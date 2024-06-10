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

MLSetting::gi()->amazon_prepare_apply_form = array(
    'category' => array(
        'fields' => array(
            'PrepareType' => array(
                'name' => 'PrepareType',
            ),
            'MainCategory' => array(
                'name' => 'variationgroups.value',
                'type' => 'select',
            ),
            'ProductType' => array(
                'name' => 'ProductType'
            ),
            array(
                'name' => 'variationthemealldata',
                'classes' => array('ml-force-hidden'),
            ),
            array(
                'name' => 'variationthemecode'
            ),
            'BrowseNodes' => array(
                'name' => 'BrowseNodes'
            ),
        ),
    ),
    'variationmatching' => array(
        'type' => 'ajaxfieldset',
        'legend' => array(
            'template' => 'two-columns',
        ),
        'field' => array(
            'name' => 'variationmatching',
            'type' => 'ajax',
        ),
    ),
    'details' => array(
        'fields' => array(
            'ItemTitle' => array(
                'name' => 'ItemTitle',
                'type' => 'string',
                'singleproduct' => true
            ),
            'Manufacturer' => array(
                'name' => 'Manufacturer',
                'type' => 'string',
                'singleproduct' => true
            ),
            'Brand' => array(
                'name' => 'Brand',
                'type' => 'string',
                'singleproduct' => true
            ),
            'ManufacturerPartNumber' => array(
                'name' => 'ManufacturerPartNumber',
                'type' => 'string',
                'singleproduct' => true
            ),
            'EAN' => array(
                'name' => 'Ean',
                'type' => 'string',
                'singleproduct' => true
            ),
        ),
    ),
    'moredetails' => array(
        'fields' => array(
            'Images' => array(
                'name' => 'Images',
                'type' => 'imagemultipleselect',
                'singleproduct' => true
            ),
            'BulletPoints' => array(
                'name' => 'BulletPoints',
                'type' => 'amazon_multiple',
                'amazon_multiple' => array(
                    'max' => 5,
                    'field' => array(
                        'type' => 'string'
                    ),
                ),
                'singleproduct' => true
            ),
            'Description' => array(
                'name' => 'Description',
                'type' => 'text',
                'singleproduct' => true
            ),
            'Keywords' => array(
                'name' => 'Keywords',
                'type' => 'string',
                'singleproduct' => true
            ),
        ),
    ),
    'b2b' => array(
        'fields' => array(
            'B2BActive' => array(
                'name' => 'b2bactive',
                'type' => 'b2bradio',
                'default' => 'false'
            ),
            'B2BSellTo' => array(
                'name' => 'b2bsellto',
                'type' => 'select',
                'cssclass' => 'js-b2b',
            ),
            'B2BDiscountType' => array(
                'name' => 'b2bdiscounttype',
                'type' => 'b2bselect',
                'cssclass' => 'js-b2b',
            ),
            'B2BDicsountTier1' => array(
                'name' => 'b2bdiscounttier1',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'quantity' => array(
                        'name' => 'b2bdiscounttier1quantity',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                    'discount' => array(
                        'name' => 'b2bdiscounttier1discount',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                ),
            ),
            'B2BDicsountTier2' => array(
                'name' => 'b2bdiscounttier2',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'quantity' => array(
                        'name' => 'b2bdiscounttier2quantity',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                    'discount' => array(
                        'name' => 'b2bdiscounttier2discount',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                ),
            ),
            'B2BDicsountTier3' => array(
                'name' => 'b2bdiscounttier3',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'quantity' => array(
                        'name' => 'b2bdiscounttier3quantity',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                    'discount' => array(
                        'name' => 'b2bdiscounttier3discount',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                ),
            ),
            'B2BDicsountTier4' => array(
                'name' => 'b2bdiscounttier4',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'quantity' => array(
                        'name' => 'b2bdiscounttier4quantity',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                    'discount' => array(
                        'name' => 'b2bdiscounttier4discount',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                ),
            ),
            'B2BDicsountTier5' => array(
                'name' => 'b2bdiscounttier5',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'quantity' => array(
                        'name' => 'b2bdiscounttier5quantity',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                    'discount' => array(
                        'name' => 'b2bdiscounttier5discount',
                        'type' => 'string',
                        'default' => '0',
                        'cssclasses' => array('autoWidth', 'rightSpacer', 'js-b2b', 'js-b2b-tier'),
                    ),
                ),
            ),
        ),
    ),
    'common' => array(
        'fields' => array(
            'ShippingTime' => array(
                'name' => 'ShippingTime',
            ),
            'ShippingTemplate' => array(
                'name' => 'ShippingTemplate'
            ),
            'BopisStores' => array(
                'name' => 'BopisStores'
            ),
        ),
    ),
);

MLSetting::gi()->amazon_prepare_variations = array(
    'variations' => array(
        'fields' => array(
            array(
                'name' => 'variationgroups.value',
                'type' => 'select',
            ),
            array(
                'name' => 'customidentifier',
                'type' => 'ajax',
            ),
        ),
    ),
    'variationmatching' => array(
        'type' => 'ajaxfieldset',
        'legend' => array(
            'template' => 'two-columns',
        ),
        'field' => array(
            'name' => 'variationmatching',
            'type' => 'ajax',
        ),
    ),
    'action' => array(
        'legend' => array(
            'classes' => array(
                '',
            ),
        ),
        'row' => array(
            'template' => 'action-row-row-row',
        ),
        'fields' => array(
            array(
                'name' => 'saveaction',
                'value' => 'save',
                'type' => 'submit',
                'position' => 'right',
            ),
            array(
                'name' => 'resetaction',
                'value' => 'reset',
                'type' => 'submit',
                'position' => 'left',
            ),
        ),
    ),
);
