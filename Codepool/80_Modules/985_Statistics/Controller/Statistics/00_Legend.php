<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Statistics_Controller_Statistics_Legend extends ML_Core_Controller_Abstract {

    protected function getOrderChartHtml() {
        return ML::gi()->instance('model_report')->showLegend();
    }

}
