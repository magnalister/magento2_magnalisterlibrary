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

MLI18n::gi()->{'hitmeister_config_account_title'} = 'Mes coordonnées';
MLI18n::gi()->{'hitmeister_config_country_title'} = 'Pays';
MLI18n::gi()->{'hitmeister_config_account_prepare'} = 'Préparation d\'article';
MLI18n::gi()->{'hitmeister_config_account_priceandstock'} = 'Prix et stock';
MLI18n::gi()->{'hitmeister_config_account_sync'} = 'Synchronisation';
MLI18n::gi()->{'hitmeister_config_account_orderimport'} = 'Importation de commandes';
MLI18n::gi()->{'hitmeister_config_invoice'} = 'Factures';
MLI18n::gi()->{'hitmeister_config_checkin_badshippingcost'} = 'La valeur saisie doit être de type numérique.';
MLI18n::gi()->{'hitmeister_config_checkin_shippingmatching'} = 'Le classement automatique des délais de livraison n\'est pas disponible pour ce système de boutique en ligne.';
MLI18n::gi()->{'hitmeister_config_checkin_manufacturerfilter'} = 'Le Filtre de fabricants n\'est pas disponible pour ce système de boutique en ligne.';
MLI18n::gi()->{'hitmeister_config_account__legend__account'} = 'Mes coordonnées';
MLI18n::gi()->{'hitmeister_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'hitmeister_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'hitmeister_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'hitmeister_config_account__field__clientkey__label'} = 'ClientKey';
MLI18n::gi()->{'hitmeister_config_account__field__clientkey__help'} = 'Vous trouverez les donnés d\'accès de l\'API dans votre compte Kaufland. Connectez vous sur Kaufland et cliquez sur <b>Kaufland API</b>, dans le menu en bas à gauche, puis sur <b>Zusatzfunktionen</b>.';
MLI18n::gi()->{'hitmeister_config_account__field__secretkey__label'} = 'SecretKey';
MLI18n::gi()->{'hitmeister_config_account__field__mpusername__label'} = 'Nom d\'utilisateur';
MLI18n::gi()->{'hitmeister_config_account__field__mppassword__label'} = 'Mot de passe';
MLI18n::gi()->{'hitmeister_config_country__legend__country'} = 'Pays';
MLI18n::gi()->{'hitmeister_config_country__field__site__label'} = 'Sélection du pays sur Kaufland';
MLI18n::gi()->{'hitmeister_config_country__field__site__help'} = '<p>Dans cette section, vous pouvez sélectionner la page pays de Kaufland à laquelle magnalister doit se connecter. Nous utilisons à cet effet les informations stockées dans votre compte Kaufland.</p><p><strong>Des entrées en grisé indiquent</strong> que la page pays de Kaufland concernée n\'est pas activée dans votre compte Kaufland. Vous ne pourrez choisir et configurer cette page pour magnalister que après avoir terminé sa configuration complète dans votre compte Kaufland.</p>';
MLI18n::gi()->{'hitmeister_config_country__field__site__alert__*__title'} = 'Nouveau site Kaufland choisi';
MLI18n::gi()->{'hitmeister_config_country__field__site__alert__*__content'} = '<p>Vous avez sélectionné un autre site Kaufland. Cela aura une incidence sur les autres options, car les sites nationaux de Kaufland peuvent proposer des devises différentes ainsi que des méthodes de paiement et d\'expédition différentes. Les articles sont alors définis pour le nouveau site national et ne sont synchronisés qu\'à partir de celui-ci, les commandes ne sont également importées qu\'à partir de ce site.</p><p><strong>Faut-il adopter la nouvelle configuration ?</strong></p>';
MLI18n::gi()->{'hitmeister_config_country__field__currency__label'} = 'Devise';
MLI18n::gi()->{'hitmeister_config_country__field__currency__help'} = '<p>La devise dans laquelle les articles sont placés sur Kaufland est déterminée par le paramètre « Sélection du pays sur Kaufland ».</p>';
MLI18n::gi()->{'hitmeister_config_prepare__legend__prepare'} = 'Préparation de l\'article';
MLI18n::gi()->{'hitmeister_config_prepare__legend__upload'} = 'Préréglages pour le téléchargement d\'article';
MLI18n::gi()->{'hitmeister_config_prepare__field__prepare.status__label'} = 'Statut du filtre';
MLI18n::gi()->{'hitmeister_config_prepare__field__prepare.status__valuehint'} = 'Ne reprendre que les articles actifs';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.status__label'} = 'Statut du filtre';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.status__valuehint'} = 'Ne reprendre que les articles actifs';
MLI18n::gi()->{'hitmeister_config_prepare__field__lang__label'} = 'Description de l\'article';
MLI18n::gi()->{'hitmeister_config_prepare__field__imagepath__label'} = 'Chemin d\'accès des images';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcondition__label'} = 'État de l\'article';
MLI18n::gi()->{'hitmeister_config_prepare__field__handlingtime__label'} = 'Délais de manutention';
MLI18n::gi()->{'hitmeister_config_prepare__field__handlingtime__help'} = 'Préréglages pour le temps de manutention (le temps nécessaire pour préparer les marchandises à l\'expédition). Vous pouvez modifier cette valeur dans la préparation de l\'article.';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcountry__label'} = 'L\'article est expédié depuis';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcountry__help'} = 'Saisissez ici le pays à partir duquel vous expédiez.  ';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippinggroup__label'} = 'Groupe d\'expédition';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippinggroup__help'} = 'Les groupes d\'expédition Kaufland contiennent des informations sur l\'expédition';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__label'} = 'Résultats';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__help'} = 'Ici, vous pouvez définir le nombre de produits par page lorsque le Multimatching (classement multiple) s\'affiche.<br/> Plus le nombre est important, plus le temps de charge sera important (pour 50 résultats comptez environ 30 secondes).';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__hint'} = 'par page lors du Multi-matching ';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__label'} = 'Information sur les déclinaisons dans le titre';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__help'} = 'Activez cette option si vous souhaitez que des informations d&eacute;taill&eacute;es telles que la taille, la couleur ou le mod&egrave;le soient incluses dans le titre de vos d&eacute;clinaisons de produits sur Kaufland.<br /><br />Vos clients pourront ainsi diff&eacute;rencier vos produits plus facilement.<br /><br /><strong>Example:</strong><br />Titre : T-Shirt Nike<br />D&eacute;clinaison : Taille S <br /><br />R&eacute;sultat dans le titre : "T-Shirt Nike - Taille S"';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__valuehint'} = 'Ajoutez les informations de déclinaisons au titre de vos produits';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.quantity__label'} = 'Gestion du stock';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.quantity__help'} = 'Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière. <br>
<br>
Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
<br>
<b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à Kaufland : 8 (articles).<br>
<br>
<b>Remarque :</b> Si vous souhaitez cesser la vente sur Kaufland, d’un article que vous avez encore en stock, mais que vous avez désactivé de votre boutique, procédez comme suit :
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
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__price'} = 'Calcul du prix';
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__price.lowest'} = 'Calcul du prix minimum';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price__label'} = 'Prix';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price__help'} = 'Veuillez saisir un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. Pour indiquer un rabais faire précéder le chiffre d’un moins. ';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.addkind__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.factor__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__help'} = 'Cette zone de texte sera utilisée dans les transmissions de données vers Kaufland, (prix après la virgule).<br><br>
 
               <strong>Par exemple :</strong><br><br> 
               Valeur dans la zone de texte: 99<br> 
               Prix d\'origine: 5.58<br> 
               Prix final: 5.99<br><br> 
               La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix.<br>
               Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule. Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions__label'} = 'Options de tarification';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions__help'} = '{#i18n:configform_priceandstock_field_priceoptions_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.group__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__label'} = 'Automatique des prix les plus bas';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__valuehint'} = 'Appliquer le prix minimum de Kaufland';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__values'} = array (
     '0' => 'Prix minimum = Prix normal',
     '1' => 'Prix minimums tels que fixés sur Kaufland',
     '2' => 'Configurer les prix minimums'
);
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__help'} = 'Définir un prix minimum';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__label'} = 'Taux de change';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__valuehint'} = 'Mise à jour automatique des taux de change';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__help'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__alert'} = 'Si la devise utilisé dans votre boutique en ligne est différente de celle de la place de marché, magnalister calcule le taux de change par rapport au taux que vous avez défini dans votre boutique en ligne. <br>
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
###
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest__label'} = 'Prix minimum';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest__help'} = 'Veuillez saisir un pourcentage, un prix majoré, un rabais ou un prix fixe prédéfini. Pour indiquer un rabais faire précéder le chiffre d’un moins. ';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.addkind__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.factor__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__label'} = 'Champ décimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__hint'} = 'Champ décimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__help'} = 'Cette zone de texte sera utilisée dans les transmissions de données vers Kaufland, (prix après la virgule).<br><br>
 
               <strong>Par exemple :</strong><br><br> 
               Valeur dans la zone de texte: 99<br> 
               Prix d\'origine: 5.58<br> 
               Prix final: 5.99<br><br> 
               La fonction aide en particulier, pour les majorations ou les rabais en pourcentage sur les prix.<br>
               Laissez le champ vide si vous souhaitez ne pas transmettre de prix avec une virgule. Le format d\'entrée est un chiffre entier avec max. 2 chiffres.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions.lowest__label'} = 'Options de tarification';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions.lowest__help'} = '{#i18n:configform_priceandstock_field_priceoptions_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.group__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.usespecialoffer__label'} = 'Utilisez également des tarifs spéciaux';
###
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__sync'} = 'Synchronisation des inventaires';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.tomarketplace__label'} = 'Variation du stock boutique';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.tomarketplace__help'} = 'Utilisez la fonction “synchronisation automatique”, pour synchroniser votre stock Kaufland et votre stock boutique. L’actualisation de base se fait toutes les quatre heures, - à moins que vous n’ayez définit d’autres paramètres - et commence à 00:00 heure. Si la synchronisation est activée, les données de votre base de données seront appliquées à Kaufland.
Vous pouvez à tous moment effectuer une synchronisation manuelle de votre stock, en cliquant sur le bouton “synchroniser les prix et les stocks”, dans le groupe de boutons en haut à droite de la page. <br>
<br>
Il est aussi possible de synchroniser votre stock en utilisant une fonction CronJob personnelle. Cette fonction n’est disponible qu’à partir du tarif “flat”. Elle vous permet de réduire le délais maximal de  synchronisation de vos données à 15 minutes d\'intervalle. 
Pour opérer la synchronisation utilisez le lien suivant:<br>
{#setting:sSyncInventoryUrl#} <br>
<br>
Attention, toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minute sera bloqué. <br>
 <br>
<b>Commande ou modification d’un article; l’état du stock Kaufland est comparé avec celui de votre boutique. </b> <br>
Chaque changement dans le stock de votre boutique, lors d’une commande ou de la modification d’un article, sera transmis à Kaufland. <br>
Attention, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée par une place de marché synchronisé ou sur magnalister, <b>ne seront ni pris en compte, ni transmis!</b> <br>
<br>
<b>Commande ou modification d’un article; l’état du stock Kaufland est modifié (différence)</b> <br>
Si par exemple, un article a été acheté deux fois en boutique, le stock Kaufland sera réduit de 2 unités. <br>
Si vous modifiez la quantité d’un article dans votre boutique, sous la rubrique “Kaufland” &rarr; “configuration” &rarr; “préparation d’article”, ce changement sera appliqué sur Kaufland. <br>
<br>
<b>Attention</b>, les changements ayant lieu uniquement dans votre base de données, c’est-à-dire ne résultant pas d’une action opérée sur une place de marché synchronisé ou sur magnalister, ne seront ni pris en compte, ni transmis!<br>
<br>
<br>
<b>Remarque :</b> Cette fonction n’est effective, que si vous choisissez une de deux première option se trouvant sous la rubrique: Configuration &rarr;  Préparation de l’article &rarr; Préréglages de téléchargement d’article. ';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.frommarketplace__label'} = 'Variation du stock Kaufland';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.frommarketplace__help'} = 'Si cette fonction est activée le nombre de commandes effectués et payés sur Kaufland sera soustrait de votre stock boutique.<br>
<br>
<b>Attention :</b> cette fonction ne s’exécute que si  l’importation des commandes est activée!';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__inventorysync.price__label'} = 'Prix de l&apos;article';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__inventorysync.price__help'} = '<p>
                    La fonction "synchronisation automatique" compare toutes les 4 heures (à partir de 0:00 dans la nuit) l\'état actuel des prix sur Kaufland et les prix de votre boutique.<br>
                    Ainsi les valeurs venant de la base de données sont vérifiées et appliquées même si des changements, par exemple, dans la gestion des marchandises, sont seulement réalisés dans la base de données.<br><br> 
 
                    <b>Remarque :</b> Les réglages sous l\'onglet "Configuration" → "Calcul du prix" seront pris en compte.
                 </p>';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__importactive'} = 'Importation de commandes';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__mwst'} = 'Taxe sur la valeur ajoutée';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__orderstatus'} = 'Synchronisation du statut de la commande de la boutique vers Kaufland';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmer la livraison avec';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.shipped__help'} = 'Définissez ici le statut dans votre boutique, qui doit automatiquement attribuer le statut "Livraison confirmée" sur Kaufland.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelled__label'} = 'Annuler la commande avec';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelled__help'} = '        Définissez  ici le statut de la boutique, qui doit "annuler la commande" automatiquement sur Kaufland. <br/><br/>
                Remarque : une annulation partielle est impossible ici. La commande tout entière est annulée avec cette fonctionnalité et est créditée à l\'acheteur.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.carrier__label'} = 'Transporteur';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.carrier__help'} = 'Transporteur présélectionné  pour la confirmation de la livraison vers {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelreason__label'} = 'Raison d\'annulation de la commande';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelreason__help'} = 'Raison pour laquelle la commandé est annulée';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__label'} = 'Taxe sur la valeur ajoutée pour les articles ne venant pas du magasin.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__hint'} = 'Le taux d\'imposition lors d\'une importation de commandes d\'articles ne venant pas de la boutique sera alors calculé en %.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__help'} = 'Si l\'article n\'a pas été enregistré sur magnalister, la TVA ne peut pas être déterminée.<br />
                 Comme solution alternative, la valeur sera fixée en pourcentage pour chaque produit enregistré, dont la TVA n\'est pas connue par Kaufland, lors de l\'importation.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__label'} = 'Activez l\'importation';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__help'} = 'Les importations de commandes doivent elles  être effectuées à partir de la place de marché? <br>
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
MLI18n::gi()->{'hitmeister_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__label'} = 'Premier lancement de l\'importation';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__hint'} = 'Point de départ du lancement de l\'importation';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__help'} = 'Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs de Kaufland ne peuvent être conservées, que quelques semaines au maximum. <br>
<br>
<b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__label'} = 'Statut de la commande en boutique';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__help'} = '               Définissez ici, Le statut qui sera automatiquement attribué aux commandes importé de Priceminister vers votre boutique. <br>
Si vous utilisez un système interne de gestion des créances, il est recommandé, de définir le statut de la commande comme étant "payé".';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.fbk__label'} = 'Statut pour les commandes FBK';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.fbk__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.fbk__help'} = 'Une commande FBK est une commande livrée par le service d\'expédition de Kaufland.
Cette fonction est uniquement réservée aux commerçants qui y ont souscrit.<br>
<br>
Définissez ici, le statut qui sera automatiquement attribué aux commandes FBK importées de Kaufland vers votre boutique. <br>
Si vous utilisez un système interne de gestion des créances, il est recommandé, de définir le statut de la commande comme étant "payé". <br>

';
MLI18n::gi()->{'hitmeister_config_orderimport__field__customergroup__label'} = 'Groupe clients';
MLI18n::gi()->{'hitmeister_config_orderimport__field__customergroup__help'} = 'Vous pouvez choisir ici un groupe dans lesquel vos clients seront classés. Pour créer des groupes, rendez-vous dans le menu de l\'administration de votre boutique PrestaShop ->Clients ->Groupes. Lorsqu\'ils sont créés, ils apparaissent dans la liste de choix proposée. ';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shippingmethod__label'} = 'Mode d\'expédition';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shippingmethod__help'} = 'Mode d\'expédition par défaut affectée à toutes les commandes Kaufland. <br> <br> Ce paramètre est important pour la facturation et l\'émission du bon de livraison, ainsi que pour la prise en compte de la commande dans la boutique et dans le gestionnaire de stock.';

MLI18n::gi()->ML_HITMEISTER_NOT_CONFIGURED_IN_KAUFLAND_DE_ACCOUNT = 'non configuré dans votre compte Kaufland';

MLI18n::gi()->ML_HITMEISTER_SYNC_FROM_MARKETPLACE_VALUES = [
    'rel' => 'Commande (pas de commande FBK) réduit le stock du shop (recommandé)',
    'fbk' => 'La commande (y compris la commande FBK) réduit le stock de la boutique',
    'no' => 'pas de synchronisation',
];
