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

MLI18n::gi()->sDateFormat = 'd.m.Y';
MLI18n::gi()->sDateTimeFormat = 'd.m.Y H:i:s';

MLI18n::gi()->ML_HEADLINE_MAIN = 'magnalister';
MLI18n::gi()->ML_ERROR_API = 'Beim magnalister-Service-Layer ist ein Fehler aufgetreten. Die Anfrage konnte nicht erfolgreich verarbeitet werden.';


// old stuff
/**
 * Deutsche Sprachdatei
 */
/* Headlines */
MLI18n::gi()->ML_HEADLINE_WELCOME = 'Willkommen';
MLI18n::gi()->ML_HEADLINE_UPDATE = 'Wichtiges Update';
MLI18n::gi()->ML_HEADLINE_MORE_MODULES = 'Weitere Anbindungen an Marketplaces&hellip;';
MLI18n::gi()->ML_HEADLINE_NOT_YET_BOOKED = 'Anbindung noch nicht aktiviert.';
MLI18n::gi()->ML_HEADLINE_STATS = 'Statistiken';
MLI18n::gi()->ML_HEADLINE_SUBMIT_PRODUCTS = '&Uuml;bermittlung der Daten';
MLI18n::gi()->ML_HEADLINE_NEWS = 'News';

MLI18n::gi()->ML_LABEL_CATEGORY_TOP = 'Top';
MLI18n::gi()->ML_LABEL_CHOICE = 'Auswahl';
MLI18n::gi()->ML_LABEL_CHOOSE = 'Ausw&auml;hlen';
MLI18n::gi()->ML_LABEL_TITLE = 'Titel';
MLI18n::gi()->ML_LABEL_SHOP_TITLE = 'Shop Titel';
MLI18n::gi()->ML_LABEL_SELECT_ALL_PRODUCTS = 'Alle Produkte hinzuf&uuml;gen';
MLI18n::gi()->ML_LABEL_SELECT_ALL_PRODUCTS_OF_CATEGORY = 'Alle Produkte dieser Kategorie hinzuf&uuml;gen';
MLI18n::gi()->ML_LABEL_DESELECT_ALL_PRODUCTS = 'Alle Produkte entfernen';
MLI18n::gi()->ML_LABEL_DESELECT_ALL_PRODUCTS_OF_CATEGORY = 'Alle Produkte dieser Kategorie entfernen';
MLI18n::gi()->ML_LABEL_SELECT_PRODUCT = 'Produkt hinzuf&uuml;gen';
MLI18n::gi()->ML_LABEL_DESELECT_PRODUCT = 'Produkt entfernen';
MLI18n::gi()->ML_LABEL_NO_PRODUCTS_SELECTABLE = 'Keine Produkte ausw&auml;hlbar';
MLI18n::gi()->ML_LABEL_SORT_ASCENDING = 'Sortiere aufsteigend';
MLI18n::gi()->ML_LABEL_SORT_DESCENDING = 'Sortiere absteigend';
MLI18n::gi()->ML_LABEL_CATEGORIES_PRODUCTS = 'Kategorien / Artikel';
MLI18n::gi()->ML_LABEL_SHOP_PRICE = 'Shop-Preis';
MLI18n::gi()->ML_LABEL_DATA_PREPARED = 'Daten vorbereitet';
MLI18n::gi()->ML_LABEL_SHOP_PRICE_NETTO = 'Shop-Preis (Netto)';
MLI18n::gi()->ML_LABEL_SHOP_PRICE_BRUTTO = 'Shop-Preis (Brutto)';
MLI18n::gi()->ML_LABEL_BRUTTO = 'Brutto';
MLI18n::gi()->ML_LABEL_NETTO = 'Netto';
MLI18n::gi()->ML_LABEL_CATEGORY = 'Kategorie';
MLI18n::gi()->ML_LABEL_PRODUCT = 'Produkt';
MLI18n::gi()->ML_LABEL_EMPTY = 'Leer';
MLI18n::gi()->ML_LABEL_ACTION = 'Aktion';
MLI18n::gi()->ML_LABEL_ACTIONS = 'Aktionen';
MLI18n::gi()->ML_LABEL_INFO = 'Info';
MLI18n::gi()->ML_LABEL_CATEGORY_PATH = 'Kategoriepfad';
MLI18n::gi()->ML_LABEL_PRODUCT_NAME = 'Produktname';
MLI18n::gi()->ML_LABEL_PRODUCTS_ID = 'ProduktID';
MLI18n::gi()->ML_LABEL_LABEL = 'Bezeichnung'; //haha
MLI18n::gi()->ML_LABEL_EDIT = 'Bearbeiten';
MLI18n::gi()->ML_LABEL_AMOUNT_SELECTED_PRODUCTS = 'Anzahl gew&auml;hlter Produkte:';
MLI18n::gi()->ML_LABEL_AMOUNT_PRODUCTS = 'Anzahl Produkte';
MLI18n::gi()->ML_LABEL_TEMPLATE = 'Vorauswahl';
MLI18n::gi()->ML_LABEL_TEMPLATE_X_SAVED = 'Die Vorauswahl %s wurde gespeichert.';
MLI18n::gi()->ML_LABEL_TEMPLATE_EXISTS = 'Diese Vorauswahl existiert bereits. Bitte geben Sie einen anderen Namen an.';
MLI18n::gi()->ML_LABEL_TITLE_FOR_TEMPLATE = 'Bitte geben Sie einen Namen f&uuml;r die Vorauswahl an.';
MLI18n::gi()->ML_LABEL_TEMPLATE_X_OVERWRITTEN = 'Die Vorauswahl %s wurde &uuml;berschrieben.';
MLI18n::gi()->ML_LABEL_TITLE_MAY_NOT_BE_EMPTY = 'Der Titel darf nicht leer bleiben. Bitte geben Sie einen g&uuml;ltigen Titel ein.';
MLI18n::gi()->ML_LABEL_CANT_SAVE_TEMPLATE_BC_NO_PROD = 'Vorauswahl kann nicht gespeichert werden, da mindestens immer ein Produkt in einer Vorlage enthalten sein muss.';
MLI18n::gi()->ML_LABEL_OVERWRITE_OLD_TEMPLATE = 'Alte Vorauswahl &uuml;berschreiben:';
MLI18n::gi()->ML_LABEL_TEMPLATE_TITLE = 'Vorauswahl-Titel:';
MLI18n::gi()->ML_LABEL_TEMPLATE_SAVE_AS_NEW = 'Als neue Vorauswahl speichern:';
MLI18n::gi()->ML_LABEL_NO_TEMPLATES_YET = 'Noch keine Vorauswahl vorhanden.';
MLI18n::gi()->ML_LABEL_USE_TEMPLATE = 'Vorauswahl verwenden';
MLI18n::gi()->ML_LABEL_QUANTITY = 'Anzahl';
MLI18n::gi()->ML_LABEL_QUANTITY_AVAILABLE = 'Verf&uuml;gbare Anzahl';
MLI18n::gi()->ML_LABEL_NEW_QUANTITY = 'Neue Anzahl';
MLI18n::gi()->ML_LABEL_OLD_QUANTITY = 'Alte Anzahl';
MLI18n::gi()->ML_LABEL_ATTENTION = 'Achtung';
MLI18n::gi()->ML_LABEL_LISTINGS_USED_THIS_MONTH = 'Verbrauchte Uploads/Imports diesen Monat';
MLI18n::gi()->ML_LABEL_LISTINGS_UPGRADE_HEADLINE = 'Upgrade?';
MLI18n::gi()->ML_LABEL_RATE = 'Tarif';
MLI18n::gi()->ML_LABEL_NOTE = 'Hinweis';
MLI18n::gi()->ML_LABEL_UNKNOWN = 'unbekannt';
MLI18n::gi()->ML_LABEL_CURRENT_PAGE = 'Aktuelle Seite';
MLI18n::gi()->ML_LABEL_PAGE = 'Seite';
MLI18n::gi()->ML_LABEL_INFORMATION = 'Information';
MLI18n::gi()->ML_LABEL_SAVED = 'gespeichert';
MLI18n::gi()->ML_LABEL_INFOS = 'Infos';
MLI18n::gi()->ML_LABEL_SEARCH = 'Suche';
MLI18n::gi()->ML_LABEL_PRODUCTS = 'Produkte';
MLI18n::gi()->ML_LABEL_SAVED_SUCCESSFULLY = 'Erfolgreich gespeichert';
MLI18n::gi()->ML_LABEL_COPYLEFT = 'Copyright &copy; 2010 - '.date('Y').' RedGecko GmbH. Alle Rechte vorbehalten.';
MLI18n::gi()->ML_LABEL_SOLD_OUT = 'ausverkauft';
MLI18n::gi()->ML_LABEL_ARTICLE_NUMBER = 'Artikelnummer';
MLI18n::gi()->ML_LABEL_DETAILS = 'Details';
MLI18n::gi()->ML_LABEL_DETAILS_FOR = 'Details f&uuml;r';
MLI18n::gi()->ML_LABEL_PRODUCTS_IMAGES = 'Produktbilder';
MLI18n::gi()->ML_LABEL_PAYMENT_METHOD = 'Zahlungsweise';
MLI18n::gi()->ML_LABEL_ACCOUNTING_OWNER = 'Kontoinhaber';
MLI18n::gi()->ML_LABEL_ACCOUNTING_NUMBER = 'Kontonummer';
MLI18n::gi()->ML_LABEL_ACCOUNTING_BLZ = 'Bankleitzahl';
MLI18n::gi()->ML_LABEL_ACCOUNTING_NAME = 'Keditinstitut';
MLI18n::gi()->ML_LABEL_ORDER_TOTAL_COD_FEE = 'Nachnahmegeb&uuml;hr'; /* nur fuer osC */
MLI18n::gi()->ML_LABEL_ORDER_TOTAL_COUPON = 'Coupon';    /* nur fuer osC */
MLI18n::gi()->ML_LABEL_ORDER_TOTAL_DISCOUNT = 'Discount';   /* nur fuer osC */
MLI18n::gi()->ML_LABEL_ORDER_TOTAL_COUNTRY_CHARGE = 'L&auml;nderzuschlag'; /* gibbet nich als ot_modul */
MLI18n::gi()->ML_LABEL_IN_QUEUE = 'in Warteschlange';
MLI18n::gi()->ML_LABEL_REFRESH = 'Werte aus Konfig &uuml;bernehmen';
MLI18n::gi()->ML_LABEL_STEP = 'Schritt';
MLI18n::gi()->ML_LABEL_ALL = 'Alle';
MLI18n::gi()->ML_LABEL_NO_DATA = 'Keine Daten';
MLI18n::gi()->ML_LABEL_ART_NR = 'Artikelnummer';
MLI18n::gi()->ML_LABEL_ART_NR_SHORT = 'Art.-Nr.';
MLI18n::gi()->ML_LABEL_OLD = 'Alt';
MLI18n::gi()->ML_LABEL_NEW = 'Neu';
MLI18n::gi()->ML_LABEL_INVALID = 'ung&uuml;ltig';
MLI18n::gi()->ML_LABEL_NO_SEARCH_RESULTS = 'Keine Suchergebnisse';
MLI18n::gi()->ML_LABEL_PRODUCTS_WITH_INVALID_MODELNR = 'Produkte mit fehlenden oder doppelten Artikelnummern';
MLI18n::gi()->ML_LABEL_NOT_SET = 'nicht vergeben';
MLI18n::gi()->ML_LABEL_PRODUCT_ID = 'Produkt ID';
MLI18n::gi()->ML_LABEL_TAB_IDENT = 'Tab-Bezeichnung (optional)';
MLI18n::gi()->ML_LABEL_SKU = 'SKU';
MLI18n::gi()->ML_LABEL_EAN = 'EAN';
MLI18n::gi()->ML_LABEL_UPC = 'UPC';
MLI18n::gi()->ML_LABEL_BRAND = 'Marke';
MLI18n::gi()->ML_LABEL_SUBCATEGORY = 'Unterkategorie';
MLI18n::gi()->ML_LABEL_MAINCATEGORY = 'Hauptkategorie';
MLI18n::gi()->ML_LABEL_TRACKINGCODE = 'Trackingcode';
MLI18n::gi()->ML_LABEL_CARRIER = 'Spediteur';
MLI18n::gi()->ML_LABEL_CARRIER_NONE = 'kein Spediteur angeben';
MLI18n::gi()->ML_LABEL_ORDER_ID = 'Bestellnummer';
MLI18n::gi()->ML_LABEL_SHIPPING_DATE = 'Versanddatum';
MLI18n::gi()->ML_LABEL_ESTIMATED_ARRIVAL_DATE = 'Gesch&auml;tztes Ankunftsdatum';
MLI18n::gi()->ML_LABEL_DONT_USE = 'Nicht verwenden';
MLI18n::gi()->ML_LABEL_SELECT_TABLE_FIRST = 'Bitte erst Tabelle w&auml;hlen';
MLI18n::gi()->ML_LABEL_HISTORY = 'Historie';
MLI18n::gi()->ML_LABEL_PROMISE_DATE = 'Versand bis';
MLI18n::gi()->ML_LABEL_ORDER_CANCELLED = 'Bestellung storniert am';
MLI18n::gi()->ML_LABEL_SELECTED_CATEGORIES = 'Gew&auml;hlte Kategorien';
MLI18n::gi()->ML_LABEL_MATCH_CATEGORIES = 'Kategorien matchen';
MLI18n::gi()->ML_LABEL_USE_STANDARD = 'Standard verwenden';
MLI18n::gi()->ML_LABEL_TAX_STANDARD = 'Standard';
MLI18n::gi()->ML_LABEL_TAX_REDUCED = 'Erm&auml;&szlig;igt';
MLI18n::gi()->ML_LABEL_TAX_FREE = 'Steuerfrei';
MLI18n::gi()->ML_LABEL_UPDATE = 'Update durchf&uuml;hren';
MLI18n::gi()->ML_LABEL_IMPORT_ORDERS = 'Bestellungen importieren';
MLI18n::gi()->ML_LABEL_SYNC_INVENTORY = 'Preis und Lager synchronisieren';
MLI18n::gi()->ML_LABEL_SYNC_INVENTORY_LOG = 'Protokoll-Start: Inventar-Abgleich Shop > Marketplace';
MLI18n::gi()->ML_LABEL_SYNC_CONTINUE_MODE = ' im Continue-Modus';
MLI18n::gi()->ML_LABEL_SYNC_ORDERSTATUS = 'Bestellstatus synchronisieren';
MLI18n::gi()->ML_LABEL_WEBSHOP_ORDERSTATUS = 'Webshop-Bestellstatus';
MLI18n::gi()->ML_LABEL_LISTINGSBASED = 'Courtage';
MLI18n::gi()->ML_LABEL_PARENT = 'Elternartikel';
MLI18n::gi()->ML_LABEL_MARKETPLACE_ORDER_ID = 'Marketplace Bestellnummer';
MLI18n::gi()->ML_LABEL_MARKETPLACE_PAYMENT_METHOD = 'Zahlart';
MLI18n::gi()->ML_LABEL_MARKETPLACE_SHIPPING_METHOD = 'Versandart';
MLI18n::gi()->ML_LABEL_MARKETPLACE_SHIPPING_TIME = 'Zeit bis Versand';
MLI18n::gi()->ML_LABEL_MARKETPLACE_SHIPPING_TIME_VALUE = 'In den n&auml;chsten %s Tagen';
MLI18n::gi()->ML_LABEL_SKU_NOT_IN_SHOP = 'Ein Artikel mit dieser SKU ist nicht (mehr) im Shop zu finden';
MLI18n::gi()->ML_LABEL_GENERIC_SETTINGS = 'Allgemeine Einstellungen';
MLI18n::gi()->ML_LABEL_DO_NOT_CHANGE = 'Nicht &auml;ndern';
MLI18n::gi()->ML_LABEL_SHIPPING_TIME_SHOP = 'Lieferzeit Shop';
MLI18n::gi()->ML_LABEL_INCL = 'inkl.';
MLI18n::gi()->ML_LABEL_MISSING_DATA = 'Fehlende Daten';
MLI18n::gi()->ML_LABEL_UNCHECK_SELECTION = 'Auswahl aufheben';
MLI18n::gi()->ML_LABEL_CUSTOMERSID = 'Kunden ID'; 
MLI18n::gi()->ML_LABEL_SHOP_TITLE = 'Shop Titel';

MLI18n::gi()->ML_OPTION_EMPTY = 'Keine Angabe';
MLI18n::gi()->ML_OPTION_DELETED_ARTICLES_ENUM_DEFAULT = 'Zeige alle';
MLI18n::gi()->ML_OPTION_DELETED_ARTICLES_ENUM_ = 'Zeige nicht auf %s vorhandene';
MLI18n::gi()->ML_OPTION_DELETED_ARTICLES_ENUM_EMPTY = 'Zeige auf %s vorhandene';
MLI18n::gi()->ML_OPTION_DELETED_ARTICLES_ENUM_SYNC = 'Beendete: durch Lagersync.';
MLI18n::gi()->ML_OPTION_DELETED_ARTICLES_ENUM_BUTTON = 'Beendete: durch man. L&ouml;schen';
MLI18n::gi()->ML_OPTION_DELETED_ARTICLES_ENUM_EXPIRED = 'Beendete: durch Laufzeitende';

/* Statistics Labels */
MLI18n::gi()->ML_LABEL_STATS_ORDERS_PER_MARKETPLACE_PERCENT = 'Bestellungen pro Marketplace (Prozentual)';
MLI18n::gi()->ML_LABEL_STATS_PERCENT_OF_ORDERS = '% der Bestellungen';
MLI18n::gi()->ML_LABEL_STATS_ORDERS_PER_MARKETPLACE = 'Bestellungen pro Marketplace';
MLI18n::gi()->ML_LABEL_STATS_ORDERS = 'Bestellungen';
MLI18n::gi()->ML_LABEL_DELIVERY_METHOD = 'Versandmethode';


/* Fi Button Labels */
MLI18n::gi()->ML_BUTTON_LABEL_OK = 'OK';
MLI18n::gi()->ML_BUTTON_LABEL_CLOSE =  'schließen';
MLI18n::gi()->ML_BUTTON_LABEL_ACCEPT = 'Akzeptieren';
MLI18n::gi()->ML_BUTTON_LABEL_ACCEPT_COSTS = 'Kostenpflichtig Akzeptieren';
MLI18n::gi()->ML_BUTTON_LABEL_CANCEL = 'Stornieren';
MLI18n::gi()->ML_BUTTON_LABEL_ABORT = 'Abbrechen';
MLI18n::gi()->ML_BUTTON_LABEL_GO = 'Los';
MLI18n::gi()->ML_BUTTON_LABEL_BACK = 'Zur&uuml;ck';
MLI18n::gi()->ML_BUTTON_LABEL_SAVE_DATA = 'Daten speichern';
MLI18n::gi()->ML_BUTTON_LABEL_SAVE_AND_NEXT = 'Speichern und weiter';
MLI18n::gi()->ML_BUTTON_LABEL_RESET = 'Zur&uuml;cksetzen';
MLI18n::gi()->ML_BUTTON_LABEL_SUMMARY = 'Auswahl hochladen: Zusammenfassung';
MLI18n::gi()->ML_BUTTON_LABEL_DELETE = 'L&ouml;schen';
MLI18n::gi()->ML_BUTTON_LABEL_DELETE_ENTIRE_PROTOCOL = 'Gesamtes Protokoll l&ouml;schen';
MLI18n::gi()->sMarketplace_BUTTON_LABEL_DELETE_COMPLETE_LOG = 'Gesamtes Log löschen';
MLI18n::gi()->ML_BUTTON_LABEL_REFRESH = 'Aktualisieren';
MLI18n::gi()->ML_BUTTON_LABEL_BACK_TO_TEMPLATEADMIN = 'Zur&uuml;ck zur Vorlagenverwaltung';
MLI18n::gi()->ML_BUTTON_LABEL_BACK_TO_CHECKIN = 'Zur&uuml;ck';
MLI18n::gi()->ML_BUTTON_LABEL_ADMINISTRATE_TEMPLATES = 'Vorlagen verwalten';
MLI18n::gi()->ML_BUTTON_LABEL_CHECKIN_ADD = 'Artikel jetzt hochladen / &auml;ndern';
MLI18n::gi()->ML_BUTTON_LABEL_CHECKIN_PURGE = 'Inventar vollst&auml;ndig ersetzen';
MLI18n::gi()->ML_BUTTON_LABEL_RETRY = 'Einstellen erneut versuchen';
MLI18n::gi()->ML_BUTTON_LABEL_YES = 'Ja';
MLI18n::gi()->ML_BUTTON_LABEL_NO = 'Nein';
MLI18n::gi()->ML_BUTTON_RESTORE_DEFAULTS = 'Standard wiederherstellen';
MLI18n::gi()->ML_BUTTON_RELOAD_INVENTORY = 'Inventaransicht aktualisieren';
MLI18n::gi()->ML_BUTTON_REFRESH_STOCK = 'Lageranzahl f&uuml;r alle aktualisieren';
MLI18n::gi()->ML_BUTTON_LABEL_EXPERTVIEW = 'Experteneinstellungen';
MLI18n::gi()->ML_BUTTON_LABEL_REVERT = 'Vorbereitung aufheben';

MLI18n::gi()->ML_HINT_NO_PRODUCTS_SELECTED = 'Sie m&uuml;ssen mindestens ein Produkt ausw&auml;hlen bevor Sie diese Aktion durchf&uuml;hren k&ouml;nnen.';
MLI18n::gi()->ML_HINT_HEADLINE_EXCEEDING_INCLUSIVE_LISTINGS = '&Uuml;berschreitung der Uploads/Imports';
MLI18n::gi()->ML_HINT_HEADLINE_CONFIRM_PURGE = 'Inventar vollst&auml;ndig ersetzen?';

/* Texts */
MLI18n::gi()->ML_TEXT_MAKE_YOUR_CHOISE = 'Bitte w&auml;hlen Sie oben Ihren Marketplace aus.';
MLI18n::gi()->ML_TEXT_PLEASE_WAIT = 'Bitte warten&hellip;';
MLI18n::gi()->ML_TEXT_FILLOUT_CONFIG_FORM = 'Bitte f&uuml;llen Sie alle Felder aus.';

MLI18n::gi()->ML_TEXT_NEW_VERSION = 'Eine neue Version ({#version#}) des magnalisters ist verf&uuml;gbar.
            Um den magnalister zu aktualisieren, klicken Sie bitte <a onclick="(function($) {$(\'#globalButtonBox .update\').trigger(\'click\');})(jqml);">hier</a>.<br/>
            <b>Wichtig:</b> Erstellen Sie zuvor ein Backup Ihres Shops (Dateien und Datenbank).
            Selbst gemachte &Auml;nderungen am magnalister gehen durch das Update verloren.
            Anpassungen durch Hook-Points gehen nicht verloren und sind update-sicher.';
MLI18n::gi()->ML_TEXT_NEW_VERSION_SAFE_MODE = 'Eine neue Version ({#version#}) des magnalisters ist verf&uuml;gbar.<br/><br/>
            {#i18n:ML_TEXT_GENERIC_SAFE_MODE#}<br/><br/>
            <b>Wichtig:</b> Erstellen Sie zuvor ein Backup Ihres Shops (Dateien und Datenbank).
            Selbst gemachte &Auml;nderungen am magnalister gehen durch das Update verloren.
            Anpassungen durch Hook-Points gehen nicht verloren und sind update-sicher.';
MLI18n::gi()->ML_TEXT_IMPORTANT_UPDATE = 'Eine neue Version ({#version#}) des magnalisters ist verf&uuml;gbar.
            Diese ist nicht abw&auml;rtskompatibel zum vorherigen System. Daher ist ein
            Update auf die neuste Version zwingend notwendig! Um den magnalister zu aktualisieren
            klicken Sie bitte <a onclick="(function($) {$(\'#globalButtonBox .update\').trigger(\'click\');})(jqml);">hier</a>.<br/>
            <b>Wichtig:</b> Erstellen Sie zuvor ein Backup Ihres Shops (Dateien und Datenbank).
            Selbst gemachte &Auml;nderungen am magnalister gehen durch das Update verloren.
            Anpassungen durch Hook-Points gehen nicht verloren und sind update-sicher.';
MLI18n::gi()->ML_TEXT_IMPORTANT_UPDATE_SAFE_MODE = 'Eine neue Version des magnalisters ({#version#}) ist verf&uuml;gbar.
            Diese ist nicht abw&auml;rtskompatibel zum vorherigen System. Daher ist ein
            Update auf die neuste Version zwingend notwendig!<br/><br/>
            {#i18n:ML_TEXT_GENERIC_SAFE_MODE#}<br/><br/>
            <b>Wichtig:</b> Erstellen Sie zuvor ein Backup Ihres Shops (Dateien und Datenbank).
            Selbst gemachte &Auml;nderungen am magnalister gehen durch das Update verloren.
            Anpassungen durch Hook-Points gehen nicht verloren und sind update-sicher.';
MLI18n::gi()->ML_TEXT_UPDATE_SHOP_CHANGES = 'Bei diesem Update sind &Auml;nderungen an den Original-Quelltexten Ihres Shops n&ouml;tig.<br /><br />
            Bitte laden Sie die <a target="_blank" class="ml-js-noBlockUi" href="{#setting:sPublicUrl#}frontend/download.php" title="aktuelle Version">aktuelle Version</a>
            des magnalisters herunter und lesen Sie die Upgrade-Anleitung.<br /><br />
            Alternativ k&ouml;nnen Sie auch unser Fachteam mit dem Upgrade beauftragen:<br />
            Loggen Sie sich hierzu einfach unter 
            <a href="{#setting:sPublicUrl#}frontend/login.php" title="Kunden Login" class="ml-js-noBlockUi" target=_blank">{#setting:sPublicUrl#}login</a> ein,
            und &uuml;bermitteln &uuml;ber den Men&uuml;punkt "Installation" den Upgrade-Auftrag.<br />
            F&uuml;r weitere Fragen steht Ihnen unser Support zur Verf&uuml;gung:
            <a href="{#setting:sPublicUrl#}support" title="Support" class="ml-js-noBlockUi" target="_blank">{#setting:sPublicUrl#}support</a>.';
MLI18n::gi()->ML_TEXT_LISTING_EXCEEDED = '&nbsp;Sie haben Ihre monatlichen Uploads/Imports um %s &uuml;berschritten.<br/>
            Sie k&ouml;nnen einfach ein <a target="_blank" class="ml-js-noBlockUi" href="{#setting:sPublicUrl#}frontend/login.php/rateupgrade:%d" title="Tarif-Upgrade">Tarif-Upgrade</a>
            r&uuml;ckwirkend zum Monatsanfang vornehmen und haben damit volle Kostenkontrolle.';
MLI18n::gi()->ML_TEXT_LISTING_ALMOST_EMPTY = '
            &nbsp;Sie haben nur noch %s%% Ihrer monatlichen Uploads/Imports &uuml;brig.<br/>
            Sie k&ouml;nnen einfach ein <a target="_blank" class="ml-js-noBlockUi" href="{#setting:sPublicUrl#}frontend/login.php/rateupgrade:%d" title="Tarif-Upgrade">Tarif-Upgrade</a>
            r&uuml;ckwirkend zum Monatsanfang vornehmen und haben damit volle Kostenkontrolle.';
MLI18n::gi()->ML_TEXT_LISTING_GOING_TO_EXCEED = '
            <p>&nbsp;Sie sind dabei Ihre Uploads/Imports um %d zu &uuml;berschreiten. Bei einer &Uuml;berschreitung der Uploads/Imports
            werden zus&auml;tzliche Geb&uuml;hren f&auml;llig. Die zus&auml;tzlichen Geb&uuml;hren k&ouml;nnen Sie 
            <a target="_blank" class="ml-js-noBlockUi" href="{#setting:sPublicUrl#}frontend/rate.php" title="Preis&uuml;bersicht">hier</a> entnehmen.</p>
            <p>Sie k&ouml;nnen einfach ein <a target="_blank" class="ml-js-noBlockUi" href="{#setting:sPublicUrl#}frontend/login.php/rateupgrade:%d" title="Tarif-Upgrade">Tarif-Upgrade</a>
            r&uuml;ckwirkend zum Monatsanfang vornehmen und haben damit volle Kostenkontrolle.</p>';
MLI18n::gi()->ML_TEXT_CURRENT_MODULE_NOT_BOOKED = 'Zur Aktivierung von <b>%s</b> loggen Sie sich unter 
        <a href="{#setting:sPublicUrl#}frontend/login.php" title="Kunden Login" target=_blank" class="ml-js-noBlockUi">{#setting:sPublicUrl#}login</a> ein, 
        w&auml;hlen "Meine Shops" und beantragen &uuml;ber den "Bearbeiten-Button" weitere Marketplaces.';
MLI18n::gi()->ML_TEXT_MORE_MODULES = '<p>Sie haben keine weiteren Anbindungen gebucht, 
            oder es sind keine weiteren Marketplaces zur Anbindung vorhanden.</p>
            <p>Zur Buchung weiterer Anbindungen loggen Sie sich unter 
            <a href="{#setting:sPublicUrl#}frontend/login.php" title="Kunden Login" class="ml-js-noBlockUi" target=_blank">{#setting:sPublicUrl#}login</a> ein, 
            w&auml;hlen "Meine Shops" und beantragen &uuml;ber den "Bearbeiten-Button" weitere Marketplaces.</p>
            <p>Sollten Sie eine Anbindung w&uuml;nschen, die wir noch nicht im Programm haben, senden Sie uns bitte eine Nachricht &ndash; 
            wir sind f&uuml;r Ihre Anregungen und Vorschl&auml;ge dankbar:<br />
            <a href="{#setting:sPublicUrl#}support" title="Support" class="ml-js-noBlockUi" target="_blank">{#setting:sPublicUrl#}support</a></p>';
MLI18n::gi()->ML_TEXT_CONFIG_SAVED_SUCCESSFULLY = 'Die Konfiguration wurde erfolgreich gespeichert. Bitte wählen Sie nun für die weitere Einrichtung links einen Marktplatz aus.';
MLI18n::gi()->ML_TEXT_CONFIG_SAVED_SEMI_SUCCESSFULLY = 'Einige &Auml;nderungen konnten nicht gespeichert werden, da diese fehlerhaft sind.
            Bitte korrigieren Sie alle Werte, die auf der linken Seite rot hervorgehobene Fehlerbeschreibungen haben.<br />
            Die alten Werte wurden an diesen Stellen wiederhergestellt.';
MLI18n::gi()->ML_TEXT_TEMPLATE_INFO = 'In den Vorauswahlen speichern Sie eine Auswahl an Produkten mit verschiedenen Werten, die nachtr&auml;glich vor dem Einstellprozess 
            teilweise &auml;nderbar sind.';
MLI18n::gi()->ML_TEXT_CONFIRM_PURGE = '<strong>Hinweis:</strong> Sie sind dabei Ihr Inventar vollst&auml;ndig zu ersetzen. 
        Dieser Vorgang l&ouml;scht erst <strong>komplett</strong> Ihren Marketplace-Bestand, und ersetzt ihn dann mit den hier ausgew&auml;hlten Artikeln.<br/><br/>
            Wollen Sie wirklich fortfahren?';
MLI18n::gi()->ML_TEXT_TAB_IDENT = 'Legt die Bezeichnung des Tabs f&uuml;r diesen Marketplace fest, um ihn besser von den anderen Marketplace-Tabs unterscheiden zu k&ouml;nnen (optional).';
MLI18n::gi()->ML_TEXT_FTP_CORRECT = 'FTP Zugangsdaten &uuml;berpr&uuml;ft und gespeichert.';
MLI18n::gi()->ML_TEXT_ORDERS_IMPORTED = 'Bestellungen wurden Importiert';
MLI18n::gi()->ML_TEXT_CONFIRM_SKU_CHANGE_TITLE = 'Warnung!';
MLI18n::gi()->ML_TEXT_CONFIRM_SKU_CHANGE_TEXT = 'Seien Sie sich bewusst, dass sich diese Funktion ma&szlig;geblich auf die Weiterverarbeitung &uuml;ber 
            eine Warenwirtschaft, sowie auf den Abgleich der Shop- und Marktplatz-Inventare auswirkt. <br><br>Wenn Sie diese Optionen nachtr&auml;glich
            &auml;ndern, nach dem Sie bereits Artikel mit einer der beiden Einstellungen &uuml;bertragen haben, zerst&ouml;ren Sie die Nummernkreise, somit
            kann dann kein Abgleich mehr zwischen magnalister, dem Shop und den Marktpl&auml;tzen erfolgen.';

/* NOTICES */
MLI18n::gi()->ML_NOTICE_PLACE_PASSPHRASE = 'Bitte hinterlegen Sie Ihre PassPhrase. Diese erhalten Sie nach der 
        <a href="{#setting:sPublicUrl#}de/kostenlos-testen/%s" title="Jetzt kostenlos testen" class="ml-js-noBlockUi" target="_blank">Registrierung</a>
        auf {#setting:sPublicUrl#}login, sowie per E-Mail.';
MLI18n::gi()->ML_NOTICE_SUBMIT_PRODUCTS = 'Dieser Vorgang kann je nach Anzahl der Artikel einige Minuten in Anspruch nehmen. 
            Bitte laden Sie den Browser w&auml;hrend dieser Zeit nicht neu!';

/* STATUS Messages */
MLI18n::gi()->ML_STATUS_SUBMIT_PRODUCTS = '{1} von bisher {2} &uuml;bertragen. {3} gesamt.';
MLI18n::gi()->ML_STATUS_SUBMIT_PRODUCTS_SUMMARY = '{1} von {2} Artikeln wurden auf den Marktplatz &uuml;bermittelt.';

MLI18n::gi()->ML_STATUS_FILTER_SYNC_ITEM = 'Synchronisiere Daten mit magnalister-Server';
MLI18n::gi()->ML_STATUS_FILTER_SYNC_CONTENT = 'Bitte haben Sie Geduld.';
MLI18n::gi()->ML_STATUS_FILTER_SYNC_SUCCESS = 'Synchronisation abgeschlossen.';

/* Product or Offer Status */
MLI18n::gi()->ML_GENERIC_STATUS_ACTIVE = 'Aktiv';
MLI18n::gi()->ML_GENERIC_STATUS_PRODUCT_IS_CREATED = 'Produkt wird erstellt';
MLI18n::gi()->ML_GENERIC_STATUS_PRODUCT_IS_UPDATED = 'Produkt wird aktualisiert';
MLI18n::gi()->ML_GENERIC_STATUS_OFFER_IS_UPDATED = 'Angebot wird aktualisiert';
MLI18n::gi()->ML_GENERIC_STATUS_OFFER_IS_CREATED = 'Angebot wird erstellt';

/* ERRORS */
MLI18n::gi()->ML_ERROR_LABEL = 'Fehler';
MLI18n::gi()->ML_ERROR_UNKNOWN = 'Unbekannter Fehler';
MLI18n::gi()->ML_ERROR_LABEL_API_FUNCTION = 'API-Funktion';
MLI18n::gi()->ML_ERROR_LABEL_API_CONNECTION_PROBLEM = 'Fehler: Derzeit kann keine Verbindung zum magnalister-Service aufgebaut werden. Bitte versuchen Sie es in einigen Minuten erneut.';
MLI18n::gi()->ML_ERROR_LABEL_LEVEL = 'Level';
MLI18n::gi()->ML_ERROR_LABEL_TYPE = 'Typ';
MLI18n::gi()->ML_ERROR_LABEL_SUBSYSTEM = 'Subsystem';
MLI18n::gi()->ML_ERROR_LABEL_MESSAGE = 'Meldung';

MLI18n::gi()->ML_ERROR_ACCESS_DENIED_TO_SERVICE_LAYER_TEXT = 'Sie sind nicht berechtigt den magnalister-Service-Layer zu verwenden. 
            Bitte wenden Sie sich an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/ .';
MLI18n::gi()->ML_ERROR_AMAZON_WRONG_SELLER_CENTRAL_LOGIN = 'Die Zugangsdaten zu der Amazon-Seller-Central scheinen nicht zu stimmen: Der
    magnalister-Server kann mit den Zugangsdaten keine Verbindung herstellen.
    Bitte &uuml;berpr&uuml;fen Sie die bei der Konfiguration hinterlegten Zugangsdaten und
    korrigieren Sie diese gegebenenfalls. Solange keine Verbindung hergestellt werden kann,
    k&ouml;nnen Sie keine Artikel einstellen oder den Status Ihrer eingestellten Artikel
    einsehen.';
MLI18n::gi()->ML_ERROR_NO_JAVASCRIPT = '<h2>Kein JavaScript</h2>
            <p>Um das magnalister-Tool nutzen zu k&ouml;nnen, ben&ouml;tigen Sie einen JavaScript-F&auml;higen Browser.</p>
            <p>Empfohlen werden aktuelle Versionen von <ul>
                    <li>Firefox</li>
                    <li>Safari</li>
                    <li>Google Chrome</li>
            </ul></p>';
MLI18n::gi()->ML_ERROR_OLD_BROWSER = '<h2>Zu alter Browser</h2>
            <p>Um das magnalister-Tool nutzen zu k&ouml;nnen, ben&ouml;tigen Sie einen Browser, der aktuelle Webstandards unterst&uuml;tzt.</p>
            <p>Empfohlen werden aktuelle Versionen von:</p>
            <ul>
                    <li>Firefox</li>
                    <li>Safari</li>
                    <li>Google Chrome</li>
            </ul>'
;
MLI18n::gi()->ML_ERROR_INVALID_NUMBER = 'Keine g&uuml;ltige Zahl';
MLI18n::gi()->ML_ERROR_WRONG_DEFAULT_CURRENCY = 'Sie versuchen Ihre Artikel in ein Verkaufsportal einzustellen, dass %1$s als W&auml;hrung vorgibt.
            Ihre Standardw&auml;hrung ist %2$s!<br/>
            Daher k&ouml;nnen Sie keine Artikel in dieses Verkausportal einstellen. Bitte &auml;ndern Sie ihre Standardw&auml;hrung um dieses Problem zu l&ouml;sen.';
MLI18n::gi()->ML_ERROR_LISTINGS_USED_UNKOWN = 'Verbrauchte Listings konnten aufgrund eines Fehlers nicht abgerufen werden.';
MLI18n::gi()->ML_SUCCESS_CS_CHECKIN_ALL = 'Es wurden alle %d Artikel erfolgreich eingestellt';
MLI18n::gi()->ML_ERROR_CS_CHECKIN_FEW = 'Beim Einstellvorgang sind Fehler aufgetreten. Es konnten nur %d von %d Artikel eingestellt werden.';
MLI18n::gi()->ML_ERROR_CS_CHECKIN_NONE = 'Beim Einstellvorgang sind Fehler aufgetreten. Von %d Artikeln konnte keiner eingestellt werden.';
MLI18n::gi()->ML_ERROR_API = 'Beim magnalister-Service-Layer ist ein Fehler aufgetreten. Die Anfrage konnte nicht erfolgreich verarbeitet werden.';
MLI18n::gi()->ML_ERROR_UNAUTHED = 'Ihr Shop konnte nicht authentifiziert werden. Bitte stellen Sie sicher, dass der von Ihnen eingegebene PassPhrase 
            und die hinterlegte Shop-URL (Kundenlogin bei magnalister.com) korrekt sind.';
MLI18n::gi()->ML_ERROR_SUBMIT_PRODUCTS = 'Bei der &Uuml;bermittlung der Produkte an den magnalister-Service-Layer ist ein Fehler aufgetreten. 
            Bitte versuchen Sie es in einigen Minuten noch einmal. Sollte der Fehler weiterhin bestehen, wenden 
            Sie sich bitte an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/ .';
MLI18n::gi()->ML_ERROR_MISSING_CURRENCY = 'Die W&auml;hrung des Marktplätze (%s) den Sie in der Konfiguration ausgew&auml;hlt haben, unterscheidet sich von der 
            Standardw&auml;hrung dieses Shops (%s). In den W&auml;hrungstabellen des Shops ist die W&auml;hrung des Marktplätze nicht enthalten. Solange dies der Fall ist,
            kann der Marketplace nicht verwendet werden.';
MLI18n::gi()->ML_ERROR_INVALID_PASSWORD = 'Passwort falsch. Bitte &uuml;berpr&uuml;fen Sie Ihre Zugangsdaten. 
        Bitte kopieren Sie keinen Text, sondern schreiben das Passwort aus, um Fehlerquellen auszuschlie&szlig;en.';
MLI18n::gi()->ML_ERROR_MISSING_PRODUCTS_EAN = 'Amazon verlangt für das &Uuml;bermitteln neuer Produkte EAN-Nummern. magnalister kann aktuell keine EAN-Felder für die Produkte finden.
Bitte f&uuml;gen Sie in Ihrer Attributsverwaltung EAN-Felder hinzu und matchen diese in magnalister > „Globale Konfiguration“ > „Produkteigenschaften"';
MLI18n::gi()->ML_ERROR_COULD_NOT_LOAD_LOCAL_CLIENTVERSION = 'Konnte die Datei ClientVersion nicht von diesem Server laden.';
MLI18n::gi()->ML_ERROR_FTP_CANNOT_CONNECT = 'Es kann &uuml;ber die von Ihnen angegeben Zugangsdaten keine Verbindung zu Ihrem Server hergestellt werden. 
            Bitte &uuml;berpr&uuml;fen Sie die FTP-Zugangsdaten. Sollte der Fehler weiterhin bestehen, wenden Sie sich bitte an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/ .';
MLI18n::gi()->ML_ERROR_FTP_PATH_DOES_NOT_MATCH = 'Es konnte eine FTP-Verbindung hergestellt werden, jedoch konnte das Shop-Verzeichnis nicht ermittelt werden. 
            Bitte &uuml;berpr&uuml;fen Sie das Shop-Verzeichnis. Sollte der Fehler weiterhin bestehen, wenden Sie sich bitte an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/ .';
MLI18n::gi()->ML_ERROR_FTP_PERMISSION_DENIED = 'Eine FTP-Verbindung konnte hergestellt werden. Jedoch hat der FTP-Benutzer keine Schreibrechte. 
        Bitte hinterlegen Sie einen Benutzer mit Schreibrechten. Sollte der Fehler weiterhin bestehen, wenden Sie sich bitte an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/ .';
MLI18n::gi()->ML_ERROR_FTP_INCOMPLETE_DATA = 'Die FTP-Zugangsdaten sind unvollst&auml;ndig. Automatische Updates sind daher nicht m&ouml;glich. 
            F&uuml;r weitere Fragen wenden Sie sich bitte an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/ .';
MLI18n::gi()->ML_ERROR_FTP_NOT_WORKY_CAUSE_OF_RETARDED_PHPCONFIG = 'Die FTP Daten konnten wegen Servereinschr&auml;nkungen nicht gespeichert werden. 
        Automatisierte Updates sind wegen der Safe Mode Einstellungen nur &uuml;ber FTP-Client m&ouml;glich. Alternativ k&ouml;nnen Sie Ihren Server-Provider bitten,
        den Safe Mode zu deaktivieren, um automatische Updates ausf&uuml;hren zu k&ouml;nnen. Sollte Sie Fragen haben, wenden Sie sich bitte an den Support 
        von {#setting:MAGNA_SUPPORT_URL#} oder Ihren Server-Provider.';
MLI18n::gi()->ML_ERROR_MARKETPLACE_TIMEOUT = 'Zurzeit ist die Schnittstelle dieses Marktplätze nicht erreichbar. Sollte diese Meldung nach l&auml;ngerer Wartezeit noch angezeigt werden,
            &uuml;berpr&uuml;fen Sie bitte, ob es auf der Startseite des magnalister Plugins eine Meldung zu diesem Marketplace gibt oder kontaktieren Sie den magnalister Support.';
MLI18n::gi()->ML_ERROR_NO_CATEGORIES_FOUND = 'Keine Kategorien gefunden.';
MLI18n::gi()->ML_ERROR_CREATING_REQUEST = 'Es ist ein Fehler bei der Erzeugung der zu &uuml;bermittelnden Daten aufgetreten.';
MLI18n::gi()->ML_ERROR_NO_SHIPPINGTIME_MATCHING = 'Das Versandzeiten Matching wird von diesem Shop-System nicht unterst&uuml;tzt.';
MLI18n::gi()->ML_ERROR_GD_LIB_MISSING = 'Die GD2 Bibliothek ist nicht installiert. Diese wird ben&ouml;tigt um Produktbilder zu verkleinern und Statistik-Grafiken zu erstellen.';

/* Configurator */
MLI18n::gi()->ML_CONFIG_NOT_INT = 'Keine ganzstellige Zahl';
MLI18n::gi()->ML_CONFIG_NOT_FLOAT = 'Keine Zahl';
MLI18n::gi()->ML_CONFIG_NOT_EMPTY = 'Darf nicht leer bleiben';
MLI18n::gi()->ML_CONFIG_MUST_CONTAIN = 'Muss %s enthalten';
MLI18n::gi()->ML_CONFIG_INVALID_CHARS = 'Enth&auml;lt ung&uuml;ltige Zeichen';
MLI18n::gi()->ML_CONFIG_FIELD_EMPTY_OR_MISSING = 'Das Feld %s in der Konfiguration ist ung&uuml;ltig oder leer. Bitte f&uuml;llen Sie das Feld aus.';
MLI18n::gi()->ML_CONFIG_ORDER_IMPORT_STATUS_SAME_OPTION_USED_TWICE = 'Der Bestellstatus der Einstellung "%s" in der Konfiguration darf nicht doppelt verwendet werden. Prüfen Sie auch folgende Einstellungen: %s';

/* Platform independent stuff */
MLI18n::gi()->ML_GENERIC_PREPARE = 'Produkte vorbereiten';
MLI18n::gi()->ML_GENERIC_CHECKIN = 'Hochladen';
MLI18n::gi()->ML_GENERIC_CONFIGURATION = 'Konfiguration';
MLI18n::gi()->ML_GENERIC_INVENTORY = 'Inventar';
MLI18n::gi()->ML_GENERIC_DELETED = 'Gel&ouml;schte';
MLI18n::gi()->ML_GENERIC_REJECTED = 'Zur&uuml;ckgewiesen';
MLI18n::gi()->ML_GENERIC_FAILED = 'Fehlgeschlagene';
MLI18n::gi()->ML_GENERIC_ERRORLOG = 'Fehlerlog';

MLI18n::gi()->ML_GENERIC_PRODUCTDETAILS = 'Produktdetails';
MLI18n::gi()->ML_GENERIC_IMAGES = 'Bilder';
MLI18n::gi()->ML_GENERIC_CONDITION = 'Zustand';
MLI18n::gi()->ML_GENERIC_CONDITION_NOTE = 'Zustandsbeschreibung';
MLI18n::gi()->ML_GENERIC_SHIPPING = 'Versand';
MLI18n::gi()->ML_GENERIC_PRICE = 'Preis';
MLI18n::gi()->ML_GENERIC_NO_IMAGE = 'Kein Bild';
MLI18n::gi()->ML_GENERIC_PRODUCTDESCRIPTION = 'Produktbeschreibung';
MLI18n::gi()->ML_GENERIC_MY_PRODUCTDESCRIPTION = 'Meine Produktbeschreibung';
MLI18n::gi()->ML_GENERIC_CHECKINDATE = 'Einstelldatum';
MLI18n::gi()->ML_GENERIC_DELETEDDATE = 'L&ouml;schdatum';
MLI18n::gi()->ML_GENERIC_COMMISSIONDATE = 'Auftragsdatum';
MLI18n::gi()->ML_GENERIC_STATUS = 'Status';
MLI18n::gi()->ML_GENERIC_ERROR_CODE = 'Fehlercode';
MLI18n::gi()->ML_GENERIC_ERROR_MESSAGES = 'Fehlermeldung';
MLI18n::gi()->ML_GENERIC_ERROR_RECOMMENDATION = 'Weitere Hilfestellung';
MLI18n::gi()->ML_GENERIC_ERROR_DETAILS = 'Fehlerdetails';
MLI18n::gi()->ML_GENERIC_NO_ERRORS_YET = 'Keine Fehlermeldungen vorhanden.';
#MLI18n::gi()->ML_GENERIC_DELETED='Gel&ouml;scht';
MLI18n::gi()->ML_GENERIC_BOOKED = 'Vorgemerkt';
MLI18n::gi()->ML_GENERIC_COULD_NOT_DELETE = 'Konnte nicht gel&ouml;scht werden';
MLI18n::gi()->ML_GENERIC_NO_DELETED_ITEMS_IN_TIMEFRAME = 'In diesem Zeitraum wurden keine Artikel gel&ouml;scht.';
MLI18n::gi()->ML_GENERIC_NO_DELETED_ITEMS_YET = 'Noch keine Artikel gel&ouml;scht.';
MLI18n::gi()->ML_GENERIC_LISTINGS = 'Inventar';
MLI18n::gi()->ML_GENERIC_LOWEST_PRICE = 'Preis-Hit';
MLI18n::gi()->ML_GENERIC_OLD_PRICE = 'Damaliger Preis';
MLI18n::gi()->ML_GENERIC_REASON = 'Grund';
MLI18n::gi()->ML_GENERIC_NO_INVENTORY = 'Das Inventar ist derzeit leer.';
MLI18n::gi()->ML_GENERIC_INVENTORY_IS_SPLIT = 'Is Split';
MLI18n::gi()->ML_GENERIC_EAN = 'EAN';
MLI18n::gi()->ML_GENERIC_MANUFACTURER = 'Artikelhersteller';
MLI18n::gi()->ML_GENERIC_MANUFACTURER_NAME = 'Artikelhersteller';
MLI18n::gi()->ML_GENERIC_MANUFACTURER_PARTNO = 'Modellnummer';
MLI18n::gi()->ML_GENERIC_MODEL_NUMBER = 'Artikel-Nummer';
MLI18n::gi()->ML_GENERIC_WEIGHT = 'Gewicht';
MLI18n::gi()->ML_GENERIC_SHIPPING_COST = 'Versandkosten';
MLI18n::gi()->ML_GENERIC_SHIPPING_COST_ADDITIONAL = 'Versandkostenaufschlag';
MLI18n::gi()->ML_GENERIC_SHIPPING_COST_IN_CURRENCY = '{#i18n:ML_GENERIC_SHIPPING_COST#} in %s';
MLI18n::gi()->ML_GENERIC_SHIPPING_TIME = 'Versandzeit';
MLI18n::gi()->ML_GENERIC_TESTMAIL_SENT = 'Die Testmail wurde versendet.';
MLI18n::gi()->ML_GENERIC_NO_TESTMAIL_SENT = 'Es wurde keine Testmail versendet, da die Konfiguration fehlerhaft ist. Bitte korrigieren Sie alle Eingabefelder.';
MLI18n::gi()->ML_GENERIC_TESTMAIL_SENT_FAIL = 'Es konnte keine Testmail versendet werden, da ein Fehler aufgetreten ist.';
MLI18n::gi()->ML_GENERIC_LASTSYNC = 'Letzte Synchronisation';
MLI18n::gi()->ML_GENERIC_AUTOMATIC_ORDER = 'Dies ist eine von magnalister automatisiert angelegte Bestellung aus Ihrem Marketplace.';
MLI18n::gi()->ML_GENERIC_AUTOMATIC_ORDER_MP = 'magnalister-Verarbeitung (%s)';
MLI18n::gi()->ML_GENERIC_AUTOMATIC_ORDER_MP_SHORT = 'magnalister-Verarbeitung (%s)';
MLI18n::gi()->ML_GENERIC_ORDER_THROUGH_COMPARISON_SHOPPING = 'Der Kunde der diese Bestellung get&auml;tigt hat, wurde durch %s auf Ihren Shop aufmerksam.';

MLI18n::gi()->ML_GENERIC_STATUS_LOGIN_SAVED = 'Die Zugangsdaten wurden erfolgreich an den magnalister-Service &uuml;bermittelt.';
MLI18n::gi()->ML_GENERIC_STATUS_LOGIN_SAVEERROR = 'Die Zugangsdaten konnten nicht an den magnalister-Service &uuml;bermittelt werden.';
MLI18n::gi()->ML_GENERIC_DELETE_LISTINGS = 'M&ouml;chten Sie die markierten Produkte wirklich bei %s l&ouml;schen?';
MLI18n::gi()->ML_GENERIC_DELETE_ERROR_MESSAGES = 'M&ouml;chten Sie wirklich die markierten Fehlermeldungen unwiderruflich l&ouml;schen?';
MLI18n::gi()->ML_GENERIC_CONFIRM_DELETE_ENTIRE_ERROR_PROTOCOL = 'M&ouml;chten Sie wirklich das gesamte Fehlerprotokoll unwiderruflich l&ouml;schen?';

MLI18n::gi()->ML_GENERIC_ERROR_WRONG_CURRENCY = 'Die W&auml;hrung des Marktplätze (%s) unterscheidet sich von der Standardw&auml;hrung dieses Shops (%s). 
            Der Preis wird automatisch in die entsprechende W&auml;hrung umgerechnet. Der Umrechnungsfaktor wird den W&auml;hrungseinstellungen	entnommen.';
MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP = 'Die zu dem gew&auml;hlten Marketplace geh&ouml;rende W&auml;hrung (%s) existiert in diesem Shop nicht.
            Bitte legen Sie die W&auml;hrung in Ihrem Shop an, um in diesem Marketplace einstellen zu k&ouml;nnen.';
MLI18n::gi()->ML_GENERIC_ERROR_UNABLE_TO_LOAD_PREPARE_DATA = 'Konnte die vorbereiteten Daten f&uuml;r das Produkt nicht laden. 
            Dies h&auml;tte nicht passieren d&uuml;rfen. Bitte setzen Sie sich mit dem Support in Verbindung.';
MLI18n::gi()->ML_GENERIC_TEXT_NO_PREPARED_PRODUCTS = 'Es sind noch keine Produkte vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bzw. "Kategorie Matching" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->ML_GENERIC_ERROR_PRODUCTS_WITHOUT_MODEL_EXIST = 'Es sind Produkte ohne oder mit doppelter Artikelnummer vorhanden. Die Produkte k&ouml;nnen daher nicht &uuml;bermittelt werden: 
            Sie haben in der Konfiguration unter "Synchronisation Nummernkreise" die Option "Artikelnummer" gew&auml;hlt. Klicken Sie <a href="#LINK#"><b>hier</b></a>, um automatisiert
            die	Artikelnummern zu korrigieren! <br/>
            Alternativ k&ouml;nnen Sie die Nummernkreissynchronisation in der Konfiguration auf "Produkt ID" &auml;ndern.';
MLI18n::gi()->ML_GENERIC_LABEL_ORIGIN = 'Herkunft';

/* Platform specific stuff */
/* amazon */
MLI18n::gi()->ML_AMAZON_PRODUCT_PREPARE = 'Produkte vorbereiten';
MLI18n::gi()->ML_AMAZON_PRODUCT_MATCHING = 'Produkt Matching';
MLI18n::gi()->ML_AMAZON_NEW_ITMES = 'Neue Produkte erstellen';
MLI18n::gi()->ML_AMAZON_CONDITION_DESCRIPTION = 'Zustandsbeschreibung';
MLI18n::gi()->ML_AMAZON_X_CHARS_LEFT = 'Noch %s Zeichen &uuml;brig';
MLI18n::gi()->ML_AMAZON_PRODUCTGROUP = 'Produktgruppe'; // zz. nicht verwendet
MLI18n::gi()->ML_AMAZON_CATEGORY = 'Amazon Kategorie';
MLI18n::gi()->ML_AMAZON_NEW_SEARCH_QUERY = 'Neue Suchanfrage';
MLI18n::gi()->ML_AMAZON_ENTER_ASIN_DIRECTLY = 'ASIN Direkteingabe';
MLI18n::gi()->ML_AMAZON_BOPIS_ORDERS = '"Click & Collect in store"-Bestellungen';
MLI18n::gi()->ML_AMAZON_BOPIS_ORDERS_OVERVIEW = '"Click & Collect in store"-Bestellübersicht';

MLI18n::gi()->ML_AMAZON_LABEL_AMAZON_PRICE = 'Mein Amazon Preis (Brutto)';
MLI18n::gi()->ML_AMAZON_LABEL_AMAZON_PRICE_SHORT = 'Mein Amazon Preis';
MLI18n::gi()->ML_AMAZON_LABEL_OLD_AMAZON_PRICE_SHORT = 'Mein alter Amazon Preis';
MLI18n::gi()->ML_AMAZON_LABEL_MATCHED = 'Vorbereitet';
MLI18n::gi()->ML_AMAZON_LABEL_MATCH = 'Vorbereiten';
MLI18n::gi()->ML_AMAZON_LABEL_MANUAL_MATCHING = 'Manuelles Matching';
MLI18n::gi()->ML_AMAZON_LABEL_MANUAL_MATCHING_POPUP = 'manuelles Matching';
MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING = 'Automatisches Matching';
MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING_POPUP = 'automatisches Matching';
MLI18n::gi()->ML_AMAZON_BUTTON_MATCHING_DELETE = 'Matching aufheben';
MLI18n::gi()->ML_AMAZON_LABEL_BATCHID = 'BatchID';
MLI18n::gi()->ML_AMAZON_LABEL_PRODUCT_IN_AMAZON = 'Ihr Angebot bei Amazon';
MLI18n::gi()->ML_AMAZON_LABEL_ADD_WAIT = 'In Warteschlange';
MLI18n::gi()->ML_AMAZON_LABEL_ADD_DONE = 'Einstellvorgang abgeschlossen';
MLI18n::gi()->ML_AMAZON_LABEL_ADD_FAIL = 'Einstellvorgang fehlgeschlagen';
MLI18n::gi()->ML_AMAZON_LABEL_EDIT_WAIT = 'Artikel wird aktualisiert';
MLI18n::gi()->ML_AMAZON_LABEL_DELETE_WAIT = 'Als gel&ouml;scht markiert';
MLI18n::gi()->ML_AMAZON_LABEL_DELETE_DONE = 'L&ouml;schvorgang abgeschlossen';
MLI18n::gi()->ML_AMAZON_LABEL_DELETE_FAIL = 'L&ouml;schvorgang fehlgeschlagen';
MLI18n::gi()->ML_AMAZON_LABEL_IN_INVENTORY = 'Aktuell im Inventar';
MLI18n::gi()->ML_AMAZON_LABEL_LAST_REPORT = 'Letzter Bericht von Amazon';
MLI18n::gi()->ML_AMAZON_LABEL_LAST_INVENTORY_CHANGE = 'Letzte &Auml;nderung am Inventar';
MLI18n::gi()->ML_AMAZON_LABEL_NO_INVENTORY = 'Derzeit liegen keine Inventarberichte von Amazon vor.';
MLI18n::gi()->ML_AMAZON_LABEL_SIMILAR_PRODUCTS = '&Auml;hnliche Angebote bei Amazon';
MLI18n::gi()->ML_AMAZON_LABEL_SAME_PRODUCTS = 'Gleiche Angebote bei Amazon';
MLI18n::gi()->ML_AMAZON_LABEL_TITLE = 'Amazon Titel';
MLI18n::gi()->ML_AMAZON_LABEL_ASIN = 'ASIN';
MLI18n::gi()->ML_AMAZON_LABEL_QUANTITY = 'Bestand: Shop / Amazon';
MLI18n::gi()->ML_AMAZON_LABEL_PRODUCT_AT_AMAZON = 'Produkt bei Amazon';
MLI18n::gi()->ML_AMAZON_LABEL_ONLY_NOT_MATCHED = 'Nur nicht gematchte';
MLI18n::gi()->ML_AMAZON_LABEL_MISSING_FIELDS = 'Fehlende Felder';
MLI18n::gi()->ML_AMAZON_LABEL_INCOMPLETE = 'unvollst&auml;ndig';
MLI18n::gi()->ML_AMAZON_LABEL_BUSINESS_FEATURE = 'Business Feature';
MLI18n::gi()->ML_AMAZON_LABEL_BUSINESS_PRICE = 'Business Preis';

MLI18n::gi()->ML_AMAZON_LABEL_PREPARE_KIND = 'Vorbereitungsart';
MLI18n::gi()->ML_AMAZON_LABEL_PREPARE_IS_MATCHED = 'gematched';
MLI18n::gi()->ML_AMAZON_LABEL_PREPARE_IS_APPLIED = 'Neue Produkte erstellen';

MLI18n::gi()->ML_AMAZON_LABEL_APPLY_EMPTY = 'Keine Artikel mit EAN Nummer gefunden. Amazon verlangt zum Erstellen neuer Produkte eine EAN pro Artikel, bzw. pro Artikelvariante';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_SINGLE = 'Beantragung &ndash; Vorbereitung';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_MULTI = 'Mehrfach-Beantragung &ndash; Vorbereitung';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_SELECT_MAIN_SUB_CAT_FIRST = 'Bitte erst Haupt- und Unterkategorie w&auml;hlen';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_SELECT_MAIN_CAT_FIRST = 'Bitte erst Hauptkategorie w&auml;hlen';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_BROWSENODE_NOT_SELECTED = 'Bitte wählen';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_PLEASE_SELECT = 'Bitte w&auml;hlen';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_REQUIRED_ATTRIBUTES = 'Pflichtattribute';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_BROWSENODES = 'Browsenodes';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_BULLETPOINTS = 'Bulletpoints';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_KEYWORDS = 'Allgemeine Schl&uuml;sselw&ouml;rter';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_ADDITIONAL_DETAILS = 'Weitere Details (Empfohlen)';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_NOT_PREPARED = 'Nicht vorbereitet';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_PREPARE_COMPLETE = 'Vollst&auml;ndig';
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_PREPARE_INCOMPLETE = 'Unvollst&auml;ndig'; 
MLI18n::gi()->ML_AMAZON_LABEL_APPLY_ATTRIBUTES = 'Attribute';
MLI18n::gi()->ML_AMAZON_LABEL_ADDITIONAL_DATA = 'Betrifft';
MLI18n::gi()->ML_AMAZON_LABEL_LEADTIME_TO_SHIP = 'Bearbeitungszeit';

MLI18n::gi()->ML_AMAZON_CATEGORY_MATCHED_NONE = 'Keine vorbereitet';
MLI18n::gi()->ML_AMAZON_CATEGORY_MATCHED_FALUTY = 'Keine erfolgreich vorbereitet';
MLI18n::gi()->ML_AMAZON_CATEGORY_MATCHED_ALL = 'Alle erfolgreich vorbereitet';
MLI18n::gi()->ML_AMAZON_CATEGORY_MATCHED_INCOMPLETE = 'Unvollst&auml;ndig vorbereitet';
MLI18n::gi()->ML_AMAZON_ITEMS_PREPARED = 'Daten sind vorbereitet';
MLI18n::gi()->ML_AMAZON_ITEMS_NOT_PREPARED = 'Daten sind nicht vorbereitet';

MLI18n::gi()->ML_AMAZON_BUTTON_TOKEN_NEW = 'Token beantragen / &auml;ndern';
MLI18n::gi()->ML_AMAZON_BUTTON_PREPARE = 'Vorbereiten';
MLI18n::gi()->ML_AMAZON_BUTTON_SELECTED = 'Ausgew&auml;hlte &uuml;bertragen';
MLI18n::gi()->ML_AMAZON_BUTTON_APPLY_DELETE = 'Vorbereitung aufheben';

MLI18n::gi()->ML_AMAZON_PRODUCT_MATHCED_NO = 'Nicht vorbereitet';
MLI18n::gi()->ML_AMAZON_PRODUCT_MATCHED_FAULTY = 'Nicht erfolgreich vorbereitet';
MLI18n::gi()->ML_AMAZON_PRODUCT_MATCHED_OK = 'Erfolgreich vorbereitet';

MLI18n::gi()->ML_AMAZON_TEXT_TOKEN_EXPIRES_AT = 'Der Token ist g&uuml;ltig bis %s';
MLI18n::gi()->ML_AMAZON_TEXT_REMATCH = 'Die ausgew&auml;hlten Produkte wurden bereits gematcht. Um diese per Multimatching neu 
            zu matchen m&uuml;ssen Sie zuvor die Option &quot;{#i18n:ML_LABEL_ALL#}&quot; neben der Schaltfl&auml;che 
            &quot;{#18n:ML_AMAZON_LABEL_MANUAL_MATCHING#}&quot; anw&auml;hlen.';
MLI18n::gi()->ML_AMAZON_TEXT_CHECKIN_DELAY = 'Bitte beachten Sie, dass es bis zu zwei Stunden dauern kann bis Einstell- und L&ouml;schvorg&auml;nge
            vollst&auml;ndig von Amazon verarbeitet werden.';
MLI18n::gi()->ML_AMAZON_TEXT_REFRESH_REQUEST_SEND = 'Ihre Aktualisierungsanfrage wurde gesendet. Bitte beachten Sie, dass es bis zu einer Stunde dauern kann 
            bis von Amazon ein neuer Bericht eintrifft.';
MLI18n::gi()->ML_AMAZON_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r Amazon vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->ML_AMAZON_TEXT_MANUALLY_MATCHING_DESC = 'Die per Checkbox ausgew&auml;hlten Shop-Artikel werden versucht &uuml;ber ASIN, EAN und Titel
            mit Artikeln auf Amazon zu matchen.<br/ ><br/ >
            Sie erhalten ein detailiertes Ergebnis &uuml;ber erfolgreiche oder erfolglose Suchtreffer und k&ouml;nnen individuell ausw&auml;hlen,
            mit welchem Treffer gematcht werden soll.<br/ ><br/ >
            Die Verarbeitung ist sehr genau, aber auch zeitaufw&auml;ndig.';
MLI18n::gi()->ML_AMAZON_TEXT_AUTOMATIC_MATCHING_DESC = 'Die per Checkbox ausgew&auml;hlten Shop-Artikel werden automatisch im Hintergrund verarbeitet: 
            Der Artikel wird &uuml;ber die hinterlegte EAN automatisch mit der EAN eines bestehenden Amazon Artikels gematcht.<br/ ><br/ >
            Voraussetzung ist die Pflege der EAN-Nummern je Artikel.';
MLI18n::gi()->ML_AMAZON_TEXT_AUTOMATIC_MATCHING_CONFIRM = 'Bitte beachten Sie, dass das automatische Matching auschlie&szlig;lich &uuml;ber den Abgleich der EAN Nummer 
            erfolgt. M&ouml;glicherweise werden Artikel aus Amazon gematcht, deren Beschreibungen oder Produktbilder eine mindere Qualit&auml;t aufweisen. Daher kann das
            Matching zu einem schlechteren Ergebnis f&uuml;hren, als das manuelle Matching.<br/ ><br/ >
            RedGecko GmbH &uuml;bernimmt daher keine Haftung f&uuml;r die Korrektheit der gematchten Produkte.';
MLI18n::gi()->ML_AMAZON_TEXT_MATCHING_NO_ITEMS_SELECTED = 'Sie haben noch keine Artikel ausgew&auml;hlt.';
MLI18n::gi()->ML_AMAZON_TEXT_AUTOMATIC_MATCHING_SUMMARY = '%d Artikel wurden erfolgreich gematcht. <br/ ><br/ >
            %d Artikel konnten nicht erfolgreich gematcht werden.<br/ >
            Davon %d mit mehrfachen Ergebnissen.';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_REQUIERD_FIELDS = '<b>Hinweis:</b> Die mit <span class="bull">&bull;</span> markierten Felder sind Pflichtfelder und m&uuml;ssen ausgef&uuml;llt werden.';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_MANUFACTURER_NAME = 'Hersteller des Produktes';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_BRAND = 'Marke oder Hersteller des Produktes';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_MANUFACTURER_PARTNO = 'Geben Sie die Modellnummer des Herstellers f&uuml;r das Produkt an.';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_PRODUCTS_IMAGES = 'Maximal 9 Produktbilder';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_BULLETPOINTS = 'Key-Features des Artikels (z. B. &quot;Vergoldete Armaturen&quot;, &quot;Extrem edles Design&quot;)<br /><br />
            Diese Daten werden aus Meta-Description gezogen und m&uuml;ssen dort mit Kommas getrennt sein.<br />
            Maximal je 500 Zeichen.';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_PRODUCTDESCRIPTION = 'Maximal 2000 Zeichen. Einige HTML-Tags und deren Attribute sind erlaubt. Diese Z&auml;hlen zu den 2000 Zeichen dazu.';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_KEYWORDS = 'Werden bei Suche verwendet (z. B. &quot;vergoldet edel kitschig&quot;)<br /><br />
            Diese Daten werden aus Meta-Keywords gezogen und m&uuml;ssen dort mit Kommas getrennt sein.<br />
            Maximal je 1000 Zeichen.';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_DATA_INCOMPLETE = 'Einige Pflichtfelder wurden nicht ausgef&uuml;llt. Bitte korrigieren Sie dies durch Klick auf die Schaltfl&auml;che "{#i18n:ML_AMAZON_BUTTON_PREPARE#}"';
MLI18n::gi()->ML_AMAZON_TEXT_APPLY_REQUIERD_IDENTIFIER = 'Nicht relevant, wenn an den Varianten %type% hinterlegt ist';

MLI18n::gi()->ML_AMAZON_ERROR_CREATE_TOKEN_LINK_HEADLINE = 'Token Link konnte nicht erzeugt werden';
MLI18n::gi()->ML_AMAZON_ERROR_CREATE_TOKEN_LINK_TEXT = 'Es konnte keine Verbindung zu amazon aufgebaut werden. Bitte laden Sie die Seite erneut.<br><br>Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';
MLI18n::gi()->ML_AMAZON_ERROR_WRONG_CURRENCY = 'Die W&auml;hrung des Amazon-Marktplätze (%s) den Sie in der Konfiguration ausgew&auml;hlt haben unterscheidet sich von der 
            Standardw&auml;hrung dieses Shops (%s). Der Preis wird automatisch in die entsprechende W&auml;hrung umgerechnet. Der Umrechnungsfaktor wird den W&auml;hrungseinstellungen
            entnommen.';

MLI18n::gi()->ML_AMAZON_ERROR_APPLY_CANNOT_FETCH_SUBCATS = 'Konnte Unterkategorien nicht laden.';
MLI18n::gi()->ML_AMAZON_ERROR_CURRENCY_NOT_IN_SHOP = 'Die zu dem gew&auml;hlten Amazon-Marktplatz geh&ouml;rende W&auml;hrung (%s) existiert in diesem Shop nicht.
            Bitte legen Sie die W&auml;hrung in Ihrem Shop an, um in diesem Amazon-Marktplatz einstellen zu k&ouml;nnen.';
MLI18n::gi()->ML_AMAZON_ERROR_ORDERSYNC_FAILED = 'Der Bestellstatus konnte nicht synchronisiert werden. Bitte schauen Sie in das Amazon Fehlerlog f&uuml;r Details.';
MLI18n::gi()->ML_AMAZON_ERROR_BOPIS_ORDERSTATUS_UPDATE_FAILED_TEXT = 'Wir konnten den Bestellstatus Ihrer BOPIS-Bestellung nicht updaten. <br>Bitte prüfen Sie noch einmal ob die Bestellung wirklich zu Ihnen gehört und ob der Statuswechsel seitens Amazon zulässig ist.<br><br> Für mehr Infos lesen Sie bitte folgende <a href="https://google.de">FAQ</a>.';
MLI18n::gi()->ML_AMAZON_ERROR_BOPIS_ORDERSTATUS_UPDATE_FAILED_HEADLINE = 'Der Bestellstatus konnte nicht aktualisiert werden';
/*
 * comparison shopping
 */
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_SKU = 'Artikel ID';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_TITLE = 'Artikelname';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_ID = '{#i18n:ML_COMPARISON_SHOPPING_FIELD_SKU#}';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_NAME = '{#i18n:ML_COMPARISON_SHOPPING_FIELD_ITEM_TITLE#}';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_PRICE = 'Preis';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_CURRENCY = 'W&auml;hrung';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_DESCRIPTION = 'Artikelbeschreibung';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_DESCRIPTION = '{#i18n:ML_COMPARISON_SHOPPING_FIELD_DESCRIPTION#}';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_URL = 'Artikel-URL';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_MANUFACTURER_NAME = 'Artikelhersteller';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_MODEL_NUMBER = 'Artikel-Nummer';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_EAN = 'EAN';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_IMAGE1 = 'Bild-URL';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_IMAGE_URL = '{#i18n:ML_COMPARISON_SHOPPING_FIELD_IMAGE1#}';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_SHIPPING_PRICE = 'Versandkosten';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_SHIPPING_TIME = 'Versandzeit';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_WEIGHT = 'Versandgewicht';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_TAX = 'Steuersatz';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_QUANTITY = 'Lagerbestand';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_QUANTITY_HOVER = 'muss gr&ouml;&szlig;er als 0 sein';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_STOCK_QTY = '{#i18n:ML_COMPARISON_SHOPPING_FIELD_QUANTITY#}';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_ITEM_STOCK_QTY_HOVER = '{#i18n:ML_COMPARISON_SHOPPING_FIELD_QUANTITY_HOVER#}';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_DAPARTO_USAGE = 'Verwendung (KBA)';
MLI18n::gi()->ML_COMPARISON_SHOPPING_FIELD_DAPARTO_USAGE_HOVER = 'Identisch mit EAN';

MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_MISSING_FIELDS = 'Fehlende Felder';
MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_LUMP = 'Pauschal (aus rechtem Feld)';
MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_ARTICLE_SHIPPING_COSTS = 'Artikel-Versandkosten';
MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_PATH_TO_CSV_TABLE = 'Pfad zu Ihrer CSV-Tabelle';

MLI18n::gi()->ML_COMPARISON_SHOPPING_TEXT_NO_CSV_TABLE_YET = 'Noch keine CSV-Tabelle erstellt: Bitte stellen Sie zuerst Artikel ein. Danach finden Sie hier den CSV-Pfad.';
MLI18n::gi()->ML_CSHOPPING_TEXT_RECONCILIATION_OF_INVENTORY = '
            Die Verarbeitung des Inventars erfolgt bei der Preissuchmaschine zeitverz&ouml;gert (i.d.R. max. 24 Stunden). 
            Kurzzeitige Abweichungen sind m&ouml;glich.';
MLI18n::gi()->ML_CSHOPPING_TEXT_FIRST_CHECKIN = 'Ihre Artikel wurden erfolgreich &uuml;bermittelt.
            Als letzten Schritt &uuml;bermitteln Sie bitte den Pfad Ihrer neuen CSV-Tabelle noch an %1$s, damit die Artikel dort aktiviert werden:
            <br/><br/>
            <span class="tt">%2$s</span>
            <br/><br/>
            Sie finden den Pfad jederzeit unter dem Register %1$s &rarr; "Konfiguration".
            Wie Sie den Pfad &uuml;bermitteln, erfahren Sie direkt bei %1$s.';


MLI18n::gi()->ML_COMPARISON_SHOPPING_ERROR_INCOMPLETE_DATA = 'Fehler beim Einstellen. Folgende Produkte konnten nicht eingestellt werden, da Angaben fehlen.
            Sie k&ouml;nnen die Artikel direkt durch Klick auf den Produktnamen bearbeiten.';

/* guenstiger.de */
MLI18n::gi()->ML_GUENSTIGER_SAME_PRODUCT_THERE = 'Dieser Artikel bei guenstiger.de';

/* getdeal.de */
MLI18n::gi()->ML_GETDEAL_SAME_PRODUCT_THERE = 'Dieser Artikel bei getdeal.de';

/* idealo.de */
MLI18n::gi()->ML_IDEALO_SAME_PRODUCT_THERE = 'Dieser Artikel bei idealo.de';

/* preissuchmaschnine.de */
MLI18n::gi()->ML_PREISSUCHMASCHINE_SAME_PRODUCT_THERE = 'Dieser Artikel bei preissuchmaschnine.de';

/* kelkoo.de */
MLI18n::gi()->ML_KELKOO_SAME_PRODUCT_THERE = 'Dieser Artikel bei kelkoo.de';

/* yatego */
MLI18n::gi()->ML_YATEGO_SAME_PRODUCT_THERE = 'Dieser Artikel bei yatego';

MLI18n::gi()->ML_YATEGO_CATEGORY_MATCHING = 'Kategorie Matching';
MLI18n::gi()->ML_YATEGO_LABEL_SHOP_CATEGORIES = 'Shop-Kategorien';
MLI18n::gi()->ML_YATEGO_LABEL_YATEGO_CATEGORIES = 'Yatego-Kategorien';
MLI18n::gi()->ML_YATEGO_LABEL_SELECTED_SHOP_CAT = 'Gew&auml;hlte Shopkategorie';
MLI18n::gi()->ML_YATEGO_LABEL_SELECTED_YATEGO_CATS = 'Dazu gew&auml;hlte Yatego Kategorien';
MLI18n::gi()->ML_YATEGO_LABEL_ORDER_ID = 'Yatego-Bestellnummer';
MLI18n::gi()->ML_YATEGO_LABEL_PURGE_CATEGORIES = 'Yatego-Kategorien aktualisieren';
MLI18n::gi()->ML_YATEGO_LABEL_INVALID_CATEGORIES = 'Verwaiste Kategorien';
MLI18n::gi()->ML_YATEGO_LABEL_YATEGO_PRICE = 'Mein Yatego Preis';

MLI18n::gi()->ML_YATEGO_MESSAGE_NOT_YET_SAVED = 'Die Yategokategorien wurden noch nicht gespeichert. Verwerfen und fortfahren?';
MLI18n::gi()->ML_YATEGO_MESSAGE_SELECT_SHOP_CAT_FIRST = 'Bitte zun&auml;chst Shop Kategorie ausw&auml;hlen.';
MLI18n::gi()->ML_YATEGO_MESSAGE_SAVE_SELECT_SHOP_CAT_FIRST = 'Es kann nichts gespeichert werden, da Sie noch keine Shop-Kategorie ausgew&auml;hlt 
            und dieser Yatego-Kategorien hinzugef&uuml;gt haben.';
MLI18n::gi()->ML_YATEGO_MESSAGE_MATCHING_SAVED = 'Das Matching wurde erfolgreich gespeichert.';
MLI18n::gi()->ML_YATEGO_MESSAGE_ONLY_ONE_SUBCAT = 'Einer Shop-Kategorie darf maximal eine Unterkategorie aus der selben Mittelkategorie zugewiesen werden.';

MLI18n::gi()->ML_YATEGO_ERROR_WHILE_SAVING = 'Speichervorgang konnte nicht ausgef&uuml;hrt werden. Bitte versuchen Sie es erneut.';
MLI18n::gi()->ML_YATEGO_ERROR_SAVING_INVALID_YATEGO_CATS = 'Die Anfrage war fehlerhaft (Yatego-Kategorien fehlerhaft). Bitte wiederholen Sie den Matching-Vorgang.';
MLI18n::gi()->ML_YATEGO_ERROR_SAVING_INVALID_SHOP_CAT = 'Die Anfrage war fehlerhaft (Shop-Kategorie ung&uuml;ltig). Bitte wiederholen Sie den Matching-Vorgang.';
MLI18n::gi()->ML_YATEGO_ERROR_SAVING_INVALID_YATEGO_CATS_ALL = 'Die Anfrage war fehlerhaft (Alle Yatego-Kategorien ung&uuml;ltig). 
            Bitte wiederholen Sie den  Matching-Vorgang.';
MLI18n::gi()->ML_YATEGO_ERROR_REQUEST_INVALID = 'Anfrage ist ung&uuml;ltig.';
MLI18n::gi()->ML_YAGETO_ERROR_CANNOT_DL_CATEGORIES = 'Die Yatego-Kategorien konnten nicht vom Yatego-Server heruntergeladen werden.';
MLI18n::gi()->ML_YAGETO_ERROR_CATEGORIES_NOT_IMPORTED_YET = 'Es wurden noch keine Yatego-Kategorien importiert.';
MLI18n::gi()->ML_YAGETO_ERROR_ACCESS_DENIED = 'Die Zugangsdaten zum Yatego-Admin scheinen nicht zu stimmen: Der
            magnalister-Server kann mit den Zugangsdaten keine Verbindung herstellen.
            Bitte &uuml;berpr&uuml;fen Sie die bei der Konfiguration hinterlegten Zugangsdaten und
            korrigieren Sie diese gegebenenfalls.';

MLI18n::gi()->ML_YAGETO_TEXT_SPECIAL_FILTER = 'Bitte achten Sie darauf, dass auf Yatego Filter f&uuml;r Ihren Account hinterlegt sein k&ouml;nnen, die das
            Listing beeinflussen k&ouml;nnen. Auch kann nicht &uuml;berpr&uuml;ft werden, ob Ihr maximales Artikel-Kontingent auf Yatego &uuml;berschritten wird.';
MLI18n::gi()->ML_YATEGO_HINT_HEADLINE_PURGE_CATEGORIES = 'Yatego-Kategorien aktualisieren';
MLI18n::gi()->ML_YATEGO_TEXT_PURGE_CATEGORIES = 'Die Yatego-Kategorien werden immer zum 1. eines Monats automatisch aktualisiert.<br /><br />
            <b>Hinweis:</b> Es kann passieren, dass Yatego Kategorien entfernt. Diese k&ouml;nnen dann nicht mehr verwendet werden und m&uuml;ssen bei dem Kategorie-Matching entfernt werden.<br /><br />
            Klicken Sie auf OK, um die Kategorien jetzt zu aktualisieren.';
MLI18n::gi()->ML_YATEGO_TEXT_DELETED_INVALID_CATEGORY_MATCHINGS = 'Yatego hat (einige) Kategorien ge&auml;ndert. Die entsprechenden Matchings wurden gel&ouml;scht.
            Bitte matchen Sie die nachstehenden Shop-Kategorien neu:';

/* eBay */
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_1 = '1 Tag';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_3 = '3 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_5 = '5 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_7 = '7 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_10 = '10 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_14 = '14 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_28 = '28 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_30 = '30 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_60 = '60 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_DAYS_120 = '120 Tage';
MLI18n::gi()->ML_EBAY_LABEL_LISTINGDURATION_GTC = 'Unbegrenzt';
MLI18n::gi()->ML_LABEL_EBAY_LISTINGTIME = 'Eingestellt von-bis';
MLI18n::gi()->ML_LABEL_EBAY_LISTINGTIME_FROM = 'Eingestellt am';
MLI18n::gi()->ML_LABEL_EBAY_LISTINGTIME_TILL = 'Beendet am';
MLI18n::gi()->ML_EBAY_CONDITION_NEW = 'Neu';
MLI18n::gi()->ML_EBAY_CONDITION_NEW_OTHER = 'Neu / Sonstige (s. Artikelbeschreibung)';
MLI18n::gi()->ML_EBAY_CONDITION_NEW_WITH_DEFECTS = 'Neu mit Fehlern';
MLI18n::gi()->ML_EBAY_CONDITION_MANUF_REFURBISHED = 'Vom Hersteller general&uuml;berholt';
MLI18n::gi()->ML_EBAY_CONDITION_CERTIFIED_REFURBISHED = 'Zertifiziert – Refurbished';
MLI18n::gi()->ML_EBAY_CONDITION_EXCELLENT_REFURBISHED = 'Hervorragend – Refurbished';
MLI18n::gi()->ML_EBAY_CONDITION_VERY_GOOD_REFURBISHED = 'Sehr gut – Refurbished';
MLI18n::gi()->ML_EBAY_CONDITION_GOOD_REFURBISHED = 'Gut – Refurbished';
MLI18n::gi()->ML_EBAY_CONDITION_SELLER_REFURBISHED = 'Vom Verk&auml;fer general&uuml;berholt';
MLI18n::gi()->ML_EBAY_CONDITION_AS_NEW = 'Neuwertig';
MLI18n::gi()->ML_EBAY_CONDITION_USED = 'Gebraucht';
MLI18n::gi()->ML_EBAY_CONDITION_VERY_GOOD = 'Gebraucht, sehr gut';
MLI18n::gi()->ML_EBAY_CONDITION_GOOD = 'Gebraucht, gut';
MLI18n::gi()->ML_EBAY_CONDITION_ACCEPTABLE = 'Gebraucht, akzeptabel';
MLI18n::gi()->ML_EBAY_CONDITION_FOR_PARTS_OR_NOT_WORKING = 'Als Ersatzteil / Defekt';

MLI18n::gi()->ML_EBAY_LABEL_NO_INTL_SHIPPING = 'Kein Versand ins Ausland';
MLI18n::gi()->ML_EBAY_LABEL_USE_SUBTITLE_YES_NO = 'Untertitel &uuml;bertragen';
MLI18n::gi()->ML_EBAY_LABEL_USE_GALLERY_YES_NO = 'Galerie-Bild &uuml;bertragen';

MLI18n::gi()->ML_EBAY_LABEL_ATTRIBUTES_FOR = 'Attribute f&uuml;r';
MLI18n::gi()->ML_LABEL_EBAY_PRIMARY_CATEGORY = 'Prim&auml;r-Kategorie';
MLI18n::gi()->ML_LABEL_EBAY_SECONDARY_CATEGORY = 'Sekund&auml;r-Kategorie';
MLI18n::gi()->ML_LABEL_EBAY_STORE_CATEGORY = 'eBay Store Kategorie';
MLI18n::gi()->ML_LABEL_EBAY_ITEM_ID = 'eBay Angebots-Nr.';
MLI18n::gi()->ML_LABEL_EBAY_EPID = 'ePID';
MLI18n::gi()->ML_EBAY_LABEL_PREPARE_KIND = 'Vorbereitungsart';
MLI18n::gi()->ML_LABEL_EBAY_TITLE = 'eBay Titel';
MLI18n::gi()->ML_PRICE_SHOP_PRICE_EBAY = 'Preis Shop / eBay';
MLI18n::gi()->ML_STOCK_SHOP_STOCK_EBAY = 'Bestand: Shop / eBay';
MLI18n::gi()->ML_LAST_SYNC = 'Letzte Synchronisation';
MLI18n::gi()->ML_EBAY_N_PENDING_UPDATES_ESTIMATED_TIME_M = '%s Artikel werden derzeit synchronisiert. Restdauer ca. %s Minuten.';
MLI18n::gi()->ML_LABEL_EBAY_DELETION_REASON = 'Gel&ouml;scht durch';
MLI18n::gi()->ML_SYNCHRONIZATION = 'Lagerabgleich';
MLI18n::gi()->ML_DELETION_BUTTON = 'L&ouml;sch-Button';
MLI18n::gi()->ML_NOT_BY_ML = 'extern (nicht ml)';
MLI18n::gi()->ML_EBAY_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r eBay vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->ML_EBAY_LABEL_PREPARE = 'Vorbereiten';
MLI18n::gi()->ML_EBAY_LABEL_PREPARED = 'Vorbereitete Artikel';
MLI18n::gi()->ML_EBAY_BUTTON_PREPARE = 'Vorbereiten';
MLI18n::gi()->ML_EBAY_BUTTON_UNPREPARE = 'Vorbereitung f&uuml;r komplette Auswahl aufheben';
MLI18n::gi()->ML_EBAY_BUTTON_RESET_DESCRIPTION = 'Vorbereitung f&uuml;r Artikelbeschreibung aufheben';
MLI18n::gi()->ML_EBAY_LABEL_ONLY_NOT_PREPARED = 'Nur Artikel die noch nicht vorbereitet sind';
MLI18n::gi()->ML_EBAY_CATEGORY_PREPARED_NONE = 'Die Kategorie enth&auml;lt keine vorbereitete Artikel';
MLI18n::gi()->ML_EBAY_CATEGORY_PREPARED_FAULTY = 'Die Kategorie enth&auml;lt einige Artikel, deren Vorbereitung gescheitert ist';
MLI18n::gi()->ML_EBAY_CATEGORY_PREPARED_INCOMPLETE = 'Die Kategorie enth&auml;lt einige vorbereitete Artikel';
MLI18n::gi()->ML_EBAY_CATEGORY_PREPARED_ALL = 'Die Kategorie enth&auml;lt nur vorbereitete Artikel';
MLI18n::gi()->ML_EBAY_PRODUCT_MATCHED_NO = 'Das Produkt wurde noch nicht vorbereitet';
MLI18n::gi()->ML_EBAY_PRODUCT_PREPARED_FAULTY = 'Die Vorbereitung des Produkts ist bisher gescheitert';
MLI18n::gi()->ML_EBAY_PRODUCT_PREPARED_OK = 'Das Produkt ist korrekt vorbereitet und kann eingestellt werden';
MLI18n::gi()->ML_EBAY_LISTING_TYPE = 'Art der Auktion';
MLI18n::gi()->ML_EBAY_DURATION = 'Dauer der Auktion';
MLI18n::gi()->ML_EBAY_DURATION_SHORT = 'Laufzeit';
MLI18n::gi()->ML_EBAY_PAYMENT_METHODS = 'Zahlungsarten';
MLI18n::gi()->ML_EBAY_PAYMENT_METHODS_OFFERED = 'Angebotene Zahlungsarten';
MLI18n::gi()->ML_EBAY_ITEM_CONDITION = 'Artikelzustand';
MLI18n::gi()->ML_EBAY_ITEM_CONDITION_INFO = 'Zustand des Artikels (wird in den meisten Kategorien bei eBay angezeigt)';
MLI18n::gi()->ML_EBAY_GALLERY_PICTURES = 'Galerie-Bilder';
MLI18n::gi()->ML_EBAY_ENABLE_GALLERY_PICTURES = 'Galerie-Bilder aktivieren (bei eBay kostenpflichtig)';
MLI18n::gi()->ML_EBAY_LABEL_EBAY_PRICE = 'eBay Preis';
MLI18n::gi()->ML_EBAY_BUYITNOW = 'Sofortkauf';
MLI18n::gi()->ML_EBAY_LABEL_SELECT_CATEGORY = 'Kategorie-Auswahl';
MLI18n::gi()->ML_EBAY_LABEL_SHIPPING_COSTS = 'Versandkosten';
MLI18n::gi()->ML_EBAY_LABEL_EACH_ONE_MORE = 'je weiteren Artikel';
MLI18n::gi()->ML_EBAY_LISTINGTYPE_CHINESE = 'Steigerungsauktion (Chinese)';
MLI18n::gi()->ML_EBAY_LISTINGTYPE_FIXEDPRICEITEM = 'Festpreis';
MLI18n::gi()->ML_EBAY_LISTINGTYPE_STORESFIXEDPRICE = 'Festpreis (eBay Store)';
MLI18n::gi()->ML_EBAY_PRODUCT_DETAILS = 'Artikeldetails';
MLI18n::gi()->ML_EBAY_MAX_80_CHARS = 'Titel max. 80 Zeichen<br />Erlaubte Platzhalter:<br />#BASEPRICE# - Grundpreis';
MLI18n::gi()->ML_EBAY_SUBTITLE = 'Untertitel';
MLI18n::gi()->ML_EBAY_SUBTITLE_MAX_55_CHARS = 'Untertitel max. 55 Zeichen';
MLI18n::gi()->ML_EBAY_CAUSES_COSTS = 'kostenpflichtig';
MLI18n::gi()->ML_EBAY_PICTURE = 'eBay-Bild';
MLI18n::gi()->ML_EBAY_MAIN_PICTURE_COMPLETE_URL = 'Hauptbild (vollst&auml;ndige URL)';
MLI18n::gi()->ML_EBAY_MAIN_GALLERY_PICTURE_CAUSES_COSTS = 'Galerie-Bild (kostenpflichtig)';
MLI18n::gi()->ML_EBAY_DESCRIPTION = 'Beschreibung';
MLI18n::gi()->ML_EBAY_PRODUCTS_DESCRIPTION = 'Produktbeschreibung';
MLI18n::gi()->ML_EBAY_PLACEHOLDERS = 'Verf&uuml;gbare Platzhalter';
MLI18n::gi()->ML_EBAY_ITEM_NAME_TITLE = 'Produktname (Titel)';
MLI18n::gi()->ML_EBAY_ARTNO = 'Artikelnummer';
MLI18n::gi()->ML_EBAY_PRODUCTS_ID = 'Products-ID';
MLI18n::gi()->ML_EBAY_PRICE = 'Preis';
MLI18n::gi()->ML_EBAY_PRICE_FOR_EBAY_SHORT = 'Preis f&uuml;r eBay';
MLI18n::gi()->ML_EBAY_CALCULATED = 'berechnet';
MLI18n::gi()->ML_EBAY_PRICE_CALCULATED = 'Berechneter Preis <small>(gem. Konfig)</small>';
MLI18n::gi()->ML_EBAY_STRIKE_PRICE_CALCULATED = 'Berechneter Streichpreis <small>(gem. Konfig)</small>';
MLI18n::gi()->ML_EBAY_PRICE_FOR_EBAY = 'Preis f&uuml;r eBay';
MLI18n::gi()->ML_EBAY_YOUR_PRICE_IF_OTHER = 'Ihr eBay Preis<br />(falls anders)'; /* deprecated */
MLI18n::gi()->ML_EBAY_FREEZE_PRICE_TOOLTIP = 'Blau = Preis einfrieren (so dass es bei &Auml;nderungen im Shop nicht automatisch angepa&szlig;t wird)';
MLI18n::gi()->ML_EBAY_FREEZE_PRICE = 'Preis einfrieren (dann keine Synchronisierung)'; /* deprecated */
MLI18n::gi()->ML_EBAY_PRICE_FROZEN_TOOLTIP = 'Der Preis wurde bei der Vorbereitung eingefroren und bleibt fest.';
MLI18n::gi()->ML_EBAY_PRICE_CALCULATED_TOOLTIP = 'Der Preis wird je nach Konfigurations-Einstellung berechnet.';
MLI18n::gi()->ML_EBAY_BUYITNOW_PRICE = 'Sofort-Kaufen Preis';
MLI18n::gi()->ML_EBAY_YOUR_CHINESE_PRICE = 'Ihr Start-Preis';
MLI18n::gi()->ML_EBAY_YOUR_FIXED_PRICE = 'Ihr eBay Preis';
MLI18n::gi()->ML_EBAY_YOUR_STRIKE_PRICE = 'Ihr Streichpreis';
MLI18n::gi()->ML_EBAY_PRICE_PER_VPE = 'Preis pro Verpackungseinheit';
MLI18n::gi()->ML_EBAY_SHORTDESCRIPTION_FROM_SHOP = 'Kurzbeschreibung aus dem Shop';
MLI18n::gi()->ML_EBAY_DESCRIPTION_FROM_SHOP = 'Beschreibung aus dem Shop';
MLI18n::gi()->ML_EBAY_FIRST_PIC = 'erstes Produktbild';
MLI18n::gi()->ML_EBAY_MORE_PICS = 'zweites Produktbild; mit #PICTURE3#, #PICTURE4# usw. k&ouml;nnen weitere Bilder &uuml;bermittelt werden, so viele wie im Shop vorhanden.';
MLI18n::gi()->ML_EBAY_AUCTION_SETTINGS = 'Auktionseinstellungen';
MLI18n::gi()->ML_EBAY_SITE = 'eBay-Marktplatz, auf dem Sie einstellen.';
MLI18n::gi()->ML_EBAY_PRIVATE_LISTING_SHORT = 'Privat-Listing';
MLI18n::gi()->ML_EBAY_PRIVATE_LISTING_YES_NO = 'K&auml;ufer / Bieterliste nicht &ouml;ffentlich';
MLI18n::gi()->ML_EBAY_PRIVATE_LISTING = 'Wenn aktiv, kann die K&auml;ufer / Bieterliste nicht von Dritten eingesehen werden';
MLI18n::gi()->ML_EBAY_BESTPRICE_SHORT = 'Preisvorschlag';
MLI18n::gi()->ML_EBAY_BESTPRICE_YES_NO = ' aktivieren (nur f&uuml;r Artikel ohne Varianten)';
MLI18n::gi()->ML_EBAY_BESTPRICE = 'Wenn aktiv, k&ouml;nnen K&auml;ufer eigene Preise vorschlagen';
MLI18n::gi()->ML_EBAY_START_TIME_SHORT = 'Startzeit<br />(falls vorbelegt)';
MLI18n::gi()->ML_EBAY_START_TIME = 'Im Normalfall ist ein eBay-Artikel sofort nach dem Hochladen aktiv. Aber wenn Sie dieses Feld f&uuml;llen, erst ab Startzeit (kostenpflichtig).';
MLI18n::gi()->ML_HITCOUNTER_SHORT = 'Besucherz&auml;hler';
MLI18n::gi()->ML_EBAY_NO_HITCOUNTER = 'Keiner';
MLI18n::gi()->ML_EBAY_BASIC_HITCOUNTER = 'Einfach';
MLI18n::gi()->ML_EBAY_RETRO_HITCOUNTER = 'Retro-Style';
MLI18n::gi()->ML_EBAY_HIDDEN_HITCOUNTER = 'Versteckt';
MLI18n::gi()->ML_EBAY_NOTE_VARIATIONS_ENABLED = '<div class="successBox"><b>Hinweis</b>: F&uuml;r diese Kategorie werden Varianten hochgeladen, soweit erw&uuml;nscht (Konfig-Einstellung) und vorhanden.</div>';
MLI18n::gi()->ML_EBAY_NOTE_VARIATIONS_DISABLED = '<div class="errorBox"><b class="error">Hinweis</b>: F&uuml;r diese Kategorie sieht eBay keine Varianten vor, es werden Varianten als Stammartikel hochgeladen.</div>';
MLI18n::gi()->ML_EBAY_PRICE_FOR_EBAY_LONG = 'Preis zu dem der Artikel bei eBay eingestellt wird';
MLI18n::gi()->ML_EBAY_CATEGORY = 'eBay-Kategorie';
MLI18n::gi()->ML_EBAY_CATEGORY_DESC = 'Die eBay-Kategorie';
MLI18n::gi()->ML_EBAY_PRIMARY_CATEGORY = 'Prim&auml;rkategorie';
MLI18n::gi()->ML_EBAY_SECONDARY_CATEGORY = 'Sekund&auml;rkategorie';
MLI18n::gi()->ML_EBAY_STORE_CATEGORY = 'eBay Store Kategorie';
MLI18n::gi()->ML_EBAY_SECONDARY_STORE_CATEGORY = 'Sekund&auml;re Store Kategorie';
MLI18n::gi()->ML_EBAY_ONLY_B2B_CATS = '<b>Hinweis</b>: Sie haben in der Konfiguration ausgew&auml;hlt, dass Sie nur an Gesch&auml;ftskunden verkaufen wollen. Daher werden nur Kategorien angezeigt, die das erlauben.';
MLI18n::gi()->ML_EBAY_CHOOSE = 'W&auml;hlen';
MLI18n::gi()->ML_EBAY_DELETE = 'L&ouml;schen';
MLI18n::gi()->ML_EBAY_SHIPPING_DOMESTIC = 'Versand Inland';
MLI18n::gi()->ML_EBAY_SHIPPING_DOMESTIC_DESC = 'Angebotene inl&auml;ndische Versandarten';
MLI18n::gi()->ML_EBAY_SHIPPING_INTL_OPTIONAL = 'Versand Ausland (Optional)';
MLI18n::gi()->ML_EBAY_SHIPPING_INTL_DESC = 'Angebotene ausl&auml;ndische Versandarten';
MLI18n::gi()->ML_EBAY_SHIPPING_PROFILE = 'Rabatte Kombizahlung und Versand';
MLI18n::gi()->ML_EBAY_SHIPPING_DISCOUNT = 'Regeln f&uuml;r Versand zum Sonderpreis anwenden';
MLI18n::gi()->ML_EBAY_LABEL_EBAYERROR = 'eBay Fehler %s';

MLI18n::gi()->ML_EBAY_LABEL_CHANGE_SITE = 'eBay Site &auml;ndern';
MLI18n::gi()->ML_EBAY_TEXT_CHANGE_SITE = 'Sie haben eine andere eBay-Site ausgew&auml;hlt. Das wirkt sich auf weitere Optionen auf, da die eBay-L&auml;nderseiten unterschiedliche W&auml;hrungen sowie Zahlungs- und Versandarten anbieten. Soll die neue Einstellung &uuml;bernommen werden?';

MLI18n::gi()->ML_EBAY_LABEL_PROD_INFOS = 'Produkt-Infos aktivieren';
MLI18n::gi()->ML_EBAY_TEXT_SET_PROD_INFOS = 'Die Produkt-Infos k&ouml;nnen nur aktiviert werden wenn auch die EAN &uuml;bergeben wird. EAN-&Uuml;bergabe aktivieren?';

MLI18n::gi()->ML_EBAY_TEXT_REQUEST_TOKEN = 'eBay-Token beantragen';
MLI18n::gi()->ML_ERROR_EBAY_WRONG_TOKEN = 'Einloggen bei eBay nicht m&ouml;glich: eBay-Token ung&uuml;ltig oder nicht vorhanden.';

MLI18n::gi()->ML_EBAY_ERROR_CREATE_TOKEN_LINK_HEADLINE = 'Token Link konnte nicht erzeugt werden';
MLI18n::gi()->ML_EBAY_ERROR_CREATE_TOKEN_LINK_TEXT = 'Es konnte keine Verbindung zu eBay aufgebaut werden. Bitte laden Sie die Seite erneut.<br><br>
            Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';

MLI18n::gi()->ML_EBAY_TEXT_TOKEN_NOT_AVAILABLE_YET = 'Es ist noch kein Token hinterlegt worden, bzw. der Token konnte
            nicht erfolgreich gespeichert werden. Bitte beantragen Sie einen neuen Token.';
MLI18n::gi()->ML_EBAY_TEXT_TOKEN_INVALID = 'Der eBay-Token ist abgelaufen oder ung&uuml;ltig. Bitte beantragen Sie einen neuen eBay-Token.';

MLI18n::gi()->ML_EBAY_TEXT_TOKEN_EXPIRES_AT = 'Der Token ist g&uuml;ltig bis %s ';

MLI18n::gi()->ML_EBAY_BUTTON_TOKEN_NEW = 'Token beantragen / &auml;ndern';

MLI18n::gi()->ML_EBAY_SUBMIT_ADD_TEXT_ZERO_STOCK_ITEMS_REMOVED = 'Artikel ohne Lagerbestand wurden ausgelassen.';

/* Status-Aenderung bei Bestellungen */
MLI18n::gi()->ML_EBAY_ORDER_PAID = 'magnalister-Verarbeitung:\nZahlung bei eBay eingegangen.';

/* Laendernamen (fuer eBay, vllt spaeter auch fuer andere */
MLI18n::gi()->ML_COUNTRY_AUSTRALIA = 'Australien';
MLI18n::gi()->ML_COUNTRY_AUSTRIA = '&Ouml;sterreich';
MLI18n::gi()->ML_COUNTRY_BELGIUM_DUTCH = 'Belgien (fl&auml;misch)';
MLI18n::gi()->ML_COUNTRY_BELGIUM_FRENCH = 'Belgien (franz&ouml;sisch)';
MLI18n::gi()->ML_COUNTRY_CANADA = 'Kanada';
MLI18n::gi()->ML_COUNTRY_CANADA_FRENCH = 'Kanada (franz&ouml;sisch)';
MLI18n::gi()->ML_COUNTRY_CHINA = 'China';
MLI18n::gi()->ML_COUNTRY_FRANCE = 'Frankreich';
MLI18n::gi()->ML_COUNTRY_GERMANY = 'Deutschland';
MLI18n::gi()->ML_COUNTRY_HONGKONG = 'Hongkong';
MLI18n::gi()->ML_COUNTRY_INDIA = 'Indien';
MLI18n::gi()->ML_COUNTRY_IRELAND = 'Irland';
MLI18n::gi()->ML_COUNTRY_ITALY = 'Italien';
MLI18n::gi()->ML_COUNTRY_MALAYSIA = 'Malaysien';
MLI18n::gi()->ML_COUNTRY_NETHERLANDS = 'Niederlande';
MLI18n::gi()->ML_COUNTRY_PHILIPPINES = 'Philippinen';
MLI18n::gi()->ML_COUNTRY_POLAND = 'Polen';
MLI18n::gi()->ML_COUNTRY_SINGAPORE = 'Singapur';
MLI18n::gi()->ML_COUNTRY_SPAIN = 'Spanien';
MLI18n::gi()->ML_COUNTRY_SWEDEN = 'Schweden';
MLI18n::gi()->ML_COUNTRY_SWITZERLAND = 'Schweiz';
MLI18n::gi()->ML_COUNTRY_TAIWAN = 'Taiwan';
MLI18n::gi()->ML_COUNTRY_UK = 'Vereinigtes K&ouml;nigreich Gro&szlig;britannien';
MLI18n::gi()->ML_COUNTRY_USA = 'Vereinigte Staaten von Amerika';
MLI18n::gi()->ML_COUNTRY_PORTUGAL = 'Portugal';
MLI18n::gi()->ML_EBAY_SITE_MOTORS = 'eBay Motors';


/* Kaufland.de */
MLI18n::gi()->ML_HITMEISTER_SAME_PRODUCT_THERE = 'Dieser Artikel bei Kaufland.de';
MLI18n::gi()->ML_HITMEISTER_LABEL_HITMEISTER_PRICE = 'Mein Kaufland.de Preis';
MLI18n::gi()->ML_HITMEISTER_LABEL_ORDER_ID = 'Kaufland.de-Bestellnummer';


/* MeinPaket.de */
MLI18n::gi()->ML_MEINPAKET_CATEGORY_MATCHING = 'Kategorie Matching';

MLI18n::gi()->ML_MEINPAKET_LABEL_CATMATCH_NOT_PREPARED = 'Nicht vorbereitet';
MLI18n::gi()->ML_MEINPAKET_LABEL_CATMATCH_PREPARE_COMPLETE = 'Vollst&auml;ndig';
MLI18n::gi()->ML_MEINPAKET_LABEL_CATMATCH_PREPARE_INCOMPLETE = 'Unvollst&auml;ndig';
MLI18n::gi()->ML_MEINPAKET_CATEGORYMATCHING_ASSIGN_MP_CAT = 'Meinpaket Kategorie zuweisen';
MLI18n::gi()->ML_MEINPAKET_CATEGORYMATCHING_ASSIGN_SHOP_CAT = 'Meinpaket-Shop Kategorie zuweisen';
MLI18n::gi()->ML_MEINPAKET_LABEL_CATEGORY = 'Meinpaket Kategorie';
MLI18n::gi()->ML_MEINPAKET_LABEL_PREPARED = 'Vorbereitet';
MLI18n::gi()->ML_MEINPAKET_LABEL_MP_PRICE_SHORT = 'Mein MeinPaket Preis';
MLI18n::gi()->ML_MEINPAKET_LABEL_MEINPAKETID = 'MeinPaketID';
MLI18n::gi()->ML_MEINPAKET_LABEL_ORDER_ID = 'MeinPaket-Bestellnummer';
MLI18n::gi()->ML_MEINPAKET_ERROR_ACCESS_DENIED = 'Die Zugangsdaten zum MeinPaket.de-Admin scheinen nicht zu stimmen: Der
            magnalister-Server kann mit den Zugangsdaten keine Verbindung herstellen.
            Bitte &uuml;berpr&uuml;fen Sie die bei der Konfiguration hinterlegten Zugangsdaten und
            korrigieren Sie diese gegebenenfalls.';

/* MagnaCompat */
MLI18n::gi()->ML_MAGNACOMPAT_CATEGORYMATCHING_ASSIGN_MP_CAT = 'Marktplatz Kategorie zuweisen';
MLI18n::gi()->ML_MAGNACOMPAT_LABEL_CATEGORY = 'Marktplatz Kategorie';
MLI18n::gi()->ML_MAGNACOMPAT_LABEL_PREPARED = 'Vorbereitet';
MLI18n::gi()->ML_MAGNACOMPAT_LABEL_MP_PRICE_SHORT = 'Mein Marktplatz Preis';
MLI18n::gi()->ML_MAGNACOMPAT_LABEL_MP_ITEMID = 'Marktplatz ID';
MLI18n::gi()->ML_MAGNACOMPAT_ERROR_ACCESS_DENIED = 'Die Zugangsdaten zu %s scheinen nicht zu stimmen: Der
            magnalister-Server kann mit den Zugangsdaten keine Verbindung herstellen.
            Bitte &uuml;berpr&uuml;fen Sie die bei der Konfiguration hinterlegten Zugangsdaten und
            korrigieren Sie diese gegebenenfalls.';

/* Laary */
MLI18n::gi()->ML_LAARY_ERROR_NO_REGION_SELECTED = 'Bitte w&auml;hlen Sie in der Konfiguration mindestens eine Einstellregion aus.';

/* Internal Stuff */
MLI18n::gi()->ML_INTERNAL_EMPTY_RESPONSE = 'Antwort von magnalister-Servern ohne Inhalt. Bitte wenden Sie sich an unseren Support.';
MLI18n::gi()->ML_INTERNAL_INVALID_RESPONSE = 'Antwort von magnalister-Servern ung&uuml;ltig. Bitte wenden Sie sich an unseren Support.';
MLI18n::gi()->ML_INTERNAL_API_CALL_UNSUCCESSFULL = 'Keine Antwort von magnalister-Schnittstelle. Bitte wenden Sie sich an unseren Support.';
MLI18n::gi()->ML_INTERNAL_API_TIMEOUT = 'Die erlaubte Ausf&uuml;hrungszeit der Funktion wurde &uuml;berschritten. Bitte versuchen Sie es in wenigen Minuten erneut.';

MLI18n::gi()->ML_RATE_FREETRIAL = 'Testzeitraum';
MLI18n::gi()->ML_RATE_ROOKIE = 'Rookie';
MLI18n::gi()->ML_RATE_BUSINESS2 = 'Business 2';
MLI18n::gi()->ML_RATE_BUSINESS12 = 'Business 12';
MLI18n::gi()->ML_RATE_ULTIMATE2 = 'Ultimate 2';
MLI18n::gi()->ML_RATE_ULTIMATE12 = 'Ultimate 12';
MLI18n::gi()->ML_RATE_FLAT2 = 'Flat 2';
MLI18n::gi()->ML_RATE_FLAT12 = 'Flat 12';
MLI18n::gi()->{'ML_RATE_ENTERPRISE'} = 'Enterprise';

MLI18n::gi()->ML_RATE_SWITCH = '%s &ndash; g&uuml;ltig bis %s. Danach beantragte Umstellung auf Tarif %s.';
MLI18n::gi()->ML_RATE_SWITCH_TRIAL = 'Testzeitraum bis zum %s. Tarif nach Testzeitraum: %s';
MLI18n::gi()->ML_RATE_END = '%s. Vertrag zum %s gek&uuml;ndigt.';
MLI18n::gi()->ML_RATE_CONTINUE = '%s';

/* topten */
MLI18n::gi()->ML_TOPTEN_MANAGE = 'verwalten';
MLI18n::gi()->ML_TOPTEN_MANAGE_HEAD = 'Kategorie-Schnellauswahl verwalten';
MLI18n::gi()->ML_TOPTEN_INIT_HEAD = 'Initialisieren';
MLI18n::gi()->ML_TOPTEN_INIT_DESC = 'Um eine leere Kategorie-Schnellauswahl aus bereits vorbereiteten Artikeln zu füllen, klicken Sie bitte auf den Button "Initialisieren"';
MLI18n::gi()->ML_TOPTEN_INIT_INFO = 'Schnellauswahl-Kateogrien wurde initialisiert';
MLI18n::gi()->ML_TOPTEN_DELETE_HEAD = 'L&ouml;schen';
MLI18n::gi()->ML_TOPTEN_DELETE_DESC = 'Markieren Sie mehrere Einträge indem Sie STRG gedr&uuml;ckt halten.';
MLI18n::gi()->ML_TOPTEN_DELETE_INFO = 'Schnellauswahl-Kateogrien wurden gelöscht';
MLI18n::gi()->ML_TOPTEN_TEXT = 'Schnellauswahl-Kateogrien';

MLI18n::gi()->ML_DAWANDA_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r DaWanda vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';

MLI18n::gi()->ML_MERCADOLIVRE_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r MercadoLivre vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';

MLI18n::gi()->ML_CHECK24_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r Check24 vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';

MLI18n::gi()->ML_TRADORIA_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r Rakuten vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';

MLI18n::gi()->ML_RICARDO_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r Ricardo vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->ML_RICARDO_LABEL_LAST_REPORT = 'Letzter Bericht von Ricardo';
MLI18n::gi()->ML_RICARDO_TEXT_CHECKIN_DELAY = 'Bitte beachten Sie, dass es bis zu zwei Stunden dauern kann bis Einstell- und L&ouml;schvorg&auml;nge
        vollst&auml;ndig von Ricardo verarbeitet werden.';
MLI18n::gi()->ML_RICARDO_PRODUCTS_NOT_SYNCRONIZED = 'Der Marktplatz verarbeitet nun ihre Daten und pr&uumlft auf inhaltliche Fehler. Bitte pr&uumlfen Sie nach ca. 30 Minuten den Reiter "Fehlerlog" auf eventuelles Feedback.<br>Bitte beachten Sie außerdem, dass auf ricardo.ch Angebots- und Lager-Limits gelten. Sie dürfen nicht mehr als 100 aktive Angebote gleichzeitig auf ricardo.ch veröffentlichen und der Lagerbestand eines Artikels darf 999 Stück nicht überschreiten. Bitte prüfen Sie das Fehlerlog sowie Ihren ricardo-Account auf entsprechende Hinweise zur Überschreitung der Limits';

MLI18n::gi()->ML_HITMEISTER_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r Kaufland.de vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';
MLI18n::gi()->ML_HITMEISTER_LABEL_LAST_REPORT = 'Letzter Bericht von Kaufland.de';
MLI18n::gi()->ML_HITMEISTER_TEXT_CHECKIN_DELAY = 'Bitte beachten Sie, dass es bis zu zwei Stunden dauern kann bis Einstell- und L&ouml;schvorg&auml;nge
        vollst&auml;ndig von Kaufland.de verarbeitet werden.';
MLI18n::gi()->ML_HITMEISTER_PRODUCTS_NOT_SYNCRONIZED = 'Der Marktplatz verarbeitet nun ihre Daten und pr&uumlft auf inhaltliche Fehler. Bitte pr&uumlfen Sie nach ca. 30 Minuten den Reiter "Fehlerlog" auf eventuelles Feedback.';
MLI18n::gi()->sMessageCannotLoadResource = 'CSS und JavaScript Dateien können nicht geladen werden. Bitte führen Sie ein <a style="text-decoration: underline;" onclick="jqml(\'a[data-ml-modal=#ml-modal_updatePlugin]\').trigger(\'click\')">magnalister-Update</a> durch, damit das Plugin richtig dargestellt wird.';
MLI18n::gi()->ML_PRICEMINISTER_TEXT_CHECKIN_DELAY = 'Bitte beachten Sie, dass es bis zu zwei Stunden dauern kann bis Einstell- und L&ouml;schvorg&auml;nge
            vollst&auml;ndig von Amazon verarbeitet werden.';
MLI18n::gi()->ML_PRICEMINISTER_LABEL_LAST_REPORT = 'Letzter Bericht von PriceMinister';
MLI18n::gi()->ML_CDISCOUNT_TEXT_NO_MATCHED_PRODUCTS = 'Es sind noch keine Produkte f&uuml;r Cdiscount vorbereitet worden. Bevor Sie Produkte hier hochladen k&ouml;nnen, m&uuml;ssen Sie diese unter dem Reiter "Produkte vorbereiten" bearbeiten.<br>
        Falls Sie an der Stelle Artikel vermissen sollten, die Sie bereits vorbereitet haben, &uuml;berpr&uuml;fen Sie, ob diese ggf. auf Inaktiv gesetzt sind und Sie die Konfiguration entsprechend eingestellt haben.';

MLI18n::gi()->ML_LABEL_CHANGELOG_ITEMS = 'Einträge';
MLI18n::gi()->ML_LABEL_CHANGELOG_THEMA = 'Thema';
MLI18n::gi()->ML_LABEL_CHANGELOG_PROJECT = 'Projekt';
MLI18n::gi()->ML_LABEL_CHANGELOG_REVISION = 'Revision';
MLI18n::gi()->ML_LABEL_CHANGELOG_DATE = 'Datum';

MLI18n::gi()->ML_LABEL_DONTSHOWAGAIN = 'Diesen Hinweis nicht mehr anzeigen';

MLI18n::gi()->ML_ETSY_LABEL_LISTINGID = 'Etsy Artikel Nummer';
MLI18n::gi()->ML_ETSY_TEXT_CHECKIN_DELAY = 'Bitte beachten Sie, dass es bis zu zehn Minuten dauern kann bis Einstell- und L&ouml;schvorg&auml;nge vollst&auml;ndig von Etsy verarbeitet werden.';
MLI18n::gi()->ML_ETSY_BUTTON_SAVE_SHIPPING_TEMPLATE = 'Versandgruppe erstellen';
MLI18n::gi()->ML_ETSY_ERROR_CREATE_TOKEN_LINK_TEXT = 'Es konnte keine Verbindung zu Etsy aufgebaut werden. Bitte laden Sie die Seite erneut.<br><br>Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';;
MLI18n::gi()->ML_ETSY_ERROR_CREATE_TOKEN_LINK_HEADLINE = 'Token Link konnte nicht erzeugt werden';
MLI18n::gi()->ML_ETSY_BUTTON_TOKEN_NEW = 'Token beantragen / &auml;ndern';
MLI18n::gi()->ML_GOOGLESHOPPING_BUTTON_TOKEN_NEW = 'Token beantragen / &auml;ndern';

MLI18n::gi()->ML_RICARDO_ERROR_CREATE_TOKEN_LINK_TEXT = 'Es konnte keine Verbindung zu ricardo.ch aufgebaut werden. Bitte laden Sie die Seite erneut.<br><br>Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';
MLI18n::gi()->ML_RICARDO_ERROR_CREATE_TOKEN_LINK_HEADLINE = 'Token Link konnte nicht erzeugt werden';
MLI18n::gi()->ML_RICARDO_BUTTON_TOKEN_NEW = 'Token beantragen / &auml;ndern';
MLI18n::gi()->ML_RICARDO_TEXT_TOKEN_EXPIRES_AT = 'Der Token ist g&uuml;ltig bis %s';
MLI18n::gi()->ML_RICARDO_TEXT_TOKEN_NOT_AVAILABLE_YET = 'Es ist noch kein Token hinterlegt worden, bzw. der Token konnte nicht erfolgreich gespeichert werden. Bitte beantragen Sie einen neuen Token.';
MLI18n::gi()->ML_RICARDO_TEXT_TOKEN_INVALID = 'Der ricardo.ch-Token ist abgelaufen oder ung&uuml;ltig. Bitte beantragen Sie einen neuen ricardo.ch-Token.';
MLI18n::gi()->ML_LABEL_METRO_ID = 'METRO ID';
MLI18n::gi()->ML_MESSAGE_BEFORE_IMPORT_ORDERS_TEXT = 'Es werden nun alle verfügbaren Marktplatz-Bestellungen in den Webshop importiert. Der Prozess dauert 1-5 Minuten.<br>Der Vorgang läuft zusätzlich automatisch in 30-60 Minuten Intervallen im Hintergrund.';
MLI18n::gi()->ML_MESSAGE_BEFORE_IMPORT_ORDERS_TITLE = 'Bestellimport';
MLI18n::gi()->ML_MESSAGE_BEFORE_SYNC_ORDERSTATUS_TEXT = 'Es werden nun alle verfügbaren Bestellstatus vom Webshop zu den Marktplätzen übermittelt. Der Prozess dauert 3-10 Minuten.<br>Der Vorgang läuft zusätzlich automatisch in 30-60 Minuten Intervallen im Hintergrund.';
MLI18n::gi()->ML_MESSAGE_BEFORE_SYNC_ORDERSTATUS_TITLE = 'Bestellstatus Synchronisation';
MLI18n::gi()->ML_MESSAGE_BEFORE_SYNC_INVENTORY_TEXT = 'Es werden nun alle verfügbaren Preise und Lagermengen vom Webshop zu den Marktplätzen übermittelt. Der Prozess dauert in der Regel 1-120 Minuten und öffnet ein Protokollfenster.<br>Der Vorgang läuft zusätzlich in 4 Stunden Intervallen im Hintergrund.';
MLI18n::gi()->ML_MESSAGE_BEFORE_SYNC_INVENTORY_TITLE = 'Preis- und Lagerabgleich';
MLI18n::gi()->ML_MESSAGE_BEFORE_SYNC_ProductIdentifier_TITLE = 'EAN- und MPN Synchronisation';
MLI18n::gi()->ML_MESSAGE_BEFORE_SYNC_ProductIdentifier_TEXT = 'Es werden nun alle verfügbaren EAN und MPN vom Webshop zu eBay synchronisiert. Der Prozess dauert in der Regel 30-120 Minuten und läuft im Hintergrund.';

// Currency Matching Popup Box
MLI18n::gi()->ML_CHECKCURRENCY_POPUP_TITLE = 'Zustimmung zur automatischen Währungsumrechnung';
MLI18n::gi()->ML_CHECKCURRENCY_POPUP_TEXT = 'Sie sind dabei, einen Marktplatz zu verbinden, auf dem Produkte in einer Währung angezeigt werden, die von der in WooCommerce eingestellten Währung abweicht.<br>
<br>
Beispiel:<br>
In WooCommerce hinterlegt: Währung Euro<br>
Verkaufswährung auf dem Marktplatz: US-Dollar<br>
<br>
Damit die Preise Ihrer auf dem Marktplatz hochgeladenen Produkte in der richtigen Währung angezeigt werden, wandelt magnalister mithilfe externer Währungsumrechner die Preise automatisch um. Hierzu greifen wir auf den Dienst “alphavantage” zurück.<br>
<br>
Stimmen Sie bitte der automatischen Währungsumrechnung zu, um diese zu nutzen. Weitere Informationen finden Sie auch unter “Konfiguration” -> “Preisberechnung” -> “Wechselkurs”.
';
MLI18n::gi()->ML_CHECKCURRENCY_INFO = '1 %s entspricht %.4f %s (zuletzt aktualisiert: %s Uhr)';

MLI18n::gi()->ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP = 'Immer aktuell aus Web-Shop verwenden';
MLI18n::gi()->ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_CONFIGURATION = 'Immer aktuell aus Konfiguration übernehmen';

// hovertexts
MLI18n::gi()->ML_DUPLICATE_INFO = "Bitte speichern Sie die Konfiguration / Vorbereitung bevor Sie Zeilen hinzufügen oder entfernen";

MLI18n::gi()->ML_BUTTON_TOKEN_NEW = 'Token beantragen / &auml;ndern';
MLI18n::gi()->ML_ERROR_CREATE_TOKEN_LINK_HEADLINE = 'Fehler beim Herstellen der Verbindung zu {#setting:currentMarketplaceName#}';
MLI18n::gi()->ML_ERROR_CREATE_TOKEN_LINK_TEXT = 'Es konnte keine Verbindung zu {#setting:currentMarketplaceName#} aufgebaut werden. Bitte versuchen Sie es zu einem späteren Zeitpunkt erneut.<br><br>Sollte der Fehler wiederholt auftreten, setzen Sie sich mit dem magnalister-Support in Verbindung.';
