<?php

/**
 * FanPress CM 4
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\view\helper;

/**
 * Icon view helper object
 * 
 * @package fpcm\view\helper
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
class icon extends helper {

    use traits\iconHelper;

    public function __construct($icon)
    {
        $this->setIcon($icon);
        parent::__construct(uniqid());
    }

    /**
     * Return element string
     * @return string
     */
    protected function getString()
    {
        if ($this->iconStack) {
            return implode(PHP_EOL, [
                "<span class=\"{$this->class} fa-stack {$this->size}\"" . ($this->text ? " title=\"{$this->text}\"" : '') . ">",
                "<span class=\"fa {$this->iconStack} fa-stack-2x\"></span>",
                "<span class=\"fa {$this->icon} fa-stack-1x\"></span>",
                "</span>",
            ]);
        }

        return $this->getIconString();
    }

    /**
     * Optional init function
     * @return void
     */
    protected function init()
    {
        $this->class = 'fpcm-ui-icon-single';
    }

}

?>