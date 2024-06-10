<?php


MLFilesystem::gi()->loadClass('Core_Update_Abstract');

class ML_Amazon_Update_ChangeConfigKey extends ML_Core_Update_Abstract {

    public function execute() {
        $blInit = false; 
        $oDB = MLDatabase::getDbInstance();
        foreach (MLShop::gi()->getMarketplaces() as $iMarketPlace => $sMarketplace) {
           
            if ($oDB->tableExists('magnalister_config')) {
                $oSelectConfig = MLDatabase::factorySelectClass() ;
                $aConfigs = $oSelectConfig->from('magnalister_config')->where("mkey = 'shippingservice.deliveryexpirience'")->getResult();
                if(
                    !empty($aConfigs)
                ){
                    foreach ($aConfigs as $aConfig){
                        $oDB->insert('magnalister_config', array('mpid'=>$aConfig['mpID'], 'mkey'=>'shippingservice.deliveryexperience', 'value'=>$aConfig['value']));

                        $oSelectConfig->delete('magnalister_config')->doDelete();
                    }
                }
            }
        }
        return parent::execute();
    }

}