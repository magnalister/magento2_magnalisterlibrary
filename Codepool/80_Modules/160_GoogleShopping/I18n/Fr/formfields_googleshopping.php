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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
// example for overwriting global element
MLI18n::gi()->add('formfields__quantity', array('help' => 'As stock {#setting:currentMarketplaceName#} supports only "availible" or "not availible".<br />Here you can define how the threshold for availible items.'));
MLI18n::gi()->add('formfields__stocksync.frommarketplace', array('help' => '
     <b>Note</b>: {#setting:currentMarketplaceName#} knows only "available" or "not available". Therefore:<br>
    <br>
    <ul>
        <li>Shop&apos;s stock quantity  &gt; 0 = available on {#setting:currentMarketplaceName#}</li>
        <li>Shop&apos;s stock quantity  &lt; 0 = not available on {#setting:currentMarketplaceName#}</li>
    </ul>
    <br>
    Function:<br>
    Automatic Synchronization by CronJob (recommended)<br>
    <br>
    <br>
    The function "Automatic Synchronisation by CronJob" equalizes the current {#setting:currentMarketplaceName#}-stock with the shop-stock every 4 hours.*<br>
    <br>
    <br>
    By this procedure, the database values are checked for changes. The new data will be submitted, also when the changes have been set by an inventory management system.<br>
    <br>
    You can manually synchronize stock changes, by clicking the assigned button in the magnalister-header, next left to the ant-logo.<br>
    <br>
    Additionally, you can synchronize stock changes, by setting a own cronjob to your following shop-link:<br>    <i>{#setting:sSyncInventoryUrl#}</i><br>
    <br>
    Setting an own cronjob is permitted for customers within the service plan "Flat", only.<br>
    Own cronjob-calls, exceeding a quarter of an hour, or calls from customers, who are not within the service plan "Flat", will be blocked.<br>
    <br>
    <br>
    <br>
    <b>Note:</b>Settings in "Configuration" + "Listing Process" ...<br>
    <br>
    + "order limit per day"
    + "quantity"  for the first two options.<br><br>... will be considered.
'));

MLI18n::gi()->add('formfields__maxquantity', array(
    'label' => 'Orderlimit for one Day',
    'help' => '
        Order limit per day for direct-buy<br />
        <br />
        Here you can define, how many items per day you allow to be sold via googleshopping direct-buy. Without this indication, your item will remain available in direct-buy until you delete the listing or change any settings.<br />
        <br />
        Please note: This is not your item stock. This is a daily limit defined for googleshopping direct buy.<br />
        <br />
        Hint:<br />
        Settings made in function "Shop Stock" will be taken into consideration as soon as you configured a value.<br />
        In case you chose "General (from right field)", the daily limit field will not take effect.
    ',
));


MLI18n::gi()->add('formfields_googleshopping', array(
    'googleshoppingtoken' => array(
        'label' => '{#setting:currentMarketplaceName#} Direct-Buy Token',
        'help' => '
            SIf you want to use {#setting:currentMarketplaceName#}-direct-buy insert your token here. Without valid token direct-buy functionality are disabled.<br />
            <br />
            Delete the token for disable direct-buy.
        '
    ),
    'shippingcountry' => array(
        'label' => 'Shipping to',
    ),
    'shippingmethodandcost' => array(
        'label' => 'Shipping Cost',
        'help' => 'Please specify the default shipping costs here. You can then adjust the values for the chosen items in the item preparation form.',
    ),
    'shippingcostmethod' => array(
        'values' => array(
            '__ml_lump' => MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_LUMP,
            '__ml_weight' => 'Shipping cost = Product weight',
        ),
    ),
    'shippingtemplatecountry' => array(
        'label' => 'Delivery Country',
        'help' => 'The country where the products are purchased and delivered. This should match the target country of the feed and may not necessarily be where the order is shipped from or where your business is based.',
        'values' => array(
            'de' => 'Germany',
            'en' => 'United Kingdom',
            'us' => 'United State Of America'
        )
    ),
    'subheader.shipping' => array(
        'label' => 'Create new shipping service',
    ),
    'shippingtemplateprimarycost' => array(
        'label' => 'Shipping price',
        'help' => 'The shipping fee',
    ),
    'shippingtemplatesecondarycost' => array(
        'label' => 'Secondary cost',
        'help' => 'The shipping fee for this item, if shipped with another item',
    ),
    'shippingtemplatesend' => array(
        'label' => 'Save shipping template',
    ),
    'shippingtemplatetitle' => array(
        'label' => 'Name',
        'help' => 'The name of the shipping service that is being created. Choose a descriptive name that will allow you to quickly identify the selected service. A name can only be used once in your Shipping settings.'
    ),
    'shippingtemplatecurrencyvalue'=> array(
        'label' => 'Currency',
        'help' => 'The currency that\'s used to define the shipping service rate. The currency will apply to offers in the target country for this shipping service.',
        'values' => array(
            'EUR' => 'EUR',
            'GBP' => 'GBP',
            'USD' => 'USD'
        )
    ),
    'shippingtemplatetime' => array(
        'label' => 'Delivery time',
        'help' => 'The expected shipping transit time. This may vary based on the shipping parameters and product types.',
        'values' => array(
            '1-2' => '1-2 days',
            '2-3' => '2-3 days',
            '3-5' => '3-5 days',
            '4-6' => '4-6 days',
        ),
    ),
    'paymentmethod' => array(
        'label' => 'Payment Methods',
        'help' => '
            Select here the default payment methods for comparison shopping portal and direct-buy (multi selection is possible).<br />
            You can change these payment methods during item preparation.<br />
            <br />
            <strong>Caution:</strong> {#setting:currentMarketplaceName#} exclusively accepts PayPal, Sofortüberweisung and credit card as payment methods for direct-buy.',
        'values' => array(
            'Direktkauf & Suchmaschine:' => array(
                'PAYPAL' => 'PayPal',
                'CREDITCARD' => 'Credit Card',
                'SOFORT' => 'Sofort&uuml;berweisung'
            ),
            'Nur Suchmaschine:' => array(
                'PRE' => 'payment in advance',
                'COD' => 'cash on delivery',
                'BANKENTER' => 'bank enter',
                'BILL' => 'bill',
                'GIROPAY' => 'Giropay',
                'CLICKBUY' => 'Click&Buy',
                'SKRILL' => 'Skrill'
            ),
        ),
    ),
    'access.clientid' => array(
        'label' => 'E-mail',
    'help' => 'Insert your Google email account to get Google Shopping authorization',
    ),
    'access.token' => array(
        'label' => 'Google Shopping Token',
    ),
    'shop.language' => array(
        'label' => 'GoogleShopping Language',
        'values' => array(
            'de' => 'Deutsch',
            'en' => 'English',
            'es' => 'Español',
            'fr' => 'Français',
            'it' => 'Italiano',
            'ja' => '日本語',
            'nl' => 'Nederlands',
            'pl' => 'Polski',
            'pt' => 'Português',
            'ru' => 'Русский',
        ),
    ),
    'shop.currency' => array(
        'label' => 'GoogleShopping Currency',
        'values' => array(
            'EUR' => '€ Euro',
            'USD' => '$ United States Dollar',
            'CAD' => '$ Canadian Dollar',
            'GBP' => '£ British Pound',
            'AUD' => '$ Australian Dollar',
            'DDK' => 'kr Danish Krone',
            'HKD' => '$ Hong Kong Dollar',
            'NZD' => '$ New Zealand Dollar',
            'NOK' => 'kr Norwegian Krone',
            'SGD' => '$ Singapore Dollar',
            'SEK' => 'kr Swedish Krona',
            'CHF' => 'Swiss Franc',
            'TWD' => 'NT$ Taiwan New Dollar',
        ),
    ),
    'prepare.imagesize' => array(
        'label' => 'Image size',
    ),
    'fixed.price' => array(
        'label' => 'Price',
        'help' => 'Please enter a price markup or markdown,
	     either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.'
    ),
    'fixed.price.addkind' => array(
        'label' => '',
    ),
    'fixed.price.factor' => array(
        'label' => '',
    ),
    'fixed.price.signal' => array(
        'label' => 'Decimal Amount',
        'hint' => 'Decimal Amount',
        'help' => 'This textfield shows the decimal value that will appear in the item price on GoogleShopping.'
    ),
    'fixed.custom1name' => array(
        'label' => 'Name',
        'hint' => 'Name of Custom Attribute',
        'help' => 'Name of Custom Attribute',
    ),
    'fixed.custom1type' => array(
        'label' => 'Type',
        'hint' => 'The type of the Attribute.',
        'help' => 'Acceptable values are: boolean, datetimerange, float, group, int, price, text, time, url'
    ),
    'fixed.custom1value' => array(
        'label' => 'Value',
        'hint' => 'The value of the attribute.',
        'help' => 'The value of the attribute.',
    ),
    'customattribute1' => array(
        'label' => 'Custom Attribute',
        'help' => 'If you want to add for example size, color, pattern ...'
    ),
    'prepare.language' => array(
        'label' => 'Language',
    ),
    'shippingtemplate' => array(
        'label' => 'Default shipping template',
        'help' => 'This is default shipping template',
        'hint' => '<button id="shippingtemplateajax" style="background-color: #E31A1C; border:0; color:white; width:25px;height:25px;">+</button>'
    ),
    'shippingtemplateprepare' => array(
        'label' => 'Default shipping template',
       'help' => 'This is default shipping template',
    ),
    'shippingmethod' => array(
        'label' => 'Shipping Methods'
    ),
    'shippingtime' => array(
        'label' => 'Shipping Time',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'use from configuration',
            ),
        )
    ),
    'shippingtimetype' => array(
        'label' => 'Delivery time',
        'help' => 'The expected shipping transit time. This may vary based on the shipping parameters and product types.',
        'values' => array(
            'immediately' => 'immediately',
            '1-2' => '1-2 days',
            '2-3' => '2-3 days',
            '3-5' => '3-5 days',
            '4-6' => '4-6 days',
        ),
    ),
    'shippingtimeproductfield' => array(
        'label' => 'Shipping Time (matching)',
    ),
    'prepare_title' => array(
        'label' => 'Title',
    ),
    'prepare_description' => array(
        'label' => 'Description',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Use always product description from web-shop',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Product Images',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Use always product image from web-shop',
            ),
        )
    ),
    'prepare_brand' => array(
        'label' => 'Product Brand'
    ),
    'prepare_channel' => array(
        'label' => 'Channel'
    ),
    'prepare_condition' => array(
        'label' => 'Condition'
    ),
    'prepare_link' => array(
        'label' => 'Link'
    ),
    'prepare_availability' => array(
        'label' => 'Availability'
    ),
    'prepare_targetCountry' => array(
        'label' => 'Target Country',
        'help' => 'Target country market for items.',
    ),
    'prepare_targetCountry_DE' => 'Germany',
    'prepare_targetCountry_GB' => 'United Kingdom',
    'prepare_targetCountry_US' => 'United States',
    'prepare_targetCountry_FR' => 'France',
    'prepare_targetCountry_BR' => 'Brasil',
    'prepare_targetCountry_JP' => 'Japan',
    'prepare_contentLanguage' => array(
        'label' => 'Content Language',
        'help' => 'The language used to show content on Google Shopping store.',
    ),
    'category' => array(
        'label' => 'Category',
    ),
    'marketplace_category' => array(
        'label' => 'Marketplace Category',
    ),
    'prepare_price' => array(
        'label' => 'Price',
    ),
    'orderstatus.cancelreason' => array(
        'label' => 'Cancel Order Reason',
        'help' => 'Please select the default cancellation reason'
    ),
    'orderstatus.cancelcomment' => array(
        'label' => 'Cancel Order Comment',
    ),
));
