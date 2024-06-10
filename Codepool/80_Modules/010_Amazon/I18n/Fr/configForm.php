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

MLI18n::gi()->amazon_config_carrier_other = 'Autres';
MLI18n::gi()->{'amazon_config_general_mwstoken_help'} ='Amazon requiert une authentification pour transférer des données via magnalister. Une fois que vous avez demandé avec succès votre token, cette valeur sera auto-remplie.<br>
<br>';
MLI18n::gi()->{'amazon_config_general_autosync'} = 'Synchronisation automatique via CronJob (recommandée)';
MLI18n::gi()->{'amazon_config_general_nosync'} = 'Aucune synchronisation';
MLI18n::gi()->{'amazon_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'amazon_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'amazon_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'amazon_configform_orderstatus_sync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_configform_orderstatus_sync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_sync_values__auto'} = 'Synchronisation automatique via CronJob (recommandée)';
MLI18n::gi()->{'amazon_configform_sync_values__no'} = 'Aucune synchronisation';
MLI18n::gi()->{'amazon_configform_stocksync_values__rel'} = 'Une commande (hormis les commandes FBA) réduit les stocks en boutique (recommandée)';
MLI18n::gi()->{'amazon_configform_stocksync_values__fba'} = 'Une commande (également les commandes FBA) réduit les stocks en boutique';
MLI18n::gi()->{'amazon_configform_stocksync_values__no'} = 'Aucune synchronisation';
MLI18n::gi()->{'amazon_configform_pricesync_values__auto'} = 'Synchronisation automatique via CronJob (recommandée)';
MLI18n::gi()->{'amazon_configform_pricesync_values__no'} = 'Aucune synchronisation';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__textfield__title'} = 'De la zone de texte';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__Amazon__title'} = 'Amazon';
MLI18n::gi()->{'amazon_configform_orderimport_shipping_values__textfield__title'} = 'De la zone de texte';
MLI18n::gi()->{'amazon_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'amazon_config_account_sync'} = 'Synchronisation';
MLI18n::gi()->{'amazon_config_account_orderimport'} = 'Importation des commandes';
MLI18n::gi()->{'amazon_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'amazon_config_account_shippinglabel'} = 'Etiquettes d\'expédition';
MLI18n::gi()->{'amazon_config_account_vcs'} = 'Factures | VCS';
MLI18n::gi()->{'amazon_config_account_bopis'} = 'Click & Collect en magasin';
MLI18n::gi()->{'amazon_config_account_emailtemplate_sender'} = 'Nom de votre boutique, de votre société, ...';
MLI18n::gi()->{'amazon_config_account_emailtemplate_sender_email'} = 'exemple@votre-boutique.fr';
MLI18n::gi()->{'amazon_config_account_emailtemplate_subject'} = 'Votre commande sur #SHOPURL#';
MLI18n::gi()->{'amazon_config_account_emailtemplate_content'} = ' <style><!--
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
<p>Bonjour  #FIRSTNAME# #LASTNAME#,</p>
<p>Merci beaucoup pour votre commande! Vous avez commander sur #MARKETPLACE# l’article suivant:</p>
#ORDERSUMMARY#
<p>Plus frais de port.</p>

<p>Sincères salutations</p>
<p>Votre équipe #ORIGINATOR#</p>';
MLI18n::gi()->{'amazon_config_tier_error'} = 'Amazon Business (B2B): votre configuration (#{#TierNumber#}) n\'est pas correcte!';

MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_header'} = 'Autoriser magnalister pour Amazon';
MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_body'} = '
    Pour utiliser magnalister en conjonction avec Amazon, votre consentement est requis.<br />
    <br />
    En autorisant magnalister dans votre portail Seller Central, vous nous permettez d\'interagir avec votre boutique Amazon.
    Plus précisément, cela signifie : récupérer des commandes, télécharger des produits, synchroniser l\'inventaire et bien plus encore.
    <br />
    <br />
    Pour autoriser magnalister, veuillez effectuer les étapes suivantes :<br />
    <ol>
        <li>Après avoir sélectionné le site Amazon et cliqué sur Request Token, une fenêtre vers Amazon s\'ouvrira juste après cette fenêtre d\'indices. Veuillez vous y connecter.</li>
        <li>Suivez les instructions sur Amazon même et complétez l\'autorisation.</li>
        <li>Cliquez ensuite sur "Continuer la préparation de l\'article"</li>.
    </ol>
    <br />
    <strong>Important:</strong> Après avoir demandé votre jeton, vous n\'êtes pas autorisé à changer leur site Amazon. Si, par erreur, vous avez un 
    mauvais site Amazon et que vous avez déjà demandé votre jeton, veuillez sélectionner le bon site et demander un nouveau jeton.<br />
    <br />
    <strong>Remarque:</strong> magnalister peut traiter les données non personnelles transmises à et par Amazon à des fins statistiques internes.
';

MLI18n::gi()->{'amazon_config_amazonvcsinvoice_invoicenumberoption_values_magnalister'} = 'Charger magnalister de la création des numéros de commande';
MLI18n::gi()->{'amazon_config_amazonvcsinvoice_reversalinvoicenumberoption_values_magnalister'} = 'Charger magnalister de la création des numéros de commande';

MLI18n::gi()->{'amazon_config_account__legend__account'} = 'Mes coordonnées';
MLI18n::gi()->{'amazon_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'amazon_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'amazon_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'amazon_config_account__field__username__label'} = 'Adresse courriel';
MLI18n::gi()->{'amazon_config_account__field__username__hint'} = '';
MLI18n::gi()->{'amazon_config_account__field__password__label'} = 'Mot de passe général du vendeur';
MLI18n::gi()->{'amazon_config_account__field__password__help'} = 'Saisissez ici, votre mot de passe Amazon';
MLI18n::gi()->{'amazon_config_account__field__mwstoken__label'} = 'MWS Token';
MLI18n::gi()->{'amazon_config_account__field__mwstoken__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__spapitoken__label'} = 'SP-API Token';
MLI18n::gi()->{'amazon_config_account__field__spapitoken__help'} = 'Pour demander un nouveau jeton Amazon, veuillez cliquer sur le bouton.<br>
                        Si aucune fenêtre vers Amazon ne s\'affiche lorsque vous cliquez sur le bouton, il se peut qu\'un bloqueur de fenêtres pop-up soit actif.<br><br>
                        Le jeton est nécessaire pour publier et gérer des articles sur Amazon par le biais d\'interfaces électroniques telles que le magnalister.<br><br>
                        Dès lors, suivez les instructions de la page Amazon pour demander le jeton et connecter votre boutique en ligne à Amazon via magnalister.';
MLI18n::gi()->{'amazon_config_account__field__merchantid__label'} = 'Commerçant-ID';
MLI18n::gi()->{'amazon_config_account__field__merchantid__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__marketplaceid__label'} = 'Place de marché-ID';
MLI18n::gi()->{'amazon_config_account__field__marketplaceid__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__site__label'} = 'Localisation du site d\'Amazon';
MLI18n::gi()->{'amazon_config_prepare__legend__prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'amazon_config_prepare__legend__machingbehavior'} = 'Comportement lors de l\'appariement';
MLI18n::gi()->{'amazon_config_prepare__legend__apply'} = 'Création de nouveaux produits';
MLI18n::gi()->{'amazon_config_prepare__legend__shipping'} = 'Expédition';
MLI18n::gi()->{'amazon_config_prepare__legend__upload'} = 'Préréglages de téléchargement';
MLI18n::gi()->{'amazon_config_prepare__legend__shippingtemplate'} = 'Profils d’expédition par région d’expédition';
MLI18n::gi()->{'amazon_config_prepare__field__itemcondition__label'} = 'État du produit';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.status__label'} = 'Statut de filtre';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.status__label'} = 'Statut du filtre';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'amazon_config_prepare__field__lang__label'} = 'Description de l\'article';
MLI18n::gi()->{'amazon_config_prepare__field__internationalshipping__label'} = 'Expédition';
MLI18n::gi()->{'amazon_config_prepare__field__internationalshipping__hint'} = 'Si les groupes d\'expédition du vendeur sont activés, ce paramètre est ignoré.';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__label'} = 'Appariez de nouveau';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__valuehint'} = 'Remplacez les produits déjà appariés lors du multi et auto appariement.';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__help'} = 'Si vous avez activé ce paramètre, les produits déjà appariés seront remplacés par les nouveaux correspondants.';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__label'} = 'Résultats';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__help'} = 'Ici, vous pouvez définir le nombre de produits par page lorsque le Multi appariement s\'affiche.<br/> Plus le nombre est important, plus long sera le chargement (pour 50 résultats comptez environ 30 secondes).';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__hint'} = 'Par page lors du multi appariement ';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.manufacturerfallback__label'} = 'Fabricant par défaut';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.manufacturerfallback__help'} = 'Amazon demande de spécifier les fabricants des produits vendus sur leurs places de marché. Si pour un produit vous n’avez pas spécifié de fabricant, celui que vous pouvez donner dans cette rubrique  sera alors automatiquement utilisé.<br>
<br>
Sous l\'onglet "Configuration globale" "Propriétés du produit", vous pouvez apparier (Matcher) des „fabricants“ à vos attributs.';
MLI18n::gi()->{'amazon_config_prepare__field__quantity__label'} = 'Variation de stock';
MLI18n::gi()->{'amazon_config_prepare__field__quantity__help'} = 'Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière. <br>
<br>
Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
<br>
<b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à Amazon: 8 (articles).<br>
<br>
<b>Remarque :</b> Si vous souhaitez cesser la vente sur Amazon, d’un article que vous avez encore en stock, mais que vous avez désactivé de votre boutique, procédez comme suit :
<ol>
      <li>
Cliquez sur  les onglets  “Configuration” →  “Synchronisation”; 
</li>
      <li>
Rubrique  “Synchronisation des Inventaires" →  "Variation du stock boutique";
</li>
      <li>
Activez dans la liste de choix "synchronisation automatique via CronJob";
</li>
<li>
Cliquez sur  l’onglet  "Configuration globale";
</li>
<li>
    Rubrique “Inventaire”, activez "Si le statut du produit est placé comme étant   inactif, le niveau des stocks sera alors enregistré comme quantité 0".
</li>
</ol>
';
MLI18n::gi()->{'amazon_config_prepare__field__maxquantity__label'} = 'Nombre d\'unité maximale';
MLI18n::gi()->{'amazon_config_prepare__field__maxquantity__help'} = 'Cette fonction vous permet de limiter la quantité disponible d’un article, sur votre marché Amazon.
<br /><br /><strong>
Exemple</strong> : Sous la rubrique "Quantité", choisissez l’option "Prendre en charge (cas) le stock de la boutique" puis inscrivez “20” sous la rubrique “Quantité limitée”. Ainsi ne seront vendables sur Amazon, que 20 pièces d’un article donné, disponible dans le stock de votre boutique. 
<br />La synchronisation du stock (si elle est activée) harmonisera dans ce cas les quantités entre vos différents stocks à concurrence de 20 pièces maximum. 
<br /><br />
Si vous ne souhaitez pas de limitation, laissez le champ vide ou inscrivez "0".
<br /><br /><strong>Remarque</strong> : Si sous la rubrique "Quantité", vous avez choisi l’option "forfait (sur le côté droit)", la limitation n\'est pas applicable.';
MLI18n::gi()->{'amazon_config_prepare__field__leadtimetoship__label'} = 'Délai de traitement (en jours)';
MLI18n::gi()->{'amazon_config_prepare__field__leadtimetoship__help'} = 'Temps qui s\'écoule entre le moment où l\'acheteur passe commande et celui où vous remettez la commande à votre transporteur.<br>Si vous ne donnez ici aucune valeur, le délai de traitement, par défaut, entre 1 et 2 jours ouvrables.
Utilisez ce champ si le délai de traitement pour un article dépasse les deux jours ouvrables prévus.';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__label'} = 'Réference fabricant';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__help'} = 'Le numéro SKU sera transmit comme numéro d\'article du fabricant';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__valuehint'} = 'Le numéro SKU sera utilisé comme référence fabricant';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__label'} = 'Taille d\'image';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__help'} = '<p>Indiquez ici, la largeur en pixels de l\'image, que vous souhaitez avoir sur la place de marché.
La hauteur sera ajustée automatiquement aux caractéristiques de la page d\'origine.</p>
<p>
Les fichiers source seront modifiés à partir du dossier image {#setting:sSourceImagePath#} et déposés avec la largeur en pixels désirée dans le dossier {#setting:sImagePath#} pour la transmission à la place de marché.';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__hint'} = 'Enregistrée sous: {#setting:sImagePath#}-';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.active__label'} = 'Utiliser les profils de Paramètres d’expédition par régions d’expédition.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.active__help'} = 'Les vendeurs peuvent créer des profils de réglages d\'expédition différents, selon leurs exigences et les coûts en vigueurs. 
Selon les régions, des profils particuliers de condition d\'expédition peuvent être établis, - conditions et/ou coût d\'expédition, différents. 
Lorsque le vendeur prépare un produit, il peut donner un des profils de réglages d\'expédition au préalable défini pour le produit à préparer. Les réglages d\'expédition de ce profil sont alors utilisés. Si aucun profil n’est mentionné les conditions d’expéditions standards seront utilisées.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__label'} = 'profil de Paramètres d’expédition par région d’expédition';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__hint'} = 'Profil étbli pour une offre particulière. 
<br>Les profils de Paramètres d’expédition par région d’expédition sont déterminés et gérés par les vendeurs';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__help'} = 'Les vendeurs peuvent créer des profils de réglages d\'expédition différents, selon leurs exigences et les coûts en vigueurs. 
Selon les régions, des profils particuliers de condition d\'expédition peuvent être établis, - conditions et/ou coût d\'expédition, différents. 
Lorsque le vendeur prépare un produit, il peut donner un des profils de réglages d\'expédition au préalable défini pour le produit à préparer. Les réglages d\'expédition de ce profil sont alors utilisés. Si aucun profil n’est mentionné les conditions d’expéditions standards seront utilisées.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.name__label'} = 'Nom du profil de Paramètres d’expédition par région d’expédition.';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__label'} = 'Utilisation des services Amazon B2B';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__help'} = '
<p>En tant que vendeur Amazon, vous pouvez enrichir votre compte avec des fonctionnalit&eacute;s destin&eacute;es aux entreprises. Cela vous permet de vendre vos produits aussi bien &agrave; des consommateurs finaux qu\'&agrave; des clients professionnels, en affichant clairement les taux de TVA applicables.</p>
<p>Pour cela, il est n&eacute;cessaire d\'activer la fonctionnalit&eacute; "Amazon Business" sur votre compte. Cette activation peut &ecirc;tre r&eacute;alis&eacute;e depuis votre compte Amazon Seller Central.</p>
<p>Il est important de noter que <strong>poss&eacute;der un compte Amazon Business activ&eacute; est une condition</strong> sine qua non pour l\'utilisation des fonctionnalit&eacute;s d&eacute;crites ci-apr&egrave;s. Vous devez &eacute;galement &ecirc;tre enregistr&eacute; en tant que "Vendeur Professionnel" chez Amazon.</p>
<p>Plus d\'informations :</p>
<ul>
<li>Vous trouverez des instructions pour l\'importation de commandes B2B Amazon en cliquant sur l\'ic&ocirc;ne d\'information dans la section "Importation des commandes" -&gt; "Activer l\'importation des commandes".<br><br></li>
<li>Les configurations mentionn&eacute;es ci-dessous sont pr&eacute;vues pour la configuration globale de votre environnement Amazon B2B. Des ajustements sp&eacute;cifiques au niveau des produits pourront &ecirc;tre faits ult&eacute;rieurement lors de la pr&eacute;paration des articles.</li>
</ul>
';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__notification'} = '<p>Pour pouvoir utiliser Amazon Business, vous devez l\'activer sur votre compte Amazon. <b>Veuillez vous assurer, que sur votre compte Amazon, l\'option Amazon business est bien activée. </b>Si ce n\'est pas le cas, le téléchargement des articles B2B entraînera des messages d\'erreurs.</p><p>Pour activer votre compte Amazon Business, veuillez suivre les indications de cette <a href="https://sellercentral.amazon.fr/business/b2bregistration" target="_blank">page</a>.</p>';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__values__true'} = '{#i18n:ML_BUTTON_LABEL_YES#}';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__values__false'} = '{#i18n:ML_BUTTON_LABEL_NO#}';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__label'} = 'Harmonisation des classes fiscales Business';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__help'} = '
<p>Synchronisez les taux de taxe de votre syst&egrave;me de gestion de boutique avec ceux d&eacute;finis par Amazon Business. Cela garantit que les taux de TVA corrects soient affich&eacute;s aux acheteurs Amazon lors du processus de commande. De plus, cette harmonisation des classes fiscales permet la cr&eacute;ation de factures de TVA pr&eacute;cises, disponibles pour les clients B2B.</p>
<p>Les taux de taxe configur&eacute;s dans votre syst&egrave;me sont affich&eacute;s dans la colonne de gauche. Pour proc&eacute;der &agrave; l\'harmonisation, s&eacute;lectionnez le taux de taxe appropri&eacute; d\'Amazon depuis les menus d&eacute;roulants de la colonne de droite.</p>
<p>Pour plus de d&eacute;tails sur les taux de taxe sp&eacute;cifi&eacute;s par Amazon, consultez la section d\'aide du Amazon Seller Central sous "Taux de TVA et codes fiscaux des produits".</p>
<p><strong>Note</strong> : Au prochain point du menu, il est possible de configurer des harmonisations fiscales au niveau cat&eacute;goriel, qui auront la priorit&eacute; sur les configurations pr&eacute;sentes ici.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__matching__titlesrc'} = 'TVA Boutique';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__matching__titledst'} = 'TVA Amazon Business';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_container__label'} = 'Harmonisation des classes fiscales - par catégories Amazon';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_container__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_container__help'} = '
<p>Dans cette section, vous pouvez aligner les taux de taxe de votre boutique avec ceux sp&eacute;cifi&eacute;s par Amazon Business selon les cat&eacute;gories Amazon (telles que "Bricolage" ou "V&ecirc;tements"). Vous pouvez ajouter autant de cat&eacute;gories que n&eacute;cessaire en utilisant le symbole "+".</p>
<p><strong>Note importante</strong> : Les taux de taxe associ&eacute;s &agrave; des cat&eacute;gories sp&eacute;cifiques ont pr&eacute;s&eacute;ance sur ceux que vous avez d&eacute;finis individuellement dans les options pr&eacute;c&eacute;dentes.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__matching__titlesrc'} = 'TVA Boutique';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__matching__titledst'} = 'TVA Amazon Business';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_category__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_category__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__label'} = 'Options de vente';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__help'} = '
<p>Vous disposez des options suivantes :</p>
<ul>
<li><strong>B2B et B2C</strong> : Les produits charg&eacute;s via magnalister sont visibles sur Amazon tant pour les acheteurs B2B (business-to-business) que B2C (business-to-consumer).<br><br></li>
<li><strong>Exclusivement B2B</strong> : Les produits charg&eacute;s via magnalister sont accessibles sur Amazon exclusivement aux acheteurs B2B.</li>
</ul>
<p><strong>Remarque</strong> : Durant la phase de pr&eacute;paration des produits, vous pouvez ajuster ces r&eacute;glages au niveau individuel de chaque article.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__values__b2b_b2c'} = 'B2B et B2C';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__values__b2b_only'} = 'Exclusivement B2B';
MLI18n::gi()->{'amazon_config_price__field__b2b.price__label'} = 'Prix Business';
MLI18n::gi()->{'amazon_config_price__field__b2b.price__help'} = '
<p>Dans cette section, vous pouvez d&eacute;finir une majoration ou une minoration du prix, soit en pourcentage soit fixe, pour le "Prix Business" qui est affich&eacute; sur Amazon et r&eacute;serv&eacute; exclusivement aux clients B2B.</p>
<p>Vous avez &eacute;galement la possibilit&eacute; de personnaliser les d&eacute;cimales pour le Prix Business. Par exemple, ins&eacute;rez "99" dans le champ correspondant si vous d&eacute;sirez que tous les prix Business sur Amazon se terminent par ",99" (comme dans 2,99 euros).</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.addkind__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.addkind__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.factor__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.factor__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.signal__help'} = 'Cette zone de texte sera utilisée dans les transmissions de données vers la place de Amazon, (prix après la virgule).<br/><br/>
                <strong>Par exemple :</strong> <br /> 
                 Valeur dans la zone de texte: 99 <br />
                 Prix d\'origine: 5.58 <br />
                 Prix final: 5.99 <br /><br />
                 La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix. <br/>
                 Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule.<br/>
                 Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'amazon_config_price__field__b2b.priceoptions__label'} = 'Options de Prix Business';
MLI18n::gi()->{'amazon_config_price__field__b2b.priceoptions__help'} = '
<p>Dans cette section, vous pouvez transmettre les prix Business bas&eacute;s sur les groupes de clients d&eacute;finis dans votre boutique. Si, par exemple, vous avez sp&eacute;cifi&eacute; un groupe de clients tel que "Clients du Magasin" pour un article, les prix associ&eacute;s &agrave; ce groupe seront repris et synchronis&eacute;s. S&eacute;lectionnez l\'option "utiliser aussi les prix sp&eacute;ciaux" si vous d&eacute;sirez que les prix sp&eacute;ciaux attribu&eacute;s &agrave; l\'article soient &eacute;galement envoy&eacute;s &agrave; Amazon.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.group__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.group__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.usespecialoffer__label'} = 'Utiliser aussi les prix spéciaux';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__label'} = 'Calcul des prix progressifs';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__help'} = '
<p>Les prix progressifs offrent des r&eacute;ductions aux clients professionnels qui ach&egrave;tent en grande quantit&eacute;. Les vendeurs qui participent au programme Vendeur Amazon Business peuvent d&eacute;finir des quantit&eacute;s minimales ("Quantit&eacute;") et des rabais ("Rabais").</p>
<p>Options disponibles dans la section "Calcul des prix progressifs" :</p>
<ul>
    <li><strong>Ne pas utiliser</strong> : Cette option d&eacute;sactive les tarifs d&eacute;gressifs d\'Amazon Business.<br><br></li>
    <li><strong>Pourcentage</strong> : Applique un rabais en pourcentage sur les tarifs d&eacute;gressifs &eacute;tablis (ex. : 10 % de rabais pour 100 unit&eacute;s, 15 % pour 500 unit&eacute;s, etc.).</li>
</ul>
<p>Entrez les &eacute;chelons de tarifs souhait&eacute;s dans les champs "Niveau de Prix Progressif 1 - 5". Exemple de structure de rabais en <strong>pourcentage</strong> :</p>
<table>
    <tr>
        <td>Niveau de Prix Progressif 1</td>
        <td>Quantit&eacute;: 100</td>
        <td>Rabais: 10</td>
    </tr>
    <tr>
        <td>Niveau de Prix Progressif 2</td>
        <td>Quantit&eacute;: 500</td>
        <td>Rabais: 15</td>
    </tr>
    <tr>
        <td>Niveau de Prix Progressif 3</td>
        <td>Quantit&eacute;: 1000</td>
        <td>Rabais: 25</td>
    </tr>
</table>
<p><strong>Informations compl&eacute;mentaires</strong> :&nbsp;</p>
<ul>
    <li>Lors de la pr&eacute;paration des produits avec magnalister, vous disposez &eacute;galement de l\'option "<strong>Fixe</strong>" pour les tarifs d&eacute;gressifs, qui vous permet de d&eacute;finir des ajustements de prix fixes pour chaque produit pr&eacute;par&eacute; (ex. : r&eacute;duction de 10 euros pour 100 unit&eacute;s, 50 euros pour 500 unit&eacute;s, etc.).<br><br></li>
    <li>Si vous choisissez de ne pas appliquer les param&egrave;tres g&eacute;n&eacute;raux d\'Amazon Business d&eacute;finis pour le march&eacute; Amazon sur certains produits, vous pouvez les modifier lors de la pr&eacute;paration du produit.</li>
</ul>
';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__values__'} = 'Ne pas tenir compte';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__values__percent'} = 'Pourcentage';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1__label'} = 'Prix plancher 1';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1__help'} = 'La remise doit être supérieure à 0';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier2__label'} = 'Prix plancher 2';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier3__label'} = 'Prix plancher 3';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier4__label'} = 'Prix plancher 4';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier5__label'} = 'Prix plancher 5';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1quantity__label'} = 'Nombre de pièce';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier2quantity__label'} = 'Nombre de pièce';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier3quantity__label'} = 'Nombre de pièce';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier4quantity__label'} = 'Nombre de pièce';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier5quantity__label'} = 'Nombre de pièce';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1discount__label'} = 'Remise';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier2discount__label'} = 'Remise';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier3discount__label'} = 'Remise';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier4discount__label'} = 'Remise';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier5discount__label'} = 'Remise';
MLI18n::gi()->{'amazon_config_price__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'amazon_config_price__legend__b2b'} = 'Amazon Business (B2B)';
MLI18n::gi()->{'amazon_config_price__field__price__label'} = 'Prix';
MLI18n::gi()->{'amazon_config_price__field__price__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price__help'} = 'Veuillez saisir un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. 
Pour indiquer un rabais faire précéder le chiffre d’un moins. ';
MLI18n::gi()->{'amazon_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'amazon_config_price__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'amazon_config_price__field__price.signal__help'} = '                Cette zone de texte sera utilisée dans les transmissions de données vers la place de Amazon, (prix après la virgule).<br/><br/>

                <strong>Par exemple :</strong> <br /> 
                 Valeur dans la zone de texte: 99 <br />
                 Prix d\'origine: 5.58 <br />
                 Prix final: 5.99 <br /><br />
                 La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix. <br/>
                 Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule.<br/>
                 Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__label'} = 'Options de tarification ';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__help'} = '<p>Avec cette fonction, vous pouvez transmettre vos prix promotionnels aux places de marché, selon les groupes clients, que vous avez déterminés dans l’espace de gestion de votre boutique et opérer leurs synchronisations automatiques. Si vous n’avez pas défini de prix, pour l’un de vos groupes clients, le prix de votre boutique sera utilisé. Ainsi, vous pouvez simplement allouer un prix différent à une certaine quantité d’article, pour un groupe particulier de clients, tout en conservant les configurations initiales inhérentes à ce prix, pour un autre groupe de clients.</p>
<ul>
<li>Créez un groupe de clients dans votre boutique en ligne, par exemple : “clients réguliers”</li>
<li>Vous pouvez alors définir les prix souhaités pour ces groupes de clients et ainsi de suite.</li>
</ul>';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'amazon_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__hint'} = 'Mise à jour automatique du taux de change';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__help'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
<br>
En activant cette fonction, le taux de change actuel défini par "alphavantage" sera appliqué à vos articles. Les prix dans votre boutique en ligne seront également mis à jour.<br>
<br>
L’activation et la désactivation de cette fonction prend effet toutes les heures.<br>
<br>
<b>Avertissement :</b> RedGecko GmbH n\'assume aucune responsabilité pour l\'exactitude du taux de change. Veuillez vérifier en contrôlant les prix de vos articles dans votre compte Amazon.            ';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__alert'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
<br>
En activant cette fonction, le taux de change actuel défini par "alphavantage" sera appliqué à vos articles. Les prix dans votre boutique en ligne seront également mis à jour.<br>
<br>
L’activation et la désactivation de cette fonction prend effet toutes les heures.<br>
<br>
Les fonctions suivantes provoqueront une actualisation du taut de change :
<ul>
<li>Importation des commandes</li>
<li>Préparer les articles</li>
<li>Charger les articles</li>
<li>Synchronisation des prix et des stocks</li>
</ul>
<b>Avertissement :</b> RedGecko GmbH n\'assume aucune responsabilité quand à l\'exactitude du taux de change. Veuillez vérifier en contrôlant les prix de vos articles sur la place de marché.            ';
MLI18n::gi()->{'amazon_config_sync__legend__sync'} = 'Synchronisation de l\'inventaire';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__label'} = 'Variation du stock boutique';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__help'} = 'Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock Amazon et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. Si la synchronisation est activée, les données de votre base de données seront appliquées à Amazon.
Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br>
<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué. <br>
 <br>
<b>Commande ou modification d’un article; l’état du stock Amazon  est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à Amazon. <br>
Attention, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, <b>ne seront ni pris en compte, ni transmis!</b> <br>
<br>
<b>Commande ou modification d’un article; l’état du stock Amazon est modifié (différence)</b> <br>
Si par exemple, un article a été acheté deux fois en boutique, le stock Amazon sera réduit de 2 unités. <br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “Amazon” &rarr; “configuration” &rarr; “préparation d’article”, ce changement sera appliqué sur Amazon. <br>
<br>
<b>Attention</b>, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<br>
<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr;  Préparation de l’article &rarr; Préréglages de téléchargement d’article. ';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__label'} = 'Variation du stock Amazon';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__help'} = 'Si cette fonction est activée, le nombre de commandes effectués et payés sur Amazon, sera soustrait de votre stock boutique.<br>
<br>
<b>Important :</b> Cette fonction n’est opérante que lors de l’importation des commandes.
';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__label'} = 'Prix de l&apos;article';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__help'} = '<b>Synchronisation automatique via CronJob (recommandée)</b><br>
<br>
Utilisez la fonction “synchronisation automatique” pour que les prix de vos articles sur Amazon soient mis à jour par rapport aux prix de vos articles en boutique. Cette mise à jour aura lieu toutes les quatre heures, à moins que vous n’ayez défini d’autres paramètres de configuration. <br>
Les données de votre base de données seront  appliquées sur Amazon, même si les changements n’ont eu lieu que dans votre base de données.<br>
 Vous pouvez à tout moment effectuer une synchronisation des prix en cliquant sur le bouton “synchroniser les prix et les stocks” en haut à droite du module. <br>
<br>
La fonction n’est disponible qu’à partir du tarif “flat” et autorise une synchronisation toutes les 15 minutes maximum. <br>
Pour opérer la synchronisation utilisez le lien suivant:<br>
<i>{#setting:sSyncInventoryUrl#}</i>
<br>
Toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minutes sera bloqué.<br>
<br>
<b>Attention :</b> les paramètres configurés dans “Configuration” &rarr;  “calcul du prix”,  affecterons cette fonction.';
MLI18n::gi()->{'amazon_config_orderimport__legend__importactive'} = 'Importation des commandes';
MLI18n::gi()->{'amazon_config_orderimport__legend__mwst'} = 'TVA';
MLI18n::gi()->{'amazon_config_orderimport__legend__orderstatus'} = 'Paramètre de synchronisation des commandes boutiques vers Amazon';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__label'} = 'Expédition confirmée si :';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__help'} = 'Définissez ici le statut de la commande, qui doit automatiquement confirmer la livraison  sur Amazon.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__label'} = 'Annuler la commande avec';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__help'} = '        Définissez  ici le statut de la boutique, qui doit "annuler la commande" automatiquement sur Amazon. <br/><br/>
                Remarque : une annulation partielle est impossible ici. La commande tout entière est annulée avec cette fonctionnalité et est créditée à l\'acheteur.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__label'} = 'Mode de paiement pour les commandes';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Mode de paiement, qui sera associé à toutes les commandes sur Amazon, lors de l\'importation des commandes. 
Standard: "Amazon"</p>
<p>
Ce paramètre est important pour les factures, l\'impression des bons de livraison, le traitement ultérieur de la commande en magasin, ainsi que dans la gestion des marchandises.</p>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__label'} = 'Mode de livraison des commandes';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__help'} = 'Mode de livraison, qui sera associé à toutes les commandes sur Amazon. Standard: "marketplace".<br><br>
				           Ce paramètre est important pour les factures, l\'impression des bons de livraison, le traitement ultérieur de la commande en magasin, ainsi que dans la gestion des marchandises';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__label'} = 'TVA des articles non référencés en boutique ';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__hint'} = 'Le taux d\'imposition lors d\'une importation de commandes d\'articles ne venant pas de la boutique sera alors calculé en %.';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__help'} = 'Si pour un article, la TVA n’a pas été spécifiée, vous pouvez ici donner un taux, qui sera automatiquement appliquée à l’importation. Les places de marché même ne donnent aucune indication de TVA.<br>
Par principe, pour l’importation des commandes et la facturation, magnalister applique le même système de TVA que celui configuré par les boutiques. <br>
Afin que les TVA nationales soient automatiquement prisent en compte, il faut que l’article acheté soit trouvé grâce à son numéro d’unité de gestion des stocks (SKU); magnalister utilisant alors la TVA configurée dans la boutique. ';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__label'} = 'Activer l\'importation des commandes';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__help'} = '
<p>Lorsque la fonction est activ&eacute;e, les commandes sont par d&eacute;faut import&eacute;es toutes les heures.</p>
<p>Vous pouvez d&eacute;clencher une importation manuelle, en cliquant sur le bouton situ&eacute; dans le groupe de boutons en haut &agrave; droite, face &agrave; l\'en-t&ecirc;te Magnalister.</p>
<p>&Agrave; partir du tarif Flat, le d&eacute;clenchement de l\'importation automatique des commandes peut &ecirc;tre r&eacute;gl&eacute; au quart d&rsquo;heure. Pour ce faire vous devez avoir install&eacute;, un syst&egrave;me Cronjob sur votre serveur, puis l&rsquo;appeler &agrave; l&rsquo;aide du lien suivant :&nbsp;<br><em>{#setting:sImportOrdersUrl#}<br></em></p>
<p><strong>TVA:</strong></p>
<p>Les diff&eacute;rents taux de TVA des pays avec lesquels vous &ecirc;tes en relation commerciales ne peuvent &ecirc;tre correctement appliqu&eacute; &agrave; vos commandes, que si vous avez les avez, au pr&eacute;alable, enregistr&eacute;es dans votre boutique, sous la rubrique : &ldquo;Localisation&rdquo; &mdash;&gt; R&egrave;gle de taxes. Les articles concern&eacute;s doivent &ecirc;tre, dans votre boutique, identifiables avec leur num&eacute;ro SKU.</p>
<p>Si pour un produit, il n\'est pas trouv&eacute; d&rsquo;identification dans votre boutique, magnalister applique alors le taux de TVA, que vous aurez donn&eacute; sous &laquo;Importation de commande&raquo; &gt; &laquo;TVA d&rsquo;articles non r&eacute;f&eacute;renc&eacute;s en boutiques&raquo;.</p>
<p><strong>R&eacute;gle de commandes et de facturation Amazon B2B</strong> (n&eacute;cessite l&rsquo;adh&eacute;sion au programme Amazon Business seller) :</p>
<p>Lors de la transmission de commandes, Amazon ne transmet pas les informations l&eacute;gales de TVA. En cons&eacute;quence, magnalister transmet les commandes B2B &agrave; votre boutique, mais la facturation n\'est pas toujours l&eacute;galement correcte.</p>
<p>Toutefois, vous avez la possibilit&eacute; de r&eacute;cup&eacute;rer les informations l&eacute;gales de TVA, dans votre espace Amazon Seller Central et de les rentrer manuellement dans vos syst&egrave;mes de gestion boutique et/ou de stock.</p>
<p>Vous pouvez &eacute;galement utiliser le service de facturation fourni par Amazon pour les commandes B2B, qui contient toutes les donn&eacute;es l&eacute;gales.</p>
<p>En tant que commer&ccedil;ant adh&eacute;rent au programme Amazon Business seller, tous les documents n&eacute;cessaires pour &eacute;tablir des factures, y compris les informations de TVA, sont accessibles dans votre espace vendeur Amazon sous la rubrique, "rapports" &gt; "documents fiscaux". La mise &agrave; disposition des documents varie de 3 ou 30 jours et d&eacute;pend de votre contrat Amazon B2B.</p>
<p>Si vous adh&eacute;rez au programme logistique FBA, vous obtiendrez &eacute;galement les informations l&eacute;gales de TVA sous la rubrique, "exp&eacute;di&eacute; par Amazon" &gt; "rapports".<br><br></p>
<p><strong>Note pour l\'import de commandes Amazon FBA</strong></p>
<p>Vous avez la possibilit&eacute; de bloquer l\'import de commandes Amazon FBA. Pour ce faire, ouvrez les param&egrave;tres avanc&eacute;s en bas. Sous "Import de commande" -&gt; "Import de commande FBA", vous pouvez d&eacute;sactiver l\'import.</p>
<p><strong>Important</strong> : Malgr&eacute; l\'import de commande FBA d&eacute;sactiv&eacute;, le nombre de commandes FBA dans magnalister sera enregistr&eacute; en arri&egrave;re-plan et ajout&eacute; &agrave; votre contingent de listage. Cela emp&ecirc;che tout abus possible du plugin magnalister pour Amazon FBA."</p>
';
MLI18n::gi()->{'amazon_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs d’Amazon ne peuvent être conservées, que quelques semaines au maximum. <br>
<br>
<b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__label'} = 'Groupe clients';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__help'} = 'Vous pouvez choisir ici un groupe dans lesquel vos clients Amazon seront classés. Pour créer des groupes, rendez-vous dans le menu de l\'administration de votre boutique PrestaShop ->Clients ->Groupes. Lorsqu\'ils sont créés, ils apparaissent dans la liste de choix proposée. ';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__help'} = '               Définissez ici le statut qui sera attribué aux commandes importées d\'Amazon dans votre boutique. <br>
Si vous utilisez un système interne de gestion des créances, il est recommandé, de définir le statut de la commande comme étant "payé".';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__label'} = 'Statut pour les commandes FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__help'} = 'Une commande FBA est une commande livrée par le service d\'expédition d’Amazon.
Cette fonction est uniquement réservée aux commerçants qui y ont souscrit.<br>
<br>
Définissez ici, le statut qui sera automatiquement attribué aux commandes FBA importées d\'Amazon vers votre boutique. <br>
Si vous utilisez un système interne de gestion des créances, il est recommandé, de définir le statut de la commande comme étant "payé". <br>

';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__label'} = 'Importation des commandes FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__valuehint'} = 'Ne pas importer les commandes FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__help'} = '
    <p><strong>Ne pas importer les commandes via Amazon FBA</strong></p>
    <p>Vous avez la possibilit&eacute; d\'emp&ecirc;cher l\'importation de commandes FBA dans votre boutique.</p>
    <p>Cochez la case pour activer cette fonctionnalit&eacute; et l\'importation des commandes exclura toute commande FBA.</p>
    <p>Si vous retirez &agrave; nouveau la coche, les nouvelles commandes FBA seront import&eacute;es comme d\'habitude.</p>
    <p><strong>Notes importantes</strong> :&nbsp;</p>
    <ul>
        <li>Si vous activez cette fonction, toutes les autres fonctions FBA dans le cadre de l\'importation de la commande ne sont pas disponibles pour vous pour ce moment.<br><br></li>
        <li>Malgr&eacute; l\'import de commande FBA d&eacute;sactiv&eacute;, le nombre de commandes FBA dans magnalister sera enregistr&eacute; en arri&egrave;re-plan et ajout&eacute; &agrave; votre contingent de listage. Cela emp&ecirc;che tout abus possible du plugin magnalister pour Amazon FBA.</li>
    </ul>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__label'} = 'Mode de paiement des commandes FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__help'} = 'Mode de paiement qui sera attribué à toutes les commandes expédiées par Amazon. Valeur par défaut : "Amazon".<br><br>
Ce réglage est important pour l\'impression des bons de livraison et des factures, mais aussi pour le traitement ultérieur des commandes dans votre boutique ainsi que dans votre gestion des marchandises.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__label'} = 'Mode d\'expédition des commandes FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__help'} = 'Mode d\'expédition qui sera attribué aux commande FBA lors de l\'importation des commandes. Mode d\'expédition par défaut : "amazon"<br><br>
Ce réglage est important pour l\'impression des bons de livraison et des factures, mais aussi pour le traitement ultérieur des commandes dans votre boutique.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__label'} = 'Transporteur';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__help'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__hint'} = 'Sélectionnez le transporteur qui sera indiqué dans toutes les commandes Amazon. Cette information doit obligatoirement être renseignée. Pour plus d’informations consultez l’infobulle.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.additional__label'} = '&nbsp;&nbsp;&nbsp;&nbsp;Transporteurs supplémentaires';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.additional__help'} = 'Amazon propose plusieurs transporteurs standards à la présélection. Vous pouvez agrandir cette liste.
Entrez alors d\'autres transporteurs, séparés par une virgule, dans la zone de texte.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__label'} = 'Annulation de la commande si';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__help'} = 'Définissez ici le statut de la commamde en boutique, qui doit automatiquement annuler la commande  sur Amazon. <br>
<br>
Remarque : Une annulation partielle de commande via l\'API n\'est pas proposée par Amazon. La commande toute entière est annulée avec cette fonctionnalité et est créditée à l\'acheteur.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount__label'} = 'Promotion Amazon';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount__help'} = '<p>Vous avez la possibilité de créer des actions promotionnelles sous forme de remises sur les produits ou sur l\'expédition dans Amazon Seller Central. Si un produit est vendu sur Amazon avec une remise correspondante, magnalister en tient compte lors de l\'importation de la commande :</p>
<p>Dans le cadre de l\'importation de la commande, les remises sur les produits et les remises sur les frais d\'expédition sont enregistrées dans la boutique en ligne en tant que postes de produits distincts.</p>
<p>Pour cela, magnalister crée la position de commande avec le numéro d\'article prédéfini (SKU), qui est enregistré ici dans le champ de saisie de droite. Par défaut, nous avons prédéfini les SKU suivants :</p>
<ul>
    <li>Remises sur les produits : "__AMAZON_DISCOUNT__".</li>
    <li>Remises d\'expédition : "__AMAZON_SHIPPING_DISCOUNT__".</li>
</ul>
<p>Vous pouvez à tout moment écraser ces SKU et enregistrer vos propres désignations.</p>
<p><strong>Remarque importante</strong> : lors de l\'attribution de vos propres SKU, assurez-vous qu\'ils ne sont pas identiques aux SKU des produits existants de la boutique, sinon le stock de ces produits sera involontairement réduit lors de l\'importation de la commande d\'une action promotionnelle.</p>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount.products_sku__label'} = 'Référence pour remise sur l’article';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount.shipping_sku__label'} = 'Référence pour remise sur l’expédition';
MLI18n::gi()->{'amazon_config_emailtemplate__field__orderimport.amazoncommunicationrules.blacklisting__label'} = 'Directives de communication Amazon';
MLI18n::gi()->{'amazon_config_emailtemplate__field__orderimport.amazoncommunicationrules.blacklisting__valuehint'} = 'Respecter les directives d\'Amazon et éviter d\'envoyer des e-mails aux acheteurs Amazon';
MLI18n::gi()->{'amazon_config_emailtemplate__field__orderimport.amazoncommunicationrules.blacklisting__help'} = '
<p><strong>Respecter les directives d\'Amazon et &eacute;viter d\'envoyer des e-mails aux acheteurs Amazon</strong></p>
<p>Les politiques de communication d\'Amazon interdisent l\'envoi de notifications par courriel (telles que les confirmations de commande ou d\'exp&eacute;dition) directement du vendeur &agrave; l\'acheteur, hors de la plateforme Amazon.</p>
<p>En activant l\'option &ldquo;Respecter les directives d\'Amazon et &eacute;viter d\'envoyer des e-mails aux acheteurs Amazon&rdquo;, magnalister modifie l\'adresse courriel d\'Amazon pour la rendre inop&eacute;rante et ainsi emp&ecirc;cher sa livraison. Cela garantit le respect des politiques de communication d\'Amazon, m&ecirc;me si votre syst&egrave;me de gestion de boutique envoie automatiquement des courriels aux acheteurs.</p>
<p>Pour envoyer des courriels directement depuis votre syst&egrave;me de gestion de boutique ou via magnalister, malgr&eacute; les r&egrave;gles d\'Amazon, il suffit de d&eacute;sactiver cette option.</p>
<p><strong>Note importante</strong> : L\'envoi direct de courriels du vendeur &agrave; l\'acheteur peut vous exposer &agrave; un risque de suspension par Amazon. Nous recommandons vivement de maintenir l\'option par d&eacute;faut active et ne saurions &ecirc;tre tenus responsables de tout dommage &eacute;ventuel.</p>
<p><strong>Comment magnalister bloque-t-il efficacement les e-mails ?</strong></p>
<p>Lorsque votre syst&egrave;me de boutique ou magnalister d&eacute;clenche l\'envoi d\'un e-mail, magnalister pr&eacute;fixe l\'adresse e-mail de l\'acheteur Amazon avec &laquo; blacklisted &raquo;, rendant ainsi l\'e-mail non distribuable (par exemple : blacklisted-max-mustermann@amazon.de). En r&eacute;sultat, vous recevrez une alerte de non-distribution (appel&eacute;e Mailer Daemon) de la part de votre serveur de courrier &eacute;lectronique.</p>
<p>Cette mesure s\'applique tant aux e-mails envoy&eacute;s directement par le syst&egrave;me de la boutique qu\'&agrave; la confirmation de commande que vous avez la possibilit&eacute; d\'activer dans la section suivante, intitul&eacute;e &laquo; Courriel &agrave; l\'acheteur &raquo;.</p>
';
MLI18n::gi()->{'amazon_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'amazon_config_emailtemplate__legend__guidelines'} = 'Directives de communication Amazon';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__help'} = '
<p><strong>Envoyer un e-mail au client lors de la r&eacute;ception d\'une commande</strong></p>
<p>Cette section vous permet de d&eacute;cider si des notifications par e-mail, comme les confirmations de commande, doivent &ecirc;tre envoy&eacute;es aux acheteurs Amazon directement depuis magnalister. Plus bas, vous avez la possibilit&eacute; de personnaliser le contenu de ces e-mails.</p>
<p><strong>Avertissement crucial</strong> : Les politiques de communication d\'Amazon prohibent explicitement l\'&eacute;change direct de notifications par e-mail entre vendeurs et acheteurs. Afin d\'&eacute;viter toute sanction d\'Amazon, telles que la suspension de compte, nous recommandons fortement de ne pas envoyer d\'e-mails depuis magnalister ou votre syst&egrave;me de gestion de boutique aux clients Amazon. Nous d&eacute;clinons toute responsabilit&eacute; pour les pr&eacute;judices qui pourraient survenir de telles actions.</p>
<p><strong>Attention sp&eacute;ciale</strong> : Si vous optez pour l\'envoi d\'e-mails aux clients via magnalister, il est imp&eacute;ratif de d&eacute;s&eacute;lectionner au pr&eacute;alable l\'option &ldquo;Adh&eacute;rer aux directives d\'Amazon et &eacute;viter les e-mails aux clients Amazon&rdquo; situ&eacute;e dans les param&egrave;tres pr&eacute;c&eacute;dents.</p>
';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__modal__true'} = '
<p>Avis important sur les directives de communication d&rsquo;Amazon</p>
<p>Il est important de souligner que les politiques de communication d\'Amazon proscrivent toute forme de communication directe par e-mail entre vendeurs et acheteurs.</p>
<p>Si, malgr&eacute; cela, vous d&eacute;sirez notifier vos clients par e-mail &agrave; l\'occasion de nouvelles commandes, il vous faudra alors retirer la s&eacute;lection de l\'option &ldquo;Respecter les directives d\'Amazon et &eacute;viter d\'envoyer des e-mails aux acheteurs Amazon&rdquo;.</p>
<p>Merci de confirmer votre intention de r&eacute;aliser cette modification :</p>
<p>{#i18n:ML_BUTTON_LABEL_OK#} : Oui, je choisis de ne pas respecter cette restriction et de communiquer par e-mail avec les clients Amazon</p>
<p>{#i18n:ML_BUTTON_LABEL_ABORT#} : Non, je d&eacute;cide de me conformer aux normes de communication d\'Amazon</p>
';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.originator.name__label'} = 'Nom de l\'expéditeur';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.originator.adress__label'} = 'Adresse de l\'expéditeur';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.subject__label'} = 'Objet';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.content__label'} = 'Contenu de l\'E-mail';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.content__hint'} = 'Liste des champs disponibles pour "objet" et "contenu".
        <dl>
                <dt>#MARKETPLACEORDERID#</dt>
                        <dd>Marketplace Order Id</dd>
                <dt>#FIRSTNAME#</dt>
                        <dd>Prénom de l\'acheteur</dd>
                <dt>#LASTNAME#</dt>
                        <dd>Nom de l\'acheteur</dd>
                <dt>#EMAIL#</dt>
                        <dd>Adresse E-Mail de l\'acheteur</dd>
                <dt>#PASSWORD#</dt>
                        <dd>Mot de passe de l\'acheteur pour vous connecter à votre boutique. Seulement pour les clients qui seront automatiquement placés, sinon l\'espace réservé sera remplacé par \'(comme on le sait)\'.</dd>
                <dt>#ORDERSUMMARY#</dt>
                        <dd>Résumé des articles achetés. Devrait être à part dans une ligne.<br/><i>Ne peut pas être utilisé dans la ligne objet!</i></dd>
                <dt>#ORIGINATOR#</dt>
                        <dd>Nom de l\'expéditeur</dd>
        </dl>';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.copy__label'} = 'Copie à l\'expéditeur';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.copy__help'} = 'Activez cette fonction si vous souhaitez recevoir une copie du courriel.';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippingaddresses'} = 'Adresses de livraison';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippingservice'} = 'Paramètres de livraison';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippinglabel'} = 'Options de livraisons';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address__label'} = 'Adresse de livraison';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.name__label'} = 'Nom';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.company__label'} = 'Nom de la société';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.streetandnr__label'} = 'Rue et numéro de rue';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.city__label'} = 'Ville';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.state__label'} = 'Land / Canton';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.zip__label'} = 'Code postale';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.country__label'} = 'Pays';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.phone__label'} = 'Numéro de téléphone ';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.email__label'} = 'Adresse e-Mail';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.carrierwillpickup__label'} = 'Enlèvement de colis';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.carrierwillpickup__default'} = 'false';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.deliveryexperience__label'} = 'Conditions de livraison';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.fallback.weight__label'} = 'Poids alternatif';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.fallback.weight__help'} = 'Si sur l\'un de vos articles le poids n\'est pas indiqué cette valeur sera appliquée.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.weight.unit__label'} = 'Unité de mesure pour le poids ';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.size.unit__label'} = 'Unité de mesure pour la taille';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension__label'} = 'Taille de colis personnalisée';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.text__label'} = 'Dénomination';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.length__label'} = 'Longueur ';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.width__label'} = 'Largeur';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.height__label'} = 'Hauteur';

// Amazon VCS
MLI18n::gi()->{'amazon_config_vcs__legend__amazonvcs'} = 'Solution de facturation automatisée d’Amazon';
MLI18n::gi()->{'amazon_config_vcs__legend__amazonvcsinvoice'} = 'Données pour la création des factures via magnalister';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__label'} = 'Réglages effectués sur Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__off'} = 'Je ne participe pas au programme de facturation automatisée Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__vcs'} = 'Réglage Amazon: Amazon génère automatiquement mes factures TVA';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__vcs-lite'} = 'Réglage Amazon: Je télécharge mes propres factures TVA';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__hint'} = 'L’option définie ici doit correspondre à votre sélection dans le programme de facturation Amazon (définie dans votre espace vendeur)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__help'} = '
    Veuillez sélectionner sous quelle forme vous participez au programme de facturation Amazon. Le paramétrage de base doit être effectué dans votre espace vendeur Amazon.
    <br>
    Avec magnalister, trois options pour la transmission de vos factures à Amazon s’offrent à vous :
    <ol>
        <li>
            Je ne participe pas au programme de facturation automatisée Amazon<br>
            <br>
            Si vous avez décidé de ne pas participer au programme de facturation automatisée d’Amazon, veuillez sélectionner cette option. Vous pouvez toujours définir si, et comment vous souhaitez télécharger vos factures sur Amazon sous la rubrique “Transmission des factures“. Cependant, vous ne bénéficiez pas des avantages du programme de facturation (obtention d’une certification sous forme d’un badge vendeur et meilleure visibilité).<br>
            <br>
        </li>
        <li>
            Réglage Amazon: Amazon génère automatiquement mes factures TVA<br>
            <br>
            La facturation et le calcul de la TVA sont entièrement pris en charge par Amazon. Le paramétrage doit être effectué directement dans votre espace vendeur Amazon.<br>
            <br>
        </li>
        <li>
            Réglage Amazon: Je télécharge mes propres factures TVA<br>
            <br>
            Sélectionnez cette option si vous souhaitez télécharger vos factures créées dans votre boutique ou par magnalister (la création des factures peut être configurée dans la rubrique “Transmission des factures“). Dans ce cas Amazon ne prends en charge que le calcul de la TVA. Le paramétrage doit être effectué directement dans votre espace vendeur Amazon.<br>
            <br>
        </li>
    </ol>
    <br>
    Notes importantes :
    <ul>
        <li>A chaque importation des commandes, magnalister vérifie si une facture a été créé pour les commandes importées via magnalister et les transmet à Amazon.<br><br></li>
    </ul>
';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__label'} = 'Transmission des factures';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__'} = 'Veuillez choisir';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__off'} = 'Ne pas transmettre les factures à Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__webshop'} = 'Transmettre les factures créées dans la boutique';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__magna'} = 'Charger magnalister de la création et de la transmission des factures';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__erp'} = 'Transmettre les factures créées dans un système tiers (par ex. PGI) à Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__help'} = '
    Choisissez ici comment vous souhaitez envoyer vos factures à Amazon :
    <ol>
        <li>
            <p>Ne pas transmettre les factures à Amazon</p>
            <p>Si vous sélectionnez cette option, vos factures ne seront pas transmises à Amazon. Cela signifie que vous devrez télécharger vos factures par vos propres soins.</p>
        </li>
        <li>
            <p>Transmettre les factures créées dans la boutique</p>
            <p>Si votre système de e-boutique prend en charge la création des factures, vous pouvez les télécharger sur Amazon.</p>
        </li>
        <li>
            <p>Les factures créées par des systèmes tiers (par exemple un système ERP) sont transmises à Amazon.</p>
            <p>Les factures que vous avez créées à l’aide d’un système tiers (par exemple un système ERP) peuvent être déposées sur le serveur de votre boutique en ligne, récupérées par magnalister et chargées sur la plateforme Amazon. Des informations complémentaires apparaissent après le choix de cette option dans l’icône info sous “Paramètres pour la transmission des factures créées à partir d’un système tiers [...]”.</p>
        </li> 
        <li>
            <p>Charger magnalister de la création et de la transmission des factures</p>
            <p>Sélectionnez cette option si vous souhaitez que magnalister prenne en charge la création et la transmission des factures. Pour ce faire, veuillez remplir les champs sous “Données pour la création des factures via magnalister”.</p>
        </li>
    </ol>
';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicedir__label'} = 'Factures téléchargées';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicedir__buttontext'} = 'Afficher';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.language__label'} = 'Invoice language';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.mailcopy__label'} = 'Copie de la facture à';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.mailcopy__hint'} = 'Entrez votre adresse email pour recevoir une copie de la facture téléchargée sur Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__label'} = 'Préfixe numéro de facture';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__hint'} = 'Si vous définissez un préfixe, celui-ci sera placé automatiquement devant le numéro de facture. Exemple : R10000. Le numéro des factures générées par magnalister commence par 10000';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__default'} = 'R';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__label'} = 'Préfixe numéro de facture d\'annulation';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__hint'} = 'Si vous définissez un préfixe, celui-ci sera placé automatiquement devant le numéro de facture d\'annulation. Exemple : S20000. Le numéro des factures d\'annulation générées par magnalister commence par 20000';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__default'} = 'S';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressleft__label'} = 'Adresse de l’entreprise (champ d’adresse de gauche)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressleft__default'} = 'Your name, Your street 1, 12345 Your town';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressright__label'} = 'Champ d’adresse de l\'entreprise (droite)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressright__default'} = "Your name\nYour street 1\n\n12345 Your town";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.headline__label'} = 'Intitulé de la facture';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.headline__default'} = 'Votre facture';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehintheadline__label'} = 'Intitulé : notes de facturation';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehintheadline__default'} = 'Notes de facturation';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__label'} = 'Texte d\'information';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__hint'} = 'Laissez le champ vide si aucune information ne doit figurer sur la facture.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__default'} = 'Votre texte d\'information pour la facture';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell1__label'} = 'Pied de page colonne 1';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell1__default'} = "Your name\nYour street 1\n\n12345 Your town";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell2__label'} = 'Pied de page colonne 2';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell2__default'} = "Your telephone number\nYour fax number\nYour homepage\nYour e-mail";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell3__label'} = 'Pied de page colonne 3';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell3__default'} = "Your tax number\nYour Ust. ID. No.\nYour jurisdiction\nYour details";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell4__label'} = 'Pied de page colonne 4';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell4__default'} = "Additional\nInformation\nin the fourth\ncolumn";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__label'} = 'Aperçus de la facture';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__buttontext'} = 'Aperçus';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__hint'} = 'Vous pouvez ici afficher un aperçu de votre facture avec les données que vous avez saisies.';

// New Shipment Options
MLI18n::gi()->{'amazon_config_carrier_option_group_marketplace_carrier'} = 'Transporteur Amazon';
MLI18n::gi()->{'amazon_config_carrier_option_group_additional_option'} = 'Options supplémentaires';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_carrier'} = 'Apparier les transporteur Amazon avec les transporteurs de votre boutique';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_shipmethod'} = 'Apparier les services d’expédition Amazon avec les les services d’expédition de votre boutique';
MLI18n::gi()->{'amazon_config_carrier_option_database_option'} = 'Correspondance des bases de données';
MLI18n::gi()->{'amazon_config_carrier_option_orderfreetextfield_option'} = 'magnalister ajoute un champ supplémentaire dans les détails de la commande';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_carrier'} = 'Entrer le nom du transporteur manuellement dans un champ ';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_shipmethod'} = 'Entrer le nom du service d’expédition manuellement dans un champ';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__label'} = 'Transporteur :';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__placeholder'} = 'Veuillez saisir le nom du service de livraison ici';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_carrier'} = 'Transporteur Amazon';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_shipmethod'} = 'Mode de livraison sur Amazon';
MLI18n::gi()->{'amazon_config_carrier_matching_title_shop_carrier'} = 'Transporteur défini dans votre boutique';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__label'} = 'Service d’expédition';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__hint'} = 'Sélectionnez le service s’expédition qui sera attribué à toutes les commandes Amazon. Le service d’expédition doit obligatoirement être renseigné.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__label'} = 'Service d’expédition :';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__placeholder'} = 'Entrez le mode d’expédition ici';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__label'} = 'Confirmer l’expédition avec l’adresse d’expédition';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__help'} = '
Sous "Statut (état) de la commande", sélectionnez le statut (l’état) de la commande qui confirme automatiquement la livraison sur Amazon.<br>
<br>
À droite, vous pouvez saisir l\'adresse à partir de laquelle les articles seront expédiés. Cela est utile si l\'adresse d\'expédition doit être différente de l\'adresse par défaut enregistrée dans Amazon (par exemple, lorsque expédition est faite à partir d\'un centre de logistique).<br>
<br>
Si vous laissez les champs d\'adresse vides, Amazon utilisera l\'adresse de l\'expéditeur que vous avez spécifiée dans vos paramètres d\'expédition Amazon (Seller Central).
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.name__label'} = 'Nom de l’entrepôt / du centre logistique';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line1__label'} = 'Adresse 1ère ligne';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line2__label'} = 'Adresse 2ème ligne';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line3__label'} = 'Adresse 3ème ligne';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.city__label'} = 'Ville';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.county__label'} = 'Comté';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.stateorregion__label'} = 'Département / région';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.postalcode__label'} = 'Code postal';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.countrycode__label'} = 'Pays';

/** BOPIS */
MLI18n::gi()->add('amazon_config_bopis', array(
    'legend' => array(
        'stores' => 'Magasins "Click & Collect en magasin"',
    ),
), false);

MLI18n::gi()->{'amazon_config_bopis__legend__products'} = 'Gestion des stocks de magasin';
MLI18n::gi()->{'amazon_config_bopis__legend__orders'} = 'Statut de commande';
MLI18n::gi()->{'amazon_config_bopis__legend__orderimport'} = '{#i18n:amazon_config_account_orderimport#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__label'} = 'Statut pour les commandes "Click & Collect en magasin".';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__help'} = 'Définit le statut de commande qu\'une commande "Click & Collect en magasin" importée d\'Amazon devrait automatiquement recevoir dans le magasin.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__label'} = 'Prêt à être récupéré';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__help'} = 'Définissez ici le statut du magasin qui devrait automatiquement définir le statut "Prêt à être récupéré" sur Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__label'} = 'Récupéré';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__help'} = 'Définissez ici le statut du magasin qui devrait automatiquement définir le statut "Récupéré" sur Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__label'} = 'Remboursement';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__help'} = 'Définissez ici le statut du magasin qui devrait automatiquement définir le statut "Remboursement" sur Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__label'} = 'Raison du remboursement';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__help'} = 'Sélectionnez ici une raison par défaut pour les remboursements qui sera ensuite sélectionnée lors de la synchronisation cronjob lorsqu\'un remboursement est effectué.';
MLI18n::gi()->{'amazon_bopis.refund.reason_NoInventory'} = 'Indisponibilité de stock';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerReturn'} = 'Retour client';
MLI18n::gi()->{'amazon_bopis.refund.reason_GeneralAdjustment'} = 'Ajustement général';
MLI18n::gi()->{'amazon_bopis.refund.reason_CouldNotShip'} = 'Impossible à expédier';
MLI18n::gi()->{'amazon_bopis.refund.reason_DifferentItem'} = 'Article différent';
MLI18n::gi()->{'amazon_bopis.refund.reason_Abandoned'} = 'Abandonné';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerCancel'} = 'Annulation client';
MLI18n::gi()->{'amazon_bopis.refund.reason_PriceError'} = 'Erreur de prix';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stores__label'} = 'Ajouter ou mettre à jour les points de retrait Click & Collect';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__label'} = 'Activer le point de retrait';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__help'} = 'Si la case est cochée, le point de retrait est considéré comme actif et les clients peuvent y retirer leur commande.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__label'} = 'Quantité disponible en magasin';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__help'} = '
    Spécifiez ici la quantité d\'article disponible pour le magasin respectif.<br/>
    <br/>
    Pour éviter les survente, vous pouvez sélectionner l\option <br/>
    "<i>Prendre en charge le stock de la boutique moins la valeur du champ de droite</i>".<br/>
    <br/>
    <strong>Exemple :</strong> valeur définie "<i>2</i>". Résultat : quatité disponible dans votre e-boutique : 10 → quantité disponible en magasin click and colleckt : 8<br/>
    <br/>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.store__label'} = 'Magasin';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.quantity__label'} = 'Stock disponible en magasin';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__label'} = 'Numéro d\'identification<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__help'} = 'Veuillez définir un identificateur pour votre point de retrait.
Celui-ci est utilisé pour l’identification interne sur Amazon, c\'est pourquoi il doit être unique et ne peut plus être modifié.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creation_error__label'} = 'En raison des raisons énumérées ci-dessous, nous n\'avons pas pu créer le magasin ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_update_error__label'} = 'En raison des raisons énumérées ci-dessous, nous n\'avons pas pu mettre à jour le magasin ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creationAndUpdate_error__label'} = 'Nous avons pu ajouter le magasin, mais en raison des raisons énumérées ci-dessous, nous n\'avons pas pu mettre à jour le magasin ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__label'} = 'Nom du point de retrait<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__help'} = 'Ce nom s\'affiche dans les cas d\'application pertinents. Le format doit être "nom du magasin - rue - code postal". ".';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__placeholder'} = 'nom du magasin - rue - code postal';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address__label'} = 'Adresse<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_storename'} = 'Nom (ex. : "nom du magasin - rue - code postal")';
MLI18n::gi()->{'amazon_bopis_addressline1'} = 'Adresse ligne 1<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_addressline2'} = 'Adresse ligne 2';
MLI18n::gi()->{'amazon_bopis_addressline3'} = 'Adresse ligne 3';
MLI18n::gi()->{'amazon_bopis_city'} = 'Ville<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_county'} = 'Comté';
MLI18n::gi()->{'amazon_bopis_district'} = 'District';
MLI18n::gi()->{'amazon_bopis_stateorregion'} = 'État ou région';
MLI18n::gi()->{'amazon_bopis_postalcode'} = 'Code postal<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_country'} = 'Pays<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.createstoresuccess'} = 'Magasin créé avec succès avec le code de source d\'approvisionnement suivant: ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.updatestoresuccess'} = 'Magasin mis à jour avec succès avec le code de source d\'approvisionnement suivant: ';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline1__label'} = '{#i18n:amazon_bopis_addressline1#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline2__label'} = '{#i18n:amazon_bopis_addressline2#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline3__label'} = '{#i18n:amazon_bopis_addressline3#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.city__label'} = '{#i18n:amazon_bopis_city#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.county__label'} = '{#i18n:amazon_bopis_county#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.district__label'} = '{#i18n:amazon_bopis_district#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.stateorregion__label'} = '{#i18n:amazon_bopis_stateorregion#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.postalcode__label'} = '{#i18n:amazon_bopis_postalcode#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.countrycode__label'} = '{#i18n:amazon_bopis_country#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__label'} = 'Fuseau horaire<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__label'} = 'Temps de traitement<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__help'} = 'Le temps de traitement décrit la période de temps qu\'il vous faudra pour préparer la commande pour le ramassage.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__label'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__label#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__help'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__help#}';
MLI18n::gi()->{'amazon_bopis.handling_time_Days'} = 'Jours';
MLI18n::gi()->{'amazon_bopis.handling_time_Hours'} = 'Heures';
MLI18n::gi()->{'amazon_bopis.handling_time_Minutes'} = 'Minutes';
MLI18n::gi()->{'amazon_bopis_value'} = 'Valeur';
MLI18n::gi()->{'amazon_bopis_timeunit'} = 'Unité de temps';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration'} = 'Coordonnées et heures d\'ouverture de la boutique<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration_hint'} = 'Si par exemple le magasin n\'est pas ouvert le samedi ou le dimanche, laissez les champs d\'heure d\'ouverture et de fermeture vides.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_bopis_contactdetails'} = 'Coordonnées de contact';
MLI18n::gi()->{'amazon_bopis_email'} = 'Email';
MLI18n::gi()->{'amazon_bopis_phone'} = 'Téléphone';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_bopis_monday'} = 'Lundi';
MLI18n::gi()->{'amazon_bopis_tuesday'} = 'Mardi';
MLI18n::gi()->{'amazon_bopis_wednesday'} = 'Mercredi';
MLI18n::gi()->{'amazon_bopis_thursday'} = 'Jeudi';
MLI18n::gi()->{'amazon_bopis_friday'} = 'Vendredi';
MLI18n::gi()->{'amazon_bopis_saturday'} = 'Samedi';
MLI18n::gi()->{'amazon_bopis_sunday'} = 'Dimanche';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_bopis_starttime'} = 'Heure de début';
MLI18n::gi()->{'amazon_bopis_endtime'} = 'Heure de fin';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_bopis_throughputconfig'} = 'Configuration de la capacité';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities__label'} = 'Capacités';
MLI18n::gi()->{'amazon_bopis_issupported'} = 'Est pris en charge?';
MLI18n::gi()->{'amazon_bopis_usefrommaster'} = 'Utiliser depuis la boutique?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__label'} = 'Sortie {#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation__label'} = 'Emplacement de retour';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address__label'} = 'Adresse';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.name__label'} = '{#i18n:amazon_bopis_storename#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline1__label'} = '{#i18n:amazon_bopis_addressline1#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline2__label'} = '{#i18n:amazon_bopis_addressline2#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline3__label'} = '{#i18n:amazon_bopis_addressline3#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.city__label'} = '{#i18n:amazon_bopis_city#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.county__label'} = '{#i18n:amazon_bopis_county#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.district__label'} = '{#i18n:amazon_bopis_district#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.stateorregion__label'} = '{#i18n:amazon_bopis_stateorregion#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.postalcode__label'} = '{#i18n:amazon_bopis_postalcode#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.countrycode__label'} = '{#i18n:amazon_bopis_country#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.phone__label'} = '{#i18n:amazon_bopis_phone#}';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel__label'} = 'Canal de livraison';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel__label'} = 'Canal de ramassage';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__label'} = 'Délai de conservation de la marchandise<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__help'} = 'Décrit la durée pendant laquelle la marchandise est disponible pour l\'enlèvement avant que vous n\'annuliez la commande.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
