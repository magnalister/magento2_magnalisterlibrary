<?php
/*
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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Otto_Controller_Otto_Config_Order extends ML_Form_Controller_Widget_Form_ConfigAbstract {
    public static function getTabTitle() {
        return MLI18n::gi()->get('otto_config_account_orderimport');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function __construct() {
        foreach (array('SyncOrderStatus', 'SyncInventory', 'ImportOrders') as $sSync) {
            try {
                MLSetting::gi()->get('s'.$sSync.'Url');
            } catch (Exception $ex) {
                MLSetting::gi()->{'s'.$sSync.'Url'} = MLHttp::gi()->getFrontendDoUrl(array('do' => $sSync, 'auth' => md5(MLShop::gi()->getShopId().trim(MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value')))));
            }

        }
        parent::__construct();
    }

    /**
     * Remove matching values for carriers when dropdown isn't set on matching value
     *
     * @param $baseName
     * @param $aFields
     */
    private function removeMatchingFiled($baseName, $aFields) {
        $selectKey = $baseName.'.select';
        $matchingKey = $baseName.'.matching';
        $matchingValue = $aFields[$baseName]['subfields']['select']['matching'];
        if (isset($this->aRequestFields[$selectKey]) && $this->aRequestFields[$selectKey] !== $matchingValue) {
            $this->aRequestFields[$matchingKey] = array('');
        }
    }

    public function saveAction($blExecute = true) {
        if ($blExecute) {
            $aModules = MLSetting::gi()->get('aModules');
            $aAuthKeyDefinition = $aModules[MLModul::gi()->getMarketPlaceName()]['authKeys'];
            foreach ($this->getFormArray('aForm') as $aLegend) {
                foreach ($aLegend['fields'] as $aField) {
                    $aFields[$aField['name']] = $aField;
                }
            }
            $aAuthKeys = array();
            $blAuthKeysChanged = false;
            $blAuthed = MLModul::gi()->isAuthed();
            $this->removeMatchingFiled('orderstatus.returncarrier', $aFields);
            $this->removeMatchingFiled('orderstatus.sendcarrier', $aFields);
            $this->removeMatchingFiled('orderstatus.forwardercarrier', $aFields);

            foreach ($this->aRequestFields as $sName => $mValue) {
                if ($sName == 'tabident') {
                    $aIdents = MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.tabident')->get('value');
                    $aIdents = is_array($aIdents) ? $aIdents : array();
                    $aIdents[MLModul::gi()->getMarketPlaceId()] = $mValue;
                    $aIdents = MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.tabident')->set('value', $aIdents)->save();
                } else {
                    if (array_key_exists($sName, $aAuthKeyDefinition)) {
                        MLModul::gi()->resetIsAuthedErrorCaches();
                        $mValue = trim($mValue);
                        $sSavedAuthValue = MLModul::gi()->getConfig($sName); //MLDatabase::factory('config')->set('mpId', MLModul::gi()->getMarketPlaceId())->set('mkey', $sName)->get('value');
                        if (
                            !empty($mValue)
                            && ($sSavedAuthValue != $mValue || !$blAuthed)
                        ) {
                            $blAuthKeysChanged = true;
                            $aAuthKeys[$aAuthKeyDefinition[$sName]] = $mValue;
                        } elseif (isset($aFields[$sName]['savevalue'])) {
                            $aAuthKeys[$aAuthKeyDefinition[$sName]] = $aFields[$sName]['savevalue'];
                        } else {
                            $aAuthKeys[$aAuthKeyDefinition[$sName]] = $sSavedAuthValue;
                        }
                    }
                    if (isset($aFields[$sName]['savevalue'])) {
                        $mValue = $aFields[$sName]['savevalue'];
                    }
                    if (array_key_exists($sName, $this->aPrepareDefaultsActive)) {
                        $this->aPrepareDefaultsActive[$sName] = $this->optionalIsActive(array('realname' => $sName));
                    }
                    if (array_key_exists($sName, $this->aPrepareDefaults)) {
                        $this->aPrepareDefaults[$sName] = $this->getField($sName, 'value');
                    } else {
                        MLModul::gi()->setConfig($sName, $this->getField($sName, 'value'));
                        //MLDatabase::factory('config')->set('mpId', MLModul::gi()->getMarketPlaceId())->set('mkey', $sName)->set('value', $this->getField($sName, 'value'))->save();
                    }
                }
            }
            MLModul::gi()->sendConfigToApi();
            MLDatabase::factory('preparedefaults')
                ->set('mpId', MLModul::gi()->getMarketPlaceId())
                ->set('name', 'defaultconfig')
                ->set('values', $this->aPrepareDefaults)
                ->set('active', $this->aPrepareDefaultsActive)
                ->save()
            ;
            if ($blAuthKeysChanged) {
                $this->isAuthed($aAuthKeys);
            }
            if (MLModul::gi()->isAuthed() && $this->isWizard()) {// redirect to next form
                $sNextController = $this->getNextController();
                if (!empty($sNextController)) {
                    MLHttp::gi()->redirect($this->getUrl(array(
                        'controller' => substr($this->getRequest('controller'), 0, strrpos($this->getRequest('controller'), '_')).'_'.$sNextController,
                        'wizard' => 'true'
                    )));
                } else {
                    $aController = explode('_', MLRequest::gi()->get('controller'));
                    MLHttp::gi()->redirect($this->getUrl(array(
                        'controller' => current($aController)
                    )));
                }
            }
            $this->aFields = array();
            if (MLShop::gi()->isCurrencyMatchingNeeded() && isset($this->aRequestFields['currency'])) {
                MLModul::gi()->setConfig('exchangerate_update', '0');
            }
            return $this;
        } else {
            $translationKey = 'form_action_save';
            if ($this->isWizard()) {
                $sNextController = $this->getNextController(true);
                if ($sNextController == '') {
                    $sForward = MLI18n::gi()->get('form_action_finish_wizard_save');
                    $translationKey = 'form_action_finish_wizard_save';
                } else {
                    $sForwardI18n = MLFilesystem::gi()->callStatic('controller_'.$sNextController, 'getTabTitle');
                    $sForward = sprintf(MLI18n::gi()->get('form_action_wizard_save'), $sForwardI18n);
                    $translationKey = 'form_action_wizard_save';
                }
            } else {
                $sForward = MLI18n::gi()->get('form_action_save');
            }

            return array(
                'aI18n' => array('label' => $sForward),
                'aForm' => array(
                    'type' => 'submit',
                    'position' => 'right',
                    'translation_key' => $translationKey,
                    'fieldposition' => array('after'=> 1)//keep save button at the right side and reset button before that
                )
            );
        }
    }

}
