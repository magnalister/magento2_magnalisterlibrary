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

MLI18n::gi()->{'ricardo_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'ricardo_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'ricardo_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'ricardo_config_account_sync'} = 'Synchronisation';
MLI18n::gi()->{'ricardo_config_account_orderimport'} = 'Importation de commandes';
MLI18n::gi()->{'ricardo_config_checkin_badshippingcost'} = 'La valeur saisie doit être de type numérique.';
MLI18n::gi()->{'ricardo_config_account_producttemplate'} = 'Gabarit pour fiche de produit';
MLI18n::gi()->{'ricardo_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_sender'} = 'Nom de votre boutique, de votre société, ...';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_sender_email'} = 'exemple@votre-boutique.fr';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_subject'} = 'Votre commande sur #SHOPURL#';
MLI18n::gi()->{'ricardo_config_prepare_maxrelistcount_sellout'} = 'Jusqu’à épuisement';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_content'} = ' <style><!--
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
MLI18n::gi()->{'ricardo_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'ricardo_config_account_defaulttemplate'} = 'Pas de brouillons';
MLI18n::gi()->{'ricardo_configform_sync_values__auto'} = 'Synchronisation automatique via CronJob (réduction uniquement)';
MLI18n::gi()->{'ricardo_configform_sync_values__auto_reduce'} = 'Synchronisation automatique via CronJob (réduction et augmentation)';
MLI18n::gi()->{'ricardo_configform_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'ricardo_label_sync_quantity'} = 'Activer la réduction et l\'augmentation du stock sur Ricardo';
MLI18n::gi()->{'ricardo_text_quantity'} = 'Normalement, Ricardo ne permet pas d\'augmentation de stock pour les articles déjà en ligne. <br>
Pour rendre  possible un ajustement du stock automatique, magnalister termine l\'offre et la remet en ligne avec le nouveau prix, dès que la fonction est activée.
<br />
Des frais supplémentaires peuvent-être facturés par Ricardo si cette fonction est activée!<br>';
MLI18n::gi()->{'ricardo_label_sync_price'} = 'Activer la hausse de prix et la  réduction de prix sur Ricardo';
MLI18n::gi()->{'ricardo_text_price'} = 'Normalement, Ricardo ne permet pas les hausses de prix pour les offres en cours.<br>
Pour rendre  possible un ajustement du prix automatique, magnalister termine l\'offre et la remet en ligne avec le nouveau prix, dès que la fonction est activée.
<br />
Des frais supplémentaires peuvent-être facturés par Ricardo si cette fonction est activée!<br>
magnalister n\'assume aucune responsabilité pour d\'éventuels frais supplémentaires facturés par Ricardo.';
MLI18n::gi()->{'ricardo_config_error_price_signal'} = 'Les prix sur Ricardo doivent être indiqués en francs suisses. Veuillez les  adapter à 2 décimals près, pour qu\'ils finissent, soit par 0 (ex. 12,40), soit par 5 (ex. 12,45). Le plus petit montant autorisé est de 5 centimes (0,05 CHF). D\'autres informations en cliquant sur l\'icône d\'info.';
MLI18n::gi()->{'ricardo_config_account__legend__account'} = 'Données d\'accès';
MLI18n::gi()->{'ricardo_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'ricardo_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'ricardo_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'ricardo_config_account__field__mpusername__label'} = 'Pseudo';
MLI18n::gi()->{'ricardo_config_account__field__mppassword__label'} = 'Mot de passe';
MLI18n::gi()->{'ricardo_config_account__field__token__label'} = 'Jeton (Token)';
MLI18n::gi()->{'ricardo_config_account__field__token__help'} = 'Le jeton (Token) est obligatoire, pour pouvoir utiliser magnalister, pour traiter et gérer vos articles sur Ricardo. Il est renouvelable tous les deux ans.<br>
Pour demander un nouveau jeton, il vous suffit de cliquer sur le Bouton “Demandez / Renouvelez”.<br>
Si aucune fenêtre ne s\'ouvre, lorsque vous cliquez sur le bouton, vérifiez que vous n’avez pas de bloqueur de pop-up.<br>
Sinon suivez les indications.
';
MLI18n::gi()->{'ricardo_config_account__field__apilang__label'} = 'Langue de l\'interface';
MLI18n::gi()->{'ricardo_config_account__field__apilang__hint'} = 'Pour la valeur choisie et les messages d\'erreur. ';
MLI18n::gi()->{'ricardo_config_account__field__apilang__values__de'} = 'Allemand';
MLI18n::gi()->{'ricardo_config_account__field__apilang__values__fr'} = 'En français';
MLI18n::gi()->{'ricardo_config_prepare__legend__prepare'} = 'Préparation de l\'article';
MLI18n::gi()->{'ricardo_config_prepare__legend__upload'} = 'Préréglages pour le téléchargement d\'article';
MLI18n::gi()->{'ricardo_config_prepare__field__prepare.status__label'} = 'Filtrer les articles selon leurs statuts';
MLI18n::gi()->{'ricardo_config_prepare__field__prepare.status__valuehint'} = 'N’afficher que les articles actifs';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.status__label'} = 'Statut';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'ricardo_config_prepare__field__listinglangs__label'} = 'Langue';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__label'} = 'Description';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__hint'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__matching__titlesrc'} = 'Langue de Ricardo';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__matching__titledst'} = 'Langue de la boutique';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.quantity__label'} = 'Variation de stock';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.quantity__help'} = 'Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière.<br>
<br>
Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
<br>
<b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à Ricardo : 8 (articles).<br>
<br>
<b>Remarque :</b> Si vous souhaitez gérer un article, défini comme étant "inactif" dans la boutique, quelle que soit la quantité réelle 
également comme quantité "0" sur la place de marché, procédez comme suit:
"Synchronisation" → "Changement dans le stock en boutique" sous l\'onglet " "Synchronisation automatique via CronJob"<br>
"Configuration globale" &rarr; "Status du produit" &rarr;  "Si le statut du produit est placé comme inactif, le niveau des stocks sera alors enregistré comme quantité 0"';
MLI18n::gi()->{'ricardo_config_prepare__field__descriptiontemplate__label'} = 'Brouillons';
MLI18n::gi()->{'ricardo_config_prepare__field__descriptiontemplate__help'} = 'Ricardo vous permet d’enregistrer 5 brouillons différents vous permettant de personnaliser la 
visualisation de votre fiche produit. Le visuel sera alors placé avant et après la description 
d’article.';
MLI18n::gi()->{'ricardo_config_prepare__field__articlecondition__label'} = 'État du produit';
MLI18n::gi()->{'ricardo_config_prepare__field__buyingmode__label'} = 'type de vente';
MLI18n::gi()->{'ricardo_config_prepare__field__priceforauction__label'} = 'Prix de départ des enchères (CHF)';
MLI18n::gi()->{'ricardo_config_prepare__field__priceincrement__label'} = 'Pas d’enchère (CHF)';
MLI18n::gi()->{'ricardo_config_prepare__field__duration__label'} = 'Durée';
MLI18n::gi()->{'ricardo_config_prepare__field__maxrelistcountfield__label'} = 'Réactiver l\'offre';
MLI18n::gi()->{'ricardo_config_prepare__field__maxrelistcount__label'} = '&nbsp';
MLI18n::gi()->{'ricardo_config_prepare__field__warranty__label'} = 'Garantie';
MLI18n::gi()->{'ricardo_config_prepare__field__warrantycondition__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__warrantydescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__payment__label'} = 'Mode de paiement ';
MLI18n::gi()->{'ricardo_config_prepare__field__payment__hint'} = 'Modes de paiement proposés';
MLI18n::gi()->{'ricardo_config_prepare__field__paymentmethods__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__paymentdescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__delivery__label'} = 'Mode de livraison';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverycondition__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverypackage__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverydescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverycost__label'} = 'Frais de port';
MLI18n::gi()->{'ricardo_config_prepare__field__cumulative__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__cumulative__valuehint'} = 'Frais de port séparés pour chaque article';
MLI18n::gi()->{'ricardo_config_prepare__field__availabilityfield__label'} = 'Délai de livraison ';
MLI18n::gi()->{'ricardo_config_prepare__field__availability__label'} = 'Disponibilité de l\'article après réception du paiement';
MLI18n::gi()->{'ricardo_config_prepare__field__firstpromotion__label'} = 'Pack promotionnelle';
MLI18n::gi()->{'ricardo_config_prepare__field__firstpromotion__hint'} = '<span style="color:#e31a1c;">Cette option fait l\'objet d\'une facturation, renseignez-vous auprès de Ricardo.</span>';
MLI18n::gi()->{'ricardo_config_prepare__field__secondpromotion__label'} = 'Page d\'accueil : option de publication promotionnelle';
MLI18n::gi()->{'ricardo_config_prepare__field__secondpromotion__hint'} = '<span style="color:#e31a1c;">Cette option fait l\'objet d\'une facturation, renseignez-vous auprès de Ricardo</span>';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.showlimitationwarning__label'} = 'Afficher le nombre d\'annonces sur Ricardo avant de charger';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.showlimitationwarning__help'} = 'Veuillez noter que Ricardo fixe en principe une limite de 100 annonces publiées simultanément par vendeur. Cette limite peut être adaptée au cas par cas, à la demande du vendeur. Avant de charger votre produit, assurez-vous bien de ne dépassez pas cette limite et vérifiez le log d\'erreurs au moins 30 minutes après le chargement.
<br><br>
Si vous activez cette option, vous recevrez avant le chargement de chaque produit un message concernant les limitations fixées par Ricardo.
';
MLI18n::gi()->{'ricardo_config_price__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'ricardo_config_price__field__price__label'} = 'Prix';
MLI18n::gi()->{'ricardo_config_price__field__price__help'} = 'Veuillez saisir un pourcentage, une majoration ou un rabais prédéfini. Pour indiquer un rabais
faire précéder le chiffre d’un moins.';
MLI18n::gi()->{'ricardo_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__help'} = 'Cette zone de texte sera utilisée dans les transmissions de données vers Ricardo, (prix après la virgule).<br><br>
               <strong>Par exemple :</strong><br>
               Valeur dans la zone de texte: 99<br> 
               Prix d\'origine: 5.58<br> 
               Prix final: 5.99<br><br> 
               La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix.<br>
               Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule. Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'ricardo_config_price__field__priceoptions__label'} = 'Options tarifaires';
MLI18n::gi()->{'ricardo_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ricardo_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'ricardo_config_price__field__mwst__label'} = 'TVA';
MLI18n::gi()->{'ricardo_config_price__field__mwst__help'} = 'Montant de la TVA à prendre en considération lors de l\'envoi de l\'article vers Ricardo. Si aucune valeur n\'est entrée, le taux standard de TVA de la boutique en ligne sera alors appliqué.';
MLI18n::gi()->{'ricardo_config_price__field__mwst__hint'} = '&nbsp;Taux d\'imposition pour les commerçants professionnels en %';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__valuehint'} = 'Mise à jour automatique des taux de change';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__help'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
<br>
En activant cette fonction, le taux de change actuel défini par "alphavantage" sera appliqué à vos articles. Les prix dans votre boutique en ligne seront également mis à jour.<br>
<br>
L’activation et la désactivation de cette fonction prend effet toutes les heures.<br>
<br>
<b>Avertissement :</b> RedGecko GmbH n\'assume aucune responsabilité pour l\'exactitude du taux de change. Veuillez vérifier en contrôlant les prix de vos articles dans votre compte Ricardo.';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__alert'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'ricardo_config_sync__legend__sync'} = 'Synchronisation des inventaires';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.tomarketplace__label'} = 'Variation du stock boutique';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.tomarketplace__help'} = '<b>Synchronisation automatique via tâche Cron (recommandée)</b>
<br>

Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock Ricardo et votre stock boutique. L’actualisation de base se
fait toutes les quatre heures, - à moins que vous n’ayez défini d’autres paramètres - et commence à 00:00 h. Si la synchronisation est activée, les données de votre base de données seront appliquées à Ricardo.<br><br>

Vous pouvez à tout moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page.<br><br>

Il est aussi possible de synchroniser votre stock en utilisant une tâche Cron personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délai maximal de synchronisation de vos données à 15 minutes d\'intervalle. Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#}<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minutes sera bloqué.<br><br>

<b>Remarque :Ricardo impose une limite de disponibilité. Veillez à ce que le niveau de stock par article mis en vente sur la plateforme Ricardo n\'excède pas 999 pièces.</b> <br>
<ul style="list-style:disc;padding-left: 1em">
<li>Les paramètres définit sous la rubrique « Configuration » > « préparation d’article » > « Préréglages pour le téléchargement d\'article  » > « Variation de stock » sont pris en compte lors de la synchronisation du stock.</li>

<li>Normalement, Ricardo ne permet pas d\'augmentation de stock pour les articles déjà en ligne.</li>
<li>Pour rendre possible un ajustement du stock automatique, magnalister termine l\'offre et la remet en ligne avec le nouveau prix, dès que la fonction est activée.</li>
<li>Des frais supplémentaires peuvent être facturés par Ricardo si cette fonction est activée! magnalister décline toute responsabilité quant aux éventuels frais!</li>
<li>Sélectionnez l’option “réduction uniquement” si vous ne souhaitez pas que vos offres soient réactivées automatiquement.</li> 
</ul>';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.frommarketplace__label'} = 'Variation du stock Ricardo';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.frommarketplace__help'} = 'Si cette fonction est activée le nombre de commandes effectués et payés sur Ricardo sera soustrait de votre stock boutique.<br>
<br>
<b>Attention :</b> cette fonction ne s’exécute que si  l’importation des commandes est activée!';
MLI18n::gi()->{'ricardo_config_sync__field__inventorysync.price__label'} = 'Prix de l&apos;article';
MLI18n::gi()->{'ricardo_config_sync__field__inventorysync.price__help'} = 'Utilisez la fonction “synchronisation automatique” pour que les prix de vos articles sur Ricardo soient mis à jour par rapport au prix de vos articles en boutique. Cette mise à jour aura lieu toutes les quatre heures, à moins que vous n’ayez défini d’autres paramètres de configuration. <br>
Les données de votre base de données seront appliquées sur Ricardo, même si les changements n’ont eu lieu que dans votre base de données.
Vous pouvez à tout moment effectuer une synchronisation des prix en cliquant sur le bouton “synchroniser les prix et les stocks” en haut à droite du module. <br><br>

Il est aussi possible de synchroniser vos prix en utilisant une tâche Cron personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délai maximal de synchronisation de vos données à 15 minutes d\'intervalle. Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br> 
Toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minutes sera bloqué. <br>  <br> 

<b>Remarques</b> :
<ul>
<li>normalement, Ricardo ne permet pas d\'augmentation de stock pour les articles déjà en ligne. &#9633;Pour rendre possible un ajustement du stock automatique, magnalister termine l\'offre et la remet en ligne avec le nouveau prix, dès que la fonction est activée. <b>&#9633;Des frais supplémentaires peuvent être facturés par Ricardo si cette fonction est activée! magnalister décline toute responsabilité quant aux éventuels frais!</b> &#9633;Sélectionnez l’option “réduction” si vous ne souhaitez pas que vos offres soient réactivées automatiquement.</li>
<li>les paramètres configurés dans “Configuration” → “calcul du prix”, affecteront cette fonction.</li>
</ul>
';
MLI18n::gi()->{'ricardo_config_orderimport__legend__importactive'} = 'Importation de commandes';
MLI18n::gi()->{'ricardo_config_orderimport__legend__mwst'} = 'TVA';
MLI18n::gi()->{'ricardo_config_orderimport__legend__orderstatus'} = 'Synchronisation du statut de la commande de la boutique vers Ricardo';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shippingmethod__label'} = 'Mode d\'expédition';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shippingmethod__help'} = 'Mode d\'expédition attribuée à toutes les commandes Ricardo. Standard : "Ricardo". <br> <br> Ce paramètre est important pour la facturation, l\'impression du bon de livraison et l\'actualisation des stocks boutique et général.';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmer l\'expédition avec';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.shipped__help'} = 'Définissez ici le statut dans votre boutique, qui doit automatiquement attribuer le statut "Livraison confirmée" sur Ricardo.';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__label'} = 'TVA pour les articles extérieurs à la boutique';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__hint'} = 'Le taux d\'imposition lors d\'une importation de commandes d\'articles ne venant pas de la boutique sera alors calculé en %.';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__help'} = 'Si un article n’est pas enregistré dans votre boutique, magnalister utilise le taux d’imposition
saisi ici étant donné que Ricardo ne transmet pas d’information quant à la TVA.
Information supplémentaire :<br />
lors de l’importation des commandes, les taux de TVA sont calculés selon les paramètres de
votre boutique. Pour ce faire, l’article commandé doit être enregistré dans votre boutique avec
la même référence d’article que sur la place de marché.';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__label'} = 'Activer l\'importation';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__help'} = 'Est-ce que les importations de commandes doivent être effectuées à partir de la place de marché?<br/><br/>
Si la fonction est activée, les commandes seront automatiquement importées toutes les heures.<br>
<br>
Vous pouvez déclencher une importation manuellement, en cliquant sur la touche de fonction correspondante dans l\'en-tête de
magnalister (à droite).<br><br>
En outre, vous pouvez également déclencher l\'importation des commandes (dès le "tarif Flat" - au maximum toutes les 15 minutes) via
une tâche cron, en suivant le lien suivant vers votre boutique:<br>
                       <i>{#setting:sImportOrdersUrl#}</i><br><br>
Les importations de commandes effectuées via tâche cron par des clients qui ne sont pas en tarif "flat", ou qui ne respectent pas les 15
minutes de délai, seront bloquées.
';
MLI18n::gi()->{'ricardo_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs de Ricardo ne peuvent être conservées, que quelques semaines au maximum. <br>
<br>
<b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!
';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande en boutique';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__help'} = 'Sélectionnez le statut qui sera attribué aux commandes importées à partir de Ricardo.
Si vous utilisez un système de procédure d’injonction de paiement, il est recommandé de définir
le statut de la commande comme étant "payé".';
MLI18n::gi()->{'ricardo_config_orderimport__field__customergroup__label'} = 'Groupe de clients';
MLI18n::gi()->{'ricardo_config_orderimport__field__customergroup__help'} = 'Vous pouvez choisir ici un groupe dans lesquel vos clients seront classés. Pour créer des groupes, rendez-vous dans le menu de l\'administration de votre boutique PrestaShop ->Clients ->Groupes. Lorsqu\'ils sont créés, ils apparaissent dans la liste de choix proposée. ';
MLI18n::gi()->{'ricardo_config_producttemplate__legend__product__title'} = 'Modèle de produit (template)';
MLI18n::gi()->{'ricardo_config_producttemplate__legend__product__info'} = 'Modèle (Template) pour la description du produit sur Ricardo. (Vous pouvez désactiver "l\'éditor" sous "Configuration globale" > "Réglages pour expert".)';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.name__label'} = 'Nom du modèle (template) du produit';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.name__help'} = 'Modèle (Template) pour la description du produit sur Ricardo. (Vous pouvez désactiver "l\'éditor" sous "Configuration globale" > "Réglages pour expert".)';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__label'} = 'Modèle (template) pour la description du produit';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__hint'} = '     Liste d\'espaces réservés et disponibles pour le contenu.:
                <dl>
                        <dt>#TITLE#</dt>
                                <dd>Nom du produit (titre)</dd>
                        <dt>#ARTNR#</dt>
                                <dd>Numéro d\'article en magasin</dd>
                        <dt>#PID#</dt>
                                <dd>Numéro de produits ID en magasin</dd>
                        <!--<dt>#PRICE#</dt>
                                <dd>Prix</dd>
                        <dt>#VPE#</dt>
                                <dd>Prix par unité de conditionnement</dd>-->
                        <dt>#SHORTDESCRIPTION#</dt>
                                <dd>Courte description venant de la boutique</dd>
                        <dt>#DESCRIPTION#</dt>
                                <dd>Description venant de la boutique</dd>
                        <dt>#PICTURE1#</dt>
                                <dd>Première photo du produit</dd>
                        <dt>#PICTURE2# ect.</dt>
                                <dd>Deuxième photo du produit; avec  #PICTURE3#, #PICTURE4# ect. vous pouvez envoyez d\'autres photos, autant que disponibles en boutique.</dd>
                </dl>
                ';
MLI18n::gi()->{'ricardo_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.originator.name__label'} = 'Nom de l\'expéditeur';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.originator.adress__label'} = 'Adresse de l\'expéditeur';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.subject__label'} = 'Objet';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.content__label'} = 'Contenu de l\'E-mail';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.content__hint'} = 'Liste d\'espaces réservés et disponibles pour l\'objet et le contenu.
                <dl>
                    <dt>#FIRSTNAME#</dt>
                    <dd>Prénom de l\'acheteur</dd>
                    <dt>#LASTNAME#</dt>
                    <dd>Nom de l\'acheteur</dd>
                    <dt>#EMAIL#</dt>
                    <dd>Adresse E-Mail de l\'acheteur</dd>
                    <dt>#PASSWORD#</dt>
                    <dd>Mot de passe de l\'acheteur pour vous connecter à votre boutique. Seulement pour les clients qui                  seront automatiquement placés, sinon l\'espace réservé sera remplacé par \'(comme on le sait)\'.</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Résumé des articles achetés. Devrait être à part dans une ligne.<br>
                        <i>Ne peut pas être utilisé dans la ligne objet!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>Nom de cette place de marché</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>URL zu Ihrem Shop</dd>
                    <dt>#ORIGINATOR#</dt>
                    <dd>Nom de l\'expéditeur</dd>
                    <dt>#USERNAME#</dt>
                    <dd>Nom d\'utilisateur de l\'acheteur</dd>
                    <dt>#MARKETPLACEORDERID#</dt>
                    <dd>Numéro d\'ordre Ricardo</dd>
                </dl>';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.copy__label'} = 'Copie à l\'expéditeur';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.copy__help'} = 'La copie sera envoyée à l\'adresse E-Mail de l\'expéditeur.';
