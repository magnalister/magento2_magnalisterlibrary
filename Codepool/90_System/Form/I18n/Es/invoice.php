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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLI18n::gi()->{'UploadInvoice_Error_PathNotExists'} = 'Atención: La ruta del servidor "{#ConfigPath#}" no existe. Comprueba la ruta del servidor para las facturas o notas de crédito seleccionadas en la configuración del marketplace {#setting:currentMarketplaceName#} en {#ConfigFieldLabel#}.';
MLI18n::gi()->{'UploadInvoice_Error_NoReceiptsForOneOrder'} = 'Ten en cuenta que no hay factura/crédito para la {#ShopOrderId#} del pedido de la tienda en la(s) etiqueta(s) "{#ConfigFieldLabel#}". Por tanto, magnalister no puede asignar una factura/abono al pedido de la tienda y enviarlo a {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'UploadInvoice_Error_MultipleReceiptsForOneOrder'} = 'Ten en cuenta que hay una factura o crédito duplicado para la(s) {#ConfigFieldLabel#} (ID de pedido de la tienda: {#ShopOrderId#}). Elimina los duplicados en consecuencia.';
MLI18n::gi()->{'UploadInvoice_Error_MoveToDestinationDirectory_Failed'} = 'La factura/abono "{#ReceiptFileName#}" no se ha podido mover a la carpeta de destino en el servidor ({#ConfigDestinationPath#}). Comprueba los permisos de lectura y escritura de las carpetas y archivos correspondientes en el servidor.';
