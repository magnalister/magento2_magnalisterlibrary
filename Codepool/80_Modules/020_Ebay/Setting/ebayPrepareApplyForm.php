<?php
/**
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

MLSetting::gi()->ebay_prepare_apply_form = array(
    'details' => array(
        'fields' => array(
            array(
                'name' => 'title',
                'singleproduct' => true,
            ),
            array(
                'name' => 'subtitle',
                'type' => 'optional',
                'singleproduct' => true,
                'multiprepareonlyswitch' => true,
            ),
            array(
                'name' => 'descriptionContainer',
                'singleproduct' => true,
                'subfields' => array(
                    'description' => array(
                        'singleproduct' => true,
                        'name' => 'description',
                        'type' => 'wysiwyg',
                        'default' => 'template.content',
                    ),
                    'descriptionmobile' => array(
                        'singleproduct' => true,
                        'name' => 'descriptionmobile',
                        'type' => 'ebay_mobile_template',
                        'default' => 'template.mobile.content',
                    )
                ),
                'fullwidth' => true,
            ),
            array(
                'name' => 'pricecontainer',
                'singleproduct' => true,
            )
        )
    ),
    'pictures' => array(
        'fields' => array(
            array(
                'name' => 'pictureUrl',
                'singleproduct' => true,
            ),
            array(
                'name' => 'galleryType',
                'type' => 'select',
            ),
            array(
                'name' => 'variationDimensionForPictures',
            ),
            array(
                'name' => 'variationPictures',
            ),
        ),
    ),
    'mwst' => array(
        'fields' => array(
            array(
                'name' => 'mwst',
                'type' => 'string',
            ),
        ),
    ),
    'auction' => array(
        'fields' => array(
            array(
                'name' => 'site',
            ),
            array(
                'name' => 'listingType',
            ),
            array(
                'name' => 'ListingDuration',
            ),
            array(
                'name' => 'strikePrice',
                'type' => 'select',
                'multiprepareonlyswitch' => true,
            ),
            array(
                'name' => 'paymentsellerprofile',
                'type' => 'select',
                'autooptional' => false,
            ),
            array(
                'name' => 'PaymentMethods',
                'type' => 'multipleselect',
            ),
            array(
                'name' => 'ConditionID',
            ),
            array(
                'name' => 'ConditionDescriptors',
                #'type' => 'ebay_conditiondescriptors',
                #'subfields' => array(
                #    'd1' => array('label' => '', 'name' => 'conditiondescriptors.1', 'type' => 'select'),
                #    'd2' => array('label' => '', 'name' => 'conditiondescriptors.2', 'type' => 'select'),
                #    'd3' => array('label' => '', 'name' => 'conditiondescriptors.3', 'type' => 'text'),
                #)
            ),
            array(
                'name' => 'ConditionDescription',
                'type' => 'string',
            ),
            array(
                'name' => 'privateListing',
            ),
            array(
                'name' => 'bestOfferEnabled',
            ),
            array(
                'name' => 'eBayPlus',
            ),
            array(
                'name' => 'startTime',
            ),
        )
    ),
    'category' => array(
        'legend' => array('template' => 'ebay_categories'),
        'fields' => array(
            array(
                'name' => 'PrimaryCategory',
                'hint' => array(
                    'template' => 'ebay_categories'
                )
            ),
            array(
                'name' => 'SecondaryCategory',
                'hint' => array(
                    'template' => 'ebay_categories'
                )
            ),
            array(
                'name' => 'StoreCategory',
                'hint' => array(
                    'template' => 'ebay_categories'
                )
            ),
            array(
                'name' => 'StoreCategory2',
                'hint' => array(
                    'template' => 'ebay_categories'
                )
            ),
            array(
                'name' => 'variationthemeblacklist',
                'classes' => array('ml-force-hidden'),
            )
        )
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
    'Shipping' => array(
        'fields' => array(
            'shippingsellerprofile' => array(
                'name' => 'shippingsellerprofile',
                'type' => 'select',
                'autooptional' => false,
            ),
            array(
                'name' => 'shippinglocalcontainer',
                'type' => 'ebay_shippingcontainer'
            ),
            array(
                'name' => 'dispatchtimemax',
                'type' => 'select',
            ),
            array(
                'name' => 'shippinginternationalcontainer',
                'type' => 'optional',
                'optional' => array(
                    'name' => 'shippinginternational',
                    'field' => array(
                        'type' => 'ebay_shippingcontainer'
                    )
                )
            ),
        )
    ),
);

MLSetting::gi()->ebay_prepare_variations = array(
    'variations' => array(
        'fields' => array(
            array(
                'name' => 'variationgroups',
                'type' => 'ebay_categoryselect',
                'subfields' => array(
                    'variationgroups.value' => array('name' => 'variationgroups.value', 'type' => 'ebay_categoryselect', 'cattype' => ''),
                ),
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
        ),
    ),
);
