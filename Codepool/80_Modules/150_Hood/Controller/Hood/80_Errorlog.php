<?php
/**
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('ErrorLog_Controller_Widget_ErrorLog_Abstract');

class ML_Hood_Controller_Hood_Errorlog extends ML_ErrorLog_Controller_Widget_ErrorLog_Abstract {

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_ERRORLOG');
    }

    public static function getTabActive() {
        return MLModul::gi()->isConfigured();
    }

    protected function processErrorAdditonalData(&$item) {
        $item['ErrorData'] =
            (is_array($item['ErrorData']) ? $item['ErrorData'] : array())
            +
            array('origin' => isset($item['Origin']) ? $item['Origin'] : '');
    }

    public function getFields() {
        return array(
            'SKU' => array(
                'Label' => $this->__('ML_AMAZON_LABEL_ADDITIONAL_DATA'),
                'Sorter' => 'products_model',
                'Field' => 'SKU',
            ),
            'ErrorMessage' => array(
                'Label' => $this->__('ML_GENERIC_ERROR_MESSAGES'),
                'Sorter' => 'errormessage',
                'Field' => 'errormessage',
            ),
            'Origin' => array(
                'Label' => $this->__('ML_GENERIC_LABEL_ORIGIN'),
                'Field' => 'Origin',
            ),
            'DateAdded' => array(
                'Label' => $this->__('ML_LABEL_CHANGELOG_DATE'),
                'Sorter' => 'dateadded',
                'Field' => 'dateadded',
            ),
        );
    }

    public function render() {
        $this->getErrorLogWidget();
        return $this;
    }

    public function getOrigin($oErrorlog) {
        $aData = $oErrorlog->get('data');
        echo isset($aData['origin']) ? $aData['origin'] : '';
    }
}
