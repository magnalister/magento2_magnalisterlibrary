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

MLI18n::gi()->{'cdiscount_config_use_shop_value'} = 'Reprendre de la boutique';
MLI18n::gi()->{'cdiscount_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'cdiscount_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'cdiscount_config_account_price'} = 'Calcul du prix';
MLI18n::gi()->{'cdiscount_config_account_sync'} = 'Synchronisation';
MLI18n::gi()->{'cdiscount_config_account_orderimport'} = 'Importation des commandes';
MLI18n::gi()->{'cdiscount_config_account_producttemplate'} = 'Gabarit pour fiche de produit';
MLI18n::gi()->{'cdiscount_config_checkin_badshippingtime'} = 'Le temps de livraison doit être un nombre choisi entre 1 et 10';
MLI18n::gi()->{'cdiscount_config_checkin_badshippingcost'} = 'La valeur saisie doit être numérique.';
MLI18n::gi()->{'cdiscount_config_checkin_shippingmatching'} = 'Il n\'est pas possible de faire concorder les délais de livraison pour ce système de boutique.';
MLI18n::gi()->{'cdiscount_config_checkin_manufacturerfilter'} = 'Le filtre fabricant n\'est pas disponible pour ce système de boutique en ligne.';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_sender'} = 'Nom de votre boutique, de votre société, ...';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_sender_email'} = 'exemple@votre-boutique.fr';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_subject'} = 'Votre commande sur #SHOPURL#';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_content'} = ' <style><!--
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
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__textfield__title'} = 'Champs de texte';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__Cdiscount__title'} = 'Cdiscount';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__textfield__title'} = 'Champs de texte';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__matching__title'} = 'Prendre le relais du marché';
MLI18n::gi()->{'cdiscount_config_account__legend__account'} = 'Mes coordonnées';
MLI18n::gi()->{'cdiscount_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'cdiscount_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'cdiscount_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'cdiscount_config_account__field__mpusername__label'} = 'Votre identifiant (API)';
MLI18n::gi()->{'cdiscount_config_account__field__mpusername__help'} = 'Votre mon d\'utilisateur est le même que sur <a target="_blank" href = "https://seller.cdiscount.com/">https://seller.cdiscount.com/</a>';
MLI18n::gi()->{'cdiscount_config_account__field__mppassword__label'} = 'Votre mot de passe (API)';
MLI18n::gi()->{'cdiscount_config_account__field__mppassword__help'} = 'Rendez-vous sur votre compte vendeur ( <a target="_blank" href = "https://seller.cdiscount.com/">https://seller.cdiscount.com/</a> ), choisissez paramètres personnels, en bas de la page, se trouve le champs du mot de passe de votre API.  ';
MLI18n::gi()->{'cdiscount_config_prepare__legend__prepare'} = 'Préparation de l\'article';
MLI18n::gi()->{'cdiscount_config_prepare__legend__upload'} = 'Préréglages pour le téléchargement d\'articles';
MLI18n::gi()->{'cdiscount_config_prepare__field__prepare.status__label'} = 'Statut du filtre';
MLI18n::gi()->{'cdiscount_config_prepare__field__prepare.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.status__label'} = 'Statut du filtre';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.status__valuehint'} = 'Ne prendre en charge que les articles actifs';
MLI18n::gi()->{'cdiscount_config_prepare__field__lang__label'} = 'Description d\'article';
MLI18n::gi()->{'cdiscount_config_prepare__field__imagepath__label'} = 'Chemin d\'accès des images';
MLI18n::gi()->{'cdiscount_config_prepare__field__marketingdescription__label'} = 'Description marketing ';
MLI18n::gi()->{'cdiscount_config_prepare__field__marketingdescription__help'} = 'La description marketing à pour but de décrire le produit. Elle apparaitra sur votre fiche de produit dans la rubrique "Présentation du produit". Elle doit uniquement décrire l\'article et ne peut pas contenir des informations sur l\'offre (prix, livraison, emballage...). La description marketing est limitée à 5000 caractères.';
MLI18n::gi()->{'cdiscount_config_prepare__field__standarddescription__label'} = 'Description';
MLI18n::gi()->{'cdiscount_config_prepare__field__standarddescription__help'} = 'La description apparait en tête de votre fiche de produit en dessous du titre. Elle doit uniquement décrire l\'article et ne peut pas contenir des informations sur l\'offre (prix, livraison, emballage...) ni de codes html ou autres. La description est limitée à 420 caractères.';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcondition__label'} = 'État de l\'article';
MLI18n::gi()->{'cdiscount_config_prepare__field__preparationtime__label'} = 'Délais pour la préparation de la livraison';
MLI18n::gi()->{'cdiscount_config_prepare__field__preparationtime__help'} = 'Délais de préparation en jours ouvrés';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_standard__label'} = 'Livraison standard';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_standard__help'} = 'Livraison classique. <br>
                                         Les frais de port additionnels seront appliqués lorsqu\'un client commande plusieurs produits à la fois. ';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_tracked__label'} = 'Livraison avec suivi';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_tracked__help'} = 'Livraison avec suivi. <br>
                                        Les frais de port additionnels seront appliqués lorsqu\'un client commande plusieurs produits à la fois. ';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_registered__label'} = 'Livraison en recommandée';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_registered__help'} = 'Livraison recommandée<br>
      Les frais de port additionnels seront appliqués lorsqu\'un client commande plusieurs produits à la fois. ';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofile__label'} = 'Profil d\'expédition';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofile__help'} = 'Créez vos profils d\'expédition ici. <br>
                            Vous pouvez spécifier différents frais d\'expédition pour chaque profil (exemple : 4,95) et définir un profil par défaut. 
                            Les frais d\'expédition spécifiés seront ajoutés au prix de l\'article lors du téléchargement du produit, car les marchandises ne peuvent être téléchargées sur la place de marché CDiscount qu\'exemptes de frais d\'expédition.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingfee__label'} = 'Frais d\'expédition (€)';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingfeeadditional__label'} = 'Frais d\'expédition supplémentaires (€)';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofilename__label'} = 'Nom du profil d\'expédition';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofilecost__label'} = 'Frais d\'expédition';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcountry__label'} = 'L\'article est expédié depuis';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcountry__help'} = 'Saisissez ici le pays à partir duquel vous expédiez. En principe, le pays où se trouve votre boutique.';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__label'} = 'Résultats';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__help'} = 'Ici, vous pouvez définir le nombre de produits par page lorsque le Multimatching (classement multiple) s\'affiche.<br/> Plus le nombre est important, plus le temps de charge sera important (pour 50 résultats comptez environ 30 secondes).';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__hint'} = 'Par page lors du Multi-matching';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.quantity__label'} = 'Variation de stock';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.quantity__help'} = 'Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière. 
<br>
Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
<br>
<b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à Cdiscout : 8 (articles).<br>
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
</ol>';
MLI18n::gi()->{'cdiscount_config_price__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__label'} = 'Déclinaisons de produit';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__help'} = 'Si la fonction est activée, les déclinaisons de vos produits (taille, couleur) seront automatiquement transmises à Cdiscount. <br>
 Une catégorie quantité sera ajoutée à chaque déclinaison de produit, pour pouvoir en gérer le stock.<br>
<br>
<b>Exemple :</b> un de vos articles est en stock, 8 fois en bleu, 5 fois en vert et 2 fois en noir. 
<ul>
<li>Si vous avez activé l\'option “Prendre en charge le stock de la boutique moins la valeur du champ de droite”, qui se trouve sous l’onglet “Calcul des prix”, rubrique “Paramètres des listings de prix fixes” puis “quantité”.</li> 
<li>Dans le champ de droite est inscrit, par exemple 2 (quantité d’articles que vous réservez à une autre place de marché).</li></ul>
L’article apparaîtra sur Cdiscount : 6 fois en bleu, 3 fois en vert et la version en noir n\'apparaîtra pas. 
<br>
<b>Note :</b> Il arrive, que ce que vous utilisez comme variante ( ex: taille ou couleur) soit également  un attribut de la catégorie dans laquelle apparaît votre article. Dans ce cas, votre variante est utilisée et non pas la valeur d\'attribut.';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__valuehint'} = 'Transmettre les déclinaisons de produit';
MLI18n::gi()->{'cdiscount_config_price__field__price__label'} = 'Prix';
MLI18n::gi()->{'cdiscount_config_price__field__price__help'} = 'Veuillez saisir un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. 
Pour indiquer un rabais faire précéder le chiffre d’un moins. ';
MLI18n::gi()->{'cdiscount_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__help'} = '                Cette zone de texte sera utilisée dans les transmissions de données vers la place de marché, (prix après la virgule).<br/><br/>

                <strong>Par exemple :</strong> <br /> 
                 Valeur dans la zone de texte: 99 <br />
                 Prix d\'origine: 5.58 <br />
                 Prix final: 5.99 <br /><br />
                 La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix. <br/>
                 Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule.<br/>
                 Le format d\'entrée est un chiffre entier avec max. 2 chiffres.
                 Prix final: 5.99 ';
MLI18n::gi()->{'cdiscount_config_price__field__priceoptions__label'} = 'Options de prix ';
MLI18n::gi()->{'cdiscount_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__valuehint'} = 'Mise à jour automatique du taux de change';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__help'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__alert'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'cdiscount_config_sync__legend__sync'} = 'Synchronisation des inventaires';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.tomarketplace__label'} = 'Variation du stock de la boutique';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.tomarketplace__help'} = 'Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock Cdiscount et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. Si la synchronisation est activée, les données de votre base de données seront appliquées à Cdiscount.
Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br>
<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué. <br>
 <br>
<b>Commande ou modification d’un article; l’état du stock Cdiscount  est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à Cdiscount. <br>
Attention, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, <b>ne seront ni pris en compte, ni transmis!</b> <br>
<br>
<b>Commande ou modification d’un article; l’état du stock Cdiscount est modifié (différence)</b> <br>
Si par exemple, un article a été acheté deux fois en boutique, le stock Cdiscount sera réduit de 2 unités. <br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “Cdiscount” &rarr; “configuration” &rarr; “préparation d’article”, ce changement sera appliqué sur Cdiscount. <br>
<br>
<b>Attention</b>, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<br>
<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr;  Préparation de l’article &rarr; Préréglages de téléchargement d’article. ';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.frommarketplace__label'} = 'Variation du stock Cdiscount';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.frommarketplace__help'} = 'Si cette fonction est activée le nombre de commandes effectués et payés sur Cdiscount sera soustrait de votre stock boutique.<br>
<br>
<b>Attention :</b> cette fonction ne s’exécute que si  l’importation des commandes est activée!';
MLI18n::gi()->{'cdiscount_config_sync__field__inventorysync.price__label'} = 'Prix de l&apos;article';
MLI18n::gi()->{'cdiscount_config_sync__field__inventorysync.price__help'} = '                <p>
                    La fonction "synchronisation automatique" compare toutes les 4 heures (à partir de 0:00 dans la nuit) l\'état actuel des prix sur Cdiscount et les prix de votre boutique.<br>
                    Ainsi les valeurs venant de la base de données sont vérifiées et appliquées même si des changements, par exemple, dans la gestion des marchandises, sont seulement réalisés dans la base de données.<br><br> 

                    <b>Remarque :</b> Les réglages sous l\'onglet "Configuration" → "Calcul du prix" seront pris en compte.
                 </p>';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__importactive'} = 'Importation des commandes';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__mwst'} = 'TVA';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__orderstatus'} = 'Synchronisation du statut des commandes de votre boutique vers Cdiscount';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmer la livraison avec';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipped__help'} = 'Définissez ici le statut affiché dans votre boutique, qui doit automatiquement entrainer la confirmation de la livraison sur Cdiscount.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.default__label'} = 'Transporteurs Standards ';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.default__help'} = 'Transporteur choisi en confirmant l\'expédition sur eBay';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.cancelled__label'} = 'Annuler la commande si';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.cancelled__help'} = 'Définissez ici le statut de l’article, qui doit automatiquement annuler la livraison sur Cdiscount. <br />
                Remarque : une annulation partielle est ici impossible. En utilisant cette fonctionnalité la commande tout entière est annulée et l\'acheteur est crédité.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__label'} = 'Accepter les commandes automatiquement ';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__valuehint'} = 'Si la fonction est activée vos commandes seront automatiquement acceptées sur Cdiscount. Cliquez sur l\'icône d\'information pour en savoir plus.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__help'} = 'Si la fonction n\'est pas activée, vous devrez vous rendre sur votre compte vendeur (lien: <a href = "https://seller.cdiscount.com/Orders.html">https://seller.cdiscount.com/Orders.html</a>) pour accepter chaque nouvelle commande. Ensuite, vous pourrez  changer le statut de la commande via magnalister. Si vous activez cette fonction, les commandes seront toutes acceptées automatiquement acceptées. Les commandes pourront toujours être annulées ultérieurement.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__label'} = 'TVA';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__hint'} = 'Le taux d\'imposition d\'une importation de commandes ne venant pas de la boutique sera calculé en %.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__help'} = 'Si l\'article n\'a pas été mis en vente par l\'intermédiaire de magnalister, la TVA ne peut pas être déterminée.<br />
                 Comme solution alternative, la valeur sera fixée en pourcentage pour chaque produit enregistré, dont la TVA n\'est pas connue par Cdiscount, lors de l\'importation.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__label'} = 'Activez l\'importation';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__help'} = 'Les importations de commandes doivent-elles  être effectuées à partir de la place de marché? <br>
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
MLI18n::gi()->{'cdiscount_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs de Cdiscount ne peuvent être conservées, que quelques semaines au maximum. <br>
<br>
<b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande dans votre boutique';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__help'} = 'Le statut des commandes dans votre boutique qui sera attribué automatiquement aux commandes provenant de la place de marché.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.paymentmethod__label'} = 'Mode de paiement de la commande';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.paymentmethod__help'} = 'Mode de paiement assigné à toutes les commandes Cdiscount. Standard : « Cdiscount ».<br><br>
Ce réglage est important pour l\'impression des bons de livraison, des factures et pour le
traitement de la commande en boutique et en stock.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shippingmethod__label'} = 'Mode d\'expédition de la commande';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shippingmethod__help'} = 'Mode d\'envoi assigné à toutes les commandes Cdiscount. Standard : « Cdiscount ».<br><br>
Ce réglage est important pour l\'impression des bons de livraison, des factures et pour le
traitement de la commande en boutique et en stock.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__customergroup__label'} = 'Groupe de client';
MLI18n::gi()->{'cdiscount_config_orderimport__field__customergroup__help'} = 'Vous pouvez choisir ici un groupe dans lesquel vos clients seront classés. Pour créer des groupes, rendez-vous dans le menu de l\'administration de votre boutique PrestaShop ->Clients ->Groupes. Lorsqu\'ils sont créés, ils apparaissent dans la liste de choix proposée. ';
MLI18n::gi()->{'cdiscount_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.originator.name__label'} = 'Nom de l\'expéditeur';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.originator.adress__label'} = 'Adresse de l\'expéditeur';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.subject__label'} = 'Objet';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.content__label'} = 'Contenu de l\'E-mail';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.content__hint'} = 'Liste des champs disponibles pour "objet" et "contenu".
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
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.copy__label'} = 'Copie à l\'expéditeur';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.copy__help'} = 'Activez cette fonction si vous souhaitez recevoir une copie du courriel.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier__label'} = 'Shipping Carrier';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier__help'} = '';
