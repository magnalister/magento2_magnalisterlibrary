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

MLI18n::gi()->{'check24_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'check24_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'check24_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'check24_config_account_sync'} = 'Synchronisation';
MLI18n::gi()->{'check24_config_account_orderimport'} = 'Importation des commandes';
MLI18n::gi()->{'check24_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'check24_config_account_emailtemplate_sender'} = 'Nom de votre boutique, de votre société, ...';
MLI18n::gi()->{'check24_config_account_emailtemplate_sender_email'} = 'exemple@votre-boutique.fr';
MLI18n::gi()->{'check24_config_account_emailtemplate_subject'} = 'Votre commande sur #SHOPURL#';
MLI18n::gi()->{'check24_config_account_emailtemplate_content'} = ' <style><!--
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
MLI18n::gi()->{'check24_config_account__legend__account'} = 'Mes coordonnées';
MLI18n::gi()->{'check24_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'check24_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'check24_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'check24_config_account__field__mpusername__label'} = 'Nom d\'utilisateur';
MLI18n::gi()->{'check24_config_account__field__mpusername__help'} = 'Les données d\'accès à l\'interface de CHECK24 se trouvent après la connexion à CHECK24 sous "Paramètres" -> "Transmission des ordres" -> Configuration et là dans la section "Vos données d\'accès à l\'interface".';
MLI18n::gi()->{'check24_config_account__field__mppassword__label'} = 'Mot de passe FTP';
MLI18n::gi()->{'check24_config_account__field__port__label'} = 'Port FTP';
MLI18n::gi()->{'check24_config_account__field__ftpserver__label'} = 'Serveur FTP';
MLI18n::gi()->{'check24_config_account__field__csvurl__label'} = 'Chemin d\'accès vers votre tableau CSV';
MLI18n::gi()->{'check24_config_prepare__legend__upload'} = 'Préparation de l\'article';
MLI18n::gi()->{'check24_config_prepare__field__checkin.status__label'} = 'Statut du filtre';
MLI18n::gi()->{'check24_config_prepare__field__checkin.status__hint'} = 'Ne reprendre que les articles actifs';
MLI18n::gi()->{'check24_config_prepare__field__lang__label'} = 'Description de l\'article';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__label'} = 'Taille d\'image';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__help'} = 'Saisissez ici la largeur maximale en pixel, que votre image doit avoir sur votre page. La hauteur sera automatiquement ajustée. <br>
Vos images originales se trouvent dans le dossier image sous l’adresse : <br><i>{#setting:sSourceImagePath#}</i>. Après ajustage, elles sont versées dans le dossier : <br><i>{#setting:sImagePath#}</i>, et sont prêtes à être utilisées par les places de marché.';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__hint'} = 'Enregistrée sous: {#setting:sImagePath#}';
MLI18n::gi()->{'check24_config_prepare__field__quantity__label'} = 'Variation de stock';
MLI18n::gi()->{'check24_config_prepare__field__quantity__hint'} = '';
MLI18n::gi()->{'check24_config_prepare__field__quantity__help'} = 'Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière. <br>
<br>
Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
<br>
<b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à CHECK24: 8 (articles).<br>
<br>
<b>Remarque :</b> Si vous souhaitez cesser la vente sur CHECK24, d’un article que vous avez encore en stock, mais que vous avez désactivé de votre boutique, procédez comme suit :
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
MLI18n::gi()->{'check24_config_prepare__field__shippingtime__label'} = 'Délais de livraison';
MLI18n::gi()->{'check24_config_prepare__field__shippingcost__label'} = 'Frais de port';
MLI18n::gi()->{'check24_config_price__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'check24_config_price__field__price__label'} = 'Prix';
MLI18n::gi()->{'check24_config_price__field__price__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price__help'} = 'Vous pouvez ici saisir un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. Le rabais commence par un moins devant le chiffre.';
MLI18n::gi()->{'check24_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'check24_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'check24_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'check24_config_price__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'check24_config_price__field__price.signal__help'} = '                Cette zone de texte sera utilisée dans les transmissions de données vers la place de marché, (prix après la virgule).<br/><br/>

                <strong>Par exemple :</strong> <br /> 
                 Valeur dans la zone de texte: 99 <br />
                 Prix d\'origine: 5.58 <br />
                 Prix final: 5.99 <br /><br />
                 La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix. <br/>
                 Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule.<br/>
                 Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'check24_config_price__field__priceoptions__label'} = 'Options de tarification ';
MLI18n::gi()->{'check24_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'check24_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'check24_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'check24_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__hint'} = 'Actualiser automatiquement le taux de change';
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__help'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__alert'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'check24_config_sync__legend__sync'} = 'Synchronisation des inventaires';
MLI18n::gi()->{'check24_config_sync__field__stocksync.tomarketplace__label'} = 'Variation du stock boutique';
MLI18n::gi()->{'check24_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'check24_config_sync__field__stocksync.tomarketplace__help'} = 'Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock CHECK24 et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. Si la synchronisation est activée, les données de votre base de données seront appliquées à Check24.
Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br>
<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué. <br>
 <br>
<b>Commande ou modification d’un article; l’état du stock CHECK24  est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à CHECK24. <br>
Attention, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, <b>ne seront ni pris en compte, ni transmis!</b> <br>
<br>
<b>Commande ou modification d’un article; l’état du stock CHECK24 est modifié (différence)</b> <br>
Si par exemple, un article a été acheté deux fois en boutique, le stock CHECK24 sera réduit de 2 unités. <br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “CHECK24” &rarr; “configuration” &rarr; “préparation d’article”, ce changement sera appliqué sur CHECK24. <br>
<br>
<b>Attention</b>, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<br>
<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr;  Préparation de l’article &rarr; Préréglages de téléchargement d’article. ';
MLI18n::gi()->{'check24_config_sync__field__stocksync.frommarketplace__label'} = 'Variation du stock CHECK24';
MLI18n::gi()->{'check24_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'check24_config_sync__field__stocksync.frommarketplace__help'} = 'Si cette fonction est activée le nombre de commandes effectués et payés sur CHECK24 sera soustrait de votre stock boutique.<br>
<br>
<b>Attention :</b> cette fonction ne s’exécute que si  l’importation des commandes est activée!';
MLI18n::gi()->{'check24_config_sync__field__inventorysync.price__label'} = 'Prix d\'article';
MLI18n::gi()->{'check24_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'check24_config_sync__field__inventorysync.price__help'} = '                <p>
                    La fonction "synchronisation automatique" compare toutes les 4 heures (à partir de 0:00 dans la nuit) l\'état actuel des prix sur CHECK24 et les prix de votre boutique.<br>
                    Ainsi les valeurs venant de la base de données sont vérifiées et appliquées même si des changements, par exemple, dans la gestion des marchandises, sont seulement réalisés dans la base de données.<br><br> 

                    <b>Remarque :</b> Les réglages sous l\'onglet "Configuration" → "Calcul du prix" seront pris en compte.
                 </p>';
MLI18n::gi()->{'check24_config_orderimport__legend__importactive'} = 'Importation des commandes';
MLI18n::gi()->{'check24_config_orderimport__legend__mwst'} = 'TVA';
MLI18n::gi()->{'check24_config_orderimport__legend__orderstatus'} = 'Paramètre de synchronisation des commandes boutiques vers CHECK24';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmer la livraison avec';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.shipped__help'} = 'Définissez ici le statut de l’article, qui doit automatiquement confirmer la livraison  sur CHECK24.';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.canceled__label'} = 'Annuler la commande avec';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.canceled__help'} = '        Définissez  ici le statut de la boutique, qui doit "annuler la commande" automatiquement sur CHECK24. <br/><br/>
                Remarque : une annulation partielle est impossible ici. La commande tout entière est annulée avec cette fonctionnalité et est créditée à l\'acheteur.';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'check24_config_orderimport__field__mwst.fallback__label'} = 'TVA';
MLI18n::gi()->{'check24_config_orderimport__field__mwst.fallback__hint'} = 'Le taux d\'imposition lors d\'une importation de commandes d\'articles ne venant pas de la boutique sera alors calculé en %.';
MLI18n::gi()->{'check24_config_orderimport__field__mwst.fallback__help'} = 'Si pour un article, la TVA n’a pas été spécifiée, vous pouvez ici donner un taux, qui sera automatiquement appliquée à l’importation. Les places de marché même ne donnent aucune indication de TVA.<br>
Par principe, pour l’importation des commandes et la facturation, magnalister applique le même système de TVA que celui configuré par les boutiques. <br>
Afin que les TVA nationales soient automatiquement prisent en compte, il faut que l’article acheté soit trouvé grâce à son numéro d’unité de gestion des stocks (SKU); magnalister utilisant alors la TVA configurée dans la boutique. ';
MLI18n::gi()->{'check24_config_orderimport__field__importactive__label'} = 'Activer l\'importation';
MLI18n::gi()->{'check24_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__importactive__help'} = 'Les importations de commandes doivent elles  être effectuées à partir de la place de marché? <br>
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
MLI18n::gi()->{'check24_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'check24_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'check24_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs de CHECK24 ne peuvent être conservées, que quelques semaines au maximum. <br>
<br>
<b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!';
MLI18n::gi()->{'check24_config_orderimport__field__customergroup__label'} = 'Groupe clients';
MLI18n::gi()->{'check24_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__customergroup__help'} = 'Vous pouvez choisir ici un groupe dans lesquel vos clients seront classés. Pour créer des groupes, rendez-vous dans le menu de l\'administration de votre boutique PrestaShop ->Clients ->Groupes. Lorsqu\'ils sont créés, ils apparaissent dans la liste de choix proposée. ';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande dans la boutique';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.open__help'} = '               Définissez ici, Le statut qui sera automatiquement attribué aux commandes importé de Priceminister vers votre boutique. <br>
Si vous utilisez un système interne de gestion des créances, il est recommandé, de définir le statut de la commande comme étant "payé".';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shippingmethod__label'} = 'Mode d\'expédition';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shippingmethod__help'} = 'Mode d\'expédition attribuée à toutes les commandes CHECK24. Standard : "CHECK24". <br> <br> Ce paramètre est important pour la facturation, l\'impression du bon de livraison et l\'actualisation des stocks boutique et général.';
MLI18n::gi()->{'check24_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.originator.name__label'} = 'Nom de l\'expéditeur';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.originator.adress__label'} = 'Adresse de l\'expéditeur';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.subject__label'} = 'Objet';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.content__label'} = 'Contenu de l\'E-mail';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.content__hint'} = 'Liste des champs disponibles pour "objet" et "contenu".
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
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.copy__label'} = 'Copie à l\'expéditeur';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.copy__help'} = 'Activez cette fonction si vous souhaitez recevoir une copie du courriel.';
