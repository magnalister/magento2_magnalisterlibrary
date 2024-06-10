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
MLI18n::gi()->{'ricardo_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'ricardo_config_prepare__field__warranty__label'} = 'Garantía';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__label'} = 'IVA sobre artículos no de almacén***.';
MLI18n::gi()->{'ricardo_config_price__field__mwst__help'} = 'Importe del IVA que se tendrá en cuenta cuando se liquide el artículo con Ricardo. Si dejas este campo abierto, se aplicará el IVA por defecto de la tienda online.';
MLI18n::gi()->{'ricardo_config_price__field__mwst__label'} = 'IVA';
MLI18n::gi()->{'ricardo_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'ricardo_config_account__field__mpusername__label'} = 'Nombre de usuario';
MLI18n::gi()->{'ricardo_config_price__field__price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'ricardo_config_prepare__legend__upload'} = 'Cargar elementos: Presets';
MLI18n::gi()->{'ricardo_config_account__field__token__help'} = 'Para solicitar un nuevo token a Ricardo, haz clic en el botón. < br> 
 Si esto no abre Ricardo en una ventana nueva, desactiva tu bloqueador de ventanas emergentes. < br>< br> 
 El token es necesario para que puedas acceder a Ricardo a través de la interfaz magnalister. < br> 
 Sigue los pasos de la ventana de Ricardo para solicitar un token y conectar tu tienda online a Ricardo a través de magnalister.';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Ricardo.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br /> 
 Esta función es útil a la hora de marcar el precio hacia arriba o hacia abajo***. <br/> 
 Deje este campo vacío si no desea establecer ningún importe decimal.<br/> 
 El formato requiere un máximo de 2 números. Ejemplo:';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__hint'} = 'El tipo impositivo que se aplicará a los artículos no pertenecientes a la tienda en las importaciones de pedidos, en %.';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__help'} = 'El estado se transfiere automáticamente a la tienda tras un nuevo pedido en DaWanda. <br /> 
 Si utilizas un proceso de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Configuración" > "Estado del pedido").';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__help'} = 'La fecha a partir de la cual deben importarse los pedidos. Ten en cuenta que no es posible establecer esta fecha demasiado lejos en el pasado, ya que los datos sólo están disponibles en Ricardo durante unas pocas semanas.';
MLI18n::gi()->{'ricardo_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.name__label'} = 'Plantilla del nombre del producto';
MLI18n::gi()->{'ricardo_config_producttemplate__legend__product__info'} = 'Correspondencia de los tramos de impuestos';
MLI18n::gi()->{'ricardo_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido desde la tienda a Ricardo';
MLI18n::gi()->{'ricardo_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.frommarketplace__label'} = 'Stock cambio Ricardo';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.tomarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'ricardo_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'ricardo_config_prepare__field__priceforauction__label'} = 'Precio de salida de la subasta (CHF)';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__hint'} = 'Fecha de inicio';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.showlimitationwarning__label'} = 'Mostrar el límite de la oferta de Ricardo antes de cargarla';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__matching__titledst'} = 'Idioma de la tienda';
MLI18n::gi()->{'ricardo_config_prepare__field__delivery__label'} = 'Tipo de envío';
MLI18n::gi()->{'ricardo_config_prepare__field__availabilityfield__label'} = 'Tiempo de envío';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shippingmethod__help'} = 'Métodos de envío que se asignarán a todos los pedidos de Ricardo. Estándar: "Ricardo"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverycost__label'} = 'Gastos de envío';
MLI18n::gi()->{'ricardo_config_checkin_badshippingcost'} = 'Los gastos de envío deben consistir en un número.';
MLI18n::gi()->{'ricardo_config_prepare__field__cumulative__valuehint'} = 'gastos de envío por separado para cada artículo';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.shipped__help'} = 'Selecciona el estado de la tienda, que establecerá automáticamente el estado de Ricardo en "Confirmar envío".';
MLI18n::gi()->{'ricardo_config_account__field__token__label'} = 'Ricardo Token';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__matching__titlesrc'} = 'Idioma de Ricardo';
MLI18n::gi()->{'ricardo_text_quantity'} = 'En principio, Ricardo no permite ningún aumento de stock para las ofertas actuales.<br>
 Para hacer posible el ajuste automático, magnalister finaliza una oferta en curso en segundo plano y la vuelve a ajustar con el aumento de stock al activar esta función.<br>
 <br>
 Confirma que aceptas la información pulsando "Aceptar" o cancela sin activar la función.';
MLI18n::gi()->{'ricardo_text_price'} = 'En principio, Ricardo no permite aumentos de precio para las ofertas en curso.<br>
 Para permitir el ajuste automático, magnalister finalizará una oferta en curso en segundo plano y la ajustará de nuevo con el aumento de precio cuando se active esta función.<br>
 <br>
 Confirma que aceptas la información pulsando "Aceptar" o cancela sin activar la función.';
MLI18n::gi()->{'ricardo_config_prepare__field__maxrelistcountfield__label'} = 'Reactivar la oferta';
MLI18n::gi()->{'ricardo_config_prepare__field__firstpromotion__label'} = 'Paquete de promoción';
MLI18n::gi()->{'ricardo_config_producttemplate__legend__product__title'} = 'Plantilla de productos';
MLI18n::gi()->{'ricardo_config_account_producttemplate'} = 'Plantilla de producto';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__label'} = 'Plantilla de descripción del producto';
MLI18n::gi()->{'ricardo_config_error_price_signal'} = 'En Ricardo, los precios deben introducirse en francos suizos. Establece el precio (último decimal) de forma que termine en 0 (por ejemplo, 12,40) o en 5 (por ejemplo, 12,45). El importe mínimo permitido es de 5 céntimos suizos (0,05 CHF). Haz clic en el símbolo de información de "Decimal" si quieres conocer más detalles.';
MLI18n::gi()->{'ricardo_config_price__field__priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'ricardo_config_price__legend__price'} = 'Cálculo de precios';
MLI18n::gi()->{'ricardo_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'ricardo_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'ricardo_config_prepare__legend__prepare'} = 'Preparar artículos';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.showlimitationwarning__help'} = 'Ten en cuenta que, por lo general, Ricardo ha limitado a 100 el número de listados simultáneos para cada comerciante, pero Ricardo puede ajustar este límite para cada comerciante individualmente. Por favor, comprueba si tus productos superan este límite antes de subirlos. Al menos puedes comprobar el registro de errores 30 minutos después de subirlos.<br>Si activas esta opción, recibirás información de Ricardo sobre el límite de ofertas cada vez que subas un producto.';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'ricardo_config_price__field__price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'ricardo_config_prepare__field__payment__label'} = 'Pago';
MLI18n::gi()->{'ricardo_config_account__field__mppassword__label'} = 'Contraseña';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'ricardo_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'ricardo_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'ricardo_config_prepare__field__prepare.status__valuehint'} = 'Sólo transferir los elementos activos';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.status__valuehint'} = 'Sólo transferir los elementos activos';
MLI18n::gi()->{'ricardo_config_prepare__field__descriptiontemplate__label'} = 'Ofrecer un lenguaje';
MLI18n::gi()->{'ricardo_config_account_defaulttemplate'} = 'Sin plantilla';
MLI18n::gi()->{'ricardo_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'ricardo_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'ricardo_config_prepare__field__listinglangs__label'} = 'Lista de idiomas';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.content__hint'} = 'Lista de marcadores de posición disponibles para Asunto y Contenido: 
 <dl> 
 <dt>#FIRSTNAME#</dt> 
 <dd>Nombre del comprador</dd> 
 <dt>#LASTNAME#</dt> 
 <dd>Apellido del comprador</dd> 
 <dt>#EMAIL#</dt> 
 <dd>Dirección de correo electrónico del comprador</dt> 
 <dt>#PASSWORD#</dt> 
 <dd>Contraseña del comprador para acceder a su Tienda. Sólo para los clientes a los que se les asigna automáticamente una contraseña - de lo contrario el marcador de posición será sustituido por &apos;(como se sabe)&apos;***.< /dd> 
 <dt>#ORDERSUMMARY#</dt> 
 <dd>Resumen de los artículos comprados. Debe escribirse en una línea separada. <br/><i>¡No puede utilizarse en el Asunto!</i> 
 </dd> 
 <dt>#MARKETPLACE#</dt> 
 <dd>Nombre del marketplace</dd> 
 <dt>#SHOPURL#</dt> 
 <dd>la URL de su tienda</dt> 
 <dt>#ORIGINATOR#</dt> 
 <dd>Nombre del remitente</dd> 
 <dt>#USERNAME#</dt> 
 <dd>Nombre de usuario del comprador</dd> 
 <dt>#MARKETPLACEORDERID#</dt> 
 <dd>Identificación del pedido de Ricardo</dd> 
 </dl>';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__hint'} = 'Lista de marcadores de posición disponibles para la descripción del producto:<dl><dt>#TITLE#</dt><dd>Nombre del producto (Titel)</dd><dt>#ARTNR#</dt>¡<dd>Número de artículo de la tienda</dd><dt>#PID#</dt><dd>Identificación del producto</dd><!--<dt>#PRICE#</dt><dd>Precio</dd><dt>#VPE#</dt><dd>Precio por unidad de embalaje</dd>--><dt>#SHORTDESCRIPTION#</dt><dd>Descripción breve de la tienda</dd><dt>#DESCRIPCIÓN#</dt><dd>Descripción de la tienda</dd><dt>#WEIGHT#</dt><dd>Peso del producto</dd><dt>#PICTURE1#</dt><dd>Primera imagen del producto</dd><dt>#PICTURE2# etc.</dt><dd>Segunda imagen del producto; con #PICTURE3#, #PICTURE4# etc. Puedes enviar tantas imágenes como estén disponibles en la tienda.< /dd></dl>#SHORTDESCRIPTION#';
MLI18n::gi()->{'ricardo_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'ricardo_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__label'} = 'Descripción del artículo';
MLI18n::gi()->{'ricardo_config_prepare__field__articlecondition__label'} = 'Estado del artículo';
MLI18n::gi()->{'ricardo_config_sync__legend__sync'} = 'Sincronización de inventarios';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.quantity__label'} = 'Recuento de artículos del inventario';
MLI18n::gi()->{'ricardo_config_account__field__apilang__label'} = 'Lenguaje de interfaz';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda de la cesta de la compra). <br><br>Además, puedes activar la comparación de existencias a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en Ricardo, el inventario de la Tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__help'} = 'Si un artículo no está introducido en la tienda online, magnalister utiliza aquí el IVA, ya que los marketplaces no especifican el IVA al importar el pedido. <br /> 
 <br /> 
 Más explicaciones:<br /> 
 Básicamente, magnalister calcula el IVA de la misma forma que lo hace el propio sistema de la tienda.<br /> El IVA por país sólo se puede tener en cuenta si el artículo se puede encontrar con su rango de números (SKU) en la tienda web.<br /> magnalister utiliza las clases de IVA configuradas de la tienda web.';
MLI18n::gi()->{'ricardo_config_prepare__field__maxrelistcount__label'} = '¿Con qué frecuencia se reactivará la oferta?';
MLI18n::gi()->{'ricardo_config_prepare__field__secondpromotion__label'} = 'hitmeister_prepare_form__legend__categories';
MLI18n::gi()->{'ricardo_config_account__field__apilang__values__de'} = 'Alemán';
MLI18n::gi()->{'ricardo_config_account__field__apilang__values__fr'} = 'Francés';
MLI18n::gi()->{'ricardo_config_account__field__apilang__hint'} = 'Para los valores activados y los mensajes de error';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__label'} = 'Primera desde la fecha';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.de';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'ricardo_config_prepare__field__duration__label'} = 'Duración';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'ricardo_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.copy__label'} = 'Copiar al remitente';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'ricardo_config_prepare__field__buyingmode__label'} = 'Modo de compra';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'ricardo_configform_sync_values__auto_reduce'} = 'Sincronización automática a través de CronJob (reduccion y aumento)';
MLI18n::gi()->{'ricardo_configform_sync_values__auto'} = 'Sincronización automática a través de CronJob (solo reduccion)';
MLI18n::gi()->{'ricardo_config_prepare__field__priceincrement__label'} = 'Incremento del precio de la subasta (CHF)';
MLI18n::gi()->{'ricardo_config_prepare__field__availability__label'} = 'Disponibilidad del artículo tras la recepción del pago';
MLI18n::gi()->{'ricardo_label_sync_quantity'} = 'Activa la reducción de existencias de Ricardo y aumenta';
MLI18n::gi()->{'ricardo_label_sync_price'} = 'Activa la reducción de existencias de Ricardo y aumenta';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__label'} = 'Activa la importación';
MLI18n::gi()->{'ricardo_config_prepare__field__payment__hint'} = 'Métodos de pago aceptados';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.copy__help'} = 'Se enviará una copia a la dirección de correo electrónico del remitente.';
MLI18n::gi()->{'ricardo_config_prepare__field__firstpromotion__hint'} = '<span style="color:#e31a1c;">Las promociones no son gratuitas. Consulta los precios en Ricardo.</span>';
MLI18n::gi()->{'ricardo_config_prepare__field__secondpromotion__hint'} = '<span style="color:#e31a1c;">Las promociones no son gratuitas. Consulta los precios en Ricardo.</span>';
MLI18n::gi()->{'ricardo_config_producttemplate_content'} = '<p>#TITLE#<br>#VARIATIONDETAILS#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'ricardo_config_sync__field__inventorysync.price__help'} = '<p>El precio actual de Ricardo se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, dependiendo de la configuración)<br> 
 Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br> 
 <b>Pista:</b> Se tendrán en cuenta los ajustes en &apos;Configuración&apos;, &apos;cálculo de precios&apos;.';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.name__help'} = '<dl> 
 <dt>Nombre del producto en Ricardo</dt> 
 <dd>Configuración: Cómo se nombra el producto en Ricardo. 
 El marcador de posición <b>#TITLE#</b> será sustituido por el nombre del producto desde la tienda, 
 <b>#BASEPRICE#</b> por el precio por unidad, hasta donde se deposite en la tienda.</dd> 
 <dt>Ten en cuenta:</dt> 
 <dd><b>#BASEPRICE#</b>será sustituido por la subida del producto porque se puede cambiar en la preparación del artículo.</dd> 
 <dd>Dado que el precio base es un valor fijo en el titel que no se puede actualizar, el precio no debería ser cambiado. Esto llevaría a precios erróneos.<br /> Puedes utilizar este marcador de posición bajo tu propia responsabilidad. En este caso te recomendamos desactivar la <b>sincronización de precios</b> (ajustes en la sincronización de magnalister Ricardo).</dd> 
 <dt>Importante:</dt> 
 <dd>Ten cuenta que Ricardo limita la longitud del título a 60 caracteres. magnalister acortará el título a la longitud máxima al cargar el producto.</dd> 
 </dl>';
MLI18n::gi()->{'ricardo_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'ricardo_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'ricardo_configform_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'ricardo_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ricardo_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'ricardo_config_price__field__mwst__hint'} = '&nbsp; Importe del IVA que se tiene en cuenta en la carga del artículo (en %).';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.tomarketplace__help'} = 'Con la función de sincronización automática mediante CronJob (recomendada), el stock actual de Ricardo se sincroniza con el stock de la tienda cada 4 horas, a partir de las 0:00 (con ***, según la configuración). El stock actual de Ricardo se sincroniza con el stock de la tienda cada 4 horas, a partir de las 0:00 (con ***, según la configuración).
 <br> Los valores deben transferirse desde la base de datos, incluidos los cambios a través de ERP o similar.<br>
 <br> La comparación manual puede activarse pulsando el botón correspondiente en la cabecera de magnalister (a la izquierda de la cesta de la compra).<br>
 <br> Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sSyncInventoryUrl#}</i><br>
 
 Algunas solicitudes de CronJob pueden bloquearse si las realizan clientes que no tienen tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas.
 <br><br> 
 <b>Nota:<br> Ricardo tiene un límite de disponibilidad. Por favor, asegúrate de que el inventario de cada artículo que ofreces en el marketplace Ricardo no supera las 999 unidades</b><br> Se tendrá en cuenta la configuración en &apos;Ajustes&apos; ,&rarr; &apos;Carga del artículo:por defecto&apos; &rarr; &apos;Cantidad de inventario&apos;.';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_content'} = '<style>
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
MLI18n::gi()->{'ricardo_config_prepare__field__descriptiontemplate__help'} = '';

MLI18n::gi()->{'ricardo_config_prepare_maxrelistcount_sellout'} = 'Hasta agotar existencias';
MLI18n::gi()->{'ricardo_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__hint'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverycondition__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__warrantycondition__label'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverydescription__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__paymentdescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverypackage__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__warrantydescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__paymentmethods__label'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__cumulative__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.factor__label'} = '';