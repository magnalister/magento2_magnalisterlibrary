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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */


MLI18n::gi()->add('metro_config_prepare', array(
    'legend' => array(
        'prepare' => 'Préparation des articles',
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'shipping' => 'Expédition',
        'upload' => 'Télécharger des articles : Préférences',
    ),
    'field' => array(
        'processingtime' => array(
            'label' => 'Délai de livraison min. en jours ouvrables',
            'help' => 'Indiquez ici le nombre minimum de jours ouvrables entre le moment où le client passe sa commande et la réception du colis.',
        ),
        'maxprocessingtime' => array(
            'label' => 'Délai de livraison max. en jours ouvrables',
            'help' => 'Indiquez ici le nombre maximum de jours ouvrables entre le moment où le client passe sa commande et la réception du colis.',
        ),
        'businessmodel' => array(
            'label' => 'Vendu à',
            'help' => 'Attribuez le produit à un groupe d\'acheteurs :<br>
                <ul>
                    <li>B2C / B2B : le produit s\'adresse aux deux groupes d\'acheteurs.</li>
                    <li>B2B : le produit s\'adresse uniquement aux clients finaux professionnels</li>
                </ul>
                ',
        ),
        'freightforwarding' => array(
            'label' => 'Livraison par transporteur',
            'help' => 'Indiquez si votre produit est expédié par transporteur.',
        ),
        'shippingprofile' => array(
            'label' => 'Profils de frais d\'envoi',
            'help' => 'Créez ici vos profils de frais d\'expédition. Vous pouvez indiquer des frais d\'expédition différents pour chaque profil (exemple : 4.95) et définir un profil par défaut. Les frais de livraison indiqués sont ajoutés au prix de l\'article lors du téléchargement du produit, car les produits sur la place de marché METRO peuvent uniquement être placés sans frais d\'expédition.',
            'hint' => '<span style="color: red">La majoration des frais de port définie ici s\'ajoute au "calcul du prix" (onglet : "Prix et stock").</span><br><br>Veuillez utiliser le point (.) comme séparateur pour les décimales.',
        ),
        'shippingprofile.name' => array(
            'label' => 'Nom du profil de frais d\'envoi',
        ),
        'shippingprofile.cost' => array(
            'label' => 'Supplément de frais d\'envoi (brut)',
        ),
        'shipping.group' => array(
            'label' => 'Groupes d\'envoi',
            'hint' => 'Un groupe particulier de paramètres d\'expédition qui est défini spécifiquement pour une offre. Le groupe d\'expédition du vendeur est créé et géré par le vendeur dans l\'interface utilisateur des paramètres d\'expédition.',
            'help' => 'Les vendeurs peuvent créer un groupe avec des paramètres d\'expédition différents, en fonction de leurs besoins commerciaux et de leurs applications. Différents groupes de paramètres d\'expédition peuvent être sélectionnés pour différentes régions, avec des conditions et des frais d\'expédition différents pour chaque région.<br /><br />
Lorsque le vendeur crée un produit en tant qu\'offre, il peut définir l\'un des groupes de paramètres d\'expédition qu\'il a créés pour ce produit. Les paramètres d\'expédition de ce groupe sont ensuite utilisés pour afficher l\'option d\'expédition en vigueur pour chaque produit sur le site.<br /><br />
Important : copiez les noms des groupes d\'expédition de votre compte METRO dans les champs correspondants ici. Seuls ceux-ci seront utilisés. La désignation ne sert ici qu\'à les afficher dans la préparation des produits.<br /><br />
Pour plus de détails sur la création de groupes d\'expédition, voir <a href="https://developer.metro-selleroffice.com/docs/offer-data/shipping/" target="_blank">la documentation METRO</a>',
        ),
        'shipping.group.name' => array(
            'label' => 'Nom du groupe d\'envoi',
        ),
        'shipping.group.id' => array(
            'label' => 'ID des groupes d\'envoi',
        ),
    )
), false);

MLI18n::gi()->add('formgroups_metro', array(
    'orderstatus' => 'Synchronisation du statut de la commande de la boutique à METRO',
));
MLI18n::gi()->{'metro_config_priceandstock__field__price.addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__price.factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__price__label'} = 'Ajustement du prix de vente';
MLI18n::gi()->{'metro_config_priceandstock__field__price__hint'} = '<span style="color: red">Zu dem hier definierten Preis addiert sich der unter "Artikelvorbereitung" ausgewählte Versandkostenaufschlag</span>';
MLI18n::gi()->{'metro_config_priceandstock__field__price__help'} = 'Saisir un pourcentage ou un taux fixe Entrez un taux ou un prix fixe de majoration ou de minoration. Marqué d\'un signe moins devant.<br><br>
<span style="color: red">Le supplément d\'expédition sélectionné dans "Préparation de l\'article" est ajouté au prix défini ici.</span>';
MLI18n::gi()->{'metro_config_priceandstock__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'metro_config_priceandstock__field__price.signal__help'} = 'Ce champ de texte est utilisé comme décimale de votre prix lors de la transmission des données à ebay.<br/><br/>
                <strong>Exemple :</strong> <br />
                Valeur dans la zone de texte : 99 <br />
                Prix d\'origine : 5.58 <br />
                Prix final :  5.99 <br /><br />
                Cette fonction est particulièrement utile pour les augmentations/diminutions de prix en pourcentage.<br/>
                Laissez ce champ vide si vous ne souhaitez pas transmettre de décimales.<br/>
                Le format d\'entrée est un nombre entier de 2 chiffres maximum.';
MLI18n::gi()->{'formfields__importactive__hint'} = 'Veuillez noter : les commandes de la place de marché METRO sont automatiquement acceptées lors de leur transfert vers la boutique en ligne (importation de commandes).';

MLI18n::gi()->{'formgroups_metro__account'} = 'Données d\'accès';
MLI18n::gi()->{'metro_config_account__field__clientkey__label'} = 'METRO Client-Key';
MLI18n::gi()->{'metro_config_account__field__clientkey__help'} = 'Saisissez ici la "METRO-Client-Key".<br><br>Actuellement, vous ne pouvez la demander qu\'au service d\'assistance des vendeurs de la place de marché METRO. Pour ce faire, envoyez un e-mail à : seller@metro-marketplace.eu';
MLI18n::gi()->{'metro_config_account__field__secretkey__label'} = 'METRO Secret Key';
MLI18n::gi()->{'metro_config_account__field__secretkey__help'} = 'Saisissez ici la "METRO Secret-Key".<br><br>Actuellement, vous ne pouvez la demander qu\'au support des vendeurs de la place de marché METRO. Pour cela, envoyez un e-mail à : seller@metro-marketplace.eu';
MLI18n::gi()->{'metro_config_account__field__shippingdestination__label'} = 'Localisation';
MLI18n::gi()->{'metro_config_account__field__shippingdestination__help'} = 'METRO : Actuellement, le commerce transfrontalier n\'est pas possible.';
MLI18n::gi()->{'metro_config_account__field__shippingdestination__hint'} = 'Sur quelle place de marché METRO du pays vos produits doivent-ils être vendus ?';
MLI18n::gi()->{'metro_config_account__field__shippingorigin__label'} = 'Expédition depuis';
MLI18n::gi()->{'metro_config_account__field__shippingorigin__help'} = 'METRO : Actuellement, le commerce transfrontalier n\'est pas possible.';
MLI18n::gi()->{'metro_config_account__field__shippingorigin__hint'} = 'Depuis quel pays vos produits sont-ils envoyés ?';
MLI18n::gi()->{'formgroups_metro__prepare'} = 'Préparation des articles';
MLI18n::gi()->{'formgroups_legend_quantity'} = 'Niveau de stock';
MLI18n::gi()->{'metro_config_prepare__field__processingtime__label'} = 'Délai de livraison min. en jours ouvrables';
MLI18n::gi()->{'metro_config_prepare__field__maxprocessingtime__label'} = 'Délai de livraison max. en jours ouvrables';
MLI18n::gi()->{'metro_config_prepare__field__businessmodel__label'} = 'Vendu à';
MLI18n::gi()->{'metro_config_prepare__field__freightforwarding__label'} = 'Livraison par transporteur';
MLI18n::gi()->{'metro_config_prepare__legend__shipping'} = 'Expédition';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile__label'} = 'Profils de frais d\'envoi';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile.name__label'} = 'Nom du profil de frais d\'envoi';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile.cost__label'} = 'Supplément de frais d\'envoi (brut)';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricesenable__hint'} = 'Attention, remarque importante : les suppléments de frais d\'envoi n\'ont pas d\'effet sur les prix échelonnés.';

MLI18n::gi()->{'formfields__price__hint'} = '<span style="color: red">Au prix défini ici s\'ajoute la majoration des frais de port sélectionnée sous "Préparation de l\'article"</span>';
MLI18n::gi()->{'formfields__price__help'} = 'Indiquez un pourcentage ou un prix fixe de majoration ou de minoration. Réduction précédée du signe "moins".<br><br><span style="color: red">Au prix défini ici s\'ajoute la majoration des frais de port sélectionnée sous "Préparation de l\'article"</span>';

########
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
MLI18n::gi()->{'metro_config_account_title'} = 'Données d\'accès';
MLI18n::gi()->{'metro_config_account_emailtemplate'} = 'Modèle d\'e-mail promotionnel';
MLI18n::gi()->{'metro_config_account_producttemplate'} = 'Template pour l\'annonce';
MLI18n::gi()->{'metro_config_priceandstock__field__price__label'} = 'Ajustement du prix de vente';
MLI18n::gi()->{'metro_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'metro_config_account_sync'} = 'Prix et stock';
MLI18n::gi()->{'formfields_metro_freightforwarding_values__false'} = 'Non';
MLI18n::gi()->{'metro_config_sync_inventory_import__false'} = 'Non';
MLI18n::gi()->{'metro_config_general_nosync'} = 'Pas de synchronisation';
MLI18n::gi()->{'formfields_metro_freightforwarding_values__true'} = 'Oui';
MLI18n::gi()->{'metro_config_sync_inventory_import__true'} = 'Oui';
MLI18n::gi()->{'metro_config_invoice'} = 'Factures';
MLI18n::gi()->{'metro_config_account_emailtemplate_subject'} = 'Votre commande chez #SHOPURL#';
MLI18n::gi()->{'metro_config_account_orderimport'} = 'Commandes';
MLI18n::gi()->{'metro_configform_stocksync_values__rel'} = 'Commande réduit le stock boutique (recommandé)';
MLI18n::gi()->{'formfields_metro__orderstatus.accepted__label'} = 'Accepter la commande avec';
MLI18n::gi()->{'metro_config_account_emailtemplate_sender'} = 'Exemple de boutique';
MLI18n::gi()->{'metro_config_account_emailtemplate_sender_email'} = 'exemple@votre-boutique.fr';
MLI18n::gi()->{'metro_configform_orderimport_payment_values__matching__title'} = 'Affectation automatique';
MLI18n::gi()->{'metro_configform_orderimport_shipping_values__matching__title'} = 'Affectation automatique';
MLI18n::gi()->{'metro_config_general_autosync'} = 'Synchronisation automatique par tâche Cron (recommandé)';
MLI18n::gi()->{'metro_configform_orderimport_payment_values__textfield__title'} = 'De la zone de texte';
MLI18n::gi()->{'metro_configform_orderimport_shipping_values__textfield__title'} = 'De la zone de texte';
MLI18n::gi()->{'metro_config_account_prepare'} = 'Préparation des articles';
MLI18n::gi()->{'metro_config_priceandstock__field__price__hint'} = '';
MLI18n::gi()->{'metro_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'metro_configform_orderstatus_sync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_sync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_stocksync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_pricesync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_orderstatus_sync_values__auto'} = '{#i18n:metro_config_general_autosync#}';
MLI18n::gi()->{'metro_configform_sync_values__auto'} = '{#i18n:metro_config_general_autosync#}';
MLI18n::gi()->{'metro_configform_pricesync_values__auto'} = '{#i18n:metro_config_general_autosync#}';
MLI18n::gi()->{'metro_config_emailtemplate_content'} = '
 <style><!--
body {
    font: 12px sans-serif;
}
table.ordersummary {
width: 100%;
border: 1px solid #e8e8e8;
}
table.ordersummary td {
padding: 3px 5px;
}
table.ordersummary thead td {
background: #cfcfcf;
color: #000;
font-weight: bold;
text-align: center;
}
table.ordersummary thead td.name {
text-align: left;
}
table.ordersummary tbody tr.even td {
background: #e8e8e8;
color: #000;
}
table.ordersummary tbody tr.odd td {
background: #f8f8f8;
color: #000;
}
table.ordersummary td.price,
table.ordersummary td.fprice {
text-align: right;
white-space: nowrap;
}
table.ordersummary tbody td.qty {
text-align: center;
}
--></style>
<p>Hallo #FIRSTNAME# #LASTNAME#,</p>
<p>vielen Dank f&uuml;r Ihre Bestellung! Sie haben &uuml;ber #MARKETPLACE# in unserem Shop folgendes bestellt:</p>
#ORDERSUMMARY#
<p>Zuz&uuml;glich etwaiger Versandkosten.</p>
<p>&nbsp;</p>
<p>Mit freundlichen Gr&uuml;&szlig;en,</p>
<p>Ihr Online-Shop-Team</p>';
MLI18n::gi()->{'metro_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'metro_configform_orderimport_shipping_values__textfield__textoption'} = '1';
