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
MLI18n::gi()->{'check24_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'check24_config_orderimport__field__mwst.fallback__label'} = 'IVA sobre artículos no disponibles en la tienda***.';
MLI18n::gi()->{'check24_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'check24_config_account__field__mpusername__label'} = 'Nombre de usuario';
MLI18n::gi()->{'check24_config_price__field__price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'check24_config_price__field__price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Check24.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br /> 
 Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. <br/> 
 Deja este campo en blanco si no quieres establecer una cantidad decimal. <br/> 
 El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'check24_config_orderimport__field__mwst.fallback__hint'} = 'El tipo impositivo que se aplicará a los artículos no pertenecientes a la tienda en las importaciones de pedidos, en %.';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.open__help'} = 'El estado que debe transferirse automáticamente a la tienda después de realizar un nuevo pedido con Check24. 
 Si utilizas un procedimiento de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Configuración" > "Estado del pedido").';
MLI18n::gi()->{'check24_config_orderimport__field__preimport.start__help'} = 'La fecha a partir de la cual deben importarse los pedidos. Ten en cuenta que no es posible establecer esta fecha demasiado lejos en el pasado, ya que los datos sólo están disponibles en Amazon durante unas pocas semanas.';
MLI18n::gi()->{'check24_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.copy__help'} = 'La copia se enviará a la dirección de correo electrónico del remitente';
MLI18n::gi()->{'check24_config_account__field__mpusername__help'} = 'Los datos de acceso a la interfaz de Check24 se encuentran después de iniciar la sesión en Check24 en "Ajustes" -> "Transmisión de órdenes" -> Configuración y allí en la sección "Sus datos de acceso a la interfaz".';
MLI18n::gi()->{'check24_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido desde la tienda a Check24';
MLI18n::gi()->{'check24_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'check24_config_sync__field__stocksync.tomarketplace__label'} = 'Tienda de cambio de stock';
MLI18n::gi()->{'check24_config_sync__field__stocksync.frommarketplace__label'} = 'Cambio de existencias Check24';
MLI18n::gi()->{'check24_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'check24_config_orderimport__field__preimport.start__hint'} = 'Fecha de inicio';
MLI18n::gi()->{'check24_config_prepare__field__checkin.status__hint'} = 'Mostrar sólo los productos activos';
MLI18n::gi()->{'check24_config_prepare__field__shippingtime__label'} = 'Tiempo de envío';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shippingmethod__help'} = 'Métodos de envío que se asignarán a todos los pedidos de Check24. Estándar: "Check24"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'check24_config_prepare__field__shippingcost__label'} = 'Gastos de envío';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.shipped__help'} = 'Selecciona el estado de la tienda, que establecerá automáticamente el estado de Ricardo en "Confirmar envío".';
MLI18n::gi()->{'check24_config_price__field__priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'check24_config_price__legend__price'} = 'Cálculo del precio';
MLI18n::gi()->{'check24_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'check24_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'check24_config_prepare__legend__upload'} = 'Preparar artículos';
MLI18n::gi()->{'check24_config_prepare__field__quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'check24_config_price__field__price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'check24_config_account__field__csvurl__label'} = 'Ruta de acceso a su tabla csv';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'check24_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'check24_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'check24_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'check24_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'check24_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'check24_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'check24_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'check24_config_sync__legend__sync'} = 'Sincronización de inventarios';
MLI18n::gi()->{'check24_config_prepare__field__quantity__label'} = 'Recuento de artículos del inventario';
MLI18n::gi()->{'check24_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda de la cesta de la compra). <br><br>Además, puedes activar la comparación de existencias a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'check24_config_sync__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en Check24, el inventario de la tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!';
MLI18n::gi()->{'check24_config_orderimport__field__mwst.fallback__help'} = 'Si un artículo no está introducido en la tienda online, magnalister utiliza aquí el IVA, ya que los marketplaces no especifican el IVA al importar el pedido. <br /> 
 <br /> 
 Más explicaciones:<br /> 
 Básicamente, magnalister calcula el IVA de la misma forma que lo hace el propio sistema de la tienda.<br /> El IVA por país sólo se puede tener en cuenta si el artículo se puede encontrar con su rango de números (SKU) en la tienda web.<br /> magnalister utiliza las clases de IVA configuradas de la tienda web.';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.canceled__help'} = 'Aquí estableces el estado de la tienda, que establecerá el estado del pedido de Check24 como "cancelar pedido". <br/><br/> 
 Nota: En esta configuración no es posible la cancelación parcial. Con esta función se cancelará todo el pedido y se abonará al cliente.';
MLI18n::gi()->{'check24_config_account__field__ftpserver__label'} = 'Servidor FTP';
MLI18n::gi()->{'check24_config_account__field__port__label'} = 'Puerto FTP';
MLI18n::gi()->{'check24_config_account__field__mppassword__label'} = 'Contraseña FTP';
MLI18n::gi()->{'check24_config_orderimport__field__preimport.start__label'} = 'Primero de la fecha';
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'check24_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.content__label'} = 'Texto del correo electrónico';
MLI18n::gi()->{'check24_config_price__field__price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'check24_config_price__field__price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'check24_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.copy__label'} = 'Copiar al remitente';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.canceled__label'} = 'Cancelar el pedido con';
MLI18n::gi()->{'check24_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.de';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.content__hint'} = 'Marcador de posición disponible para el tema y el contenido: 
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
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__hint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'check24_config_orderimport__field__importactive__label'} = 'Activa la importación';
MLI18n::gi()->{'check24_config_sync__field__inventorysync.price__help'} = '<p>El precio actual de Check24 se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, dependiendo de la configuración)<br> 
 Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br> 
 <b>Pista:</b> Se tendrán en cuenta los ajustes en &apos;Configuración&apos;, &apos;cálculo de precios&apos;.';
MLI18n::gi()->{'check24_config_sync__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de Check24 se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, según configuración).<br>Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar pulsando el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br>
 
 Algunas solicitudes de CronJob pueden bloquearse, si se realizan a través de clientes que no están en la tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas. 
 </dd> 
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'check24_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'check24_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'check24_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'check24_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'check24_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'check24_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'check24_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'check24_config_account_emailtemplate_content'} = '<style>
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
 <p>Puedes encontrar más ofertas interesantes en nuestra tienda en <strong>#URLDETIENDA#</strong>.</p>
 <p>&nbsp;</p>
 <p>Saludos,</p>
 <p>El equipo de la tienda online</p>';

MLI18n::gi()->{'check24_config_prepare__field__available_service_product_ids__help'} = 'Lista de servicios disponibles (ID de producto del feed) que pueden adquirirse en combinación con el producto';
MLI18n::gi()->{'check24_config_prepare__field__custom_tariffs_number__help'} = 'El número TARIC es un código aduanero europeo para las mercancías. Es importante si importa mercancías a la UE o las exporta desde la UE.';
MLI18n::gi()->{'check24_config_prepare__field__installation_service__label'} = 'Instalación del artículo';
MLI18n::gi()->{'check24_config_prepare__field__imagesize__hint'} = 'Guardado en: {#setting:sImagePath#}';
MLI18n::gi()->{'check24_config_prepare__field__logistics_provider__help'} = 'Proveedor de servicios logísticos para el producto (por ejemplo, DHL)';
MLI18n::gi()->{'check24_config_prepare__field__removal_old_item__label'} = 'Llevarse el aparato viejo';
MLI18n::gi()->{'check24_config_prepare__field__removal_packaging__help'} = 'Para la expedición de mercancías:<br />adquisición del embalaje.';
MLI18n::gi()->{'check24_config_prepare__field__removal_packaging__label'} = 'Llevarse el envase';
MLI18n::gi()->{'check24_config_prepare__field__imagesize__label'} = 'Tamaño de la imagen';
MLI18n::gi()->{'check24_config_prepare__field__custom_tariffs_number__label'} = 'Número TARIC';
MLI18n::gi()->{'check24_config_prepare__field__two_men_handling__help'} = 'Si realiza entregas gratuitas en el lugar de instalación, introduzca aquí "sí"; de lo contrario, introduzca el recargo. Si no lo ofrece, deje el campo en blanco.';
MLI18n::gi()->{'check24_config_prepare__field__two_men_handling__label'} = 'Entrega en el lugar de instalación';
MLI18n::gi()->{'check24_config_prepare__field__available_service_product_ids__label'} = 'Servicios reservables';
MLI18n::gi()->{'check24_config_prepare__field__imagesize__help'} = '<p>Introduzca el ancho en píxeles que debe tener su imagen en el mercado.
La altura se ajusta automáticamente según el ratio original de la página.
<p>
Los archivos de origen se procesan desde la carpeta de imágenes <i>{#setting:sSourceImagePath#}</i> y se almacenan con el ancho en píxeles seleccionado aquí en la carpeta <i>{#setting:sImagePath#}</i> para su transmisión al mercado.</p> <p';
MLI18n::gi()->{'check24_config_prepare__field__removal_old_item__help'} = 'Para la expedición de mercancías:<br />Recogida del aparato antiguo.';
MLI18n::gi()->{'check24_config_prepare__field__logistics_provider__label'} = 'Proveedor de servicios logísticos';
MLI18n::gi()->{'check24_config_prepare__field__return_shipping_costs__label'} = 'Gastos de devolución';
MLI18n::gi()->{'check24_config_prepare__field__return_shipping_costs__help'} = 'Gastos de devolución de sabores';
MLI18n::gi()->{'check24_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'check24_config_prepare__field__delivery__label'} = 'Tipo de envío';
MLI18n::gi()->{'check24_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'check24_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'check24_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'check24_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'check24_config_prepare__field__quantity__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'check24_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'check24_config_price__field__price__hint'} = '';
MLI18n::gi()->{'check24_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'check24_config_orderimport__field__orderstatus.shipped__hint'} = '';