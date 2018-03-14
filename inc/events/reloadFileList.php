<?php

/**
 * Module-Event: reloadFileList
 * 
 * Event wird ausgeführt, wenn Dateiliste in Dateimanager via AJAX neu geladen wird
 * Parameter: array Liste mit Dateieinträgen
 * Rückgabe: array Liste mit Dateienträgen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\events;

/**
 * Module-Event: reloadFileList
 * 
 * Event wird ausgeführt, wenn Dateiliste in Dateimanager via AJAX neu geladen wird
 * Parameter: array Liste mit Dateieinträgen
 * Rückgabe: array Liste mit Dateienträgen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @package fpcm/model/events
 */
final class reloadFileList extends \fpcm\events\abstracts\event {

    /**
     * wird ausgeführt, wenn Dateiliste neu geladen wird
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
            $eventClass = \fpcm\model\abstracts\module::getModuleEventNamespace($classkey, 'reloadFileList');

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
