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
MLI18n::gi()->{'UploadInvoice_Error_PathNotExists'} = 'Warning: The server path "{#ConfigPath#}" does not exist. Please check the server path for the invoices or credit notes selected in the {#setting:currentMarketplaceName#} Marketplace configuration under "{#ConfigFieldLabel#}.';
MLI18n::gi()->{'UploadInvoice_Error_MultipleReceiptsForOneOrder'} = 'Warning: For the "{#ConfigFieldLabel#}" there is an invoice or credit note duplicate (shop order id: {#ShopOrderId#}). Please delete the duplicate accordingly.';
MLI18n::gi()->{'UploadInvoice_Error_NoReceiptsForOneOrder'} = 'Warning: In the "{#ConfigFieldLabel#}"(s) there is no invoice or credit note for shop order id: {#ShopOrderId#}. magnalister can therefore not assign an invoice / credit note to the store order and transmit it to {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'UploadInvoice_Error_MoveToDestinationDirectory_Failed'} = 'The invoice / credit note "{#ReceiptFileName#}" could not be moved to the destination folder on the server ({#ConfigDestinationPath#}). Please check the write and read permissions for corresponding folders and files on your server!';


