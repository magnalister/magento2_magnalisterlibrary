<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Statistics_Controller_Statistics_Percent extends ML_Core_Controller_Abstract {

    protected function getOrderPercentChartHtml() {
        return ML::gi()->instance('model_report')->showChart("percent");
    }
}
