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
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell2__default'} = 'Tu número de teléfono 
Tu número de fax 
Tu página web 
Tu correo electrónico';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell3__default'} = 'Tu número de identificación fiscal 
Tu NIF
Tu jurisdicción 
Tus datos';
MLI18n::gi()->{'amazon_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressleft__default'} = 'Tu nombre, Tu calle 1, 12345 Tu ciudad';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressright__default'} = 'Tu nombre 
Tu calle 1
 
12345 Tu ciudad';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell1__default'} = 'Tu nombre 
Tu calle 1
 
12345 Tu ciudad';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.headline__default'} = 'Tu factura';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__default'} = 'Tu texto informativo para la factura';
MLI18n::gi()->{'amazon_config_prepare__field__b2bactive__values__true'} = 'Sí';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.width__label'} = 'Anchura';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.weight.unit__label'} = 'Unidad de peso';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.name__label'} = 'Nombre de la ubicación del almacén';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__label'} = 'Ajustes del VCS realizados en Amazon Seller Central';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__label'} = 'IVA sobre artículos externos';
MLI18n::gi()->{'amazon_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension__label'} = 'Tamaños de paquetes definidos por el usuario';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__valuehint'} = 'Utiliza SKU como número de pieza del fabricante';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'amazon_config_price__field__price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.active__label'} = 'Utiliza las plantillas de envío de Amazon';
MLI18n::gi()->{'amazon_config_prepare__field__b2bactive__label'} = 'Utilizar Amazon B2B';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicedir__label'} = 'Facturas transmitidas';
MLI18n::gi()->{'amazon_config_prepare__legend__upload'} = 'Cargar elementos: Presets';
MLI18n::gi()->{'amazon_config_prepare__field__b2bactive__help'} = 'Para utilizar esta función, debes activar el Servicio de Vendedor de Empresas de Amazon: 
 Si ya eres vendedor de Amazon, puedes acceder a tu cuenta central de vendedor y activar el Servicio de Vendedor de Empresas.<br /> Para ello se requiere una "Cuenta de Vendedor Profesional". (Se puede ampliar dentro de tu cuenta de vendedor). 
 Lee también las instrucciones del icono de información en "Importar pedidos" > "Activar importación".';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Amazon.< br/><br/> 
 <strong>Ejemplo:</strong> <br> 
 Valor en textfeld: 99 <br> 
 Precio original: 5,58 <br> 
 Importe final: 5,99 <br><br> 
 Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. <br> 
 Deja este campo en blanco si no quieres establecer una cantidad decimal. <br> 
 El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'amazon_config_price__field__price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Amazon.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br /> Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. <br/> 
 Deja este campo vacío si no desea establecer ninguna cantidad decimal. <br/> 
 El formato requiere un máximo de 2 números.
 Esta función es útil para marcar el precio al alza o a la baja***.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__help'} = 'Esta función sólo es relevante para los vendedores que participan en &apos;Fulfilment by Amazon (FBA)&apos;: <br/>El estado del pedido se definirá como un pedido FBA, y el estado se transferirá automáticamente a su tienda.
 Si utilizas un procedimiento de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Ajustes" > "Estado del pedido").';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__hint'} = 'El tipo impositivo que se aplicará a los artículos que no son de la tienda en las importaciones de pedidos, en %.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__help'} = 'El estado se transfiere automáticamente a la tienda después de un nuevo pedido en Amazon. <br /> 
 Si utilizas un proceso de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Configuración" > "Estado del pedido").';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__hint'} = 'La opción establecida aquí debe coincidir con tu selección en el programa VCS de Amazon (introducida en Amazon Seller Central).';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.fallback.weight__help'} = 'Si no se especifica ningún parámetro de peso para un producto, se tomará el parámetro aquí establecido.';
MLI18n::gi()->{'amazon_config_prepare__field__leadtimetoship__help'} = 'El tiempo transcurrido desde que el comprador realiza el pedido hasta que lo entregues a su transportista.<br>Si no se introduce ningún valor, el tiempo de manipulación se establecerá en 1-2 días laborables. Utiliza este campo si el plazo de tramitación es superior a 2 días laborables.';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier1__help'} = 'El descuento debe ser superior a 0';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__help'} = 'La fecha a partir de la cual deben importarse los pedidos. Ten en cuenta que no es posible establecer esta fecha demasiado lejos en el pasado, ya que los datos sólo están disponibles en Amazon durante unas pocas semanas.';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'amazon_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.streetandnr__label'} = 'Nombre y número de la calle';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__label'} = 'Tienda de cambio de stock';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__label'} = 'Cambio de existencias de Amazon';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.stateorregion__label'} = 'Comunidad autónoma';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__label'} = 'por primera vez a partir de';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__hint'} = 'Fecha de inicio';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__help'} = 'El SKU se utilizará como número de pieza del fabricante.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.size.unit__label'} = 'Unidad de tamaño';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicedir__buttontext'} = 'Mostrar';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__buttontext'} = 'Vista previa';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code__matching__titlesrc'} = 'Clases de impuestos en la tienda';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_specific__matching__titlesrc'} = 'Clases de impuestos en la tienda';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippingservice'} = 'Configuración del envío';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__label'} = 'Servicio de envío de los pedidos (FBA)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippinglabel'} = 'Opciones de envío';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__help'} = 'Métodos de envío que se asignarán a todos los pedidos de Amazon. Estándar: "Marketplace"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__label'} = 'Servicios de entrega:';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_shipmethod'} = 'Introducción manual de un servicio de entrega';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__help'} = 'Método de envío para los pedidos de Amazon, que son cumplidos (enviados) por Amazon (FBA). Estándar: "amazon".<br><br> 
 Esta configuración es importante para las facturas y albaranes de envío, el posterior procesamiento del pedido dentro de la tienda, y para algunos ERP.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__label'} = 'Servicio de entrega (tipo de envío/método de envío)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount.shipping_sku__label'} = 'Descuento por envío Número de artículo';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.deliveryexperience__label'} = 'Condiciones de envío';
MLI18n::gi()->{'amazon_config_carrier_option_group_marketplace_carrier'} = 'Empresas de transporte propuestas por Amazon';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__label'} = 'Empresa de transporte:';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_carrier'} = 'Empresa de transporte propuesta por Amazon';
MLI18n::gi()->{'amazon_config_carrier_matching_title_shop_carrier'} = 'Proveedor de servicios de envío del módulo de gastos de envío de la tienda web';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__label'} = 'Empresa de transporte';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippingaddresses'} = 'Direcciones de envío
{#i18n:Amazon_Productlist_Apply_Requiered_Fields#}';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address__label'} = 'Dirección de envío';
MLI18n::gi()->{'amazon_config_prepare__legend__shipping'} = 'Envío';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__label'} = 'Grupos de envío de vendedores';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.name__label'} = 'Designación de los grupos de envío del vendedor';
MLI18n::gi()->{'amazon_config_prepare__legend__shippingtemplate'} = 'Grupos de envío de vendedores';
MLI18n::gi()->{'amazon_config_account__field__password__label'} = 'Contraseña de la Central de Vendedores';
MLI18n::gi()->{'amazon_config_account__field__username__label'} = 'Dirección de correo electrónico de la Central de Vendedores';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.active__help'} = 'El vendedor puede crear plantillas con diferentes servicios/métodos de envío específicos para las necesidades y casos de uso de su empresa. Se pueden seleccionar diferentes plantillas de métodos de envío con diferentes condiciones y gastos de envío para diferentes regiones. 
 
 Cuando un vendedor crea un presupuesto para tus productos, debe seleccionar una de tus plantillas de envío para el producto. El método de envío de esa plantilla se utiliza entonces para mostrar la opción de envío del producto en el sitio web.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__help'} = 'El vendedor puede crear grupos con diferentes servicios/métodos de envío específicos para las necesidades y casos de uso de su empresa. Se pueden seleccionar diferentes grupos de métodos de envío con diferentes condiciones y gastos de envío para diferentes regiones. 
 
 Cuando un vendedor crea un presupuesto para sus productos, debe seleccionar uno de sus grupos de condiciones de envío para su producto. El método de envío de este grupo se utiliza entonces para mostrar la opción de envío del producto en el sitio web.';
MLI18n::gi()->{'amazon_config_prepare__field__b2bsellto__label'} = 'Vender a';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__hint'} = 'Selecciona el servicio de entrega (tipo/método de envío) que se asigna por defecto a todos los pedidos de Amazon. La introducción de estos datos es obligatoria para Amazon. Encontrarás más detalles en el icono de información.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__hint'} = 'Selecciona el transportista que se asigna por defecto a todos los pedidos de Amazon. Esta información es requerida por Amazon. Puedes encontrar más detalles bajo el icono de información.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__'} = 'Selecciona una opción';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__hint'} = 'Guardado en {#setting:sImagePath#}';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__default'} = 'S';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__label'} = 'Resultados';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__default'} = 'R';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttype__label'} = 'Cantidad Tipo de descuento';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier5__label'} = 'Descuento por cantidad Nivel 5';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier4__label'} = 'Descuento por cantidad Nivel 4';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier3__label'} = 'Descuento por cantidad Nivel 3';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier2__label'} = 'Descuento por cantidad Nivel 2';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier1__label'} = 'Descuento por cantidad Nivel 1';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier1quantity__label'} = 'Cantidad';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier2quantity__label'} = 'Cantidad';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier3quantity__label'} = 'Cantidad';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier4quantity__label'} = 'Cantidad';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier5quantity__label'} = 'Cantidad';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount.products_sku__label'} = 'Producto Descuento Número de artículo';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'amazon_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'amazon_config_price__legend__price'} = 'Cálculo de precios';
MLI18n::gi()->{'amazon_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'amazon_config_prepare__legend__prepare'} = 'Preparar artículos';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__label'} = 'Prefijo del número de factura de anulación';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__label'} = 'Prefijo del número de factura';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.postalcode__label'} = 'Código postal';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.zip__label'} = 'Código postal<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__help'} = 'Por favor, configura el estado de la tienda para activar el estado "Envío confirmado" en Amazon.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__help'} = 'Introduce el estado de la tienda que debe activar el estado "Pedido cancelado" en Amazon.<br/><br/> 
 Nota: Las cancelaciones parciales no son posibles con la API de Amazon. Con esta función, se cancela todo el pedido y se reembolsa al comprador.';
MLI18n::gi()->{'amazon_config_prepare__field__quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
 <br/> Puedes cambiar el número de elementos individuales directamente en "Subir". En este caso se recomienda desactivar
 la<br/> sincronización automática en "Sincronización de la acción" > "Sincronización de la acción con el marketplace".<br/> 
 <br/> Para evitar la sobreventa, puedes activar "Transferir existencias de la tienda menos el valor del campo derecho".
 <br/> 
 <strong>Ejemplo:</strong> Al establecer el valor en 2 se obtiene &#8594; Inventario de la tienda: 10 &#8594; Inventario del DummyModule: 8<br/> 
 <br/> 
 <strong> Ten en cuenta:</strong>Si quieres establecer en "0" el inventario de un artículo en el marketplace, que ya está establecido en "Inactivo" en la Tienda, independientemente del inventario real, procede de la siguiente forma:<br/> 
 <li>"Sincronizar inventario">Configura "Editar inventario de la tienda" en "Sincronizar automáticamente con CronJob"</li>.
 <li>" Configuración global" > "Estado del producto" > Activa el ajuste "Si el estado del producto es inactivo, trata las existencias como 0"</li>.
 <ul>.';
MLI18n::gi()->{'amazon_config_price__field__price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.phone__label'} = 'Número de teléfono<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttype__values__percent'} = 'Porcentaje';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__hint'} = 'por página de multimatching';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__label'} = 'Métodos de pago';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__label'} = 'Forma de pago de los pedidos FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__help'} = 'Forma de pago para los pedidos de Amazon que son cumplidos (enviados) por Amazon (FBA). Por defecto: "dummymodule". <br><br> 
 Esta configuración es importante para las facturas y albaranes, para el posterior procesamiento de pedidos en la tienda y para algunos ERP.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.carrierwillpickup__label'} = 'Recogida de paquetes';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__valuehint'} = 'Sobrescribir los productos ya emparejados por medio de el multi- y el auto-matching.';
MLI18n::gi()->{'amazon_config_carrier_other'} = 'Otros';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__help'} = 'Las órdenes se importan cada hora si la función está activada<br />. 
 <br />
 Puedes importar los pedidos manualmente pulsando el botón de la función en la cabecera de la derecha.
 <br />
 También tienes la opción de importar pedidos por cronjob (cada cuarto de hora con una tarifa plana) haciendo clic en el siguiente enlace:<br />
 <i>{#setting:sImportOrdersUrl#}</i><br />
 <br />
 <strong>IVA:</strong><br />
 <br />
 Los tipos impositivos para importar pedidos de países sólo se pueden calcular correctamente si has almacenado los tipos impositivos correspondientes en tu tienda online y si los artículos comprados se pueden identificar en la tienda online mediante el SKU.<br />
 magnalister utiliza el tipo impositivo asignado en "Importación de pedidos" > "IVA artículos externos de la tienda" como "alternativa" si el artículo no se encuentra en la tienda online<br /><br />.
 
 <strong>Sugerencia para los pedidos y la facturación de Amazon B2B</strong> (requiere la participación en Amazon Business Program):<br /><br />
 
 Amazon no transmite los números de identificación fiscal para la importación de pedidos. magnalister, por lo tanto, puede generar los pedidos B2B en la tienda web, pero no será posible crear facturas formalmente correctas en todo momento.
 <br /><br />
 Tienes la opción de activar el número de identificación fiscal manualmente a través de tu Amazon Seller Central y luego puedes mantenerlo manualmente en tu sistema de tienda o ERP.
 <br /><br />
 También puedes utilizar el servicio de facturación para pedidos B2B en Amazon. De esta forma, todos los datos legales relevantes se preparan en el recibo para el cliente.
 <br /><br />
 Todos los datos relacionados con los pedidos, incluidos los identificadores fiscales, se pueden encontrar en Seller Central en "Informes" > "Documentos fiscales" si participas en el Programa de Vendedores de Amazon Empresas. El tiempo hasta que los ID estén disponibles depende de tu contrato B2B con Amazon (después de 3 o después de 30 días).
 <br /><br />
 También puedes encontrar identificadores fiscales en "Envío por Amazon" > deslizador: "Informes" si estás registrado en FBA.';
MLI18n::gi()->{'amazon_configform_stocksync_values__fba'} = 'El pedido (también pedido de FBA) reduce el stock de la tienda';
MLI18n::gi()->{'amazon_configform_stocksync_values__rel'} = 'El pedido (sin pedido de FBA) reduce el stock de la tienda (recomendado)';
MLI18n::gi()->{'amazon_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido entre la tienda y Amazon';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'amazon_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'amazon_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.status__valuehint'} = 'Mostrar sólo los elementos activos';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.status__valuehint'} = 'Mostrar sólo los artículos activos';
MLI18n::gi()->{'amazon_config_general_nosync'} = 'sin sincronización';
MLI18n::gi()->{'amazon_config_prepare__field__b2bactive__values__false'} = 'No';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.name__label'} = 'Nombre<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_account__field__mwstoken__label'} = 'Token MWS';
MLI18n::gi()->{'amazon_config_account__field__merchantid__label'} = 'Identificación del comerciante';
MLI18n::gi()->{'amazon_config_prepare__legend__machingbehavior'} = 'Comportamiento del matching';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_shipmethod'} = 'Vincular el servicio de entrega con entradas de la tienda web del módulo de gastos de envió';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_carrier'} = 'Vincula las empresas de transporte sugeridas por Amazon con los proveedores de servicios de transporte en el módulo de gastos de envío de la tienda online.';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__label'} = 'Hacer un nuevo match';
MLI18n::gi()->{'amazon_config_account__field__marketplaceid__label'} = 'Identificación del marketplace';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__label'} = 'Número de artículo del fabricante';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.mailcopy__label'} = 'Enviar por correo con copia de la factura a';
MLI18n::gi()->{'amazon_config_carrier_option_orderfreetextfield_option'} = 'magnalister añade un campo de texto libre en los detalles del pedido';
MLI18n::gi()->{'amazon_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'amazon_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.content__hint'} = 'Lista de marcadores de posición disponibles para Asunto y Contenido: 
 <dl> 
 <dt>#MARKETPLACEORDERID#</dt> 
 <dd>Identificación de pedido de Marketplace</dd> 
 <dt>#FIRSTNAME#</dt> 
 <dd>Nombre del comprador</dt> 
 <dt>#LASTNAME#</dt> 
 <dd>Apellido del comprador</dt> 
 <dt>#EMAIL#</dt> 
 <dd>Dirección de correo electrónico del comprador</dt> 
 <dt>#PASSWORD#</dt> 
 <dd>Contraseña del comprador para acceder a su Tienda. Sólo para los clientes a los que se les asigna automáticamente una contraseña - de lo contrario el marcador de posición será sustituido por &apos;(como se sabe)&apos;***.</dd> 
 <dt>#ORDERSUMMARY#</dt> 
 <dd>Resumen de los artículos comprados. Debe escribirse en una línea separada. <br/><i>¡No puede utilizarse en el Asunto!< /i></dd> 
 <dt>#ORIGINATOR#</dt> 
 <dd>Nombre del remitente</dd> 
 </dl>.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.length__label'} = 'Longitud';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__hint'} = 'Dejar en blanco si no debe aparecer ninguna información en la factura';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'amazon_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'amazon_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'amazon_config_prepare__field__itemcondition__label'} = 'Estado del artículo';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__webshop'} = 'Las facturas creadas en la tienda web se suben a Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__erp'} = 'Las facturas creadas en el sistema de terceros (por ejemplo, ERP) se cargan en Amazon';
MLI18n::gi()->{'amazon_config_account_vcs'} = 'Facturas | VCS';
MLI18n::gi()->{'amazon_config_vcs__legend__amazonvcs'} = 'Carga de facturas y programa Amazon VCS';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__label'} = 'Carga de facturas';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__label'} = 'Vista previa de la factura';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehintheadline__default'} = 'Notas de la factura';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__magna'} = 'La generación y carga de las facturas se realiza a través de magnalister';
MLI18n::gi()->{'amazon_config_sync__legend__sync'} = 'Sincronización de inventarios';
MLI18n::gi()->{'amazon_config_prepare__field__quantity__label'} = 'Recuento de artículos del inventario';
MLI18n::gi()->{'amazon_config_prepare__field__internationalshipping__label'} = 'Ajustes de envío para productos emparejados';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__label'} = 'Texto informativo';
MLI18n::gi()->{'amazon_config_prepare__field__b2bactive__notification'} = 'Para utilizar las funciones de Amazon Business, debes tener tu cuenta de Amazon habilitada para ellas. <b>Asegúrate de que tu cuenta está habilitada para Amazon Business Services. 
 De lo contrario, pueden producirse errores de carga cuando esta opción está habilitada.
 <br> Para actualizar tu cuenta, sigue las instrucciones de
 <a href="https://sellercentral.amazon.de/business/b2bregistration" target="_blank">esta página</a>.';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__label'} = 'Tamaño de la imagen';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__hint'} = 'Si introduces aquí un prefijo, éste se antepondrá al número de factura de anulación. Ejemplo: S20000. Las facturas de anulación generadas por magnalister comienzan con el número 20000.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__hint'} = 'Si introduces un prefijo aquí, se colocará delante del número de factura. Ejemplo: R10000. Las facturas generadas por magnalister comienzan con el número 10000.';
MLI18n::gi()->{'amazon_config_prepare__field__internationalshipping__hint'} = 'Si los grupos de envío de proveedores están activados, este ajuste se ignora.';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__help'} = 'Si un artículo no está introducido en la tienda online, magnalister utiliza aquí el IVA, ya que los marketplaces no especifican el IVA al importar el pedido. <br /> 
 <br /> 
Explicación:<br /> 
 Básicamente, magnalister calcula el IVA de la misma forma que lo hace el propio sistema de la tienda.<br /> El IVA por país sólo se puede tener en cuenta si el artículo se puede encontrar con su rango de números (SKU) en la tienda web.<br /> magnalister utiliza las clases de IVA configuradas de la tienda web.';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.manufacturerfallback__help'} = 'Si un producto no tiene asignado ningún fabricante, se utilizará aquí el fabricante asignado.<br />
 También puedes hacer coincidir el "Fabricante" general con tus atributos en "Configuraciones globales" > "Atributos del producto".';
MLI18n::gi()->{'amazon_config_prepare__field__b2bsellto__help'} = 'Si se selecciona <i>Sólo B2B</i>, los productos subidos con esta opción sólo serán visibles para los clientes profesionales en Amazon. De lo contrario, los productos estarán disponibles tanto para clientes normales como para clientes empresariales.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__off'} = 'No participo en el programa Amazon VCS';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__help'} = 'Aquí estableces el estado de la tienda que establecerá el estado del pedido de Amazon en "cancelar pedido". <br/><br/> 
 Nota: la cancelación parcial no es posible en esta configuración. Con esta función se cancelará todo el pedido y se abonará al cliente.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__hint'} = 'Aquí puedes previsualizar tu factura con los datos que has introducido.';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__help'} = 'Aquí puedes determinar cuántos productos se mostrarán por página de emparejamiento múltiple. 
 <br/>Un número mayor implicará tiempos de carga más largos (por ejemplo, 50 resultados tardarán unos 30 segundos).';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.height__label'} = 'Altura';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehintheadline__label'} = 'Título de las notas de la factura';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.headline__label'} = 'Título de la factura';
MLI18n::gi()->{'amazon_config_prepare__field__leadtimetoship__label'} = 'Tiempo de tramitación (en días)';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_shipmethod'} = 'Asignar el servicio de entrega desde el campo de texto';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_carrier'} = 'Tomar en bloque empresas de transporte desde el campo de texto';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__textfield__title'} = 'Desde el campo de texto';
MLI18n::gi()->{'amazon_configform_orderimport_shipping_values__textfield__title'} = 'Desde el campo de texto';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell4__label'} = 'Columna de pie de página 4';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell3__label'} = 'Columna de pie de página 3';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell2__label'} = 'Columna de pie de página 2';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell1__label'} = 'Columna de pie de página 1';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.state__label'} = 'Comunidad autónoma';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__label'} = 'Estado del pedido FBA';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__label'} = 'Importación de pedidos FBA';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.carrierwillpickup__default'} = 'falso';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'amazon_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.com';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__help'} = 'Ejemplo: Si un artículo se compra 3 veces en Amazon, el inventario de la Tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> Esta función sólo se aplica si has activado la Importación de Pedidos';
MLI18n::gi()->{'amazon_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__placeholder'} = 'Introduce aquí un servicio de entrega';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__placeholder'} = 'Introduce aquí una empresa de transporte';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.mailcopy__hint'} = 'Introduce aquí tu dirección de correo electrónico para recibir por correo electrónico una copia de la factura cargada.';
MLI18n::gi()->{'amazon_config_account__field__password__help'} = 'Introduce tu contraseña actual de Amazon para acceder a tu cuenta de Seller Central.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.email__label'} = 'Dirección de correo electrónico<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__valuehint'} = 'No importar pedidos FBA';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttype__values__'} = 'No utilices';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__off'} = 'No subir facturas a Amazon';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier1discount__label'} = 'Descuento';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier2discount__label'} = 'Descuento';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier3discount__label'} = 'Descuento';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier4discount__label'} = 'Descuento';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttier5discount__label'} = 'Descuento';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.text__label'} = 'Descripción';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'amazon_config_price__field__price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'amazon_config_price__field__price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'amazon_config_carrier_option_database_option'} = 'Matching de base de datos';
MLI18n::gi()->{'amazon_config_vcs__legend__amazonvcsinvoice'} = 'Datos para la creación de facturas por parte de magnalister';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'amazon_config_amazonvcsinvoice_reversalinvoicenumberoption_values_magnalister'} = 'Crear números de factura de anulación mediante magnalister';
MLI18n::gi()->{'amazon_config_prepare__legend__apply'} = 'Crear nuevos productos';
MLI18n::gi()->{'amazon_config_amazonvcsinvoice_invoicenumberoption_values_magnalister'} = 'Crear números de factura a través de magnalister';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.county__label'} = 'Distrito';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.countrycode__label'} = 'País';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.country__label'} = 'País<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.copy__label'} = 'Copiar al remitente';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__label'} = 'Confirma el envío y especifica la dirección del remitente';
MLI18n::gi()->{'amazon_config_tier_error'} = 'Amazon Business (B2B): La configuración para el nivel de precios escalonados B2B {#TierNumber#} es incorrecta';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.company__label'} = 'Nombre de la empresa';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressright__label'} = 'Campo de la dirección de la empresa (lado derecho)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressleft__label'} = 'Campo de la dirección de la empresa (izquierda)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.city__label'} = 'Ciudad';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.city__label'} = 'Ciudad<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__label'} = 'Cancelar el pedido con';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__label'} = 'Cancelar el pedido con';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__help'} = 'Al activar esto, los productos ya emparejados se sobrescribirán con los nuevos emparejados';
MLI18n::gi()->{'amazon_config_account_shippinglabel'} = 'Servicios de envío';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_container__label'} = 'Matching de clases de impuesto Business - Para categoría';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code__label'} = 'Matching de las clases de impuesto business';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.priceoptions__label'} = 'Opciones de precios para empresas';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price__label'} = 'Precio Business';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazoncommunicationrules.blacklisting__valuehint'} = 'Lista negra de direcciones de correo electrónico de clientes de Amazon';
MLI18n::gi()->{'amazon_config_prepare__field__b2bsellto__values__b2b_only'} = 'Sólo B2B';
MLI18n::gi()->{'amazon_config_prepare__field__b2bsellto__values__b2b_b2c'} = 'B2B y B2C';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__hint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'amazon_config_general_autosync'} = 'Sincronización automática mediante CronJob (recomendado)';
MLI18n::gi()->{'amazon_config_account__field__site__label'} = 'Sitio web de Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__vcs-lite'} = 'Configuración de Amazon: Subo mis propias facturas a Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__vcs'} = 'Configuración de Amazon: Amazon crea mis facturas';
MLI18n::gi()->{'amazon_config_general_mwstoken_help'} = 'Amazon requiere un proceso de autenticación para transferir datos a través de la interfaz. Introduce las claves correspondientes en "ID de vendedor", "ID de marketplace" y "Token MWS". Puedes solicitar estas claves en el marketplace de Amazon correspondiente en el que quieras publicar.<br>
 <br>
 Puedes averiguar cómo solicitar el token MWS en el siguiente artículo de preguntas frecuentes:<br>
 <a href="https://otrs.magnalister.com/otrs/public.pl?Action=PublicFAQZoom;ItemID=997" title="Amazon MWS" target="_blank">¿Cómo solicitar el token MWS de Amazon?</a>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount__label'} = 'Promociones de Amazon';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazoncommunicationrules.blacklisting__label'} = 'Directrices de comunicación de Amazon';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code__matching__titledst'} = 'Códigos fiscales de las empresas de Amazon';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_specific__matching__titledst'} = 'Clases de impuestos para Amazon Business';
MLI18n::gi()->{'amazon_config_prepare__legend__b2b'} = 'Amazon Business (B2B)';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__Amazon__title'} = 'Amazon';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.fallback.weight__label'} = 'Peso alternativo';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.manufacturerfallback__label'} = 'Fabricante alternativo';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line3__label'} = 'Dirección (línea 3)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line2__label'} = 'Dirección (línea 2)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line1__label'} = 'Dirección (línea 1)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell4__default'} = 'Información
adicional
en la cuarta
columna';
MLI18n::gi()->{'amazon_config_carrier_option_group_additional_option'} = 'Opciones adicionales';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__label'} = 'Activa la importación';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__hint'} = 'Un grupo de procedimientos de envío específico que se establecerá para una oferta específica del vendedor. El grupo de envío del vendedor es generado y administrado por el vendedor en la interfaz de usuario para los servicios de envío.';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.copy__help'} = 'Se enviará una copia a la dirección de correo electrónico del remitente.';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__help'} = '<p>Introduce la anchura en píxeles de la imagen tal y como debe aparecer en el marketplace. La altura se ajustará automáticamente en función de la relación de aspecto original. </p> 
 <p>Los archivos de origen se procesarán desde la carpeta de imágenes {#setting:sSourceImagePath#}, y se almacenarán en la carpeta {#setting:sImagePath#} con la anchura en píxeles seleccionada para su uso en el marketplace.</p>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Método de pago que se aplicará a todos los pedidos importados de Amazon. Estándar: "Amazon"</p> 
 <p>Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.</p>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount__help'} = '<p>magnalister importa los descuentos promocionales de Amazon como productos independientes a tu tienda online. Se crea un producto en el pedido importado para cada producto y descuento de envío.</p> 
 <p> En esta opción de configuración, puedes definir tus propios números de artículo para estos descuentos promocionales.</p>';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__help'} = '<dl> 
 <dt>Sincronización automática mediante CronJob (recomendado)</dt> 
 <dd>La función &apos;Sincronización automática&apos; sincroniza el precio de Amazon con el de la Tienda cada 4 horas, a partir de las 0:00 horas (dependiendo de la configuración).<br>Los valores serán transferidos desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br> 
 Algunas peticiones de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana o si la petición se realiza más de una vez cada 4 horas. 
 </dd> 
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de Amazon se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (dependiendo de la configuración).<br>Los valores serán transferidos desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana - máx. cada 4 horas) con el enlace:<br> 
 <i>{#setting:sSyncInventoryUrl#}</i><br> 
 Algunas peticiones de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana o si la petición se realiza más de una vez cada 4 horas. 
 </dd> 
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'amazon_config_prepare__field__b2bdiscounttype__help'} = '<b>Descuento por cantidad</b><br>
 El descuento por cantidad representa los descuentos escalonados disponibles para los clientes de Amazon Business para las compras de mayor volumen. Los vendedores del Programa de Vendedores de Empresas de Amazon especifican niveles para los Precios por Cantidad. La opción "porcentaje" significa que se aplicará un porcentaje de descuento específico a las compras que incluyan la cantidad especificada.<br><br>
 <b>Ejemplo</b>: 
 Si el producto cuesta 100 euros y el tipo de descuento es "Porcentaje", los descuentos aplicados para los <b>clientes empresariales</b>
 podría establecerse así: 
 <table><tr>
 <th style="background-color: #ddd;">Cantidad</th>
 <th style="background-color: #ddd;">Descuento</th>
 <th style="background-color: #ddd;">Precio final por producto</th>
 <tr><td>5 (o más)</td><td style="text-align: right;">10</td><td style="text-align: right;">90 €</td></tr>
 <tr><td>8 (o más)</td><td style="text-align: right;">12</td><td style="text-align: right;">88 €</td></tr>
 <tr><td>12 (o más)</td><td style="text-align: right;">15</td><td style="text-align: right;">85 €</td></tr>
 <tr><td>20 (o más)</td><td style="text-align: right;">20</td><td style="text-align: right;">80 €</td></tr>
 </table>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__help'} = '<b>No importar pedidos a través de Amazon FBA</b><br /> 
 <br />Tienes la opción de impedir que los pedidos FBA se importen a tu tienda. <br/> 
 Selecciona la casilla de verificación para activar esta función y la importación de pedidos excluirá cualquier pedido FBA. 
 <br /> 
 Si vuelves a quitar la opción, los nuevos pedidos FBA se importarán como siempre. 
 <br /> 
 Notas importantes: 
 <ul> 
 <li>Cuando actives esta función, el resto de funciones FBA dentro de la importación de pedidos no estarán disponibles por el momento.</li> 
 </ul>.';
MLI18n::gi()->{'amazon_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'amazon_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'amazon_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'amazon_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'amazon_configform_orderstatus_sync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_sync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_stocksync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_pricesync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_config_account__field__mwstoken__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__merchantid__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__marketplaceid__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_configform_orderstatus_sync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_configform_sync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_configform_pricesync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__help'} = 'En "Estado del pedido", selecciona el estado de la tienda online con el que se confirmará el envío de la mercancía.<br>
 <br>
 En la parte derecha puedes introducir la dirección desde la que se enviará la mercancía. Esto es útil si la dirección de envío debe ser diferente de la dirección estándar almacenada en Amazon (por ejemplo, cuando se envía desde un almacén externo).<br> 
 <br> 
 Si dejas los campos de dirección vacíos, Amazon utilizará la dirección del remitente que hayas introducido en los ajustes de envío de Amazon (Central del Vendedor).';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazoncommunicationrules.blacklisting__help'} = '<b>Evita las notificaciones de envío a los compradores de Amazon</b><br /> <br />. 
 Debido a las políticas de comunicación de Amazon, los vendedores de Amazon no pueden enviar notificaciones de envío (correos electrónicos) directamente a los compradores. 
 <br /> <br /> 
 La opción "Lista negra de direcciones de correo electrónico de clientes de Amazon" suprime los correos electrónicos enviados por el sistema de compras (para pedidos importados a través de magnalister). Esto significa que no llegan al comprador de Amazon. <br />
 <br /> 
 Si quieres permitir que se envíen correos electrónicos a los compradores a pesar de la política de comunicación de Amazon, desmarca la casilla "Lista negra de direcciones de correo electrónico de clientes de Amazon". Esto puede provocar que Amazon te bloquee. Por lo tanto, te lo desaconsejamos encarecidamente y no aceptamos ninguna responsabilidad por cualquier daño que pueda producirse. 
 <br /> 
 Notas importantes: 
 <ul> 
 <li>La lista negra está activada por defecto. Recibirás un mailer daemon (información del servidor de correo de que no se ha podido entregar el correo electrónico) en cuanto el sistema de la tienda envíe un correo electrónico al comprador de Amazon.<br /><br /></li> 
 <li>magnalister simplemente antepone a la dirección de correo electrónico de Amazon el prefijo "blacklisted-" (por ejemplo, blacklisted-12345@amazon.com). Si aun así quieres ponerte en contacto con el comprador de Amazon, simplemente elimina el prefijo "blacklisted-".</li> <li>magnalister no utiliza el prefijo "blacklisted-". </li>
 <ul>.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__help'} = 'Selecciona si ya participas en el programa VCS de Amazon y cómo. La configuración básica se realiza en Seller Central.
 <br> 
 magnalister te da tres opciones: 
 <ol> 
 <li> 
 No participo en el Programa VCS de Amazon<br> 
 <br> 
 Si has decidido no participar en el programa VCS de Amazon, selecciona esta opción. Todavía puedes elegir si quieres subir tus facturas a Amazon y cómo hacerlo en "Subir facturas". Sin embargo, ya no te beneficiarás de las ventajas del programa VCS (por ejemplo, insignia de vendedor y mejor clasificación).<br> 
 <br> 
 <li> 
 Configuración de Amazon: Amazon crea mis facturas<br> 
 <br>La facturación y el cálculo del IVA se realiza completamente por parte de Amazon como parte del programa VCS. La configuración para esto se hace en Seller Central.
 <br> 
 </li> 
 <li>Configuración de Amazon: Subo mis propias facturas a Amazon<br> 
 <br> 
 Elija esta opción si desea subir las facturas creadas por el sistema de la tienda o por magnalister (selección concreta en el campo "Carga de facturas"). Amazon se encarga entonces únicamente del cálculo del IVA. Esta selección también se realiza primero en Seller Central.<br> 
 </li> 
 </ol> <br> 
 Notas importantes: 
 <ul> 
 <li> Si seleccionas la opción 1 o 3, magnalister comprueba con cada importación de pedido si existe una factura para un pedido de Amazon importado por magnalister. En caso afirmativo, magnalister transferirá la factura a Amazon en un plazo de 60 minutos. Para la opción 3, esto ocurre tan pronto como el pedido haya recibido el estado enviado en la tienda online.<br><br></li>.
 <li>Si los importes de IVA de una o más facturas difieren de Amazon, recibirás un correo electrónico diario de magnalister entre las 9 y las 10 de la mañana CET+1 con todos los datos relevantes. CET+1 con todos los datos relevantes, como el número de pedido de Amazon, el número de pedido de la tienda y los datos de IVA correspondientes.<br><br></li>
 </ul>';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__help'} = '<p>Aquí puedes elegir si quieres enviar tus facturas a Amazon y cómo hacerlo. Están disponibles las siguientes opciones:</p> 
 <ol> 
 <li> 
 <li> 
 <p>No subir las facturas a Amazon</p> 
 <p> Si seleccionas esta opción, tus facturas no se enviarán a Amazon. Esto significa que tú mismo organizarás la distribución de tus facturas.</p> 
 <li> 
 <li> 
 <p>Las facturas creadas en la tienda web se suben a Amazon</p> 
 <p> Si tu sistema de tienda tiene la opción de crear facturas, puedes subirlas a Amazon.</p> 
 <li> 
 <li> 
 <p>La generación y subida de facturas la realiza magnalister</p> 
 <p> Selecciona esta opción si quieres que magnalister cree y cargue las facturas por ti. Para ello, rellena los campos "Datos para la creación de facturas por magnalister"</p> 
 <li> 
 <li> 
 <p>Las facturas creadas por sistemas de terceros (por ejemplo, sistema ERP) se suben a Amazon</p>
 
 <p> Las facturas creadas con tu sistema de terceros (por ejemplo, ERP) pueden subirse al servidor de tu tienda online, ser recuperadas por magnalister y subidas a Amazon. Aparecerá más información después de seleccionar esta opción en el icono de información bajo "Configuración para la transferencia de facturas creadas desde un sistema de terceros [...]".</p> 
 <li> 
 </ol>';
MLI18n::gi()->{'amazon_config_account_emailtemplate_content'} = '<style><!--
 body {
 font: 12px sans-serif;
 }
 table.ordersummary {
 width: 100%;
 border: 1px solid #e8e8e8;
 }
 table.ordersummary td {
 padding: 3px 5px;
 }
 table.ordersummary thead td {
 background: #cfcfcf;
 color: #000;
 font-weight: bold;
 text-align: center;
 }
 table.ordersummary thead td.name {
 text-align: left;
 }
 table.ordersummary tbody tr.even td {
 background: #e8e8e8;
 color: #000;
 }
 table.ordersummary tbody tr.odd td {
 background: #f8f8f8;
 color: #000;
 }
 table.ordersummary td.price,
 table.ordersummary td.fprice {
 text-align: right;
 white-space: nowrap;
 }
 table.ordersummary tbody td.qty {
 text-align: center;
 }
 --></style>
 <p>Hola, #FIRSTNAME# #LASTNAME#:</p>
 <p>Muchas gracias por tu pedido. Has realizado un pedido en nuestra tienda a través de #MARKETPLACE#:
 </p>#ORDERSUMMARY#
 <p>Se aplican además gastos de envío.
 </p><p> </p>
 <p>Saludos,</p>
 <p>El equipo de la tienda online</p>';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'amazon_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.additional__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.additional__help'} = '';

MLI18n::gi()->{'amazon_bopis.refund.reason_GeneralAdjustment'} = 'Ajuste general';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_bopis.refund.reason_Abandoned'} = 'Cancelado / Abandonado';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__help'} = 'Selecciona aquí un motivo predeterminado para los reembolsos, que se seleccionará en caso de sincronización de cronjob para un reembolso.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__label'} = 'Tiempo de tramitación<span class="bull">-</span>';
MLI18n::gi()->{'amazon_bopis_timeunit'} = 'Unidad de tiempo';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__label'} = 'Saliente {#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__placeholder'} = 'Nombre de la sucursal - Calle - Código postal';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_header'} = 'Autorizar magnalister para Amazon';
MLI18n::gi()->{'amazon_config_bopis__legend__stores'} = 'Sucursales "Click & Collect in store"';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline3__label'} = '{#i18n:amazon_bopis_addressline3#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.name__label'} = '{#i18n:amazon_bopis_storename#}';
MLI18n::gi()->{'amazon_bopis_stateorregion'} = 'Estado o región';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.district__label'} = '{#i18n:amazon_bopis_district#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_account__field__spapitoken__help'} = 'Para solicitar una nueva ficha de Amazon, haz clic en el botón.<br>
                        Si no se abre ninguna ventana de Amazon al hacer clic en el botón, es posible que tengas activado un bloqueador de ventanas emergentes.<br><br>
                        El token es necesario para colocar y gestionar artículos en Amazon a través de interfaces como magnalister.<br>
                        A partir de ese momento, sigue las instrucciones de la página de Amazon para solicitar el token y conectar tu tienda online a Amazon a través de magnalister.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_bopis_county'} = 'Condado';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline2__label'} = '{#i18n:amazon_bopis_addressline2#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.district__label'} = '{#i18n:amazon_bopis_district#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creationAndUpdate_error__label'} = 'Hemos podido crear la filial para usted, pero no hemos podido actualizarla debido a los siguientes errores';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.quantity__label'} = 'Inventario de la sucursal';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__label'} = 'Motivo de la devolución';
MLI18n::gi()->{'amazon_bopis.refund.reason_PriceError'} = 'Error de precio';
MLI18n::gi()->{'amazon_bopis_throughputconfig'} = 'Configuración del caudal';
MLI18n::gi()->{'amazon_bopis_usefrommaster'} = 'Tomar de la sucursal?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__help'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__help#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation__label'} = 'Lugar de devolución';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_update_error__label'} = 'No hemos podido actualizar la tienda por los motivos que se indican a continuación';
MLI18n::gi()->{'amazon_bopis_addressline1'} = 'Línea 1 de la dirección<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_bopis.refund.reason_NoInventory'} = 'No hay existencias';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creation_error__label'} = 'No hemos podido crear la sucursal por los siguientes motivos';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__help'} = 'Por favor, define una clave de tienda (código fuente de suministro) para tu tienda. <br> Se utiliza para identificar tu tienda, por lo que debe ser <strong>única</strong> y ya no se puede cambiar.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_prepare__field__maxquantity__help'} = 'Aquí se puede limitar el número de unidades de los artículos que aparecen en Amazon.<br /><br /><strong>Ejemplo:</strong> En "Número de unidades" se configura "Asumir stock de tienda" y se introduce aquí 20. A continuación, al cargar, se establecen tantos artículos como haya disponibles en la tienda, pero no más de 20. La sincronización del almacén (si está activada) ajusta el recuento de artículos de Amazon al stock de la tienda siempre que el stock de la tienda sea inferior a 20 artículos. Si hay más de 20 artículos en stock en la tienda, la cantidad de Amazon se ajusta a 20.<br /><br />Deja este campo vacío o introduzca 0 si no desea un límite.<br /><br /><strong>Nota:</strong> Si el ajuste "Cantidad" es "Tarifa plana (del campo de la derecha)", el límite no tiene efecto.';
MLI18n::gi()->{'amazon_bopis_issupported'} = '¿Es compatible?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__legend__orderimport'} = '{#i18n:amazon_config_account_orderimport#}';
MLI18n::gi()->{'amazon_bopis_friday'} = 'Viernes';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__label'} = 'Recogido';
MLI18n::gi()->{'amazon_bopis_contactdetails'} = 'Información de contacto';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel__label'} = 'Canal de recogida';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.county__label'} = '{#i18n:amazon_bopis_county#}';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration'} = 'Información de contacto y horario de apertura de la sucursal<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_bopis_sunday'} = 'Domingo';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_bopis_value'} = 'Valor';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_bopis.handling_time_Hours'} = 'Horas';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_bopis_country'} = 'País<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities__label'} = 'Otros ajustes';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_bopis_saturday'} = 'Sábado';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__help'} = 'Establece aquí el estado de la tienda, que debería establecer automáticamente el estado "Recogido" en Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.postalcode__label'} = '{#i18n:amazon_bopis_postalcode#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__help'} = 'Establece aquí el estado de la tienda que debe activar automáticamente un reembolso en Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__label'} = '{#i18n:amazon_bopis_storename#}<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__hint'} = 'Si la casilla no está marcada, significa que la sucursal está cerrada temporal o definitivamente.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__help'} = 'Establece aquí el estado de la tienda, que debería establecer automáticamente el estado "Listo para recoger" en Amazon.';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerReturn'} = 'El cliente ha devuelto el producto';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.city__label'} = '{#i18n:amazon_bopis_city#}';
MLI18n::gi()->{'amazon_config_bopis__legend__products'} = 'Sucursales de gestión de inventarios';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_bopis_wednesday'} = 'Miércoles';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerCancel'} = 'El cliente ha cancelado';
MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_body'} = '    Para utilizar magnalister en relación con Amazon, necesitamos su consentimiento.<br />
    <br />
    Al autorizar a magnalister en su portal Seller Central, nos permite interactuar con su tienda de Amazon.
    En concreto, esto significa: consultar pedidos, subir productos, sincronizar stocks y mucho más.
    <br />
    <br />
    Para autorizar a magnalister, realiza los siguientes pasos:<br />
    <ol>
        <li>Después de seleccionar el sitio de Amazon y hacer clic en Solicitar token, se abrirá una ventana a Amazon inmediatamente después de esta ventana de mensaje. Por favor, inicie sesión allí</li>.
        <li>Sigue las instrucciones del propio Amazon y completa el proceso de autorización</li>.
        <li>A continuación, haga clic en "Continuar con la preparación del artículo"</li>.
    </ol>
    <br />
    <strong>Importante:</strong> Una vez hayas solicitado tu token, ya no podrás cambiar de sitio de Amazon. Si has elegido por error un sitio Amazon incorrecto y ya has solicitado tu Token, selecciona el sitio correcto y solicita un nuevo Token.<br />
    <br />
    <strong>Nota:</strong> magnalister podrá tratar los datos no personales transmitidos a y por Amazon con fines estadísticos internos.';
MLI18n::gi()->{'amazon_bopis_phone'} = 'Teléfono';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.countrycode__label'} = '{#i18n:amazon_bopis_country#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_bopis.refund.reason_DifferentItem'} = 'Producto equivocado';
MLI18n::gi()->{'amazon_config_prepare__field__maxquantity__label'} = 'Límite de cantidad';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__label'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__label#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_bopis_addressline3'} = 'Dirección línea 3';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.language__label'} = 'Idioma de las facturas';
MLI18n::gi()->{'amazon_bopis_thursday'} = 'Jueves';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.postalcode__label'} = '{#i18n:amazon_bopis_postalcode#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.city__label'} = '{#i18n:amazon_bopis_city#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline1__label'} = '{#i18n:amazon_bopis_addressline1#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline3__label'} = '{#i18n:amazon_bopis_addressline3#}';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration_hint'} = 'Si no abres los sábados o domingos por ejemplo, deja vacíos los dos campos de hora de apertura y hora de cierre.';
MLI18n::gi()->{'amazon_bopis_city'} = 'Ciudad<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_bopis_addressline2'} = 'Dirección línea 2';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__label'} = '¿Sucursal en funcionamiento?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.createstoresuccess'} = 'La sucursal se ha creado correctamente - Código:  ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.updatestoresuccess'} = 'La sucursal se ha actualizado correctamente - Código:  ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__help'} = 'Se muestra al comprador en los casos de uso pertinentes. El formato debe ser "Nombre de la tienda - Calle - Código postal".';
MLI18n::gi()->{'amazon_bopis_email'} = 'Correo electrónico';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__label'} = 'Reembolso';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_bopis.handling_time_Days'} = 'Días';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.stateorregion__label'} = '{#i18n:amazon_bopis_stateoregion#}';
MLI18n::gi()->{'amazon_bopis_tuesday'} = 'Martes';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__hint'} = 'El tiempo de tramitación describe el tiempo que necesita para preparar el pedido para su recogida.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.store__label'} = 'Sucursal';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__help'} = 'Describe el tiempo que mantendrá las existencias hasta que cancele el pedido si no se recogen.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline2__label'} = '{#i18n:amazon_bopis_addressline2#}';
MLI18n::gi()->{'amazon_bopis.handling_time_Minutes'} = 'minutos';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__label'} = 'Estado de los pedidos "Click & Collect in store"';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_bopis.refund.reason_CouldNotShip'} = 'No se puede enviar';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stores__label'} = 'Añadir o actualizar sucursales "Click & Collect in store"';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__legend__orders'} = 'Sincronización del estado de los pedidos';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__label'} = 'Periodo de retención del inventario de un pedido "Click & Collect in store"<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_bopis_storename'} = 'Nombre de la sucursal';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address__label'} = 'Dirección';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__hint'} = '¿En qué zona horaria se encuentra la sucursal?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel__label'} = 'Canal de distribución';
MLI18n::gi()->{'amazon_bopis_starttime'} = 'Horarios de apertura';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_bopis_endtime'} = 'Hora de cierre';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__label'} = 'Huso horario';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__label'} = 'Stock';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__label'} = 'Clave de sucursal<br>(Código fuente de suministro)<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.county__label'} = '{#i18n:amazon_bopis_county#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.countrycode__label'} = '{#i18n:amazon_bopis_country#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline1__label'} = '{#i18n:amazon_bopis_addressline1#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__help'} = '    Especifica aquí cuánta cantidad de existencias de un artículo debe estar disponible para la tienda correspondiente.<br/>
    <br/>
    Para evitar la sobreventa, puedes establecer el valor<br/>
    "<i>Tomar el stock de la tienda menos el valor del campo derecho</i>".<br/>
    <br/>
    <strong>Ejemplo:</strong> Establezca el valor en "<i>2</i>". Resulta en → stock de tienda: 10 → stock de tienda: 8<br/>.
    <br/>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_account_bopis'} = 'Click & Collect en tienda';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.stateorregion__label'} = '{#i18n:amazon_bopis_stateoregion#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__label'} = 'Listo para la recogida';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_bopis_monday'} = 'Lunes';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__help'} = 'Define el estado del pedido que un pedido "Click & Collect in store" importado de Amazon debe recibir automáticamente en la tienda.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address__label'} = 'Dirección de la sucursal<span class="bull">-</span>';
MLI18n::gi()->{'amazon_config_account__field__spapitoken__label'} = 'Ficha Amazon';
MLI18n::gi()->{'amazon_bopis_postalcode'} = 'Código postal<span class="bull">-</span>';
MLI18n::gi()->{'amazon_bopis_district'} = 'Distrito';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_account__field__username__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.addkind__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_container__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.factor__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.group__label'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_category__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_specific__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__help'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_category__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.addkind__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.factor__label'} = '';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.tax_code_specific__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'amazon_config_prepare__field__b2b.price.group__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__hint'} = '';