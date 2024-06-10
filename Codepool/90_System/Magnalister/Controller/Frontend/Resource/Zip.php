<?php

MLFilesystem::gi()->loadClass('Magnalister_Controller_Frontend_Resource');

class ML_Magnalister_Controller_Frontend_Resource_Zip{
    public function header($sFile){
        header('Content-type: application/'.  pathinfo($sFile, PATHINFO_EXTENSION));
        return $this;
    }
}