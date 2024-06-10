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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
class ML_Ebay_Helper_Model_Form_Type_SellerProfiles {
    
    protected $aSellerProfiles = null;
    
    /**
     * merge api seller profiles and contents
     * @param string $sProfileType 
     * @return array
     * @throws Exception no prifiles
     */
    protected function getSellerProfiles ($sProfileType, $blForceRefresh=false) {
        $sProfileType = strtolower($sProfileType);
        if ($this->aSellerProfiles === null) {
            $this->aSellerProfiles = array();
            try {
                if ($blForceRefresh) {
                	$aProfiles = MagnaConnector::gi()->submitRequest(array(
                            'ACTION' => 'GetSellerProfiles',
                        ));
                } else {
                	$aProfiles = MagnaConnector::gi()->submitRequestCached(array(
	                    'ACTION' => 'GetSellerProfiles',
	                ), 30 * 60);
                }
                if ($aProfiles['STATUS'] == 'SUCCESS' && isset($aProfiles['DATA']['Profiles']) && is_array($aProfiles['DATA']['Profiles'])) {
                    foreach ($aProfiles['DATA']['Profiles'] as $iProfile => $aProfile) {
                        $aProfile['ProfileType'] = $aProfile['ProfileType'] == 'RETURN_POLICY' ? 'return' : $aProfile['ProfileType'];
                        $this->aSellerProfiles[strtolower($aProfile['ProfileType'])][$iProfile] = array(
                            'name' => $aProfile['ProfileName'],
                            'default' => $aProfile['IsDefault'] && $aProfile['IsDefault'] != 'false'
                        );
                    }
                }
                try {
                    if ($blForceRefresh) {
                	$aProfilesContents = MagnaConnector::gi()->submitRequest(array(
                            'ACTION' => 'GetSellerProfileContents',
                        ));
                    } else {
                        $aProfilesContents = MagnaConnector::gi()->submitRequestCached(array(
                            'ACTION' => 'GetSellerProfileContents',
                        ), 30 * 60);
                    }
                    if ($aProfilesContents['STATUS'] == 'SUCCESS' && isset($aProfilesContents['DATA']) && is_array($aProfiles['DATA'])) {
                        foreach ($aProfilesContents['DATA'] as $sProfileContent => $aProfileContent) {
                            $sProfileContent = strtolower($sProfileContent);
                            if (array_key_exists($sProfileContent, $this->aSellerProfiles)) {
                                foreach ($aProfileContent as $iProfile => $aProfile) {
                                    if (array_key_exists($iProfile, $this->aSellerProfiles[$sProfileContent])) {
                                        switch ($sProfileContent) {
                                            case 'payment': {
                                                $this->aSellerProfiles['payment'][$iProfile]['contents'] = array(
                                                    'paymentmethods' => array_key_exists('paymentmethod', $aProfile) ? $aProfile['paymentmethod'] : array(),
                                                    'paypal.address' => array_key_exists('paypal.address', $aProfile) ? $aProfile['paypal.address'] : '',
                                                    'paymentinstructions' => array_key_exists('paymentinstructions', $aProfile) ? $aProfile['paymentinstructions'] : '',
                                                );
                                                break;
                                            }
                                            case 'shipping': {
                                                $this->aSellerProfiles['shipping'][$iProfile]['contents'] = array(
                                                    'dispatchtimemax' => (int)(array_key_exists('DispatchTimeMax', $aProfile) ? $aProfile['DispatchTimeMax'] : 0),
                                                    'shippinglocalprofile' => (int)(array_key_exists('shippingprofile.local', $aProfile) ? $aProfile['shippingprofile.local'] : 0),
                                                    'shippinginternationalprofile' => (int)(array_key_exists('shippingprofile.international', $aProfile) ? $aProfile['shippingprofile.international'] : 0),
                                                    'shippinglocaldiscount' => (bool)(array_key_exists('shippingdiscount.local', $aProfile) ? current(json_decode($aProfile['shippingdiscount.local'], true)) : 0),
                                                    'shippinginternationaldiscount' => (bool)(array_key_exists('shippingdiscount.international', $aProfile) ? current(json_decode($aProfile['shippingdiscount.international'], true)) : 0),
                                                );
                                                foreach (array('shipping.local' => 'shippinglocal', 'shipping.international' => 'shippinginternational') as $sShippingDirectionApi => $sShippingDirectionPlugin) {
                                                    foreach (array_key_exists($sShippingDirectionApi, $aProfile) && !empty($aProfile[$sShippingDirectionApi]) ? $aProfile[$sShippingDirectionApi] : array(array()) as $aShipping) {
                                                        $aShippment = array(
                                                            'ShippingService' => array_key_exists('service', $aShipping) ? $aShipping['service'] : '',
                                                            'ShippingServiceCost' => array_key_exists('service', $aShipping) ? $aShipping['cost'] : 0,
                                                        );
                                                        if ($sShippingDirectionPlugin == 'shippinginternational') {
                                                            $aShippment['ShipToLocation'] = array_key_exists('location', $aShipping) ? $aShipping['location'] : array();
                                                        }
                                                        $this->aSellerProfiles['shipping'][$iProfile]['contents'][$sShippingDirectionPlugin][] = $aShippment;
                                                    }
                                                }
                                                break;
                                            }
                                            case 'return': {
                                                $this->aSellerProfiles['return'][$iProfile]['contents'] = array(
                                                    'returnpolicy.returnsaccepted' => array_key_exists('returnsaccepted', $aProfile) ? $aProfile['returnsaccepted'] : '',
                                                    'returnpolicy.returnswithin' => array_key_exists('returnswithin', $aProfile) ? $aProfile['returnswithin'] : '',
                                                    'returnpolicy.shippingcostpaidby' => array_key_exists('shippingcostpaidby', $aProfile) ? $aProfile['shippingcostpaidby'] : '',
                                                    'returnpolicy.description' => array_key_exists('description', $aProfile) ? $aProfile['description'] : '',
                                                );
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $this->aSellerProfiles = array();
                    }
                    foreach ($this->aSellerProfiles as $sProfile => $aProfile) {
                        foreach (array_keys($aProfile) as $iProfile) {
                            if (!array_key_exists('contents', $this->aSellerProfiles[$sProfile][$iProfile])) {
                                unset($this->aSellerProfiles[$sProfile][$iProfile]);
                            }
                        }
                    }
                } catch(MagnaException $e) {
                    $this->aSellerProfiles = array();
                }
            } catch (MagnaException $e) {
            }
        }
        if (empty($this->aSellerProfiles)) {
            throw new Exception('No seller profiles.', 1470300945);
        } else {
            return array_key_exists($sProfileType, $this->aSellerProfiles) ? $this->aSellerProfiles[$sProfileType] : array();
        }
    }
    
    public function hasSellerProfiles ($blForceRefresh=false) {
        try {
            $this->getSellerProfiles('', $blForceRefresh);
            return true;
        } catch (Exception $oEx) {
            return false;
        }
    }
    
    /**
     * Manipulates seller-profile fields. If there is no profile, it will be deactivated
     * @param array $aField
     * @param string $sApiField
     */
    public function sellerProfileField (&$aField, $sApiField, $blForceRefresh=false) {
        try {
            $aProfiles = $this->getSellerProfiles($sApiField, $blForceRefresh);
            $aField['values'] = array();
            foreach ($aProfiles as $sKey => $aValue) {
                $aField['values'][$sKey] = (MLSetting::gi()->get('blDebug') ? '('.$sKey.') ' : '').$aValue['name']; //@todo no key
                if ($aValue['default']) {
                    $aField['values'][$sKey] .= ' ('.MLI18n::gi()->get('sEbayDefaultValueText').')';
                    if (empty($aField['value'])) {
                        $aField['value'] = $sKey;
                    }
                }
            }
            if (MLSetting::gi()->get('blDebug') && array_key_exists('i18n', $aField)) {
                $aField['i18n']['hint'] = (isset($aField['i18n']['hint']) ? $aField['i18n']['hint'] : '');
                ob_start();
                new dBug($aProfiles, '', true);
                $aField['i18n']['hint'] .= '<div style="position:absolute;">'.ob_get_clean().'</div>';
            }
        } catch (Exception $oEx) {
            unset($aField['type']);//dont display;
        }
    }
    
    public function manipulateFieldForSellerProfile(&$aField, $aControllerField, $sApiType, $blForceRefresh=false) {
        $sApiField = strtolower($aField['realname']);
        try {
            $aProfiles = MLHelper::gi('model_form_type_sellerprofiles')->getSellerProfiles($sApiType, $blForceRefresh);
            if (array_key_exists('optional', $aField)) {
                $aField['type'] = isset($aField['optional']['field']) ? $aField['optional']['field']['type']:null;
                unset($aField['optional']);
            }
            $aField['autooptional'] = false;
            if (!MLHttp::gi()->isAjax() && array_key_exists('type', $aField)) {
                $aField['ajax'] = array(
                    'selector' => '#' . (isset($aControllerField['id']) ? $aControllerField['id'] : null),
                    'trigger' => 'change',
                    'field' => array('type' => $aField['type'])
                );
                $aField['type'] = 'ajax';
            }
            $aField['classes'] = array('ml-js-not-editable');
            if (isset($aProfiles[$aControllerField['value']]) && array_key_exists($sApiField, $aProfiles[$aControllerField['value']]['contents'])) {
                $aField['value'] = $aProfiles[$aControllerField['value']]['contents'][$sApiField];
            }
            if (array_key_exists('i18n', $aField)) {
                $aField['i18n']['help'] = 
                    (isset($aField['i18n']['help']) && !empty($aField['i18n']['help']) ? '<span style="opacity:.8">'.$aField['i18n']['help'].'</span><br /><br />' : '')
                    .(isset($aControllerField['i18n']['help_subfields']) ? $aControllerField['i18n']['help_subfields'] : '')
                ;
            }
            return true;
        } catch (Exception $oEx) {
            return false;
        }
    }
    
    public function manipulateShippingFieldForSellerProfile(&$aField, $aControllerField, $blForceRefresh=false) {
        try {
            $aProfile = MLHelper::gi('model_form_type_sellerprofiles')->getSellerProfiles('shipping', $blForceRefresh);
            $aField['value'] = array();
            if(isset($aProfiles[$aControllerField['value']])) {
                $aField['value'] = $aProfile[$aControllerField['value']]['contents'][$aField['realname']];
            }
            foreach ($aField['value'] as $aValue) {
                if (array_key_exists('values', $aField) && !array_key_exists($aValue['ShippingService'], $aField['values'])) {
                    $aField['values'][$aValue['ShippingService']] = '';
                }
            }
            return true;
        } catch (Exception $oEx) {
            return false;
        }
    }
    
    public function manipulateShippingProfileFieldForSellerProfile(&$aField, $aControllerField, $blForceRefresh=false) {
        try {
            $aProfile = MLHelper::gi('model_form_type_sellerprofiles')->getSellerProfiles('shipping', $blForceRefresh);
            if (array_key_exists('optional', $aField)) {
                $aField['type'] = isset($aField['optional']['field']) ? $aField['optional']['field']['type'] : null;
                unset($aField['optional']);
                $aField['autooptional'] = false;
            }
            //            $aField['type'] = 'select';
            if (!empty($aProfile[$aControllerField['value']]['contents'][$aField['realname']])) {
                $aField['value'] = $aProfile[$aControllerField['value']]['contents'][$aField['realname']];
            }
            if (empty($aField['value']) && array_key_exists('values', $aField)) {
                $aField['values'][$aField['value']] = $aField['i18n']['optional']['select']['false'];
            }
            return true;
        } catch (Exception $oEx) {
            return false;
        }
    }
    
}
