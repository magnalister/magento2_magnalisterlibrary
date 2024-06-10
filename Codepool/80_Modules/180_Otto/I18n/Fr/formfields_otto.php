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
    'prepare_title' => array(
        'label' => 'Title',
        'hint' => '',
    ),
    'prepare_description' => array(
        'label' => 'Beschreibung<span class="bull">•</span>',
        'hint' => 'Detaillierte und informative Beschreibung des Produkts mit seinen Spezifikationen und Eigenschaften. Angebotsdetails, Versand- oder Shopinformationen wie Preise, Lieferbedingungen, etc. sind nicht erlaubt. Bitte beachten Sie, dass es nur eine Produktdetailseite pro Produkt gibt, die von allen Verkäufern, die dieses Produkt anbieten, geteilt wird. Fügen Sie keine Hyperlinks, Bilder oder Videos hinzu.<br><br>May contain HTML elements<br><br>Maximal 2000 Zeichen',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Produktbilder<span class="bull">•</span>',
        'hint' => 'A minimum of 1 product images',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'processingtime' => array(
        'label' => 'Bearbeitungszeit in Werktagen',
        'hint' => 'Tragen Sie hier ein, wie viele Werktagen Sie zur Bearbeitung der Bestellung brauchen (vom Bestelleingang bis zum Versand der Ware).',
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
        'label' => 'Statut des commandes “en cours” dans la boutique',
        'help' => '
            <p>Le statut OTTO Market “en cours” signifie que la commande a été payée et qu’elle peut donc être expédiée. Sélectionnez ici le statut que les commandes “en cours” doivent recevoir dans votre boutique.</p>
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
            Sélectionnez ici, le statut boutique, qui transmettra automatiquement le statut "Commande annulée" à l\'{#setting:currentMarketplaceName#}.<br />
            <br />
            Remarque: Dans le cadre de commandes groupées, l\'annulation partielle n\'est pas possible. Cette fonction annulera toute la commande.
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
    'orderstatus.carrier' => array(
        'label' => '&nbsp;&nbsp;&nbsp;&nbsp;Spediteur',
        'help' => 'Vorausgew&auml;hlter Spediteur beim Best&auml;tigen des Versandes nach OTTO Market.',
    ),
    'orderstatus.standardshipping' => array(
        'label' => 'Send Carrier Option',
        'hint' => 'OTTO.de only allows certain carriers.Please make sure to provide valid data only.'
    ),
    'orderstatus.forwardershipping' => array(
        'label' => 'Forwarding Carrier Option',
        'hint' => 'OTTO.de only allows certain carriers.Please make sure to provide valid data only.'
    ),
    'orderstatus.shippedaddress' => array(
        'label' => 'Confirm Shipping and \'From\' Address',
        'help' => 'Confirm Shipping status and the warehouse or location from which the shipment will be picked up for final delivery.'
    ),
    'orderstatus.shippedaddress.city' => array(
        'label' => 'City'
    ),
    'orderstatus.shippedaddress.code' => array(
        'label' => 'Country Code'
    ),
    'orderstatus.shippedaddress.zip' => array(
        'label' => 'ZIP Code'
    ),
    'orderstatus.shippedaddress.status' => array(
        'label' => 'Order Status'
    ),
    'orderstatus.carrier' => array(
        'label' => 'Carrier',
        'help' => 'Pre-selected freight forwarder confirming shipment to OTTO Market.',
    ),
    'customfield.carrier' => array(
        'label' => 'Carrier'
    ),
    'return.carrier' => array(
        'label' => 'Return Carrier Option',
        'hint' => 'OTTO.de only allows certain carriers.Please make sure to provide valid data only.'
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
            'label' => 'Marktplatz-Kategorie<span class="bull">•</span>',
            'hint' => '',
        ),
        'variationgroups.value' => array(
            'label' => 'Marktplatz-Kategorie:',
        ),
    ),
), false);
