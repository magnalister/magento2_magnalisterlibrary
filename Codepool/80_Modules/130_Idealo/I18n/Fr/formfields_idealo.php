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

// example for overwriting global element
MLI18n::gi()->add('formfields__quantity', array('help' => '{#setting:currentMarketplaceName#} n\'autorise, que la quantité de stock "disponible" ou "non disponible". Indiquez si l\'article doit être offert en fonction de l\'inventaire de votre magasin.<br /><br />Pour éviter les surventes, vous pouvez utiliser la valeur «prendre en charge le stock de la boutique, moins, la valeur du champ ci-contre» et donner une valeur de reserve dans le champ mentionné.<br /><br />Exemple : Stock en boutique : 10 (articles) → valeur entrée: 2 (articles) → Stock alloué à {#setting:currentMarketplaceName#}: 8 (articles).<br /><br />Note: Si, vous voulez que les articles inactifs, indépendamment des quantités disponibles, aient sur le marché une valeur de stock "0", veuillez procéder comme suit:<br /<br />Cliquez sur les onglets “Configuration” → “Synchronisation”;<br />Rubrique “Synchronisation des Inventaires" → "Variation du stock boutique";<br />Activez dans la liste de choix "synchronisation automatique via CronJob",<br />Cliquez sur l’onglet "Configuration globale", Rubrique “Inventaire”,<br />activez<br />"Si le statut du produit est placé comme étant inactif, le niveau des stocks sera alors enregistré comme quantité 0".'));

MLI18n::gi()->add('formfields_idealo', array(
    'shippingcountry'                 => array(
        'label' => 'Expédié vers',
    ),
    'shippingmethodandcost'           => array(
        'label' => 'Frais d\'expédition',
        'help'  => 'Entrez ici les frais d\'expédition standards de vos articles. Dans "Préparation d\'articles", vous pouvez donner des frais particuliers pour les produits sélectionnés .',
    ),
    'shippingcostmethod'              => array(
        'values' => array(
            '__ml_lump'   => MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_LUMP,
            '__ml_weight' => 'Frais d\'expédition = articles poids',
        ),
    ),
    'paymentmethod'                   => array(
        'label'  => 'Mode de payement <span class="bull">•</span>',
        'help'   => '
            indiquez les modes de paiement standard souhaités sur idealo et pour l\'achat direct (multiple possible sélection).<br />
            Sous "préparer les produits", vous pouvez, à tout moment et individuellement, ajuster les modes de paiement  par produit.<br />
            <br />
            Note: {#setting:currentMarketplaceName#} n\'autorise pour l\'achat direct, que le paiement avec PayPal, le transfert instantané ou les cartes de crédit.<br />
            Le mode de paiement, que vous avez sélectionné pour l\'achat direct, sera également affiché sur idealo.
        ',
        'values' => array(
            'PAYPAL'     => 'PayPal',
            'CREDITCARD' => 'carte de crédit',
            'SOFORT'     => 'Sofort&uuml;berweisung',
            'PRE'       => 'paiement anticipé',
            'COD'       => 'paiement à la livraison',
            'BANKENTER' => 'banque entrer',
            'BILL'      => 'facture',
            'GIROPAY'   => 'Giropay',
            'CLICKBUY'  => 'Click&Buy',
            'SKRILL'    => 'Skrill',
        ),
    ),
    'access.inventorypath'            => array(
        'label' => 'Lien vers votre fichier CSV',
    ),
    'shippingmethod'                  => array(
        'label'  => 'Mode d\'expédition',
        'help'   => 'Spécifiez la méthode d\'expédition qui sera utilisée pour vos devis d\'achat direct.',
        'values' => array(
            'Paketdienst' => 'service de colis',
            'Spedition'   => 'entreprise de transport',
            'Download'    => 'Download',
        ),
    ),
    'shippingtime'                    => array(
        'label'    => 'délai de livraison',
        'optional' => array(
            'checkbox' => array(//*todo 'labelNegativ' => 'immer aus Konfiguration übernehmen',
            ),
        )
    ),
    'shippingtimetype'                => array(
        'values' => array(
            '__ml_lump'   => array('title' => 'Forfait (dans le champs de droite)',),
            'immediately' => array('title' => 'immédiatement',),
            '4-6days'     => array('title' => '4-6 journées',),
            '1-2days'     => array('title' => '1-2 journées',),
            '2-3days'     => array('title' => '2-3 journées',),
            '4weeks'      => array('title' => '4 semaines',),
            '24h'         => array('title' => '24 heures',),
            '1-3days'     => array('title' => '1-3 journées',),
            '3days'       => array('title' => '3 journées',),
            '3-5days'     => array('title' => '3-5 journées',),
        ),
    ),
    'shippingtimeproductfield'        => array(
        'label' => 'délai de livraison (matching)',
    ),
    'campaignlink' => array(
        'label' => 'Lien de la campagne',
        'help' => 'Pour créer un lien de campagne qui puisse faire l\'objet d\'un suivi spécifique, veuillez saisir une chaîne de caractères sans caractères spéciaux (par ex. trémas, signes de ponctuation et espaces), comme par exemple "toutdoitdisparaitre".',
    ),
    'prepare_title' => array(
        'label' => 'Titre',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'prepare_description' => array(
        'label' => 'Description',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Images de produits',
        'hint' => 'Maximal 3 images',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'currency' => array(
        'label' => 'Monnaie',
        'hint' => '',
    ),
));
