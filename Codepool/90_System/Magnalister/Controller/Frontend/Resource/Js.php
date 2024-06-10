<?php

MLFilesystem::gi()->loadClass('Magnalister_Controller_Frontend_Resource');

class ML_Magnalister_Controller_Frontend_Resource_Js{
    public function header($sFile){
        header('Content-type: application/javascript');
        return $this;
    }
}