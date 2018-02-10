<?php
    /**
     * FanPress CM 3.x
     * @license http://www.gnu.org/licenses/gpl.txt GPLv3
     */

    namespace fpcm\controller\traits\system;
    
    /**
     * System check trait
     * 
     * @package fpcm\controller\traits\system\syscheck
     * @author Stefan Seehafer <sea75300@yahoo.de>
     * @copyright (c) 2011-2018, Stefan Seehafer
     * @license http://www.gnu.org/licenses/gpl.txt GPLv3
     */
    trait syscheck {
        
        /**
         * System-Check ausführen
         * @return array
         */
        protected function getCheckOptionsSystem() {
            $checkOptions     = [];
            
            $loadedExtensions = array_map('strtolower', get_loaded_extensions());

            $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_PHPVERSION', ['value' => FPCM_PHP_REQUIRED])]    = array(
                'current'   => phpversion(),
                'recommend' => FPCM_PHP_REQUIRED,
                'result'    => version_compare(phpversion(), FPCM_PHP_REQUIRED, '>='),
                'helplink'  => 'http://php.net/',
                'optional'  => 0,
                'isFolder'  => 0
            );
            
            $recomVal = 64;
            $curVal   = \fpcm\classes\baseconfig::memoryLimit();
            $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_PHPMEMLIMIT', ['value' => $recomVal.' MiB'])]    = array(
                'current'   => $curVal.' MiB',  
                'recommend' => $recomVal.' MiB',
                'result'    => ($curVal >= $recomVal ? true : false),
                'helplink'  => 'http://php.net/manual/de/info.configuration.php',
                'optional'  => 1,
                'isFolder'  => 0
            );
            
            $recomVal = 10;
            $curVal   = ini_get('max_execution_time');
            $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_PHPMAXEXECTIME', ['value' => $recomVal.' sec'])]    = array(
                'current'   => $curVal.' sec',
                'recommend' => $recomVal.' sec',
                'result'    => ($curVal >= $recomVal ? true : false),
                'helplink'  => 'http://php.net/manual/de/info.configuration.php',
                'optional'  => 1,
                'isFolder'  => 0
            );

            $dbDrivers   = \PDO::getAvailableDrivers();
            $resultMySql = in_array(\fpcm\classes\database::DBTYPE_MYSQLMARIADB, $dbDrivers);
            $resultPgSql = in_array(\fpcm\classes\database::DBTYPE_POSTGRES, $dbDrivers);
            $sqlhelp     = 'http://php.net/manual/de/pdo.getavailabledrivers.php';

            $current = $resultMySql || $resultPgSql ? true : false;
            
            $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_DBDRV_MYSQL', ['value' => 'true'])]    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => $resultMySql,
                'helplink'  => $sqlhelp,
                'optional'  => (!$resultMySql && $resultPgSql ? 1 : 0),
                'isFolder'  => 0
            );
            
            $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_DBDRV_PGSQL', ['value' => 'true'])]    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => $resultPgSql,
                'helplink'  => $sqlhelp,
                'optional'  => ($resultMySql ? 1 : 0),
                'isFolder'  => 0
            );
    
            if (is_object(\fpcm\classes\loader::getObject('\fpcm\classes\database'))) {
                
                $db = \fpcm\classes\loader::getObject('\fpcm\classes\database');
                
                $recommend = implode('/', array_intersect($dbDrivers, array_keys(\fpcm\classes\database::$supportedDBMS)));
                
                $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_DBDRV_ACTIVE', ['value' => $recommend])]    = array(
                    'current'   => $db->getDbtype(),
                    'recommend' => $recommend,
                    'result'    => true,
                    'helplink'  => 'http://php.net/manual/de/pdo.getavailabledrivers.php',
                    'optional'  => 0,
                    'isFolder'  => 0
                );

                $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_DBVERSION', ['value' => $db->getRecommendVersion()])]    = array(
                    'current'   => $db->getDbVersion(),
                    'recommend' => $db->getRecommendVersion(),
                    'result'    => $db->checkDbVersion(),
                    'helplink'  => 'http://php.net/manual/de/pdo.getattribute.php',
                    'optional'  => 0,
                    'isFolder'  => 0
                );
            }
            
            $current = in_array('pdo', $loadedExtensions) && in_array('pdo_mysql', $loadedExtensions);
            $checkOptions['PHP Data Objects (PDO)']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/en/class.pdo.php',
                'optional'  => 0,
                'isFolder'  => 0
            );

            $current = (CRYPT_SHA256 == 1 ? true : false);
            $current = $current && in_array(\fpcm\classes\security::defaultHashAlgo, hash_algos());            
            $checkOptions['SHA256 Hash Algorithm']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/en/function.hash-algos.php',
                'optional'  => 0,
                'isFolder'  => 0
            );
            
            $current = in_array('gd', $loadedExtensions);
            $checkOptions['GD Lib']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/en/book.image.php',
                'optional'  => 0,
                'isFolder'  => 0
            );
            
            $current = in_array('json', $loadedExtensions);
            $checkOptions['JSON']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/en/book.json.php',
                'optional'  => 0,
                'isFolder'  => 0
            );
            
            $current = in_array('xml', $loadedExtensions) && in_array('simplexml', $loadedExtensions) && class_exists('DOMDocument');
            $checkOptions['XML, SimpleXML, DOMDocument']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/en/class.simplexmlelement.php',
                'optional'  => 0,
                'isFolder'  => 0
            );
            
            $current = in_array('zip', $loadedExtensions);
            $checkOptions['ZipArchive']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/en/class.ziparchive.php',
                'optional'  => 0,
                'isFolder'  => 0
            );
            
            $current = in_array('openssl', $loadedExtensions);
            $checkOptions['OpenSSL ('.$this->lang->translate('GLOBAL_OPTIONAL').')']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $current),
                'helplink'  => 'http://php.net/manual/de/book.openssl.php',
                'optional'  => 1,
                'isFolder'  => 0
            );
            
            $current = in_array('curl', $loadedExtensions);
            $checkOptions['cURL ('.$this->lang->translate('GLOBAL_OPTIONAL').')']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (false || $current),
                'helplink'  => 'http://php.net/manual/en/book.curl.php',
                'optional'  => 1,
                'isFolder'  => 0
            ); 
            
            $externalCon = \fpcm\classes\baseconfig::canConnect();
            $checkOptions['allow_url_fopen = 1 ('.$this->lang->translate('GLOBAL_OPTIONAL').')']    = array(
                'current'   => $externalCon ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $externalCon),
                'helplink'  => 'http://php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen',
                'optional'  => 1,
                'isFolder'  => 0
            );
            
            $https = \fpcm\classes\baseconfig::canHttps();
            $checkOptions[$this->lang->translate('SYSTEM_OPTIONS_SYSCHECK_HTTPS').' ('.$this->lang->translate('GLOBAL_OPTIONAL').')']    = array(
                'current'   => $https ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (true && $https),
                'helplink'  => 'http://php.net/manual/en/reserved.variables.server.php',
                'optional'  => 1,
                'isFolder'  => 0
            );  
            
            $current = in_array('phar', $loadedExtensions);
            $checkOptions['Phar ('.$this->lang->translate('GLOBAL_OPTIONAL').')']    = array(
                'current'   => $current ? 'true' : 'false',
                'recommend' => 'true',
                'result'    => (false || $current),
                'helplink'  => 'http://php.net/manual/en/class.phar.php',
                'optional'  => 1,
                'isFolder'  => 0
            );

            $checkFolders = $this->getCheckFolders();
            foreach ($checkFolders as $description => $folderPath) {
                $current = is_writable($folderPath);
                
                $pathOutput = \fpcm\model\files\ops::removeBaseDir($folderPath, true);
                $checkOptions['<i>'.$description.'</i> '.$pathOutput]    = array(
                    'current'   => $current ? 'true' : 'false',
                    'recommend' => 'true',
                    'result'    => (true && $current),
                    'optional'  => 0,
                    'isFolder'  => 1
                );                
            }
            
            return $checkOptions;
        }
        
        public function getCheckFolders() {
            
            $checkFolders = array(
                $this->lang->translate('SYSCHECK_FOLDER_DATA')          => \fpcm\classes\dirs::getDataDirPath(''),
                $this->lang->translate('SYSCHECK_FOLDER_CACHE')         => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_CACHE),
                $this->lang->translate('SYSCHECK_FOLDER_CONFIG')        => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_CONFIG),
                $this->lang->translate('SYSCHECK_FOLDER_FILEMANAGER')   => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_FMTMP),
                $this->lang->translate('SYSCHECK_FOLDER_LOGS')          => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_LOGS),
                $this->lang->translate('SYSCHECK_FOLDER_MODULES')       => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_MODULES),
                $this->lang->translate('SYSCHECK_FOLDER_SHARE')         => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_SHARE),
                $this->lang->translate('SYSCHECK_FOLDER_SMILEYS')       => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_SMILEYS),
                $this->lang->translate('SYSCHECK_FOLDER_STYLES')        => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_STYLES),
                $this->lang->translate('SYSCHECK_FOLDER_TEMP')          => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_TEMP),
                $this->lang->translate('SYSCHECK_FOLDER_UPLOADS')       => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_UPLOADS),
                $this->lang->translate('SYSCHECK_FOLDER_DBDUMPS')       => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_DBDUMP),
                $this->lang->translate('SYSCHECK_FOLDER_DRAFTS')        => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_DRAFTS),
                $this->lang->translate('SYSCHECK_FOLDER_PROFILES')      => \fpcm\classes\dirs::getDataDirPath(\fpcm\classes\dirs::DATA_PROFILES),
            );
            
            natsort($checkFolders);
            
            return $checkFolders;
        }
        
    }
?>