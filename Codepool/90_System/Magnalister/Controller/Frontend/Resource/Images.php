<?php

MLFilesystem::gi()->loadClass('Magnalister_Controller_Frontend_Resource');

/**
 * This class sets the appropriate headers for serving any type of images
 * used in the plugin gui.
 */
class ML_Magnalister_Controller_Frontend_Resource_Images {
    
    /**
     * Emit the header based on the file path.
     * @param string $sFile
     * @return self
     */
    public function header($sFile) {
        $ext = strtolower(pathinfo($sFile, PATHINFO_EXTENSION));
        $aAdditionalHeaders = array();
        switch ($ext) {
            case 'svg': {
                // @see: https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Getting_Started#A_Word_on_Webservers
                $mime = 'image/svg+xml';
                $aAdditionalHeaders[] = 'Vary: Accept-Encoding';
                break;
            }
            default: {
                $mime = 'image/'.$ext;
                break;
            }
        }
        
        header('Content-Type: '.$mime);
        foreach ($aAdditionalHeaders as $header) {
            header($header);
        }
        return $this;
    }
    
}
