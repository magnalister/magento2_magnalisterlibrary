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

MLI18n::gi()->sModuleNameMetro = 'METRO';
/*MLI18n::gi()->sMetroNoInternationalShipping = 'Kein Versand ins Ausland';
MLI18n::gi()->sMetroSyncButtonDisableIfno = 'Diese Funktion steht Ihnen derzeit nicht zur Verfügung.';
MLI18n::gi()->sMetroDefaultValueText = 'Standard';
MLI18n::gi()->ML_METRO_N_PENDING_UPDATES_TITLE_ITEMS = 'Preis und Lagerabgleich:';
MLI18n::gi()->ML_METRO_N_PENDING_UPDATES_TITLE_PRODUCTDETAILUPDATES = 'METRO verpflichtenede Produkteigenschaften:';
MLI18n::gi()->ML_TEXT_WARNING = 'Warnung';
MLI18n::gi()->metroSalesRecordNumber = 'Verkaufsprotokollnummer';
MLI18n::gi()->ML_METRO_LABEL_NOIDENTIFIERFLAG_NO = 'Nein';
MLI18n::gi()->ML_METRO_LABEL_NOIDENTIFIERFLAG_YES = 'Ja, Sonderanfertigung ohne MPN und EAN';
MLI18n::gi()->ML_METRO_LABEL_FSK_NOINFO = 'Keine Angabe';
MLI18n::gi()->ML_METRO_LABEL_FSK_UNKNOWN = 'Unbekannt';


MLI18n::gi()->ML_METRO_LABEL_ATTRIBUTES_FOR = 'Attribute f&uuml;r';
MLI18n::gi()->ML_LABEL_METRO_PRIMARY_CATEGORY = 'Prim&auml;r-Kategorie';
MLI18n::gi()->ML_LABEL_METRO_SECONDARY_CATEGORY = 'Sekund&auml;r-Kategorie';
MLI18n::gi()->ML_LABEL_METRO_STORE_CATEGORY = 'METRO Store Kategorie';
MLI18n::gi()->ML_LABEL_METRO_ITEM_ID = 'METRO Angebots-Nr.';
MLI18n::gi()->ML_LABEL_METRO_TITLE = 'METRO Titel';
MLI18n::gi()->ML_PRICE_SHOP_PRICE_METRO = 'Preis Shop / METRO';
MLI18n::gi()->ML_STOCK_SHOP_STOCK_METRO = 'Bestand Shop / METRO';
MLI18n::gi()->ML_LAST_SYNC = 'Letzte Synchronisation';
MLI18n::gi()->ML_METRO_N_PENDING_UPDATES_ESTIMATED_TIME_M = '%s Artikel werden derzeit synchronisiert. Restdauer ca. %s Minuten.';
MLI18n::gi()->ML_LABEL_METRO_DELETION_REASON = 'Gel&ouml;scht durch';
MLI18n::gi()->ML_SYNCHRONIZATION = 'Lagerabgleich';
MLI18n::gi()->ML_DELETION_BUTTON = 'L&ouml;sch-Button';
MLI18n::gi()->ML_NOT_BY_ML = 'extern (nicht ml)';
MLI18n::gi()->ML_Metro_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r METRO vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->ML_METRO_LABEL_PREPARE = 'Vorbereiten';
MLI18n::gi()->ML_METRO_LABEL_PREPARED = 'Vorbereitete Artikel';
MLI18n::gi()->ML_METRO_BUTTON_PREPARE = 'Vorbereiten';
MLI18n::gi()->ML_METRO_BUTTON_UNPREPARE = 'Vorbereitung f&uuml;r komplette Auswahl aufheben';
MLI18n::gi()->ML_METRO_BUTTON_RESET_DESCRIPTION = 'Vorbereitung f&uuml;r Artikelbeschreibung aufheben';
MLI18n::gi()->ML_METRO_LABEL_ONLY_NOT_PREPARED = 'Nur Artikel die noch nicht vorbereitet sind';
MLI18n::gi()->ML_METRO_CATEGORY_PREPARED_NONE = 'Die Kategorie enth&auml;lt keine vorbereitete Artikel';
MLI18n::gi()->ML_METRO_CATEGORY_PREPARED_FAULTY = 'Die Kategorie enth&auml;lt einige Artikel, deren Vorbereitung gescheitert ist';
MLI18n::gi()->ML_METRO_CATEGORY_PREPARED_INCOMPLETE = 'Die Kategorie enth&auml;lt einige vorbereitete Artikel';
MLI18n::gi()->ML_METRO_CATEGORY_PREPARED_ALL = 'Die Kategorie enth&auml;lt nur vorbereitete Artikel';
MLI18n::gi()->ML_METRO_PRODUCT_MATCHED_NO = 'Das Produkt wurde noch nicht vorbereitet';
MLI18n::gi()->ML_METRO_PRODUCT_PREPARED_FAULTY = 'Die Vorbereitung des Produkts ist bisher gescheitert';
MLI18n::gi()->ML_METRO_PRODUCT_PREPARED_OK = 'Das Produkt ist korrekt vorbereitet und kann eingestellt werden';
MLI18n::gi()->ML_METRO_DURATION_SHORT = 'Laufzeit';
MLI18n::gi()->ML_METRO_LABEL_METRO_PRICE = 'METRO Preis';
MLI18n::gi()->ML_METRO_LABEL_SELECT_CATEGORY = 'Kategorie-Auswahl';
MLI18n::gi()->ML_METRO_LABEL_SHIPPING_COSTS = 'Versandkosten';
MLI18n::gi()->ML_METRO_LISTINGTYPE_STORESFIXEDPRICE = 'Festpreis (METRO Store)';
MLI18n::gi()->ML_METRO_PRODUCT_DETAILS = 'Artikeldetails';
MLI18n::gi()->ML_METRO_MAX_80_CHARS = 'Titel max. 80 Zeichen<br />Erlaubte Platzhalter:<br />#BASEPRICE# - Grundpreis';
MLI18n::gi()->ML_METRO_CAUSES_COSTS = 'kostenpflichtig';
MLI18n::gi()->ML_METRO_DESCRIPTION = 'Beschreibung';
MLI18n::gi()->ML_METRO_PRODUCTS_DESCRIPTION = 'Produktbeschreibung';
MLI18n::gi()->ML_METRO_PLACEHOLDERS = 'Verf&uuml;gbare Platzhalter';
MLI18n::gi()->ML_METRO_ITEM_NAME_TITLE = 'Produktname (Titel)';
MLI18n::gi()->ML_METRO_ARTNO = 'Artikelnummer';
MLI18n::gi()->ML_METRO_PRODUCTS_ID = 'Products-ID';
MLI18n::gi()->ML_METRO_PRICE = 'Preis';
MLI18n::gi()->ML_METRO_PRICE_FOR_METRO_SHORT = 'Preis f&uuml;r METRO';
MLI18n::gi()->ML_METRO_CALCULATED = 'berechnet';
MLI18n::gi()->ML_METRO_PRICE_CALCULATED = 'Berechneter Preis <small>(gem. Konfig)</small>';
MLI18n::gi()->ML_METRO_PRICE_FOR_METRO = 'Preis f&uuml;r METRO';
MLI18n::gi()->ML_METRO_YOUR_PRICE_IF_OTHER = 'Ihr METRO Preis<br />(falls anders)'; // deprecated 
MLI18n::gi()->ML_METRO_PRICE_CALCULATED_TOOLTIP = 'Der Preis wird je nach Konfigurations-Einstellung berechnet.';
MLI18n::gi()->ML_METRO_YOUR_FIXED_PRICE = 'Ihr METRO Preis';
MLI18n::gi()->ML_METRO_SHORTDESCRIPTION_FROM_SHOP = 'Kurzbeschreibung aus dem Shop';
MLI18n::gi()->ML_METRO_DESCRIPTION_FROM_SHOP = 'Beschreibung aus dem Shop';
MLI18n::gi()->ML_METRO_FIRST_PIC = 'erstes Produktbild';
MLI18n::gi()->ML_METRO_MORE_PICS = 'zweites Produktbild; mit #PICTURE3#, #PICTURE4# usw. k&ouml;nnen weitere Bilder &uuml;bermittelt werden, so viele wie im Shop vorhanden.';
MLI18n::gi()->ML_METRO_AUCTION_SETTINGS = 'Auktionseinstellungen';
MLI18n::gi()->ML_METRO_SITE = 'METRO-Marketplace, auf dem Sie einstellen.';
MLI18n::gi()->ML_METRO_BESTPRICE_SHORT = 'Preisvorschlag';
MLI18n::gi()->ML_METRO_START_TIME_SHORT = 'Startzeit<br />(falls vorbelegt)';
MLI18n::gi()->ML_METRO_START_TIME = 'Im Normalfall ist ein METRO-Artikel sofort nach dem Hochladen aktiv. Aber wenn Sie dieses Feld f&uuml;llen, erst ab Startzeit (kostenpflichtig).';
MLI18n::gi()->ML_METRO_PRICE_FOR_METRO_LONG = 'Preis zu dem der Artikel bei METRO eingestellt wird';
MLI18n::gi()->ML_METRO_CATEGORY = 'METRO-Kategorie';
MLI18n::gi()->ML_METRO_CATEGORY_DESC = 'Die METRO-Kategorie';
MLI18n::gi()->ML_METRO_PRIMARY_CATEGORY = 'Prim&auml;rkategorie';
MLI18n::gi()->ML_METRO_CHOOSE = 'W&auml;hlen';
MLI18n::gi()->ML_METRO_DELETE = 'L&ouml;schen';
MLI18n::gi()->ML_METRO_LABEL_METROERROR = 'METRO Fehler %s';

MLI18n::gi()->ML_METRO_ERROR_CREATE_TOKEN_LINK_HEADLINE = 'Token Link konnte nicht erzeugt werden';
MLI18n::gi()->ML_METRO_ERROR_CREATE_TOKEN_LINK_TEXT = 'Es konnte keine Verbindung zu METRO aufgebaut werden. Bitte laden Sie die Seite erneut.<br><br>
            Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';


MLI18n::gi()->ML_METRO_SUBMIT_ADD_TEXT_ZERO_STOCK_ITEMS_REMOVED = 'Artikel ohne Lagerbestand wurden ausgelassen.';
*/
/* Status-Aenderung bei Bestellungen */
MLI18n::gi()->ML_METRO_ORDER_PAID = 'magnalister-Verarbeitung:\nZahlung bei METRO eingegangen.';

MLI18n::gi()->ML_METRO_MANDATORY_FIELDS_INFO = '{#i18n:attributes_matching_mandatory_fields_info#}';

/*
 * Error Messages of prepare
 */
/*
MLI18n::gi()->ML_METRO_ERROR_MISSING_GTIN_MPN_MANUFACTURER = 'METRO demande soit un GTIN, soit le fabricant + le numéro d\'article du fabricant. Comme vous avez laissé les champs "Fabricant" et "Numéro d\'article du fabricant" vides, vous devez saisir une valeur dans le champ GTIN pour terminer la préparation du produit.';
MLI18n::gi()->ML_METRO_ERROR_MISSING_CATEGORY = 'Die Marktplatz-Kategorie ist ein Pflichtfeld und darf nicht leer sein.';
MLI18n::gi()->ML_METRO_ERROR_MISSING_TITLE = 'Der Produkttitel für METRO ist ein Pflichtfeld und darf nicht leer sein.';
MLI18n::gi()->ML_METRO_ERROR_MISSING_DESCRIPTION = 'Die Produktbeschreibung für METRO ist ein Pflichtfeld und darf nicht leer sein.';
MLI18n::gi()->ML_METRO_ERROR_MISSING_IMAGES = 'Es muss mindestens ein Bild ausgewählt und an METRO übertragen werden.';
MLI18n::gi()->ML_METRO_ERROR_WRONG_MANUFACTURERSSUGGESTEDRETAILPRICE = 'Die unverbindliche Preisempfehlung des Herstellers ist ung&uuml;ltig';
MLI18n::gi()->ML_METRO_ERROR_SHORT_DESCRIPTION_LENGTH = 'Kurze Beschreibung des Produkts mit einer Zusammenfassung der wichtigsten Produkteigenschaften. Maximal 150 Zeichen';

MLI18n::gi()->ML_METRO_STATUS_PRODUCT_IS_PENDING_DELETE = 'Angebot wird gel&ouml;scht';
MLI18n::gi()->ML_METRO_DELETED_OFFER_PURGE_INFO = 'Gel&ouml;schte Artikel werden nach 30 Tagen final aus der Datenbank und &Uuml;bersicht gel&ouml;scht.';
*/
MLI18n::gi()->{'metro_upload_explanation'} = 'Veuillez noter que cela peut prendre jusqu&apos;à une heure pour que vos articles soient visibles dans l&apos;onglet "inventaire" de magnalister.<br>Si vous rencontrez un problème avec un produit, vous trouverez de plus amples informations dans l&apos;onglet "rapport d&apos;erreurs".<br><br>En règle générale, le traitement des nouveaux produits sur METRO prend environ 2 à 3 jours ouvrables.';

MLI18n::gi()->{'metro_prepare_apply'} = 'Créer des nouveaux produits';

/** Volume Prices */
MLI18n::gi()->ML_METRO_VOLUMEPRICES_START_AT_PLACEHOLDER = 'z.B.: 10';
MLI18n::gi()->ML_METRO_PRICE_PLACEHOLDER = 'z.B.: 0.00';
MLI18n::gi()->ML_METRO_PRICE_SIGNAL_PLACEHOLDER = 'z.B.: 99';
MLI18n::gi()->{'ML_METRO_MORE_PICS'} = 'deuxième image produit; d&apos;autres images peuvent être ajoutées avec les balises #PICTURE3#, #PICTURE4# etc.';
MLI18n::gi()->{'ML_METRO_CHOOSE'} = 'Sélectionner';
MLI18n::gi()->{'ML_METRO_BUTTON_UNPREPARE'} = 'Annuler la préparation de tous les articles sélectionnés';
MLI18n::gi()->{'ML_METRO_BUTTON_RESET_DESCRIPTION'} = 'Réinitialiser la description de l&apos;article';
MLI18n::gi()->{'ML_METRO_LABEL_PREPARED'} = 'Articles préparés';
MLI18n::gi()->{'ML_METRO_LABEL_PREPARE'} = 'Préparer';
MLI18n::gi()->{'ML_METRO_BUTTON_PREPARE'} = 'Préparer';
MLI18n::gi()->{'ML_METRO_LABEL_SHIPPING_COSTS'} = 'Frais d&apos;expédition';
MLI18n::gi()->{'metroSalesRecordNumber'} = 'Référence du protocole de vente';
MLI18n::gi()->{'ML_METRO_PLACEHOLDERS'} = 'Balises disponibles';
MLI18n::gi()->{'ML_METRO_LABEL_FSK_UNKNOWN'} = 'Inconnu';
MLI18n::gi()->{'ML_METRO_ERROR_CREATE_TOKEN_LINK_HEADLINE'} = 'Le lien token n&apos;a pas pu être créé';
MLI18n::gi()->{'ML_METRO_MAX_80_CHARS'} = 'Titre de 80 caractères max<br />Balises autorisées:<br />#BASEPRICE# - Prix de base';
MLI18n::gi()->{'ML_METRO_START_TIME_SHORT'} = 'Heure de lancement<br />(si pré-rempli)';
MLI18n::gi()->{'sMetroDefaultValueText'} = 'Standard';
MLI18n::gi()->{'ML_LABEL_METRO_SECONDARY_CATEGORY'} = 'Catégorie secondaire';
MLI18n::gi()->{'ML_METRO_ITEM_NAME_TITLE'} = 'Nom du produit (titre)';
MLI18n::gi()->{'ML_METRO_PRODUCTS_DESCRIPTION'} = 'Description du produit';
MLI18n::gi()->{'ML_METRO_PRODUCTS_ID'} = 'ID du produit';
MLI18n::gi()->{'ML_LABEL_METRO_PRIMARY_CATEGORY'} = 'Catégorie principale';
MLI18n::gi()->{'ML_METRO_PRIMARY_CATEGORY'} = 'Catégorie principale';
MLI18n::gi()->{'ML_METRO_BESTPRICE_SHORT'} = 'Suggestion de prix';
MLI18n::gi()->{'ML_METRO_PRICE_FOR_METRO_LONG'} = 'Prix auquel l&apos;article est mis en vente sur METRO';
MLI18n::gi()->{'ML_METRO_N_PENDING_UPDATES_TITLE_ITEMS'} = 'Synchronisation des prix et des stocks :';
MLI18n::gi()->{'ML_PRICE_SHOP_PRICE_METRO'} = 'prix boutique/METRO';
MLI18n::gi()->{'ML_METRO_PRICE_FOR_METRO_SHORT'} = 'Prix sur METRO';
MLI18n::gi()->{'ML_METRO_PRICE_FOR_METRO'} = 'Prix sur METRO';
MLI18n::gi()->{'ML_METRO_PRICE'} = 'Prix';
MLI18n::gi()->{'ML_METRO_LABEL_ONLY_NOT_PREPARED'} = 'Uniquement les articles n&apos;ayant pas encore été préparés';
MLI18n::gi()->{'metro_prepare_apply'} = 'Créer des nouveaux produits';
MLI18n::gi()->{'ML_METRO_LABEL_NOIDENTIFIERFLAG_NO'} = 'Non';
MLI18n::gi()->{'ML_METRO_SITE'} = 'Site METRO sur lequel les produits sont publiés';
MLI18n::gi()->{'ML_METRO_CATEGORY'} = 'Catégorie METRO';
MLI18n::gi()->{'ML_METRO_N_PENDING_UPDATES_TITLE_PRODUCTDETAILUPDATES'} = 'Caractéristiques obligatoires de METRO';
MLI18n::gi()->{'ML_LABEL_METRO_TITLE'} = 'Titre METRO';
MLI18n::gi()->{'ML_LABEL_METRO_STORE_CATEGORY'} = 'Catégorie dans votre boutique METRO';
MLI18n::gi()->{'ML_METRO_LABEL_METRO_PRICE'} = 'Prix sur METRO';
MLI18n::gi()->{'ML_METRO_LABEL_METROERROR'} = 'Erreur METRO %s';
MLI18n::gi()->{'ML_LABEL_METRO_ITEM_ID'} = 'Référence METRO';
MLI18n::gi()->{'sModuleNameMetro'} = 'METRO';
MLI18n::gi()->{'ML_METRO_ORDER_PAID'} = 'Traitement magnalister:\NPaiement reçu par METRO.';
MLI18n::gi()->{'ML_METRO_DURATION_SHORT'} = 'Durée';
MLI18n::gi()->{'ML_METRO_DELETE'} = 'Supprimer';
MLI18n::gi()->{'ML_METRO_SHORTDESCRIPTION_FROM_SHOP'} = 'Description courte de votre boutique';
MLI18n::gi()->{'ML_METRO_CAUSES_COSTS'} = 'Payant';
MLI18n::gi()->{'ML_METRO_LABEL_FSK_NOINFO'} = 'Non spécifié';
MLI18n::gi()->{'sMetroNoInternationalShipping'} = 'Pas d&apos;envoi à l&apos;étranger';
MLI18n::gi()->{'ML_METRO_LABEL_SELECT_CATEGORY'} = 'Sélection de la catégorie';
MLI18n::gi()->{'ML_METRO_LABEL_NOIDENTIFIERFLAG_YES'} = 'Oui, produit personnalisé sans MPN ni EAN';
MLI18n::gi()->{'ML_METRO_START_TIME'} = 'Normalement, le produit est actif immédiatement après sa publication. Mais si vous remplissez ce champ, il ne sera actif qu&apos;à partir de l&apos;heure de lancement (option payante).';
MLI18n::gi()->{'ML_METRO_YOUR_PRICE_IF_OTHER'} = 'Votre prix METRO<br />(si différent)';
MLI18n::gi()->{'ML_METRO_YOUR_FIXED_PRICE'} = 'Votre prix METRO';
MLI18n::gi()->{'ML_LABEL_METRO_DELETION_REASON'} = 'Supprimé par';
MLI18n::gi()->{'ML_METRO_LISTINGTYPE_STORESFIXEDPRICE'} = 'Festpreis (METRO Store)';
MLI18n::gi()->{'ML_Metro_TEXT_NO_MATCHED_PRODUCTS'} = 'Es sind noch keine Produkte f&uuml;r METRO vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->{'ML_METRO_ERROR_MISSING_IMAGES'} = 'Es muss mindestens ein Bild ausgewählt und an METRO übertragen werden.';
MLI18n::gi()->{'ML_METRO_ERROR_CREATE_TOKEN_LINK_TEXT'} = 'Es konnte keine Verbindung zu METRO aufgebaut werden. Bitte laden Sie die Seite erneut.<br><br>
            Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';
MLI18n::gi()->{'ML_METRO_FIRST_PIC'} = 'erstes Produktbild';
MLI18n::gi()->{'sMetroSyncButtonDisableIfno'} = 'Cette option n&apos;est pas disponible actuellement.';
MLI18n::gi()->{'ML_METRO_PRODUCT_PREPARED_FAULTY'} = 'La préparation du produit a échoué pour le moment.';
MLI18n::gi()->{'ML_METRO_ERROR_MISSING_DESCRIPTION'} = 'La description du produit pour METRO est un champ obligatoire et ne peut être laissé vide.';
MLI18n::gi()->{'ML_METRO_CATEGORY_DESC'} = 'Catégorie METRO';
MLI18n::gi()->{'ML_METRO_ERROR_MISSING_CATEGORY'} = 'La catégorie de la place de marché est un champ obligatoire et ne doit pas être laissée vide.';
MLI18n::gi()->{'ML_METRO_CATEGORY_PREPARED_ALL'} = 'Il y a que des produits d&apos;ores et déjà préparés pour cette catégorie';
MLI18n::gi()->{'ML_METRO_CATEGORY_PREPARED_NONE'} = 'Il n&apos;y a pas de prouits préparés pour cette catégorie';
MLI18n::gi()->{'ML_METRO_CATEGORY_PREPARED_INCOMPLETE'} = 'Il n&apos;y a pas de prouits préparés pour cette catégorie';
MLI18n::gi()->{'ML_METRO_CATEGORY_PREPARED_FAULTY'} = 'Cette catégorie contient des articles dont la préparation a échouée';
MLI18n::gi()->{'ML_METRO_ERROR_MISSING_TITLE'} = 'Le titre du produit pour METRO est un champ obligatoire et ne doit pas être vide.';
MLI18n::gi()->{'ML_METRO_PRICE_CALCULATED_TOOLTIP'} = 'Le prix est calculé en fonction des paramètres de configuration.';
MLI18n::gi()->{'ML_METRO_PRODUCT_MATCHED_NO'} = 'Le produit n&apos;a pas encore été préparé';
MLI18n::gi()->{'ML_METRO_PRODUCT_PREPARED_OK'} = 'Le produit est correctement préparé et peut être publié';
MLI18n::gi()->{'ML_METRO_ERROR_MISSING_GTIN'} = 'Le champ GTIN est un champ obligatoire et ne doit pas être vide.';
MLI18n::gi()->{'metro_upload_explanation'} = 'Veuillez noter que cela peut prendre jusqu&apos;à une heure pour que vos articles soient visibles dans l&apos;onglet "inventaire" de magnalister.<br>Si vous rencontrez un problème avec un produit, vous trouverez de plus amples informations dans l&apos;onglet "rapport d&apos;erreurs".<br><br>En règle générale, le traitement des nouveaux produits sur METRO prend environ 2 à 3 jours ouvrables.';
MLI18n::gi()->{'ML_STOCK_SHOP_STOCK_METRO'} = 'Stock boutique / METRO';
MLI18n::gi()->{'ML_METRO_DESCRIPTION_FROM_SHOP'} = 'Description de votre site';
MLI18n::gi()->{'ML_METRO_DESCRIPTION'} = 'Description';
MLI18n::gi()->{'ML_METRO_PRICE_CALCULATED'} = 'Prix calculé <small>(selon la configuration)</small>';
MLI18n::gi()->{'ML_METRO_CALCULATED'} = 'Calculé';
MLI18n::gi()->{'ML_METRO_AUCTION_SETTINGS'} = 'Paramètres des enchères';
MLI18n::gi()->{'ML_METRO_LABEL_ATTRIBUTES_FOR'} = 'Attributs pour';
MLI18n::gi()->{'ML_METRO_ARTNO'} = 'Référence d&apos;article';
MLI18n::gi()->{'ML_METRO_PRODUCT_DETAILS'} = 'Détails de l&apos;article';
MLI18n::gi()->{'ML_METRO_SUBMIT_ADD_TEXT_ZERO_STOCK_ITEMS_REMOVED'} = 'Les articles sans stock ont été ignorés.';
MLI18n::gi()->{'ML_METRO_MANDATORY_FIELDS_INFO'} = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->{'ML_METRO_N_PENDING_UPDATES_ESTIMATED_TIME_M'} = '%s Articles en cours de synchronisation. Durée restante env. %s minutes.';
MLI18n::gi()->{'ML_METRO_ERROR_WRONG_MANUFACTURERSSUGGESTEDRETAILPRICE'} = 'Le prix de vente recommandé par le fabricant n&apos;est pas valable.';
MLI18n::gi()->{'ML_METRO_ERROR_SHORT_DESCRIPTION_LENGTH'} = 'Brève description du produit avec un résumé des principales caractéristiques du produit. 150 caractères maximum';
MLI18n::gi()->{'ML_METRO_STATUS_PRODUCT_IS_PENDING_DELETE'} = 'Demande de suppression de l&apos;annonce en cours';
MLI18n::gi()->{'ML_METRO_DELETED_OFFER_PURGE_INFO'} = 'Les articles supprimés sont définitivement supprimés de la base de données et de l&apos;aperçu après 30 jours.';
