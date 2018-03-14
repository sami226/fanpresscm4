<?php

/**
 * Module-Event: commentsByCondition
 * 
 * Event wird ausgeführt, wenn Kommentar-Suche ausgeführt wird
 * Parameter: array Suchbedingungen
 * Rückgabe: array Suchbedingungen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @since FPCM 3.4
 */

namespace fpcm\events\comments;

/**
 * Module-Event: commentsByCondition
 * 
 * Event wird ausgeführt, wenn Kommentar-Suche ausgeführt wird
 * Parameter: array Suchbedingungen
 * Rückgabe: array Suchbedingungen
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @package fpcm/model/events
 * @since FPCM 3.4
 */
final class commentsByCondition extends \fpcm\events\abstracts\event {

    /**
     * wird ausgeführt, wenn Kommentar-Suche ausgeführt wird
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
            $eventClass = \fpcm\model\abstracts\module::getModuleEventNamespace($classkey, 'commentsByCondition');

            /**
             * @var \fpcm\events\event
             */
            $module = new $eventClass();

            if (!$this->is_a($module))
                continue;

            $mdata = $module->run($mdata);
        }

        if (!$mdata || !is_array($mdata) || !isset($eventData['where']) || !is_array($eventData['where']) || !isset($eventData['conditions']) || !is_array($eventData['conditions'])) {
            return $data;
        }

        return $mdata;
    }

}
