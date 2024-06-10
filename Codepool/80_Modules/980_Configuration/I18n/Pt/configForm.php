<?php

MLI18n::gi()->add('configuration', array(
    'legend' => array(
        'general' => 'Configurações Gerais',
        'sku' => 'Faixas de número de sincronização',
        'stats' => 'Estatísticas',
        'orderimport' => 'Order Import',
        'crontimetable' => 'Outros',
        'articlestatusinventory' => 'Inventário',
        'productfields' => 'Características do produto',
    ),
    'field' => array(
        'general.passphrase' => array(
            'label' => 'Frase Senha',
            'help' => 'A Frase Senha você obtém após o registro em www.magnalister.com.',
        ),
        'general.keytype' => array(
            'label' => 'Por favor escolha',
            'help' => 'Depending on the selection, either the shop item number or the shop product ID will determine the item number in the marketplace (SKU).<br/><br/>
This setting matches the shop item to the marketplace item, which is necessary for stock management systems to function.<br/><br/>
Please note! The synchronization of stocks and prices is dependent on this setting. Please don\'t change this setting if you have already uploaded items via magnalister. Otherwise, the synchronization won\'t work for older items.',
            'values' => array(
                'pID' => 'ID do Produto (loja) - SKU (Markteplace)',
                'artNr' => 'Número do artigo (loja) = SKU (Marketplace)'
            ),
            'alert' => array(
                'pID' => '{#i18n:sChangeKeyAlert#}',
                'artNr' => '{#i18n:sChangeKeyAlert#}'
            ),
        ),
        'general.stats.backwards' => array(
            'label' => 'Meses atrás',
            'help' => 'Quantos meses passados a estatística deve considerar?',
            'values' => array(
                '0' => '1 mês',
                '1' => '2 meses',
                '2' => '3 meses',
                '3' => '4 meses',
                '4' => '5 meses',
                '5' => '6 meses',
                '6' => '7 meses',
                '7' => '8 meses',
                '8' => '9 meses',
                '9' => '10 meses',
                '10' => '11 meses',
                '11' => '12 meses',
                '12' => '13 meses',
                '13' => '14 meses',
            ),
        ),
        'general.order.information' => array(
            'label' => 'Order Information',
            'valuehint' => 'Save order number and marketplace name in customer comments.',
            'help' => 'When this function is activated, the marketplace order number and the marketplace name will be saved in the customer comments after order import.<br />
The customer comments can be transferred to the invoice on many systems, so the customer automatically receives the information about the origin of the order.<br />
This also allows you to provide space for further statistical sales overviews.<br />
<b>Important:</b> Some ERPs do not import orders that have customer comments. Please speak to your ERP provider for any further information.',
        ),
        'general.editor' => array(
            'label' => 'Editor',
            'help' => 'Editor for product descriptions, templates and promotional emails.<br /><br />
<strong>TinyMCE Editor:</strong><br />Use a html editor, ideally one which automatically corrects image paths in product descriptions. <br /><br />
<strong>Basic textfeld, expand local links:</strong><br />Use a basic textfield. This is useful if the TinyMCE editor causes unintended changes to the inserted html code (e.g. in the eBay product template).<br />
Addresses of pictures or links which don\'t start with <strong>http://</strong>,
	                <strong>javascript:</strong>, <strong>mailto:</strong> or <strong>#</strong> will be extended with the shop\'s URL. <br /><br />
<strong>Basic textfeld, migrate data directly:</strong><br />The entered text will not be changed, no addresses will be extended. ',
            'values' => array(
                'tinyMCE' => 'Editor TinyMCE<br>',
                'none' => 'Campo de texto simples, expandir links locais<br>',
                'none_none' => 'Campo de texto simples, repassar dados diretamente'
            ),
        ),
        'general.inventar.productstatus' => array(
            'label' => 'Situação de Produto',
            'help' => 'Determine whether an item in your web shop should be marked "<i>inactive</i>", or if the sale on the marketplace has ended (eBay) or become inactive. <br/>
						<br/>
						In order for this function to take effect, please activate the relevant module in your marketplace under<br/>
						"<i>Synchronization of Inventory</i>" > "<i>Stock Sync to Marketplace</i>" ><br/>
						"<i>automatic synchronization with CronJob</i>".<br/>',
            'values' => array(
                'true' => 'Quando a situação do produto foi inativo, o estoque é tratado como estando zerado',
                'false' => 'Utilizar sempre o estoque atual'
            ),
        ),
        'general.manufacturer' => array(
            'label' => 'Fabricante',
            'help' => 'Manufacturer<br/><br/>
			<b>Note:</b> The data will not be reviewed. Incorrect data can cause database problems!',
        ),
        'general.manufacturerpartnumber' => array(
            'label' => 'Número do modelo do fabricante',
            'help' => 'W&auml;hlen Sie hier die Artikel-Eigenschaft / Freitextfeld, in dem die Hersteller-Modellnummer des Produkts gespeichert wird.
                Die Artikel-Eigenschaften / Freitextfelder definieren Sie direkt &uuml;ber Ihre Web-Shop Verwaltung.'
        ,
        ),
        'general.ean' => array(
            'label' => 'EAN',
            'help' => 'European Article Number<br/><br/>
				           <b>Observação:</b> Estes dados não são verificados. Caso estejam errados, haverá um erro na base de dados!',
        ),
        'general.upc' => array(
            'label' => 'UPC',
            'help' => 'Universal Product Code<br/><br/>
<b>Note:</b>We don&apos;t check the data. Wrongly formatted data can cause database errors!',
        ),
    ),
        )
);

