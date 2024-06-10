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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_Abstract');

abstract class ML_Form_Controller_Widget_Form_ConfigAbstract extends ML_Form_Controller_Widget_Form_Abstract {

    protected $aParameters = array('controller');

    protected $blExpert = false;
    protected $blHaveExpert = null;
    protected $sActionTemplate = 'action-row-row-row';
//    protected $blValidateAuthKeys = true;

    public function __construct() {
        /*
         * sSyncOrderStatusUrl, sSyncInventoryUrl, sImportOrdersUrl
         */
        foreach (array('SyncOrderStatus', 'SyncInventory', 'ImportOrders') as $sSync) {
            // Helper for php8 compatibility - can't pass null to trim 
            $sPassphrase = MLHelper::gi('php8compatibility')->checkNull(MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value'));
            MLSetting::gi()->set('s'.$sSync.'Url', MLHttp::gi()->getFrontendDoUrl(array('do' => $sSync, 'auth' => md5(MLShop::gi()->getShopId().trim($sPassphrase)))), true);
        }
        parent::__construct();
    }
    /** @var ML_Form_Helper_Model_Table_ConfigData_Abstract */
    protected $oConfigHelper = null;


    /**
     * default-data for prepare mask
     * @var array
     */
    protected $aPrepareDefaults = array();

    protected $aPrepareDefaultsActive = array();

    protected static function addMissingConfKeyError($sClass, $aErrorField) {
        $aFormArray = MLController::gi($sClass)->getNormalizedFormArray();
        foreach ($aFormArray as $aFieldSet) {
            $sLegend = self::getLegendOfFieldSet($aFieldSet);
            foreach ($aFieldSet['fields'] as $aField) {
                if ((isset($aField['realname']) ? $aField['realname'] :'') == $aErrorField['name']) {
                    MLMessage::gi()->addError(
                        MLModule::gi()->getMarketPlaceName(false).'('.MLModule::gi()->getMarketPlaceId().') '.sprintf(
                            MLI18n::gi()->ML_CONFIG_FIELD_EMPTY_OR_MISSING,
                            $sLegend.$aField['i18n']['label']
                        )
                    );
                } elseif (array_key_exists('subfields', $aField)) {
                    foreach ($aField['subfields'] as $aSubfield) {
                        if ($aSubfield['realname'] == $aErrorField['name']) {
                            MLMessage::gi()->addError(
                                MLModule::gi()->getMarketPlaceName(false).'('.MLModule::gi()->getMarketPlaceId().') '.sprintf(
                                    MLI18n::gi()->ML_CONFIG_FIELD_EMPTY_OR_MISSING,
                                    $sLegend.$aField['i18n']['label']
                                )
                            );
                        }
                    }
                }
            }
        }

    }

    /**
     * calculates if * config tab is active tab depending on wizard
     * @param string $sClassName
     * @param bool $blDefault
     * @return bool
     * @throws Exception
     */
    protected static function calcConfigTabActive($sClassName, $blDefault) {
        $sController = MLRequest::gi()->cleanMarketplaceId('controller');
        $sClass = strtolower(preg_replace('/^(.*_.*_.*_).*/U', '', $sClassName));
        if (!MLModule::gi()->isAuthed()) {
            if (strpos($sClass, '_config_account') === false) {
                return false;
            } else {
                return true;
            }
        }
        if (!MLRequest::gi()->data('wizard')) {
                if (!MLModule::gi()->isConfigured()) {
                    $aSettings = MLSetting::gi()->get('aModules');
                    $isAuthenticated = MLModule::gi()->isAuthed();
                    $aRequiredConfigKey = ($isAuthenticated ? $aSettings[MLModule::gi()->getMarketPlaceName()]['requiredConfigKeys'] : array());
                    $aRequiredConfigKey = array_merge(
                        array_keys(self::getAuthKeys($aSettings)),
                        $aRequiredConfigKey,
                        MLModule::gi()->getListOfConfigurationKeysNeedShopValidation()
                    );
                    $aRequiredConfigKey = MLModule::gi()->addRequiredConfigurationKeys($aRequiredConfigKey);
                    $aFoundMissingField = null;
                foreach (array_unique($aRequiredConfigKey) as $sMissingConfKey) {
                    $mConfigValue = MLModule::gi()->getConfigAndDefaultConfig($sMissingConfKey);
                    if (self::isValidated($mConfigValue, $sMissingConfKey)) {
                        continue;
                    }
                    $aFoundMissingField = null;
                    foreach (ML::gi()->getChildClassesNames('controller_'.substr($sClass, 0, strrpos($sClass, '_')), false) as $sConfTab) {
                        try {
                            try {
                                $aConfForm = MLSetting::gi()->get(MLModule::gi()->getMarketPlaceName().'_config_'.$sConfTab);
                            } catch (Exception $ex) {
                                $aConfForm = MLSetting::gi()->get('generic_config_'.$sConfTab);
                            }
                            MLFormHelper::getShopInstance()->manipulateForm($aConfForm);
                            foreach ($aConfForm as $aFormPart) {
                                $aFormPart['fields'] = array_key_exists('fields', $aFormPart) ? $aFormPart['fields'] : array();
                                // go through the tabs until the missing key is found
                                foreach ($aFormPart['fields'] as $aField) {
                                    if (
                                        $aField['name'] == $sMissingConfKey
                                        && $sClass == substr($sClass, 0, strrpos($sClass, '_')).'_'.$sConfTab
                                    ) {
                                        if ($sClass === $sController) {
                                            self::addMissingConfKeyError($sClass, $aField);
                                        }
                                        $aFoundMissingField = true;
                                    } elseif (
                                        isset($aField['subfields'])
                                        && is_array($aField['subfields'])
                                    ) {
                                        // we can also have required subfields
                                        foreach ($aField['subfields'] as $sSubfield) {
                                            if (is_array($sSubfield) && isset($sSubfield['name'])) {
                                                if (
                                                    $sSubfield['name'] == $sMissingConfKey
                                                    && $sClass == substr($sClass, 0, strrpos($sClass, '_')).'_'.$sConfTab
                                                ) {
                                                    if ($sClass === $sController) {
                                                        self::addMissingConfKeyError($sClass, $aField);
                                                    }
                                                    $aFoundMissingField = true;
                                                } else if ($sSubfield['name'] == $sMissingConfKey) {
                                                    $aFoundMissingField = false;
                                                }
                                            }
                                        }
                                    } elseif ($aField['name'] == $sMissingConfKey) {
                                        $aFoundMissingField = false;
                                    }
                                }
                            }
                        } catch (Exception $oEx) {
                            MLMessage::gi()->addDebug($oEx);
                        }
                    }

                }
                if ($aFoundMissingField !== null) {
                    return $aFoundMissingField;
                }
            }
        }
        if ($blDefault) {
            return
                (
                       MLRequest::gi()->data('wizard')
                    && $sClass != $sController
                    && substr_count($sController, '_') >= substr_count($sClass, '_')
                )
                    ? false
                    : true;
        } else {
            return
                (
                    MLRequest::gi()->data('wizard')
                    && $sClass !== $sController
                )
                    ? false
                    : MLModule::gi()->isAuthed();
        }
    }

    protected static function getLegendOfFieldSet($aFieldSet) {
        $sLegend = '';
        if (
            isset($aFieldSet['legend']) &&
            isset($aFieldSet['legend']['i18n']) &&
            !empty($aFieldSet['legend']['i18n'])
        ) {
            $sLegend =
                (
                is_array($aFieldSet['legend']['i18n'])
                    ? $aFieldSet['legend']['i18n']['title']
                    : $aFieldSet['legend']['i18n']
                ) . ' > ';
        }
        return $sLegend;
    }

    protected static function isValidated($mConfigValue, $sMissingConfKey) {
        $isValidated = MLShop::gi()->isConfiguredKeyValid($sMissingConfKey);
        if ($isValidated === null) {
            return $mConfigValue !== null && $mConfigValue !== '';
        }
        return $isValidated;
    }

    /**
     * check if expert-setting ar active
     * @return bool
     */
    public function isExpert() {
        return $this->blExpert;
    }

    protected function haveExpertFields() {
        if ($this->blHaveExpert === null) {
            foreach (MLSetting::gi()->get($this->getIdent()) as $aGroup) {
                foreach ($aGroup['fields'] as $aField) {
                    if (array_key_exists('expert', $aField) && $aField['expert']) {
                        $this->blHaveExpert = true;
                        break;
                    }
                }
                if ($this->blHaveExpert !== null) {
                    break;
                }
            }
            $this->blHaveExpert = $this->blHaveExpert === null ? false : $this->blHaveExpert;
        }
        return $this->blHaveExpert;
    }

    protected function getField($aField, $sVector = null) {
        $aField = is_array($aField) ? $aField : array('name' => $aField);
        if (isset($aField['expert']) && $aField['expert']) {
            if ($this->isExpert()) {
                $aField['classes'][] = 'mlexpert';
            } else {
                unset($aField['type']);
            }
        }
        try {
            $sName = array_key_exists('realname', $aField) ? $aField['realname'] : $aField['name'];
            $aModules = MLSetting::gi()->get('aModules');
            $aRequiredKeys = isset($aModules[MLModule::gi()->getMarketPlaceName()]) ? $aModules[MLModule::gi()->getMarketPlaceName()]['requiredConfigKeys'] : array();
            $aRequiredKeys = MLModule::gi()->addRequiredConfigurationKeys($aRequiredKeys);
            if (
                in_array($sName, $aRequiredKeys)
                && !MLModule::gi()->isConfigured()
                && !MLRequest::gi()->data('wizard')
            ) {
                $aField['required'] = 'true';
                $aField['cssclasses'][] = 'ml-error';
            }
        } catch (Exception $oEx) {
        }
        return parent::getField($aField, $sVector);
    }

    public function render() {
        $this->getFormWidget();

        if (MLShop::gi()->isCurrencyMatchingNeeded()) {
            $this->renderCurrencyPopup();
        }

        $this->checkSameOrderStatusIsUsedMultipleTimes();
    }

    protected function construct() {
        $this->isAuthed();
        $oPrepareDefaults = MLDatabase::factory('preparedefaults')->set('mpId', MLModule::gi()->getMarketPlaceId())->set('name', 'defaultconfig');
        $aPrepareDefaults = $oPrepareDefaults->get('values');
        $aPrepareDefaults = is_array($aPrepareDefaults) ? $aPrepareDefaults : array();
        $aPrepareDefaultsConfig = MLSetting::gi()->get(strtolower(MLModule::gi()->getMarketPlaceName()) . '_prepareDefaultsFields');
        $aPrepareDefaultsConfig = isset($aPrepareDefaultsConfig) ? $aPrepareDefaultsConfig : array();
        foreach ($aPrepareDefaultsConfig as $sDefaultKey) {
            $this->aPrepareDefaults[$sDefaultKey] = isset($aPrepareDefaults[$sDefaultKey]) ? $aPrepareDefaults[$sDefaultKey] : null;
        }

        $aPrepareDefaultsActive = $oPrepareDefaults->get('active');
        $aPrepareDefaultsActiveConfig = MLSetting::gi()->get(strtolower(MLModule::gi()->getMarketPlaceName()) . '_prepareDefaultsOptionalFields');
        $aPrepareDefaultsActiveConfig= isset($aPrepareDefaultsActiveConfig) ? $aPrepareDefaultsActiveConfig : array();
        foreach ($aPrepareDefaultsActiveConfig as $sDefaultKey) {
            $this->aPrepareDefaultsActive[$sDefaultKey] = isset($aPrepareDefaultsActive[$sDefaultKey]) ? $aPrepareDefaultsActive[$sDefaultKey] : null;
            $this->aRequestOptional[$sDefaultKey] = array_key_exists($sDefaultKey, $this->aRequestOptional) ? $this->aRequestOptional[$sDefaultKey] : $this->aPrepareDefaultsActive[$sDefaultKey];
        }
        $this->oConfigHelper = MLHelper::gi('model_table_' . MLModule::gi()->getMarketPlaceName() . '_configdata');
        $this->oConfigHelper
            ->setIdent($this->getIdent())
            ->setRequestFields($this->aRequestFields)
            ->setRequestOptional($this->aRequestOptional)
        ;

        if (MLI18n::gi()->isTranslationActive()) {
            MLI18n::gi()->addGlobalTranslationData(array(
                'form_text_addon_success',
                'form_text_addon_error',
                'ML_GENERIC_STATUS_LOGIN_SAVED',
                'ML_GENERIC_STATUS_LOGIN_SAVEERROR',
                'ML_GENERIC_TESTMAIL_SENT',
                'ML_GENERIC_TESTMAIL_SENT_FAIL',
            ));
        }
    }

    protected function optionalIsActive($aField) {
        return $this->oConfigHelper->optionalIsActive($aField);
    }

    protected function getFieldMethods($aField) {
        $aMethods = array();
        $aMethods[] = 'getRequestValue'; //request
        $aMethods[] = 'getValue'; //  database
        $aMethods[] = 'getDefaultValue'; //  config
        $aMethods[] = 'prepareAddonField'; // addon field 
        foreach (parent::getFieldMethods($aField) as $sMethod) {
            $aMethods[] = $sMethod;
        }

        $aMethods[] = 'prepareFieldByFormHelper';
        return $aMethods;
    }

    protected function prepareFieldByFormHelper(&$aField) {
        if (isset($aField['realname'])) {
            $sMethod = str_replace('.', '_', $aField['realname'] . 'field');
            if (method_exists($this->oConfigHelper, $sMethod)) {
                $this->oConfigHelper->{$sMethod}($aField);
            }
        }
    }

    public function getRequestValue(&$aField) {
        if (!isset($aField['value'])) {
            if (($mValue = $this->getRequestField($aField['realname'])) !== null) {
                $aField['value'] = $mValue;
            }
        }
    }

    public function getValue(&$aField) {
        if (!isset($aField['value'])) {
            if ($aField['realname'] == 'tabident') {
                $aIdents = MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.tabident')->get('value');
                $aIdents = is_array($aIdents) ? $aIdents : array();
                $aField['value'] = isset($aIdents[MLModule::gi()->getMarketPlaceId()]) ? $aIdents[MLModule::gi()->getMarketPlaceId()] : '';
            } else {
                if (array_key_exists($aField['realname'], $this->aPrepareDefaults)) {
                    $aField['value'] = $this->aPrepareDefaults[$aField['realname']];
                } else {
                    $aField['value'] = MLModule::gi()->getConfig($aField['realname']);//MLDatabase::factory('config')->set('mpId', MLModule::gi()->getMarketPlaceId())->set('mkey', $aField['realname'])->get('value');
                }
            }
        }
    }

    public function getDefaultValue(&$aField) {
        if (!isset($aField['value']) && isset($aField['default'])) {
            $aField['value'] = $aField['default'];
        }
        if (isset($aField['i18n']['values'])) {
            $aField['values'] = $aField['i18n']['values'];
        }
    }

    protected function prepareAddonField(&$aField) {
        if (array_key_exists('type', $aField) && ($aField['type'] == 'addon_bool' || $aField['type'] == 'addon_select')) {
            if (
                array_key_exists('addonsku', $aField)
                && !MLShop::gi()->addonBooked($aField['addonsku'])
            ) {
                try {
                    $aResponse = MagnaConnector::gi()->submitRequest(array(
                        'SKU' => $aField['addonsku'],
                        'SUBSYSTEM' => 'Core',
                        'ACTION' => 'GetAddonInfo',
                    ), true);
                    if (
                        array_key_exists('DATA', $aResponse)
                        && array_key_exists('PluginText', $aResponse['DATA'])
                    ) {
                        $aField['i18n']['alert'] = $aResponse['DATA']['PluginText'];
                        $aField['value'] = false;
                    }
                } catch (Exception $oEx) {// addon cant be booked.
                    MLMessage::gi()->addDebug($oEx);
                    $aField = array();
                }
            } elseif (!array_key_exists('addonsku', $aField)) {
                MLMessage::gi()->addDebug('Field addon have no SKU.');
                $aField = array();
            }
        }
    }

    public function callAjaxAddAddon() {
        $sSku = '';
        try {
            $aAjaxData = $this->getAjaxData();
            if (!array_key_exists('addonsku', $aAjaxData)) {
                throw new Exception('No Addon-Sku setted.');
            }
            $sSku = $aAjaxData['addonsku'];
            MagnaConnector::gi()->submitRequest(array(
                'SUBSYSTEM' => 'Core',
                'ACTION' => 'AddAddon',
                'SKU' => $sSku,
                'CHANGE_TARIFF' => true,
            ));
            MLShop::gi()->getShopInfo(true);// reload addons
            MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('.addon_'.$sSku.'>.ml-addAddonError' => '<div class="successBox">'.MLI18n::gi()->get('form_text_addon_success', array('Sku' => $sSku)).'</div>')));
            MLSetting::gi()->add('aAjax', array('success' => true));
        } catch (Exception $oEx) {
            MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('.addon_'.$sSku.'>.ml-addAddonError' => '<div class="errorBox">'.MLI18n::gi()->get('form_text_addon_error', array('Sku' => $sSku, 'Error' => $oEx->getMessage())).'</div>')));
            throw $oEx;
        }
        return $this;
    }

    protected function isAuthed($aAuthKeys = array()) {
        $aModules = MLSetting::gi()->get('aModules');
        $blForce = false;
        if (count($aAuthKeys)) {
            MLMessage::gi()->addDebug($aAuthKeys);
            $blForce = true;
            try {
                MagnaConnector::gi()->submitRequest(array('ACTION' => 'SetCredentials') + $aAuthKeys);
                if (MLModule::gi()->isAuthed($blForce)) {
                    $blForce = false;
                    MLMessage::gi()->addSuccess(MLI18n::gi()->get('ML_GENERIC_STATUS_LOGIN_SAVED'));
                }
            } catch (MagnaException $oEx) {
                MLMessage::gi()->addDebug($oEx);
                MLMessage::gi()->addError(MLI18n::gi()->get('ML_GENERIC_STATUS_LOGIN_SAVEERROR'), array('md5' => get_class($this).'__auth'));
            }
        }
        return MLModule::gi()->isAuthed($blForce);
    }

    public function expertAction($blExecute = true) {
        if ($blExecute) {
            $this->blExpert = true;
            return $this;
        } else {
            return array(
                'aI18n' => array('label' => MLI18n::gi()->get('form_action_expert')),
                'aForm' => array(
                    'type' => 'submit',
                    'position' => 'left',
                    'disabled' => $this->isExpert() || !$this->haveExpertFields(),
                    'hiddenifdisabled' => true,
                    'translation_key' => 'form_action_expert',
                )
            );
        }
    }

    public function resetAction($blExecute = true) {
        if ($blExecute) {
            return $this;
        } else {
            return array(
                'aI18n' => array('label' => MLI18n::gi()->get('form_action_reset')),
                'aForm' => array('type' => 'reset', 'position' => 'right', 'translation_key' => 'form_action_reset')
            );
        }
    }

    protected function testMailAction($blExecute = true) {
        if ($blExecute) {
            $this->saveAction();
            ML::gi()->init(array('do' => 'importorders'));//activate sync-modul
            $blTestMail = MLService::getImportOrdersInstance()->sendPromotionMailTest();
            ML::gi()->init();
            if ($blTestMail) {
                MLMessage::gi()->addSuccess(MLI18n::gi()->ML_GENERIC_TESTMAIL_SENT);
            } else {
                MLMessage::gi()->addNotice(MLI18n::gi()->ML_GENERIC_TESTMAIL_SENT_FAIL);
            }
            return $this;
        } else {
            return array();
        }
    }

    /**
     * returns true if module is not completely configured
     * @param array $aParams
     */
    protected function isWizard() {
        return ($this->getRequest('wizard') || !MLModule::gi()->isConfigured());
    }

    /**
     * adds wizard to url, if config started first time
     * @param array $aParams
     */
    public function getCurrentUrl($aParams = array()) {
        $sNextController = $this->getNextController();
        if ($this->isWizard()) {
            $aParams['wizard'] = true;
        }
        return parent::getCurrentUrl($aParams);
    }

    /**
     * calculates next controller of current controller, only for wizard
     * @param bool $blLong true for complete controllername, false, only for name of child-part
     * @return string
     */
    protected function getNextController($blLong = false) {
        if (!$this->isWizard()) {
            return '';
        } else {
            $sParentController = substr($this->getIdent(), 0, strrpos($this->getIdent(), '_'));
            $sCurrentController = substr($this->getIdent(), strrpos($this->getIdent(), '_') + 1);
            $sNextController = '';
            $aSiblingControllers = ML::gi()->getChildClassesNames('controller_'.$sParentController, false);
            $blNext = false;
            foreach ($aSiblingControllers as $sSiblingController) {
                if ($blNext) {
                    if ($this->isControllerVisible($sParentController, $sSiblingController)) {
                        $sNextController = $sSiblingController;
                    }
                    break;
                }
                if ($sCurrentController === $sSiblingController && $this->isControllerVisible($sParentController, $sSiblingController)) {
                    $blNext = true;
                }
            }
            if ($blLong && $sNextController != '') {
                $sNextController = $sParentController.'_'.$sNextController;
            }
            return $sNextController;
        }
    }


    private function isControllerVisible($sParentController, $sController) {
        $sControllerClass = MLFilesystem::gi()->loadClass('controller_'.$sParentController.'_'.$sController);
        return !method_exists($sControllerClass, 'getTabVisibility') || $sControllerClass::getTabVisibility();
    }


    public function saveAction($blExecute = true) {
        if ($blExecute) {
            $aModules = MLSetting::gi()->get('aModules');
            $aAuthKeyDefinition = MLModule::gi()->addAuthenticationKeys(self::getAuthKeys($aModules));
            foreach ($this->getFormArray('aForm') as $aLegend) {
                foreach ($aLegend['fields'] as $aField) {
                    $aFields[$aField['name']] = $aField;
                }
            }
            $aAuthKeys = array();
            $blAuthKeysChanged = false;
            $blAuthed = MLModule::gi()->isAuthed();
            $aSecretKeys = array();
            foreach ($this->aRequestFields as $sName => $mValue) {
                if ($sName == 'tabident') {
                    $aIdents = MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.tabident')->get('value');
                    $aIdents = is_array($aIdents) ? $aIdents : array();
                    $aIdents[MLModule::gi()->getMarketPlaceId()] = $mValue;
                    $aIdents = MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.tabident')->set('value', $aIdents)->save();
                } else {
                    if (array_key_exists($sName, $aAuthKeyDefinition)) {
                        MLModule::gi()->resetIsAuthedErrorCaches();
                        $mValue = trim($mValue);
                        $sSavedAuthValue = MLModule::gi()->getConfig($sName); //MLDatabase::factory('config')->set('mpId', MLModule::gi()->getMarketPlaceId())->set('mkey', $sName)->get('value');
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
                        $aSecretKeys[$sName] = $aFields[$sName]['savevalue'];
                    }
                    if (array_key_exists($sName, $this->aPrepareDefaultsActive)) {
                        $this->aPrepareDefaultsActive[$sName] = $this->optionalIsActive(array('realname' => $sName));
                    }
                    if (array_key_exists($sName, $this->aPrepareDefaults)) {
                        $this->aPrepareDefaults[$sName] = $this->getField($sName, 'value');
                    } else {
                        MLModule::gi()->setConfig($sName, $this->getField($sName, 'value'));
                        //MLDatabase::factory('config')->set('mpId', MLModule::gi()->getMarketPlaceId())->set('mkey', $sName)->set('value', $this->getField($sName, 'value'))->save();
                    }
                }
            }
            MLModule::gi()->sendConfigToApi();
            MLDatabase::factory('preparedefaults')
                ->set('mpId', MLModule::gi()->getMarketPlaceId())
                ->set('name', 'defaultconfig')
                ->set('values', $this->aPrepareDefaults)
                ->set('active', $this->aPrepareDefaultsActive)
                ->save();
            if ($blAuthKeysChanged) {
                $this->isAuthed($aAuthKeys);
                foreach ($aSecretKeys as $sName => $sSecretValue) {
                    MLModule::gi()->setConfig($sName, $sSecretValue);
                }
            }
            if (MLModule::gi()->isAuthed() && $this->isWizard()) {// redirect to next form
                $sNextController = $this->getNextController();
                if (!empty($sNextController)) {
                    MLHttp::gi()->redirect($this->getUrl(array(
                        'controller' => substr($this->getRequest('controller'), 0, strrpos($this->getRequest('controller'), '_')).'_'.$sNextController,
                        'wizard'     => 'true'
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
                MLModule::gi()->setConfig('exchangerate_update', '0');
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

    /**
     * @throws MLAbstract_Exception
     * @throws ML_Filesystem_Exception
     */
    private function renderCurrencyPopup() {
        $mpDBCurrency = MLModule::gi()->getConfig('currency');
        $shopCurrency = strtoupper(MLHelper::gi('model_price')->getShopCurrency());
        $mpCurrency = strtoupper((empty($mpDBCurrency)) ? getCurrencyFromMarketplace(MLModule::gi()->getMarketPlaceId()) : $mpDBCurrency);
        if (!empty($mpCurrency) && $shopCurrency !== $mpCurrency && !MLModule::gi()->getConfig('exchangerate_update')) {
            MLSettingRegistry::gi()->addJs('magnalister.woocommerce.currencypopup.js');
            ?>
            <div class="cml-modal"
                 data-button-abort="<?php echo(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')) ?>"
                 data-button-ok="<?php echo(MLI18n::gi()->get('ML_BUTTON_LABEL_ACCEPT')) ?>"
                 data-title="<?php echo(MLI18n::gi()->get('ML_CHECKCURRENCY_POPUP_TITLE')) ?>"
                 data-ajaxmethod="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>"
            >
                <p><?php echo MLI18n::gi()->get('ML_CHECKCURRENCY_POPUP_TEXT') ?></p>
            </div>

            <?php
        }

    }

    protected function callAjaxAcceptCurrencyExchange() {
        MLModule::gi()->setConfig('exchangerate_update', '1');
    }

    /**
     * This function checks if the same orders status is used multiple times for like import, confirm shipment, cancel shipment
     *  Because when it will show an error
     * @return void
     * @throws MLAbstract_Exception
     */
    protected function checkSameOrderStatusIsUsedMultipleTimes() {
        $configFields = MLModule::gi()->getNoneRepeatedStatusConfigurationKey();
        // helper function
        $getCleanSettingName = function($setting) {
            preg_match('/(.*?)__#/m', $setting, $matches);
            if (!empty($matches)) {
                return $matches[1];
            }

            return $setting;
        };

        $ordersStatus = array();

        // get only the set config keys to be checked
        foreach ($configFields as $configField) {
            $value = MLModule::gi()->getConfig($configField);

            if ($value !== null) {
                if (is_array($value)) {
                    foreach ($value as $key => $status) {
                        $ordersStatus[$configField.'__#'.$key] = $status;
                    }
                } else {
                    $ordersStatus[$configField] = $value;
                }
            }
        }

        // I18n
        $i18nForm = $this->getFormArray('aI18n')['field'];

        // Get Unique config values
        $unique = array_unique($ordersStatus);
        // check for duplicates
        $duplicates = array_diff_assoc($ordersStatus, $unique);

        // array unique + values return only the need config value to be checked
        foreach (array_unique(array_values($duplicates)) as $val) {
            // now get all config field keys that are affected
            $val = array_keys($ordersStatus, $val);

            // get first affected key
            $firstSetting = (string)array_shift($val);
            $firstSetting = $getCleanSettingName($firstSetting);

            // when content not available - throw no error
            if (!isset($i18nForm[$firstSetting])) {
                return;
            }

            // pull translation
            $firstSetting = $i18nForm[$firstSetting]['label'];
            $otherSettings = '';

            // pull translation for other settings
            foreach ($val as $setting) {
                $setting = $getCleanSettingName($setting);
                $otherSettings .= '"'.$i18nForm[$setting]['label'].'",';
            }
            $otherSettings = rtrim($otherSettings, ',');

            // throw an error
            MLMessage::gi()->addError(
                MLModule::gi()->getMarketPlaceName(false).' ('.MLModule::gi()->getMarketPlaceId().') '.sprintf(
                    MLI18n::gi()->get('ML_CONFIG_ORDER_IMPORT_STATUS_SAME_OPTION_USED_TWICE'), $firstSetting, $otherSettings
                )
            );
        }
    }

    /**
     * @param $aSettings mixed
     * @return array
     */
    static protected function getAuthKeys($aSettings) {
        $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
        return empty($aSettings[$sMarketplaceName]['authKeys']) || !is_array($aSettings[$sMarketplaceName]['authKeys']) ? array() : $aSettings[$sMarketplaceName]['authKeys'];
    }
}
