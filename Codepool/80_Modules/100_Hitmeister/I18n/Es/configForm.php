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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__label'} = 'IVA sobre los artículos que no son de tienda***.';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__label'} = 'Información sobre la variante en el título del producto';
MLI18n::gi()->{'hitmeister_config_account__field__mpusername__label'} = 'Nombre de usuario';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'hitmeister_config_prepare__legend__upload'} = 'Cargar elementos: Presets';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Kaufland.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br /> 
 Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. <br/> 
 Deja este campo en blanco si no quieres establecer una cantidad decimal. <br/> 
 El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__hint'} = 'El tipo impositivo que se aplicará a los artículos no pertenecientes a la tienda en las importaciones de pedidos, en %.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__help'} = 'El estado se transfiere automáticamente a la tienda tras un nuevo pedido en DaWanda. <br /> 
 Si utilizas un procedimiento de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Configuración" > "Estado del pedido").';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__help'} = 'La fecha a partir de la cual se importarán los pedidos. Ten en cuenta que no es posible fijar esta fecha demasiado lejos en el pasado, ya que los datos sólo estarán disponibles en Kaufland durante unas semanas.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__valuehint'} = 'Fijar precio mínimo';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__values'} = array (
     '0' => 'Precio mínimo = Precio normal',
     '1' => 'Precio mínimo establecido en Kaufland',
     '2' => 'Configurar precios mínimos'
);
MLI18n::gi()->{'hitmeister_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.tomarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.frommarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'hitmeister_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__hint'} = 'Fecha de inicio';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippingtime__label'} = 'Tiempo de envío';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shippingmethod__help'} = 'Métodos de envío que se asignarán a todos los pedidos de Kaufland. Estándar: "Kaufland"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'hitmeister_config_checkin_badshippingcost'} = 'Los gastos de envío deben consistir en un número.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.shipped__help'} = 'Selecciona el estado de la tienda, que establecerá automáticamente el estado de Ricardo en "Confirmar envío".';
MLI18n::gi()->{'hitmeister_config_account__field__secretkey__label'} = 'Clave secreta';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__label'} = 'Resultados';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelreason__help'} = 'Motivo de la anulación del pedido.';
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__price'} = 'Cálculo del precio';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions__label'} = 'Cálculo del precio';
MLI18n::gi()->{'hitmeister_config_account_priceandstock'} = 'Precio y existencias';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price__label'} = 'Precio';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippingtime__help'} = 'Preconfiguración del tiempo de envío. Esto todavía se puede adaptar en la preparación del artículo.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.carrier__help'} = 'Transportista preseleccionado durante la confirmación del envío a Kaufland';
MLI18n::gi()->{'hitmeister_config_prepare__legend__prepare'} = 'Preparar artículos';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcountry__help'} = 'Selecciona el país desde el que se enviará el artículo. La configuración por defecto es el país de tu tienda.';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippinggroup__help'} = 'Los grupos de expedición de Kaufland contienen información de envío.';
MLI18n::gi()->{'hitmeister_config_account__field__clientkey__help'} = 'Puedes encontrar la clave API en tu cuenta de Kaufland. Inicia sesión en Kaufland y selecciona <b>API de Kaufland</b> en el menú de la parte inferior izquierda, en <b>Funciones adicionales</b>.';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__hint'} = 'por página de multimatching';
MLI18n::gi()->{'hitmeister_config_account__field__mppassword__label'} = 'Contraseña';
MLI18n::gi()->{'hitmeister_config_country__legend__country'} = 'Países';
MLI18n::gi()->{'hitmeister_config_country__field__site__label'} = 'Sitio Kaufland';
MLI18n::gi()->{'hitmeister_config_country__field__site__help'} = 'Página de país de Kaufland en la que figurar';
MLI18n::gi()->{'hitmeister_config_country__field__site__alert__*__title'} = 'Nuevo sitio web del país';
MLI18n::gi()->{'hitmeister_config_country__field__site__alert__*__content'} = 'Ha seleccionado un sitio de Kaufland diferente. Esto afectará a otras opciones, ya que los sitios de país de Kaufland pueden ofrecer diferentes monedas, así como métodos de pago y envío. Los artículos se configuran entonces en el nuevo sitio del país y sólo se sincronizan allí, los pedidos también sólo se importan desde allí. ¿Debería adoptarse la nueva configuración?';
MLI18n::gi()->{'hitmeister_config_country__field__currency__label'} = 'Moneda';
MLI18n::gi()->{'hitmeister_config_country__field__currency__help'} = 'La moneda en la que se muestran los artículos en Kaufland, según la página de país de Kaufland';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido entre la tienda y Kaufland';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'hitmeister_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'hitmeister_config_prepare__field__prepare.status__valuehint'} = 'Sólo transferir los elementos activos';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.status__valuehint'} = 'Sólo transferir los elementos activos';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__label'} = 'Precio mínimo automático';
MLI18n::gi()->{'hitmeister_config_checkin_shippingmatching'} = 'La vinculación de los tiempos de envió no es compatible con este sistema de tienda.';
MLI18n::gi()->{'hitmeister_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'hitmeister_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'hitmeister_config_country_title'} = 'Países';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'hitmeister_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'hitmeister_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcondition__label'} = 'Estado del artículo';
MLI18n::gi()->{'hitmeister_config_invoice'} = 'Facturas';
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__sync'} = 'Sincronización de inventarios';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.quantity__label'} = 'Recuento de artículos del inventario';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda de la cesta de la compra). <br><br>Además, puedes activar la comparación de existencias a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'hitmeister_config_prepare__field__imagepath__label'} = 'Ruta de la imagen';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en Kaufland, el inventario de la tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__help'} = 'Fijar el precio mínimo';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__help'} = 'Si un artículo no está introducido en la tienda online, magnalister utiliza aquí el IVA, ya que los marketplaces no especifican el IVA al importar el pedido. <br /> 
 <br /> 
 Más explicaciones:<br /> 
 Básicamente, magnalister calcula el IVA de la misma forma que lo hace el propio sistema de la tienda.<br /> El IVA por país sólo se puede tener en cuenta si el artículo se puede encontrar con su rango de números (SKU) en la tienda web.<br /> magnalister utiliza las clases de IVA configuradas de la tienda web.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelled__help'} = 'Aquí estableces el estado de la tienda que establecerá el estado del pedido de MercadoLivre en "cancelar pedido". <br/><br/>
 Nota: la cancelación parcial no es posible en esta configuración. Con esta función se cancelará todo el pedido y se abonará al cliente.';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__help'} = 'Aquí defines el número de artículos que se mostrarán en la búsqueda múltiple. <br/>Un número mayor también implica tiempos de carga más largos (por ejemplo, 50 artículos > 30 segundos).';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__label'} = 'primero de la fecha';
MLI18n::gi()->{'hitmeister_config_checkin_manufacturerfilter'} = 'El filtro del fabricante no es compatible con este sistema de tienda.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'hitmeister_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'hitmeister_config_account__field__clientkey__label'} = 'ClientKey';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.carrier__label'} = 'Portador';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelreason__label'} = 'Motivo de la anulación del pedido';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelled__label'} = 'Cancelar el pedido con';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio ';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcountry__label'} = 'El artículo se envía desde';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippinggroup__label'} = 'Grupo de expedición';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__valuehint'} = 'Añadir información de la variante al título del producto';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__label'} = 'Importación activa';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__help'} = 'Activa esta opción si quieres que se incluya información detallada como la talla, el color o el tipo en el título de las variantes de tus productos en el marketplace de Kaufland..<br /><br /> Esto facilita al comprador la distinción entre ellos.<br /><br /><strong>Ejemplo:</strong><br />Título: Camiseta Nike<br />Variante: Talla S<br /><br />Resultando en el título: "Camiseta Nike - Talla S"';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__inventorysync.price__help'} = '<p>El precio actual de Kaufland ser sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, dependiendo de la configuración)<br> 
 Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br> 
 <b>Pista:</b> Se tendrán en cuenta los ajustes en &apos;Configuración&apos;, &apos;cálculo de precios&apos;.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de Kaufland se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0.00 horas (con ***, según configuración).<br>Los valores se transferirán desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar pulsando el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br>
 
 Algunas solicitudes de CronJob pueden bloquearse, si se realizan a través de clientes que no están en la tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas. 
 </dd> 
 
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'hitmeister_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'hitmeister_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions__help'} = '{#i18n:configform_priceandstock_field_priceoptions_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__price.lowest'} = 'Cálculo del precio mínimo';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest__label'} = 'Precio mínimo';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.addkind__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.factor__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Kaufland.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br /> 
 Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. <br/> 
 Deja este campo en blanco si no quieres establecer una cantidad decimal. <br/> 
 El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions.lowest__label'} = 'Cálculo del precio';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions.lowest__help'} = '{#i18n:configform_priceandstock_field_priceoptions_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.group__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';

MLI18n::gi()->{'hitmeister_config_carrier_option_group_additional_option'} = 'Opción adicional';
MLI18n::gi()->{'hitmeister_config_prepare__field__handlingtime__help'} = 'Ajuste por defecto del tiempo de procesamiento (tiempo hasta la expedición). Aún puede ajustarse durante la preparación del artículo.';
MLI18n::gi()->{'hitmeister_config_prepare__field__handlingtime__label'} = 'Tiempo de procesamiento';
MLI18n::gi()->{'hitmeister_config_carrier_option_group_shopfreetextfield_option_carrier'} = 'Seleccionar empresa de transporte desde un campo de texto libre de la tienda web (pedidos)';
MLI18n::gi()->{'hitmeister_config_account__legend__tabident'} = 'Pestaña';

MLI18n::gi()->ML_HITMEISTER_NOT_CONFIGURED_IN_KAUFLAND_DE_ACCOUNT = 'no está configurado en su cuenta de Kaufland';

MLI18n::gi()->{'hitmeister_config_carrier_option_group_marketplace_carrier'} = 'Empresas de transporte sugeridas por Kaufland';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.factor__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.addkind__label'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.group__label'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__import__label'} = '';

MLI18n::gi()->ML_HITMEISTER_SYNC_FROM_MARKETPLACE_VALUES = [
    'rel' => 'Pedido (sin pedido FBK) reduce el stock de la tienda (recomendado)',
    'fbk' => 'El pedido (también el pedido FBK) reduce las existencias de la tienda',
    'no' => 'No sincronización',
];
