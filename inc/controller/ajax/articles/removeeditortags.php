<?php

/**
 * AJAX remove editor tags controller
 * 
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\ajax\articles;

/**
 * Entfernt in HTML-Editor-Ansicht über entsprechenden Button alle HTML-Tags
 * 
 * @package fpcm\controller\ajax\articles\removeeditortags
 * @author Stefan Seehafer <sea75300@yahoo.de>
 */
class removeeditortags extends \fpcm\controller\abstracts\ajaxController {

    /**
     * 
     * @return array
     */
    protected function getPermissions()
    {
        return ['article' => ['add', 'edit', 'editall']];
    }

    /**
     * Request-Handler
     * @return bool
     */
    public function request()
    {
        return $this->session->exists();
    }

    /**
     * Controller-Processing
     */
    public function process()
    {


        exit(strip_tags($this->getRequestVar('text')));
    }

}

?>