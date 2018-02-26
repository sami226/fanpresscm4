<?php

/**
 * Article list controller base
 * @article Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\action\articles;

abstract class articlelistbase extends \fpcm\controller\abstracts\controller {

    use \fpcm\controller\traits\common\dataView,
        \fpcm\controller\traits\articles\lists;


    /**
     * Liste mit erlaubten Artikel-Aktionen
     * @var array
     */
    protected $articleActions = [];

    /**
     *
     * @var bool
     */
    protected $deleteActions = false;

    /**
     *
     * @var bool
     */
    protected $canEdit = true;

    /**
     *
     * @var string
     */
    protected $listAction = '';

    /**
     *
     * @var string
     */
    protected $page = '';

    /**
     *
     * @var \fpcm\model\articles\search
     */
    protected $conditionItems;

    /**
     * 
     * @return string
     */
    protected function getViewPath()
    {
        return 'articles/listouter';
    }

    /**
     * 
     * @return string
     */
    protected function getHelpLink()
    {
        return 'hl_article_edit';
    }

    /**
     * Konstruktor
     */
    public function __construct()
    {
        parent::__construct();

        $this->initActionObjects();
        $this->initArticleActions();
        $this->initEditPermisions();
    }

    /**
     * Request-Handler
     * @return boolean
     */
    public function request()
    {   
        if (($this->buttonClicked('doAction') || $this->buttonClicked('clearTrash')) && !$this->checkPageToken()) {
            $this->view->addErrorMessage('CSRF_INVALID');
            return $this->init();
        }

        if ($this->buttonClicked('doAction') && !is_null($this->getRequestVar('actions'))) {

            $actionData = $this->getRequestVar('actions');

            if ($actionData['action'] === 'trash') {

                if (!$this->doTrash()) {
                    $this->view->addErrorMessage('DELETE_FAILED_TRASH');
                } else {
                    $this->view->addNoticeMessage('DELETE_SUCCESS_TRASH');
                }

                return $this->init();
            }


            if ((!isset($actionData['ids']) && $actionData['action'] != 'trash') || !$actionData['action']) {
                $this->view->addErrorMessage('SELECT_ITEMS_MSG');
                return $this->init();
            }

            $ids = array_map('intval', $actionData['ids']);

            $action = in_array($actionData['action'], array_values($this->articleActions)) ? $actionData['action'] : false;

            if ($action === false) {
                $this->view->addErrorMessage('SELECT_ITEMS_MSG');
                return $this->init();
            }

            if (!call_user_func([$this, 'do' . ucfirst($action)], $ids)) {
                $msg = ($action == 'delete') ? 'DELETE_FAILED_ARTICLE' : 'SAVE_FAILED_ARTICLE';
                $this->view->addErrorMessage($msg);
                return $this->init();
            }

            $msg = ($action == 'delete') ? 'DELETE_SUCCESS_ARTICLE' : 'SAVE_SUCCESS_ARTICLE' . strtoupper($action);
            $this->view->addNoticeMessage($msg);
        }

        return $this->init();
    }

    /**
     * 
     * @return boolean
     */
    private function init()
    {
        $this->getListAction();
        $this->getLimitsByPage();
        $this->getConditionItem();
        $this->getArticleCount();
        $this->getArticleItems();
        
        return true;
    }

    /**
     * Controller-Processing
     * @return boolean
     */
    public function process()
    {
        $this->initActionVars();

        $this->view->assign('users', array_flip($this->users));
        $this->view->assign('commentEnabledGlobal', $this->config->system_comments_enabled);
        $this->view->assign('showDraftStatus', $this->showDraftStatus);
        $this->view->assign('articleActions', $this->articleActions);
        $this->view->assign('deletePermissions', $this->deleteActions);

        $this->initSearchForm($this->users);
        $this->initMassEditForm($this->users);

        $this->view->addJsFiles(['articlelist.js']);

        $buttons = [];

        if ($this->listAction !== 'articles/trash') {

            if ($this->permissions->check(['article' => 'add'])) {
                $buttons[] = (new \fpcm\view\helper\linkButton('addArticle'))->setUrl(\fpcm\classes\tools::getFullControllerLink('articles/add'))->setText('HL_ARTICLE_ADD')->setIcon('pencil')->setIconOnly(true);
            }

            if ($this->canEdit) {
                $buttons[] = (new \fpcm\view\helper\button('massEdit', 'massEdit'))->setText('GLOBAL_EDIT')->setIcon('pencil-square-o')->setIconOnly(true);
            }

            $buttons[] = (new \fpcm\view\helper\button('opensearch', 'opensearch'))->setText('ARTICLES_SEARCH')->setIcon('search')->setIconOnly(true);
        }

        $buttons[] = (new \fpcm\view\helper\select('actions'))->setOptions($this->articleActions);
        $buttons[] = (new \fpcm\view\helper\submitButton('doAction'))->setText('GLOBAL_OK')->setClass('fpcm-loader')->setIcon('check')->setIconOnly(true);
        
        if ($this->listAction !== 'articles/trash') {
            $this->view->addPager((new \fpcm\view\helper\pager($this->listAction, $this->page, count($this->articleItems), $this->config->articles_acp_limit, $this->articleCount)));
        }
        
        $this->view->addButtons($buttons);
        
        $minMax = $this->articleList->getMinMaxDate(1);
        $this->view->addJsVars([
            'articleSearchMode'   => $this->getSearchMode(),
            'articleSearchMinDate' => date('Y-m-d', $minMax['minDate'])
        ]);

        $formActionParams = [];
        if ($this->page) {
            $formActionParams['page'] = $this->page;
        }
        
        $this->view->setFormAction($this->listAction, $formActionParams);
        
        $this->translateCategories();

        $this->initDataView();
        $this->view->addDataView($this->dataView);

        return true;
    }

    /**
     * Artikel löschen
     * @param array $ids
     * @return boolean
     */
    protected function doDelete(array $ids)
    {
        if (!$this->deleteActions) {
            return false;
        }

        return $this->articleList->deleteArticles($ids);
    }

    /**
     * Papierkorb leeren
     * @return boolean
     */
    protected function doTrash()
    {
        if (!$this->deleteActions) {
            return false;
        }

        return $this->articleList->emptyTrash();
    }

    /**
     * Artikel aus Papierkorb wiederherstellen
     * @param array $ids
     * @return boolean
     */
    protected function doRestore(array $ids)
    {
        if (!$this->deleteActions) {
            return false;
        }
        
        return $this->articleList->restoreArticles($ids);
    }
    
    protected function getLimitsByPage()
    {
        $this->page          = $this->getRequestVar('page', [\fpcm\classes\http::FPCM_REQFILTER_CASTINT]);
        $this->listShowStart = \fpcm\classes\tools::getPageOffset($this->page, $this->config->articles_acp_limit);
    }

    protected function initArticleActions()
    {
        if (!$this->permissions) {
            return false;
        }

        $this->canEdit = $this->permissions->check(['article' => ['edit', 'editall', 'approve', 'archive']]);

        $this->view->assign('canEdit', $this->canEdit);
        $this->deleteActions = $this->permissions->check(['article' => 'delete']);

        $tweet = new \fpcm\model\system\twitter();

        if ($tweet->checkRequirements() && $tweet->checkConnection()) {
            $this->articleActions['ARTICLE_LIST_NEWTWEET'] = 'newtweet';
        }

        if ($this->deleteActions) {
            $this->articleActions['GLOBAL_DELETE'] = 'delete';
        }

        $this->articleActions['ARTICLES_CACHE_CLEAR'] = 'articlecache';

        $crypt = \fpcm\classes\loader::getObject('\fpcm\classes\crypt');
        $this->view->addJsVars(['artCacheMod' => urlencode($crypt->encrypt(\fpcm\model\articles\article::CACHE_ARTICLE_MODULE))]);
    }

    /**
     * Initialisiert Suchformular
     * @param array $users
     */
    private function initSearchForm($users)
    {
        $users = ['ARTICLE_SEARCH_USER' => -1] + $users;
        $this->view->assign('searchUsers', $users);

        $categories = ['ARTICLE_SEARCH_CATEGORY' => -1] + $this->categories;
        $this->view->assign('searchCategories', $categories);

        $this->view->assign('searchTypes', [
            'ARTICLE_SEARCH_TYPE_ALL' => -1,
            'ARTICLE_SEARCH_TYPE_TITLE' => 0,
            'ARTICLE_SEARCH_TYPE_TEXT' => 1
        ]);

        $this->view->assign('searchPinned', [
            'ARTICLE_SEARCH_PINNED' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('searchPostponed', [
            'ARTICLE_SEARCH_POSTPONED' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('searchComments', [
            'ARTICLE_SEARCH_COMMENTS' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('searchApproval', [
            'ARTICLE_SEARCH_APPROVAL' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('searchDraft', [
            'ARTICLE_SEARCH_DRAFT' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('searchCombination', [
            'ARTICLE_SEARCH_LOGICAND' => 0,
            'ARTICLE_SEARCH_LOGICOR' => 1
        ]);

        $this->view->addJsLangVars(['SEARCH_WAITMSG', 'ARTICLES_SEARCH', 'ARTICLE_SEARCH_START']);
        $this->view->addJsVars(['articlesLastSearch' => 0]);
    }

    /**
     * Initialisiert Massenbearbeitung
     * @param array $users
     */
    private function initMassEditForm($users)
    {
        $this->view->assign('massEditUsers', ['GLOBAL_NOCHANGE_APPLY' => -1] + $users);
        $this->view->assign('massEditCategories', $this->categories);

        $this->view->assign('massEditPinned', [
            'GLOBAL_NOCHANGE_APPLY' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('massEditPostponed', [
            'GLOBAL_NOCHANGE_APPLY' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('massEditComments', [
            'GLOBAL_NOCHANGE_APPLY' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('massEditApproved', [
            'GLOBAL_NOCHANGE_APPLY' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('massEditDraft', [
            'GLOBAL_NOCHANGE_APPLY' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->assign('massEditArchived', [
            'GLOBAL_NOCHANGE_APPLY' => -1,
            'GLOBAL_YES' => 1,
            'GLOBAL_NO' => 0
        ]);

        $this->view->addJsLangVars(['SAVE_FAILED_ARTICLES']);
        $this->view->addJsVars(['masseditPageToken' => \fpcm\classes\security::createPageToken('articles/massedit')]);
    }

    abstract protected function getArticleCount();

    abstract protected function getArticleItems();

    abstract protected function getConditionItem();

    abstract protected function getListAction();

    abstract protected function getSearchMode();

}

?>
