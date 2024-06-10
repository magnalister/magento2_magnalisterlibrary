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
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_DontMatch_Warning'} = 'La siguiente distinción se aplica a las variantes de productos en cuanto a la vinculación de productos al catálogo de eBay:
 <br><br>
 1. En la variante de producto se almacena un código EAN<br><br> 2. En la variante de producto se almacena un código EAN.
 
 A continuación, magnalister intenta vincular un producto coincidente del catálogo de eBay<br><br> 2.
 según el EAN Si este proceso tiene éxito<br>.
 la variante se vincula a un ePID y se publica en eBay.
 <br>
 Si no se puede<br> asignar claramente ningún producto del catálogo
 mediante la coincidencia EAN, magnalister solicitará automáticamente que la variante<br>
 se añada al catálogo de eBay. Si eBay aprueba la variante, se publica automáticamente en el marketplace.
 <br>
 2. Si no hay ningún código EAN almacenado en la variante del producto<br>.
 <br> <br>
 En este caso, no es posible vincular el producto al catálogo de eBay y eBay mostrará un mensaje de error. Puedes comprobarlo en la pestaña "Inventario" -> "Registro de errores".';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__checkboxes__unprepare'} = 'Anular la preparación por completo';
MLI18n::gi()->{'Ebay_Productlist_Header_sPreparedType'} = 'Tipo de preparación';
MLI18n::gi()->{'Ebay_Productlist_Header_sPreparedListingType'} = 'Tipo de subasta';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_Select'} = 'Seleccionar';
MLI18n::gi()->{'Ebay_Productlist_Match_Manual_Button_Save'} = 'Guardar vinculaciones y preparar el producto';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__checkboxes__title'} = 'Anular la preparación para el título';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__checkboxes__subtitle'} = 'Anular la preparación para el subtítulo';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__checkboxes__description'} = 'Anular la preparación para la descripción del artículo';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__checkboxes__pictures'} = 'Anular la preparación de las imágenes seleccionadas';
MLI18n::gi()->{'Ebay_Productlist_Prepare_sResetValuesButton'} = 'Anular la preparación (parcialmente)';
MLI18n::gi()->{'Ebay_Productlist_Matching_sResetValuesButton'} = 'Anular la preparación (parcialmente)';
MLI18n::gi()->{'Ebay_Productlist_Matching_aResetValues__checkboxes__matching'} = 'Anular el matching';
MLI18n::gi()->{'Ebay_Product_Matching'} = 'Matching de productos';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedStatus__OPEN__title'} = 'Preparado sin revisión';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedStatus__ERROR__title'} = 'Preparado incorrectamente';
MLI18n::gi()->{'Ebay_Productlist_Filter_aPreparedStatus__ERROR'} = 'Preparado incorrectamente';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedStatus__OK__title'} = 'Preparado correctamente';
MLI18n::gi()->{'Ebay_Productlist_Filter_aPreparedStatus__OK'} = 'Preparado correctamente';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedType__NotMatched'} = 'Datos propios<br /><span class="small">(sin obligación de catalogo)</span>';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__buttons__ok'} = 'aceptar';
MLI18n::gi()->{'Ebay_Productlist_Matching_aResetValues__buttons__ok'} = 'aceptar';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_Search_Free'} = 'Nueva consulta de búsqueda';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_SkuOfManufacturer'} = 'N° de artículo del fabricante';
MLI18n::gi()->{'Ebay_Productlist_Upload_ShippingFee_Notice_Title'} = 'Información';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedType__StoresFixedPrice'} = 'Precio fijo (tienda de eBay)';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedType__FixedPriceItem'} = 'Precio fijo';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_Search_EPID'} = 'Entrada directa de ePID';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedType__Matched'} = 'Producto ePID<br /><span class="small">(catálogo obligatorio)</span>';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_Epid'} = 'ePID';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_Title'} = 'Título de eBay';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_DontMatch'} = 'No vincular';
MLI18n::gi()->{'Ebay_Productlist_Upload_ShippingFee_Notice_Content'} = 'Según el contrato, eBay cobra comisiones por anuncio o al utilizar funciones adicionales como "Subtítulos".
 El envío de los productos genera estas tarifas.
 Por favor, comprueba tu tarifa de eBay para evitar cargos no deseados.';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__checkboxes__strikeprices'} = 'Anular la preparación para los precios rebajados<br />';
MLI18n::gi()->{'Ebay_Productlist_Matching_aResetValues__checkboxes__unprepare'} = 'Anular la preparación por completo';
MLI18n::gi()->{'Ebay_Productlist_Cell_aPreparedType__Chinese'} = 'Subasta por incrementos (chino)';
MLI18n::gi()->{'Ebay_Productlist_Prepare_aResetValues__buttons__abort'} = 'cancelar';
MLI18n::gi()->{'Ebay_Productlist_Matching_aResetValues__buttons__abort'} = 'cancelar';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_Barcode'} = 'Código de barras (EAN, UPC o ISBN)';
MLI18n::gi()->{'Ebay_Productlist_Itemsearch_CreateNewProduct'} = 'Solicitar un nuevo producto en el catálogo de eBay';

MLI18n::gi()->{'Productlist_Filter_aMarketplaceSync__notTransferred'} = 'Mostrar durante al menos 1 año no en {#marketplace#} conjunto';