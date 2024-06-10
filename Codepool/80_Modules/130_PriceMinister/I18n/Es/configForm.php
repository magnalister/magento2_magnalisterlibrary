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
MLI18n::gi()->{'priceminister_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__hint'} = 'Tipo de IVA (en %) para pedidos de artículos no disponibles en la tienda.';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__label'} = 'IVA sobre artículos no conocidos en la tienda';
MLI18n::gi()->{'priceminister_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'priceminister_config_account__field__username__label'} = 'Nombre de usuario';
MLI18n::gi()->{'priceminister_config_price__field__price.usespecialoffer__label'} = 'Utiliza también precios especiales';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__label'} = 'Precio umbral';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__hint'} = 'Precio umbral';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__help'} = 'El precio umbral se utilizará como la posición después del punto decimal en la transmisión a PriceMinister.<br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 valor en el campo de descripción: 99 <br /> 
 origen del precio: 5.58 <br /> 
 resultado final: 5,99 <br /><br /> 
 Esta función ayuda en particular para las adiciones y reducciones porcentuales.<br/> 
 Si el campo está vacío, no se transmite ningún precio umbral.<br/><br/>El formato de entrada es un número natural con un máximo de dos dígitos. 
 El formato de entrada es un número natural con un máximo de dos dígitos.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.open__help'} = 'El estado debería transferirse automáticamente a la tienda tras un nuevo pedido en PriceMinister. <br /> 
 Si utilizas un proceso de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Configuración" > "Estado del pedido").';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.comment__help'} = 'El motivo de la anulación del pedido';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.name__label'} = 'Plantilla Nombre del producto';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.content__label'} = 'Plantilla Descripción del producto';
MLI18n::gi()->{'priceminister_config_producttemplate__legend__product__info'} = 'El tipo impositivo utilizado al importar el pedido del artículo fuera de la tienda en %.';
MLI18n::gi()->{'priceminister_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido desde la tienda a PriceMinister';
MLI18n::gi()->{'priceminister_config_sync__legend__sync'} = 'Sincronización de existencias';
MLI18n::gi()->{'priceminister_config_account_sync'} = 'Sincronización del inventario';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.quantity__label'} = 'Cantidad de existencias';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.frommarketplace__label'} = 'Cambios en las existencias en PriceMinister';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.tomarketplace__label'} = 'Cambios de stock en la tienda';
MLI18n::gi()->{'priceminister_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.status__label'} = 'Precio de salida de la subasta (CHF)';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__label'} = 'A partir de';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__help'} = 'Hora de inicio de la primera importación de pedidos. Ten en cuenta que esto no es posible para cualquier momento del pasado. Los datos están disponibles en PriceMinister durante un máximo de una semana.';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__help'} = 'Establece cuántos elementos se muestran en una página en Multiencuadre. <br />Nota: Los números más altos también conllevan tiempos de respuesta más altos.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingmethod__help'} = 'Método de envío para los pedidos de PriceMinister. Por defecto es "PriceMinister". <br /><br />Este ajuste se refiere a la creación de facturas y albaranes, y es importante para el procesamiento posterior en la tienda, así como algunos sistemas ERP (si se utiliza).';
MLI18n::gi()->{'priceminister_config_checkin_badshippingcost'} = 'El campo para los gastos de envío debe ser numérico.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.shipped__label'} = 'Establecer la orden como se envía con';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.shipped__help'} = 'Selecciona el estado del pedido en la tienda para configurarlo para su envío en PriceMinister.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.canceled__help'} = 'Selecciona el estado del pedido en la tienda para establecer el pedido como cancelado en PriceMinister.<br/><br/>.
 Nota: Sólo se pueden cancelar pedidos completos (no cancelaciones parciales).';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__label'} = 'Resultados';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__label'} = 'Orden de rechazo con';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.de';
MLI18n::gi()->{'priceminister_config_producttemplate__legend__product__title'} = 'Plantilla de productos';
MLI18n::gi()->{'priceminister_config_account_producttemplate'} = 'Plantilla de producto';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__help'} = 'PriceMinister no cobra gastos de envío por pedidos no confirmados. Si no activas la confirmación automática de pedidos, los pedidos de PriceMinister se crearán en tu tienda sin gastos de envío. Te recomendamos que actives esta función.';
MLI18n::gi()->{'priceminister_config_price__field__priceoptions__label'} = 'Precio del grupo de clientes';
MLI18n::gi()->{'priceminister_config_price__legend__price'} = 'Cálculo del precio';
MLI18n::gi()->{'priceminister_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'priceminister_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.quantity__help'} = 'Indica la cantidad de productos que estarán disponibles en el marketplace. 
 <br /> 
 Para omitir la sobreventa, puedes utilizar la <i>cantidad de la tienda, menos el valor del último campo</i><br /> <br />Ejemplo:</strong>El valor establecido como "<i>2</i>" significa que cuando haya existencias en la tienda, "<i>2</i>" significa. 
 <br />Ejemplo:</strong>El valor establecido como "<i>2</i>" significa que si las existencias en tu tienda son 10, las existencias en PriceMinister serán 8.<br />';
MLI18n::gi()->{'priceminister_config_orderstatus_autoacceptance'} = 'Ten en cuenta que has desactivado la confirmación automática del pedido. Como la API de PriceMinister no proporciona gastos de envío para pedidos no confirmados, tu tienda online creará pedidos sin gastos de envío. Por lo tanto, te recomendamos que actives la confirmación de pedido.';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.content__hint'} = 'Marcadores de posición disponibles para la descripción del producto: 
 <dl> 
 <dt>#TITLE#</dt> 
 <dd>Nombre del producto (Título)</dd> 
 <dt>#ARTNR#</dt> 
 <dd>Número de artículo en la tienda</dd> 
 <dt>#PID#</dt> 
 <dd>Identificación del producto en la tienda</dd> 
 <!--<dt>#PRICE#</dt> 
 <dd>Precio</dd> 
 <dt>#VPE#</dt> 
 <dd>Precio por unidad</dd>--> 
 <dt>#SHORTDESCRIPTION#</dt> <dd>Descripción breve 
 de la tienda</dd> 
 <dt>#DESCRIPTION#</dt> 
 <dd>Descripción de la tienda</dd>
 <dt>#PICTURE1#</dt> 
 <dd>Primera foto del producto</dd> 
 <dt>#PICTURE2# etc.</dt> 
 <dd>Segunda imagen del producto; utilice #PICTURE3#, #PICTURE4#, etc. para otras imágenes (tantas como estén almacenadas en los datos del producto de la tienda).</dd> 
 </dl>';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__hint'} = 'por página en multimatching';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingfromcountry__label'} = 'El pedido se enviará desde';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'priceminister_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'priceminister_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'priceminister_config_prepare__field__prepare.status__valuehint'} = 'Sólo transferir los elementos activos';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.status__valuehint'} = 'Sólo transferir los elementos activos';
MLI18n::gi()->{'priceminister_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'priceminister_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.content__hint'} = 'Lista de marcadores de posición disponibles para Asunto y Contenido: 
 <dl> 
 <dt>#MARKETPLACEORDERID#</dt> 
 <dd>Identificación de pedido de Marketplace</dd> 
 <dt>#FIRSTNAME#</dt> 
 <dd>Nombre del comprador</dt> 
 <dt>#LASTNAME#</dt>. 
 <dd>Apellido del 
 comprador</dt> 
 <dt>#EMAIL#</dt> 
 <dd>Dirección de correo electrónico del comprador</dt> 
 <dt>#PASSWORD#</dt> 
 <dd>Contraseña del comprador para acceder a su tienda. Sólo para los clientes a los que se les asignan contraseñas automáticamente - de lo contrario el marcador de posición será reemplazado por &apos;(como se sabe)&apos;***.< /dd> 
 <dt>#ORDERSUMMARY#</dt> 
 <dd>Resumen de los artículos comprados. Debe escribirse en una línea separada. <br/><i>¡No puede utilizarse en el Asunto!< /i> 
 </dd> 
 <dt>#MARKETPLACE#</dt> 
 <dd>Nombre de este Marketplace</dd> 
 <dt>#SHOPURL#</dt> 
 <dd>la URL de su tienda</dd> 
 <dt>#ORIGINATOR#</dt> 
 <dd>Nombre del remitente</dd> 
 </dl>';
MLI18n::gi()->{'priceminister_config_orderimport__field__customergroup__help'} = 'Grupo de clientes, al que los clientes deben dirigirse en caso de nuevos pedidos.';
MLI18n::gi()->{'priceminister_config_prepare__legend__upload'} = 'Carga de artículos';
MLI18n::gi()->{'priceminister_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'priceminister_config_prepare__legend__prepare'} = 'Preparación de la partida';
MLI18n::gi()->{'priceminister_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'priceminister_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'priceminister_config_prepare__field__itemcondition__label'} = 'Estado del artículo';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda de la cesta de la compra). <br><br>Además, puedes activar la comparación de existencias a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en PriceMinister, el inventario de la tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__help'} = 'Si un artículo no se ha liquidado a través de magnalister, no conocemos el tipo de IVA de este artículo (PriceMinister no facilita esta información). En este caso, introduce aquí un valor alternativo.';
MLI18n::gi()->{'priceminister_config_prepare__field__identifier__label'} = 'Identificador';
MLI18n::gi()->{'priceminister_config_account__field__token__help'} = 'Ve a la <a href="https://www.priceminister.com/usersecure?action=usrwstokenaccess" target="_blank">página</a> y obtén tu token.';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'priceminister_config_price__field__price__help'} = 'Introduce un porcentaje o una constante definida de adición o reducción al precio. Puedes introducir una reducción añadiendo un menos delante del valor.';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.carrier__help'} = 'Transportista por defecto para establecer las órdenes a enviar en PriceMinister';
MLI18n::gi()->{'priceminister_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.copy__label'} = 'CC al remitente';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.carrier__label'} = 'Portador';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.comment__label'} = 'Motivo de la anulación';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.canceled__label'} = 'Cancelar el pedido con';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__help'} = 'Antes de confirmar la entrega, selecciona el valor por defecto para aceptar el pedido en PriceMinister.<br/><br/><b>IMPORTANT:</b><br/><br/> 
 Esta aceptación debe realizarse en un plazo de 2 días a partir de la recepción del pedido, de lo contrario se desactivará tu cuenta de PriceMinister.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__label'} = 'Confirmación automática del pedido';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__valuehint'} = 'confirmación automática del pedido';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__valuehint'} = 'Actualización automática del tipo de cambio';
MLI18n::gi()->{'priceminister_config_account__field__token__label'} = 'Token API';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__label'} = 'Activa la importación de pedidos';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__label'} = 'Aceptar el pedido con';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.copy__help'} = 'Se enviará una copia del correo electrónico a la dirección de origen.';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_content'} = '<style>
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
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__hint'} = '<span style="color:#e31a1c;"> Lee la información para obtener más explicaciones.</span>';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__hint'} = '<span style="color:#e31a1c;"> Lee la información para obtener más explicaciones.</span>';
MLI18n::gi()->{'priceminister_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'priceminister_config_sync__field__inventorysync.price__help'} = '<p>El precio actual de PriceMinister se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, dependiendo de la configuración)<br> 
 Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br> 
 <b>Pista:</b> Se tendrán en cuenta los ajustes en &apos;Configuración&apos;, &apos;cálculo de precios&apos;.';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.name__help'} = '<dl> 
 <dt>Nombre del Producto en PriceMinister</dt> 
 <dd>Especifica cómo debe nombrarse el Producto en PriceMinister. 
 El marcador de posición <b>#TITLE#</b> será sustituido automáticamente por el nombre del Producto de la tienda, 
 <b>#BASEPRICE#</b> por el precio por unidad, si está almacenado en los datos del Producto.</dd> 
 <dt> Por favor, ten en cuenta:</dt> 
 <dd><b>#BASEPRICE#</b> será reemplazado mientras se sube el Producto a PriceMinister, ya que puede cambiar entre la preparación y la subida.</dd> 
 <dt> Si utilizas <b>#BASEPRICE#</b>, te recomendamos encarecidamente que <b>desactives la sincronización de precios</b>, ya que la sincronización no puede cambiar el contenido del nombre del Producto, por lo que los cambios en el precio del Producto provocarían datos contradictorios en la página de Producto de PriceMinister.</dd> 
 <dt>Precaución:</dt> 
 <dt> en en cuenta que PriceMinister restringe la longitud del Título a 40 caracteres. Los títulos de más de 40 caracteres serán truncados.</dd> 
 </dl>';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de PriceMinister se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, según configuración).<br>Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar pulsando el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br>
 
 Algunas solicitudes de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas. 
 </dd> 
 </dl>
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'priceminister_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'priceminister_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'priceminister_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';

MLI18n::gi()->{'priceminister_config_prepare__field__itemcondition__hint'} = 'Los valores los proporciona el mercado';
MLI18n::gi()->{'priceminister_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__help'} = 'Por favor, selecciona un estado de pedido de la tienda para rechazar el pedido en PriceMinister.<br/><br/>
                       <b>IMPORTANTE:</b><br/><br/>
                        La aceptación o rechazo del pedido debe realizarse en un plazo de 2 días desde la recepción del pedido, de lo contrario su cuenta en PriceMinister será desactivada.';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.addkind__label'} = '';