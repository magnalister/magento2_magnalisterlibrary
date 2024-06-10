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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLSetting::gi()->ricardo_prepare_form = array(
    'language' => array(
        'fields' => array(
            array(
                'name' => 'listinglangs',
                'type' => 'checkboxforlangs',
                'isdynamic' => 'true',
            ),
        ),
    ),
    'details' => array(
        'fields' => array(
            array(
                'name' => 'detitle',
                'type' => 'string',
                'singleproduct' => true,
            ),
            array(
                'name' => 'desubtitle',
                'type' => 'optional',
                'singleproduct' => true,
                'multiprepareonlyswitch' => true,
            ),
            array(
                'name' => 'dedescription',
                'type' => 'wysiwyg',
                'singleproduct' => true,
            ),
            array(
                'name' => 'frtitle',
                'type' => 'string',
                'singleproduct' => true,
            ),
            array(
                'name' => 'frsubtitle',
                'type' => 'optional',
                'singleproduct' => true,
                'multiprepareonlyswitch' => true,
            ),
            array(
                'name' => 'frdescription',
                'type' => 'wysiwyg',
                'singleproduct' => true,
            ),
            array(
                'name' => 'images',
                'type' => 'imagemultipleselect',
                'singleproduct' => true,
            ),
        ),
    ),
    'templates' => array(
        'fields' => array(
            array(
                'name' => 'descriptiontemplate',
                'type' => 'select',
            ),
        ),
    ),
    'categories' => array(
        'fields' => array(
            array(
                'name' => 'categories',
                'type' => 'categoryselect',
                'subfields' => array(
                    'primary' => array('name' => 'primarycategory', 'type' => 'categoryselect', 'cattype' => 'marketplace'),
                ),
            ),
        ),
    ),
    'price' => array(
        'fields' => array(
            array(
                'name' => 'buyingmode',
                'type' => 'select',
            ),
            array(
                'name' => 'price',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'fixpriceajax' => array('name' => 'fixpriceajax', 'type' => 'ajax'),
                    'enablebuynowpriceajax' => array('name' => 'enablebuynowpriceajax', 'type' => 'ajax'),
                    'priceajax' => array('name' => 'priceajax', 'type' => 'ajax'),
                )
            ),
            array(
                'name' => 'startdate',
                'type' => 'startdate'
            ),
            array(
                'name' => 'durationcontainer',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'duration' => array('name' => 'duration', 'type' => 'select'),
                    'endtime' => array(
                        'name' => 'endtime',
                        'type' => 'subFieldsContainer',
                        'subfields' => array(
                            'enddate' => array('name' => 'enddate', 'type' => 'enddate'),
                        ),
                    ),
                )
            ),
            array(
                'name' => 'maxrelistcountcontainer',
                'type' => 'subFieldsContainer',
                'subfields' => array('maxrelistcount' => array('name' => 'maxrelistcount', 'type' => 'ajax',),
                )
            ),
            array(
                'name' => 'payment',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'paymentmethods' => array(
                        'name' => 'paymentmethods',
                        'type' => 'multipleselect'
                    ),
                    'paymentmethodsajax' => array(
                        'name' => 'paymentmethodsajax',
                        'type' => 'ajax'
                    ),
                )
            ),
        ),
    ),
    'shipping' => array(
        'fields' => array(
            array(
                'name' => 'delivery',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'deliverycondition' => array(
                        'name' => 'deliverycondition',
                        'type' => 'ajax',
                    ),
                    'deliveryconditionajax' => array(
                        'name' => 'deliveryconditionajax',
                        'type' => 'ajax'
                    ),
                    'deliverycost' => array(
                        'name' => 'deliverycost',
                        'type' => 'price',
                        'currency' => 'CHF'
                    ),
                    'cumulative' => array(
                        'name' => 'cumulative',
                        'type' => 'bool',
                    ),
                )
            ),
            array(
                'name' => 'availabilitycontainer',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    array('name' => 'availability', 'type' => 'select'),
                ),
            ),
        ),
    ),
    'promotion' => array(
        'fields' => array(
            array(
                'name' => 'firstpromotion',
                'type' => 'select',
            ),
            array(
                'name' => 'secondpromotion',
                'type' => 'select',
            ),
        ),
    ),
    'other' => array(
        'fields' => array(
            array(
                'name' => 'articlecondition',
                'type' => 'select',
            ),
            array(
                'name' => 'warranty',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'warrantycondition' => array(
                        'name' => 'warrantycondition',
                        'type' => 'select',
                    ),
                    'warrantyconditionajax' => array(
                        'name' => 'warrantyconditionajax',
                        'type' => 'ajax'
                    ),
                )
            ),
        ),
    ),
);
