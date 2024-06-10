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
/**
 * @see formfiled.php
 */
MLI18n::gi()->add('formfields_metro', array(
    'prepare_title' => array(
        'label' => 'Nom du produit<span class="bull">•</span>',
        'hint' => '150 caractères maximum',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Reprendre toujours le nom de l\'article actuel du magasin',
            ),
        )
    ),
    'prepare_description' => array(
        'label' => 'Description<span class="bull">•</span>',
        'hint' => 'Description détaillée et informative du produit avec ses spécifications et ses caractéristiques. Les détails de l\'offre, les informations sur l\'expédition ou la boutique comme les prix, les conditions de livraison, etc. ne sont pas autorisés. Veuillez noter qu\'il n\'y a qu\'une seule page de détails de produit par produit, partagée par tous les vendeurs proposant ce produit. N\'ajoutez pas d\'hyperliens, d\'images ou de vidéos.<br><br>
Les balises HTML suivantes sont autorisées : P, B, BR, A, UL, OL, LI, SPAN<br><br>
4000 caractères maximum',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Utilisez toujours la description actuelle de l\'article en magasin',
            ),
        )
    ),
    'prepare_shortdescription' => array(
        'label' => 'Description courte',
        'hint' => 'Brève description du produit avec un résumé des principales caractéristiques du produit.<br><br>150 caractères maximum 150 Zeichen',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Photo sur METRO<span class="bull">•</span>',
        'hint' => '10 images de produits maximum',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_gtin' => array(
        'label'    => 'GTIN (Global Trade Item Number)',
        /*'hint'     => 'Zum Beispiel: EAN, ISBN, ...<br><br>Maximal 14 Zeichen<br>Sie müssen hier eine GTIN hinterlegen, wenn Sie bei “Hersteller” und “Herstellerartikelnummer” keinen Wert eintragen.',*/
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_manufacturer' => array(
        'label'    => 'Fabricant',
        'hint'     => '100 caractères maximum <br>Si vous ne saisissez rien sous "GTIN", vous devez enregistrer ici un fabricant.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_manufacturerpartnumber' => array(
        'label'    => 'Numéro d\'article du fabricant',
        'hint'     => '100 caractères maximum <br>Si vous ne saisissez rien sous "GTIN", vous devez enregistrer ici un numéro d\'article du fabricant (MPN).',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_brand' => array(
        'label' => 'Marque',
        'hint' => '100 caractères maximum',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_feature' => array(
        'label' => 'Caractéristiques importantes',
        'hint' => '200 caractères maximum par caractéristique',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'toujours utiliser l\'actualité de la boutique en ligne',
            ),
        )
    ),
    'prepare_msrp' => array(
        'label' => 'Prix conseillé par le fabricant',
        'hint' => '',
    ),
    'prepare_saveaction' => array(
        'name' => 'saveaction',
        'type' => 'submit',
        'value' => 'save',
        'position' => 'right',
    ),
    'prepare_resetaction' => array(
        'name' => 'resetaction',
        'type' => 'submit',
        'value' => 'reset',
        'position' => 'left',
    ),
    'processingtime' => array(
        'label' => 'Délai de livraison min. en jours ouvrables',
        'help' => 'Indiquez ici le nombre minimum de jours ouvrables entre le moment où le client passe sa commande et la réception du colis.',
    ),
    'maxprocessingtime' => array(
        'label' => 'Délai de livraison max. en jours ouvrables',
        'help' => 'Indiquez ici le nombre maximum de jours ouvrables entre le moment où le client passe sa commande et la réception du colis.',
    ),
    'freightforwarding'              => array(
        'label' => 'Livraison par transporteur',
        'hint' => 'Indiquez si votre produit est expédié par transporteur.',
    ),
    'businessmodel'                  => array(
        'label' => 'Vendu à',
        'hint' => '',
    ),
    'shippinggroup'                => array(
        'label' => 'Group d\'envoi',
        'hint'  => '',
    ),
    'shippingprofile'                => array(
        'label' => 'Profils de frais d\'envoi',
        'hint'  => '',
    ),
    'orderstatus.carrier'            => array(
        'label' => '&nbsp;&nbsp;&nbsp;&nbsp;Transporteur',
        'help'  => 'Transporteur présélectionné lors de la confirmation de l\'envoi vers METRO',
    ),
    'orderstatus.cancellationreason' => array(
        'label' => 'Annuler une commande - Motif',
        'hint'  => 'Pour annuler une commande sur METRO, il faut indiquer un motif.',
    ),
    'volumeprices_enable' => array(
        'label' => 'Prix échelonnés',
        'help' => '
            <p>Staffelpreise dienen dazu, K&auml;ufer Rabatte bei der Abnahme h&ouml;herer St&uuml;ckzahlen zu bieten. Um Staffelpreise zu konfigurieren, haben Sie in magnalister folgende Optionen:</p>
            <p><br></p>
            <ol>
                <li>
                    <p>Aus nachfolgender Konfiguration verwenden<br><br>W&auml;hlen Sie diese Option, wenn Sie <strong>im magnalister Plugin</strong> f&uuml;r alle Produkte, die Sie auf den METRO Marktplatz hochladen, Staffelpreis-Rabatte einrichten m&ouml;chten.<br><br>Bei Auswahl der Option erscheint eine Liste, in der Sie im ersten Schritt w&auml;hlen k&ouml;nnen, welche Art von Staffelpreis-Rabatt Sie gew&auml;hren m&ouml;chten:</p>
                    <ol style="list-style-type: lower-alpha;">
                        <li>
                            <p>Prozentualer Preis-Auf-/Abschlag<br><br>Tragen Sie hier f&uuml;r die jeweilige St&uuml;ckzahl einen prozentualen Rabatt ein (z. B. ab 2 St&uuml;ck -&gt; &ldquo;5&rdquo; f&uuml;r 5 Prozent Rabatt). Der von magnalister zu METRO &uuml;bertragene Preis bei Abnahme von 2 St&uuml;ck wird dann um 5 % gemindert.<br><br>METRO gibt die Staffelungsm&ouml;glichkeiten der Preise vor. Eine Staffelung ist zwischen 2 und 5 St&uuml;ck m&ouml;glich, dar&uuml;ber hinaus k&ouml;nnen Sie unter &ldquo;Ab A St&uuml;ck&rdquo; und &ldquo;Ab B St&uuml;ck&rdquo; eigene Staffelungen eintragen (z. B. 15 % Rabatt ab einer Abnahme von 10 St&uuml;ck).<br><br>Au&szlig;erdem k&ouml;nnen Sie &uuml;ber &ldquo;Nachkommastelle&rdquo; die Preisanzeige im Cent-Bereich manipulieren. Weitere Infos dazu finden Sie im Info-Icon neben &ldquo;Nachkommastelle&rdquo;.</p>
                        </li>
                        <li>
                            <p>Fixer Preis-Auf-/Abschlag<br><br>Diese Option funktioniert analog zu a. Statt eines prozentualen Abschlags k&ouml;nnen Sie hier einen fixen Euro-Betrag eintragen (z. B. Ab 2 St&uuml;ck -&gt; &ldquo;5&rdquo; f&uuml;r 5 Euro Rabatt).</p>
                        </li>
                        <li>
                            <p>Kundengruppe<br><br>In Ihrem Shopsystem haben Sie die M&ouml;glichkeit, Artikel bestimmten Kundengruppen zuzuteilen. Innerhalb der Kundengruppen k&ouml;nnen Sie dann Anpassungen am Preis vornehmen. Hinterlegen Sie in magnalister bei einer bestimmten Staffelung (z. B. &ldquo;Ab 5 St&uuml;ck&rdquo;) eine Kundengruppe, so werden die Preiseinstellungen der Kundengruppe auf diese Staffel angewendet.</p>
                        </li>
                    </ol>
                </li>
                <li>
                    <p>Aus Web-Shop &uuml;bernehmen<br><br>Einige Shopsysteme bieten selbst Staffelpreis-Optionen an. Wenn Sie in magnalister &ldquo;Aus Web-Shop &uuml;bernehmen&rdquo; w&auml;hlen, k&ouml;nnen Sie die Staffelpreis-Einstellungen <strong>aus einer Shop-Kundengruppe</strong> &uuml;bernehmen.</p>
                </li>
                <li>
                    <p>Nicht verwenden<br><br>Wenn Sie keine Staffelpreise auf METRO anbieten m&ouml;chten, w&auml;hlen Sie diese Option.<br><br><br></p>
                </li>
            </ol>
            <p><strong>Wichtig:</strong></p>
            <p>Der Staffelpreis muss niedriger sein als der Standardpreis des Produkts, andernfalls werden die Angebote von METRO abgelehnt.</p>
        ',
        'hint' => '<span style="color: red">Attention, remarque importante : les suppléments de frais d\'envoi n\'ont pas d\'effet sur les prix échelonnés.</span>'
    ),
    'volumeprices_enable_useconfig' => 'Utiliser à partir de la configuration suivante',
    'volumeprices_enable_webshop' => 'Reprendre de la boutique web',
    'volumeprices_enable_dontuse' => 'Ne pas utiliser',
    'volumepriceswebshoppriceoptions' => array(
        'label' => 'Preis-Optionen',
        'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.',
        'hint' => '<span style="color: red">Die Funktion "Nachkommastelle" hat nur Auswirkungen auf den Bruttopreis.</span>'
    ),
    'volumeprices_price2' => array(
        'label' => 'A partir de 2 pièces',
        'hint' => '',
        'help' => '
            Si l\'option "majoré ou rabais" est sélectionnée, qu\'il s\'agisse d\'un pourcentage ou d\'une valeur fixe, le paramètre "Prix" choisi sous "Calcul du prix" est ignoré, mais les "options de prix" (comme le groupe de clients, les prix spéciaux) restent actives.<br>
            <br>
            Si l\'option "Groupes clients" est sélectionnée, les paramètres "Prix" et "Option de prix (y compris l\'option de prix spécial)" choisis sous "Calcul du prix" sont ignorés - et seul le prix du groupe de clients est transmis.
        ',
    ),
    'volumeprices_price3' => array(
        'label' => 'A partir de 3 pièces',
        'hint' => '',
        'help' => '
            Si l\'option "majoré ou rabais" est sélectionnée, qu\'il s\'agisse d\'un pourcentage ou d\'une valeur fixe, le paramètre "Prix" choisi sous "Calcul du prix" est ignoré, mais les "options de prix" (comme le groupe de clients, les prix spéciaux) restent actives.<br>
            <br>
            Si l\'option "Groupes clients" est sélectionnée, les paramètres "Prix" et "Option de prix (y compris l\'option de prix spécial)" choisis sous "Calcul du prix" sont ignorés - et seul le prix du groupe de clients est transmis.
        ',
    ),
    'volumeprices_price4' => array(
        'label' => 'A partir de 4 pièces',
        'hint' => '',
        'help' => '
            Si l\'option "majoré ou rabais" est sélectionnée, qu\'il s\'agisse d\'un pourcentage ou d\'une valeur fixe, le paramètre "Prix" choisi sous "Calcul du prix" est ignoré, mais les "options de prix" (comme le groupe de clients, les prix spéciaux) restent actives.<br>
            <br>
            Si l\'option "Groupes clients" est sélectionnée, les paramètres "Prix" et "Option de prix (y compris l\'option de prix spécial)" choisis sous "Calcul du prix" sont ignorés - et seul le prix du groupe de clients est transmis.
        ',
    ),
    'volumeprices_price5' => array(
        'label' => 'A partir de 5 pièces',
        'hint' => '',
        'help' => '
            Si l\'option "majoré ou rabais" est sélectionnée, qu\'il s\'agisse d\'un pourcentage ou d\'une valeur fixe, le paramètre "Prix" choisi sous "Calcul du prix" est ignoré, mais les "options de prix" (comme le groupe de clients, les prix spéciaux) restent actives.<br>
            <br>
            Si l\'option "Groupes clients" est sélectionnée, les paramètres "Prix" et "Option de prix (y compris l\'option de prix spécial)" choisis sous "Calcul du prix" sont ignorés - et seul le prix du groupe de clients est transmis.
        ',
    ),
    'volumeprices_priceA' => array(
        'label' => 'A partir de A pièces',
        'hint' => '',
        'help' => '
            Si l\'option "majoré ou rabais" est sélectionnée, qu\'il s\'agisse d\'un pourcentage ou d\'une valeur fixe, le paramètre "Prix" choisi sous "Calcul du prix" est ignoré, mais les "options de prix" (comme le groupe de clients, les prix spéciaux) restent actives.<br>
            <br>
            Si l\'option "Groupes clients" est sélectionnée, les paramètres "Prix" et "Option de prix (y compris l\'option de prix spécial)" choisis sous "Calcul du prix" sont ignorés - et seul le prix du groupe de clients est transmis.
        ',
    ),
    'volumeprices_priceB' => array(
        'label' => 'A partir de B pièces',
        'hint' => '',
        'help' => '
            Si l\'option "majoré ou rabais" est sélectionnée, qu\'il s\'agisse d\'un pourcentage ou d\'une valeur fixe, le paramètre "Prix" choisi sous "Calcul du prix" est ignoré, mais les "options de prix" (comme le groupe de clients, les prix spéciaux) restent actives.<br>
            <br>
            Si l\'option "Groupes clients" est sélectionnée, les paramètres "Prix" et "Option de prix (y compris l\'option de prix spécial)" choisis sous "Calcul du prix" sont ignorés - et seul le prix du groupe de clients est transmis.
        ',
    ),
));

MLI18n::gi()->add('metro_prepare_form', array(
    'field' => array(
        'variationgroups'       => array(
            'label' => 'Marktplatz-Kategorie<span class="bull">•</span>',
            'hint'  => '',
        ),
        'variationgroups.value' => array(
            'label' => 'Marktplatz-Kategorie:',
        ),
    ),
), false);
