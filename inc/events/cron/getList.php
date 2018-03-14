<?php

/**
 * Module-Event: getCronList
 * 
 * Event wird ausgeführt, wenn Liste von Cronjob-Dateien für asynchrone Ausführung geladen wird
 * Parameter: array mit Dateiliste von Cronjob-Classen
 * Rückgabe: array mit Dateiliste von Cronjob-Classen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\events\cron;

/**
 * Module-Event: getCronList
 * 
 * Event wird ausgeführt, wenn Liste von Cronjob-Dateien für asynchrone Ausführung geladen wird
 * Parameter: array mit Dateiliste von Cronjob-Classen
 * Rückgabe: array mit Dateiliste von Cronjob-Classen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @package fpcm/model/events
 */
final class getCronList extends \fpcm\events\abstracts\event {

    /**
     * wird ausgeführt, wenn Liste von Cronjob-Dateien für asynchrone Ausführung geladen wird
     * @param array $data
     * @return array
     */
    public function run($data = null)
    {

        $eventClasses = $this->getEventClasses();

        if (!count($eventClasses))
            return [];

        $mdata = $data;
        foreach ($eventClasses as $eventClass) {

            $classkey = $this->getModuleKeyByEvent($eventClass);
            $eventClass = \fpcm\model\abstracts\module::getModuleEventNamespace($classkey, 'getCronList');

            /**
             * @var \fpcm\events\event
             */
            $module = new $eventClass();

            if (!$this->is_a($module))
                continue;

            $mdata = $module->run($mdata);
        }

        if (!isset($mdata))
            return $data;

        return $mdata;
    }

}
