<?php

/**
 * Module-Event: viewRenderBefore
 * 
 * Event wird ausgeführt, bevor eine View gerendert wird
 * Parameter: array mit View-Variablen
 * Rückgabe: array mit View-Variablen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\events\view;

/**
 * Module-Event: viewRenderBefore
 * 
 * Event wird ausgeführt, bevor eine View gerendert wird
 * Parameter: array mit View-Variablen
 * Rückgabe: array mit View-Variablen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @package fpcm/model/events
 */
final class viewRenderBefore extends \fpcm\events\abstracts\event {

    /**
     * wird ausgeführt, bevor eine View gerendert wird
     * @param array $data
     * @return array
     */
    public function run($data = null)
    {

        $eventClasses = $this->getEventClasses();

        if (!count($eventClasses))
            return $data;

        $mdata = $data;
        foreach ($eventClasses as $eventClass) {

            $classkey = $this->getModuleKeyByEvent($eventClass);
            $eventClass = \fpcm\model\abstracts\module::getModuleEventNamespace($classkey, 'viewRenderBefore');

            /**
             * @var \fpcm\events\event
             */
            $module = new $eventClass();

            if (!$this->is_a($module))
                continue;

            $mdata = $module->run($mdata);
        }

        if (!$mdata)
            return $data;

        return $mdata;
    }

}
