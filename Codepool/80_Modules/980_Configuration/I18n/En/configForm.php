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

MLI18n::gi()->add('configuration', array(
    'legend' => array(
        'general' => 'General Settings',
        'sku' => 'Synchronize Number Ranges',
        'stats' => 'Statistics',
        'orderimport' => 'Order Import',
        'crontimetable' => 'Miscellaneous',
        'articlestatusinventory' => 'Inventory',
        'productfields' => 'Product attributes',
    ),
    'field' => array(
        'general.passphrase' => array(
            'label' => 'PassPhrase',
            'help' => 'You will receive your PassPhrase after Registration at www.magnalister.com.',
        ),
        'general.keytype' => array(
            'label' => 'Please Select',
            'help' => 'Depending on the selection, either the shop item number or the shop product ID will determine the item number in the marketplace (SKU).<br/><br/>
This setting matches the shop item to the marketplace item, which is necessary for stock management systems to function.<br/><br/>
Please note! The synchronization of stocks and prices is dependent on this setting. Please don\'t change this setting if you have already uploaded items via magnalister. Otherwise, the synchronization won\'t work for older items.',
            'values' => array(
                'pID' => 'Product ID (Shop) = SKU (Marketplace)<br>',
                'artNr' => 'Item number (Shop) = SKU (Marketplace)'
            ),
            'alert' => array(
                'pID' => '{#i18n:sChangeKeyAlert#}',
                'artNr' => '{#i18n:sChangeKeyAlert#}'
            ),
        ),
        'general.stats.backwards' => array(
            'label' => 'Since',
            'help' => 'From how long ago should the statistics be shown?',
            'values' => array(
                '0' => '1 month ago',
                '1' => '2 months ago',
                '2' => '3 months ago',
                '3' => '4 months ago',
                '4' => '5 months ago',
                '5' => '6 months ago',
                '6' => '7 months ago',
                '7' => '8 months ago',
                '8' => '9 months ago',
                '9' => '10 months ago',
                '10' => '11 months ago',
                '11' => '12 months ago',
                '12' => '13 months ago',
                '13' => '14 months ago',
            ),
        ),
        'general.order.information'                       => array(
            'label' => 'Order Information',
            'valuehint' => 'Save order number, marketplace name and buyer&apos;s message (if any) in customer comments.',
            'help' => 'When this function is activated, the marketplace order number, the marketplace name and the message entered by buyer (if available) will be saved in the customer comments after order import.<br />
The customer comments can be transferred to the invoice on many systems, so the customer automatically receives the information about the origin of the order.<br />
This also allows you to provide space for further statistical sales overviews.<br />
<b>Important:</b> Some ERPs do not import orders that have customer comments. Please speak to your ERP provider for any further information.',
        ),
        'general.editor'                                  => array(
            'label' => 'Editor',
            'help' => 'Editor for product descriptions, templates and promotional emails.<br /><br />
<strong>TinyMCE Editor:</strong><br />Use a html editor, ideally one which automatically corrects image paths in product descriptions. <br /><br />
<strong>Basic textfeld, expand local links:</strong><br />Use a basic textfield. This is useful if the TinyMCE editor causes unintended changes to the inserted html code (e.g. in the eBay product template).<br />
Addresses of pictures or links which don\'t start with <strong>http://</strong>,
	                <strong>javascript:</strong>, <strong>mailto:</strong> or <strong>#</strong> will be extended with the shop\'s URL. <br /><br />
<strong>Basic textfeld, migrate data directly:</strong><br />The entered text will not be changed, no addresses will be extended. ',
            'values' => array(
                'tinyMCE'   => 'TinyMCE Editor<br>',
                'none'      => 'Basic textfield, expand local links<br>',
                'none_none' => 'Basic textfield, migrate data directly'
            ),
        ),
        'general.cronfronturl'                            => array(
            'label' => 'CRON Url',
            'help'  => 'This URL is automatically calculated from the store system settings and called to perform inventory synchronization, order import and ... from magnalister servers.This URL called for executing inventory synchronization, order import and ... from magnalister servers, and it automatically get from shop-system. Only if the current URL is not callable, you can change the URL here. To reset the URL to the original, clear the input and save the configuration.',
        ),
        'general.inventar.productstatus'                  => array(
            'label'  => 'Product Status',
            'help'   => 'Determine whether an item in your web shop should be marked "<i>inactive</i>", or if the sale on the marketplace has ended (eBay) or become inactive. <br/>
						<br/>
						In order for this function to take effect, please activate the relevant module in your marketplace under<br/>
						"<i>Synchronization of Inventory</i>" > "<i>Stock Sync to Marketplace</i>" ><br/>
						"<i>automatic synchronization with CronJob</i>".<br/>',
            'values' => array(
                'true' => 'If the product status is inactive, the stock will be set to 0<br>',
                'false' => 'Always use current stock values'
            ),
        ),
        'general.manufacturer'                            => array(
            'label' => 'Manufacturer',
            'help' => 'Manufacturer<br/><br/>
			<b>Note:</b> The data will not be reviewed. Incorrect data can cause database problems!',
        ),
        'general.manufacturerpartnumber' => array(
            'label' => 'Manufacturer Model Number',
            'help' => 'W&auml;hlen Sie hier die Artikel-Eigenschaft / Freitextfeld, in dem die Hersteller-Modellnummer des Produkts gespeichert wird.
                Die Artikel-Eigenschaften / Freitextfelder definieren Sie direkt &uuml;ber Ihre Web-Shop Verwaltung.'
        ,
        ),
        'general.ean' => array(
            'label' => 'EAN',
            'help' => 'European Article Number<br/><br/>
				           <b>Note:</b> The data will not be reviewed. Incorrect data can cause database problems!',
        ),
        'general.upc' => array(
            'label' => 'UPC',
            'help' => 'Universal Product Code<br/><br/>
<b>Note:</b>We don&apos;t check the data. Wrongly formatted data can cause database errors!',
        ),
    ),
        )
);

