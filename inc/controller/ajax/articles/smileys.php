<?php

/**
 * AJAX article editor smileys controller
 * 
 * Editor Smiley controller
 * 
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\ajax\articles;

/**
 * Editor smiley ajax controller
 * 
 * @package fpcm\controller\ajax\articles\smileys
 * @author Stefan Seehafer <sea75300@yahoo.de>
 */
class smileys extends \fpcm\controller\abstracts\ajaxController {

    /**
     * 
     * @return array
     */
    protected function getPermissions()
    {
        return ['article' => ['add', 'edit', 'editall']];
    }

    protected function getViewPath() : string
    {
        return $this->getRequestVar('json') ? '' : 'articles/editors/smileys';
    }

    /**
     * Controller-Processing
     */
    public function process()
    {
        $values = array_values((new \fpcm\model\files\smileylist())->getDatabaseList());

        if ($this->getRequestVar('json')) {
            $this->returnData = $values;
            $this->getSimpleResponse();
        }

        $this->view->assign('smileys', $values);
    }

}

?>