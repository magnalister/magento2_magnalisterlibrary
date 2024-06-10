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

MLSetting::gi()->check24_prepare_form=array(
    'details' => array(
        'fields' => array(
            array(
                'name' => 'shippingtime',
                'type' => 'select'
            ),
            array(
                'name' => 'shippingcost',
                'type' => 'string',
            ),
            array(
                'name' => 'delivery',
                'type' => 'selectwithtextoption',
                'subfields' => array (
                    'select' => array(
                        'name' => 'deliverymode',
                        'type' => 'select',
                        'values' => array(
                            '' => array(
                                'title' => '-',
                                'textoption' => false
                            ),
                            'Paket' => array(
                                'title' => '{#i18n:check24_deliverymode_paket#}',
                                'textoption' => false
                            ),
                            'Warensendung' => array(
                                'title' => '{#i18n:check24_deliverymode_warensendung#}',
                                'textoption' => false
                            ),
                            'Spedition' => array(
                                'title' => '{#i18n:check24_deliverymode_spedition#}',
                                'textoption' => false
                            ),
                            'Sperrgut' => array(
                                'title' => '{#i18n:check24_deliverymode_sperrgut#}',
                                'textoption' => false
                            ),
                            'EigeneAngaben' => array(
                                'title' => '{#i18n:check24_deliverymode_eigene_angaben#}',
                                'textoption' => true
                            )
                        ),
                    ),
                    'string' => array(
                        'name' => 'deliverymodetext',
                        'type' => 'string'
                    ),
                )
            ),
            array(
                'name' => 'two_men_handling',
                'type' => 'string',
            ),
            array(
                'name' => 'installation_service',
                'type' => 'select',
            ),
            array(
                'name' => 'removal_old_item',
                'type' => 'select',
            ),
            array(
                'name' => 'removal_packaging',
                'type' => 'select',
            ),
            array(
                'name' => 'available_service_product_ids',
                'type' => 'string',
            ),
            array(
                'name' => 'logistics_provider',
                'type' => 'string',
            ),
            array(
                'name' => 'custom_tariffs_number',
                'type' => 'string',
                'singleproduct' => true,
            ),
            array(
                'name' => 'return_shipping_costs',
                'type' => 'string',
            ),
        )
    )
);
