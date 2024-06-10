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

/**
 * all fields include i18n directly
 */
MLSetting::gi()->add('formfields_metro', array(
    'mwst' => array(
        'i18n' => '{#i18n:formfields_metro__mwst#}',
        'name' => 'mwst',
        'type' => 'string',
    ),
    'usevariations' => array(
        'i18n' => '{#i18n:formfields_metro__usevariations#}',
        'name' => 'usevariations',
        'type' => 'bool',
        'default' => true
    ),
    'processingtime' => array(
        'i18n' => '{#i18n:formfields_metro__processingtime#}',
        'name' => 'processingtime',
        'type' => 'select',
    ),
    'maxprocessingtime' => array(
        'i18n' => '{#i18n:formfields_metro__maxprocessingtime#}',
        'name' => 'maxprocessingtime',
        'type' => 'select',
    ),
    'businessmodel' => array(
        'i18n' => '{#i18n:formfields_metro__businessmodel#}',
        'name' => 'businessmodel',
        'type' => 'select',
        'default' => '',
    ),
    'freightforwarding' => array(
        'i18n' => '{#i18n:formfields_metro__freightforwarding#}',
        'name' => 'freightforwarding',
        'type' => 'radio',
        'values' => '{#i18n:formfields_metro_freightforwarding_values#}',
        'default' => 'false',
    ),
    'shippingprofile' => array(
        'i18n' => '{#i18n:formfields_metro__shippingprofile#}',
        'name' => 'ShippingProfile',
    ),
    'shippinggroup' => array(
        'i18n' => '{#i18n:formfields_metro__shippinggroup#}',
        'name' => 'ShippingGroup',
    ),
    'prepare_title' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_title#}',
        'name' => 'Title',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_shortdescription' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_shortdescription#}',
        'name' => 'ShortDescription',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_description' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_description#}',
        'name' => 'Description',
        'type' => 'wysiwyg',
        'singleproduct' => true,
    ),
    'prepare_image' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_image#}',
        'name' => 'Images',
        'type' => 'imagemultipleselect',
        'singleproduct' => true,
    ),

    'prepare_gtin' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_gtin#}',
        'name' => 'GTIN',
        'type' => 'string',
        'singleproduct' => true,
    ),

    'prepare_manufacturer' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_manufacturer#}',
        'name' => 'Manufacturer',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_manufacturerpartnumber' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_manufacturerpartnumber#}',
        'name' => 'ManufacturerPartNumber',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_brand' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_brand#}',
        'name' => 'Brand',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_msrp' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_msrp#}',
        'name' => 'ManufacturersSuggestedRetailPrice',
        'type' => 'string',
        'optional' => array('defaultvalue' => false),//it set optional select to false by default
        'singleproduct' => true,
    ),

    'prepare_feature' => array(
        'i18n' => '{#i18n:formfields_metro__prepare_feature#}',
        'name' => 'Feature',
        'type' => 'metro_multiple',
        'metro_multiple' => array(
            'max' => 5,
            'field' => array(
                'type' => 'string'
            ),
        ),
        'singleproduct' => true,
    ),
    'prepare_category' => array(
        'label' => '{#i18n:formfields_metro__prepare_category#}',
        'name' => 'variationgroups',
        'type' => 'categoryselect',
        'subfields' => array(
            'variationgroups.value' => array('name' => 'variationgroups.value', 'type' => 'categoryselect', 'cattype' => 'marketplace'),
        ),
    ),
    'orderstatus.carrier' => array(
        'i18n' => '{#i18n:formfields_metro__orderstatus.carrier#}',
        'name' => 'orderstatus.carrier',
        'type' => 'string',
    ),
    'orderstatus.cancellationreason' => array(
        'i18n' => '{#i18n:formfields_metro__orderstatus.cancellationreason#}',
        'name' => 'orderstatus.cancellationreason',
        'type' => 'select',
    ),
    'prepare_saveaction' => array(
        'name' => 'saveaction',
        'type' => 'submit',
        'value' => 'save',
        'position' => 'right',
    ),
    'prepare_resetaction' => array(
        'name' => 'resetaction',
        'type' => 'submit',
        'value' => 'reset',
        'position' => 'left',
    ),
    'prepare_variationgroups' => array(
        'i18n' => '{#i18n:formfields__prepare_variationgroups#}',
        'name' => 'variationgroups',
        'type' => 'categoryselect',
        'subfields' => array(
            'variationgroups.value' => array('name' => 'variationgroups.value', 'type' => 'categoryselect', 'cattype' => 'marketplace', 'value' => null),
        ),
    ),
    'config_magnaInvoice' => array(
        'i18n' => '{#i18n:formfields_metro__erpInvoiceDestination#}',
        'name' => 'invoice.erpinvoicedestination',
        'type' => 'string',
    ),
    'VolumepricesEnable' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_enable#}',
        'name' => 'VolumepricesEnable',
        'type' => 'select',
        'values' => array(
            'useconfig' => '{#i18n:formfields_metro__volumeprices_enable_useconfig#}',
            'webshop' => '{#i18n:formfields_metro__volumeprices_enable_webshop#}',
            'dontuse' => '{#i18n:formfields_metro__volumeprices_enable_dontuse#}',
        ),
        'default' => 'dontuse',
    ),
    'VolumepricesWebshopCustomerGroup' => array(
        'i18n' => array(
            'label' => '{#i18n:configform_price_field_priceoptions_label#}',
        ),
        'name' => 'VolumepricesWebshopCustomerGroup',
        'type' => 'select',
    ),
    'VolumepricesWebshopPriceOptions' => array(
        'i18n' => '{#i18n:formfields_metro__volumepriceswebshoppriceoptions#}',
        'name' => 'VolumepricePriceWebshopOptions',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'AddKind' => array(
                'name' => 'VolumepricesWebshopPriceOptionsAddKind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                ),
                'default' => 'percent',
                'autooptional' => false,
            ),
            'Factor' => array(
                'name' => 'VolumepricesWebshopPriceOptionsFactor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'default' => '0.00',
                'autooptional' => false,
            ),
            'Signal' => array(
                'name' => 'VolumepricesWebshopPriceOptionsSignal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
                'autooptional' => false,
            ),
        )
    ),
    'VolumepricePrice2' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_price2#}',
        'name' => 'VolumepricePrice2',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'AddKind' => array(
                'name' => 'VolumepricePrice2AddKind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'dontuse' => '{#i18n:form_type_optional_select__false#}',
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                    'customergroup' => '{#i18n:formfields__customergroup__label#}',
                ),
                'default' => 'dontuse',
                'autooptional' => false,
            ),
            'Factor' => array(
                'name' => 'VolumepricePrice2Factor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'default' => '0.00',
                'autooptional' => false,
            ),
            'Signal' => array(
                'name' => 'VolumepricePrice2Signal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
                'autooptional' => false,
            ),
            'CustomerGroup' => array(
                'name' => 'VolumepricePrice2CustomerGroup',
                'i18n' => array(
                    'label' => '{#i18n:configform_price_field_priceoptions_label#}',
                    'hint' => '',
                ),
                'type' => 'select',
            ),
        ),
    ),
    'VolumepricePrice3' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_price3#}',
        'name' => 'VolumepricePrice3',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'Addkind' => array(
                'name' => 'VolumepricePrice3Addkind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'dontuse' => '{#i18n:form_type_optional_select__false#}',
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                    'customergroup' => '{#i18n:formfields__customergroup__label#}',
                ),
                'default' => 'dontuse',
            ),
            'Factor' => array(
                'name' => 'VolumepricePrice3Factor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'default' => '0.00',
            ),
            'Signal' => array(
                'name' => 'VolumepricePrice3Signal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
            ),
            'CustomerGroup' => array(
                'name' => 'VolumepricePrice3CustomerGroup',
                'i18n' => array(
                    'label' => '{#i18n:configform_price_field_priceoptions_label#}',
                    'hint' => '',
                ),
                'type' => 'select',
            ),
        ),
    ),
    'VolumepricePrice4' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_price4#}',
        'name' => 'VolumepricePrice4',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'Addkind' => array(
                'name' => 'VolumepricePrice4Addkind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'dontuse' => '{#i18n:form_type_optional_select__false#}',
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                    'customergroup' => '{#i18n:formfields__customergroup__label#}',
                ),
                'default' => 'dontuse',
            ),
            'Factor' => array(
                'name' => 'VolumepricePrice4Factor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'default' => '0.00',
            ),
            'Signal' => array(
                'name' => 'VolumepricePrice4Signal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
            ),
            'CustomerGroup' => array(
                'name' => 'VolumepricePrice4CustomerGroup',
                'i18n' => array(
                    'label' => '{#i18n:configform_price_field_priceoptions_label#}',
                    'hint' => '',
                ),
                'type' => 'select',
            ),
        ),
    ),
    'VolumepricePrice5' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_price5#}',
        'name' => 'VolumepricePrice5',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'Addkind' => array(
                'name' => 'VolumepricePrice5Addkind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'dontuse' => '{#i18n:form_type_optional_select__false#}',
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                    'customergroup' => '{#i18n:formfields__customergroup__label#}',
                ),
                'default' => 'dontuse',
            ),
            'Factor' => array(
                'name' => 'VolumepricePrice5Factor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'default' => '0.00',
            ),
            'Signal' => array(
                'name' => 'VolumepricePrice5Signal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
            ),
            'CustomerGroup' => array(
                'name' => 'VolumepricePrice5CustomerGroup',
                'i18n' => array(
                    'label' => '{#i18n:configform_price_field_priceoptions_label#}',
                    'hint' => '',
                ),
                'type' => 'select',
            ),
        ),
    ),
    'VolumepricePriceA' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_priceA#}',
        'name' => 'VolumepricePriceA',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'Addkind' => array(
                'name' => 'VolumepricePriceAAddkind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'dontuse' => '{#i18n:form_type_optional_select__false#}',
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                    'customergroup' => '{#i18n:formfields__customergroup__label#}',
                ),
                'default' => 'dontuse',
            ),
            'Factor' => array(
                'name' => 'VolumepricePriceAFactor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'default' => '0.00',
            ),
            'Signal' => array(
                'name' => 'VolumepricePriceASignal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
            ),
            'Start' => array(
                'name' => 'VolumepricePriceAStart',
                'i18n' => '{#i18n:formfields_metro__volumeprices_priceA#}',
                'placeholder' => '{#i18n:ML_METRO_VOLUMEPRICES_START_AT_PLACEHOLDER#}',
                'type' => 'string'
            ),
            'CustomerGroup' => array( // the order of these fields will impact the js
                'name' => 'VolumepricePriceACustomerGroup',
                'i18n' => array(
                    'label' => '{#i18n:configform_price_field_priceoptions_label#}',
                    'hint' => '',
                ),
                'type' => 'select',
            ),
        ),
    ),
    'VolumepricePriceB' => array(
        'i18n' => '{#i18n:formfields_metro__volumeprices_priceB#}',
        'name' => 'VolumepricePriceB',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'Addkind' => array(
                'name' => 'VolumepricePriceBAddkind',
                'i18n' => '{#i18n:formfields__price.addkind#}',
                'type' => 'select',
                'values' => array(
                    'dontuse' => '{#i18n:form_type_optional_select__false#}',
                    'percent' => '{#i18n:configform_price_addkind_values__percent#}',
                    'addition' => '{#i18n:configform_price_addkind_values__addition#}',
                    'customergroup' => '{#i18n:formfields__customergroup__label#}',
                ),
                'default' => 'dontuse',
            ),
            'Factor' => array(
                'name' => 'VolumepricePriceBFactor',
                'i18n' => '{#i18n:formfields__price.factor#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_PLACEHOLDER#}',
            ),
            'Signal' => array(
                'name' => 'VolumepricePriceBSignal',
                'i18n' => '{#i18n:formfields__price.signal#}',
                'type' => 'string',
                'placeholder' => '{#i18n:ML_METRO_PRICE_SIGNAL_PLACEHOLDER#}',
            ),
            'Start' => array(
                'name' => 'VolumepricePriceBStart',
                'i18n' => '{#i18n:formfields_metro__volumeprices_priceB#}',
                'placeholder' => '{#i18n:ML_METRO_VOLUMEPRICES_START_AT_PLACEHOLDER#}',
                'type' => 'string'
            ),
            'CustomerGroup' => array( // the order of these fields will impact the js
                'name' => 'VolumepricePriceBCustomerGroup',
                'i18n' => array(
                    'label' => '{#i18n:configform_price_field_priceoptions_label#}',
                    'hint' => '',
                ),
                'type' => 'select',
            ),
        ),
    ),
));
