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

/**
 * all fields include i18n directly
 */
MLSetting::gi()->add('formfields_etsy', array(
    'access.token' => array(
        'i18n' => '{#i18n:formfields_etsy__access.token#}',
        'name' => 'etsytoken',
        'type' => 'etsy_token',
    ),
    'shop.language' => array(
        'i18n' => '{#i18n:formfields_etsy__shop.language#}',
        'name' => 'shop.language',
        'type' => 'select',
    ),
    'shop.currency' => array(
        'i18n' => '{#i18n:formfields_etsy__shop.currency#}',
        'name' => 'currency',
        'type' => 'select',
    ),
    'prepare.whomade' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare.whomade#}',
        'name' => 'whomade',
        'type' => 'select',
        'values' => '{#i18n:formfields_etsy__whomade__values#}',
    ),
    'prepare.whenmade' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare.whenmade#}',
        'name' => 'whenmade',
        'type' => 'select',
        'values' => '{#i18n:formfields_etsy__whenmade__values#}',
    ),
    'prepare.issupply' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare.issupply#}',
        'name' => 'issupply',
        'type' => 'select',
        'values' => '{#i18n:formfields_etsy__issupply__values#}',
    ),
    'prepare.language' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare.language#}',
        'name' => 'lang',
        'type' => 'select',
    ),
    'prepare.imagesize' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare.imagesize#}',
        'name' => 'imagesize',
        'type' => 'select',
        'default' => 1000,
    ),
    'shippingprofile' => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofile#}',
        'name' => 'shippingprofile',
        'type' => 'select',
    ),
    'category' => array(
        'i18n' => '{#i18n:formfields_etsy__category#}',
        'name' => 'category',
        'type' => 'etsy_categories',
        'subfields' => array(
            'primary' => array('name' => 'primarycategory', 'type' => 'categoryselect', 'cattype' => 'marketplace'),
        ),
    ),
    'prepare_price' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare_price#}',
        'name' => 'price',
        'type' => 'hidden',
    ),
    'prepare_quantity' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare_quantity#}',
        'name' => 'quantity',
        'type' => 'hidden',
    ),
    'shippingprofiletitle'             => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofiletitle#}',
        'name' => 'shippingprofiletitle',
        'type' => 'string',
    ),
    'shippingprofileorigincountry'     => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofileorigincountry#}',
        'name' => 'shippingprofileorigincountry',
        'type' => 'select',
    ),
    'shippingprofiledestinationcountry'=> array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofiledestinationcountry#}',
        'name' => 'shippingprofiledestinationcountry',
        'type' => 'select',
    ),

    'shippingprofiledestinationregion'=> array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofiledestinationregion#}',
        'name' => 'shippingprofiledestinationregion',
        'type' => 'select',
    ),
    'shippingprofileprimarycost'       => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofileprimarycost#}',
        'name' => 'shippingprofileprimarycost',
        'type' => 'string',
    ),
    'shippingprofilesecondarycost'     => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofilesecondarycost#}',
        'name' => 'shippingprofilesecondarycost',
        'type' => 'string',
    ),
    'shippingprofileminprocessingtime' => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofileminprocessingtime#}',
        'name' => 'shippingprofileminprocessingtime',
        'type' => 'string',
    ),
    'shippingprofilemaxprocessingtime' => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofilemaxprocessingtime#}',
        'name' => 'shippingprofilemaxprocessingtime',
        'type' => 'string',
    ),
    'shippingprofilemindeliverydays'   => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofilemindeliverydays#}',
        'name' => 'shippingprofilemindeliverydays',
        'type' => 'string',
    ),
    'shippingprofilemaxdeliverydays'   => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofilemaxdeliverydays#}',
        'name' => 'shippingprofilemaxdeliverydays',
        'type' => 'string',
    ),
    'shippingprofileoriginpostalcode'  => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofileoriginpostalcode#}',
        'name' => 'shippingprofileoriginpostalcode',
        'type' => 'string',
    ),
    'shippingprofilesend'              => array(
        'i18n' => '{#i18n:formfields_etsy__shippingprofilesend#}',
        'name' => 'shippingprofilesend',
        'type' => 'etsy_shippingprofilesave',
    ),
    'fixed.price'                       => array(
        'i18n'      => '{#i18n:formfields_etsy__fixed.price#}',
        'name'      => 'fixed.price',
        'type'      => 'subFieldsContainer',
        'subfields' => array(
            'addkind' => array(
                'name' => 'price.addkind',
                'i18n' => '{#i18n:formfields_etsy__fixed.price.addkind#}',
                'type' => 'select'
            ),
            'factor' => array(
                'name' => 'price.factor',
                'i18n' => '{#i18n:formfields_etsy__fixed.price.factor#}',
                'type' => 'string'
            ),
            'signal' => array(
                'name' => 'price.signal',
                'i18n' => '{#i18n:formfields_etsy__fixed.price.signal#}',
                'type' => 'string'
            ),
        ),
    ),
    'prepare_title' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare_title#}',
        'name' => 'Title',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_description' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare_description#}',
        'name' => 'Description',
        'type' => 'text',
        'singleproduct' => true,
    ),
    'prepare_image' => array(
        'i18n' => '{#i18n:formfields_etsy__prepare_image#}',
        'name' => 'Image',
        'type' => 'imagemultipleselect',
        'singleproduct' => true,
    ),
    'prepare_variationgroups' => array(
        'label' => '{#i18n:formfields_etsy__prepare_variationgroups#}',
        'name' => 'variationgroups',
        'type' => 'etsy_categories',
        'subfields' => array(
            'variationgroups.value' => array(
                'name' => 'variationgroups.value',
                'type' => 'categoryselect',
                'cattype' => 'marketplace',
                'value' => null,
            ),
        ),
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

    'orderstatus.shipping' => array(
        'i18n' => '{#i18n:formfields_etsy__orderstatus.shipping#}',
        'name' => 'orderstatus.shipping',
        'type' => 'selectwithtmatchingoption',
        'subfields' => array(
            'select' => '{#setting:formfields_etsy__orderstatus.shipping.select#}',
            'matching' => '{#setting:formfields_etsy__orderstatus.shipping.duplicate#}'
        ),
    ),

    'orderstatus.shipping.select' => array(
        'i18n' => array('label' => '',),
        'name' => 'orderstatus.shipping.select',
        'required' => true,
        'matching' => 'sendCarrierMatching', //must be the same as value defined in ConfigData key value for matching
        'type' => 'am_attributesselect'
    ),

    'orderstatus.shipping.duplicate' => array(
        'i18n' => array('label' => '', ),
        'name' => 'orderstatus.shipping.duplicate',
        'norepeat_included' => true,
        'type' => 'duplicate',
        'duplicate' => array(
            'field' => array(
                'type' => 'subFieldsContainer'
            )
        ),
        'subfields' => array(
            array(
                'i18n'        => array('label' => ''),
                'name'        => 'orderstatus.shipping.matching',
                'breakbefore' => true,
                'type'        => 'matchingcarrier',
                'cssclasses'  => array('tableHeadCarrierMatching')
            ),
        ),
    ),
));


MLSetting::gi()->{'formgroups__orderimport__fields__orderimport.paymentmethod'} = array(
    'i18n'      => '{#i18n:formfields__orderimport.paymentmethod#}',
    'name'      => 'orderimport.paymentmethod',
    'type'      => 'selectwithtextoption',
    'subfields' => array(
        'select' => array('name' => 'orderimport.paymentmethod', 'type' => 'select'),
        'string' => array('name' => 'orderimport.paymentmethod.name', 'type' => 'string', 'default' => '{#setting:currentMarketplaceName#}',)
    ),
    'expert'    => true,
);
MLSetting::gi()->{'formgroups__orderimport__fields__orderimport.shippingmethod'} = array(
    'i18n'      => '{#i18n:formfields__orderimport.shippingmethod#}',
    'name'      => 'orderimport.shippingmethod',
    'type'      => 'selectwithtextoption',
    'subfields' => array(
        'select' => array('name' => 'orderimport.shippingmethod', 'type' => 'select'),
        'string' => array('name' => 'orderimport.shippingmethod.name', 'type' => 'string', 'default' => '{#setting:currentMarketplaceName#}',)
    ),
    'expert'    => true,
);
