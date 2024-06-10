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
MLI18n::gi()->{'hood_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'hood_config_sync_inventory_import__true'} = 'Si';
MLI18n::gi()->{'hood_config_orderimport__field__mwstfallback__label'} = 'IVA sobre artículos no destinados a tiendas***.';
MLI18n::gi()->{'hood_config_prepare__field__mwst__label'} = 'IVA por defecto';
MLI18n::gi()->{'hood_config_prepare__field__mwst__help'} = 'Importe del IVA que se muestra en Hood.de, si no está almacenado en el artículo. Los valores distintos de 0 solo se permiten si tiene una cuenta comercial con Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__forcefallback__label'} = 'Utilizar siempre por defecto';
MLI18n::gi()->{'hood_config_prepare__field__forcefallback__help'} = 'Si esta opción está activada, siempre se utiliza el valor por defecto para el IVA, independientemente de lo que se haya guardado para el artículo.';
MLI18n::gi()->{'hood_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'hood_config_prepare__field__usevariations__label'} = 'Variaciones';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocaldiscount__label'} = 'Utilizar reglas especiales de precios de envío';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationaldiscount__label'} = 'Utilizar reglas especiales de precios de envío';
MLI18n::gi()->{'hood_config_price__field__fixed.price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'hood_config_price__field__chinese.price.usespecialoffer__label'} = 'Utilizar los precios de las ofertas especiales';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocalprofile__optional__select__true'} = 'Utilizar el perfil de envío';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationalprofile__optional__select__true'} = 'Utilizar el perfil de envío';
MLI18n::gi()->{'hood_config_orderimport__field__updateableorderstatus__label'} = 'Actualizar el estado del pedido cuando';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.cancelled__label'} = 'Deshacer la confirmación del envío con';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled__label'} = 'Deshacer la confirmación del envío cuando';
MLI18n::gi()->{'hood_config_prepare__field__usevariations__valuehint'} = 'Variaciones de la transferencia';
MLI18n::gi()->{'hood_config_account__field__token__help'} = 'Para solicitar un nuevo token de Hood.de, haz clic en el botón. < br> 
 Si esto no abre Hood.de en una ventana nueva, desactiva tu bloqueador de ventanas emergentes. < br>< br> 
 El token es necesario para acceder a Hood.de a través de la interfaz magnalister. < br> 
 Sigue los pasos de la ventana de Hood.de para solicitar un token y conectar tu tienda online a Hood.de a través de magnalister.';
MLI18n::gi()->{'hood_config_price__field__fixed.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Hood.de.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br 
 />Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. 
 <br/> Deja este campo en blanco si no quieres introducir una cantidad decimal. 
 <br/>El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'hood_config_price__field__chinese.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Hood.de.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br /> 
 Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. <br/> 
 Deja este campo en blanco si no quieres establecer una cantidad decimal. <br/> 
 El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en Hood.de.< br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 <br /><br 
 />Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. 
 <br/> Deja este campo en blanco si no quieres introducir una cantidad decimal. 
 <br/>El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'hood_config_orderimport__field__mwstfallback__hint'} = 'El tipo impositivo que se aplicará a los artículos no pertenecientes a la tienda en las importaciones de pedidos, en %.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.paid__help'} = 'El estado que recibe tu tienda cuando se realiza el pago a través de Hood.de.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.open__help'} = 'El estado que debe transferirse automáticamente a la tienda tras un nuevo pedido en Hood.de. <br /> 
 Si utilizas un procedimiento de reclamación conectado***, se recomienda establecer el estado del pedido en "Pagado" ("Ajustes" > "Estado del pedido").';
MLI18n::gi()->{'hood_config_prepare__field__paypal.address__help'} = 'La dirección de correo electrónico proporcionada a Hood.de para los pagos de PayPal. Esto es necesario para cargar los artículos de la tienda Hood.de.';
MLI18n::gi()->{'hood_config_orderimport__field__preimport.start__help'} = 'La fecha a partir de la cual deben importarse los pedidos. Ten en cuenta que no es posible fijar esta fecha demasiado lejos en el pasado, ya que los datos sólo estarán disponibles en Hood.de durante unas semanas.';
MLI18n::gi()->{'hood_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'hood_config_account__field__currency__help'} = 'La moneda en la que quieres que se muestren tus artículos de Hood.de. Elige una moneda que se corresponda con la del sitio Hood.de.';
MLI18n::gi()->{'hood_config_producttemplate__legend__product__info'} = 'Tipo impositivo utilizado al importar pedidos del artículo desde la tienda externa, en %.';
MLI18n::gi()->{'hood_config_prepare__field__mwst__hint'} = 'Tipo impositivo para vendedores comerciales en %';
MLI18n::gi()->{'hood_config_sync__field__inventory.import__label'} = 'Sincronización de los elementos que no son de la tienda***';
MLI18n::gi()->{'hood_config_sync__field__inventory.import__help'} = '¿Sincronizar artículos que no están configurados en magnalister?<br/><br/>Si esta función está activada, cada artículo que se ofrece a través de tu cuenta de Hood.de se carga en la base de datos de magnalister cada noche. A continuación, son visibles en el plugin en "Listados".
 La sincronización de precios y existencias también se aplica a estos artículos siempre que el SKU en Hood.de coincida con el número de artículo en la tienda. <br/><br/>Para asegurarte de que esto funciona correctamente, establece "Número de artículo (tienda) = SKU (tienda)" en Ajustes globales > Sincronizar intervalo de números***.<br/>Ten en cuenta que si cambias este intervalo de números, tendrás que compararlo de nuevo con la tienda para asegurarte de que la sincronización es correcta.<br/>Esta función no está disponible actualmente para artículos que no sean de la tienda*** con variantes configuradas.br/';
MLI18n::gi()->{'hood_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'hood_config_sync__field__stocksync.tomarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'hood_config_sync__field__chinese.stocksync.tomarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'hood_config_sync__field__stocksync.frommarketplace__label'} = 'Sincronización de existencias desde el marketplace';
MLI18n::gi()->{'hood_config_sync__field__chinese.stocksync.frommarketplace__label'} = 'Sincronización de existencias desde el marketplace';
MLI18n::gi()->{'hood_config_orderimport__field__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'hood_config_price__field__chinese.price__label'} = 'Precio inicial';
MLI18n::gi()->{'hood_config_orderimport__field__preimport.start__label'} = 'Iniciar la importación desde';
MLI18n::gi()->{'hood_config_prepare__field__topten__help'} = 'Mostrar la categoría de selección rápida en Preparar elementos.';
MLI18n::gi()->{'hood_config_prepare__field__useprefilledinfo__valuehint'} = 'Mostrar información del producto Hood.de prefilled';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.send__help'} = '¿Debería enviarse un correo electrónico desde tu tienda a tus clientes para promocionarla?';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.shippingmethod__help'} = 'Método de envío que se aplicará a todos los pedidos importados desde Hood.de. Estándar: "marketplace"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocal__cost'} = 'Gastos de envío';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternational__cost'} = 'Gastos de envío';
MLI18n::gi()->{'hood_config_prepare__legend__shipping'} = 'Envío';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternational__optional__select__true'} = 'Envíos internacionales';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled__help'} = 'Establece el estado del pedido en su tienda, que deshará el estado 
 &apos;enviado&apos; en Hood.de. <br/><br/> 
 Nota: Esto sólo significa que el estado del pedido en Hood.de ya no es &apos;enviado&apos;. No significa que el pedido se haya cancelado.';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.send__label'} = '¿Quieres enviar un correo electrónico?';
MLI18n::gi()->{'hood_config_prepare__field__imagesize__hint'} = 'Guardado en: {#setting:sImagePath#}';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__0'} = 'el mismo día';
MLI18n::gi()->{'hood_configform_prepare_hitcounter_values__RetroStyle'} = 'Estilo retro';
MLI18n::gi()->{'hood_config_prepare__field__restrictedtobusiness__label'} = 'Restringir a las empresas';
MLI18n::gi()->{'hood_config_sync__field__syncrelisting__help'} = 'Ayuda de ReList';
MLI18n::gi()->{'hood_config_sync__field__syncrelisting__label'} = 'ReList';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.nostock__help'} = 'Motivo de la cancelación: El artículo no se puede entregar o está agotado. <br /> 
 Selecciona el estado apropiado en esta pestaña desplegable (ajustable en tu sistema de tienda). Este estado se mostrará en la cuenta Hood.de de tu cliente. <br /> 
 El cambio de estado del pedido se activa cuando cambia el estado del producto de tu tienda. magnalister sincroniza automáticamente el cambio de estado con Hood.de.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.defect__help'} = 'Motivo de la cancelación: El artículo es defectuoso. <br /> 
 Selecciona el estado apropiado en esta pestaña desplegable (ajustable en tu sistema de tienda). Este estado se mostrará en la cuenta Hood.de de tu cliente. <br /> 
 El cambio de estado del pedido se activa cuando cambia el estado del producto de tu tienda. magnalister sincroniza automáticamente el cambio de estado con Hood.de.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.nopayment__help'} = 'Motivo de la cancelación: El cliente no paga el artículo. <br /> 
 Selecciona el estado apropiado en esta pestaña desplegable (ajustable en tu sistema de tienda). Este estado se mostrará en la cuenta Hood.de de tu cliente. <br /> 
 El cambio de estado del pedido se activa cuando cambia el estado del producto en tu tienda. magnalister sincroniza automáticamente el cambio de estado con Hood.de.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.revoked__help'} = 'Motivo de la cancelación: El cliente ha cancelado el artículo o ya no desea comprarlo. 
 Selecciona el estado apropiado en esta pestaña desplegable (ajustable en tu sistema de tienda). Este estado se mostrará en la cuenta Hood.de de tu cliente. <br /> 
 El cambio de estado del pedido se activa cuando cambia el estado del producto en tu tienda. magnalister sincroniza automáticamente el cambio de estado con Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__hoodplus__valuehint'} = 'Publicar un artículo con Hood.de Plus';
MLI18n::gi()->{'hood_config_emailtemplate__legend__mail'} = 'Plantilla de correo electrónico de promoción';
MLI18n::gi()->{'hood_config_account_emailtemplate'} = 'Plantilla de correo electrónico de promoción';
MLI18n::gi()->{'hood_config_prepare__field__usevariations__help'} = 'Los productos que estén disponibles con variaciones (por ejemplo, tamaño o color) en tu tienda se transferirán al capó con estas variaciones.<br /><br />Los ajustes de cantidad se aplicarán entonces a cada variación individual.<br /><br /> 
 <b>Ejemplo:</b> Si tienes 8 unidades de un artículo en azul, 5 en verde y 2 en negro, seleccionas la opción "Transferir existencias menos el valor del campo derecho" en Cantidad e introduces "2" en el campo, el artículo estará disponible como 6 unidades en azul y 3 unidades en verde.<br /><br /><b>Ten en cuenta:</b> Puede ocurrir que una variación que utilices (por ejemplo, talla o color) también aparezca en la selección de atributos de la categoría. En este caso, se utilizará tu variación en lugar del atributo.';
MLI18n::gi()->{'hood_config_producttemplate__legend__product__title'} = 'Plantilla de productos';
MLI18n::gi()->{'hood_config_account_producttemplate'} = 'Plantilla de producto';
MLI18n::gi()->{'hood_config_producttemplate__field__template.name__label'} = 'Plantilla de nombres de productos';
MLI18n::gi()->{'hood_config_prepare__field__useprefilledinfo__label'} = 'Información sobre el producto';
MLI18n::gi()->{'hood_config_producttemplate__field__template.content__label'} = 'Plantilla de descripción del producto';
MLI18n::gi()->{'hood_config_prepare__field__privatelisting__label'} = 'Listados privados';
MLI18n::gi()->{'hood_config_price__field__fixed.priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'hood_config_price__field__chinese.priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'hood_config_price__legend__price'} = 'Cálculo del precio';
MLI18n::gi()->{'hood_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'hood_config_price__field__fixed.price__label'} = 'Precio';
MLI18n::gi()->{'hood_config_prepare__field__chinese.duration__help'} = 'Ajuste anticipado de la duración de la subasta. Este ajuste puede modificarse en la preparación del artículo.';
MLI18n::gi()->{'hood_config_price__field__chinese.duration__help'} = 'Ajuste anticipado de la duración de la subasta. Este ajuste puede modificarse en la preparación del artículo.';
MLI18n::gi()->{'hood_config_prepare__field__paymentmethods__help'} = 'Configuración por defecto de los métodos de pago (seleccione varias opciones manteniendo pulsado cmd/ctrl mientras hace clic). Las opciones son las predeterminadas por Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__hitcounter__help'} = 'Preselecciones para el contador de visitas de los listados.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.carrier.default__help'} = 'Transportistas preseleccionados disponibles en Confirmar envío en Hood.de';
MLI18n::gi()->{'hood_config_prepare__legend__prepare'} = 'Preparar artículos';
MLI18n::gi()->{'hood_config_prepare__field__fixed.duration__help'} = 'Preparación de la duración de las listas de precios fijos. La configuración puede modificarse en la preparación de la partida.';
MLI18n::gi()->{'hood_config_price__field__fixed.duration__help'} = 'Preparación de la duración de las listas de precios fijos. La configuración puede modificarse en la preparación de la partida.';
MLI18n::gi()->{'hood_config_prepare__field__postalcode__label'} = 'Código postal';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.cancelled__help'} = 'Por favor, establece el estado de la tienda para eliminar el estado enviado en Hood.de.<br/><br/>.
 
 Nota: Las cancelaciones parciales no son posibles con la API de Hood.de. Con esta función, se cancela todo el pedido y se reembolsa al comprador.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.shipped__help'} = 'Por favor, configura el estado de la tienda para que se active el estado "Envío confirmado" en Hood.de.';
MLI18n::gi()->{'hood_config_account__field__mpusername__help'} = 'Por favor, introduce tu nombre de usuario Hood.de.';
MLI18n::gi()->{'hood_config_account__field__mppassword__help'} = 'Por favor, introduce tu contraseña de Hood.de.';
MLI18n::gi()->{'hood_config_prepare__legend__location__info'} = 'Por favor, introduce la ubicación de tu tienda. Ésta será visible como dirección del vendedor en Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__postalcode__help'} = 'Por favor, introduce la ubicación de tu tienda. Ésta será visible como dirección del vendedor en Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__paymentinstructions__help'} = 'Por favor, introduce aquí el texto que debe aparecer en la página del artículo bajo &apos;Instrucciones de pago del vendedor&apos;***. Máximo 500 caracteres (sólo texto, no HTML).';
MLI18n::gi()->{'hood_config_prepare__field__fixed.quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'hood_config_price__field__fixed.quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) delante del importe para indicar la reducción de precio. Precio fijo" significa que el valor introducido aquí se transferirá directamente (por ejemplo, si quieres utilizar siempre un precio inicial de 1 euro).';
MLI18n::gi()->{'hood_config_price__field__chinese.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'hood_config_price__field__fixed.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'hood_configform_account_sitenotselected'} = 'Selecciona primero el sitio web de Hood.de';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationalcontainer__help'} = 'Selecciona los métodos de envío que deseas establecer como predeterminados (o no elijas ninguno).< div class="ui-díalog-titlebar"> 
 <span>Descuento por combinación de pago y envío***</span>.
 Selección de perfil para el descuento de envío. Puedes establecer perfiles en tu cuenta de Hood.de, en Mi Hood.de > Cuenta de usuario > Configuración > Configuración de envío<br /><br />. 
 Aquí también puedes establecer las reglas para los precios especiales de envío (por ejemplo, precio máximo de envío por pedido, o envío gratuito si el artículo supera una determinada cantidad).<br /><br /> 
 <b>Ten en cuenta:</b><br /> 
 La importación de pedidos está sujeta a las reglas seleccionadas aquí (no recibimos información sobre la configuración de los artículos de Hood.de).***';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocalcontainer__help'} = 'Selecciona uno o varios métodos de envío que quieras establecer como predeterminados. <br /><br />Introduce un número para los gastos de envío (sin divisa), o "=PESO" para establecer los gastos de envío según el peso del artículo. 
 <div class="ui-díalog-titlebar">
 <span>Descuento por combinación de pago y envío***</span>.
 Selección de perfil para el descuento de envío. Puedes establecer perfiles en tu cuenta de Hood.de, en Mi Hood.de > Cuenta de usuario > Configuración > Configuración de envío<br /><br />. 
 Aquí también puedes establecer las reglas para los precios especiales de envío (por ejemplo, precio máximo de envío por pedido, o envío gratuito si el artículo supera una determinada cantidad).<br /><br /> 
 <b>Ten en cuenta:</b><br /> 
 La importación de pedidos está sujeta a las reglas seleccionadas aquí (no recibimos información sobre la configuración de los artículos de Hood.de).***';
// For shopify this hint is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyHood/I18n/Es/configForm.php
MLI18n::gi()->{'hood_config_producttemplate__field__template.name__hint'} = 'Marcador de posición: #TITLE# - Nombre del producto; #BASEPRICE# - Precio base';
MLI18n::gi()->{'hood_config_prepare__field__variationdimensionforpictures__label'} = 'Paquete de imágenes Dimensión de la variación';
MLI18n::gi()->{'hood_config_prepare__field__picturepack__label'} = 'Paquete de imágenes';
MLI18n::gi()->{'hood_config_prepare__field__paypal.address__label'} = 'Dirección de correo electrónico de PayPal';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.paymentmethod__label'} = 'Métodos de pago';
MLI18n::gi()->{'hood_config_prepare__field__paymentmethods__label'} = 'Métodos de pago';
MLI18n::gi()->{'hood_config_prepare__field__paymentinstructions__label'} = 'Instrucciones de pago';
MLI18n::gi()->{'hood_config_sync__field__synczerostock__help'} = 'Ayuda a la salida de almacén';
MLI18n::gi()->{'hood_config_sync__field__synczerostock__label'} = 'Fuera de stock';
MLI18n::gi()->{'hood_configform_stocksync_values__rel'} = 'El pedido reduce el stock de la tienda (recomendado)';
MLI18n::gi()->{'hood_config_orderimport__field__updateableorderstatus__help'} = 'Estado del pedido que puede ser activado por los pagos de Hood.de. 
 Si el pedido tiene un estado diferente, éste no puede ser modificado por un pago de Hood.de.<br /><br />.
 Si no deseas que se modifique tu estado debido al pago de Hood.de, desmarca la casilla.<br /><br />
 <b>Ten en cuenta:</b>El estado de los pedidos combinados no se modificará hasta que se paguen en su totalidad.';
MLI18n::gi()->{'hood_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido entre la tienda y Hood.de';
MLI18n::gi()->{'hood_config_orderimport__legend__orderupdate__title'} = 'Sincronización del estado del pedido';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'hood_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'hood_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationalprofile__notavailible'} = 'Sólo cuando se activa `<i>Envío Internacional</i>`.';
MLI18n::gi()->{'hood_config_prepare__field__restrictedtobusiness__help'} = 'Sólo los clientes comerciales pueden comprar los artículos.';
MLI18n::gi()->{'hood_config_prepare__field__fixed.quantity__label'} = 'Número de artículos';
MLI18n::gi()->{'hood_config_prepare__field__chinese.quantity__label'} = 'Número de artículos';
MLI18n::gi()->{'hood_config_price__field__fixed.quantity__label'} = 'número de artículos';
MLI18n::gi()->{'hood_config_general_nosync'} = 'sin sincronización';
MLI18n::gi()->{'hood_configform_prepare_hitcounter_values__NoHitCounter'} = 'ninguno';
MLI18n::gi()->{'hood_config_sync_inventory_import__false'} = 'No';
MLI18n::gi()->{'hood_config_prepare__field__dispatchtimemax__help'} = 'Tiempo máximo necesario antes de que se envíe el artículo. Esto será visible en Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__privatelisting__valuehint'} = 'Hacer que la lista de compradores y licitadores sea privada';
MLI18n::gi()->{'hood_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'hood_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'hood_config_prepare__legend__location__title'} = 'Ubicación';
MLI18n::gi()->{'hood_config_prepare__field__fixed.duration__label'} = 'duración de los listados';
MLI18n::gi()->{'hood_config_price__field__fixed.duration__label'} = 'duración de los listados';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.content__hint'} = 'Lista de marcadores de posición disponibles para Asunto y Contenido: 
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
MLI18n::gi()->{'hood_config_producttemplate__field__template.content__hint'} = 'Lista de marcadores de posición disponibles para el Contenido: 
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
 <dd>Precio por unidad de embalaje</dd>-->
 <dt>#SHORTDESCRIPTION#</dt> 
 <dd>Corta descripción de la Tienda</dd> 
 <dt>#DESCRIPTION#</dt> 
 <dd>Descripción de la tienda</dd> 
 <dt>#PICTURE1#</dt> 
 <dd>Primera imagen del producto</dd> 
 <dt>#PICTURE2# etc.</dt> 
 <dd>Segunda imagen del producto; con #PICTURE3#, #PICTURE4# etc, puedes transferir tantas imágenes como tengas disponibles en tu tienda. </dd></dl>.';
MLI18n::gi()->{'hood_config_prepare__field__maxquantity__label'} = 'Limitación del número de artículos';
MLI18n::gi()->{'hood_config_price__field__maxquantity__label'} = 'Limitación del número de artículos';
MLI18n::gi()->{'hood_config_prepare__field__dispatchtimemax__label'} = 'Plazo de entrega';
MLI18n::gi()->{'hood_config_prepare__field__lang__help'} = 'Idioma de los nombres y descripciones de los artículos. Tu tienda permite nombres y descripciones en más de un idioma; para subirlos a Hood.de, hay que seleccionar un idioma. 
 Los informes de error de Hood también se generan en el idioma seleccionado.';
MLI18n::gi()->{'hood_config_prepare__field__lang__label'} = 'Idioma';
MLI18n::gi()->{'hood_config_prepare__field__restrictedtobusiness__valuehint'} = 'Los artículos sólo pueden ser comprados por clientes comerciales';
MLI18n::gi()->{'hood_config_prepare__legend__upload'} = 'Cargar preajustes de elementos';
MLI18n::gi()->{'hood_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'hood_config_sync__field__chinese.inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'hood_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'hood_config_prepare__field__conditiontype__help'} = 'Especifica el estado del artículo (para las categorías de Hood.de que requieren u ofrecen esta opción). No todas las descripciones son válidas para todas las categorías. Una vez seleccionada la categoría, asegúrate de que el estado del artículo es correcto.';
MLI18n::gi()->{'hood_config_prepare__field__conditiontype__label'} = 'Estado del artículo';
MLI18n::gi()->{'hood_config_sync__legend__sync__title'} = 'Sincronización de inventarios';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationalcontainer__label'} = 'Envíos internacionales';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocalcontainer__label'} = 'Transporte marítimo interior';
MLI18n::gi()->{'hood_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda de la cesta de la compra). <br><br>Además, puedes activar la comparación de existencias a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa plana*** o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'hood_config_orderimport__field__importonlypaid__label'} = 'Importar sólo los pedidos marcados como "pagados".';
MLI18n::gi()->{'hood_config_prepare__field__imagesize__label'} = 'Tamaño de la imagen';
MLI18n::gi()->{'hood_config_prepare__legend__pictures'} = 'Configuración de la imagen';
MLI18n::gi()->{'hood_config_sync__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en Hood.de, el inventario de la tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!';
MLI18n::gi()->{'hood_config_prepare__field__variationdimensionforpictures__help'} = 'Si has guardado imágenes de variación con los datos de tu producto, el Paquete de imágenes las enviará a Hood.de con la carga del producto.
 Hood.de sólo permite una dimensión de variación: Por ejemplo, si tomas el color, la imagen principal de la página de producto de Hood.de cambiará si el comprador selecciona un color diferente.<br /><br /> <br />. 
 Esta configuración es la predeterminada. Puedes cambiarla en el formulario de preparación de cada producto. <br /> 
 Si quieres cambiarlo más tarde, tienes que preparar y subir el producto de nuevo.';
MLI18n::gi()->{'hood_config_sync__field__syncproperties__help'} = 'Si activas la sincronización EAN y MPN, podrás transferir los valores correspondientes a Hood.de con un solo clic (medíante el nuevo botón de sincronización situado a la izquierda del botón de importación de pedidos).<br />
 <br />
 Esto también sincroniza los artículos que no aparecen en magnalister. El stock de Hood.de se indica mediante el número de artículo, siempre que sea idéntico tanto en Hood.de como en tu tienda online (compara en &ldquo;magnalister&rdquo; > &ldquo;Hood.de&rdquo; > &ldquo;Stock&rdquo;). La primera sincronización puede tardar hasta 24 horas.<br />
 <br />
 Para las <b>Variaciones</b>, se utiliza el EAN del artículo maestro, si no se encuentra ningún EAN para la variación en la base de datos de la tienda (la mayoría de los sistemas de tienda de la familia OsCommerce no pueden manejar los EAN de las variaciones). Si no hay un EAN para el artículo principal, y no todas las variaciones tienen EAN, uno de los EAN existentes se utilizará también para las variaciones restantes del artículo. Si has reservado el complemento "Sincronización EAN y NMP", los valores también se rellenan durante la sincronización "normal" de precios y existencias.<br />
 <br />
 *También puedes introducir el ISBN o el UPC en el campo EAN. magnalister reconoce automáticamente qué número de identificación has introducido.<br /><br />
 <b>Importante</b> para osCommerce: Instalación de la expansión de EAN<br />
 osCommerce no tiene por defecto ningún campo para el EAN. ante en contacto con nosotros para obtener más información sobre cómo ampliar la base de datos de la tienda y los formularios para que gestionen EAN.<br /><br />
 <b>Consejos:</b><br />
 Hood.de te permite enviar números comodín para EAN y MPN en lugar del número real. Los productos con estos números comodín tendrán una clasificación inferior en Hood.de, lo que significa que no se encontrarán tan fácilmente.<br />
 <br />
 magnalister transfiere estos números comodín desde Hood.de para los artículos en los que no se encuentra ningún EAN o MPN para que puedas realizar cambios en los artículos existentes.';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.closed__help'} = 'Si un pedido se establece en uno de los estados de pedido seleccionados, los nuevos pedidos de ese cliente no se añadirán a ese estado de pedido.<br />
 Si no quieres un resumen de pedido, selecciona cada estado de pedido.***';
MLI18n::gi()->{'hood_config_orderimport__field__mwstfallback__help'} = 'Si un artículo no se introduce a través de magnalister, no se puede calcular el IVA. <br /> 
 El valor porcentual introducido aquí se tomará como tipo de IVA para todos los pedidos importados en Hood.de.';
MLI18n::gi()->{'hood_config_account__field__token__label'} = 'hitmeister_prepareform_labelprice';
MLI18n::gi()->{'hood_config_sync__legend__stocksync'} = 'hitmeister_prepareform_labelfixprice';
MLI18n::gi()->{'hood_config_account__field__site__label'} = 'hitmeister_prepareform_delivery_description';
MLI18n::gi()->{'hood_config_prepare__field__hoodplus__label'} = 'hitmeister_prepareform_days';
MLI18n::gi()->{'hood_config_account__field__mppassword__label'} = 'hitmeister_prepare_form__legend__templates';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.paid__label'} = 'hitmeister_prepare_form__legend__shipping';
MLI18n::gi()->{'hood_config_account__field__mpusername__label'} = 'hitmeister_prepare_form__legend__price';
MLI18n::gi()->{'hood_config_account__field__apikey__label'} = 'hitmeister_prepare_form__legend__details';
MLI18n::gi()->{'hood_config_prepare__field__hitcounter__label'} = 'Contador de golpes';
MLI18n::gi()->{'hood_configform_prepare_hitcounter_values__HiddenStyle'} = 'oculto';
MLI18n::gi()->{'hood_config_prepare__field__maxquantity__help'} = 'Aquí puedes limitar el número de artículos publicados en Hood.de.<br /><br />. 
 <strong>Ejemplo:</strong>. 
 Para el "número de artículos" selecciona "tomar del inventario de la tienda" e introduce "20" en este campo. Al subir el número de artículos se tomará del inventario disponible pero no más de 20. La sincronización de inventario (si está activada) adaptará el número de artículos en Hood.de al inventario de la tienda siempre que el inventario de la tienda sea inferior a 20. Si hay más de 20 artículos en el inventario, el número de artículos en Hood.de se ajustará a 20.<br /><br />.
 Introduce "0" o deja este campo en blanco si no deseas una limitación.<br /><br /> 
 <strong>Consejo:</strong>. 
 Si la opción "número de elementos" es "global (del campo de la derecha)", la limitación no tiene efecto.';
MLI18n::gi()->{'hood_config_price__field__maxquantity__help'} = 'Aquí puedes limitar el número de artículos publicados en Hood.de.<br /><br />. 
 <strong>Ejemplo:</strong>. 
 Para el "número de artículos" selecciona "tomar del inventario de la tienda" e introduce "20" en este campo. Al subir el número de artículos se tomará del inventario disponible pero no más de 20. La sincronización de inventario (si está activada) adaptará el número de artículos en Hood.de al inventario de la tienda siempre que el inventario de la tienda sea inferior a 20. Si hay más de 20 artículos en el inventario, el número de artículos en Hood.de se ajustará a 20.<br /><br />.
 Introduce "0" o deja este campo en blanco si no deseas una limitación.<br /><br /> 
 <strong>Consejo:</strong>. 
 Si la opción "número de elementos" es "global (del campo de la derecha)", la limitación no tiene efecto.';
MLI18n::gi()->{'hood_config_prepare__field__useprefilledinfo__help'} = 'Función activada: Mostrar la información del producto de Hood.de, si se encuentra. Sólo aplicable si se utiliza el EAN.';
MLI18n::gi()->{'hood_configform_orderimport_payment_values__textfield__title'} = 'Desde el campo de texto';
MLI18n::gi()->{'hood_configform_orderimport_shipping_values__textfield__title'} = 'Desde el campo de texto';
MLI18n::gi()->{'hood_config_account__field__site__help'} = '¿Para qué país deben figurar sus productos?';
MLI18n::gi()->{'hood_config_sync__field__chinese.stocksync.frommarketplace__help'} = 'Por ejemplo, si un artículo se compra tres veces en Hood.de, el inventario de la tienda se reducirá en 3.';
MLI18n::gi()->{'hood_configform_price_chinese_quantityinfo'} = 'En las subastas ascendentes, la cantidad solo puede ser exactamente 1.';
MLI18n::gi()->{'hood_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'hood_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.de';
MLI18n::gi()->{'hood_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.closed__label'} = 'Resumen del pedido final***';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.sendmail__label'} = 'Envío por correo electrónico';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'hood_config_sync__field__syncproperties__label'} = 'Sincronización de EAN, MPN y fabricante';
MLI18n::gi()->{'hood_config_prepare__field__chinese.duration__label'} = 'Duración de la subasta en línea';
MLI18n::gi()->{'hood_config_price__field__chinese.duration__label'} = 'Duración de la subasta en línea';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternational__optional__select__false'} = 'No hagas envíos internacionales';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocalprofile__optional__select__false'} = 'No utilices el perfil de envío';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationalprofile__optional__select__false'} = 'No utilices el perfil de envío';
MLI18n::gi()->{'hood_config_sync__legend__sync__info'} = 'Determina qué atributos de los productos de tu tienda deben actualizarse automáticamente en Hood.de.<br /><br /><b>Configuración de listados de precio fijo</b>.';
MLI18n::gi()->{'hood_config_prepare__field__shippingtime.min__label'} = 'Tiempo de entrega (min)';
MLI18n::gi()->{'hood_config_prepare__field__shippingtime.max__label'} = 'Plazo de entrega (máx.)';
MLI18n::gi()->{'hood_config_price__field__fixed.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'hood_config_price__field__fixed.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'hood_config_price__field__chinese.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'hood_config_price__field__chinese.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'hood_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'hood_config_account__field__currency__label'} = 'Moneda';
MLI18n::gi()->{'hood_config_prepare__field__country__label'} = 'País';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.copy__label'} = 'Copiar al remitente';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'hood_config_prepare__field__location__label'} = 'Ciudad';
MLI18n::gi()->{'hood_config_prepare__field__topten__label'} = 'Selección rápida de categorías';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.carrier.default__label'} = 'Portador';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.revoked__label'} = 'Cancelar (vía cliente)';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.nostock__label'} = 'Cancelar (no se puede entregar)';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.defect__label'} = 'Cancelar (el artículo es defectuoso)';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.nopayment__label'} = 'Cancelar (el cliente no ha pagado)';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price__label'} = 'Precio de compra';
MLI18n::gi()->{'hood_config_prepare__field__productfield.brand__label'} = 'Marca';
MLI18n::gi()->{'hood_configform_prepare_hitcounter_values__BasicStyle'} = 'sencillo';
MLI18n::gi()->{'hood_config_price__field__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'hood_config_general_autosync'} = 'Sincronización automática mediante CronJob (recomendado)';
MLI18n::gi()->{'hood_configform_orderimport_payment_values__matching__title'} = 'Tomar del marketplace';
MLI18n::gi()->{'hood_configform_orderimport_shipping_values__matching__title'} = 'Tomar del marketplace';
MLI18n::gi()->{'hood_config_prepare__field__privatelisting__help'} = 'Activa esta opción para marcar las ofertas como "privadas". Esto hará que tu lista de compradores/ofertantes no sea visible públicamente.';
MLI18n::gi()->{'hood_config_orderimport__field__update.orderstatus__label'} = 'Activa la actualización del estado';
MLI18n::gi()->{'hood_config_sync__field__syncrelisting__valuehint'} = 'Activa ReList';
MLI18n::gi()->{'hood_config_prepare__field__picturepack__valuehint'} = 'Activa el paquete de imágenes';
MLI18n::gi()->{'hood_config_sync__field__synczerostock__valuehint'} = 'Activa OutOfStock';
MLI18n::gi()->{'hood_config_orderimport__field__importactive__label'} = 'Activa la importación';
MLI18n::gi()->{'hood_config_sync__field__syncproperties__valuehint'} = 'Activa la sincronización de EAN, MPN y fabricante';
MLI18n::gi()->{'hood_config_price__field__buyitnowprice__label'} = 'Activo precio de compra';
MLI18n::gi()->{'hood_config_emailtemplate__field__mail.copy__help'} = 'Se enviará una copia a la dirección de correo electrónico del remitente.';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__9'} = '9 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__8'} = '8 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__7'} = '7 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__6'} = '6 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__5'} = '5 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__4'} = '4 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__30'} = '30 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__3'} = '3 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__29'} = '29 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__28'} = '28 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__27'} = '27 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__26'} = '26 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__25'} = '25 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__24'} = '24 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__23'} = '23 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__22'} = '22 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__21'} = '21 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__20'} = '20 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__2'} = '2 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__19'} = '19 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__18'} = '18 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__17'} = '17 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__16'} = '16 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__15'} = '15 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__14'} = '14 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__13'} = '13 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__12'} = '12 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__11'} = '11 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__10'} = '10 días';
MLI18n::gi()->{'hood_configform_prepare_dispatchtimemax_values__1'} = '1 día';
MLI18n::gi()->{'hood_config_prepare__field__imagesize__help'} = '<p>Introduce la anchura en píxeles de la imagen tal y como debe aparecer en el marketplace. La altura se ajustará automáticamente en función de la relación de aspecto original. </p> 
 <p>Los archivos de origen se procesarán desde la carpeta de imágenes {#setting:sSourceImagePath#}, y se almacenarán en la carpeta {#setting:sImagePath#} con la anchura en píxeles seleccionada para su uso en el marketplace.</p>';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Método de pago que se aplicará a todos los pedidos importados de Hood.de. Estándar: "Asignación automática"</p> 
 <p>Si eliges "Asignación automática", magnalister aceptará el método de pago elegido por el comprador en Hood.de.</p> 
 <p>Añade métodos de pago adicionales a la lista a través de Shopware > Configuración > Métodos de pago, y luego actívalos aquí.</p> 
 <p>Estos ajustes son necesarios para la factura y la notificación de envío, y para editar los pedidos más tarde en el Shopware o a través del ERP.</p>';
MLI18n::gi()->{'hood_config_orderimport__field__importonlypaid__help'} = '<p> Al activar esta función, los pedidos de Hood sólo se importan cuando se marcan en Hood como "Pagados". En caso de PayPal, Amazon Pay o Transferencia Bancaria Instantánea, esto ocurre automáticamente. De lo contrario, el pedido debe estar marcado en Hood como "Pagado".
 </p><p> 
 <strong>Beneficio:</strong> 
 El pedido importado puede enviarse inmedíatamente. Para PayPal y Amazon Pay, el código de transacción está disponible para tu ERP.</p>';
MLI18n::gi()->{'hood_config_orderimport__field__importonlypaid__alert'} = '<p> Al activar esta función, los pedidos de Hood sólo se importan cuando se marcan en Hood como "Pagados". En caso de PayPal, Amazon Pay o Transferencia Bancaria Instantánea, esto ocurre automáticamente. De lo contrario, el pedido debe estar marcado en Hood como "Pagado".
 </p><p> 
 <strong>Beneficio:</strong> 
 El pedido importado puede enviarse inmedíatamente. Para PayPal y Amazon Pay, el código de transacción está disponible para tu ERP.</p>';
MLI18n::gi()->{'hood_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'hood_config_sync__field__inventorysync.price__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>La función &apos;Sincronización automática&apos; sincroniza el precio de Hood.de con el precio de la Tienda cada 4 horas, a partir de las 0.00 horas (con ***, dependiendo de la configuración).<br>Los valores serán transferidos desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br> 
 Algunas peticiones de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana*** o si la petición se realiza más de una vez cada 4 horas. 
 </dd> 
 <dt>La edición de pedidos / artículos sincronizará Hood.de y el precio de la Tienda. </dt> 
 <dd>Si se cambia el precio de la Tienda al editar un artículo, el precio actual de la Tienda se transferirá entonces a Hood.de.<br> 
 ¡Los cambios que sólo se realizan en la base de datos, por ejemplo a través de un ERP, <b>no se</b> registran ni se transmiten!</dd>
 <dt>La edición de artículos cambia el precio de Hood.de.</dt> 
 <dd>Si cambias el precio del artículo en la tienda, en "Editar artículo", el precio actual del artículo se transfiere a Hood.de.<br> 
 ¡Los cambios que sólo se realizan en la base de datos, por ejemplo a través de un ERP, <b>no se</b> registran ni se transmiten!</dd>
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'hood_config_sync__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de Hood.de ser sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con ***, dependiendo de la configuración).<br>Los valores serán transferidos desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa plana*** - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br> 
 Algunas peticiones de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana*** o si la petición se realiza más de una vez cada 4 horas. 
 </dd> 
 <dt>La edición de pedidos / artículos sincronizará el stock de Hood.de y de la tienda. </dt> 
 <dd>Si el inventario de la tienda se modifica debido a un pedido o a la edición de un artículo, el inventario actual de la tienda se transferirá entonces a Hood.de.<br> 
 ¡Los cambios que sólo se realizan en la base de datos, por ejemplo a través de un ERP, <b>no se</b> registran ni se transmiten!</dd>
 <dt>La edición de pedidos / artículos cambia el inventario de Hood.de.</dt> 
 <dd>Por ejemplo, si un artículo de la tienda se compra dos veces, el inventario de Hood.de se reducirá en 2.<br /> Si cambias el importe del artículo en la tienda en <strong>Editar artículo</strong>, la diferencia se suma o se resta del importe anterior.<br> 
 ¡Los cambios que sólo se realizan en la base de datos, por ejemplo a través de un ERP, <b>no se</b> registran ni se transmiten!</dd>
 </dl> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
// For shopify this help is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyHood/I18n/Es/configForm.php
MLI18n::gi()->{'hood_config_producttemplate__field__template.name__help'} = '<dl> 
 <dt>Nombre del producto en Hood.de</dt> 
 <dd>Decide cómo nombrar el producto en Hood.de. 
 El marcador de posición <b>#TITLE#</b> será sustituido por el nombre del producto de la tienda, 
 <b>#BASEPRICE#</b> por el precio por unidad, siempre que el dato exista en la tienda.</dd> 
 <dt>Ten en cuenta:</dt> 
 <dd>El marcador de posición <b>#BASEPRICE#</b> no es necesario en la mayoría de los casos, ya que enviamos los precios base automáticamente a Hood.de, si se rellena en la Tienda y se permite para la categoría de Hood.de.</dd> 
 <dd>Utiliza este marcador de posición si tienes unidades no métricas (que Hood.de no ofrece), o si quieres mostrar precios base en categorías en las que Hood.de no los ofrece.</dt> 
 <dd>Si utilizas este marcador de posición, <b>desactiva la sincronización de precios</b>. El título del artículo no se puede cambiar en Hood.de. Por lo tanto, si el precio cambia, el precio base dentro del título ya no se ajustará.</dd> 
 <dd><b>#BASEPRICE#</b> se reemplaza mientras se sube el producto a Hood.de.</dd> 
 <dd>Hood.de no puede manejar <b>diferentes precios base para Variaciones</b>. Por lo tanto, lo añadimos a los títulos de las Variaciones.</dd> 
 <dd>Ejemplo: 
 <br />&nbsp;Grupo de variaciones: cantidad de relleno<ul> 
 <li>Variación: 0,33 l (3 EUR / l)</li> 
 <li>Variación: 0,5 l (2,50 EUR / l)</li> 
 <li>etc.</li></ul></dd> 
 <dd>En este caso, por favor <b>desactiva la sincronización de precios</b> (porque los títulos de la Variación no se pueden cambiar en Hood.de).</dd> 
 <dl>dd';
MLI18n::gi()->{'hood_config_sync__field__chinese.inventorysync.price__help'} = '<dl> 
 <dt>Sincronización automática por CronJob</dt> 
 <dd>La función "Sincronización automática por CronJob" iguala el precio actual de _#_nombredelaplataforma_#_ con el precio de la tienda cada 4 horas (comienza a las 0 pm).<br /><br /> 
 Este procedimiento comprueba si se han producido cambios en los valores de la base de datos. Los nuevos datos se mostrarán, aunque los cambios hayan sido establecidos por un sistema de gestión de mercancías.
 <br/><br/>Puedes sincronizar los cambios de precios manualmente haciendo clic en el botón de la cabecera de magnalister, a la izquierda del logotipo de la hormiga.
 <br/><br/>Además, puedes sincronizar los cambios de precios estableciendo un cronjob personalizado en el siguiente enlace de tu tienda:<br/>
 <i>http://www.YourShop.com/magnaCallback.php?do=SyncInventory</i><br/><br/>El establecimiento de un cronjob propio está permitido para los clientes dentro del plan de servicio "Flat", solamente.
 <br/><br/>Las llamadas del cronjob propio, que superen un cuarto de hora, o las llamadas de los clientes, que no están dentro del plan de servicio "Flat", serán bloqueadas. 
 </dl><br/> 
 <b>Avisos:</b><ul><li>Los ajustes en "Configuración" &rarr; "Cálculo de precios" serán proporcionados.</li> 
 <li>Una vez realizadas las pujas de una Subasta, no se permiten cambios.</li></ul>';
MLI18n::gi()->{'hood_config_sync__field__chinese.stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática por CronJob (recomendado)</dt> 
 <dd>La función "Sincronización automática por CronJob" comprueba el stock de la tienda cada 4 horas, y borra las subastas de Hood.de para los artículos que ya no están disponibles en la tienda.<br /><br /> 
 Este procedimiento comprueba si se han producido cambios en los valores de la base de datos. Los nuevos datos se mostrarán, aunque los cambios hayan sido establecidos por un sistema de gestión de mercancías.
 <br/><br/>Puedes sincronizar los cambios de precios manualmente haciendo clic en el botón de la cabecera de Magnalister, a la izquierda del logotipo de la hormiga.
 <br/><br/>Además, puedes sincronizar los cambios de precios estableciendo un cronjob personalizado en el siguiente enlace de tu tienda:<br/>
 <i>http://www.YourShop.com/magnaCallback.php?do=SyncInventory</i><br><br> 
 Establecer un cronjob propio está permitido para los clientes dentro del plan de servicio "Flat", solamente.<br><br> Las llamadas de cronjob propias que superen un cuarto de hora, o las llamadas de clientes que no estén dentro del plan de servicio "Flat", serán bloqueadas. 
 <dt>Reducción de la cantidad de pedidos / existencias</dt> 
 <dd>Si las existencias se reducen a 0 por un Pedido en la tienda, o por la edición del artículo en la tienda, la subasta resp. Hood.de subasta se borra. 
 <br>¡Los cambios dentro de la base de datos solamente (por ejemplo, por un sistema de gestión de inventario), no <b>se capturarán y enviarán!</dd> 
 </dl><br> 
 <b>Aviso:</b> <ul><li>Una vez realizadas las pujas de una Subasta, no se permiten cambios.</li></ul>';
MLI18n::gi()->{'hood_config_prepare__legend__payment'} = '<b>Configuración de los métodos de pago</b>';
MLI18n::gi()->{'hood_config_price__legend__fixedprice'} = '<b>Configuración de los listados de precio fijo</b>';
MLI18n::gi()->{'hood_config_prepare__legend__fixedprice'} = '<b>Opción de listas de precios fijos</b>';
MLI18n::gi()->{'hood_config_prepare__legend__misc'} = '<b>Varios</b>';
MLI18n::gi()->{'hood_config_prepare__legend__chineseprice'} = '<b>Configuración de la subasta</b>';
MLI18n::gi()->{'hood_config_price__legend__chineseprice'} = '<b>Configuración de la subasta</b>';
MLI18n::gi()->{'hood_config_sync__legend__syncchinese'} = '<b>Configuración de la subasta</b>';
MLI18n::gi()->{'hood_config_prepare__field__hoodplus__help'} = '<a href="http://verkaeuferportal.hood.de/hood-plus" target="_blank">Hood.de Plus</a> se puede activar a través de tu cuenta de Hood.de si Hood.de ha activado la función para ti. Actualmente, esta función sólo se ofrece para Hood.de Alemania.<br /><br />
 La casilla que se encuentra aquí es una configuración por defecto para subir a través de Magnalister. Puede marcarse si Hood.de Plus está activo en tu cuenta. No afecta a la configuración por defecto para los artículos de Hood.de (sólo se puede activar a través de tu cuenta de Hood.de).<br /><br /> 
 Si la casilla no se puede seleccionar aunque hayas activado la función en Hood.de, guarda tu configuración (magnalister recuerda la última configuración de Hood.de en este contexto).<br /><br /> 
 <b>Consejo:</b> 
 <ul> 
 <li>Se deben cumplir condiciones adicionales para los listados de Hood.de Plus:
 Periodo de reenvío de 1 mes, posibilidad de pago por paypal, un <a href="http://verkaeuferportal.hood.de/versand-bei-hood-plus" target="_blank">método de envío que esté acreditado por Hood.de</a>.
 No recibiremos respuesta</b> de eBay si estas condiciones son correctas. Tienes que encargarte tú mismo de esto.
 <li> Por favor, permite que se modifique el pedido (mediante la sincronización de pedidos) o utiliza la función &quoimportar pedidos marcados como pagados&quot (vie importación de pedidos). La etiqueta Hood.de plus no se transmite con el primer pedido. Se transmite en cuanto el comprador ha seleccionado el método de pago y envío.</li> 
 <li>A veces parece que los pedidos de Hood.de plus se transmiten sin métodos de pago autorizados. En estos casos se mostrará un aviso previo en la vista detallada del pedido.</li></ul>';
MLI18n::gi()->{'hood_config_prepare__field__shippinglocalprofile__option'} = '{#NAME#} ({#AMOUNT#} por artículo adicional)';
MLI18n::gi()->{'hood_config_prepare__field__shippinginternationalprofile__option'} = '{#NAME#} ({#AMOUNT#} por artículo adicional)';
MLI18n::gi()->{'hood_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'hood_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'hood_configform_orderstatus_sync_values__no'} = '{#i18n:hood_config_general_nosync#}';
MLI18n::gi()->{'hood_configform_sync_values__no'} = '{#i18n:hood_config_general_nosync#}';
MLI18n::gi()->{'hood_configform_stocksync_values__no'} = '{#i18n:hood_config_general_nosync#}';
MLI18n::gi()->{'hood_configform_pricesync_values__no'} = '{#i18n:hood_config_general_nosync#}';
MLI18n::gi()->{'hood_configform_sync_chinese_values__no'} = '{#i18n:hood_config_general_nosync#}';
MLI18n::gi()->{'hood_configform_orderstatus_sync_values__auto'} = '{#i18n:hood_config_general_autosync#}';
MLI18n::gi()->{'hood_configform_sync_values__auto'} = '{#i18n:hood_config_general_autosync#}';
MLI18n::gi()->{'hood_configform_pricesync_values__auto'} = '{#i18n:hood_config_general_autosync#}';
MLI18n::gi()->{'hood_configform_sync_chinese_values__auto'} = '{#i18n:hood_config_general_autosync#}';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'hood_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'hood_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'hood_config_price__field__fixed.priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'hood_config_price__field__chinese.priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'hood_config_emailtemplate_content'} = '<style><!--
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
 <p>Hola, #NOMBRE# #APELLIDO#:</p>
 <p>Muchas gracias por tu pedido. Has realizado un pedido en nuestra tienda a través de #MARKETPLACE#:
 </p>#RESUMENPEDIDO#
 <p>Se aplican además gastos de envío.
 </p><p>&nbsp;</p>
 <p>Saludos,</p>
 <p>El equipo de la tienda online</p>';
MLI18n::gi()->{'hood_config_prepare__field__picturepack__help'} = '<b>Paquete de imágenes</b><br /><br /> 
 Si activas la función &quot;Paquete de imágenes&quot;, puedes mostrar hasta 12 imágenes por cada artículo. El comprador puede ver las imágenes en un formato mayor y ampliar partes de la imagen. No se requiere ninguna configuración especial en tus cuentas de Hood.de.<br /><br /> 
 <b>Imágenes de variación</b><br /><br /> 
 Si tienes imágenes de variaciones de un artículo, también puedes transferirlas a Hood.de (hasta 12 imágenes por variación)..<br /><br /> 
 <b>Nota</b><br /><br /> 
 magnalister sólo puede procesar los datos proporcionados por tu sistema de tienda. Si tu sistema de tienda no admite imágenes de variación, esta función no estará disponible en magnalister.<br /><br /> 
 <b>&quot;Imágenes de gran tamaño&quot; y &quot;Zoom&quot; </b><br /><br /> 
 Por favor, utiliza imágenes de tamaño suficiente para poder utilizar las funciones &quot;Imágenes grandes&quot; y &quot;Zoom&quot;. Si una imagen es demasiado pequeña (menos de <b>1000px</b> en el lado más largo), se utilizará pero recibirás una advertencia en la vista de registro de errores de magnalister.<br /><br /> 
 <b>Uso de direcciones https para imágenes (URLs seguras)</b><br /><br /> 
 Hood.de no permite URL seguras para las imágenes si se especifican directamente como dirección en los datos del artículo. Nuestro paquete de imágenes utiliza el servicio de imágenes de Hood.de para almacenar las imágenes, por lo que sí admite URL seguras.<br /><br /> 
 <b>Duración del procesamiento</b><br /><br /> 
 Con el paquete de imágenes, las imágenes se suben primero a Hood.de y luego se adjuntan al artículo correspondiente. Esto puede llevar entre 2 y 5 segundos por imagen, dependiendo del tamaño de la misma.<br /><br /> 
 Para que la tienda tenga una velocidad de procesamiento razonable, los datos se almacenan en el servidor de magnalister. Los posibles mensajes de error de Hood.de se pueden ver en el registro de errores de magnalister sólo después de que se haya completado la carga a Hood.de..<br /><br />
 <b>Actualización de imágenes en Hood.de</b><br /><br /> 
 Con el paquete de imágenes, sólo tienes que cambiar la imagen en tu tienda y volver a subir el artículo para que el cambio sea visible en Hood.de.<br /> 
 Sin ella, una imagen en Hood.de sólo cambiará si cambias la URL de la imagen (y luego subes el artículo).<br /><br /> 
 <b>Posibles tarifas en la parte de Hood.de</b><br /><br /> 
 El uso del Paquete de Imágenes es gratuito para los sitios de Hood.de en Alemania y Austria. Para otros países, consulta las páginas de ayuda de Hood.de o el soporte de Hood.de del país correspondiente.<br /><br /> 
 RedGecko GmbH no se hace responsable de las tasas de Hood.de causadas.';
MLI18n::gi()->{'hood_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'hood_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'hood_config_account__field__username__label'} = '';
MLI18n::gi()->{'hood_config_account__field__username__help'} = '';
MLI18n::gi()->{'hood_config_account__field__password__label'} = '';
MLI18n::gi()->{'hood_config_account__field__password__help'} = '';

MLI18n::gi()->{'hood_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'hood_config_prepare__field__shippingtime.min__help'} = 'Introduzca aquí el plazo de entrega más corto (en forma de número). Utilice 0 si realiza la entrega el mismo día. Si no introduce un número aquí, se utilizará el valor almacenado en su cuenta de Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__returnsellerprofile__label'} = 'Condiciones generales: Amortización';
MLI18n::gi()->{'hood_config_prepare__field__returnsellerprofile__help'} = '
                <b>Seleccione el perfil de condiciones generales para devoluciones</b><br /><br />
                Está utilizando la función "Condiciones generales para sus ofertas" en Hood.de. Esto significa que las opciones de pago, envío y devolución ya no se pueden seleccionar individualmente, sino que están determinadas por la información del perfil respectivo en Hood.de.<br /><br />
                Seleccione aquí el perfil preferido para la política de devoluciones.
            ';
MLI18n::gi()->{'hood_config_sync__legend__stocksync__title'} = 'Sincronización de capó a tienda';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.sendmail__help'} = 'Si activa esta opción, Hood.de informará al comprador del cambio de estado por correo electrónico.';
MLI18n::gi()->{'hood_config_prepare__field__shippingtime.max__help'} = 'Introduce aquí el plazo de entrega más largo (en forma de número). Utiliza 0 si realizas la entrega el mismo día. Si no introduce un número aquí, se utilizará el valor almacenado en su cuenta de Hood.de.';
MLI18n::gi()->{'hood_config_prepare__field__returnsellerprofile__help_subfields'} = '                <b>Nota</b>:<br />
                Este campo no es editable ya que está utilizando el framework Hood.de. Por favor, utiliza el campo de selección
                <b>Condiciones generales: Canje</b> para definir el perfil de las condiciones de canje.
            ';
MLI18n::gi()->{'hood_config_price__field__fixed.price.group__label'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.group__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.addkind__label'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.paymentmethod__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.factor__label'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__updateable.orderstatus__label'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price.addkind__label'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.group__label'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price.factor__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.revoked__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.addkind__label'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.addkind__hint'} = '';
MLI18n::gi()->{'hood_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.factor__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'hood_config_orderimport__legend__orderupdate__info'} = '';
MLI18n::gi()->{'hood_config_price__field__buyitnowprice__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.priceoptions__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.priceoptions__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.nopayment__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.defect__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__updateable.orderstatus__help'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price.group__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.factor__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.price.addkind__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price.addkind__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.price.factor__label'} = '';
MLI18n::gi()->{'hood_config_account__field__mpusername__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderstatus.canceled.nostock__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__fixed.price.factor__label'} = '';
MLI18n::gi()->{'hood_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'hood_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'hood_config_orderimport__field__orderimport.shippingmethod__hint'} = '';
MLI18n::gi()->{'hood_config_price__field__chinese.buyitnow.priceoptions__hint'} = '';
MLI18n::gi()->{'hood_config_account__field__apikey__help'} = '';