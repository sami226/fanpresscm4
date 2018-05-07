<?php

/**
 * FanPress CM 4.x
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */

namespace fpcm\controller\ajax\files;

/**
 * AJAX Controller zum Laden der Dateiliste im Dateimanager
 * 
 * @package fpcm\controller\ajax\files\filelist
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
class rename extends \fpcm\controller\abstracts\ajaxController {

    /**
     *
     * @var string
     */
    private $fileName = '';

    /**
     *
     * @var string
     */
    private $newFileName = '';

    /**
     * 
     * @return array
     */
    protected function getPermissions()
    {
        return ['uploads' => 'rename'];
    }
    
    /**
     * Request-Handler
     * @return boolean
     */
    public function request()
    {
        $this->newFileName = $this->getRequestVar('newName');
        $this->fileName = $this->getRequestVar('oldName', [
            \fpcm\classes\http::FILTER_BASE64DECODE
        ]);

        if (!$this->newFileName || !$this->fileName) {
            $this->returnData['code'] = -1;
            $this->returnData['message'] = $this->lang->translate('DELETE_FAILED_RENAME', [
                '{{filename1}}' => $this->fileName,
                '{{filename2}}' => $this->newFileName
            ]);

            $this->getSimpleResponse();
        }

        return true;
    }

    /**
     * Controller-Processing
     */
    public function process()
    {
        $image = new \fpcm\model\files\image($this->fileName, false);
        
        $replace = ['{{filename1}}' => $this->fileName, '{{filename2}}' => $this->newFileName];
        if ($image->rename($this->newFileName, $this->session->getUserId())) {

            (new \fpcm\model\files\imagelist())->createFilemanagerThumbs();
            
            $this->returnData['code'] = 1;
            $this->returnData['message'] = $this->lang->translate('DELETE_SUCCESS_RENAME', $replace);
            $this->getSimpleResponse();
        }

        $this->returnData['code'] = 0;
        $this->returnData['message'] = $this->lang->translate('DELETE_FAILED_RENAME', $replace);
        $this->getSimpleResponse();
    }

}

?>