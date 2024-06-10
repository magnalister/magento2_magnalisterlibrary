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

MLI18n::gi()->{'priceminister_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'priceminister_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'priceminister_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'priceminister_config_account_sync'} = 'Synchronisation du stock';
MLI18n::gi()->{'priceminister_config_account_orderimport'} = 'Importation des commandes';
MLI18n::gi()->{'priceminister_config_checkin_badshippingcost'} = 'La valeur saisie doit être de type numérique.';
MLI18n::gi()->{'priceminister_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_sender'} = 'Nom de votre boutique, de votre société, ...';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_sender_email'} = 'exemple@votre-boutique.fr';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_subject'} = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->{'priceminister_config_account_producttemplate'} = 'Gabarit pour fiche de produit';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_content'} = ' <style><!--
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
<p>Cher Client,<br>
<br>
Nous vous remercions d\'avoir effectué une commande sur #MARKETPLACE# et d’avoir acheté :</p>
<p>#ORDERSUMMARY#</p>
<p>Frais de port additionnels.</p>
<p>&nbsp;</p>
<p>cordialement</p>
<p>Notre équipe #ORIGINATOR#</p>
';
MLI18n::gi()->{'priceminister_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'priceminister_config_orderstatus_autoacceptance'} = 'Important : Vous avez désactivé la confirmation automatique des commandes. PriceMinisters ne transmet pas les frais de port, pour les commandes non confirmées, des commandes sans frais de port seront donc transmises à votre boutique. Nous recommandons donc, par conséquent, d\'activer l\'option "confirmation des commandes".';
MLI18n::gi()->{'priceminister_config_account__legend__account'} = 'Mes coordonnées';
MLI18n::gi()->{'priceminister_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'priceminister_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'priceminister_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'priceminister_config_account__field__username__label'} = 'Pseudo';
MLI18n::gi()->{'priceminister_config_account__field__token__label'} = 'Clé d\'authentification (Token)';
MLI18n::gi()->{'priceminister_config_account__field__token__help'} = 'Rendez-vous sur <a href="https://www.priceminister.com/usersecure?action=usrwstokenaccess" target="_blank">votre espace vendeur PriceMinister</a> et demandez un Token';
MLI18n::gi()->{'priceminister_config_prepare__legend__prepare'} = 'Préparation de l\'article';
MLI18n::gi()->{'priceminister_config_prepare__legend__upload'} = 'Téléchargement de l\'article : Préréglages';
MLI18n::gi()->{'priceminister_config_prepare__field__prepare.status__label'} = 'Filtre de statut';
MLI18n::gi()->{'priceminister_config_prepare__field__prepare.status__valuehint'} = 'Ne prendre en compte que les articles actifs';
MLI18n::gi()->{'priceminister_config_prepare__field__lang__label'} = 'Description de l\'articles';
MLI18n::gi()->{'priceminister_config_prepare__field__identifier__label'} = 'Identifier';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.status__label'} = 'Filtre de statut';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.status__valuehint'} = 'ne prendre en compte que les articles actifs';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.quantity__label'} = 'Nombre d\'articles du stock attribué au marché.';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.quantity__help'} = 'Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière. <br>
<br>
Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
<br>
<b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à Cdiscount: 8 (articles).<br>
<br>
<b>Remarque :</b> Si vous souhaitez cesser la vente sur Cdiscount, d’un article que vous avez encore en stock, mais que vous avez désactivé de votre boutique, procédez comme suit :
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
MLI18n::gi()->{'priceminister_config_prepare__field__itemcondition__label'} = 'État de l\'article';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__label'} = 'Résultats';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__help'} = 'Définissez le nombre de produits affichés par page lors du Multi appariement. Plus le nombre est important, plus le chargement de la page sera long.';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__hint'} = 'Par page lors du Multi appariement';
MLI18n::gi()->{'priceminister_config_price__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'priceminister_config_price__field__price__label'} = 'Prix';
MLI18n::gi()->{'priceminister_config_price__field__price__help'} = 'Veuillez saisir un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. 
Pour indiquer un rabais faire précéder le chiffre d’un moins. ';
MLI18n::gi()->{'priceminister_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__help'} = '                Cette zone de texte sera utilisée dans les transmissions de données vers Priceminister (prix après la virgule).<br/><br/>

                <strong>Par exemple :</strong> <br /> 
                 Valeur dans la zone de texte: 99 <br />
                 Prix d\'origine: 5.58 <br />
                 Prix final: 5.99 <br /><br />
                 La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix. <br/>
                 Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule.<br/>
                 Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'priceminister_config_price__field__priceoptions__label'} = 'Options de tarification ';
MLI18n::gi()->{'priceminister_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__valuehint'} = 'Actualiser le taux de change automatiquement ';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'priceminister_config_sync__legend__sync'} = 'Synchronisation des Inventars';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.tomarketplace__label'} = 'Variation du stock boutique';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.tomarketplace__help'} = 'Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock Priceminister et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. Si la synchronisation est activée, les données de votre base de données seront appliquées à Priceminister.
Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br>
<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué. <br>
 <br>
<b>Commande ou modification d’un article; l’état du stock Priceminister  est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à Priceminister. <br>
Attention, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, <b>ne seront ni pris en compte, ni transmis!</b> <br>
<br>
<b>Commande ou modification d’un article; l’état du stock Priceminister est modifié (différence)</b> <br>
Si par exemple, un article a été acheté deux fois en boutique, le stock Priceminister sera réduit de 2 unités. <br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “Priceminister” &rarr; “configuration” &rarr; “préparation d’article”, ce changement sera appliqué sur Priceminister. <br>
<br>
<b>Attention</b>, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<br>
<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr;  Préparation de l’article &rarr; Préréglages de téléchargement d’article. ';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.frommarketplace__label'} = 'Variation du stock PriceMinister';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.frommarketplace__help'} = 'Lorsque par exemple 3 articles sont achetés, la quantité de stock boutique imputé à l\'article se trouve réduit de 3.  <br><br> <strong>Important : </strong> Cette fonction n\'est active que lorsque que l\'importation de commande à été activé !';
MLI18n::gi()->{'priceminister_config_sync__field__inventorysync.price__label'} = 'Prix de l&apos;article';
MLI18n::gi()->{'priceminister_config_sync__field__inventorysync.price__help'} = '<b>Synchronisation automatique via CronJob (recommandée)</b><br>
<br>
Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock Priceminister et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. <b>Si la synchronisation est activée, les données de votre base de données seront appliquées à Priceminister.</b><br>
 Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#}<br>
<br>
<b>Attention</b>, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué.<br>
 <br>
<b>Commande ou modification d’un article; l’état du stock Priceminister  est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à Priceminister. <br>
<b>Attention</b>, les changements ayant lieu <b>uniquement</b> dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<b>Commande ou modification d’un article; l’état du stock Priceminister est modifié (différence)</b><br>
Si par exemple, un article a été acheté deux fois en boutique, le stock Priceminister sera réduit de 2 unités.<br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “Priceminister” &rarr;“configuration” &rarr;“préparation de l’article”, ce changement sera appliqué sur Priceminister.<br>
<b>Attention</b>, les changements ayant lieu <b>uniquement</b> dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br><br>

<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr; Préparation de l’article &rarr; Préréglages de téléchargement d’article. 

';
MLI18n::gi()->{'priceminister_config_orderimport__legend__importactive'} = 'Importation de commandes';
MLI18n::gi()->{'priceminister_config_orderimport__legend__mwst'} = 'TVA';
MLI18n::gi()->{'priceminister_config_orderimport__legend__orderstatus'} = 'Synchronisation des statuts de commandes provenant de la boutique PriceMinister';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingfromcountry__label'} = 'La commande est expédiée à partir de';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__label'} = 'Confirmation automatique';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__valuehint'} = 'Confirmation automatique';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__help'} = 'Si vous desactivez la fonction "Confirmation automatique", les commandes seront transmisent à votre boutique sans frais de port, car PriceMinisters ne transmet pas les frais de port, des commandes qui ne sont pas confirmées.Nous vous conseillons donc d\'activer la fonction.
';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__label'} = 'Acepter la commande avec';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__hint'} = '<span style="color:#e31a1c;">Pour plus d\'explications, lisez les points d\'informations.</span>';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__help'} = 'Avant de confirmer la livraison. veuillez définir le statut qui acceptera les commandes sur Priceminister. .<br/><br/><b>Attention:</b><br/><br/>
Les commandes doivent-être acceptées ou rejetées dans un délai de 2 jours, autrement votre compte sera banni.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__label'} = 'Refuser la commande avec';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__hint'} = '<span style="color:#e31a1c;">Pour plus d\'explications, lisez les points d\'informations.</span>';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__help'} = 'Définissez ici, le statut boutique, qui doit automatiquement activer la fonction "annuler la commande" sur Priceminister.<br/><br/><b>Attention:</b><br/>
Les commandes doivent-être acceptées ou rejetées dans un délai de 2 jours, autrement votre compte sera banni.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmation d\'expédition avec';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.shipped__help'} = 'Définissez ici le statut boutique, qui doit automatiquement activer la fonction "Confirmation de la livraison" sur Priceminister.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.canceled__label'} = 'Annuler la commande avec';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.canceled__help'} = 'Définissez ici, le statut boutique, qui doit automatiquement activer la fonction "annuler la commande" sur Priceminister. <br/><br/>

<b>Remarque</b> : Par l’activation de cette fonction, l’article ne serra pas signalé comme “envoyé” sur Priceminister, mais cela ne constitue en aucun cas l’annulation de la commande.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.comment__label'} = 'Motif d\'annulation';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.comment__help'} = 'Saisissez ici le motif d\'annulation qui sera attribué à toutes les commandes annulées.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.carrier__label'} = 'Transporteur';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.carrier__help'} = 'Transporteur principal automatiquement proposé à la confirmation de la commande.';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__label'} = 'TVA';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__hint'} = 'Lors d\'une importation, le taux d\'imposition d\'une commandes ne venant pas de la boutique, sera alors calculé en %.';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__help'} = 'Si l\'article n\'a pas été enregistré sur magnalister, la TVA ne peut pas être déterminée.<br />
                 Comme solution alternative, la valeur sera fixée en pourcentage pour chaque produit enregistré, dont la TVA n\'est pas connue par Priceminister, lors de l\'importation.';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__label'} = 'Activer l\'importation';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__help'} = 'Les importations de commandes doivent elles  être effectuées à partir de la place de marché? <br>
<br>
Si la fonction est activée, les commandes seront automatiquement importées toutes les heures.<br>
<br>
Vous pouvez à tout moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délai maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation, utilisez le lien suivant : <br>
<i>{#setting:sSyncInventoryUrl#}</i> <br>
<br>

<b>Attention</b>, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué.
';
MLI18n::gi()->{'priceminister_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs de Priceminister ne peuvent être conservées, que quelques semaines au maximum. <br>
';
MLI18n::gi()->{'priceminister_config_orderimport__field__customergroup__label'} = 'Groupe clients';
MLI18n::gi()->{'priceminister_config_orderimport__field__customergroup__help'} = 'Vous pouvez choisir ici un groupe dans lesquel vos clients seront classés. Pour créer des groupes, rendez-vous dans le menu de l\'administration de votre boutique PrestaShop ->Clients ->Groupes. Lorsqu\'ils sont créés, ils apparaissent dans la liste de choix proposée. ';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande dans votre boutique';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.open__help'} = ' Définissez ici, Le statut qui sera automatiquement attribué aux commandes importé de Priceminister vers votre boutique. <br>
Si vous utilisez un système interne de gestion des créances, il est recommandé, de définir le statut de la commande comme étant "payé".';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingmethod__label'} = 'Envoi de la commande';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingmethod__help'} = 'Mode d\'expédition assigné à toutes les commandes PriceMinister. Standard : « PriceMinister ».<br><br> Ce réglage est important pour l\'impression des bons de livraison, des factures, et pour le traitement par la boutique et le stock. ';
MLI18n::gi()->{'priceminister_config_producttemplate__legend__product__title'} = 'Gabarit pour fiche de produit';
MLI18n::gi()->{'priceminister_config_producttemplate__legend__product__info'} = 'Template pour une personnalisation de la présentation de vos article sur vos annonces Priceminister (Vous pouvez désactiver l\'éditeur sous "Configuartion générale"&rarr;"Réglages expert".)';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.name__label'} = 'No du template d\'articles';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.name__help'} = '<b>Nom du produit sur Priceminister </b><br>
Saisissez dans ce champ le nom de l’article, tel que vous voulez qu’il apparaisse sur votreannonce Priceminister. <br>
paramètre générique possible : <br>
#TITLE# : sera automatiquement remplacé par le nom de l’article. <br>
#BASEPRICE# sera remplacé par le prix de base de l’article si celui-ci est indiqué dans votre boutique.<br>
<br>
Noter que le paramètre #BASEPRICE# n’est pas absolument nécessaire puisqu’en principe magnalister transmet automatiquement les prix de base de votre boutique à Priceminister.
<br>
Si vous saisissez le prix de base de votre article dans votre boutique, alors que vous l’avez déjà mis en vente sur eBay, veuillez télécharger l’article à nouveau, afin que les changements soient pris en compte sur Priceminister.<br>
<br>
Utilisez le paramètre #BASEPRICE#, pour des unités non métriques,  rejetées par Priceminister ou pour indiquer le prix de base d’articles, dans des catégories dans lesquelles eBay ne le prévoit pas.<br>
<br>
<b>Attention : Si vous utilisez le paramètre #BASEPRICE#, veillez à ce que la synchronisation des prix soit désactivée.</b> Sur Priceminister, le titre ne peut pas être modifié. Si, vous ne vous ne désactivez pas la synchronisation, le prix indiqué dans le titre ne sera plus concordant avec le prix réel, si celui-ci a été modifié dans votre boutique.<br>
<br>
#BASEPRICE# est remplacé dès que vous téléchargez vos articles sur Priceminister.<br>
<br>
<b>Attention :</b> <br>
Les titres d\'annonces excédants 40 caractère ne sont pas acceptés par priceminister. Si le titre d\'une annonce contient plus de 40 caractères, magnalister raccourcira le titre à l\'endroit correspondant.';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.content__label'} = 'Corp du template';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.content__hint'} = 'Liste des champs disponibles pour la rubrique: <br>
<br>
#TITLE#<br>
<BLOCKQUOTE>
<p>nom du produit</p>
</BLOCKQUOTE>
#ARTNR#
<BLOCKQUOTE>
<p>numéro d’article dans votre boutique</p>
</BLOCKQUOTE>
#PID#
<BLOCKQUOTE>
<p>identifiant du produit dans votre boutique</p>
</BLOCKQUOTE>
#SHORTDESCRIPTION#
<BLOCKQUOTE>
<p>description abrégée de l’article de votre boutique</p>
</BLOCKQUOTE>
#DESCRIPTION#
	<BLOCKQUOTE>
<p>description de l’article de votre boutique</p>
	</BLOCKQUOTE>
#PICTURE1#
	<BLOCKQUOTE>
<p>première image de l’article</p>
	</BLOCKQUOTE>
#PICTURE2# etc.
<BLOCKQUOTE>
<p>deuxième image de l’article; vous pouvez ajouter plus d’images de l’article (autant que dans votre boutique) en saisissant #PICTURE3#, #PICTURE4# etc.</p>
</BLOCKQUOTE>
<br>
<p><font color="red">(les paramètres suivants ne sont pas disponibles sur PrestaShop)</font></p>
<br>
<br>

Champs de texte libre pour description d’article:<br>
<br>
#Description1# #Freetextfield1#<br>
#Description2# #Freetextfield2#<br>
#description12# #freetextfield1#<br>
<br>
Prise en charge des champs de texte libre: le chiffre derrière le paramètre générique correspond à la position du texte.<br>
<br>
#PROPERTIES#<br>
liste contenant toutes les caractéristiques du produit. Vous pouvez changer l’apparence de la liste avec CSS.
';
MLI18n::gi()->{'priceminister_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.originator.name__label'} = 'Nom de l\'expéditeur';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.originator.adress__label'} = 'Adresse E-Mail de l\'expéditeur';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.subject__label'} = 'Objet';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.content__label'} = 'Contenu';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.content__hint'} = 'Liste des champs disponibles pour "objet" et "contenu".
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
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.copy__label'} = 'Copie à l\'expéditeur. ';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.copy__help'} = 'Une copie sera automatiquement envoyée à l\'expéditeur. ';
