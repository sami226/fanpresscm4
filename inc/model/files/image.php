<?php

/**
 * FanPress CM 4.x
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\model\files;

/**
 * Image file objekt
 * 
 * @package fpcm\model\files
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
class image extends \fpcm\model\abstracts\file {

    /**
     * Erlaubte Dateitypen
     * @var array
     */
    public static $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp'];

    /**
     * Erlaubte Dateiendungen
     * @var array
     */
    public static $allowedExts = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

    /**
     * ID von Datei-Eintrag in DB
     * @var int
     */
    protected $id;

    /**
     * Bild-Breite
     * @var int
     */
    protected $width;

    /**
     * Bild-Höhe
     * @var int
     */
    protected $height;

    /**
     * String in der Form width="" height=""
     * @var string
     */
    protected $whstring;

    /**
     * Benutzer-ID des Uploaders
     * @var int
     */
    protected $userid;

    /**
     * Zeitpunkt des Uploads
     * @var int
     */
    protected $filetime;

    /**
     * MIME-Dateityp-Info
     * @var string
     */
    protected $mimetype;

    /**
     * Exif/ IPCT data
     * @var string
     */
    protected $iptcStr;

    /**
     * Felder die in Datenbank gespeichert werden können
     * @var array
     */
    protected $dbParams = ['userid', 'filename', 'filetime', 'filesize'];
    
    /**
     * Konstruktor
     * @param string $filename file name including sub path
     * @param bool $initDB Datenbank-Eintrag initialisieren
     * @param bool $forceInit Initialisierung erzwingen
     */
    public function __construct($filename = '', $initDB = true, $forceInit = false)
    {
        $this->table = \fpcm\classes\database::tableFiles;
        $filename = $this->splitFilename($filename);
        parent::__construct($filename);

        $this->filename = $filename;

        if ($this->exists() || $forceInit) {
            $this->init($initDB);
        }
    }

    /**
     * Returns base path for file
     * @param string $filename
     * @return string
     */
    protected function basePath($filename)
    {
        return \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_UPLOADS, $filename);
    }

    /**
     * Datensatz-ID
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Bild-Url ausgeben
     * @return string
     */
    public function getImageUrl()
    {
        return \fpcm\classes\dirs::getDataUrl(\fpcm\classes\dirs::DATA_UPLOADS, $this->filename);
    }

    /**
     * Thumbnail-Url ausgeben
     * @return string
     */
    public function getThumbnailUrl()
    {
        return \fpcm\classes\dirs::getDataUrl(\fpcm\classes\dirs::DATA_UPLOADS, $this->getThumbnail());
    }

    /**
     * Dateimanager-Thumbnail ausgeben
     * @return string
     */
    public function getFileManagerThumbnailUrl()
    {
        return \fpcm\classes\dirs::getDataUrl(\fpcm\classes\dirs::DATA_FMTMP, $this->filename);
    }

    /**
     * Thumbnail-Pfad ausgeben
     * @return string
     */
    public function getThumbnail()
    {
        $fnArr = explode('/', $this->filename, 2);
        if (count($fnArr) == 2) {
            return $fnArr[0].'/thumbs/'.$fnArr[1];
        }
                
        return 'thumbs/' . $this->filename;
    }

    /**
     * kompletten Thumbnail-Pfad ausgeben
     * @return string
     */
    public function getThumbnailFull()
    {
        return \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_UPLOADS, $this->getThumbnail());
    }

    /**
     * Dateimanager-Thumbnail-Pfad ausgeben
     * @return string
     */
    public function getFileManagerThumbnail()
    {
        return \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_FMTMP, $this->filename);
    }

    /**
     * Breite ausgeben
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Höhe ausgeben
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * String width="" height="" auslesen
     * @return string
     */
    public function getWhstring()
    {
        return $this->whstring;
    }

    /**
     * Uploader-ID ausgeben
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Upload-Zeit ausgeben
     * @return int
     */
    public function getFiletime()
    {
        return $this->filetime;
    }

    /**
     * MIME-Type ausgeben
     * @return int
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Returns IPTC credit string
     * @return string
     */
    public function getIptcStr() {
        return $this->iptcStr;
    }
    
    /**
     * Datensatz-ID setzen
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Benutzer-ID setzen
     * @param int $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Upload-Zeit setzen
     * @param int $filetime
     */
    public function setFiletime($filetime)
    {
        $this->filetime = $filetime;
    }

    /**
     * Speichert einen neuen Datei-Eintrag in der Datenbank
     * @return bool
     */
    public function save()
    {
        if ($this->exists(true)) {
            return false;
        }

        $saveValues = $this->getSaveValues();
        $saveValues['filesize'] = (int) $saveValues['filesize'];

        return $this->dbcon->insert($this->table, $this->events->trigger('image\save', $saveValues));
    }

    /**
     * Aktualisiert einen Datei-Eintrag in der Datenbank
     * @return bool
     */
    public function update()
    {
        if (!$this->exists(true)) {
            return false;
        }

        $saveValues = $this->getSaveValues();
        $saveValues['filesize'] = (int) $saveValues['filesize'];

        $saveValues[] = $this->filename;
        $saveValues = $this->events->trigger('image\update', $saveValues);

        return $this->dbcon->update($this->table, $this->dbParams, array_values($saveValues), "filename = ?");
    }

    /**
     * Löscht Datei-Eintrag in Datenbank und Datei in Dateisystem
     * @return bool
     */
    public function delete()
    {
        parent::delete();
        if (file_exists($this->getFileManagerThumbnail())) {
            unlink($this->getFileManagerThumbnail());
        }

        $fileName = \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_UPLOADS, $this->getThumbnail());
        if (file_exists($fileName)) {
            unlink($fileName);
        }

        return $this->dbcon->delete($this->table, 'filename = ?', array($this->filename));
    }

    /**
     * Benennt eine Datei um
     * @param string $newname
     * @param int $userId
     * @return bool
     */
    public function rename($newname, $userId = false)
    {
        $newname = $this->splitFilename($newname);

        $oldname = $this->filename;
        if (strpos($oldname, '/') !== false) {
            $newname = dirname($oldname).DIRECTORY_SEPARATOR.$newname;
        }

        $newnameExt = $newname.'.'.$this->getExtension();
        if (!$this->isValidDataFolder($this->getFilepath(), \fpcm\classes\dirs::DATA_UPLOADS) || !parent::rename($newnameExt)) {
            return false;
        }

        $this->filetime = time();
        $this->userid = $userId;
        $params = array_merge(array_values($this->getSaveValues()), [$oldname]);
        $res = $this->dbcon->update($this->table, $this->dbParams, $params, "filename = ?");

        if (!$res) {
            trigger_error('Unable to update database file info for ' . $oldname);
            return false;
        }

        if (!$this->createThumbnail()) {
            return false;
        }

        $this->filename = $oldname;
        unlink(\fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_UPLOADS, $this->getThumbnail()));

        return true;
    }

    /**
     * Prüft ob Datei existiert
     * @param bool $dbOnly
     * @return bool
     */
    public function exists($dbOnly = false)
    {
        if (!$this->filename) {
            return false;
        }

        $count = $this->dbcon->count($this->table, '*', "filename = ?", array($this->filename));
        if ($dbOnly) {
            return $count > 0 ? true : false;
        }

        return (parent::exists() && $count > 0) ? true : false;
    }

    /**
     * Prüft, ob Bild nur in Dateisystem existiert
     * @return bool
     * @since FPCM 3.1.2
     */
    public function existsFolder()
    {
        return parent::exists();
    }

    /**
     * Erzeugt ein Thumbnail für das aktuelle Bild
     * @return bool
     */
    public function createThumbnail()
    {
        include_once \fpcm\classes\loader::libGetFilePath('PHPImageWorkshop');

        $phpImgWsp = \PHPImageWorkshop\ImageWorkshop::initFromPath($this->getFullpath());
        if (memory_get_usage(true) < \fpcm\classes\baseconfig::memoryLimit(true) * 0.5) {
            $phpImgWsp->cropMaximumInPixel(0, 0, 'MM');
        }

        $phpImgWsp->resizeInPixel($this->config->file_img_thumb_width, $this->config->file_img_thumb_height);
        $fullThumbPath = $this->getThumbnailFull();
        $phpImgWsp->save(dirname($fullThumbPath), basename($fullThumbPath), true, null, 85);

        $this->events->trigger('image\thumbnailCreate', $this);
        if (!file_exists($fullThumbPath)) {
            trigger_error('Unable to create filemanager thumbnail: ' . $this->getThumbnail());
            return false;
        }

        return true;
    }

    /**
     * Gibt Speicher-Values zurück
     * @return array
     */
    protected function getSaveValues()
    {
        $values = [];
        foreach ($this->dbParams as $key) {
            $values[$key] = ($this->$key) ? $this->$key : '';
        }

        return $values;
    }

    /**
     * initialisiert Bild-Objekt
     * @param bool $initDB
     * @return bool
     */
    protected function init($initDB)
    {
        if ($initDB) {
            $dbData = $this->dbcon->fetch($this->dbcon->select($this->table, '*', 'filename = ?', array($this->filename)));
            if (!$dbData) {
                return false;
            }

            foreach ($dbData as $key => $value) {
                $this->$key = $value;
            }
        }

        if (!parent::exists()) {
            return true;            
        }

        $ext = pathinfo($this->fullpath, PATHINFO_EXTENSION);
        $this->extension = ($ext) ? $ext : '';

        if (!$this->filesize) {
            $this->filesize = filesize($this->fullpath);
        }

        $fileData = getimagesize($this->fullpath, $metaInfo);
        if (!is_array($fileData)) {
            return true;
        }

        $this->width = $fileData[0];
        $this->height = $fileData[1];
        $this->whstring = $fileData[3];
        $this->mimetype = $fileData['mime'];

        $this->parseIptc($metaInfo);
    }

    /**
     * Füllt Objekt mit Daten aus Datenbank-Result
     * @param object $object
     * @return bool
     * @since FPCM 3.1.2
     */
    public function createFromDbObject($object)
    {
        if (!is_object($object)) {
            return false;
        }

        $keys = array_keys($this->getPreparedSaveParams());
        $keys[] = 'id';

        foreach ($keys as $key) {
            if (!isset($object->$key)) {
                continue;
            }

            $this->$key = $object->$key;
        }

        $this->fullpath = \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_UPLOADS, $this->filename);
        $this->filepath = dirname($this->fullpath);

        $this->init(false);

        return true;
    }

    /**
     * Bereitet Eigenschaften des Objects zum Speichern ind er Datenbank vor und entfernt nicht speicherbare Eigenschaften
     * @return array
     * @since FPCM 3.1.2
     */
    protected function getPreparedSaveParams()
    {
        $params = get_object_vars($this);
        unset($params['cache'], $params['config'], $params['dbcon'], $params['events'], $params['id'], $params['nodata'], $params['system'], $params['table'], $params['dbExcludes'], $params['language'], $params['editAction'], $params['objExists'], $params['cacheName']);

        if ($this->nodata)
            unset($params['data']);

        return $params;
    }

    /**
     * Splits filename with possible folder
     * @param string $filename
     * @return string
     * @since FPCM 4.1
     */
    protected function splitFilename(string $filename) : string
    {
        $filename = explode('/', $filename, 2);

        $fn = (isset($filename[1]) ? $filename[1] : $filename[0]);
        $this->escapeFileName($fn);
        if (isset($filename[1])) {
            $filename[1] = $fn;
        }
        else {
            $filename[0] = $fn;
        }

        return implode('/', $filename);;
    }

    /**
     * reads IPTC data from file
     * @param array $info
     * @return bool
     * @since FPCm 4.2.1 
     */
    public function parseIptc($info)
    {
        if (trim($this->iptcStr)) {
            return true;
        }
        
        if (!function_exists('iptcparse') || !is_array($info) || !count($info)) {
            return false;
        }

        $this->iptcStr = [];
        array_map(function ($item) {

            $iptc = iptcparse($item);
            if (!is_array($iptc) || !count($iptc)) {
                return [];
            }

            foreach (array_keys($iptc) as $s) {             
                $c = count ($iptc[$s]);
                for ($i=0; $i <$c; $i++) {
                    $this->iptcStr[$s] = $iptc[$s][$i];
                }
            }  

            $this->iptcStr = array_intersect_key($this->iptcStr, ['2#080' => 1, '2#110' => 1, '2#116' => 1]);

        }, $info);

        $this->iptcStr = utf8_encode(implode(PHP_EOL, $this->iptcStr));
        return true;
    }

}

?>