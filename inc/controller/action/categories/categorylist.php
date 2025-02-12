<?php

/**
 * FanPress CM 4.x
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\action\categories;

/**
 * Category list controller
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
class categorylist extends \fpcm\controller\abstracts\controller {

    use \fpcm\controller\traits\common\dataView;

    /**
     *
     * @var \fpcm\model\categories\categoryList 
     */
    protected $list;

    /**
     *
     * @var \fpcm\model\users\userRollList
     */
    protected $rollList;

    /**
     *
     * @var bool
     */
    protected $countReadOnly = false;

    /**
     * 
     * @return string
     */
    protected function getViewPath() : string
    {
        return 'components/dataview';
    }

    /**
     * 
     * @return array
     */
    protected function getPermissions()
    {
        return ['system' => 'categories'];
    }

    /**
     * 
     * @return string
     */
    protected function getHelpLink()
    {
        return 'HL_CATEGORIES_MNG';
    }

    /**
     * 
     * @return bool
     */
    public function request()
    {
        $this->list = new \fpcm\model\categories\categoryList();
        $this->rollList = new \fpcm\model\users\userRollList();

        if ($this->getRequestVar('added')) {
            $this->view->addNoticeMessage('SAVE_SUCCESS_ADDCATEGORY');
        }

        if ($this->getRequestVar('edited')) {
            $this->view->addNoticeMessage('SAVE_SUCCESS_EDITCATEGORY');
        }

        if ($this->buttonClicked('delete') && !$this->checkPageToken()) {
            $this->view->addErrorMessage('CSRF_INVALID');
            return true;
        }

        if ($this->buttonClicked('delete') && !is_null($this->getRequestVar('ids'))) {
            $category = new \fpcm\model\categories\category($this->getRequestVar('ids'));

            if ($category->delete()) {
                $this->view->addNoticeMessage('DELETE_SUCCESS_CATEGORIES');
            } else {
                $this->view->addErrorMessage('DELETE_FAILED_CATEGORIES');
            }
        }

        return true;
    }

    /**
     * 
     * @return bool
     */
    public function process()
    {
        $this->items = $this->list->getCategoriesAll();
        $this->itemsCount = count($this->items);

        $this->countReadOnly = $this->itemsCount < 2 ? true : false;
        $this->initDataView();

        $this->view->addJsFiles(['categories.js']);
        $this->view->assign('headline', 'HL_CATEGORIES_MNG');

        $this->view->setFormAction('categories/list');
        $this->view->addButtons([
            (new \fpcm\view\helper\linkButton('addnew'))->setUrl(\fpcm\classes\tools::getFullControllerLink('categories/add'))->setText('CATEGORIES_ADD')->setIcon('tag')->setClass('fpcm-loader'),
            (new \fpcm\view\helper\deleteButton('delete'))->setClass('fpcm-ui-button-confirm')
        ]);

        $this->view->render();
        return true;
    }

    /**
     * 
     * @return array
     */
    protected function getDataViewCols()
    {
        return [
            (new \fpcm\components\dataView\column('select', ''))->setSize(1)->setAlign('center'),
            (new \fpcm\components\dataView\column('button', ''))->setSize(1)->setAlign('center'),
            (new \fpcm\components\dataView\column('name', 'CATEGORIES_NAME'))->setSize(3),
            (new \fpcm\components\dataView\column('groups', 'CATEGORIES_ROLLS'))->setSize(3),
            (new \fpcm\components\dataView\column('icon', 'CATEGORIES_ICON_PATH'))->setSize(4)
        ];
    }

    /**
     * 
     * @return string
     */
    protected function getDataViewName()
    {
        return 'categorylist';
    }

    /**
     * 
     * @param \fpcm\model\categories\category $category
     * @return \fpcm\components\dataView\row
     */
    protected function initDataViewRow($category)
    {
        $rolls = $this->rollList->getRollsbyIdString($category->getGroups());

        return new \fpcm\components\dataView\row([
            new \fpcm\components\dataView\rowCol('select', (new \fpcm\view\helper\radiobutton('ids', 'ids' . $category->getId()))->setValue($category->getId())->setReadonly($this->countReadOnly), '', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT),
            new \fpcm\components\dataView\rowCol('button', (new \fpcm\view\helper\editButton('editCat'))->setUrlbyObject($category), '', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT),
            new \fpcm\components\dataView\rowCol('name', new \fpcm\view\helper\escape($category->getName())),
            new \fpcm\components\dataView\rowCol('groups', implode(', ', array_keys($rolls))),
            new \fpcm\components\dataView\rowCol('icon', $category->getCategoryImage()),
        ]);
    }

}

?>
