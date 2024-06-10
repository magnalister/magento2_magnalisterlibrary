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
MLI18n::gi()->{'UploadInvoice_Error_PathNotExists'} = 'Attention, le chemin d’accès serveur "{#ConfigPath#}" n’existe pas. Vérifiez s’il vous plaît le chemin d’accès sélectionné pour les factures et les avoirs dans la configuration de la place de marché {#setting:currentMarketplaceName#} sous "{#ConfigFieldLabel#}.';
MLI18n::gi()->{'UploadInvoice_Error_MultipleReceiptsForOneOrder'} = 'Attention, pour le/la "{#ConfigFieldLabel#}" il existe un doublon d’une facture ou d’un avoir (N° de commande : {#ShopOrderId#}). Merci d’effacer le doublon correspondant.';
MLI18n::gi()->{'UploadInvoice_Error_NoReceiptsForOneOrder'} = 'Attention, il n’existe pas de facture ou d’avoir dans le/la "{#ConfigFieldLabel#}" correspondant au numéro de commande : {#ShopOrderId#}. magnalister ne peut pas associer de facture/d’avoir à la commande ni la transmettre à {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'UploadInvoice_Error_MoveToDestinationDirectory_Failed'} = 'La facture/l’avoir "{#ReceiptFileName#}" n’a pas pu être placé(e) dans le répertoire de destination sur le serveur ({#ConfigDestinationPath#}). Vérifiez s’il vous plaît les droits en lecture et en écriture pour les répertoires et les fichiers correspondants sur votre serveur !';


MLI18n::gi()->{'UploadInvoice_Error_PathNotExists'} = 'Attention, le chemin d’accès serveur "{#ConfigPath#}" n’existe pas. Vérifiez s’il vous plaît le chemin d’accès sélectionné pour les factures et les avoirs dans la configuration de la place de marché {#setting:currentMarketplaceName#} sous "{#ConfigFieldLabel#}.';
MLI18n::gi()->{'UploadInvoice_Error_NoReceiptsForOneOrder'} = 'Attention, il n’existe pas de facture ou d’avoir dans le/la "{#ConfigFieldLabel#}" correspondant au numéro de commande : {#ShopOrderId#}. magnalister ne peut pas associer de facture/d’avoir à la commande ni la transmettre à {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'UploadInvoice_Error_MultipleReceiptsForOneOrder'} = 'Attention, pour le/la "{#ConfigFieldLabel#}" il existe un doublon d’une facture ou d’un avoir (N° de commande : {#ShopOrderId#}). Merci d’effacer le doublon correspondant.';
MLI18n::gi()->{'UploadInvoice_Error_MoveToDestinationDirectory_Failed'} = 'La facture/l’avoir "{#ReceiptFileName#}" n’a pas pu être placé(e) dans le répertoire de destination sur le serveur ({#ConfigDestinationPath#}). Vérifiez s’il vous plaît les droits en lecture et en écriture pour les répertoires et les fichiers correspondants sur votre serveur !';
