<?php

MLI18n::gi()->add('configuration', array(
    'legend' => array(
        'general' => 'Paramètres généraux',
        'sku' => 'Synchronisation du référencement',
        'stats' => 'Statistiques',
        'orderimport' => 'Importation des commandes',
        'crontimetable' => 'Divers',
        'articlestatusinventory' => 'Inventaire',
        'productfields' => 'Propriétés du produit',
    ),
    'field' => array(
        'general.passphrase' => array(
            'label' => 'PassPhrase',
            'help' => 'Vous recevrez la PassPhrase après votre inscription sur le site www.magnalister.com.',
        ),
        'general.keytype' => array(
            'label' => 'Choisissez',
            'help' => 'Lorsque vous enregistrez un nouveau produit sur votre boutique, vous lui attribuez automatiquement un numéro d\'enregistrement : le <strong>numéro ID</strong>. Sous la rubrique &laquo; <strong>référence</strong> &raquo;, vous pouvez aussi attribuer vos propres références à vos produits. <br/><br/>

Selon votre choix, le numéro de <strong>votre référence</strong> ou le <strong>numéro ID</strong>, sera utilisé comme <strong>numéro SKU</strong> sur la place de marché, afin de pouvoir classer le produit lors de la synchronisation des stocks et des commandes.<br/><br/>

Cette fonction est  particulièrement importante pour la gestion des marchandises, car elle permet la comparaison des inventaires entre la boutique en ligne et la place de marché.<br/><br/>

<strong>Attention!</strong> La synchronisation des quantités en stock et de leurs prix dépend de ce paramètre. Si vous avez déjà téléchargé des articles, vous ne devez <strong>plus modifier<strong> ce paramètre, dans le cas contraire, <strong>les articles précédemment</strong> enregistrés ne seraient plus synchronisés.',
            'values' => array(
                'pID' => 'Numéro ID (numéro d\'enregistrement automatique des produits dans la boutique) = SKU (Place de marché)<br>',
                'artNr' => 'référence d\'article (La référence que vous attribuez à vos produits) = SKU (place de marché)'
            ),
            'alert' => array(
                'pID' => '{#i18n:sChangeKeyAlert#}',
                'artNr' => '{#i18n:sChangeKeyAlert#}'
            ),
        ),
        'general.stats.backwards' => array(
            'label' => 'Mode de journalisation',
            'help' => 'Combien de mois doivent restituer la statistique ?',
            'values' => array(
                '0' => '1 mois',
                '1' => '2 mois',
                '2' => '3 mois',
                '3' => '4 mois',
                '4' => '5 mois',
                '5' => '6 mois',
                '6' => '7 mois',
                '7' => '8 mois',
                '8' => '9 mois',
                '9' => '10 mois',
                '10' => '11 mois',
                '11' => '12 mois',
                '12' => '13 mois',
                '13' => '14 mois',
            ),
        ),
        'general.order.information' => array(
            'label' => 'Information sur la commande',
            'valuehint' => 'Enregistrer le numéro de commande, le nom de la place de marché et le message de commande de l&apos;acheteur (si disponible) dans le commentaire client',
            'help' => 'Si vous activez cette fonction, le numéro de commande de la place de marché, le nom de la place de marché et, si transmis, le message de l&apos;acheteur, seront enregistrés dans le commentaire du client après l&apos;importation de la commande.<br/>
Cette fonction est prise en charge par la plupart des programmes de boutique en ligne. Elle dépend donc de la programmation de votre boutique en ligne. 
Ces commentaires peuvent apparaître sur la facture de sorte que le client soit informé de l’origine de ses achats. <br/> <br/>

Vous pouvez également faire programmer des extensions pour obtenir plus d\'analyses statistiques sur l\'évolution du chiffre d\'affaires.<br/> <br/>

<strong>Important</strong>: <u>Certains systèmes de gestion de marchandises</u> ne tiennent pas compte des  commandes si les commentaires clients sont intégrés. Pour plus d\'informations à ce sujet, contactez s\'il vous plaît directement votre fournisseur de service.',
        ),
        'general.editor' => array(
            'label' => 'Rédacteur en chef',
            'help' => 'Editeur pour les descriptions de produits, des modèles (Templates) et les courriers électroniques promotionnels.<br /><br />
	                <strong>TinyMCE Editeur:</strong><br />Utilisez un éditeur confortable, qui affiche les formats HTML et par exemple, corrige automatiquement les flèches d\'accès dans la description des articles.<br /><br />
	                <strong>Ajouter des champs de texte simples, et des liens locaux:</strong><br />Utilisez un champ de texte simple. Utile pour le remplissage lorsque l\'éditeur TinyMCE provoque des modifications indésirables des modèles spécifiés(comme par exemple dans le modèle de produit eBay).<br />
	                Les images ou liens, dont les adresses ne commencent pas par<strong>http://</strong>,
	                <strong>javascript:</strong>, <strong>mailto:</strong> ou <strong>#</strong>,
	                seront cependant transformées en adresse de boutique.<br /><br />
	                <strong>Les champs de textes simples, les données directes seront reprises:</strong><br />Il n\'y a aucune adresse acceptée dans laquelle des modifications de texte auront été effectuées.',
            'values' => array(
                'tinyMCE' => 'Editeur TinyMCE<br>',
                'none' => 'Possibilité d\'ajouter champ de texte ou des chemins d\'accès<br>',
                'none_none' => 'Acceptez les données directement, un simple texte. '
            ),
        ),
        'general.cronfronturl' => array(
            'label' => 'Base CRON Url',
            'help' => 'Cette URL est calculée et appelée automatiquement à partir des paramètres du système de boutique en ligne afin de synchroniser l\'inventaire, l\'importation des commandes et ... à partir des serveurs magnalister. Ce n\'est que si l\'URL actuelle ne peut pas être appelée que vous pouvez la modifier ici. Pour réinitialiser l\'URL à l\'original, videz la saisie et enregistrez la configuration.',
        ),
        'general.inventar.productstatus' => array(
            'label' => 'Statut du produit',
            'help' => 'Vous pouvez utiliser cette fonction pour déterminer, si les articles marqués "Inactifs" de votre boutique en ligne, doivent être <strong>inaccessibles</strong> sur une place de marché (eBay),
ou juste <strong>inactifs </strong>(sur les autres).<br/><br/>

Pour que cette fonctionnalité soit prise en compte, sélectionnez le module correspondant à la place de marché en cliquant sur :<br/><br/>

"synchronisation des inventaires" &rarr;  "Variation des stocks de la boutique" → 
"synchronisation automatique par CronJob".
',
            'values' => array(
                'true' => 'Si le statut du produit est inactif, le stock sera mis à 0.',
                'false' => 'Utilisez toujours le stock actuel'
            ),
        ),
        'general.manufacturer' => array(
            'label' => 'Fabricant',
            'help' => 'Choisissez l’attribut de produit qui est associé à la référence fabricant.<br/>
Vous pouvez définir les attributs de produit dans votre logiciel de e-commerce.',
        ),
        'general.manufacturerpartnumber' => array(
            'label' => 'Référence fabricant',
            'help' => 'Choisissez l’attribut de produit dans lequel la référence fabricant est sauvegardée.<br/>
Vous pouvez définir les attributs de produit dans votre logiciel de e-commerce.',
        ),
        'general.ean' => array(
            'label' => 'EAN',
            'help' => '(Numéro d’article européen) <br/> <br/>
<strong>Remarque</strong>: Attention, la véracité des données n’est pas contrôlable. Une saisie incorrecte entraînerait des erreurs de fonctionnement de la banque de données!',
        ),
        'general.upc' => array(
            'label' => 'UPC',
            'help' => 'Code universel de produit<br/><br/>
<b>Information : </b> Ces codes ne peuvent pas être vérifiés d\'une quelconque façon. Vous devez vous assurer de leurs exactitudes pour éviter d\'enregistrer des erreurs dans la banque de données.',
        ),
    ),
        )
);
