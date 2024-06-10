<?php
MLSetting::gi()->Productlist_Cell_aNotPreparedStatus__color='gray';

MLSetting::gi()->Productlist_Prepare_Columns = array(
    'image' => null,
    'product' => null,
    'manufacturerpartnumber' => array('title'=> 'Productlist_Header_Field_sManufacturerpartnumber'), // <1
    'ean' => array('title'=> 'Productlist_Header_Field_sEan'),
    'quantityShop' => null,
//    'quantityMarketplace' => null,
    'priceShop' => null,
    'priceMarketplace' => null,
    'preparedStatus' => null,
);

MLSetting::gi()->Productlist_Upload_Columns = array(
    'image' => null,
    'product' => null,
    'manufacturerpartnumber' => array('title'=> 'Productlist_Header_Field_sManufacturerpartnumber'),
    'ean' => array('title'=> 'Productlist_Header_Field_sEan'),
    'quantityShop' => null,
    'quantityMarketplace' => null,
    'priceShop' => null,
    'priceMarketplace' => null,
    'preparedType' => null,
);

MLSetting::gi()->Productlist_Upload_NoPrepareType_Columns = array(
    'image' => null,
    'product' => null,
    'manufacturerpartnumber' => array('title'=> 'Productlist_Header_Field_sManufacturerpartnumber'),
    'ean' => array('title'=> 'Productlist_Header_Field_sEan'),
    'quantityShop' => null,
    'quantityMarketplace' => null,
    'priceShop' => null,
    'priceMarketplace' => null,
);