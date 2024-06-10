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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->metro_config_general_autosync = 'Automatic synchronization with CronJob (recommended)';
MLI18n::gi()->metro_config_general_nosync = 'No synchronization';
MLI18n::gi()->metro_config_account_title = 'Access Data';
MLI18n::gi()->metro_config_account_prepare = 'Item Preparation';
MLI18n::gi()->metro_config_account_price = 'Price Calculation';
MLI18n::gi()->metro_config_account_sync = 'Price and Stock';
MLI18n::gi()->metro_config_account_orderimport = 'Orders';
MLI18n::gi()->metro_config_invoice = 'Invoices';

MLI18n::gi()->{'formfields_metro_freightforwarding_values'} = array(
    'true' => 'Yes',
    'false' => 'No',
);

MLI18n::gi()->{'formgroups_legend_quantity'} = 'Stock';

MLI18n::gi()->metro_configform_orderstatus_sync_values = array(
    'auto' => '{#i18n:metro_config_general_autosync#}',
    'no' => '{#i18n:metro_config_general_nosync#}',
);
MLI18n::gi()->metro_configform_sync_values = array(
    'auto' => '{#i18n:metro_config_general_autosync#}',
    'no' => '{#i18n:metro_config_general_nosync#}',
);
MLI18n::gi()->metro_configform_stocksync_values = array(
    'rel' => 'Bestellung reduziert Shop-Lagerbestand (empfohlen)',
    'no' => '{#i18n:metro_config_general_nosync#}',
);
MLI18n::gi()->metro_configform_pricesync_values = array(
    'auto' => '{#i18n:metro_config_general_autosync#}',
    'no' => '{#i18n:metro_config_general_nosync#}',
);

MLI18n::gi()->metro_configform_orderimport_payment_values = array(
    'textfield' => array(
        'title' => 'From text field',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Automatic allocation',
    ),
);

MLI18n::gi()->metro_configform_orderimport_shipping_values = array(
    'textfield' => array(
        'title' => 'From text field',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Automatic allocation',
    ),
);

MLI18n::gi()->add('metro_config_account', array(
    'legend' => array(
        'account' => '{#i18n:metro_config_account_title#}',
        'tabident' => 'Tab'
    ),
    'field' => array(
        'tabident' => array(
            'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
            'help' => '{#i18n:ML_TEXT_TAB_IDENT#}'
        ),
        'clientkey' => array(
            'label' => 'METRO-Client-Key',
            'help' => 'Enter the "METRO-Client-Key" here.<br>Currently, you can only request this from METRO Marketplace Seller Support. To do so, send an e-mail to: seller@metro-marketplace.eu',
        ),
        'secretkey' => array(
            'label' => 'METRO-Secret-Key',
            'help' => 'Enter the "METRO-Secret-Key" here.<br>Currently, you can only request this from METRO Marketplace Seller Support. To do so, send an e-mail to: seller@metro-marketplace.eu',
        ),
        'shippingdestination' => array(
            'label' => 'METRO Site',
            'help' => 'METRO requirement: Currently no cross border trade is possible.',
            'hint' => 'On which METRO Marketplace country should your products be sold',
        ),
        'shippingorigin' => array(
            'label' => 'Shipping from',
            'help' => 'METRO requirement: Currently no cross border trade is possible.',
            'hint' => 'From which country are your products shipped',
        ),
    ),
), false);


MLI18n::gi()->add('metro_config_prepare', array(
    'legend' => array(
        'prepare' => 'Prepare Items',
        'shipping' => 'Shipping',
        'upload' => 'Upload Items: Presets',
    ),
    'field' => array(
        'processingtime' => array(
            'label' => 'Minimum delivery time in working days',
            'help' => 'Enter here the minimum number of working days from the time the customer places the order until the parcel is received.',
        ),
        'maxprocessingtime' => array(
            'label' => 'Maximum delivery time in working days',
            'help' => 'Enter here the maximum number of working days from the time of the order by the customer until receipt of the parcel.',
        ),
        'businessmodel' => array(
            'label' => 'Determine buyer group',
            'help' => 'Assign the product to a buyer group:<br>
                <ul>
                    <li>B2C and B2B: Product is aimed at both groups of buyers</li>
                    <li>B2B: Product is aimed at commercial end customers</li>
                </ul>
                ',
        ),
        'freightforwarding' => array(
            'label' => 'Delivery by forwarding agent',
            'help' => 'Indicate whether your product will be shipped by carrier.',
        ),
        'shippingprofile' => array(
            'label' => 'Shipping costs profiles',
            'help' => 'Create your shipping costs profiles here. You can specify different shipping costs for each profile (example: 4.95) and define a standard profile. The specified shipping costs will be added to the item price when the product is uploaded, as goods can only be uploaded to the METRO Marketplace free of shipping costs.',
            'hint' => '<span style="color: red">The shipping surcharge defined here is added to the "Price calculation" (Tab: "Price and stock").</span><br><br>Please use the dot (.) as separator for decimal places.',
        ),
        'shippingprofile.name' => array(
            'label' => 'Shipping profile name',
        ),
        'shippingprofile.cost' => array(
            'label' => 'Shipping surcharge (gross)',
        ),
        'shipping.group' => array(
            'label' => 'Shipping Groups',
            'hint' => 'A specific group of shipping settings that is defined on a seller-specific basis for an offer. The Seller Shipping Group is created and managed by the seller in the shipping settings user interface.',
            'help' => 'Sellers can create a group with different shipping settings depending on their business needs and use cases. Different groups of shipping settings can be selected for different regions, with different shipping conditions and fees for each region.<br /><br />
When the seller creates a product as an offer, they can specify one of their created groups of shipping settings for that product. The shipping settings of this group are then used to display the valid shipping option for each product on the website.<br /><br />
Important: Copy the shipping group names from your METRO account into the corresponding fields here. Only these will be used. The name is only used here to display them in the product preparation.<br /><br />
For details on creating shipping groups, see <a href="https://developer.metro-selleroffice.com/docs/offer-data/shipping/" target="_blank">METRO documentation.</a>',
        ),
        'shipping.group.name' => array(
            'label' => 'Shipping Group Name',
        ),
        'shipping.group.id' => array(
            'label' => 'Shipping Group ID',
        ),
    )
), false);

MLI18n::gi()->add('formgroups_metro', array(
    'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu METRO',
));
MLI18n::gi()->{'metro_config_priceandstock__field__price.addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__price.factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__price__label'} = 'Preis';
MLI18n::gi()->{'metro_config_priceandstock__field__price__hint'} = '<span style="color: red">The shipping surcharge selected under "Item preparation" is added to the price defined here</span>';
MLI18n::gi()->{'metro_config_priceandstock__field__price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.<br><br><span style="color: red">The shipping surcharge selected under "Item preparation" is added to the price defined here</span>';
MLI18n::gi()->{'metro_config_priceandstock__field__price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'metro_config_priceandstock__field__price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on METRO.<br/><br/>
        <strong>Example:</strong> <br>
        Value in textfeld: 99 <br>
        Original price: 5.58 <br>
        Final amount: 5.99 <br><br>
        This function is useful when marking the price up or down. <br>
        Leave this field empty if you do not wish to set any decimal amount. <br>
        The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'formfields__importactive__hint'} = 'Please note: Orders from METRO Marketplace are automatically accepted upon transfer to the webshop (order import).';

MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceswebshoppriceoptionsaddkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceswebshoppriceoptionsfactor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceswebshoppriceoptionssignal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceswebshoppriceoptionssignal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2addkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2factor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2signal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2signal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3addkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3factor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3signal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3signal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4addkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4factor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4signal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4signal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5addkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5factor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5signal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5signal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceaaddkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceafactor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceasignal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceasignal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebaddkind__label'} = '{#i18n:metro_config_priceandstock__field__price.addkind__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebfactor__label'} = '{#i18n:metro_config_priceandstock__field__price.factor__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebsignal__label'} = '{#i18n:metro_config_priceandstock__field__price.signal__label#}';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebsignal__help'} = '{#i18n:metro_config_priceandstock__field__price.signal__help#}';
