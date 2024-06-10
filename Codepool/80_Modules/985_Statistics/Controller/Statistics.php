<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Statistics_Controller_Statistics extends ML_Core_Controller_Abstract {
    protected function getReport() {
        foreach ($this->getChildControllersNames() as $sName) {
            $this->getChildController($sName)->render();
        }
    }
}
