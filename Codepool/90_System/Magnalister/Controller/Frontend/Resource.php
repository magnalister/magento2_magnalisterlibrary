<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

/**
 * Frontend controller to serve any kind of static resource such as images, javascript, css, etc.
 */
class ML_Magnalister_Controller_Frontend_Resource extends ML_Core_Controller_Abstract {
    protected $sFolder;
    
    /**
     * "Renders" the static resource. It fetches the resource based on the request and
     * sets the headers and echoes the resource back to the client.
     * @return void
     */
    public function render() {
        $sType = $this->sFolder;
        //strtolower(substr(get_class($this), strlen(__class__) + 1, strlen(get_class($this))));
        $aRequest = $this->getRequest();
        $aServer = MLHttp::gi()->getServerRequest();
        $sFileName = substr($aServer['REQUEST_URI'], strpos($aServer['REQUEST_URI'], $sType) + strlen($sType) + 1);
        $iPos = strpos($sFileName, '?');
        $sFileName = $iPos ? substr($sFileName, 0, $iPos) : $sFileName;
        $sFileName = (substr($sFileName, -1) == '/') ? substr($sFileName, 0, -1) : $sFileName;
        
        if ($sType == 'writable') {
            $sFile = MLFilesystem::getWritablePath($sFileName);
        } else {
            $aFile = MLFilesystem::gi()->findResource($sType . '_' . $sFileName);
            $sFile = $aFile['path']; //
        }
        
        if (file_exists($sFile)) {
            $file = $line = null;
            // Clear any additional output buffering levels except the default top one.
            // Sometimes other plugins may add an additional level which prevents setting headers
            // for example the Content-Type.
            if (!headers_sent($file, $line)) {
                while (ob_get_level() > 1) {
                    ob_end_clean();
                }
            }
            if (function_exists('header_remove')) {
                header_remove(); //(PHP 5 >= 5.3.0)
            }
            $iExpires = 60 * 60 * 12 * 1; //12h
            header("Pragma: public");
            header("Cache-Control: maxage=" . $iExpires);
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $iExpires) . ' GMT');
            $sExtension = pathinfo($sFile, PATHINFO_EXTENSION);
            if (in_array($sExtension, array('css', 'js'))) {
                $sFileType = $sExtension;
            } elseif (in_array($sExtension, array('html', 'htm'))) {
                $sFileType = 'html';
            } elseif (in_array($sExtension, array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'))) {
                $sFileType = 'images';
            } elseif (in_array($sExtension, array('zip', 'gz'))) {
                $sFileType = 'zip';
            }
            if (isset($sFileType)) {
                MLController::gi('frontend_resource_' . $sFileType)->header($sFile);
            } else {
                // fallback
                header('Content-Type: application/octet-stream');
            }
            @readfile($sFile);
        }
        exit;
    }
    
    /**
     * Set the folder in which the static resources are stored.
     * @param string $sFolder
     * @return self
     */
    public function setFolder($sFolder) {
        $this->sFolder = strtolower($sFolder);
        return $this;
    }
    
}
