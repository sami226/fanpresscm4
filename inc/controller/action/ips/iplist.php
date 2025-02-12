<?php

/**
 * FanPress CM 4.x
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\action\ips;

/**
 * IP address list controller
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
class iplist extends \fpcm\controller\abstracts\controller {

    use \fpcm\controller\traits\common\dataView;

    /**
     *
     * @var array
     */
    private $users = [];

    /**
     *
     * @var array
     */
    private $notfoundStr = '';

    /**
     * 
     * @return array
     */
    protected function getPermissions()
    {
        return ['system' => 'ipaddr'];
    }

    /**
     * 
     * @return string
     */
    protected function getHelpLink()
    {
        return 'HL_OPTIONS_IPBLOCKING';
    }

    /**
     * 
     * @return string
     */
    protected function getActiveNavigationElement()
    {
        return 'submenu-itemnav-item-ips';
    }

    /**
     * Request-Handler
     * @return bool
     */
    public function request()
    {
        if ($this->getRequestVar('added') == 1) {
            $this->view->addNoticeMessage('SAVE_SUCCESS_IPADDRESS');
        }

        if ($this->getRequestVar('added') == 2) {
            $this->view->addNoticeMessage('SAVE_SUCCESS_IPADDRESS_CHG');
        }

        if ($this->buttonClicked('delete') && !$this->checkPageToken()) {
            $this->view->addErrorMessage('CSRF_INVALID');
            return true;
        }

        if ($this->buttonClicked('delete') && !is_null($this->getRequestVar('ipids'))) {

            $ids = array_map('intval', $this->getRequestVar('ipids'));

            if ($this->ipList->deleteIpAdresses($ids)) {
                $this->view->addNoticeMessage('DELETE_SUCCESS_IPADDRESS');
            } else {
                $this->view->addErrorMessage('DELETE_FAILED_IPADDRESS');
            }
        }

        return true;
    }

    /**
     * Controller-Processing
     */
    public function process()
    {
        $userList = new \fpcm\model\users\userList();
        $this->items = $this->ipList->getIpAll();
        $this->users = $userList->getUsersAll();
        
        $this->notfoundStr = $this->language->translate('GLOBAL_NOTFOUND');
        
        $this->initDataView();
        
        $this->view->assign('headline', 'HL_OPTIONS_IPBLOCKING');
        $this->view->setFormAction('ips/list');
        $this->view->addJsFiles(['ipadresses.js']);
        $this->view->addButtons([
            (new \fpcm\view\helper\linkButton('addnew'))->setUrl(\fpcm\classes\tools::getFullControllerLink('ips/add'))->setText('IPLIST_ADDIP')->setIcon('globe')->setClass('fpcm-loader'),
            (new \fpcm\view\helper\deleteButton('delete'))->setClass('fpcm-ui-button-confirm')
        ]);
        $this->view->render();
    }

    /**
     * 
     * @return array
     */
    protected function getDataViewCols()
    {
        return [
            (new \fpcm\components\dataView\column('select', (new \fpcm\view\helper\checkbox('fpcm-select-all'))->setClass('fpcm-select-all')))->setSize(1)->setAlign('center'),
            (new \fpcm\components\dataView\column('button', ''))->setSize(1)->setAlign('center'),
            (new \fpcm\components\dataView\column('ipaddress', 'IPLIST_IPADDRESS'))->setSize(4),
            (new \fpcm\components\dataView\column('user', 'LOGS_LIST_USER'))->setSize(2),
            (new \fpcm\components\dataView\column('time', 'IPLIST_IPTIME'))->setSize(2),
            (new \fpcm\components\dataView\column('metadata', '')),
        ];
    }

    /**
     * 
     * @return string
     */
    protected function getDataViewName()
    {
        return 'iplist';
    }

    /**
     * 
     * @param \fpcm\model\ips\ipaddress $item
     * @return \fpcm\components\dataView\row
     */
    protected function initDataViewRow($item)
    {
        $userName   = isset($this->users[$item->getUserid()])
                    ? $this->users[$item->getUserid()]->getDisplayName()
                    : $this->notfoundStr;
        
        $metaData   = [
            (new \fpcm\view\helper\icon('comment-slash fa-inverse'))->setClass('fpcm-ui-editor-metainfo fpcm-ui-status-' . $item->getNocomments())->setText('IPLIST_NOCOMMENTS')->setStack('square'),
            (new \fpcm\view\helper\icon('sign-in-alt fa-inverse'))->setClass('fpcm-ui-editor-metainfo fpcm-ui-status-' . $item->getNologin())->setText('IPLIST_NOLOGIN')->setStack('square'),
            (new \fpcm\view\helper\icon('ban fa-inverse'))->setClass('fpcm-ui-editor-metainfo fpcm-ui-status-' . $item->getNoaccess())->setText('IPLIST_NOACCESS')->setStack('square')
        ];

        return new \fpcm\components\dataView\row([
            new \fpcm\components\dataView\rowCol('select', (new \fpcm\view\helper\checkbox('ipids[]', 'chbx' . $item->getId()))->setClass('fpcm-ui-list-checkbox')->setValue($item->getId()), '', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT),
            new \fpcm\components\dataView\rowCol('button', (new \fpcm\view\helper\editButton('ipedit'.$item->getId()))->setUrlbyObject($item) ),
            new \fpcm\components\dataView\rowCol('ipaddress', new \fpcm\view\helper\escape($item->getIpaddress()) ),
            new \fpcm\components\dataView\rowCol('user', new \fpcm\view\helper\escape($userName) ),
            new \fpcm\components\dataView\rowCol('time', new \fpcm\view\helper\dateText($item->getIptime()) ),
            new \fpcm\components\dataView\rowCol('metadata', implode('', $metaData), 'fpcm-ui-metabox fpcm-ui-dataview-align-center', \fpcm\components\dataView\rowCol::COLTYPE_ELEMENT ),
        ]);
    }

    
}

?>
