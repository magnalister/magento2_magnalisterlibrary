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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Amazon_Controller_Amazon_Config_Bopis extends ML_Form_Controller_Widget_Form_ConfigAbstract {
    /**
     * BOPIS store config iteration key
     * @var integer
     */
    protected $storeConfigKey;

    public function __construct() {
        parent::__construct();

        MLSetting::gi()->add('aCss', array('magnalister.config_bopis.css?%s'), true);
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('amazon_config_account_bopis');
    }
    
    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false) ;
    }

    public static function getTabVisibility() {
        $shopData = MLShop::gi()->getShopInfo();
        return $shopData['DATA']['IsBopisPilot'] === 'yes';
    }

    // Not used because the getting of subfields is complex , can be maybe used in the future
    private function getamazon_bopis_use_from_master($currentField){
        $result = array();
        if (    array_key_exists('ismaster', $currentField) && $currentField['ismaster'] === false
            || !array_key_exists('ismaster', $currentField)
        ) {
            $result = array(
                array(
                    'name' => $currentField['realname'].'.usefrommaster',
                    'type' => 'radio',
                    'values' => array(
                        'yes' => 'Yes',
                        'no' => 'No',
                    ),
                    'default' => 'yes',
                ),
            );
        }

        return $result;
    }

    public function get_amazon_bopis_address_subfields($currentField){
        $result = $this->getamazon_bopis_use_from_master($currentField);
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array_merge($result, array(
            array(
                'name' => $currentField['realname'].'.name',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.addressLine1',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.addressLine2',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.addressLine3',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.city',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.county',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.district',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.stateOrRegion',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.postalCode',
                'type' => 'string'
            ),
            array(
                'name' => $currentField['realname'].'.countryCode',
                'type' => 'select'
            ),
            array(
                'name' => $currentField['realname'].'.phone',
                'type' => 'string'
            ),
        ));

        return $result;
    }

    public function get_amazon_bopis_capabilities_subfields($currentField){
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array(
            array(
                'name' => $currentField['realname'].'.isSupported',
                'type' => 'radio',
                'values' => array(
                    'yes' => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
                    'no' => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'),
                ),
                'default' => 'yes',
            ),
            array(
                'name' => $currentField['realname'].'.operationalConfiguration',
                'type' => 'amazon_bopis_operational_configuration',
            ),
            array(
                'name' => $currentField['realname'].'.pickupChannel',
                'type' => 'amazon_bopis_capabilities_pickup_channel',
            ),
        );

        return $result;
    }

    public function get_amazon_bopis_operational_configuration_subfields($currentField){
        $result = $this->getamazon_bopis_use_from_master($currentField);
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array_merge($result, array(
            array(
                'name' => $currentField['realname'].'.contactDetails',
                'type' => 'subFieldsContainer',
                'incolumn' => true,
                'subfields' => $this->get_amazon_bopis_contact_details_subfields($currentField),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.monday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'monday'),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.tuesday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'tuesday'),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.wednesday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'wednesday'),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.thursday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'thursday'),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.friday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'friday'),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.saturday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'saturday'),
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.sunday',
                'type' => 'subFieldsContainer',
                'incolumn' => false,
                'subfields' => $this->get_amazon_bopis_start_end_time_subfields($currentField, 'sunday'),
            ),
        ));

        return $result;
    }

    public function get_amazon_bopis_capabilities_pickup_channel_subfields($currentField){
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array(
            array(
                'name' => $currentField['realname'].'.isSupported',
                'type' => 'radio',
                'values' => array(
                    'yes' => 'Yes',
                    'no' => 'No',
                ),
                'default' => 'yes',
            ),
            array(
                'name' => $currentField['realname'].'.inventoryHoldPeriod',
                'type' => 'amazon_bopis_handling_time',
            ),
            /*
             * Currently only one handling time is supported, therefore we set all handling times to the same time at the moment
                array(
                    'name' => $currentField['realname'].'.handlingtime',
                    'type' => 'amazon_bopis_handling_time',
                ),
            */
            array(
                'name' => $currentField['realname'].'.operationalConfiguration',
                'type' => 'amazon_bopis_operational_configuration',
            ),
        );

        return $result;
    }

    public function get_amazon_bopis_contact_details_subfields($currentField){
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array(
            array(
                'name' => $currentField['realname'].'.contactDetails.email',
                'type' => 'string',
                'placeholder' => 'example@mail.com',
            ),
            array(
                'name' => $currentField['realname'].'.contactDetails.phone',
                'type' => 'string',
                'placeholder' => '0123456789',
            ),
        );

        return $result;
    }

    public function get_amazon_bopis_handling_time_subfields($currentField){
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array(
            array(
                'name' => $currentField['realname'].'.value',
                'type' => 'string',
            ),
            array(
                'name' => $currentField['realname'].'.timeUnit',
                'type' => 'select',
            ),
        );

        return $result;
    }

    public function get_amazon_bopis_start_end_time_subfields($currentField, $day){
        $currentField['realname'] = isset($currentField['realname']) ? $currentField['realname'] : $currentField['name'];
        $result = array(
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.'.$day.'.startTime',
                'type' => 'string',
                'placeholder' => '09:00',
            ),
            array(
                'name' => $currentField['realname'].'.operatingHoursByDay.'.$day.'.endTime',
                'type' => 'string',
                'placeholder' => '18:00',
            ),
        );

        return $result;
    }

    private function updateFieldValue($requestFiledName, $configFiledName, &$mValue){
        $iStoreIndex = MLRequest::gi()->data('storeindex');
        if (strpos(strtolower($configFiledName), $requestFiledName) === 0) {
            if (!is_array($mValue)) {
                $aCurrentValue = MLModule::gi()->getConfig($configFiledName);
                if (isset($iStoreIndex)) {
                    $aCurrentValue[$iStoreIndex] = $mValue;
                } else {
                    $aCurrentValue[] = $mValue;
                }

                $mValue = $aCurrentValue;
            }
        }
    }

    private function oldSaveAction(){
        $aFields = MLSetting::gi()->get('amazon_config_bopis__stores__fields');
        foreach ($this->aRequestFields as $sName => &$mValue) {
            foreach ($aFields as $aField) {
                if (substr($aField['type'], 0, strpos($aField['type'], '_', strpos($aField['type'], '_')+1)) === 'amazon_bopis'
                    && method_exists($this,'get_'.$aField['type'].'_subfields')) {
                    $aSubfields = $this->{'get_'.$aField['type'].'_subfields'}($aField);
                    MLMessage::gi()->addDebug(__LINE__.':'.'$aSubfields', $aSubfields);
                    foreach ($aSubfields as $subfield) {
                        if (isset($subfield['subfields'])) {
                            foreach ($subfield['subfields'] as $sSubfield) {
                                $this->updateFieldValue($sName, $sSubfield['name'], $mValue);
                            }
                        } else {
                            $this->updateFieldValue($sName, $subfield['name'], $mValue);
                        }

                    }
                } else {
                    $this->updateFieldValue($sName, $aField['name'], $mValue);
                }

            }
        }
    }

    public function deleteStoreAction($blExecute = true) {
        if ($blExecute) {
            $iStoreIndex = $this->aRequestFields['bopis.stores'];
            $aStoreFields = MLDatabase::getDbInstance()->fetchArray('SELECT * FROM magnalister_config WHERE mpID = 56700 AND mkey LIKE "%bopis.array%"');
            foreach ($aStoreFields as $storeField) {
                $values = json_decode($storeField['value']);
                if(isset($values[$iStoreIndex])) {
                    unset($values[$iStoreIndex]);
                    MLModule::gi()->setConfig($storeField['mkey'], array_values($values));
                }
            }
            $this->sendStoreToAPI();
        }
    }

    public function saveAction($blExecute = true) {
        if (isset($this->aRequestFields['bopis.stores'])) {
            $iStoreIndex = $this->aRequestFields['bopis.stores'];
            foreach ($this->aRequestFields as $sName => &$mValue) {
                if (strpos($sName, 'bopis.array.') === 0) {
                    if (!is_array($mValue)) {
                        $aCurrentValue = MLModule::gi()->getConfig($sName);
                        if (isset($iStoreIndex) && $iStoreIndex !== '') {
                            $aCurrentValue[$iStoreIndex] = $mValue;
                        } else {
                            $aCurrentValue[] = $mValue;
                        }

                        $mValue = $aCurrentValue;
                    }
                }
            }
        }

        if (isset($this->aRequestFields['bopis.stores'])) {
            unset($this->aRequestFields['bopis.stores']);
        }

        MLMessage::gi()->addDebug(__LINE__.':'.'$this->aRequestFields', $this->aRequestFields);
        $result = parent::saveAction($blExecute);

        // should only be triggered when config active is saved
        if ($blExecute && isset($this->aRequestFields['bopis.array.alias']) && isset($this->aRequestFields['bopis.array.supplysourcecode'])) {
            $this->sendStoreToAPI();
        }

        return $result;
    }

    private function sendStoreToAPI() {
        try {
            $aSend = $this->prepareBOPISData();
//            echo print_m($aSend);
            $response = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'CreateUpdateStore',
                'DATA'   => $aSend,
            ));

            if (isset($response['DATA'])) {
                $responseData = $response['DATA'];
                if(!empty($responseData['CREATION_SUCCESS'])){
                    foreach ($responseData['CREATION_SUCCESS'] as $createdStore) {
                        # We don't want the storeSourceId in the shopsystem, API will handle it based on supplySourceCode
                        # $this->storeSourceId($createdStore);
                        $this->showSuccess($createdStore, 'createstoresuccess');
                    }
                }
                if(!empty($responseData['CREATION_AND_UPDATE_SUCCESS'])) {
                    foreach ($responseData['CREATION_AND_UPDATE_SUCCESS'] as $createdAndUpdatedStore) {
                        # We don't want the storeSourceId in the shopsystem, API will handle it based on supplySourceCode
                        # $this->storeSourceId($createdAndUpdatedStore);
                        $this->showSuccess($createdAndUpdatedStore, 'createstoresuccess');
                    }
                }
                if(!empty($responseData['UPDATE_SUCCESS'])) {
                    foreach ($responseData['UPDATE_SUCCESS'] as $updatedStore) {
                        # We don't want the storeSourceId in the shopsystem, API will handle it based on supplySourceCode
                        # $this->storeSourceId($updatedStore);
                        $this->showSuccess($updatedStore, 'updatestoresuccess');
                    }
                }
                if(!empty($responseData['CREATION_ERROR'])) {
                    foreach ($responseData['CREATION_ERROR'] as $createdError) {
                        $this->showError($createdError, 'creation');
                    }
                }
                if(!empty($responseData['CREATION_AND_UPDATE_ERROR'])) {
                    foreach ($responseData['CREATION_AND_UPDATE_ERROR'] as $createdAndUpdatedError) {
                        $this->showError($createdAndUpdatedError, 'creationAndUpdate');
                    }
                }
                if(!empty($responseData['UPDATE_ERROR'])) {
                    foreach ($responseData['UPDATE_ERROR'] as $updatedError) {
                        $this->showError($updatedError, 'update');
                    }
                }
            }


            $blFlushCache = true;
        } catch (MagnaException $oEx) {

        }
    }

    protected function getField($aField, $sVector = null) {
        $aField = parent::getField($aField, $sVector);
        if ($aField === null) {
            return null;
        }
        $iStoreIndex = MLRequest::gi()->data('storeindex');
        if (
            isset($aField['realname']) &&
            strpos($aField['realname'], 'bopis.array') === 0 &&
            is_array($aField['value'])
        ) {
            if ($iStoreIndex !== null) {
                $aField['value'] = $aField['value'][$iStoreIndex];
            } else {
                if (!empty($aField['default'])) {
                    $aField['value'] = $aField['default'];
                } else {
                    unset($aField['value']);
                }
            }
        }
        return $aField;
    }

    private function showSuccess($success, $type) {
        MLMessage::gi()->addSuccess(
            MLI18n::gi()->get('amazon_config_bopis__field__bopis.array.'.$type).$success['supplySourceCode']
        );
    }
    
    private function showError($error, $type) {
        MLMessage::gi()->addWarn(
            MLI18n::gi()->get('amazon_config_bopis__field__bopis.array.supplysourcecode_'.$type.'_error__label').': '.$error['supplySourceCode'].'<br>'.
            $error['error']
        );
    }

    private function getStoreKey($requestSupplySourceCode) {
        $storeKey = null;
        $aSupplySourceCodes = MLModule::gi()->getConfig('bopis.supplysourcecode');
        foreach ($aSupplySourceCodes as $key => $supplySourceCode) {
            if ($requestSupplySourceCode == $supplySourceCode) {
                $storeKey = $key;
            }
        }

        return $storeKey;
    }

    private function prepareBOPISData() {
        $preparedData = array();
        $aSupplySourceCodes = MLModule::gi()->getConfig('bopis.array.supplysourcecode');
        foreach ($aSupplySourceCodes as $storeConfigKey => $sSupplySourceCode) {
            // do not submit any stores without supply source code
            if (empty($sSupplySourceCode)) {
                continue;
            }
            $preparedData[$storeConfigKey] = array();
            $operationConfigurationCapabilities = $this->useStoreConfigData('capabilities', $storeConfigKey);
            $operationConfigurationPickupChannel = $this->useStoreConfigData('capabilities.pickupchannel', $storeConfigKey);
            $preparedData[$storeConfigKey] = $preparedData[$storeConfigKey] + array(
                    'storeStatus'      => $this->getBOPISConfigValue('status', $storeConfigKey),
                    'supplySourceCode' => $sSupplySourceCode,
                    'alias'            => $this->getBOPISConfigValue('alias', $storeConfigKey),
                    'handlingTime'     => $this->prepareBOPISHandlingTime('configuration', $storeConfigKey),
                    'address'          => $this->prepareBOPISAddress($storeConfigKey),
                    'configuration'    => array(
                        'operationalConfiguration' => $this->prepareBOPISOperationalConfiguration('configuration', $storeConfigKey),
                        'timezone'                 => $this->getBOPISConfigValue('configuration.timezone', $storeConfigKey),
                    ),
                    'capabilities'     => array(
                        'outbound' => array(
                            'isSupported'              => true,
                            'operationalConfiguration' => $this->prepareBOPISOperationalConfiguration('configuration', $storeConfigKey), // same as store
                            'pickupChannel'            => array(
                                'inventoryHoldPeriod'      => $this->prepareBOPISInventoryHoldPeriod('capabilities.pickupchannel', $storeConfigKey),
                                'isSupported'              => true,
                                'operationalConfiguration' => $this->prepareBOPISOperationalConfiguration('configuration', $storeConfigKey), // same as store,
                            ),
                        ),
                    )
                    /* commented because update of config only show inventoryHoldPeriod and automatically set other values
                    'capabilities'     => array(
                        'outbound' => array(
                            'isSupported'              => $this->getBOPISConfigValue('capabilities.issupported', $storeConfigKey) == 'yes' ? true : false,
                            'operationalConfiguration' => $this->prepareBOPISOperationalConfiguration($operationConfigurationCapabilities, $storeConfigKey, false),
                            'pickupChannel'            => array(
                                'inventoryHoldPeriod'      => $this->prepareBOPISInventoryHoldPeriod('capabilities.pickupchannel', $storeConfigKey),
                                'isSupported'              => $this->getBOPISConfigValue('capabilities.pickupchannel.issupported', $storeConfigKey) == 'yes' ? true : false,
                                'operationalConfiguration' => $this->prepareBOPISOperationalConfiguration($operationConfigurationPickupChannel, $storeConfigKey),
                            ),
                        ),
                    )*/
            );
        }

        return $preparedData;
    }

    private function prepareBOPISAddress($storeConfigKey) {
        return array(
            'name'          => $this->getBOPISConfigValue('alias', $storeConfigKey),
            'addressLine1'  => $this->getBOPISConfigValue('address.addressline1', $storeConfigKey),
            'addressLine2'  => $this->getBOPISConfigValue('address.addressline2', $storeConfigKey),
            'addressLine3'  => $this->getBOPISConfigValue('address.addressline3', $storeConfigKey),
            'city'          => $this->getBOPISConfigValue('address.city', $storeConfigKey),
            'countryCode'   => $this->getBOPISConfigValue('address.countrycode', $storeConfigKey),
            'county'        => $this->getBOPISConfigValue('address.county', $storeConfigKey),
            'stateOrRegion' => $this->getBOPISConfigValue('address.stateorregion', $storeConfigKey),
            'postalCode'    => $this->getBOPISConfigValue('address.postalcode', $storeConfigKey),
            'phone'         => $this->getBOPISConfigValue('address.phone', $storeConfigKey),
        );
    }

    private function useStoreConfigData($fieldType, $storeConfigKey) {
        $configValue = $this->getBOPISConfigValue($fieldType.'.operationalconfiguration.usefrommaster', $storeConfigKey);
        if ($configValue == 'yes') {
            $result = 'configuration';
        } else {
            $result = $fieldType;
        }

        return $result;
    }

    private function prepareBOPISOperationalConfiguration($operationalConfigurationType, $storeConfigKey, $includeHandlingTime = true) {
        $result = array(
            'contactDetails'      => $this->prepareBOPISContactData($operationalConfigurationType, $storeConfigKey),
            'operatingHoursByDay' => $this->prepareBOPISOperatingHours($operationalConfigurationType, $storeConfigKey),
        );

        if ($includeHandlingTime) {
            $result['handlingTime'] = $this->prepareBOPISHandlingTime($operationalConfigurationType, $storeConfigKey);
        }
        return $result;
    }

    private function prepareBOPISHandlingTime($handlingTimeType, $storeConfigKey) {
        return array(
            'value'    => $this->getBOPISConfigValue($handlingTimeType.'.handlingtime.value', $storeConfigKey),
            'timeUnit' => $this->getBOPISConfigValue($handlingTimeType.'.handlingtime.timeunit', $storeConfigKey),
        );
    }

    private function prepareBOPISInventoryHoldPeriod($inventoryHoldPeriodType, $storeConfigKey) {
        return array(
            'value'    => $this->getBOPISConfigValue($inventoryHoldPeriodType.'.inventoryholdperiod.value', $storeConfigKey),
            'timeUnit' => $this->getBOPISConfigValue($inventoryHoldPeriodType.'.inventoryholdperiod.timeunit', $storeConfigKey),
        );
    }

    private function prepareBOPISContactData($contactType, $storeConfigKey) {
        return array(
            'primary' => array(
                'email' => $this->getBOPISConfigValue($contactType.'.operationalconfiguration.contactdetails.email', $storeConfigKey),
                'phone' => $this->getBOPISConfigValue($contactType.'.operationalconfiguration.contactdetails.phone', $storeConfigKey),
            )
        );
    }

    private function prepareBOPISOperatingHours($operatingHoursType, $storeConfigKey) {
        $result = array();
        $aWeek = array(
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday'
        );
        foreach ($aWeek as $day) {
            $sConfigValue = $this->getBOPISConfigValue($operatingHoursType.'.operationalconfiguration.'.$day.'.starttime', $storeConfigKey);
            if (!empty($sConfigValue)) {
                $result[$day]['startTime'] = $sConfigValue;
            } else {
                //in case the time is not filed we should pass 00:00 to Amazon
                $result[$day]['startTime'] = '00:00';
            }
            $sConfigValue = $this->getBOPISConfigValue($operatingHoursType.'.operationalconfiguration.'.$day.'.endtime', $storeConfigKey);
            if (!empty($sConfigValue)) {
                $result[$day]['endTime'] = $sConfigValue;
            } else {
                //in case the time is not filed we should pass 00:00 to Amazon
                $result[$day]['endTime'] = '00:00';
            }
        }
       return $result;
    }

    private function getBOPISConfigValue($mkey, $storeConfigKey) {
        $result = '';
        $aConfigValue = MLModule::gi()->getConfig('bopis.array.'.$mkey);
        if (isset($aConfigValue[$storeConfigKey])) {
            $result = $aConfigValue[$storeConfigKey];
        }
        if ($result === null) {
            $result = '';
        }
        return $result;
    }


}
