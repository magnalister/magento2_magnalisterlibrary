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
* (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
// example for overwriting global element
MLI18n::gi()->add('formfields__quantity', array('help' => 'As stock {#setting:currentMarketplaceName#} supports only "availible" or "not availible".<br />Here you can define how the threshold for availible items.'));
MLI18n::gi()->add('formfields__stocksync.tomarketplace', array('help' => '
<p>D&eacute;finissez ici de quelle mani&egrave;re les changements de l&rsquo;&eacute;tat de stock dans votre boutique en ligne doivent &ecirc;tre synchronis&eacute;s avec l&rsquo;&eacute;tat de stock sur Etsy :</p>
<p>1. Pas de synchronisation</p>
<p>L&lsquo;&eacute;tat du stock n&lsquo;est pas synchronis&eacute; entre votre boutique en ligne et Etsy.</p>
<p>2. Synchronisation automatique <strong>incluant</strong> les articles ayant un stock de 0 (recommand&eacute;)</p>
<p>L&lsquo;inventaire est synchronis&eacute; automatiquement entre votre boutique en ligne et Etsy. Cela vaut aussi pour les produits dont le niveau de stock est inf&eacute;rieur &agrave; 1. Ces offres seront d&eacute;sactiv&eacute;es et r&eacute;activ&eacute;s automatiquement d&egrave;s que le niveau de stock repasse au dessus de 0 (&gt;0).</p>
<p><strong>Important :</strong> Etsy facture des frais lors de la r&eacute;activation des articles.</p>
<p>3. Synchronisation automatique articles avec un stock 0 <strong>hormis</strong></p>
<p>Le niveau de stock sera synchronis&eacute; seulement s&lsquo;il est sup&eacute;rieur &agrave; 0. Les articles ne seront <strong>pas r&eacute;activ&eacute;s automatiquement</strong> sur Etsy &ndash; m&ecirc;me si la boutique affiche qu&lsquo;ils sont de nouveau disponibles. C&lsquo;est un moyen d&lsquo;&eacute;viter des frais non intentionnels.</p>
<p><strong>Conseils g&eacute;n&eacute;raux :</strong></p>
<ul>
<li>D&eacute;clinaisons d\'articles : la synchronisation automatique des stocks des d&eacute;clinaisons d&rsquo;articles (m&ecirc;me si le stock est inf&eacute;rieur &agrave; 1) ne g&eacute;n&egrave;re pas de frais sur Etsy du moment qu&rsquo;une d&eacute;clinaison &agrave; un stock sup&eacute;rieur &agrave; 0.<br /><br /></li>
<li>Des produits inactifs isol&eacute;s peuvent &ecirc;tre r&eacute;activ&eacute;s manuellement en r&eacute;glant le niveau de stock dans votre boutique en ligne au dessus de 0 (&gt;0) et en relan&ccedil;ant le t&eacute;l&eacute;chargeant &agrave; nouveau le produit via magnalister.<br /><br /></li>
<li>La synchronisation automatique du niveau de stock est r&eacute;alis&eacute;e toutes les 4 heures via une t&acirc;che cron. La premi&egrave;re t&acirc;che cron est lanc&eacute;e tous les jours &agrave; 0:00.<br /><br /></li>
<li>Il est aussi possible de synchroniser votre stock en utilisant une t&acirc;che Cron personnelle (&agrave; partir du tarif flat et pas &agrave; moins de 15 minutes d&rsquo;intervalle). Pour op&eacute;rer la synchronisation utilisez le lien suivant:<br /><br />{#setting:sSyncInventoryUrl#}<br /><br /></li>
<li>Toute synchronisation provenant d&rsquo;un client n&rsquo;utilisant pas le tarif &ldquo;flat&rdquo; ou ne respectant pas le d&eacute;lai de 15 minute sera bloqu&eacute;.<br /><br /></li>
<li>Vous pouvez &agrave; tout moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton &ldquo;synchroniser les prix et les stocks&rdquo;, dans le groupe de boutons en haut &agrave; droite de la page.<br /><br /></li>
<li>Plus d&lsquo;informations concernant les frais factur&eacute;s par Etsy ici : <a href="https://help.etsy.com/hc/en-us/articles/360000344908">Etsy Help Center</a></li>
</ul>
'));

MLI18n::gi()->add('formfields_etsy', array(
    'shippingprofiletitle'             => array(
        'label' => 'Delivery profile title',
    ),
    'shippingprofileorigincountry'           => array(
        'label' => 'Origin country',
        'help'  => 'Country from which the listing ships',
    ),
    'shippingprofiledestinationcountry'           => array(
        'label' => 'Destination country',
        'help'  => 'Country where the listing is shipped',
    ),
    'shippingprofiledestinationregion'           => array(
        'label' => 'Destination region',
        'help'  => 'Region where the listing is shipped available values (inside EU, Outside EU and none)',
    ),
    'shippingprofileprimarycost'       => array(
        'label' => 'Primary cost',
        'help'  => 'The shipping fee for this item, if shipped alone',
    ),
    'shippingprofilesecondarycost'     => array(
        'label' => 'Secondary cost',
        'help'  => 'The shipping fee for this item, if shipped with another item',
    ),
    'shippingprofileminprocessingtime' => array(
        'label' => 'Durée minimale de traitement',
        'help'  => 'La durée minimale de traitement de l\'offre.',
    ),
    'shippingprofilemaxprocessingtime' => array(
        'label' => 'Durée maximale du traitement',
        'help'  => 'Le durée maximale du traitement de l\'offre.',
    ),
    'shippingprofilemindeliverydays'   => array(
        'label' => 'Durée minimale de livraison',
        'help'  => 'Le durée minimale de livraison de la marchandise.',
    ),
    'shippingprofilemaxdeliverydays'   => array(
        'label' => 'Durée maximale de livraison ',
        'help'  => 'Le durée maximale de livraison en jours.',
    ),
    'shippingprofileoriginpostalcode'  => array(
        'label' => 'Code postal du lieu de départ',
        'help'  => 'Le code postal de la ville à partir de laquelle l\'offre est envoyée (pas nécessairement un chiffre).',
    ),
    'shippingprofilesend'              => array(
        'label' => 'Save delivery profile',
    ),
    'paymentmethod'                     => array(
        'label'  => 'Payment Methods',
        'help'   => '
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
    'whomade' => array(
        'values' => array(
            'i_did' => 'I did',
            'collective' => 'A member of my shop',
            'someone_else' => 'Another company or person',
        ),
    ),
    'whenmade' => array(
        'values' => array(
            'made_to_order' => 'Made to order',
            '2020_'.date('Y') => '2020-'.date('Y'),
            '2010_2019' => '2010-2019',
            '2004_2009' => '2004-2009',
            'before_2004' => 'Before 2004',
            '2000_2003' => '2000-2003',
            '1990s' => '1990s',
            '1980s' => '1980s',
            '1970s' => '1970s',
            '1960s' => '1960s',
            '1950s' => '1950s',
            '1940s' => '1940s',
            '1930s' => '1930s',
            '1920s' => '1920s',
            '1910s' => '1910s',
            '1900s' => '1900s',
            '1800s' => '1800s',
            '1700s' => '1700s',
            'before_1700' => 'Before 1700'
        ),
    ),
    'issupply' => array(
        'values' => array(
            'false' => 'A finished product',
            'true' => 'A supply or tool to make things',
        ),
    ),
    'access.token' => array(
        'label' => 'Etsy Token',
    ),
    'shop.language' => array(
        'label' => 'Etsy Language',
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
        'label' => 'Etsy Currency',
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
    'prepare.whomade' => array(
        'label' => 'Who made it?',
    ),
    'prepare.whenmade' => array(
        'label' => 'When did you make it?',
    ),
    'prepare.issupply' => array(
        'label' => 'What is it?',
    ),
    'fixed.price' => array(
        'label' => 'Price',
        'help' => 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.'
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
        'help' => 'This textfield shows the decimal value that will appear in the item price on Etsy.'
    ),
    'prepare.language' => array(
        'label' => 'Language',
    ),
    'shippingprofile' => array(
        'label' => 'Default delivery profile',
        'hint' => '<button id="shippingprofileajax" class="mlbtn action add-matching" value="Secondary_color" style="display: inline-block; width: 45px;">+</button>',
    ),
    'prepare_title' => array(
        'label' => 'Title',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Always use product title from web-shop',
            )
        ),
    ),
    'prepare_description' => array(
        'label' => 'Description',
        'help' => 'Maximum number of characters is 63000.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Utiliser la description de l\'article toujours à jour depuis la boutique en ligne',
            )
        ),
    ),
    'prepare_image' => array(
        'label' => 'Product Images',
        'hint' => 'Maximum 10 images',
        'help' => 'A maximum 10 images can be set.<br/>The maximum allowed image size is 3000 x 3000 px.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Utiliser des images toujours actuelles de la boutique en ligne',
            )
        ),
    ),
    'category' => array(
        'label' => 'Category',
    ),
    'prepare_price' => array(
        'label' => 'Price',
        'help' => 'Minimum item price on Etsy is 0.17£',
    ),
    'prepare_quantity' => array(
        'label' => 'Quantity',
        'help' => 'Maximum item on Etsy is 999',
    ),
    'orderstatus.shipping' => array(
        'label' => 'Shipping provider'
    )
));
