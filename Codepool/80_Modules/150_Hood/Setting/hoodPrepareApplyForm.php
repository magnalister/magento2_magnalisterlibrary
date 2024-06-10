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

MLSetting::gi()->hood_prepare_apply_form = array(
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
            ),
            array(
                'name' => 'manufacturer',
                'type' => 'string',
                'singleproduct' => true,
            ),
            array(
                'name' => 'manufacturerpartnumber',
                'type' => 'string',
                'singleproduct' => true,
            ),
            array(
                'name' => 'images',
                'singleproduct' => true,
            ),
            array(
                'name' => 'shortdescription',
                'type' => 'text',
                'singleproduct' => true,
            ),
            array(
                'singleproduct' => true,
                'name' => 'description',
                'type' => 'wysiwyg',
                'fullwidth' => true,
            ),
        )
    ),
    'auction' => array(
        'fields' => array(
            array(
                'name' => 'listingType',
            ),
            array(
                'name' => 'ListingDuration',
            ),
            array(
                'name' => 'PaymentMethods',
                'type' => 'multipleselect',
            ),
            array(
                'name' => 'conditiontype',
                'type' => 'select',
            ),
            array(
                'name' => 'startTime',
            ),
            array(
                'name' => 'noIdentifierFlag',
            ),
            array(
                'name' => 'age',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    array('name' => 'fsk', 'type' => 'select'),
                    array('name' => 'usk', 'type' => 'select'),
                )
            ),
            array(
                'name' => 'features',
                'type' => 'hood_features',
            ),
        )
    ),
    'categories' => array(
        'fields' => array(
            array(
                'name' => 'categories',
                'type' => 'categoryselect',
                'subfields' => array(
                    'primarycategory' => array('name' => 'primarycategory', 'type' => 'categoryselect', 'cattype' => 'marketplace'),
                    'secondarycategory' => array('name' => 'secondarycategory', 'type' => 'categoryselect', 'cattype' => 'marketplace'),
                    'storecategory' => array('name' => 'storecategory', 'type' => 'categoryselect', 'cattype' => 'store'),
                    'storecategory2' => array('name' => 'storecategory2', 'type' => 'categoryselect', 'cattype' => 'store'),
                    'storecategory3' => array('name' => 'storecategory3', 'type' => 'categoryselect', 'cattype' => 'store'),
                ),
            ),
        ),
    ),
    'Shipping' => array(
        'fields' => array(

            array(
                'name' => 'shippinglocalcontainer',
                'type' => 'hood_shippingcontainer'
            ),
            array(
                'name' => 'shippinginternationalcontainer',
                'type' => 'hood_shippingcontainer'
            ),
        )
    ),
);
