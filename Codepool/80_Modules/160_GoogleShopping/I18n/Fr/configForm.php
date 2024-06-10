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

MLI18n::gi()->{'googleshopping_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'googleshopping_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'googleshopping_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'googleshopping_config_account_sync'} = 'Synchronisation';
MLI18n::gi()->{'googleshopping_config_account_orderimport'} = 'Importation des commandes';
MLI18n::gi()->{'googleshopping_config_account__legend__account'} = 'Mes coordonnées';
MLI18n::gi()->{'googleshopping_config_account__legend__tabident'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'googleshopping_config_account__field__tabident__hint'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'googleshopping_config_account__field__mpusername__label'} = 'Pseudo';
MLI18n::gi()->{'googleshopping_config_account__field__mpusername__hint'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__mppassword__label'} = 'Mot de passe';
MLI18n::gi()->{'googleshopping_config_account__field__mppassword__hint'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__apikey__label'} = 'Clé d\'accès GoogleShopping';
MLI18n::gi()->{'googleshopping_config_account__field__apikey__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__legend__prepare'} = 'Préparation de l\'article';
MLI18n::gi()->{'googleshopping_config_prepare__legend__upload'} = 'Téléchargez l\'article: les paramétrages par défaut ';
MLI18n::gi()->{'googleshopping_config_prepare__field__prepare.status__label'} = 'Statut ';
MLI18n::gi()->{'googleshopping_config_prepare__field__prepare.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'googleshopping_config_prepare__field__producttype__label'} = 'Type de produit';
MLI18n::gi()->{'googleshopping_config_prepare__field__producttype__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__returnpolicy__label'} = 'Droit de révocation';
MLI18n::gi()->{'googleshopping_config_prepare__field__returnpolicy__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.status__label'} = 'Statut';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__label'} = 'Description de l\'article';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__matching__titlesrc'} = 'Langue de DaWanda';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__matching__titledst'} = 'Langue de la boutique';
MLI18n::gi()->{'googleshopping_config_prepare__field__quantity__label'} = 'Nombre d\'unités en stock';
MLI18n::gi()->{'googleshopping_config_prepare__field__quantity__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__quantity__help'} = '    Spécifiez ici quelle quantité de cet article doit être disponible en stock sur la place de marché.<br/>
                <br/>
				Vous pouvez changer le nombre directement sous "<i>Télécharger</i>", changer individuellement - dans ce cas ci, il est recommandé<br/> de désactiver la synchronisation automatique, sous <br/>"<i>Synchronisation des inventaires</i>" > "<i>changement dans le stock" en  boutique.</i>".<br/>
				<br/>
				Pour éviter les excès de ventes, vous pouvez activer la valeur<br/>
				"<i>reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite".<br/>
				<br/>
				<strong>Exemple :</strong> Mettez comme valeur "<i>2</i>". Donne &#8594; Stock en boutique: 10 &#8594; Stock sur DaWanda: 8<br/>
				<br/>
				<strong>Remarque :</strong>Si vous souhaitez gérer un article, défini comme étant "inactif" dans la boutique, quelle que soit la quantité réelle,<br/>
 également comme quantité "<i>0</i>" sur la place de marché, procédez comme suit.:<br/>
				<ul>
                    <li>"<i>Synchronisation des Inventaires</i>" > "<i>Changement dans le stock en boutique</i>" sous l\'onglet "<i>Synchronisation automatique via CronJob"</i></li>
                    <li>"<i>Configuration globale " > "<i>Status du produit</i>" > "<i>et activez "Si le statut du produit est placé comme étant inactif, le niveau des stocks sera alors  enregistré comme quantité 0 "</i></li>
				</ul>';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.leadtimetoship__label'} = 'Expédition';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.leadtimetoship__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.manufacturerfallback__label'} = 'Fabricant par défaut';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.manufacturerfallback__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.manufacturerfallback__help'} = 'Si aucun fabricant n\'a été enregisté pour un produit, celui indiqué dans ce champ lui sera attribué.';
MLI18n::gi()->{'googleshopping_config_prepare__field__imagesize__label'} = '{#i18n:form_config_orderimport_imagesize_lable#}';
MLI18n::gi()->{'googleshopping_config_prepare__field__imagesize__help'} = '{#i18n:form_config_orderimport_imagesize_help#}';
MLI18n::gi()->{'googleshopping_config_prepare__field__imagesize__hint'} = '{#i18n:form_config_orderimport_imagesize_hint#}';
MLI18n::gi()->{'googleshopping_config_price__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'googleshopping_config_price__field__price__label'} = 'Prix';
MLI18n::gi()->{'googleshopping_config_price__field__price__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price__help'} = 'Veuillez donner un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. Le rabais commence par un moins devant le chiffre.';
MLI18n::gi()->{'googleshopping_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'googleshopping_config_price__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'googleshopping_config_price__field__price.signal__help'} = 'Cette zone de texte sera utilisée dans les transmissions de données vers GoogleShopping, (prix après la virgule).<br/><br/>

<strong>Par exemple :</strong> <br /> 
Valeur dans la zone de texte: 99 <br /> 
Prix d\'origine: 5.58 <br /> 
Prix final: 5.99 <br /><br />

La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix.
Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule.
Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'googleshopping_config_price__field__priceoptions__label'} = 'Options de tarification';
MLI18n::gi()->{'googleshopping_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'googleshopping_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'googleshopping_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__hint'} = 'Mise à jour automatique des Taux de change';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__help'} = 'La fonction est activée: Si la monnaie de la boutique est différente de la monnaie sur la place de marché, le prix lors du règlement sera alors automatiquement calculé selon le taux de change actuel de la monnaie sur "alphavantage".<br /><br />

AVERTISSEMENT : RedGecko GmbH n\'assume aucune responsabilité pour l\'exactitude du taux de change. Vérifiez, s\'il vous plaît, et contrôlez la transmission de ces valeurs dans votre compte GoogleShopping.';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__alert'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'googleshopping_config_sync__legend__sync'} = 'Synchronisation des inventaires';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.tomarketplace__label'} = 'Variation du stock boutique';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.tomarketplace__help'} = 'Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock GoogleShopping et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. Si la synchronisation est activée, les données de votre base de données seront appliquées à GoogleShopping.
Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br>
<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué. <br>
 <br>
<b>Commande ou modification d’un article; l’état du stock GoogleShopping  est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à GoogleShopping. <br>
Attention, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, <b>ne seront ni pris en compte, ni transmis!</b> <br>
<br>
<b>Commande ou modification d’un article; l’état du stock GoogleShopping est modifié (différence)</b> <br>
Si par exemple, un article a été acheté deux fois en boutique, le stock Amazon sera réduit de 2 unités. <br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “GoogleShopping” &rarr; “configuration” &rarr; “préparation d’article”, ce changement sera appliqué sur GoogleShopping. <br>
<br>
<b>Attention</b>, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<br>
<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr;  Préparation de l’article &rarr; Préréglages de téléchargement d’article. ';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.frommarketplace__label'} = 'Variation du stock GoogleShopping';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.frommarketplace__help'} = 'Si par exemple un article a été acheté 3 fois chez DaWanda, le stock en boutique va se réduire de 3 unités.<br /><br />
                <strong>Important:</strong> Cette fonction s\'exécute uniquement si vous avez activé l\'importation de commande!
';
MLI18n::gi()->{'googleshopping_config_sync__field__inventorysync.price__label'} = 'Prix de l&apos;article';
MLI18n::gi()->{'googleshopping_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'googleshopping_config_sync__field__inventorysync.price__help'} = '       <p>
                    la fonction "synchronisation automatique" compare toutes les 4 heures (à partir de 0:00 dans la nuit) l\'état actuel des prix sur DaWanda et les prix de votre boutique.<br>
                    Ainsi les valeurs venant de la base de données sont vérifiées et appliquées même si des changements, par exemple, dans la gestion des marchandises, sont seulement réalisés dans la base de données.
                    <br><br>
                    <b>Remarque :</b> Les réglages sous l\'onglet "Configuration" &rarr; "Calcul du prix" seront pris en compte.
                </p>';
MLI18n::gi()->{'googleshopping_config_orderimport__legend__importactive'} = 'Importation des commandes';
MLI18n::gi()->{'googleshopping_config_orderimport__legend__mwst'} = 'Taxe sur la valeur';
MLI18n::gi()->{'googleshopping_config_orderimport__legend__orderstatus'} = 'Synchronisation du statut de la commande de la boutique vers DaWanda';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmez l\'expédition avec';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.shipped__help'} = 'Modifiez ici le statut de la boutique, qui doit "confirmer la livraison" automatiquement sur DaWanda.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'googleshopping_config_orderimport__field__mwst.fallback__label'} = 'TVA pour les articles ne venant pas de la boutique';
MLI18n::gi()->{'googleshopping_config_orderimport__field__mwst.fallback__hint'} = 'Le taux d\'imposition lors d\'une importation de commandes d\'articles ne venant pas de la boutique sera alors calculé en %.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__mwst.fallback__help'} = '       Si l\'article n\'a pas été enregistré sur magnalister, la TVA ne peut pas être déterminée.<br />
                Comme solution alternative, la valeur sera fixée en pourcentage pour chaque produit enregistré, dont la TVA n\'est pas connue par DaWanda, lors de l\'importation.
';
MLI18n::gi()->{'googleshopping_config_orderimport__field__importactive__label'} = 'Activez l\'importation';
MLI18n::gi()->{'googleshopping_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__importactive__help'} = '            Est-ce que les importations de commandes doivent être effectuées à partir de la place de marché?.<br><br>Si la fonction est activée, les commandes seront automatiquement importées toutes les heures.<br><br>            
				Vous pouvez déclencher une importation manuellement, en cliquant sur la touche de fonction correspondante dans l\'en-tête de magnalister (à gauche).<br><br>
				En outre, vous pouvez également déclencher l\'importation des commandes (dès le "tarif Flat" - au maximum toutes les 15 minutes) Via CronJob, en suivant le lien suivant vers votre boutique: <br>
    			<i>{#setting:sImportOrdersUrl#}</i><br><br>
    			Les importations de commandes effectuées via CronJob par des clients, qui ne sont pas en "Flat tarif", ou qui ne respectent pas les 15 minutes de délai, seront bloqués.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'googleshopping_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'googleshopping_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs GoogleShopping ne peuvent être conservées, que quelques semaines au maximum. <br>
<br>
<b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customergroup__label'} = 'Groupes clients';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customergroup__help'} = 'Les groupes de clients, pourront s\'associer pour passer de nouvelles commandes.

';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande boutique';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.open__help'} = '               Définissez le statut de la commande dans votre boutique qui doit être attribué aux commandes importées.<br/>
                Si vous utilisez un système interne d\'avertissements, il est recommandé, de définir le statut de la commande comme étant "payé" (Configuration → Statut de la commande).';
MLI18n::gi()->{'googleshopping_config_orderimport__field__order.importonlypaid__label'} = 'Importer uniquement les commandes payées ';
MLI18n::gi()->{'googleshopping_config_orderimport__field__order.importonlypaid__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__label'} = 'Les clients fidèles';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__help'} = '                DaWanda génère à chaque commande une nouvelle adresse E-Mail de l\'acheteur (transfert) pouvant venir de la commande précédente.<br />
                 <br />
                Dans le menu déroulant, choisissez si vous voulez mettre à jour les coordonnées et autres données de base comme l\'E-Mail, pour le retour des clients fidèles et donc reprendre les données ou si vous souhaitez enregistrer de nouveau entièrement le client.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__values__1'} = 'Mise à jour des données clients';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__values__0'} = 'Créez de nouvelles données clients';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shippingmethod__label'} = 'googleshopping_config_orderimport__field__orderimport.shippingmethod__label';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shippingmethod__help'} = 'googleshopping_config_orderimport__field__orderimport.shippingmethod__help';
