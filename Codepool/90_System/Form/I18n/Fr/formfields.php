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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLI18n::gi()->add('formfields', array(
    'checkin.status' => array(
        'label' => 'Filtre de statut',
        'valuehint' => 'Appliquer uniquement aux articles actifs',
        'help' => 'Vous pouvez définir les articles de votre boutique, comme actifs ou inactifs. Selon le réglage, seuls les éléments actifs ou inactifs seront alors, affichés dans la préparation et le téléchargement des produits.',
    ),
    'lang' => array (
        'label' => 'Description d\'article',
    ),
    'prepare.status' => array(
        'label' => '{#i18n:formfields__checkin.status__label#}',
        'valuehint' => '{#i18n:formfields__checkin.status__valuehint#}',
        'help' => 'Vous pouvez définir les articles de votre boutique, comme actifs ou inactifs. Selon le réglage, seuls les éléments actifs ou inactifs seront alors, affichés dans la préparation et le téléchargement des produits.',
    ),
    'tabident' => array(
        'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
        'help' => '{#i18n:ML_TEXT_TAB_IDENT#}',
    ),
    'stocksync.tomarketplace' => array(
        'label' => 'Variation du stock boutique',
        'help' => '
            Note : Idealo ne reconnaît les produits, que "disponible" ou "non disponible" pour vos offres, en conséquence  :<br />
            <br />
            Quantité boutique > 0 = disponible sur Idéalo<br />
            Quantité stock < 1 = non disponible sur Idealo<br />
            <br />
            <br />
            Fonction :<br />
            Synchronisation automatique via CronJob (recommandée)<br />
            <br />
            <br />
            La fonction "Synchronisation automatique" ajuste l\'inventaire Idéalo actuel à, l\'inventaire boutique, toutes les 4 heures. <br />
            <br />
            Les données sont vérifiées et transférées de la base de données, même si les modifications ont été effectuées directement dans la base de données, par exemple, par un système  de gestion de marchandise.<br />
            <br />
            Vous pouvez déclencher une synchronisation manuelle, en cliquant sur le bouton correspondant, dans le groupe de boutons gris en haut à gauche de l\'en-tête magnalister.<br />
            <br />
            Il est aussi possible de synchroniser votre stock, en utilisant un CronJob personnel. Cela n’est possible qu’à partir du tarif “flat”. CronJob vous permet de réduire le délai maximal de synchronisation de vos données à 15 minutes d\'intervalle. Pour opérer la synchronisation, utilisez le lien suivant :<br />
            <i>{#setting:sSyncInventoryUrl#}</i><br />
            <br />
            Toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minutes sera bloqué.<br />
            <br />
            Remarque : les paramètres sous "Configuration" → "Téléchargement d\'article" ...<br />
            <br />
            → “Limite journalière de commandes" et<br />
            → “Stock” pour les deux premières options.<br />
            <br />
            ... sont pris en compte.
        ',
    ),
    'stocksync.frommarketplace' => array(
        'label' => 'Variation du stock {#setting:currentMarketplaceName#}',
        'help' => '
            Si cette fonction est activée, le nombre de commandes effectués et payés sur {#setting:currentMarketplaceName#}, sera soustrait de votre stock boutique.<br>
            <br>
            <b>Important :</b> Cette fonction n’est opérante que lors de l’importation des commandes.
        ',
    ),
    'inventorysync.price' => array(
        'label' => 'Prix d&apos;article',
        'help' => '
            Synchronisation automatique via CronJob (recommandée)<br />
            <br />
            Cette mise à jour aura lieu toutes les quatre heures, à moins que vous n’ayez défini d’autres paramètres de configuration. <br />
            Les donnés sont vérifiées et transférées de la base de données, même si les modifications ont été effectuées directement dans la base de données.<br />
            <br />
            Vous pouvez à tout moment effectuer une synchronisation manuelle des prix en cliquant sur le bouton “synchroniser les prix et les stocks” en haut à droite du module, dans le groupe de boutons gris. <br />
            <br />
            Il est aussi possible de synchroniser vos prix, en utilisant un CronJob personnel. Ceci n’est possible qu’à partir du tarif “flat”. CronJob vous permet de réduire le délais maximal de synchronisation de vos données à 15 minutes d\'intervalle. Pour opérer la synchronisation utilisez le lien suivant :<br />
            <i>{#setting:sSyncInventoryUrl#}</i><br />
            <br />
            Toute importation provenant d’un client n’utilisant pas le tarif “flat” ou ne respectant pas le délai de 15 minutes sera bloqué.<br />
            <br />
            Remarque : les paramètres configurés dans “Configuration” → “calcul du prix”, affecterons cette fonction.
        ',
    ),
    'mail.send' => array(
        'label' => 'Envoyer',
        'help' => 'Activez cette fonction si vous voulez qu’un courriel soit envoyé à vos clients, afin de promouvoir votre boutique en ligne.',
    ),
    'mail.originator.name' => array(
        'label' => 'Nom de l\'expéditeur',
        'default' => 'Exemple-Shop',
    ),
    'mail.originator.adress' => array(
        'label' => 'Adresse de l\'expéditeur',
        'default' => 'exemple@onlineshop.de',
    ),
    'mail.subject' => array(
        'label' => 'Objet',
        'default' => 'Votre commande sur #SHOPURL#',
    ),
    'mail.content' => array(
        'label' => 'Contenu de l\'E-mail',
        'hint' => 'Liste des champs disponibles pour "objet" et "contenu".
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
        </dl>',
        'default' => 
'<style><!--
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
<p>Votre équipe #ORIGINATOR#</p>'
    ),
    'mail.copy' => array(
        'label' => 'Copie à l\'expéditeurr',
        'help' => 'Activez cette fonction si vous souhaitez recevoir une copie du courriel.',
    ),
    'quantity' => array(
        'label' => 'Variation de stock',
        'help' => '
            Cette rubrique vous permet d’indiquer les quantités disponibles d’un article de votre stock, pour une place de marché particulière. <br>
            <br>
            Elle vous permet aussi de gérer le problème de ventes excédentaires. Pour cela activer dans la liste de choix, la fonction : "reprendre le stock de l\'inventaire en boutique, moins la valeur du champ de droite". <br>
            Cette option ouvre automatiquement un champ sur la droite, qui vous permet de donner des quantités à exclure de la comptabilisation de votre inventaire général, pour les réserver à un marché particulier. <br>
            <br>
            <b>Exemple :</b> Stock en boutique : 10 (articles) &rarr; valeur entrée: 2 (articles) &rarr; Stock alloué à {#setting:currentMarketplaceName#}: 8 (articles).<br>
            <br>
            <b>Remarque :</b> Si vous souhaitez cesser la vente sur {#setting:currentMarketplaceName#}, d’un article que vous avez encore en stock, mais que vous avez désactivé de votre boutique, procédez comme suit :
            <ol>
                <li>Cliquez sur  les onglets  “Configuration” →  “Synchronisation”; </li>
                <li>Rubrique  “Synchronisation des Inventaires" →  "Variation du stock boutique";</li>
                <li>Activez dans la liste de choix "synchronisation automatique via CronJob";</li>
                <li>Cliquez sur  l’onglet  "Configuration globale";</li>
                <li>Rubrique “Inventaire”, activez "Si le statut du produit est placé comme étant   inactif, le niveau des stocks sera alors enregistré comme quantité 0".</li>
            </ol>
        ',
    ),
    'maxquantity' => array(
        'label' => 'Nombre d\'unité maximale',
        'help' => '
            Cette fonction vous permet de limiter la quantité disponible d’un article, sur votre marché {#setting:currentMarketplaceName#}.
            <br /><br />
            <strong>Exemple</strong> : Sous la rubrique "Quantité", choisissez l’option "Prendre en charge (cas) le stock de la boutique" puis inscrivez “20” sous la rubrique “Quantité limitée”. Ainsi ne seront vendables sur {#setting:currentMarketplaceName#}, que 20 pièces d’un article donné, disponible dans le stock de votre boutique. <br />
            La synchronisation du stock (si elle est activée) harmonisera dans ce cas les quantités entre vos différents stocks à concurrence de 20 pièces maximum. 
            <br /><br />
            Si vous ne souhaitez pas de limitation, laissez le champ vide ou inscrivez "0".<br /><br />
            <strong>Remarque</strong> : Si sous la rubrique "Quantité", vous avez choisi l’option "forfait (sur le côté droit)", la limitation n\'est pas applicable.
        ',
    ),
    'priceoptions' => array(
        'label' => 'Groupe clients',
        'help' => '{#i18n:configform_price_field_priceoptions_help#}',
    ),
    'price.usespecialoffer' => array(
        'label' => 'Prendre en compte les prix spéciaux',
    ),
    'exchangerate_update' => array(
        'label' => 'Taux de change',
        'valuehint' => 'Actualiser automatiquement les taux de change',
        'help' => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
        'alert' => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
    ),
    'importactive' => array(
        'label' => 'Activez l\'importation',
        'help' => '
            Est-ce que les importations de commandes doivent être effectuées à partir de la place de marché?<br />
            <br />
            Si la fonction est activée, les commandes seront automatiquement importées toutes les heures.<br />
            <br />
            Vous pouvez régler vous-même la durée de l\'importation automatique des commandes en cliquant sur <br />
            "magnalister Admin" → "Configuration globale" → "Importation des commandes".<br />
            <br />
            Vous pouvez déclencher une importation manuellement, en cliquant sur la touche de fonction correspondante dans l\'en-tête de magnalister (à gauche).<br />
            <br />
            En outre, vous pouvez également déclencher l\'importation des commandes (dès le "tarif Flat" - au maximum toutes les 15 minutes) Via CronJob, en suivant le lien suivant vers votre boutique: <br />
            <i>{#setting:sImportOrdersUrl#}</i><br />
            <br />
            Les importations de commandes effectuées via CronJob par des clients, qui ne sont pas en "Flat tarif", ou qui ne respectent pas les 15 minutes de délai, seront bloqués.
        ',
    ),
    'preimport.start' => array(
        'label' => 'Premier lancement de l\'importation',
        'hint' => 'Premier lancement',
        'help' => '
            Les commandes seront importées à partir de la date que vous saisissez dans ce champ. Veillez cependant à ne pas donner une date trop éloignée dans le temps pour le début de l’importation, car les données sur les serveurs d\'{#setting:currentMarketplaceName#} ne peuvent être conservées, que quelques semaines au maximum. <br>
            <br>
            <b>Attention</b> : les commandes non importées ne seront après quelques semaines plus importables!
        ',
    ),
    'customergroup' => array(
        'label' => 'Groupes clients',
        'help' => 'Groupes de clients, auxquels les clients peuvent être affectés lors de nouvelles commandes',
    ),
    'orderimport.shop' => array(
        'label' => '{#i18n:form_config_orderimport_shop_lable#}',
        'help' => '{#i18n:form_config_orderimport_shop_help#}',
    ),
    'orderstatus.open' => array(
        'label' => 'Statuts de la commandes en boutique',
        'help' => '
            Déterminez ici le statut, qui déclenche le téléchargement automatiquement d\'une nouvelle commane idéalo, dans votre boutique.<br />
            Si vous utilisez un système de recouvrement de factures, il est conseillé de définir l\'état de la commande par «payé» (configuration → état de la commande).
        ',
    ),
    'orderimport.shippingmethod' => array(
        'label' => 'Mode d\'expédition',
        'help' => '
            Mode d\'expédition standard, assignée à toutes les commandes {#setting:currentMarketplaceName#}. Standard : "{#setting:currentMarketplaceName#}".<br />
            <br />
            Ce paramètre est important pour l\'impression des factures les bons de livraison, pour le traitement ultérieur de la commande dans la boutique ainsi que pour la gestion des marchandises.<br />
        ',
    ),
    'orderimport.paymentmethod' => array(
        'label' => 'Mode de paiement des commandes',
        'help' => '
            <p>Le mode de paiement, qui sera associé à toutes les commandes d\'{#setting:currentMarketplaceName#}, lors de l\'importation des commandes. Standard: "Attribution automatique"</p>
            <p>Si vous sélectionnez „Attribution automatique", magnalister reprend le mode de paiement, choisi par l\'acheteur sur {#setting:currentMarketplaceName#}.</p>
            <p>Ce paramètre est important pour les factures et l\'impression des bons de livraison et le traitement ultérieur des commandes en boutique, ainsi que dans la gestion des marchandises.</p>
        ',
    ),
    'mwst.fallback' => array(
        'label' => 'TVA des articles non référencés dans la boutique',
        'hint' => 'Le taux d\'imposition lors d\'une importation de commandes d\'articles ne venant pas de la boutique sera alors calculé en %.',
        'help' => '
            Si la référence d\'un article n\'est pas reconnue par la boutique lors de l\'importation d\'une commande, la TVA ne peut pas être calculée.<br />
            Nous proposons une solution alternative : la valeur donnée ici s\'applique en pourcentage à chaque produit, dont la TVA n\'est pas connue, lors d\'une importation idealo.
        ',
    ),
    'orderstatus.sync'                           => array(
        'label' => 'Synchronisation du statut',
        'help' => '
            La synchronisation automatique de la fonction via CronJob transmet toutes les 2 heures (à partir de 0:00 dans la nuit) le statut actuel des commandes (envoyées) sur Cdisount.<br />
            Ainsi les valeurs venant de la base de données sont vérifiées et appliquées même si des changements, par exemple, dans la gestion des marchandises, sont seulement réalisés dans la base de données.<br />
            <br />
            Un réglage manuel peut être déclenché, en traitant directement une commande de votre boutique en ligne. Vous réglez alors le statut correspondant de la commande et cliquez sur "Actualiser".<br />
            <br />
            Vous pouvez aussi cliquer sur la touche de fonction correspondante dans l\'en-tête de magnalister (à gauche), pour transmettre immédiatement le statut correspondant.<br />
            <br />
            En outre, vous pouvez utiliser la synchronisation des statuts de commande (dès le "tarif Flat" - ou au maximum toutes les 15 minutes) en déclenchant les importations via CronJob, et en cliquant sur le lien suivant vers votre boutique:<br />
            <br />
            <i>{#setting:sSyncOrderStatusUrl#}</i><br/><br/>
            <br />
            Les importations déclenchées via CronJob par des clients qui ne sont pas au "tarif Flat" ou qui ne respectent pas le délai de 15 minutes, seront bloqués.
        ',
    ),
    'orderstatus.shipped'                        => array(
        'label' => 'Confirmer la livraison avec',
        'help' => 'Définissez ici le statut de la commande, qui doit automatiquement confirmer la livraison  sur {#setting:currentMarketplaceName#}.',
    ),
    'orderstatus.carrier.default'                => array (
        'label' => 'Expéditeur',
        'help'  => 'Transporteur choisi en confirmant l\'expédition sur {#setting:currentMarketplaceName#}.',
    ),
    'orderstatus.canceled'                       => array(
        'label' => 'Annuler la commande avec',
        'help'  => '
            Sélectionnez ici, le statut boutique, qui transmettra automatiquement le statut "Commande annulée" à l\'{#setting:currentMarketplaceName#}.<br />
            <br />
            Remarque: Dans le cadre de commandes groupées, l\'annulation partielle n\'est pas possible. Cette fonction annulera toute la commande.
        ',
    ),
    'config_uploadInvoiceOption'                      => array(
        'label' => 'Options de transmission des factures',
        'help'  => '<p>Choisissez ici comment vous souhaitez envoyer vos factures à {#setting:currentMarketplaceName#} :</p>
<ol>
    <li>
        <p>Ne pas transmettre les factures à {#setting:currentMarketplaceName#}</p>
        <p>Si vous sélectionnez cette option, vos factures ne seront pas transmises à {#setting:currentMarketplaceName#}. Cela signifie que vous
            devrez
            télécharger vos factures par vos propres soins.</p>
    </li>
    {#i18n:formfields_config_uploadInvoiceOption_help_webshop#}
    {#i18n:formfields_config_uploadInvoiceOption_help_erp#}

    <li>
        <p>Charger magnalister de la création et de la transmission des factures</p>
        <p>Sélectionnez cette option si vous souhaitez que magnalister prenne en charge la création et la transmission
            des
            factures. Pour ce faire, veuillez remplir les champs sous “Données pour la création des factures via
            magnalister”.
            La transmission est effective toutes les 60 minutes.</p>
    </li>
</ol>',
    ),
    'config_invoice_invoiceDir'                       => array(
        'label'      => 'Factures téléchargées',
        'buttontext' => 'Afficher',
    ),
    'config_invoice_mailCopy'                         => array(
        'label' => 'Copie de la facture à',
        'hint'  => 'Entrez votre adresse email pour recevoir une copie de la facture téléchargée sur Amazon',
    ),
    'config_invoice_invoiceNumberPrefix'              => array(
        'label'   => 'Préfixe numéro de facture',
        'hint'    => 'Si vous définissez un préfixe, celui-ci sera placé automatiquement devant le numéro de facture. Exemple : F10000. Le numéro des factures générées par magnalister commence par 10000',
        'default' => 'F', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_reversalInvoiceNumberPrefix'      => array(
        'label'   => 'Préfixe numéro de facture d\'annulation',
        'hint'    => 'Si vous définissez un préfixe, celui-ci sera placé automatiquement devant le numéro de facture d\'annulation. Exemple : S20000. Le numéro des factures d\'annulation générées par magnalister commence par 20000',
        'default' => 'S', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceNumber'                    => array(
        'label' => 'Numéro de facture',
        'help'  => '<p>
Choisissez ici si les numéros de facture doivent être générés par magnalister ou si vous voulez qu’ils soient extraits d’un champ de texte libre de Shopware.
</p><p>
<b>Charger magnalister de la création des numéros de commande</b>
</p><p>
Lors de la création des factures par magnalister, des numéros de factures consécutifs sont automatiquement générés. Saisissez ici un préfixe qui sera automatiquement placé devant le numéro de facture.
Exemple : F10000
</p><p>
Note : Les commandes créées par magnalister commencent par le numéro 10000.
</p><p>
<b>Tirer le numéro de commande d’un {#i18n:shop_order_attribute_name#}</b>
</p><p>
Lors de la création de la facture, le numéro de commande est tirée du {#i18n:shop_order_attribute_name#} que vous avez sélectionné.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Important :</b> <br/>l’agrandisseur génère et transmet la facture dès que la commande est marquée comme expédiée. Veuillez vous assurer que le champ de texte libre est bien rempli, sinon une erreur sera causée (voir l’onglet "Journal des erreurs").
<br/><br/>
Si vous utilisez la correspondance des champs de texte libre, la société Magnalister n’est pas responsable de la création correcte et consécutive des numéros de facture.
</p>',
    ),
    'config_invoice_reversalInvoiceNumber'            => array(
        'label' => 'Numéro de facture d’annulation',
        'help'  => '<p>
Choisissez ici si les numéros de facture doivent être générés par magnalister ou si vous voulez qu’ils soient extraits d’un champ de texte libre de Shopware.
</p><p>
<b>Charger magnalister de la création des numéros de commande</b>
</p><p>
Lors de la création des factures par magnalister, des numéros de factures consécutifs sont automatiquement générés. Saisissez ici un préfixe qui sera automatiquement placé devant le numéro de facture.
Exemple : F10000
</p><p>
Note : Les commandes créées par magnalister commencent par le numéro 10000.
</p><p>
<b>Tirer le numéro de commande d’un {#i18n:shop_order_attribute_name#}</b>
</p><p>
Lors de la création de la facture, le numéro de commande est tirée du {#i18n:shop_order_attribute_name#} que vous avez sélectionné.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Important :</b> <br/>l’agrandisseur génère et transmet la facture dès que la commande est marquée comme expédiée. Veuillez vous assurer que le champ de texte libre est bien rempli, sinon une erreur sera causée (voir l’onglet "Journal des erreurs").
<br/><br/>
Si vous utilisez la correspondance des champs de texte libre, la société Magnalister n’est pas responsable de la création correcte et consécutive des numéros de facture.
</p>',
    ), 'config_invoice_invoiceNumberOption'           => array(
        'label' => '',
    ),
    'config_invoice_reversalInvoiceNumberOption'      => array(
        'label' => '',
    ),
    'config_invoice_invoiceNumberPrefixValue'         => array(
        'label' => 'Préfixe numéro de facture',
    ),
    'config_invoice_reversalInvoiceNumberPrefixValue' => array(
        'label' => 'Préfixe numéro de facture d’annulation',
    ),
    'config_invoice_invoiceNumberMatching'            => array(
        'label' => 'Champ de texte libre pour les commandes Shopware',
    ),
    'config_invoice_reversalInvoiceNumberMatching'    => array(
        'label' => 'Champ de texte libre pour les commandes Shopware',
    ),
    'config_invoice_companyAddressLeft'               => array(
        'label'   => 'Adresse de l’entreprise (champ d’adresse de gauche)',
        'default' => 'Your name, Your street 1, 12345 Your town', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_companyAddressRight'              => array(
        'label'   => 'Champ d’adresse de l\'entreprise (droite)',
        'default' => "Your name\nYour street 1\n\n12345 Your town", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_headline'                         => array(
        'label'   => 'Intitulé de la facture',
        'default' => 'Votre facture', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceHintHeadline'              => array(
        'label'   => 'Intitulé : notes de facturation',
        'default' => 'Notes de facturation', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceHintText'                  => array(
        'label'   => 'Texte d\'information',
        'hint'    => 'Laissez le champ vide si aucune information ne doit figurer sur la facture.',
        'default' => 'Votre texte d\'information pour la facture', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell1'                      => array(
        'label'   => 'Pied de page colonne 1',
        'default' => "Your name\nYour street 1\n\n12345 Your town", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell2'                      => array(
        'label'   => 'Pied de page colonne 2',
        'default' => "Your telephone number\nYour fax number\nYour homepage\nYour e-mail", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell3'                      => array(
        'label'   => 'Pied de page colonne 3',
        'default' => "Your tax number\nYour Ust. ID. No.\nYour jurisdiction\nYour details", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell4'                      => array(
        'label'   => 'Pied de page colonne 4',
        'default' => "Additional\nInformation\nin the fourth\ncolumn", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_preview'                          => array(
        'label'      => 'Aperçus de la facture',
        'buttontext' => 'Aperçus',
        'hint'       => 'Vous pouvez ici afficher un aperçu de votre facture avec les données que vous avez saisies.',
    ),
    'erpInvoiceSource'                                => array(
        'label'      => 'Répertoire source pour factures (chemin d’accès)',
        'help'       => '<p>Choisissez ici le chemin d’accès au répertoire dans lequel vous avez téléchargé en PDF les factures créées dans le système tiers (par exemple ERP).</p>

    <b>Important:</b> <br>
<p>Pour que magnalister puisse associer une facture en PDF à une commande dans la boutique, les fichiers PDF doivent être nommés en respectant un modèle précis :</p>
<ol>
    <li><p>Désignation d’après la commande dans la boutique</p>

        <p>Modèle : #numero-de-commande-boutique#.pdf</p>

        <p>Exemple:  <br>
            Numéro de la commande dans votre e-boutique : 12345678<br>
            Facture en PDF : 12345678.pdf</p>
    </li>
    <li>
        <p>Désignation d’après la commande dans la boutique + numéro de facture dans le système ERP</p>

        <p>Modèle :  #numéro-de-commande-boutique#_#numéro-de-facture#.pdf</p>

        <p>Exemple: <br>
            Numéro de la commande dans la boutique : 12345678<br>
            Numéro de facture dans ERP : 9876543<br>
            Facture en PDF : 12345678_9876543.pdf </p>
    </li>
</ol>',
        'hint'       => '',
        'buttontext' => 'Wählen',

    ),
    'erpInvoiceDestination'                           => array(
        'label'      => 'Répertoire de destination pour les factures transmises à {#setting:currentMarketplaceName#} (chemin d’accès)',
        'help'       => '<p>Une fois que magnalister a chargé une facture depuis le répertoire source sur {#setting:currentMarketplaceName#}, celle-ci est placée dans le répertoire de destination. Ainsi, vous pourrez vérifier quelles factures ont déjà été transmises à {#setting:currentMarketplaceName#}.</p>

<p>Sélectionnez ici le chemin d’accès vers le répertoire cible dans lequel les factures chargées sur {#setting:currentMarketplaceName#} doivent être placées.</p>

<p><b>Important</b> : Si vous ne sélectionnez pas un serveur de destination différent pour les factures chargées sur {#setting:currentMarketplaceName#},  vous ne serez pas en mesure de reconnaître les factures déjà chargées sur {#setting:currentMarketplaceName#}.</p>',
        'hint'       => '',
        'buttontext' => 'Wählen',
    ),
    'erpReversalInvoiceSource'                        => array(
        'label'      => 'Répertoire source pour les avoirs (chemin d’accès)',
        'help'       => '<p>Sélectionnez ici le chemin d’accès vers le répertoire dans lequel les avoirs issus de votre système tiers (par exemple ERP) ont été stockés au format PDF.</p>

    <b>Important:</b> <br>
<p>Pour que magnalister puisse associer un avoir en PDF à une commande sur votre e-boutique, vous devez nommer vos fichiers PDF en respectant un modèle précis :</p>
<ol>
    <li><p>Désignation d’après la commande dans la boutique</p>

        <p>Modèle : #numero-de-commande-boutique#.pdf</p>

        <p>Exemple:  <br>
            Numéro de la commande dans votre e-boutique : 12345678<br>
            Avoir en PDF : 12345678.pdf</p>
    </li>
    <li>
        <p>Désignation d’après la commande + numéro de l’avoir dans le système ERP</p>

        <p>Modèle :  #numero-de-commande-boutique#_#numero-avoir#.pdf</p>

        <p>Exemple: <br>
            Numéro de la commande dans la boutique : 12345678<br>
            Numéro de l’avoir dans le système ERP : 9876543<br>
            Avoir en PDF : 12345678_9876543.pdf </p>
    </li>
</ol>',
        'hint'       => '',
        'buttontext' => 'Wählen',
    ),
    'erpReversalInvoiceDestination'                   => array(
        'label'      => 'Répertoire de destination pour les avoirs transmis à {#setting:currentMarketplaceName#} (chemin d’accès)',
        'help'       => '<p>Une fois que magnalister a chargé un avoir depuis le répertoire source sur {#setting:currentMarketplaceName#}, celui-ci est placé dans le répertoire de destination. Ainsi, les vendeurs peuvent vérifier quels avoirs ont déjà été transmis à {#setting:currentMarketplaceName#}.</p>

<p>Sélectionnez ici le chemin d’accès vers le répertoire de destination dans lequel doivent être placés les avoirs chargés sur {#setting:currentMarketplaceName#}.</p>

<p><b>Important</b> : Si vous ne souhaitez pas que vos avoirs soient placés dans le répertoire de destination une fois chargés sur {#setting:currentMarketplaceName#}, utilisez le même chemin d’accès pour le répertoire cible et pour le répertoire source.</p>',
        'hint'       => '',
        'buttontext' => 'Wählen',

    ),
));

MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_magnalister'} = 'Charger magnalister de la création des numéros de commande';
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_matching'} = 'Tirer le numéro de commande d’un {#i18n:shop_order_attribute_name#}';

MLI18n::gi()->add('formfields_uploadInvoiceOption_values', array(
    'off'     => 'Ne pas transmettre les factures à {#setting:currentMarketplaceName#}',
    'webshop' => 'Transmettre les factures créées dans la boutique',
    'erp'     => 'Les factures créées dans le système tiers (par exemple ERP) sont transmises à {#setting:currentMarketplaceName#}',
    'magna'   => 'Charger magnalister de la création et de la transmission des factures',
));

MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_erp'} = '<li><p>Les factures créées par des systèmes tiers (par exemple un système ERP) sont transmises à {#setting:currentMarketplaceName#}.</p>
        <p>Les factures que vous avez créées à l’aide d’un système tiers (par exemple un système ERP) peuvent être
            déposées
            sur
            le serveur de votre boutique en ligne, récupérées par magnalister et chargées sur la plateforme {#setting:currentMarketplaceName#}. Des
            informations complémentaires apparaissent après le choix de cette option dans l’icône info sous “Paramètres
            pour
            la
            transmission des factures créées à partir d’un système tiers [...]”.</p></li>';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_webshop'} = ' <li><p>Transmettre les factures créées dans la boutique</p>
        <p>Si votre système de e-boutique prend en charge la création des factures, vous pouvez les télécharger sur
            {#setting:currentMarketplaceName#}.</p></li>';MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_matching'} = 'Tirer le numéro de commande d’un {#i18n:shop_order_attribute_name#}';
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_magnalister'} = 'Charger magnalister de la création des numéros de commande';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_webshop'} = ' <li><p>Transmettre les factures créées dans la boutique</p>
        <p>Si votre système de e-boutique prend en charge la création des factures, vous pouvez les télécharger sur
            {#setting:currentMarketplaceName#}.</p></li>';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_erp'} = '<li><p>Les factures créées par des systèmes tiers (par exemple un système ERP) sont transmises à {#setting:currentMarketplaceName#}.</p>
        <p>Les factures que vous avez créées à l’aide d’un système tiers (par exemple un système ERP) peuvent être
            déposées
            sur
            le serveur de votre boutique en ligne, récupérées par magnalister et chargées sur la plateforme {#setting:currentMarketplaceName#}. Des
            informations complémentaires apparaissent après le choix de cette option dans l’icône info sous “Paramètres
            pour
            la
            transmission des factures créées à partir d’un système tiers [...]”.</p></li>';
