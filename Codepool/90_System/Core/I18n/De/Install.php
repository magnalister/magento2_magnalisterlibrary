<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLI18n::gi()->ML_TEXT_UPDATE_SUCCESS = '
    Das Update wurde erfolgreich durchgef&uuml;hrt. Eine Liste der wichtigsten &Auml;nderungen k&ouml;nnen Sie im 
    <a href="{#url#}" title="Change-Log">Change-Log</a> einsehen.
';
MLI18n::gi()->ML_TEXT_INSTALL_SUCCESS = 'magnalister wurde erfolgreich installiert.';

MLI18n::gi()->sModal_updatePlugin_title = 'magnalister-Plugin wird aktualisiert.';
MLI18n::gi()->sModal_updatePlugin_content_init = 'Es werden Dateien vom magnalister Server runtergeladen.';
MLI18n::gi()->sModal_updatePlugin_content_calcSequences = 'Es werden Dateien vom magnalister Server runtergeladen.';
MLI18n::gi()->sModal_updatePlugin_content_copyFilesToStaging = 'Dateien werden extrahiert.';
MLI18n::gi()->sModal_updatePlugin_content_addIndexPhp = 'Dateien werden extrahiert.';
MLI18n::gi()->sModal_updatePlugin_content_finalizeUpdate = 'Plugin wird aktualisiert.';
MLI18n::gi()->sModal_updatePlugin_content_afterUpdate = 'Datenbank wird vorbereitet.';
MLI18n::gi()->sModal_updatePlugin_content_success = 'Update ist abgeschlossen.';

MLI18n::gi()->sModal_installPlugin_title = 'magnalister-Plugin wird installiert.';
MLI18n::gi()->sModal_installPlugin_content_init = 'Es werden Dateien vom magnalister Server runtergeladen.';
MLI18n::gi()->sModal_installPlugin_content_calcSequences = 'Es werden Dateien vom magnalister Server runtergeladen.';
MLI18n::gi()->sModal_installPlugin_content_copyFilesToStaging = 'Dateien werden extrahiert.';
MLI18n::gi()->sModal_installPlugin_content_addIndexPhp = 'Dateien werden extrahiert.';
MLI18n::gi()->sModal_installPlugin_content_finalizeUpdate = 'Plugin wird installiert.';
MLI18n::gi()->sModal_installPlugin_content_afterUpdate = 'Datenbank wird vorbereitet.';
MLI18n::gi()->sModal_installPlugin_content_success = 'Die magnalister Erstinstallation ist abgeschlossen.';

MLI18n::gi()->sModal_afterUpdatePlugin_content = 'Die Datenbank wird aktualisiert'; // title is installPlugin

MLI18n::gi()->ML_TEXT_GENERIC_SAFE_MODE = '
    Auf Ihrem System ist die Safe-Mode Beschr&auml;nkung aktiviert.<br/><br/>
    Um den magnalister manuell zu aktualisieren, laden Sie sich bitte die aktuelle Version auf der 
    <a href="{#setting:sPublicUrl#}" title="magnalister Seite">magnalister Seite</a> herunter, und kopieren Sie das Verzeichnis 
    <i>files/</i> aus dem Archiv in das  Wurzelverzeichnis Ihres Shops. Kontaktieren Sie alternativ Ihren Server-Administrator 
    und bitten Sie ihn, den Safe-Mode dauerhaft abzuschalten, um das Update per Knopfdruck auszuf&uuml;hren.<br /><br />
    Wenn Sie w&uuml;nschen, k&ouml;nnen wir Ihnen das manuelle Update f&uuml;r eine Unkostenpauschale aufspielen (siehe 
    <a href="{#setting:sPublicUrl#}frontend/installation_pricing.php" title="magnalister Seite">Preisliste</a>).
';
MLI18n::gi()->sException_update_misc = '
    Das magnalister-Plugin l&auml;sst sich nicht automatisch updaten.<br/><br/>
    Um den magnalister manuell zu aktualisieren, laden Sie sich bitte die aktuelle Version auf der 
    <a href="{#setting:sPublicUrl#}" title="magnalister Seite">magnalister Seite</a> herunter, und kopieren Sie das Verzeichnis 
    <i>files/</i> aus dem Archiv in das  Wurzelverzeichnis Ihres Shops.
    Wenn Sie w&uuml;nschen, k&ouml;nnen wir Ihnen das manuelle Update f&uuml;r eine Unkostenpauschale aufspielen (siehe 
    <a href="{#setting:sPublicUrl#}frontend/installation_pricing.php" title="magnalister Seite">Preisliste</a>).
';
MLI18n::gi()->sNotUpdateable_title = 'Update fehlgeschlagen';
MLI18n::gi()->ML_ERROR_CANNOT_CONNECT_TO_SERVICE_LAYER_HEADLINE = 'Fehler bei Anfrage an den magnalister-Service Layer';
MLI18n::gi()->ML_ERROR_CANNOT_CONNECT_TO_SERVICE_LAYER_TEXT = '
    Der magnalister-Service-Layer ist entweder nicht erreichbar oder die 
    Anfrage schlug fehl. Sollte der Fehler weiterhin bestehen wenden Sie sich bitte an den Support von https://www.magnalister.com/de/kontaktieren-sie-uns/.
';
MLI18n::gi()->sMagnalisterRemoteServer = 'magnalister Server';

MLI18n::gi()->sUpdateError_doAgain = '
    Klicken Sie <a class="global-ajax" data-ml-global-ajax=\'{"triggerAfterSuccess":"currentUrl"}\' onclick="jqml(\'.ml-js-modalPushMessages>*\').remove();jqml(this).parent().hide();return true;" href="{#link#}">hier</a>, um es nochmal zu versuchen.<br />
    Falls das Problem bestehen bleibt, kontaktieren Sie bitte den <a href="https://www.magnalister.com/de/kontaktieren-sie-uns/" class="ml-js-noBlockUi" target="_blank">magnalister-Service</a>.
';
MLI18n::gi()->sException_update_notEnoughDiskSpace = 'Es steht nicht gen&uuml;gend Festplattenspeicher zur Verf&uuml;gung.';
MLI18n::gi()->sException_update_cantCreateFolder = 'Das Verzeichnis `{#path#}` kann nicht anlegt werden.';
MLI18n::gi()->sException_update_insufficientFilesCount = 'Beim Erstellen der Update-Liste ist ein Fehler aufgetreten.';
MLI18n::gi()->sException_update_wrongMethodParameter = 'Es ist ein Fehler aufgetreten.';
MLI18n::gi()->sException_update_pathNotExists = 'Der Pfad `{#path#}` kann nicht <strong>angelegt</strong> / ge&auml;ndert werden. Bitte setzen Sie Schreibrechte auf 775 oder 777.';
MLI18n::gi()->sException_update_pathNotWriteable = 'Der Pfad `{#path#}` kann nicht <strong>angelegt</strong> / ge&auml;ndert werden. Bitte setzen Sie Schreibrechte auf 775 oder 777.';
MLI18n::gi()->sException_update_pathNotReadable = 'Pfad `{#path#}` ist nicht lesbar.';
MLI18n::gi()->sException_update_cantDeleteFolder = 'Verzeichnis `{#path#}` kann nicht gel&ouml;scht werden.';
MLI18n::gi()->sException_update_cantCopyFile = 'Die Datei `{#srcPath#}` nach `{#dstPath#}` kopiert werden.';
MLI18n::gi()->sException_update_cantRenameFolder = 'Kann Verzeichnis `{#srcPath#}` nach `{#dstPath#}` wegen fehlenden Schreibrechte nicht verschieben.';
MLI18n::gi()->sException_update_cantDeleteFile = 'Die Datei `{#path#}` kann nicht gel&ouml;scht werden.';
MLI18n::gi()->sException_update_pathOutsideRoot = 'Pfad `{#path#}` ist ausserhalb des Dateisystems.';

MLI18n::gi()->{'installation_content_title'} = 'magnalister wird aktuell installiert. Und dann?';
MLI18n::gi()->{'installation_content_freetest_url'} = 'http://www.magnalister.com/de/kostenlos-testen/';
MLI18n::gi()->{'installation_content_firststep'} = 'Speichern Sie die PassPhrase, die Sie nach Registrierung und Aktivierung per E-Mail erhalten, unter "Globale Konfiguration".';
MLI18n::gi()->{'installation_content_notcutomer'} = 'Noch kein Kunde?';
MLI18n::gi()->{'installation_content_secondstep'} = 'W&auml;hlen Sie einen Marktplatzreiter und vervollst&auml;ndigen Sie die Konfiguration. <a style="pointer-events: none;">Die Info-Icons in der Konfiguration geben wertvolle Hinweise</a>';
MLI18n::gi()->{'installation_content_thirdstep'} = 'Marktpl&auml;tze haben viele Regeln. Nutzen Sie unseren Support und Bildschirmhilfe, falls Sie nicht weiterkommen!';
MLI18n::gi()->{'installation_content_help'} = 'Hilfe anfordern';
MLI18n::gi()->{'installation_content_help_url'} = 'http://www.magnalister.com/de#support';
MLI18n::gi()->{'installation_content_fourthstep'} = 'Verkaufe von jetzt an spielend einfach auf einer Vielzahl der wichtigsten Marktpl&auml;tze weltweit!';
