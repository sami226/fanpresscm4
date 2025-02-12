<?php

/**
 * FanPress CM table model object
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @since FPCM 3.2.0
 */

namespace fpcm\model\abstracts;

/**
 * Table model object
 * 
 * @author Stefan Seehafer aka imagine <fanpress@nobody-knows.org>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @since FPCM 3.2.0
 */
abstract class tablelist {

    /**
     * DB-Verbindung
     * @var \fpcm\classes\database
     */
    protected $dbcon;

    /**
     * Tabellen-Name
     * @var string
     */
    protected $table;

    /**
     * System-Cache
     * @var \fpcm\classes\cache
     */
    protected $cache;

    /**
     * Event-Liste
     * @var \fpcm\events\events 
     */
    protected $events;

    /**
     * System-Config-Objekt
     * @var \fpcm\model\system\config
     */
    protected $config;

    /**
     * System-Sprachen-Objekt
     * @var \fpcm\classes\language
     */
    protected $language;

    /**
     * Notifications
     * @var \fpcm\model\theme\notifications
     * @since FPCM 3.6
     */
    protected $notifications;

    /**
     * Cache name
     * @var string
     */
    protected $cacheName = false;

    /**
     * Cache Modul
     * @var string
     * @since FPCM 3.4
     */
    protected $cacheModule = '';

    /**
     * Data array
     * @var array
     * @since FPCM 4.1
     */
    protected $data = [];

    /**
     * Konstruktor
     * @param int $id
     * @return void
     */
    public function __construct()
    {
        $this->dbcon = \fpcm\classes\loader::getObject('\fpcm\classes\database');
        $this->events = \fpcm\classes\loader::getObject('\fpcm\events\events');
        $this->cache = \fpcm\classes\loader::getObject('\fpcm\classes\cache');

        if (\fpcm\classes\baseconfig::installerEnabled()) {
            return false;
        }

        $this->config = \fpcm\classes\loader::getObject('\fpcm\model\system\config');
        $this->language = \fpcm\classes\loader::getObject('\fpcm\classes\language', $this->config->system_lang);
        $this->notifications = \fpcm\classes\loader::getObject('\fpcm\model\theme\notifications');

        if (is_object($this->config)) {
            $this->config->setUserSettings();
        }

        return true;
    }

    /**
     * Magische Methode für nicht vorhandene Methoden
     * @param string $name
     * @param mixed $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        print "Function '{$name}' not found in " . get_class($this) . '<br>';
        return false;
    }

    /**
     * Magische Methode für nicht vorhandene, statische Methoden
     * @param string $name
     * @param mixed $arguments
     * @return bool
     */
    public static function __callStatic($name, $arguments)
    {
        print "Static function '{$name}' not found in " . get_called_class() . '<br>';
        return false;
    }

    /**
     * Konstruktor
     * @return void
     */
    public function __destruct()
    {
        $this->dbcon = false;
        $this->cache = null;
        $this->events = null;

        return;
    }

}
