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
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__label'} = 'Artículo externo de la tienda del IVA';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__label'} = 'Variaciones';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__valuehint'} = 'Variaciones de transmisión';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_tracked__help'} = 'Método de envío con seguimiento.<br> Los gastos de envío adicionales se aplican si puedes aplicar tarifas de envío más baratas cuando el cliente pide varios productos en el mismo pedido.';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__help'} = 'Este campo de texto se tomará como posición después del punto decimal para los datos transmitidos a Cdiscount.<br><br> 
 <strong>Ejemplo:</strong><br> 
 valor en el campo de texto: 99<br> 
 precio de origen: 5,58<br> 
 resultado final: 5,99<br><br> 
 Esta función es útil para los porcentajes de recargo y rebaja.<br> 
 Deja este campo abierto si no quieres transferir un decimal.<br> El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__help'} = 'El IVA no se puede determinar si el artículo no se transmite a través de magnalister.< br /> 
 Solución: El valor % aquí insertado se asignará a todos los productos en los que no se conoce el IVA mientras la importación de la orden de Cdiscount.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__help'} = 'El estado se transfiere automáticamente a la tienda tras un nuevo pedido en DaWanda. <br /> 
 Si utilizas un proceso de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Configuración" > "Estado del pedido").';
MLI18n::gi()->{'cdiscount_config_prepare__field__standarddescription__help'} = 'La descripción del producto debe describir el producto. Aparece en la parte superior de la ficha del producto, debajo del texto. No debe contener datos de la oferta (garantía, precio, envío, embalaje...), código html u otros códigos. La descripción no debe superar los 420 caracteres.';
MLI18n::gi()->{'cdiscount_config_prepare__field__marketingdescription__help'} = 'La descripción comercial debe describir el producto. Aparece en la pestaña "Presentación del producto". No debe contener ningún dato de la oferta (garantía, precio, envío, embalaje...). Se permite el código HTML. La descripción no debe superar los 5000 caracteres.';
MLI18n::gi()->{'cdiscount_config_checkin_manufacturerfilter'} = 'El filtro del fabricante no es compatible con este sistema de tienda.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__hint'} = 'Tipo impositivo utilizado al importar pedidos del artículo desde la tienda externa, en %.';
MLI18n::gi()->{'cdiscount_config_use_shop_value'} = 'Tomar de la tienda';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__matching__title'} = 'Tomar del marketplace';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido de la tienda a Cdiscount';
MLI18n::gi()->{'cdiscount_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'cdiscount_config_sync__legend__sync'} = 'Sincronización de existencias';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.tomarketplace__label'} = 'Tienda de cambio de inventario';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.frommarketplace__label'} = 'Cambio de stock Cdiscount';
MLI18n::gi()->{'cdiscount_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__help'} = 'Hora de inicio de la primera importación de pedidos. Ten en cuenta que esto no es posible para una hora aleatoria del pasado. Los datos están disponibles durante un máximo de una semana en Cdiscount.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_standard__help'} = 'Método de envío estándar.<br> Se cobrará la tarifa de envío adicional si se conceden tarifas de envío más baratas cuando el cliente pida varios productos en el mismo pedido.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofile__label'} = 'Perfil de envío';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_tracked__label'} = 'Envío con seguimiento';
MLI18n::gi()->{'cdiscount_config_checkin_badshippingtime'} = 'El plazo de entrega debe ser un número entre 1 y 10.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofilecost__label'} = 'Recargo por envío';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_standard__label'} = 'Envío estándar';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_registered__label'} = 'Envío registrado';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shippingmethod__help'} = 'Métodos de envío que se asignarán a todos los pedidos de Cdiscount. Estándar: "Cdiscount"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingfee__label'} = 'Gastos de envío (€)';
MLI18n::gi()->{'cdiscount_config_checkin_badshippingcost'} = 'El campo para los gastos de envío debe ser numérico.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier__label'} = 'Transportista';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipped__help'} = 'Selecciona el estado de la tienda, que establecerá automáticamente el estado de Ricardo en "Confirmar envío".';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__label'} = 'Resultados';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_registered__help'} = 'Forma de envío registrada.<br> La tarifa de envío adicional es cuando se permite aplicar tarifas de envío más baratas si el cliente pide varios productos en el mismo pedido.';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.quantity__label'} = 'Cantidad de existencias';
MLI18n::gi()->{'cdiscount_config_account_producttemplate'} = 'Plantilla de producto';
MLI18n::gi()->{'cdiscount_config_price__field__priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'cdiscount_config_price__legend__price'} = 'Cálculo de precios';
MLI18n::gi()->{'cdiscount_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'cdiscount_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.default__help'} = 'Transportista preseleccionado con confirmación de distribución a Cdiscount.';
MLI18n::gi()->{'cdiscount_config_prepare__legend__prepare'} = 'Preparar artículos';
MLI18n::gi()->{'cdiscount_config_prepare__field__preparationtime__help'} = 'Tiempo de preparación para la entrega del producto. debe ser en días entre 1 y 10.';
MLI18n::gi()->{'cdiscount_config_prepare__field__preparationtime__label'} = 'Tiempo de preparación (en días 1-10)';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcountry__help'} = 'Selecciona el país desde el que se enviará el artículo. Por defecto es el país de tu tienda';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'cdiscount_config_price__field__price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__label'} = 'Lugar después del punto decimal';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__hint'} = 'Lugar después del punto decimal';
MLI18n::gi()->{'cdiscount_config_prepare__field__imagepath__label'} = 'Ruta de la imagen';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__hint'} = 'por Página dentro de la concordancia múltiple';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.paymentmethod__label'} = 'Métodos de pago';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'cdiscount_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__help'} = 'Opción activada: Los productos que están disponibles en varias variantes (por ejemplo, talla o color) en la tienda se transmiten a Cdiscount de esta forma. <br /><br />
 La opción "Número de artículos" se utiliza para cada variación.<br /><br />
 <b>Ejemplo:</b> 
 Tienes 8 artículos "azules", 5 "verdes" y 2 "negros". En cantidad tomas la cantidad de existencias menos el valor del campo de la derecha y el valor 2 de este campo. El artículo se transfiere 6 veces azul y 3 veces verde.
 <br /><br /><b>Sugerencia:</b> 
 Es posible que las variaciones que utilices (por ejemplo, tamaño o color) también aparezcan en la selección de atributos de la categoría. En este caso, se utiliza su variación, no el valor de los atributos.';
MLI18n::gi()->{'cdiscount_config_prepare__field__prepare.status__valuehint'} = 'Sólo tome el artículo activo';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.status__valuehint'} = 'Sólo tome el artículo activo';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofilename__label'} = 'Nombre del perfil de expedición';
MLI18n::gi()->{'cdiscount_config_checkin_shippingmatching'} = 'La vinculación de los tiempos de envió no es compatible con este sistema de tienda.';
MLI18n::gi()->{'cdiscount_config_prepare__field__marketingdescription__label'} = 'Descripción de marketing';
MLI18n::gi()->{'cdiscount_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'cdiscount_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'cdiscount_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda de la cesta de la compra). <br><br>Además, puedes activar la comparación de existencias a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en Cdiscount, el inventario de la tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__help'} = 'Si la aceptación automática aún no está activada 
 debes ir a tu perfil de vendedor de Cdiscount (enlace: <a href = "https://seller.cdiscount.com/Orders.html">https://seller.cdiscount.com/Orders.html</a>) y aceptar los pedidos manualmente.
 Después de este paso, puedes actualizar el estado del pedido a "Cancelar envío" o "Confirmar envío" a través del plugin magnalister.
 Si este campo permanece marcado, los pedidos se aceptarán automáticamente (y el vendedor podrá rechazarlos en cualquier momento).';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.cancelled__help'} = 'Aquí estableces el estado de la tienda que establecerá el estado del pedido de MercadoLivre en "cancelar pedido". <br/><br/>
 Nota: la cancelación parcial no es posible en esta configuración. Con esta función se cancelará todo el pedido y se abonará al cliente.';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__help'} = 'Aquí defines el número de artículos que se mostrarán en la búsqueda múltiple. <br/>Un número mayor también implica tiempos de carga más largos (por ejemplo, 50 artículos > 30 segundos).';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__textfield__title'} = 'Desde el campo de texto';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__textfield__title'} = 'Desde el campo de texto';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__label'} = 'primero de la fecha';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.de';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'cdiscount_config_prepare__field__standarddescription__label'} = 'Descripción';
MLI18n::gi()->{'cdiscount_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofile__help'} = 'Crea aquí tus perfiles de envío. <br> 
 Puedes especificar distintos gastos de envío para cada perfil (ejemplo: 4,95) y definir un perfil por defecto. 
 Los gastos de envío especificados se añadirán al precio del artículo durante la subida del producto, ya que los productos sólo pueden subirse al marketplace CDiscount libres de gastos de envío.';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.copy__help'} = 'Se enviará una copia a la dirección de correo electrónico del remitente';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.copy__label'} = 'Copiar al remitente';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcondition__label'} = 'Condición';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__Cdiscount__title'} = 'Cdiscount';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.default__label'} = 'Portador';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.cancelled__label'} = 'Cancelar el pedido con';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.content__hint'} = 'Marcador de posición disponible para el tema y el contenido: 
 <dl> 
 <dt>#MARKETPLACEORDERID#</dt> 
 <dd>Identificación de pedido de Marketplace</dd> 
 <dt>#FIRSTNAME#</dt> 
 <dd>Nombre del comprador</dt> 
 <dt>#LASTNAME#</dt>. 
 <dd>Apellido del comprador</dt> 
 <dt>#EMAIL#</dt> 
 <dd>Dirección de correo electrónico del comprador</dd> 
 <dt>#PASSWORD#</dt> 
 <dd>Contraseña del cliente para acceder a tu tienda. Sólo para los clientes que se añaden automáticamente. De lo contrario, el marcador de posición se sustituye por "(según se conozca)".</dd> 
 <dt>#ORDERSUMMARY#</dt> 
 <dd>Resumen de los artículos comprados. Debe ir en una línea adicional.<br><i>¡No debe utilizarse en el asunto!</i> 
 </dd> 
 <dt>#MARKETPLACE#</dt> 
 <dd>Nombre del marketplace</dd> 
 <dt>#SHOPURL#</dt> 
 <dd>la URL de tu tienda</dd> 
 <dt>#ORIGINATOR#</dt> 
 <dd>Nombre del remitente</dd> 
 </dl>';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__valuehint'} = 'Actualización automática del tipo de cambio';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__label'} = 'Aceptación automática de pedidos';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcountry__label'} = 'El artículo se enviará desde';
MLI18n::gi()->{'cdiscount_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'cdiscount_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'cdiscount_config_prepare__legend__upload'} = 'Carga de Artícele: Preajustes';
MLI18n::gi()->{'cdiscount_config_account__field__mpusername__label'} = 'Nombre de usuario de la API';
MLI18n::gi()->{'cdiscount_config_account__field__mppassword__label'} = 'API-Contraseña';
MLI18n::gi()->{'cdiscount_config_price__field__price.usespecialoffer__label'} = 'también utilizan precios especiales';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingfeeadditional__label'} = 'Gastos de envío adicionales (€)';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__label'} = 'Activa la importación';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_content'} = '<style>
 <!--body { font: 12px sans-serif; }
 table.ordersummary { width: 100%; border: 1px solid #e8e8e8; }
 table.ordersummary td { padding: 3px 5px; }
 table.ordersummary thead td { background: #cfcfcf; color: #000; font-weight: bold; text-align: center; }
 table.ordersummary thead td.name { text-align: left; }
 table.ordersummary tbody tr.even td { background: #e8e8e8; color: #000; }
 table.ordersummary tbody tr.odd td { background: #f8f8f8; color: #000; }
 table.ordersummary td.price, table.ordersummary td.fprice { text-align: right; white-space: nowrap; }
 table.ordersummary tbody td.qty { text-align: center; }-->
 </style>
 <p>Hola, #NOMBRE# #APELLIDO#:</p>
 <p>Muchas gracias por tu pedido. Has realizado un pedido en nuestra tienda a través de #MARKETPLACE#:</p>
 #RESUMENPEDIDO#
 <p>Se aplican gastos de envío.</p>
 <p>Puedes encontrar otras ofertas interesantes en nuestra tienda en <strong>#URLDETIENDA#</strong>.</p>
 <p>&nbsp;</p>
 <p>Saludos,</p>
 <p>El equipo de la tienda online</p>';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Método de pago que se aplicará a todos los pedidos importados de CDiscount. Estándar: "Cdiscount"</p>
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.</p>';
MLI18n::gi()->{'cdiscount_config_sync__field__inventorysync.price__help'} = '<p>El precio actual de Cdiscount se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, dependiendo de la configuración)<br> 
 Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br> 
 <b>Pista:</b> Se tendrán en cuenta los ajustes en &apos;Configuración&apos;, &apos;cálculo de precios&apos;.';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de Cdiscount se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, según configuración).<br>Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar pulsando el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br>
 
 Algunas solicitudes de CronJob pueden bloquearse, si se realizan a través de clientes que no están en la tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas. 
 </dd> 
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'cdiscount_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'cdiscount_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__valuehint'} = '(Recomendado) Si aceptas este campo, puedes rechazar el pedido en cualquier momento.';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'cdiscount_config_account__field__mpusername__help'} = '';
MLI18n::gi()->{'cdiscount_config_account__field__mppassword__help'} = '';

MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier__help'} = '
                Seleccione aquí la empresa de transporte que se asigna por defecto a los pedidos de Cdiscount.<br>
                <br>
                Dispone de las siguientes opciones:<br>
                <ul>
                    <li>
                        <span class="negrita subrayada">Empresa de transporte sugerida por Cdiscount</span>.
                        <p>Seleccione una empresa de transporte de la lista desplegable. Se mostrarán las empresas recomendadas por Cdiscount.<br>
                            <br>
                            Esta opción es útil si <strong>desea utilizar siempre la misma empresa de transporte</strong> para los pedidos de Cdiscount.
                        </p>
                    </li> <li
                    <li>
                        <span class="negrita subrayada">Coincidir empresas de transporte sugeridas por Cdiscount con proveedores de servicios de envío del módulo de envío de la tienda web</span>.
                        <p>Puede hacer coincidir las empresas de transporte recomendadas por Cdiscount con los proveedores de servicios creados en el módulo de gastos de envío de Shopware 5. Puede realizar múltiples coincidencias utilizando el símbolo "+".<br>
                            <br>
                            Para obtener información sobre qué entrada del módulo de gastos de envío de Shopware se utiliza para la importación de pedidos de Cdiscount, consulte el icono de información en "Importación de pedidos" -> "Forma de envío de los pedidos".<br>
                            <br>
                            Esta opción es útil si desea utilizar <strong>configuraciones de gastos de envío existentes</strong> del módulo de gastos de envío de <strong>Shopware 5</strong>.<br>
                        </p>
                    </li> <li>
                    <li>
                        <span class="negrita subrayada">magnalister añade un campo de texto libre en los detalles del pedido</span>.
                        <p>Si selecciona esta opción, magnalister añadirá un campo en los detalles del pedido de PrestaShop. En este campo puede introducir la empresa de transporte.<br>
                            <br>
                            Esta opción es útil si desea utilizar <strong>diferentes empresas de transporte</strong> para los pedidos de Amazon.<br>
                        </p>
                    </li> <li>
                    <li>
                        <span class="negrita subrayada">Adoptar empresa de transporte desde campo de texto</span><br>
                        <p>Esta opción es útil si <strong>desea introducir manualmente la misma empresa de transporte para todos los pedidos de Cdiscount</strong>.<br></p>
                    </li> <li>
                </ul>
                <span class="negrita subrayada">Notas importantes:</span>
                <ul>
                    <li>La especificación de una empresa de transporte es obligatoria para las confirmaciones de envío en Cdiscount.<br><br></li>.
                    <li>El hecho de no facilitar la empresa de transporte puede suponer la retirada temporal de la autorización de venta.</li> <li>La empresa de transporte es obligatoria para la confirmación de los envíos en Cdiscount.
                </ul>
            ';
MLI18n::gi()->{'cdiscount_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.freetext__placeholder'} = 'Introduzca aquí su método de envío';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipmethod__help'} = 'Seleccione el método de envío que se asignará por defecto a todos los pedidos de Cdiscount.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.freetext__label'} = 'Empresa de transportes:';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipmethod__label'} = 'Forma de envío';
MLI18n::gi()->{'cdiscount_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__import__label'} = '';