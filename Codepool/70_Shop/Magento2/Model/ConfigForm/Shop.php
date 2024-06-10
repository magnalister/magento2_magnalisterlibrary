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

use Magento\Catalog\Model\Product as ProductEntityType;
use Magento\Eav\Api\Data\AttributeInterface;

MLFilesystem::gi()->loadClass('Shop_Model_ConfigForm_Shop_Abstract');

class ML_Magento2_Model_ConfigForm_Shop extends ML_Shop_Model_ConfigForm_Shop_Abstract {

    protected $sPlatformName = '';
    public static $aLanguages = null;

    public function getDescriptionValues() {
        $aOut = array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magento\Store\Api\StoreRepositoryInterface $repository */
        $stores = $objectManager->get('\Magento\Store\Api\StoreRepositoryInterface');
        foreach ($stores->getList() as $store) {
            /** @var $store Magento\Store\Model\Store */
            if ($store->getCode() != 'admin') {
                $aOut[$store->getId()] = $store->getWebsite()->getName().': '.$store->getGroup()->getName().': '.$store->getName();
            }
        }
        return $aOut;
    }

    /**
     *
     * @return array
     * {
     *      "123":"channel 1",
     *      ....
     * }
     */
    public function getShopValues() {
        return $this->getDescriptionValues();
    }

    /**
     * @param boolean $blNotLoggedIn
     * @return array
     * @todo : the user.repository should be checked
     */
    public function getCustomerGroupValues($blNotLoggedIn = false) {

        /**
         * @var \Magento\Customer\Model\ResourceModel\Group\Collection
         * Returns array('customer_group_id', 'customer_group_code') of customer group collection
         */
        $aGroupsName = MLMagento2Alias::ObjectManagerProvider('\Magento\Customer\Model\ResourceModel\Group\Collection')->toOptionHash();

        return $aGroupsName;
    }

    /**
     * @return type
     * @todo Done
     */
    public function getOrderStatusValues() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /**
         * @var Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory
         * Returns array('status', 'label') of Order Status collection
         */
        try {
            $aOrderStatesName = $objectManager->get('Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory')->create()->toOptionHash();
        } catch (Exception $exception) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('magento2_generated_directory_issue'));
            throw new Exception();
        }

        return $aOrderStatesName;
    }

    /**
     * @return type
     * @todo Done
     */
    public function getPaymentStatusValues() {
        return array();
    }

    /**
     * @return array
     */
    public function getEan() {
        return $this->getListOfArticleFields();
    }

    /**
     * @return array
     */
    public function getUpc() {
        return $this->getListOfArticleFields();
    }

    /**
     * @return array
     */
    public function getMarketingDescription() {
        return $this->getListOfArticleFields();
    }

    /**
     * @return type
     * @todo Done
     */
    protected function getVariationsAttribute($blAttributeMatching = false) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        try {
            $attributeFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory');
        } catch (Exception $exception) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('magento2_generated_directory_issue'));
            throw new Exception();
        }
        $eavConfig = $objectManager->create('Magento\Eav\Model\Config');
        $collection = $attributeFactory->create();
        $collection->addFieldToFilter('entity_type_id', $eavConfig->getEntityType(ProductEntityType::ENTITY)->getEntityTypeId());
        $collection->addFieldToFilter('frontend_input', 'select');
        $collection->addFieldToFilter('is_user_defined', '1');

        $VariationsGroupItems = array();
        if ($blAttributeMatching) {
            foreach($collection as $attributes) {
                $label = $this->getAttributeLabel($attributes->getData(AttributeInterface::FRONTEND_LABEL), $attributes->getData(AttributeInterface::ATTRIBUTE_CODE));

                $VariationsGroupItems['a_' . $attributes->getData(AttributeInterface::ATTRIBUTE_CODE)] = array(
                    'name' => $label,
                    'type' => 'select',
                );
            }
        } else {
            foreach($collection as $attributes) {
                $label = $this->getAttributeLabel($attributes->getData(AttributeInterface::FRONTEND_LABEL), $attributes->getData(AttributeInterface::ATTRIBUTE_CODE));

                $VariationsGroupItems['a_' . $attributes->getData(AttributeInterface::ATTRIBUTE_CODE)] = $label. ' (' . MLI18n::gi()->get('VariationsOptGroup') . ')';
            }
        }
        return $VariationsGroupItems;
    }

    protected function getLanguage() {
        return true;
    }

    /**
     * @return type
     * @todo Done
     */
    protected function getProductCustomAttributesGroup($blAttributeMatching = false) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        try {
            $attributeFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory');
        } catch (Exception $exception) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('magento2_generated_directory_issue'));
            throw new Exception();
        }
        $eavConfig = $objectManager->create('Magento\Eav\Model\Config');
        $collection = $attributeFactory->create();
        $collection->addFieldToFilter('entity_type_id', $eavConfig->getEntityType(ProductEntityType::ENTITY)->getEntityTypeId());
        $collection->addFieldToFilter('is_user_defined', '1');

        $PropertiesGroupItems = array();
        if ($blAttributeMatching) {
            foreach($collection as $attributes) {
                $label = $this->getAttributeLabel($attributes->getData(AttributeInterface::FRONTEND_LABEL), $attributes->getData(AttributeInterface::ATTRIBUTE_CODE));

                $PropertiesGroupItems['p_' . $attributes->getData(AttributeInterface::ATTRIBUTE_CODE)] = array(
                    'name' => $label,
                    'type' => in_array($attributes->getData(AttributeInterface::FRONTEND_INPUT), ['multiselect', 'select']) ? MLFormHelper::getShopInstance()::Shop_Attribute_Type_Key_Select : MLFormHelper::getShopInstance()::Shop_Attribute_Type_Key_Text,
                );
            }
        } else {
            foreach($collection as $attributes) {
                $label = $this->getAttributeLabel($attributes->getData(AttributeInterface::FRONTEND_LABEL), 'p_' . $attributes->getData(AttributeInterface::ATTRIBUTE_CODE));

                $PropertiesGroupItems['p_' . $attributes->getData(AttributeInterface::ATTRIBUTE_CODE)] = $label . ' (' . MLI18n::gi()->get('PropertiesOptGroup') . ')';
            }
        }
        return $PropertiesGroupItems;
    }

    /**
     * @return type
     * @todo Done
     */
    protected function getSystemAttributes($blAttributeMatching = false) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        try {
            $attributeFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory');
        } catch (Exception $exception) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('magento2_generated_directory_issue'));
            throw new Exception();
        }
        $eavConfig = $objectManager->create('Magento\Eav\Model\Config');
        $collection = $attributeFactory->create();
        $collection->addFieldToFilter('entity_type_id', $eavConfig->getEntityType(ProductEntityType::ENTITY)->getEntityTypeId());
        $collection->addFieldToFilter('frontend_input', ['neq' => 'select']);
        $collection->addFieldToFilter('frontend_input', ['neq' =>  'media_image']);
        $collection->addFieldToFilter('is_user_defined', '0');

        $attributeCodes = [];
        foreach($collection as $attributes)
        {
            $label = $this->getAttributeLabel($attributes->getData(AttributeInterface::FRONTEND_LABEL), $attributes->getData(AttributeInterface::ATTRIBUTE_CODE));

            if ($blAttributeMatching) {
                $attributeCodes[$attributes->getData(AttributeInterface::ATTRIBUTE_CODE) ] =
                    array(
                        'name' => $label,
                        'type' => in_array($attributes->getData(AttributeInterface::FRONTEND_INPUT), ['multiselect', 'select']) ? MLFormHelper::getShopInstance()::Shop_Attribute_Type_Key_Select : MLFormHelper::getShopInstance()::Shop_Attribute_Type_Key_Text,
                    );
            }else{
                $attributeCodes[$attributes->getData(AttributeInterface::ATTRIBUTE_CODE)] = $label;
            }
        }
        /*if ($blAttributeMatching) {
            $productProperty = array(
                'Name' => array(
                    'name' => MLI18n::gi()->get('ProductName'),
                    'type' => 'text',
                ),
               .....
            );
        } else {
            $productProperty = array(
                'Name' =>
                    MLI18n::gi()->get('ProductName'),
                'ProductNumber' =>
                    MLI18n::gi()->get('ProductNumber'),
               ...
            );
        }*/
        return $attributeCodes;
    }

    private function getAttributeLabel($aLabel, $aCode)
    {        
        if ($aLabel == '') {
            $aLabel = $aCode;
        }

        return $aLabel;
    }

    /**
     * @return array
     * @throws MLAbstract_Exception
     */
    protected function getListOfArticleFields() {
        $aFields = array_merge(
            array('' => MLI18n::gi()->get('ConfigFormPleaseSelect')),
            $this->getSystemAttributes(),
            $this->getProductCustomAttributesGroup()
        );

        return $aFields;
    }

    public function getManufacturerPartNumber() {
        return $this->getListOfArticleFields();
    }

    public function getManufacturer() {
        return $this->getListOfArticleFields();
    }

    public function getBrand() {
        return $this->getListOfArticleFields();
    }

    public function getShopSystemAttributeList() {
        return $this->getListOfArticleFields();
    }

    public function getShippingTime() {
        return $this->getListOfArticleFields();
    }

    /**
     * @param false $getProperties
     * @return array
     * @throws MLAbstract_Exception
     */
    public function getPrefixedAttributeList($getProperties = false) {
        return $this->getListOfArticleFields();
    }


    /**
     * @inheritDoc
     */
    public function getAttributeListWithOptions() {
        $aAttributes = $this->getPossibleVariationGroupNames();
        foreach ($aAttributes as $sKey => $sAttribute) {
            $aAttributes[$sKey] = mb_convert_encoding($sAttribute, 'HTML-ENTITIES');
        }
        return $aAttributes;
    }

    public function getAttributeOptions($sAttributeCode, $iLangId = null) {
        $iLangId = $iLangId === null ? MLModule::gi()->getConfig()['lang'] : $iLangId;
        $aAttributeCode = explode('_', $sAttributeCode, 2);
        $attributes = array();
        $oAttribute = MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\ResourceModel\Eav\Attribute');

        // Getting values for attributes
        if (!empty($aAttributeCode[1])) {
            $oAttribute->loadByCode(\Magento\Catalog\Model\Product::ENTITY, $aAttributeCode[1]);
            if ($oAttribute->usesSource()) {
                $oAttribute->setStoreId($iLangId === null ? '0' : $iLangId);
                foreach ($oAttribute->getSource()->getAllOptions(false) as $aOption) {
                    if (is_array($aOption)) {
                        if (!is_array($aOption['value']) && is_string($aOption['label'])) {
                            $attributes[$aOption['value']] = $aOption['label'];
                        }
                    }
                }
            }
        }

        return $attributes;
    }

    /**
     * Gets the list of product attribute values.
     * If $iLangId is set, use translation for attribute options' labels.
     *
     * @return array Collection of attribute values
     */
    public function getPrefixedAttributeOptions($sAttributeCode, $iLangId = null) {
        return $this->getAttributeOptions($sAttributeCode, $iLangId);
    }

    /**
     * Return a list of tax classes id and name pair in Magento 2
     * @return array
     */
    public function getTaxClasses() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $taxClassObj = $objectManager->create('Magento\Tax\Model\TaxClass\Source\Product');
        return $taxClassObj->getAllOptions();
    }

    public function getPaymentMethodValues() {
        $aResult = array();
        $paymentConfig = MLMagento2Alias::ObjectManagerProvider('Magento\Payment\Model\Config');
        $activePaymentMethods = $paymentConfig->getActiveMethods();
        foreach ($activePaymentMethods as $method) {
                $aResult[$method->getCode()] = $method->getTitle();
        }

        return $aResult;
    }

    public function getShippingMethodValues() {
        $aResult = array();
        $storeID = MLModule::gi()->getConfig('lang');
        $activeShipping = MLMagento2Alias::ObjectManagerProvider('Magento\Shipping\Model\Config')
            ->getActiveCarriers($storeID);

        foreach ($activeShipping as $carrier) {
            $carrierName = $carrier->getConfigData('title') != '' ? $carrier->getConfigData('title') : $carrier->getCarrierCode();
            $aResult[$carrier->getCarrierCode(). '_' .$carrier->getCarrierCode()] = $carrierName;
        }

        return $aResult;
    }

    public function getShopShippingModuleValues()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        /**
         * @var \Magento\Shipping\Model\Config\Source\Allmethods
         * Returns array('customer_group_id', 'customer_group_code') of customer group collection
         * To get the enables shipping method you can add true in to the toOptionArray(true)
         */
        $Shipping = $objectManager->get('\Magento\Shipping\Model\Config\Source\Allmethods')->toOptionArray();
        $aResult = array();
        foreach ($Shipping as $aShipping => $value) {
            if ($value['label'] !== '') {
                $aResult[$aShipping] = $value['label'];
            }
        }
        return $aResult;
    }

    /**
     * @return array
     * array(
     * "attribute-id"=>"color",...
     * )
     */
    public function getPossibleVariationGroupNames() {
        //$attributeFactory = $objectManager->create('Magento\Eav\Model\ResourceModel\Entity\Attribute\CollectionFactory');
        $attributeFactory = MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory');
        $eavConfig = MLMagento2Alias::ObjectManagerProvider('Magento\Eav\Model\Config');
        $collection = $attributeFactory->create();
        $collection->addFieldToFilter('entity_type_id', $eavConfig->getEntityType(ProductEntityType::ENTITY)->getEntityTypeId());
        $aAttributes = array('' => MLI18n::gi()->get('ConfigFormPleaseSelect'));
        foreach($collection as $attributes)
        {
            $aAttributes['a_' . $attributes->getData(AttributeInterface::ATTRIBUTE_CODE)] = $attributes->getData(AttributeInterface::FRONTEND_LABEL);
        }

        return $aAttributes;
    }

    /**
     * @return array
     * @todo
     */
    public function getGroupedAttributesForMatching($oSelectedProducts = null) {
        $aShopAttributes = array();

        // keep it as it is
        $aFirstElement = array('' => MLI18n::gi()->get('ConfigFormPleaseSelect'));

        // Variation attributes
        $aShopVariationAttributes = $this->getVariationsAttribute(true);
        if (!empty($aShopVariationAttributes)) {
            $aShopVariationAttributes['optGroupClass'] = 'variation';
            $aShopAttributes += array(MLI18n::gi()->get('VariationsOptGroup') => $aShopVariationAttributes);
        }
        // Custom product attributes
        $aShopProductPropertyAttributes = $this->getProductCustomAttributesGroup(true);
        if (!empty($aShopProductPropertyAttributes)) {
            $aShopProductPropertyAttributes['optGroupClass'] = 'property';
            $aShopAttributes += array(MLI18n::gi()->get('PropertiesOptGroup') => $aShopProductPropertyAttributes);
        }

        // Product default fields: Magento2 product table field
        $aShopDefaultFieldsAttributes = $this->getSystemAttributes(true);
        if (!empty($aShopDefaultFieldsAttributes)) {
            $aShopDefaultFieldsAttributes['optGroupClass'] = 'default';
            $aShopAttributes += array(MLI18n::gi()->get('ProductDefaultFieldsOptGroup') => $aShopDefaultFieldsAttributes);
        }

        return $aFirstElement + $aShopAttributes;
    }

    /**
     * @param string $attributeCode
     * @param ML_Magento2_Model_Product|null $product If present attribute value will be set from given product
     * @return array|mixed
     * @throws Exception
     */
    public function getFlatShopAttributesForMatching($attributeCode = null, $product = null) {
        $result = $this->getVariationsAttribute(true) + $this->getProductCustomAttributesGroup(true) + $this->getSystemAttributes(true);

        if (!empty($attributeCode) && !empty($result[$attributeCode])) {
            $result = $result[$attributeCode];
            if (!empty($product)) {
                $result['value'] = $product->getAttributeValue($attributeCode);
            }
        }

        return $result;
    }

    /**
     * @param key $sAttributeKey
     * @return bool
     * @todo return prefix that is used for variations, for example in shopware "_c"
     */
    public function shouldBeDisplayedAsVariationAttribute($sAttributeKey) {
        return substr($sAttributeKey, 0, 2) === 'a_';
    }

//    Implemented overrides for the shipment and payment methods extend eif needed
    public function manipulateFormAfterNormalize(&$aForm) {
        try {
            parent::manipulateFormAfterNormalize($aForm);
            MLModule::gi();

            if (isset($aForm['importactive']['fields']['orderimport.paymentmethod'])) {
                $aForm['importactive']['fields']['orderimport.paymentmethod']['type'] = 'select';
                $aForm['importactive']['fields']['orderimport.paymentmethod']['expert'] = false;
                $aForm['importactive']['fields']['orderimport.paymentmethod']['values'] = $this->getPaymentMethodValues();
                unset($aForm['importactive']['fields']['orderimport.paymentmethod']['subfields']);
            } else if (isset($aForm['orderimport']['fields']['orderimport.paymentmethod'])) {
                $aForm['orderimport']['fields']['orderimport.paymentmethod']['type'] = 'select';
                $aForm['orderimport']['fields']['orderimport.paymentmethod']['expert'] = false;
                $aForm['orderimport']['fields']['orderimport.paymentmethod']['values'] = $this->getPaymentMethodValues();
                unset($aForm['orderimport']['fields']['orderimport.paymentmethod']['subfields']);
            } else if (isset($aForm['paymentandshipping']['fields']['orderimport.paymentmethod'])) {
                $aForm['paymentandshipping']['fields']['orderimport.paymentmethod']['type'] = 'select';
                $aForm['paymentandshipping']['fields']['orderimport.paymentmethod']['expert'] = false;
                $aForm['paymentandshipping']['fields']['orderimport.paymentmethod']['values'] = $this->getPaymentMethodValues();
                unset($aForm['paymentandshipping']['fields']['orderimport.paymentmethod']['subfields']);
            }

            if (in_array(MLModule::gi()->getMarketPlaceName(), ['ebay', 'hood'])) {
                $aMatching = MLI18n::gi()->get('magento2_configform_orderimport_shipping_values__matching__title');
                $shippingValues =  array('matching' => $aMatching) + $this->getShippingMethodValues();
            } else {
                $shippingValues = $this->getShippingMethodValues();
            }
            if (isset($aForm['importactive']['fields']['orderimport.shippingmethod'])) {
                $aForm['importactive']['fields']['orderimport.shippingmethod']['type'] = 'select';
                $aForm['importactive']['fields']['orderimport.shippingmethod']['expert'] = false;
                $aForm['importactive']['fields']['orderimport.shippingmethod']['values'] = $shippingValues;
                unset($aForm['importactive']['fields']['orderimport.shippingmethod']['subfields']);
            } else if (isset($aForm['orderimport']['fields']['orderimport.shippingmethod'])) {
                $aForm['orderimport']['fields']['orderimport.shippingmethod']['type'] = 'select';
                $aForm['orderimport']['fields']['orderimport.shippingmethod']['expert'] = false;
                $aForm['orderimport']['fields']['orderimport.shippingmethod']['values'] = $shippingValues;
                unset($aForm['orderimport']['fields']['orderimport.shippingmethod']['subfields']);
            } else if (isset($aForm['paymentandshipping']['fields']['orderimport.shippingmethod'])) {
                $aForm['paymentandshipping']['fields']['orderimport.shippingmethod']['type'] = 'select';
                $aForm['paymentandshipping']['fields']['orderimport.shippingmethod']['expert'] = false;
                $aForm['paymentandshipping']['fields']['orderimport.shippingmethod']['values'] = $shippingValues;
                unset($aForm['paymentandshipping']['fields']['orderimport.shippingmethod']['subfields']);
            }
        } catch (Exception $ex) {

        }
    }

    public function getDefaultCancelStatus() {
        return 'canceled';
    }

}
