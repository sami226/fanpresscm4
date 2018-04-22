<?php

/**
 * FanPress CM 4.x
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\modules;

/**
 * Module base model
 * 
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @package fpcm\modules
 */
class repoModule extends module {

    /**
     * Initialize object with database data
     * @param object $result
     * @return boolean
     */
    public function createFromRepoArray(array $result)
    {
        $this->id = isset($result->id) ? $result['id'] : false;
        $this->config = new config($this->mkey, $result);

        return true;
    }

    /**
     * 
     * @return boolean
     */
    public function init()
    {
        return true;
    }

}