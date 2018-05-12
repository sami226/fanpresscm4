<?php

/**
 * FanPress CM 4.x
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\action\comments;

/**
 * Comment trash list controller
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
class commenttrash extends \fpcm\controller\abstracts\controller {

    use \fpcm\controller\traits\common\dataView;

    /**
     * Data view object
     * @var \fpcm\components\dataView\dataView
     */
    protected $dataView;

    /**
     * 
     * @return string
     */
    protected function getHelpLink()
    {
        return 'hl_comments_mng';
    }

    /**
     * 
     * @return string
     */
    protected function getViewPath()
    {
        return 'comments/trash';
    }
    
    protected function initActionObjects()
    {
        $conditions = new \fpcm\model\comments\search();
        $conditions->deleted = 1;
        
        $this->items = (new \fpcm\model\comments\commentList())->getCommentsBySearchCondition($conditions);
        return true;
    }

    /**
     * @see \fpcm\controller\abstracts\controller::request()
     * @return boolean
     */
    public function request()
    {
        if (!$this->buttonClicked('doAction')) {
            return true;
        }

        if (!$this->checkPageToken()) {
            $this->view->addErrorMessage('CSRF_INVALID');
            return true;
        }

        return true;
    }

    /**
     * @see \fpcm\controller\abstracts\controller::process()
     * @return mixed
     */
    public function process()
    {
        $this->view->assign('commentsMode', 1);
        $this->view->setFormAction('comments/trash');
        $this->view->addJsFiles(['comments.js']);

        $this->view->addButtons([    
            (new \fpcm\view\helper\select('action'))->setOptions(['ARTICLE_LIST_RESTOREARTICLE' => 'restore', 'ARTICLE_LIST_EMPTYTRASH' => 'trash']),
            (new \fpcm\view\helper\submitButton('doAction'))->setIcon('check')->setText('GLOBAL_OK')->setIconOnly(true)

        ]);

        $this->initDataView();
    }
    
    protected function getDataViewCols()
    {
        return [
            (new \fpcm\components\dataView\column('select', (new \fpcm\view\helper\checkbox('fpcm-select-all'))->setClass('fpcm-select-all')))->setSize('05')->setAlign('center'),
            (new \fpcm\components\dataView\column('button', ''))->setSize(2),
            (new \fpcm\components\dataView\column('name', 'COMMMENT_AUTHOR'))->setSize(2),
            (new \fpcm\components\dataView\column('email', 'GLOBAL_EMAIL'))->setSize(3),
            (new \fpcm\components\dataView\column('create', 'COMMMENT_CREATEDATE'))->setSize(3)->setAlign('center'),
            (new \fpcm\components\dataView\column('metadata', ''))->setAlign('center'),
        ];
    }

    protected function getDataViewName()
    {
        return 'commenttrash';
    }

    /**
     * 
     * @param \fpcm\model\comments\comment $item
     * @return \fpcm\components\dataView\row
     */
    protected function initDataViewRow($item)
    {
        $buttons = [
            '<div class="fpcm-ui-controlgroup">',
            (new \fpcm\view\helper\openButton('commentfe'))->setUrlbyObject($item)->setTarget('_blank'),
            (new \fpcm\view\helper\editButton('commentedit'))->setUrlbyObject($item, '&mode=1')->setClass('fpcm-ui-commentlist-link'),
            '</div>'
        ];
        
        return new \fpcm\components\dataView\row([
            new \fpcm\components\dataView\rowCol('select', (new \fpcm\view\helper\checkbox('ids[' . ($item->getEditPermission() ? '' : 'ro') . ']', 'chbx' . $item->getId()))->setClass('fpcm-ui-list-checkbox')->setValue($item->getId())->setReadonly(!$item->getEditPermission()), '', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT),
            new \fpcm\components\dataView\rowCol('button', implode('', $buttons), 'fpcm-ui-dataview-align-center fpcm-ui-font-small', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT),
            new \fpcm\components\dataView\rowCol('name', $item->getName(), 'fpcm-ui-ellipsis'),
            new \fpcm\components\dataView\rowCol('email', $item->getEmail(), 'fpcm-ui-ellipsis'),
            new \fpcm\components\dataView\rowCol('create', new \fpcm\view\helper\dateText($item->getCreatetime()), 'fpcm-ui-ellipsis'),
            new \fpcm\components\dataView\rowCol('metadata', implode('', $item->getMetaDataStatusIcons()), 'fpcm-ui-metabox fpcm-ui-dataview-align-center', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT),
        ]);
    }


}

?>