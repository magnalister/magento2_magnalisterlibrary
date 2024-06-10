<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Database_Controller_Do_Table extends ML_Core_Controller_Abstract {

    public function renderAjax() {
        $this->execute();
    }

    public function render() {
        $this->execute();
    }

    protected function execute() {
        try {
            $oRequest = MLRequest::gi();
            $oTable = MLDatabase::factory($oRequest->get('table'));
            $blList=false;
            foreach ($oRequest->get('keys') as $sKey => $sValue) {
                if(is_numeric($sKey)){//if key is numeric => value is array
                    $blList=true;
                }else{
                    $oTable->set($sKey, $sValue);
                }
            }
            if($blList===true){
                $oList=$oTable->getList();
                $oList->getQueryObject()->where('1=0');
                foreach ($oRequest->get('keys') as $sKey => $mValue) {
                    if(is_numeric($sKey)){// adding each mvalue array as new table to list
                        $oCurrentTable=clone $oTable;
                        foreach($mValue as $sListKey=>$sListValue){
                            $oCurrentTable->set($sListKey,$sListValue);
                        }
                        $oList->add($oCurrentTable->data());
                    }
                }
                $oAction=$oList;
            }else{
                $oAction=$oTable;
            }
            switch ($oRequest->get('command')) {
                case 'data': {
                    echo json_encode(array('success' => true, 'result' => $oAction->load()->data()));
                    break;
                }
                case 'edit': {
                    try {
                        foreach ($oRequest->get('data') as $sKey => $sValue) {
                            $oAction->set($sKey, $sValue);
                        }
                    } catch (Exception $oEx) {
                        
                    }
                    $oAction->save();
                    echo json_encode(array('success' => true));
                    break;
                }
                case 'delete': {
                    $oAction->delete();
                    echo json_encode(array('success' => true));
                    break;
                }
            }
        } catch (Exception $oEx) {
            echo json_encode(array('success' => false, 'error' => $oEx->getMessage()));
        }
    }

}