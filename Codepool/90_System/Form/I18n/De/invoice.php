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
MLI18n::gi()->{'UploadInvoice_Error_PathNotExists'} = 'Achtung der Server-Pfad "{#ConfigPath#}" existiert nicht. Bitte überprüfen Sie den in der {#setting:currentMarketplaceName#} Marktplatz Konfiguration unter "{#ConfigFieldLabel#}" ausgewählten Server-Pfad für die Rechnungen bzw. Gutschriften.';
MLI18n::gi()->{'UploadInvoice_Error_MultipleReceiptsForOneOrder'} = 'Achtung für den/die "{#ConfigFieldLabel#}" besteht eine Rechnungs- bzw. Gutschrift-Dublette (Shop-Bestell-Id: {#ShopOrderId#}). Bitte löschen Sie die Dublette entsprechend.';
MLI18n::gi()->{'UploadInvoice_Error_NoReceiptsForOneOrder'} = 'Achtung in dem/den "{#ConfigFieldLabel#}" existiert keine Rechnung bzw. Gutschrift zu Shop-Bestell-Id: {#ShopOrderId#}. magnalister kann der Shop-Bestellung daher keine Rechnung / Gutschrift zuordnen und an {#setting:currentMarketplaceName#} übermitteln.';
MLI18n::gi()->{'UploadInvoice_Error_MoveToDestinationDirectory_Failed'} = 'Die Rechnung / Gutschrift "{#ReceiptFileName#}" konnte nicht in den Ziel-Ordner auf dem Server ({#ConfigDestinationPath#}) verschoben werden. Bitte prüfen Sie die Schreib- und Leserechte für entsprechende Ordner und Dateien auf Ihrem Server!';


