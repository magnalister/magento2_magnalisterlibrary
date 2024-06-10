<?php

class ML_Magento2_Helper_Model_Product_Magento2Tax {

    public static function getTax($oMagentoProduct, $aAddressSets = null) {
        return MLMagento2Alias::ObjectManagerProvider('Magento\Tax\Model\Calculation')
            ->getRate(self::getRateRequest($oMagentoProduct, $aAddressSets));
    }

    private static function getRateRequest($oMagentoProduct, $aAddressSets = null) {

        if ($aAddressSets === null) {
            $aAddresses = array(
                'Shipping' => null,
                'Billing' => null,
            );
        } else {
            $aAddresses = array();
            foreach (array('Shipping', 'Billing') as $sAddressType) {
                $aAddressData = $aAddressSets[$sAddressType];
                $oAddress = MLMagento2Alias::ObjectManagerProvider('Magento\Customer\Api\Data\AddressInterfaceFactory')->create();

                if (isset($aAddressData['Postcode'])) {
                    $oAddress->setCountryId($aAddressData['CountryCode'])
                        ->setPostcode($aAddressData['Postcode']); //some postcode
                } else {
                    $oAddress->setCountryId($aAddressData['CountryCode']);
                }

                if (array_key_exists('Suburb', $aAddressData) && !empty($aAddressData['Suburb'])) {
                    $oRegion = MLMagento2Alias::ObjectManagerProvider('\Magento\Directory\Model\RegionFactory')->create();
                    $regionId = $oRegion
                        ->loadByCode($aAddressData['Suburb'], $aAddressData['CountryCode'])
                        ->getId();
                    if (!isset($regionId)) {
                        $regionId = $oRegion
                            ->loadByName($aAddressData['Suburb'], $aAddressData['CountryCode'])
                            ->getId();
                    }
                    $oAddress->setRegionId($regionId);
                }
                $aAddresses[$sAddressType] = $oAddress;
            }
        }

        $oRateRequest = MLMagento2Alias::ObjectManagerProvider('Magento\Tax\Model\Calculation')->getRateRequest(
            $aAddresses['Shipping'],
            $aAddresses['Billing'],
            null,
            $oMagentoProduct->getStore()
        );
        $oRateRequest->setProductClassId($oMagentoProduct->getTaxClassId());
        return $oRateRequest;
    }

}
