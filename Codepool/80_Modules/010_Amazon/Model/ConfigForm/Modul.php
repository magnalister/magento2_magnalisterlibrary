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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Model_ConfigForm_Modul_Abstract');

class ML_Amazon_Model_ConfigForm_Modul extends ML_Modul_Model_ConfigForm_Modul_Abstract {

    public function getConditionValues() {
        return $this->amazonGetPossibleOptions('ConditionTypes');
    }

    public function getCarrierCodeValues($bCalledFromConfigForm = true) {
        $aCarrierCodes = MLModule::gi()->getCarrierCodes();
        if (MLHttp::gi()->isAjax() && $bCalledFromConfigForm) {
            $aFields = MLRequest::gi()->data('field');
            $sAdditional = $aFields['orderstatus.carrier.additional'];
        } else {
            $sAdditional = MLModule::gi()->getConfig('orderstatus.carrier.additional');
        }
        $aAdditional = explode(',', $sAdditional);
        if (!empty($aAdditional)) {
            foreach ($aAdditional as $sValue) {
                if (trim($sValue) != '') {
                    $aCarrierCodes[$sValue] = $sValue;
                }
            }
            if (MLHttp::gi()->isAjax() && $bCalledFromConfigForm) {
                MLModule::gi()->setConfig('orderstatus.carrier.additional', $sAdditional, true);
            }
        }

        return $aCarrierCodes;
    }

    public function getShippingLocationValues() {
        return $this->amazonGetPossibleOptions('ShippingLocations');
    }

    /**
     * deprecated , it will be removed after amazon new configuration
     */
    function updateCarrierCodesAjax($args) {
        global $_MagnaSession;

        setDBConfigValue('amazon.orderstatus.carrier.additional', $_MagnaSession['mpID'], $args['value']);

        $carrierCodes = $this->loadCarrierCodes();
        $setting = getDBConfigValue(
            'amazon.orderstatus.carrier.default',
            $_MagnaSession['mpID']
        );

        $ret = '';
        foreach ($carrierCodes as $val) {
            $ret .= '<option '.(($val == $setting) ? 'selected="selected"' : '').' value="'.$val.'">'.$val.'</option>'."\n";
        }
        return $ret;
    }


    private function loadCarrierCodes($mpID = false) {
        $aPost = MLRequest::gi()->data();
        if ($mpID === false) {
            global $_MagnaSession;
            $mpID = $_MagnaSession['mpID'];
        }
        $carrier = $this->amazonGetPossibleOptions('CarrierCodes', $mpID);

        # Amazon Config Form
        if (array_key_exists('conf', $aPost) && array_key_exists('amazon.orderstatus.carrier.additional', $aPost['conf'])) {
            setDBConfigValue(
                'amazon.orderstatus.carrier.additional',
                $mpID,
                $aPost['conf']['amazon.orderstatus.carrier.additional']
            );
        }

        $addCarrier = explode(',', getDBConfigValue('amazon.orderstatus.carrier.additional', $mpID, ''));
        if (!empty($addCarrier)) {
            foreach ($addCarrier as $val) {
                $val = trim($val);
                if (empty($val))
                    continue;
                $carrier[$val] = $val;
            }
        }
        $carrierValues = array('null' => MLI18n::gi()->ML_LABEL_CARRIER_NONE);
        if (!empty($carrier)) {
            foreach ($carrier as $val) {
                if ($val == 'Other')
                    continue;
                $carrierValues[$val] = $val;
            }
        }
        return $carrierValues;
    }

    private function amazonGetPossibleOptions($kind, $mpID = false) {
        if ($mpID === false) {
            global $_MagnaSession;
            $mpID = $_MagnaSession['mpID'];
        }

        initArrayIfNecessary($_MagnaSession, array($mpID, $kind));

        if (empty($_MagnaSession[$mpID][$kind])) {
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'Get'.$kind,
                    'SUBSYSTEM' => 'Amazon',
                    'MARKETPLACEID' => $mpID,
                ));
                $_MagnaSession[$mpID][$kind] = $result['DATA'];
            } catch (MagnaException $e) {
            }
        }
        return $_MagnaSession[$mpID][$kind];
    }
}
