<?php
MLSetting::gi()->Ebay_Productlist_Cell_aPreparedStatus = array(
    'OK' => array('color' => 'green'),
    'ERROR' => array('color' => 'red'),
    'OPEN' => array('color' => 'orange'),
);
MLSetting::gi()->get('Productlist_Upload_Columns');
MLSetting::gi()->set('Productlist_Upload_Columns', array(
    'image' => null,
    'product' => null,
    'manufacturerpartnumber' => array('title'=> 'Productlist_Header_Field_sManufacturerpartnumber'),
    'ean' => array('title'=> 'Productlist_Header_Field_sEan'),
    'quantityShop' => null,
    'quantityMarketplace' => null,
    'priceShop' => null,
    'priceMarketplace' => null,
    'auctionType' => array(),
//    'preparedType' => null,
), true);
MLSetting::gi()->get('Productlist_Prepare_Columns');
MLSetting::gi()->set('Productlist_Prepare_Columns', array(
    'image' => null,
    'product' => null,
    'manufacturerpartnumber' => array('title'=> 'Productlist_Header_Field_sManufacturerpartnumber'), // <1
    'ean' => array('title'=> 'Productlist_Header_Field_sEan'),
    'quantityShop' => null,
//    'quantityMarketplace' => null,
    'priceShop' => null,
    'priceMarketplace' => null,
    'auctionType' => array(),
//    'preparedType' => null,
    'preparedStatus' => null,
), true);
