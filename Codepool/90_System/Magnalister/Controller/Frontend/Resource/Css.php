<?php

MLFilesystem::gi()->loadClass('Magnalister_Controller_Frontend_Resource');

class ML_Magnalister_Controller_Frontend_Resource_Css{
    public function header($sFile){
        header('Content-type: text/css');
        return $this;
    }
}