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

MLI18n::gi()->add('formfields_otto', array(
    'vat' => array(
        'label' => 'VAT',
        'hint' => ''
    ),
    'lang' => array(
        'label' => 'Language',
        'hint' => ''
    ),
    'imagesize' => array(
        'label' => 'Image Size',
        'hint' => ''
    ),
    'delivery' => array(
        'label' => 'Delivery'
    ),
    'deliverytype' => array(
        'label' => 'Delivery type'
    ),
    'deliverytime' => array(
        'label' => 'Delivery time in days'
    ),
    'provider' => array(
        'label' => 'Provider'
    ),
    'prepare_title' => array(
        'label' => 'Title',
        'hint' => '',
    ),
    'prepare_description' => array(
        'label' => 'Description<span class="bull">•</span>',
        'hint' => 'Detailed and informative description of the product with its specifications and properties. Offer details, shipping or shop information such as prices, delivery conditions, etc. are not allowed. Please note that there is only one product detail page per product that is shared by all sellers who offer this product. Do not add hyperlinks, images, or videos.<br><br>May contain HTML elements<br><br>A maximum of 2000 characters',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Always use the latest from the web shop',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Product images<span class="bull">•</span>',
        'hint' => 'A minimum of 1 product images',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Always use the latest from the web shop',
            ),
        )
    ),
    'processingtime' => array(
        'label' => 'Processing time in working days',
        'hint' => 'Enter here how many working days you need to process the order (from the receipt of the order to the dispatch of the goods).',
    ),
    'shippingtype' => array(
        'label' => 'Shipping type',
        'help' => 'Enter witch shipping type. Available values PARCEL and FORWARDER',
    ),
    'freightforwarding' => array(
        'label' => 'Lieferung per Spedition',
        'hint' => 'Geben Sie an, ob Ihr Produkt per Spedition versendet wird.',
    ),
    'orderstatus.open' => array(
        'label' => 'Processable Order Status (Webshop)',
        'help' => '
            <p>The OTTO Market order status „processable" means that the Buyer has already paid for the items. It can therefore be shipped without risk.</p>
            <p>Select the corresponding shop order status that an imported OTTO Market order with the status „processable" should receive.</p>
        ',
    ),
    'orderimport.paymentstatus' => array(
        'label' => 'Payment Status (Webshop)',
        'help' => '<p>OTTO Market does not assign any shipping method to imported orders.</p>
            <p>Please choose here the available Web Shop shipping methods. The contents of the drop-down menu can be assigned in Shopware > Settings > Shipping Costs.</p>
            <p>This setting is important for bills and shipping notes, the subsequent processing of the order inside the shop, and for some ERPs.</p>'
    ),
    'orderstatus.canceled' => array(
        'label' => 'Confirm Canceled with',
        'help' => '
            Here you set the shop status which will set the {#setting:currentMarketplaceName#} order status to „cancel order“. <br/><br/>
            Note: partial cancellation is not possible in this setting. The whole order will be cancelled with this function und credited tot he customer
        '
    ),
    'orderstatus.shipping' => array(
        'label' => 'Confirm Shipping with',
        'help' => 'Here you set the shop status which will set the {#setting:currentMarketplaceName#} order status to „shipped order“.'
    ),
    'paymentmethods' => array(
        'label' => 'Payment Methods',
        'help' => 'Payment method that will apply to all orders imported from OTTO Market. Standard: "OTTO Market"<br><br>
            This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.'
    ),
    'shippingservice' => array(
        'label' => 'Shipping Service',
        'help' => 'Shipping methods that will be assigned to all OTTO Market orders. Standard: "Marketplace"<br><br>
            This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.'
    ),
    'orderstatus.standardshipping' => array(
        'label' => 'Send Carrier Option',
        'hint' => 'OTTO Market only allows certain carriers. Please make sure to provide valid data only.'
    ),
    'orderstatus.forwardershipping' => array(
        'label' => 'Forwarding Carrier Option',
        'hint' => 'OTTO Market only allows certain carriers. Please make sure to provide valid data only.'
    ),
    //Do not change translation keys
    'orderstatus.shippedaddress' => array(
        'label' => 'Confirm Shipping and \'From\' Address',
        'help' => 'Confirm Shipping status and the warehouse or location from which the shipment will be picked up for final delivery.'
    ),
    //Do not change translation keys
    'orderstatus.shippedaddress.city' => array(
        'label' => 'City'
    ),
    'orderstatus.shippedaddress.code' => array(
        'label' => 'Country Code'
    ),
    //Do not change translation keys
    'orderstatus.shippedaddress.zip' => array(
        'label' => 'ZIP Code'
    ),
    'orderstatus.shippedaddress.status' => array(
        'label' => 'Order Status'
    ),
    'orderstatus.carrier' => array(
        'label' => 'Carrier',
        'help' => 'Pre-selected freight forwarder confirming shipment to OTTO.',
    ),
    'customfield.carrier' => array(
        'label' => 'Carrier'
    ),
    'return.carrier' => array(
        'label' => 'Return Carrier Option',
        'hint' => 'OTTO Market only allows certain carriers. Please make sure to provide valid data only.'
    ),
    'return.trackingkey' => array(
        'label' => 'Return Tracking Key Option',
    ),
    'trackingkey' => array(
        'label' => 'Send Tracking Key Option',
    ),
    'customfield.trackingnumber' => array(
        'label' => 'Tracking number'
    ),
));

MLI18n::gi()->add('otto_prepare_form', array(
    'field' => array(
        'variationgroups' => array(
            'label' => 'Marketplace-Category<span class="bull">•</span>',
            'hint' => '',
        ),
        'variationgroups.value' => array(
            'label' => 'Marketplace-Category:',
        ),
    ),
), false);
