<?php

MLFilesystem::gi()->loadClass('Sync_Controller_Frontend_Do_ImportOrders');

class ML_Sync_Controller_Frontend_Do_UpdateOrders extends ML_Sync_Controller_Frontend_Do_ImportOrders {

    protected function getService(){
        return MLService::getUpdateOrdersInstance();
    }
}