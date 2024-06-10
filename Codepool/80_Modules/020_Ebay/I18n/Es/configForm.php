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
MLI18n::gi()->{'ebay_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'ebay_config_prepare__field__paymentsellerprofile__help'} = 'Utiliza la función "Encuadrar condiciones de venta" de eBay. Esto significa que las condiciones de pago, envío y entrega no se pueden seleccionar individualmente. Las condiciones se toman ahora del perfil de eBay.
 Seleccione el perfil que prefiera para las condiciones de pago. Es obligatorio. Puedes seleccionar un perfil diferente en la preparación del artículo si tienes varios perfiles de eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__mwst__hint'} = 'Tipo de IVA en %';
MLI18n::gi()->{'ebay_config_orderimport__field__mwstfallback__label'} = 'IVA sobre artículos no disponibles en la tienda.';
MLI18n::gi()->{'ebay_config_prepare__field__mwst__label'} = 'IVA';
MLI18n::gi()->{'ebay_config_orderimport__legend__mwst'} = 'IVA';
MLI18n::gi()->{'ebay_config_prepare__field__usevariations__label'} = 'Variaciones';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.usespecialoffer__label'} = 'Utiliza el precio especial de la tienda online como precio de venta en el marketplace.';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.usespecialoffer__label'} = 'Utiliza el precio especial de la tienda online como precio de venta en el marketplace.';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocaldiscount__label'} = 'Utilizar reglas especiales de precios de envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationaldiscount__label'} = 'Utilizar reglas especiales de precios de envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalprofile__optional__select__true'} = 'Aplicar perfil de envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__optional__select__true'} = 'Utilizar el perfil de envío';
MLI18n::gi()->{'ebay_config_orderimport__field__updateableorderstatus__label'} = 'Actualizar el estado del pedido cuando';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.cancelled__label'} = 'Deshacer la confirmación del envío con';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.canceled__label'} = 'Deshacer la confirmación del envío cuando';
MLI18n::gi()->{'ebay_config_prepare__field__usevariations__valuehint'} = 'Variaciones de la transferencia';
MLI18n::gi()->{'ebay_config_account__field__token__help'} = 'Para solicitar una nueva cuenta de eBay, haz clic en el botón. < br>
 Si no se abre eBay en una ventana nueva, desactiva tu bloqueador de ventanas emergentes. < br>< br>
 La contraseña es necesaria para acceder a eBay a través de la interfaz magnalister. < br>
 Sigue los pasos de la ventana de eBay para solicitar una contraseña y conectar tu tienda a eBay a través de magnalister.';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.returnswithin__help'} = 'Plazo en el que se aceptarán las devoluciones.';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en eBay.<br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 
 <br /><br 
 />Esta función es útil cuando se marca el precio hacia arriba o hacia abajo. 
 <br/> Deja este campo en blanco si no quieres introducir una cantidad decimal. 
 <br/>El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en eBay.<br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 
 <br /><br 
 />Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. 
 <br/> Deja este campo en blanco si no quieres introducir una cantidad decimal. 
 <br/>El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.signal__help'} = 'Este campo de texto muestra el valor decimal que aparecerá en el precio del artículo en eBay.<br/><br/> 
 <strong>Ejemplo:</strong> <br /> 
 Valor en textfeld: 99 <br /> 
 Precio original: 5,58 <br /> 
 Importe final: 5,99 
 <br /><br 
 />Esta función es útil cuando se marca el precio hacia arriba o hacia abajo***. 
 <br/> Deja este campo en blanco si no quieres introducir una cantidad decimal. 
 <br/>El formato requiere un máximo de 2 números.';
MLI18n::gi()->{'ebay_config_orderimport__field__mwstfallback__hint'} = 'El tipo impositivo que se aplicará a los artículos no pertenecientes a la tienda en las importaciones de pedidos, en %.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__SELLER_CANCEL'} = 'El vendedor ha cancelado el pedido.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__OTHER_ADJUSTMENT'} = 'El comprador ha solicitado el reembolso sin aportar ningún motivo.';
MLI18n::gi()->{'ebay_config_prepare__field__paypal.address__help'} = 'La dirección de correo electrónico proporcionada a eBay para los pagos de PayPal. Esto es necesario para cargar los artículos de la tienda de eBay.';
MLI18n::gi()->{'ebay_config_orderimport__field__preimport.start__help'} = 'La fecha a partir de la cual se importarán los pedidos. Ten en cuenta que no es posible fijar esta fecha demasiado lejos en el pasado, ya que los datos sólo estarán disponibles en DaWanda durante unas semanas.';
MLI18n::gi()->{'ebay_config_orderimport__field__customergroup__help'} = 'El grupo de clientes en el que deben clasificarse los clientes de los nuevos pedidos.';
MLI18n::gi()->{'ebay_config_account__field__currency__help'} = 'La divisa en la que quieres que se muestren tus artículos de eBay. Elige una moneda que se corresponda con la del sitio Web de eBay.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__BUYER_RETURN'} = 'El comprador ha devuelto la mercancía, por ejemplo, como gesto de buena voluntad por parte del comerciante o porque la mercancía entregada no se correspondía con la descrita.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__ITEM_NOT_RECEIVED'} = 'El comprador no ha recibido la mercancía.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__ITEM_NOT_AS_DESCRIBED'} = 'El comprador ha presentado la reclamación sobre la mercancía: «no se ajusta a la descripción».';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__BUYER_CANCEL'} = 'El comprador ha cancelado el pedido.';
MLI18n::gi()->{'ebay_config_producttemplate__legend__product__info'} = 'Plantilla para la descripción del producto en eBay. (Puede cambiar el editor en "Configuración global" > "Configuración experta").';
MLI18n::gi()->{'ebay_config_sync__field__synczerostock__label'} = 'Sincronización de las existencias cero';
MLI18n::gi()->{'ebay_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.blacklisting__label'} = 'Suprimir la notificación de envío de eBay';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.tomarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.tomarketplace__label'} = 'Sincronización de acciones con el marketplace';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.frommarketplace__label'} = 'Sincronización de existencias desde el marketplace';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.frommarketplace__label'} = 'Sincronización de existencias desde el marketplace';
MLI18n::gi()->{'ebay_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'ebay_config_orderimport__field__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'ebay_config_price__field__chinese.price__label'} = 'Precio inicial';
MLI18n::gi()->{'ebay_config_orderimport__field__preimport.start__label'} = 'Iniciar la importación desde';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.paid__help'} = 'A veces los pedidos de eBay son pagados con retraso por el cliente.
 <br><br>
 Para separar los pedidos impagados de los pagados, puedes seleccionar el estado de pedido/pago de tu propia tienda online para los pedidos pagados de eBay.
 <br><br>
 Para separar los pedidos pendientes de pago de los pedidos pagados, puedes seleccionar el estado de pedido/pago de tu propia tienda online para los pedidos pagados de eBay.
 <br><br>
 Si has activado "Sólo importar pedidos marcados como "Pagados" más arriba, también se utilizará el "Estado del pedido en la tienda" más arriba. En ese caso, la función aparece en gris.';
MLI18n::gi()->{'ebay_config_sync__field__synczerostock__help'} = 'Los artículos agotados suelen estar cerrados en eBay. Si vuelves a poner en venta el artículo y le asignas un nuevo número de puja de eBay, se perderá el rango del artículo.
 <br /><br />
 Para cerrar automáticamente tus artículos agotados en eBay y volver a ponerlos en venta después de que se repongan sin perder la clasificación del producto, magnalister admite la opción "Agotado" de eBay para los anuncios "válidos hasta que se revoquen" con esta función.
 <br /><br />
 Además de esta función, activa la opción "Agotado" en "Mi eBay" > "Configuración del vendedor" directamente en tu cuenta de eBay.
 <br /><br />
 Ten en cuenta que esta función sólo se aplica a los anuncios "válidos hasta su revocación".
 <br /><br />
 Puedes encontrar más información sobre este tema en las páginas de ayuda de eBay (busca el término "agotado").';
MLI18n::gi()->{'ebay_config_prepare__field__topten__help'} = 'Mostrar la categoría de selección rápida en Preparar productos.';
MLI18n::gi()->{'ebay_config_prepare__field__useprefilledinfo__valuehint'} = 'Mostrar información del producto eBay';
MLI18n::gi()->{'ebay_config_orderimport__field__refundstatus__label'} = 'Estado del pedido de la tienda';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shippingmethod__label'} = 'Servicio de envío de los pedidos';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shippingmethod__help'} = 'Método de envío que se aplicará a todos los pedidos importados de eBay. Estándar: "marketplace"<br><br> 
 Esta configuración es necesaria para la factura y el aviso de envío, y para editar los pedidos posteriormente en la Tienda o a través del ERP.';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocal__cost'} = 'Gastos de envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternational__cost'} = 'Gastos de envío';
MLI18n::gi()->{'ebay_config_prepare__legend__shipping'} = 'Envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternational__optional__select__true'} = 'Envíos internacionales';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.canceled__help'} = 'Establece el estado del pedido en su tienda, que deshará el estado 
 &apos;enviado&apos; en eBay. <br/><br/> 
 Nota: Esto sólo significa que el estado del pedido en eBay ya no es &apos;enviado&apos;. No significa que el pedido esté cancelado.';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'ebay_config_orderimport__field__refundstatus__firstoption__--'} = 'Por favor selecciona ...';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__hint'} = 'Guardado en: {#setting:sImagePath#}';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__0'} = 'el mismo día';
MLI18n::gi()->{'ebay_config_price__field__fixed.priceoptions__label'} = 'Precio de venta del grupo de clientes';
MLI18n::gi()->{'ebay_config_price__field__fixed.price__label'} = 'Ajuste del precio de venta';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.returnswithin__label'} = 'Devoluciones en el interior';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.returnsaccepted__label'} = 'Se aceptan devoluciones';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.shippingcostpaidby__label'} = 'Gastos de devolución';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.description__label'} = 'Política de devoluciones: Más detalles';
MLI18n::gi()->{'ebay_config_prepare__field__restrictedtobusiness__label'} = 'Solo clientes profesionales';
MLI18n::gi()->{'ebay_config_orderimport__field__refundcomment__label'} = 'Observaciones sobre la devolución';
MLI18n::gi()->{'ebay_config_orderimport__field__refundreason__label'} = 'Motivo de la devolución';
MLI18n::gi()->{'ebay_config_prepare__field__ebayplus__valuehint'} = 'Publicar un artículo con eBay Plus';
MLI18n::gi()->{'ebay_config_prepare__field__usevariations__help'} = 'Los productos que estén disponibles con variaciones (por ejemplo, tamaño o color) en tu tienda se transferirán a eBay con estas variaciones.<br /><br />La configuración de cantidad se aplicará entonces a cada variación.<br /><br /> 
 <b>Ejemplo:</b> Si tienes 8 unidades en azul, 5 unidades en verde y 2 unidades en negro de un artículo, seleccionas "Transferir existencias de la tienda menos el valor del campo derecho" en Cantidad e introduces "2" en el campo, el artículo estará disponible como 6 unidades en azul y 3 unidades en verde.<br /><br /><b>Ten en cuenta:</b> Puede ocurrir que una variación que utilices (por ejemplo, talla o color) también aparezca en la selección de atributos de la categoría. En este caso, se utilizará tu variación en lugar del atributo.';
MLI18n::gi()->{'ebay_config_producttemplate__legend__product__title'} = 'Plantilla de productos';
MLI18n::gi()->{'ebay_config_account_producttemplate'} = 'Plantilla de producto';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.name__label'} = 'Plantilla de nombres de productos';
MLI18n::gi()->{'ebay_config_prepare__field__useprefilledinfo__label'} = 'Información sobre el producto';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.content__label'} = 'Plantilla de descripción del producto';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__label'} = 'Listings privados';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'ebay_config_price__field__chinese.priceoptions__label'} = 'Precio del grupo de clientes';
MLI18n::gi()->{'ebay_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'ebay_config_price__legend__price'} = 'Cálculo de precios';
MLI18n::gi()->{'ebay_config_prepare__field__chinese.duration__help'} = 'Ajuste anticipado de la duración de la subasta. Este ajuste puede modificarse en la preparación del artículo.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.carrier.default__help'} = 'Transportista preseleccionado al confirmar el envío a eBay. <br /><br />
                    Para que el código de seguimiento se transfiera a eBay, se debe almacenar un transportista.';
MLI18n::gi()->{'ebay_config_prepare__legend__prepare'} = 'Preparar artículos';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.duration__help'} = 'Preparación de la duración de las listas de precios fijos. La configuración puede modificarse en la preparación de la partida.';
MLI18n::gi()->{'ebay_config_prepare__field__paymentmethods__help'} = 'Configuración de los métodos de pago (selección múltiple con Ctrl+clic).<br /><br />Aquí puedes seleccionar los métodos de pago proporcionados por eBay.<br /><br />Si utilizas "Pagos gestionados por eBay", eBay no proporciona más información sobre el método de pago utilizado por el comprador.';
MLI18n::gi()->{'ebay_config_prepare__field__postalcode__label'} = 'Código postal';
MLI18n::gi()->{'ebay_configform_prepare_gallerytype_values__Plus'} = 'Plus';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.cancelled__help'} = 'Establece aquí el estado de la tienda que cancelará el envío en eBay.<br/><br/>.
 
 Nota: Esta función hace que el pedido deje de aparecer como "enviado" en eBay. No es una cancelación del pedido.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.shipped__help'} = 'Configura el estado de la tienda para que se active el estado "Envío confirmado" en eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__alert__Plus__title'} = 'Tenga en cuenta';
MLI18n::gi()->{'ebay_config_account__field__username__help'} = 'Por favor, introduce tu nombre de usuario de eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__postalcode__help'} = 'Por favor, introduce la ubicación de tu tienda. Ésta será visible como dirección del vendedor en eBay.';
MLI18n::gi()->{'ebay_config_prepare__legend__location__info'} = 'Por favor, introduce la ubicación de tu tienda. Ésta será visible como dirección del vendedor en eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__paymentinstructions__help'} = 'Por favor, introduce aquí el texto que debe aparecer en la página del artículo bajo "Instrucciones de pago del vendedor ". Máximo 500 caracteres (sólo texto, no HTML).';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.quantity__help'} = 'Por favor, introduce la cantidad de existencias que deben estar disponibles en el marketplace.<br/> 
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
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.description__help'} = 'Indica aquí los detalles de tu política de devoluciones. Máximo 5.000 caracteres (sólo texto, no HTML).';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) delante del importe para indicar la reducción de precio. Precio fijo significa que el valor introducido aquí se transferirá directamente (por ejemplo, si quieres utilizar siempre un precio inicial de 1 euro).';
MLI18n::gi()->{'ebay_config_price__field__chinese.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'ebay_config_price__field__fixed.price__help'} = 'Por favor, introduce un margen o una reducción de precio, ya sea como porcentaje o como importe fijo. Utiliza un signo menos (-) antes del importe para indicar la reducción de precio.';
MLI18n::gi()->{'ebay_configform_account_sitenotselected'} = 'Selecciona primero del sitio de eBay';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalcontainer__help'} = 'Selecciona los métodos de envío que deseas establecer como predeterminados (o no elijas ninguno).< div class="ui-díalog-titlebar"> 
 <span>Descuento por combinación de pago y envío</span>.
 Selección de perfil para el descuento de envío. Puedes establecer perfiles en tu cuenta de eBay, en Mi eBay > Cuenta de usuario > Configuración > Configuración de envío<br /><br />. 
 Aquí también puedes establecer las reglas para los precios especiales de envío (por ejemplo, precio máximo de envío por pedido, o envío gratuito si el artículo supera una determinada cantidad).<br /><br /> 
 <b>Ten en cuenta:</b><br /> 
 La importación de pedidos está sujeta a las reglas seleccionadas aquí (no recibimos información sobre la configuración de los artículos de eBay).';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalcontainer__help'} = 'Selecciona uno o varios métodos de envío que quieras establecer como predeterminados. <br /><br />Introduce un número en gastos de envío (sin especificar la moneda), o "=PESO" para establecer los gastos de envío según el peso del artículo. 
 <div class="ui-díalog-titlebar">
 <span>Descuento por combinación de pago y envío</span>.
 Selección de perfil para el descuento de envío. Puedes establecer perfiles en tu cuenta de eBay, en Mi eBay > Cuenta de usuario > Configuración > Configuración de envío<br /><br />. 
 Aquí también puedes establecer las reglas para los precios especiales de envío (por ejemplo, precio máximo de envío por pedido, o envío gratuito si el artículo supera una determinada cantidad).<br /><br /> 
 <b>Ten en cuenta:</b><br /> 
 La importación de pedidos está sujeta a las reglas seleccionadas aquí (no recibimos información sobre la configuración de los artículos de eBay).';
// For shopify this hint is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyEbay/I18n/Es/configForm.php
MLI18n::gi()->{'ebay_config_producttemplate__field__template.name__hint'} = 'Marcador de posición: #TITLE# - Nombre del producto; #BASEPRICE# - Precio base';
MLI18n::gi()->{'ebay_config_prepare__field__variationdimensionforpictures__label'} = 'Capas de las variantes de las imágenes de paquete';
MLI18n::gi()->{'ebay_config_prepare__field__picturepack__label'} = 'Paquete de imágenes';
MLI18n::gi()->{'ebay_config_prepare__field__paypal.address__label'} = 'Dirección de correo electrónico de PayPal';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.paymentmethod__label'} = 'Métodos de pago';
MLI18n::gi()->{'ebay_config_prepare__field__paymentmethods__label'} = 'Métodos de pago';
MLI18n::gi()->{'ebay_config_prepare__field__paymentinstructions__label'} = 'Más información sobre el proceso de compra';
MLI18n::gi()->{'ebay_configform_stocksync_values__rel'} = 'El pedido reduce el stock de la tienda (recomendado)';
MLI18n::gi()->{'ebay_config_orderimport__field__updateableorderstatus__help'} = 'Estado del pedido que se puede cambiar en Pagos de eBay.
 Si el pedido tiene un estado diferente, no se cambiará en Pagos de eBay.<br /><br />. 
 Si no deseas cambios en el estado de pago de Pagos de eBay, desactiva la casilla de verificación.<br /><br />.
 <b>Nota:</b> El estado de los pedidos colectivos sólo cambia cuando se han pagado todas las piezas.';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido entre la tienda y eBay';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderupdate__title'} = 'Sincronización del estado del pedido';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.paid__label'} = 'Estado del pedido para los pedidos pagados de eBay';
MLI18n::gi()->{'ebay_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'ebay_config_orderimport__legend__importactive'} = 'Orden de Importación';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__notavailible'} = 'Sólo cuando se activa `<i>Envío Internacional</i>`.';
MLI18n::gi()->{'ebay_config_prepare__field__prepare.status__valuehint'} = 'mostrar sólo los elementos activos';
MLI18n::gi()->{'ebay_config_prepare__field__restrictedtobusiness__help'} = 'Sólo los clientes comerciales pueden comprar los artículos.';
MLI18n::gi()->{'configform_strikeprice_kind_values__OldPrice'} = 'Precio antiguo';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.quantity__label'} = 'Número de artículos';
MLI18n::gi()->{'ebay_config_prepare__field__chinese.quantity__label'} = 'Número de artículos';
MLI18n::gi()->{'ebay_configform_prepare_gallerytype_values__None'} = 'Ninguna imagen';
MLI18n::gi()->{'ebay_config_general_nosync'} = 'sin sincronización';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.content__label'} = 'Plantilla móvil';
MLI18n::gi()->{'ebay_config_prepare__field__dispatchtimemax__help'} = 'Tiempo máximo necesario antes de que se envíe el artículo. Esto será visible en eBay.';
MLI18n::gi()->{'configform_strikeprice_kind_values__ManufacturersPrice'} = 'PRVP del fabricante';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__valuehint'} = 'Lista de compradores/licitadores no pública';
MLI18n::gi()->{'ebay_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'ebay_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'ebay_config_prepare__legend__location__title'} = 'Ubicación';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.duration__label'} = 'Duración de los listados';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.content__hint'} = 'Lista de marcadores de posición disponibles para Asunto y Contenido: 
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
 <dd>Contraseña del comprador para acceder a su tienda. Sólo para los clientes a los que se les asignan automáticamente contraseñas - de lo contrario el marcador de posición será reemplazado por \'(como se sabe)\'.</dd> 
 <dt>#ORDERSUMMARY#</dt> 
 <dd>Resumen de los artículos comprados. Debe ser escrito en una línea separada. <br/><i>No puede ser utilizado en el Asunto< /i></dd> 
 <dt>#ORIGINATOR#</dt>
 <d>Nombre del remitente</dd> 
 </dl>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.content__hint'} = 'Lista de marcadores de posición disponibles para el Contenido: 
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
 <dt>#SHORTDESCRIPTION#</dt> <dd>Descripción breve de la 
 Tienda</dd> 
 <dt>#DESCRIPTION#</dt> 
 <dd>Descripción de la tienda</dd> 
 <dt>#MOBILEDESCRIPTION#</dt> 
 <dd>Descripción breve para dispositivos móviles (si está definida)</dd> 
 <dt>#PICTURE1#</dt> 
 <dd>Primera imagen del producto</dd> 
 <dt>#PICTURE2# etc.</dt> 
 <dd>Segunda imagen del producto; con #PICTURE3#, #PICTURE4# etc, puedes transferir tantas imágenes como tengas disponibles en tu tienda. </dd></dl>';
MLI18n::gi()->{'ebay_config_prepare__field__maxquantity__label'} = 'Limitación del número de artículos';
MLI18n::gi()->{'ebay_config_prepare__field__dispatchtimemax__label'} = 'Plazo de entrega';
MLI18n::gi()->{'ebay_config_prepare__field__lang__help'} = 'Idioma de los nombres y descripciones de los artículos. En tu tienda, los nombres y las descripciones pueden estar en más de un idioma; para subirlos a eBay, hay que seleccionar un idioma. Los informes de error de eBay también se mostrarán en el idioma seleccionado.';
MLI18n::gi()->{'ebay_config_prepare__field__lang__label'} = 'Idioma';
MLI18n::gi()->{'ebay_config_prepare__field__restrictedtobusiness__valuehint'} = 'Los artículos sólo pueden ser comprados por clientes comerciales';
MLI18n::gi()->{'ebay_config_prepare__legend__upload'} = 'Subir artículo: Configuración por defecto';
MLI18n::gi()->{'ebay_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'ebay_config_sync__field__chinese.inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'ebay_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'ebay_config_prepare__field__conditionid__help'} = 'Preestablecer la condición del artículo (para las categorías de eBay que lo requieran u ofrezcan la opción de hacerlo). No todas las descripciones son válidas para todas las categorías. Tras seleccionar la categoría, asegúrate de que la condición del artículo es correcta.';
MLI18n::gi()->{'ebay_config_prepare__field__conditionid__label'} = 'Estado del artículo';
MLI18n::gi()->{'ebay_config_sync__legend__sync__title'} = 'Sincronización de inventarios';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalcontainer__label'} = 'Envíos internacionales';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.refund__label'} = 'Iniciar el reembolso con';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.open__help'} = 'En su tienda online, esta información determina el estado del pedido que se asigna automáticamente a cada nuevo pedido que llega de eBay. 
 <br><br> 
 Tenga en cuenta que se importan tanto los pedidos de eBay pagados como los no pagados. 
 <br><br> 
 Sin embargo, al utilizar la función "Importar sólo pedidos marcados como "pagados"", puede elegir importar a su tienda online sólo los pedidos de eBay pagados. 
 <br><br> 
 Para los pedidos pagados de eBay, puede establecer su propio estado de pedido un poco más abajo, en "Sincronización del estado del pedido" > "Estado del pedido para pedidos pagados de eBay". 
 <br><br> 
 <b>Nota para su proceso de reclamación:</b> 
 <br><br> 
 Si utilizas una herramienta de gestión de inventario y/o facturación que esté conectada a tu tienda online, se recomienda ajustar el estado del pedido para que tu herramienta de gestión de inventario/facturación pueda procesar el pedido de acuerdo con tu proceso empresarial.';
MLI18n::gi()->{'ebay_config_orderimport__field__importactive__help'} = '¿Importar pedidos del marketplace? <br/><br/>Si está activada, los pedidos se importan automáticamente cada hora.<br><br>La importación manual se puede activar haciendo clic en el botón correspondiente en la cabecera del magnalister (arriba a la derecha). <br><br>Además, puedes activar la comparación de existencias a través de CronJob (tarifa Flat - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sImportOrdersUrl#}</i><br> 
 Algunas solicitudes de CronJob pueden bloquearse si se realizan a través de clientes que no están en tarifa Flat o si la solicitud se realiza más de una vez cada 4 horas';
MLI18n::gi()->{'ebay_config_orderimport__field__importonlypaid__label'} = 'Importar sólo los pedidos marcados como "pagados"';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__label'} = 'Tamaño de la imagen';
MLI18n::gi()->{'ebay_config_prepare__legend__pictures'} = 'Configuración de la imagen';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.frommarketplace__help'} = 'Si, por ejemplo, un artículo se compra 3 veces en eBay, el inventario de la tienda se reducirá en 3.<br /><br /> 
 <strong>Importante:</strong>Esta función sólo funciona si has activado la importación de pedidos';
MLI18n::gi()->{'ebay_config_prepare__field__variationdimensionforpictures__help'} = 'Si has guardado imágenes de variación con los datos de tu producto, el Paquete de imágenes las envía a eBay con la subida del producto.
 eBay sólo permite una dimensión de variación: Por ejemplo, si tomas el color, la imagen principal de la página de producto de eBay cambiará si el comprador selecciona un color diferente. <br /><br /> 
 Esta configuración es el valor por defecto. Puedes cambiarlo en el formulario de preparación de cada producto. <br /> 
 Si quieres cambiarlo más tarde, tienes que preparar y subir el producto de nuevo.';
MLI18n::gi()->{'ebay_config_sync__field__syncproperties__help'} = 'Si activas la sincronización EAN y MPN, puedes transferir los valores correspondientes a eBay con un solo clic (medíante el nuevo botón de sincronización situado a la izquierda del botón de importación de pedidos).<br />
 <br />
 Esto también sincroniza los artículos que no están listados en magnalister. El inventario de eBay se determina por el número de artículo, siempre que sea idéntico tanto en eBay como en tu tienda virtual (ver “magnalister” > “eBay” > “Inventario”). La primera sincronización puede tardar hasta 24 horas..<br />
 <br />
 Para las <b>variaciones</b>, se utiliza el EAN del artículo principal si no se encuentra ningún EAN para la variación en la base de datos de la tienda (la mayoría de los sistemas de tienda de la familia OsCommerce no pueden procesar EAN de variaciones). Si no hay EAN para el artículo principal y no todas las variaciones tienen EAN, se utilizará también uno de los EAN existentes para el resto de las variaciones del artículo. Si has contratado el complemento "Sincronización EAN y NMP", los valores también se rellenan durante la sincronización "normal" de precios y existencias.<br />
 <br />
 *También puedes introducir el ISBN o el UPC en el campo EAN. magnalister reconocerá automáticamente el número de identificación que introduzcas.<br /><br />
 <b>Importante</b> para osCommerce: Instala la extensión EAN<br />.
 osCommerce no tiene campos para EAN por defecto. Ponte en contacto con nosotros para saber cómo puedes ampliar la base de datos y los formularios de tu tienda para que gestionen EAN.<br /><br />
 <b>osCommerce no tiene campos para el EAN por defecto. Ponte en contacto con nosotros para saber cómo puedes ampliar la base de datos y los formularios de la tienda para que se pueda procesar el EAN.:</b>Consejos:<br />
 eBay permite la transmisión de números de marcador de posición para EAN y MPN en lugar del número real. Los productos con estos números de marcador de posición tienen una clasificación inferior en eBay, lo que significa que no se encuentran tan fácilmente..<br />
 <br />
 magnalister transfiere estos números de reserva de eBay para los artículos para los que no se ha encontrado ningún EAN o MPN, de forma que puedas realizar cambios en los artículos existentes.<br />';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.closed__help'} = 'Si un pedido se establece en uno de los estados de pedido seleccionados, los nuevos pedidos de ese cliente no se añadirán a ese estado de pedido.<br />
 Si no quieres un resumen de pedido, selecciona cada estado de pedido.';
MLI18n::gi()->{'ebay_config_orderimport__field__mwstfallback__help'} = '                                Si el artículo no se encuentra en la tienda web, magnalister utilizará el tipo impositivo almacenado aquí, ya que los marketplaces no especifican el tipo de IVA al importar los pedidos.<br />
                <br />
                Aclaraciones:<br />
                En principio, magnalister se comporta de la misma manera que el propio sistema de la tienda a la hora de calcular el IVA al importar pedidos.<br />
                <br />
                Para que el IVA por país se tenga en cuenta automáticamente, el artículo adquirido debe encontrarse en la tienda web con su rango de números (SKU).<br />
                magnalister utiliza entonces las clases de impuestos configuradas en la tienda web.';
MLI18n::gi()->{'ebay_config_prepare__field__maxquantity__help'} = 'Aquí puedes limitar el número de artículos publicados en eBay.<br /><br />. 
 <strong>Ejemplo:</strong>. 
 Para el "número de artículos" selecciona "tomar del inventario de la tienda" e introduce "20" en este campo. Al subir el número de artículos se tomará del inventario disponible pero no más de 20. La sincronización de inventario (si está activada) adaptará el número de artículos en eBay al inventario de la tienda siempre que el inventario de la tienda sea inferior a 20. Si hay más de 20 artículos en el inventario, el número de artículos en eBay se ajustará a 20.<br /><br />.
 Introduce "0" o deja este campo en blanco si no deseas una limitación.<br /><br /> 
 <strong>Consejo:</strong>. 
 Si la opción "número de elementos" es "global (del campo de la derecha)", la limitación no tiene efecto.';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__hint'} = 'Galería<br />("Plus" puede ser <span style="color:#e31a1c">sujeto de tasa</span> en algunas categorías)';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__alert__Plus__content'} = 'Galería Plus significa una ventana emergente con una vista más grande del artículo, cuando el cliente apunta con el ratón al artículo dentro de la lista de resultados de la búsqueda. Ten en cuenta que el tamaño de la imagen debe ser <b>al menos 800x800 px</b>.<br /><br /> 
 El uso de Galería Plus puede <span style="color:#e31a1c">causar tarifas adicionales</span> en algunas categorías de eBay. Consulta <a href="http://pages.ebay.com/help/sell/gallery-upgrade.html" target="_blank">página de ayuda de eBay</a> para más detalles.<br /><br />RedGecko GmbH no se hace responsable de los costes ocasionados.';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__label'} = 'Galería de imágenes';
MLI18n::gi()->{'ebay_configform_prepare_gallerytype_values__Gallery'} = 'Estándar';
MLI18n::gi()->{'ebay_config_prepare__field__useprefilledinfo__help'} = 'Función activada: Mostrar la información del producto de eBay, si se encuentra. Sólo se aplica si se utiliza el EAN.';
MLI18n::gi()->{'ebay_configform_orderimport_payment_values__textfield__title'} = 'Del campo de texto';
MLI18n::gi()->{'ebay_configform_orderimport_shipping_values__textfield__title'} = 'Del campo de texto';
MLI18n::gi()->{'ebay_config_prepare__field__shippingsellerprofile__label'} = 'condiciones del marco: Envío';
MLI18n::gi()->{'ebay_config_prepare__field__returnsellerprofile__label'} = 'Condiciones del marco: Reenvío';
MLI18n::gi()->{'ebay_config_prepare__field__paymentsellerprofile__label'} = 'Condiciones del marco: Métodos de pago';
MLI18n::gi()->{'ebay_config_account__field__site__help'} = '¿Para qué país deben figurar sus productos?';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.frommarketplace__help'} = 'Por ejemplo, si un artículo se compra tres veces en eBay, el inventario de la tienda se reducirá en 3.';
MLI18n::gi()->{'ebay_configform_price_chinese_quantityinfo'} = 'En las subastas ascendentes, la cantidad solo puede ser exactamente 1.';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'ebay_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.com';
MLI18n::gi()->{'ebay_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.closed__label'} = 'Finalizar resumen del pedido';
MLI18n::gi()->{'ebay_config_sync__field__synczerostock__valuehint'} = 'Activar la sincronización de existencias cero';
MLI18n::gi()->{'ebay_config_sync__field__syncrelisting__valuehint'} = 'Activar las listas automáticas';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'ebay_config_account__field__username__label'} = 'Nombre de usuario de eBay';
MLI18n::gi()->{'ebay_config_account__field__token__label'} = 'Token de eBay';
MLI18n::gi()->{'ebay_config_account__field__site__label'} = 'Sitio de eBay';
MLI18n::gi()->{'ebay_config_prepare__field__ebayplus__label'} = 'eBay Plus';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderrefund'} = 'Pagos gestionados de eBay: Iniciar el reembolso del pedido';
MLI18n::gi()->{'ebay_config_sync__field__syncproperties__label'} = 'Sincronización de EAN, MPN y fabricante';
MLI18n::gi()->{'ebay_config_prepare__field__chinese.duration__label'} = 'Duración de la subasta';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternational__optional__select__false'} = 'No enviar al extranjero';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalprofile__optional__select__false'} = 'No utilices el perfil de envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__optional__select__false'} = 'No utilices el perfil de envío';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalcontainer__label'} = 'Envío nacional';
MLI18n::gi()->{'ebay_config_sync__legend__sync__info'} = 'Determina qué atributos de los productos de tu tienda deben actualizarse automáticamente en eBay.<br /><br /><b>Configuración de listados de precio fijo</b>.';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.signal__label'} = 'Importe decimal';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.signal__hint'} = 'Importe decimal';
MLI18n::gi()->{'ebay_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'ebay_config_account__field__currency__label'} = 'Moneda';
MLI18n::gi()->{'ebay_config_prepare__field__country__label'} = 'País';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.copy__label'} = 'Copiar al remitente';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'ebay_config_prepare__field__location__label'} = 'Ciudad';
MLI18n::gi()->{'ebay_config_prepare__field__topten__label'} = 'Selección rápida de categorías';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.carrier.default__label'} = 'Transportista';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price__label'} = 'Precio de compra';
MLI18n::gi()->{'ebay_config_prepare__field__productfield.brand__label'} = 'Marca';
MLI18n::gi()->{'ebay_config_prepare__field__productfield.tecdocktype__label'} = 'TecDoc KType';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.blacklisting__valuehint'} = 'Lista negra de direcciones de correo electrónico de clientes de eBay';
MLI18n::gi()->{'ebay_config_price__field__bestofferenabled__label'} = 'Propuesta de precio';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'ebay_config_general_autosync'} = 'Sincronización automática mediante CronJob (recomendado)';
MLI18n::gi()->{'ebay_configform_orderimport_payment_values__matching__title'} = 'Asignación automática';
MLI18n::gi()->{'ebay_configform_orderimport_shipping_values__matching__title'} = 'Asignación automática';
MLI18n::gi()->{'ebay_config_sync__field__syncrelisting__label'} = 'Reencuadernación de automóviles';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__help'} = 'Activa esta opción para marcar las ofertas como "privadas". Esto hará que tu lista de compradores/ofertantes no sea visible públicamente.<span style="color:#e31a1c">cargo obligatorio</span>.';
MLI18n::gi()->{'ebay_config_price__field__bestofferenabled__help'} = 'Activa esta función para que los compradores puedan sugerir su propio mejor precio para los artículos.<br /><br /> 
 Este ajuste sólo se aplica a los "artículos básicos" (sin variaciones). Si hay variaciones, este ajuste no se aplica.';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.active__valuehint'} = 'Activa los precios rebajados';
MLI18n::gi()->{'ebay_config_orderimport__field__update.orderstatus__label'} = 'Activa la actualización del estado';
MLI18n::gi()->{'ebay_config_prepare__field__picturepack__valuehint'} = 'Activa el paquete de imágenes';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__label'} = 'Activa la plantilla móvil';
MLI18n::gi()->{'ebay_config_orderimport__field__importactive__label'} = 'Activa la importación';
MLI18n::gi()->{'ebay_config_sync__field__syncproperties__valuehint'} = 'Activa la sincronización de EAN, MPN y fabricante';
MLI18n::gi()->{'ebay_config_price__field__buyitnowprice__label'} = 'Precio activo de compra inmediata';
MLI18n::gi()->{'ebay_config_price__field__bestofferenabled__valuehint'} = 'Activa la mejor oferta (sólo se aplica a los artículos sin variaciones)';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.copy__help'} = 'Se enviará una copia a la dirección de correo electrónico del remitente.';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__9'} = '9 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__8'} = '8 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__7'} = '7 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__6'} = '6 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__5'} = '5 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__4'} = '4 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__30'} = '30 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__3'} = '3 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__29'} = '29 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__28'} = '28 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__27'} = '27 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__26'} = '26 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__25'} = '25 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__24'} = '24 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__23'} = '23 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__22'} = '22 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__21'} = '21 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__20'} = '20 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__2'} = '2 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__19'} = '19 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__18'} = '18 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__17'} = '17 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__16'} = '16 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__15'} = '15 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__14'} = '14 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__13'} = '13 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__12'} = '12 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__11'} = '11 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__10'} = '10 días';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__1'} = '1 día';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.usespecialoffer__help'} = '<span style="color:#e31a1c;font-weight:bold">Utilizar el precio especial de la tienda online como precio de venta en el marketplace</span><br /><br />Activa esta opción si quieres utilizar los precios especiales de tu tienda online como precios de venta en eBay. Si has realizado algún cambio en "Ajustar precio de venta", se tendrá en cuenta adicionalmente.';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.kind__help'} = '<span style="color:#e31a1c;font-weight:bold">{#i18n:configform_price_field_priceoptions_kind_label#}</span><br /><br />Si el precio tachado es el PVPR del fabricante y quieres mostrar esta información en eBay, activa la opción.';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.active__alert'} = '<span style="color:#e31a1c;font-weight:bold">Activar los precios de remate</span><br /><br /><b>Ten en cuenta que:</b>Los precios de remate sólo están disponibles en eBay para los vendedores con tiendas <b>premium</b> o <b>platinum</b> (para más detalles sobre las distintas opciónes de tienda de eBay, consulta las páginas de ayuda de eBay).<br /><br /> Si no utilizas un plan de eBay que incluya la fijación de precios de huelga y aun así intentas subir artículos con precio de huelga, <b>eBay rechazará estos artículos con un mensaje de error.</b>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.content__hint2'} = '<span>Notas</span><span style="color:#000">:</span><p> No se permite HTML, excepto listas y saltos de línea. Los demás elementos HTML se filtrarán. La longitud permitida es de hasta 800 caracteres.</p> 
 <p>La descripción breve móvil se mostrará dentro de la descripción principal. Por favor, omite el uso de los mismos marcadores de posición en ambas, de lo contrario filtraremos los marcadores de posición en cuestión de la descripción principal, para evitar el doble contenido..</p>.';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__help'} = '<p>Introduce la anchura en píxeles de la imagen tal y como debe aparecer en el marketplace. La altura se ajustará automáticamente en función de la relación de aspecto original. </p> 
 <p>Los archivos de origen se procesarán desde la carpeta de imágenes {#setting:sSourceImagePath#}, y se almacenarán en la carpeta {#setting:sImagePath#} con la anchura en píxeles seleccionada para su uso en el marketplace.</p>';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Método de pago que se aplicará a todos los pedidos importados de eBay. Estándar: "Asignación automática"</p> 
 <p>Si eliges "Asignación automática", magnalister aceptará el método de pago elegido por el comprador en Hood.de.</p> 
 <p>Añade métodos de pago adicionales a la lista a través de Shopware > Configuración > Métodos de pago, y luego actívalos aquí.</p> 
 <p>Estos ajustes son necesarios para la factura y la notificación de envío, y para editar los pedidos más tarde en el Shopware o a través del ERP.</p>';
MLI18n::gi()->{'ebay_config_prepare__field__mwst__help'} = '<p>Aquí puedes establecer el valor predeterminado del IVA (porcentaje), que se mostrará en tus anuncios de eBay. Puedes ajustar el tipo de IVA más adelante para cada producto individualmente en el magnalister de preparación de productos.</p> 
 <p><b>Importante:</b><br/> Rellena este campo sólo si cobras IVA.</p>';
MLI18n::gi()->{'ebay_config_orderimport__field__importonlypaid__help'} = '<p> Al activar esta función, los pedidos de eBay sólo se importan cuando están marcados en eBay como "Pagados". En el caso de los pedidos de PayPal, esto ocurre automáticamente. En el caso de una transferencia de dinero, el pedido debe estar marcado en eBay como "Pagado".
 </p><p> 
 <strong>Beneficio:</strong> 
 El pedido importado ya no se puede modificar, puesto que está completado.
 Los datos como la dirección de envío y los gastos de envío se envían desde 1:1 tal y como se han pedido. Ya no es necesario supervisar los cambios y actualizarlos en la tienda online.';
MLI18n::gi()->{'ebay_config_orderimport__field__importonlypaid__alert'} = '<p>Al activar esta función, los pedidos de eBay sólo se importan cuando están marcados en eBay como "Pagados". En el caso de los pedidos de PayPal, esto ocurre automáticamente. En el caso de una transferencia de dinero, el pedido debe estar marcado en eBay como "Pagado".". </p>
 </p><p> 
 <strong>Beneficio:</strong> 
 El pedido importado ya no se puede modificar, puesto que está completado.
 Los datos como la dirección de envío y los gastos de envío se envían desde 1:1 tal y como se han pedido. Ya no es necesario supervisar los cambios y actualizarlos en la tienda online.</p>';
MLI18n::gi()->{'ebay_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p><p>#MOBILEDESCRIPTION#</p>';
MLI18n::gi()->{'ebay_config_sync__field__inventorysync.price__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>La función \'Sincronización automática\' sincroniza el precio de eBay con el de la tienda cada 4 horas, a partir de las 0.00 horas (con {#setting:currentMarketplaceName#} dependiendo de la configuración).<br>Los valores serán transferidos desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar pulsando el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Adicionalmente, se puede activar la comparación de stock a través de CronJon (tarifa plana - máximo cada 4 horas) con el enlace:<br> 
 <i>{#setting:sSyncInventoryUrl#}</i><br> 
 Algunas peticiones de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana o si la petición se realiza más de una vez cada 4 horas. 
 </dd> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática a través de CronJob (recomendado)</dt> 
 <dd>El stock actual de eBay se sincronizará con el stock de la tienda cada 4 horas, a partir de las 0:00 horas (con {#setting:currentMarketplaceName#} dependiendo de la configuración).<br>Los valores serán transferidos desde la base de datos, incluyendo los cambios que se produzcan a través de un ERP o similar.<br><br>La comparación manual se puede activar pulsando el botón correspondiente en la cabecera del magnalister (a la izquierda del carrito de la compra).<br><br> 
 Además, puedes activar la comparación de acciones a través de CronJon (tarifa Flat - máximo cada 4 horas) con el enlace:<br>
 <i>{#setting:sSyncInventoryUrl#}</i><br> 
 Algunas peticiones de CronJob pueden ser bloqueadas, si se realizan a través de clientes que no están en la tarifa plana o si la petición se realiza más de una vez cada 4 horas. 
 </dd> 
 <b>Nota:</b> Se tienen en cuenta los ajustes "Configuración", "Carga de artículos" y "Cantidad de existencias".';
// For shopify this help is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyEbay/I18n/Es/configForm.php
MLI18n::gi()->{'ebay_config_producttemplate__field__template.name__help'} = '<dl> 
 <dt>Nombre del producto en eBay</dt> 
 <dd>Decide cómo nombrar el producto en eBay. 
 El marcador de posición <b>#TITLE#</b> se sustituirá por el nombre del producto de la tienda, 
 <b>#BASEPRICE#</b> por el precio por unidad, siempre que los datos existan en la tienda.</dd> 
 <dt>Ten en cuenta:</dt> 
 <dd>El marcador de posición <b>#BASEPRICE#</b> no es necesario en la mayoría de los casos, ya que enviamos los precios base automáticamente a eBay, si se rellena en la Tienda y se permite para la categoría de eBay.</dd> 
 <dd>Utiliza este marcador de posición si tienes unidades no métricas (que Hood.de no ofrece), o si quieres mostrar precios base en categorías en las que Hood.de no los ofrece.</dt> 
 <dd>Si utilizas este marcador de posición, <b>desactiva la sincronización de precios</b>. El título del artículo no se puede cambiar en Hood.de. Por lo tanto, si el precio cambia, el precio base dentro del título ya no se ajustará.</dd>
 <dd><b>#BASEPRICE#</b> se sustituye mientras se sube el producto a eBay.</dd> 
 <dd>eBay no puede manejar <b>diferentes precios base para Variaciones</b>. Por lo tanto, lo añadimos a los títulos de las Variaciones.</dd> 
 <dd>Ejemplo: 
 <br /> Grupo de variación: cantidad de relleno<ul>
 <li>Variación: 0,33 l (3 EUR / l)</li> 
 <li>Variación: 0,5 l (2,50 EUR / l)</li> 
 <li>etc.</li></ul></dd> 
 <dd>En este caso, por favor, <b>desactiva la sincronización de precios</b> (porque los títulos de la Variación no se pueden cambiar en eBay).</dd> 
 </dl>';
MLI18n::gi()->{'ebay_config_sync__field__chinese.inventorysync.price__help'} = '<dl> 
 <dt>Sincronización automática por CronJob</dt> 
 <dd>La función "Sincronización automática por CronJob" iguala el precio actual de _#_platformName_#_con el precio de la tienda cada 4 horas (comienza a las 0 pm).<br /><br /> 
 Este procedimiento comprueba si se han producido cambios en los valores de la base de datos. Los nuevos datos se mostrarán incluso si los cambios fueron establecidos por un sistema de gestión de inventario.<br/>
 <br/>Puedes sincronizar los cambios de precio manualmente haciendo clic en el botón de la cabecera del magnalister a la izquierda del logotipo de la hormiga.<br/><br/>Además, puedes sincronizar los cambios de precio estableciendo tu propio cronjob en el siguiente enlace de tu tienda:<br/>
 <i>http://www.tu-tienda.com/magnaCallback.php?do=SyncInventory</i><br/><br/> El establecimiento de un cronjob propio está permitido para los clientes dentro del plan de servicio "Flat", solamente.
 <br/><br/>Las llamadas del cronjob propio, que superen un cuarto de hora, o las llamadas de los clientes, que no están dentro del plan de servicio "Flat", serán bloqueadas. 
 </dl><br/> 
 <b>Avisos:</b><ul><li>Los ajustes en "Configuración" → "Cálculo de precios" serán proporcionados.</li> 
 <li>Una vez realizadas las pujas de una Subasta, no se permiten cambios.</li></ul>';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.tomarketplace__help'} = '<dl> 
 <dt>Sincronización automática por CronJob (recomendado)</dt> 
 <dd>La función "Sincronización automática por CronJob" comprueba el stock de la tienda cada 4 horas, y borra las subastas de eBay de los Artículos que ya no están disponibles en la tienda.<br /><br /> 
 Este procedimiento comprueba si se han producido cambios en los valores de la base de datos. Los nuevos datos se mostrarán, aunque los cambios hayan sido establecidos por un sistema de gestión de mercancías.
 <br/><br/>Puedes sincronizar los cambios de precios manualmente haciendo clic en el botón de la cabecera de magnalister, a la izquierda del logotipo de la hormiga.
 <br/><br/>Además, puedes sincronizar los cambios de precios estableciendo un cronjob personalizado en el siguiente enlace de tu tienda:<br/>
 <i>http://www.tu-tienda.com/magnaCallback.php?do=SyncInventory</i><br><br> El establecimiento de un cronjob propio está permitido sólo para clientes dentro del plan de servicio "Flat".<br><br> Las llamadas de cronjob propio, que excedan un cuarto de hora, o las llamadas de clientes, que no estén dentro del plan de servicio "Flat", serán bloqueadas. 
 <dt>Reducción de la cantidad de pedidos/existencias</dt> 
 <dd>Si el stock se reduce a 0 por un Pedido en la tienda, o por la edición del artículo en la tienda, la subasta resp. 
 Los cambios dentro de la base de datos (por ejemplo, por un sistema de gestión de inventario), no serán capturados ni enviados.
 </dd> 
 </dl><br> 
 <b>Aviso:</b> <ul><li>Una vez realizadas las pujas de una subasta, no se permiten cambios.</li></ul>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__alert'} = '<div title="wichtig">El resumen de la descripción móvil se muestra también dentro de la descripción principal. Con el marcador de posición #MOBILEDESCRIPTION# puede especificar en qué lugar se mostrará.<br/><br/>Por favor, no utilices los mismos marcadores de posición en la descripción principal y en la descripción móvil. De lo contrario, filtraremos estos marcadores de posición de la descripción principal para dejar fuera el contenido duplicado.</div>';
MLI18n::gi()->{'ebay_config_prepare__legend__payment'} = '<b>Configuración de los métodos de pago</b>';
MLI18n::gi()->{'ebay_config_price__legend__fixedprice'} = '<b>Configuración de los listados de precio fijo</b>';
MLI18n::gi()->{'ebay_config_prepare__field__shippingsellerprofile__help'} = '<b>Selección del perfil de condiciones del marco para el envío</b><br /><br /> 
 Estás utilizando la función "Condiciones de venta" de eBay. Esto significa que las condiciones de pago, envío y entrega no pueden seleccionarse individualmente. Las condiciones de 
 condiciones se toman ahora del perfil de eBay.<br /><br />
 Selecciona el perfil preferido para las condiciones de envío. Esto es obligatorio. Puedes seleccionar un perfil diferente durante la preparación del artículo si tienes varios perfiles de eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__returnsellerprofile__help'} = '<b>Selección del perfil de condiciones del marco para el reenvío</b><br /><br /> 
 Estás utilizando la función "Condiciones de venta" de eBay. Esto significa que las condiciones de pago, envío y entrega no pueden seleccionarse individualmente. Las condiciones se toman ahora del perfil de eBay.<br /><br /> 
 Selecciona el perfil preferido para las condiciones de reenvío. Esto es obligatorio. Puedes seleccionar un perfil diferente durante la preparación del artículo si tienes varios perfiles de eBay.';
MLI18n::gi()->{'ebay_config_prepare__legend__returnpolicy'} = '<b>Política de devoluciones</b>';
MLI18n::gi()->{'ebay_config_prepare__legend__fixedprice'} = '<b>Opción de listados con precio fijo</b>';
MLI18n::gi()->{'ebay_config_prepare__legend__misc'} = '<b>Varios</b>';
MLI18n::gi()->{'ebay_config_prepare__field__shippingsellerprofile__help_subfields'} = '<b>Consejo:</b><br /> 
 Este campo no es editable porque estás utilizando el marco de trabajo de eBay. Utiliza la casilla <b> condición de marco: métodos de envío</b> para establecer el perfil de condiciones de envío.';
MLI18n::gi()->{'ebay_config_prepare__field__returnsellerprofile__help_subfields'} = '<b>Consejo:</b><br />
 Este campo no es editable porque estás utilizando los términos y condiciones de eBay. Utiliza la casilla de verificación <b>condición de marco: reenvío</b> para establecer el perfil de las condiciones de reenvío.';
MLI18n::gi()->{'ebay_config_prepare__field__paymentsellerprofile__help_subfields'} = '<b>Consejo:</b><br /> 
 Este campo no es editable porque estás utilizando los términos y condiciones de eBay. Por favor, utiliza la casilla de verificación <b> condición de marco: formas de pago</b> para establecer el perfil de las condiciones de pago.';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__help'} = '<b>Imágenes de la galería</b><br /><br /> 
 Las imágenes de la galería aparecen en la lista de resultados de búsqueda en eBay. Esto mejora la visibilidad de sus artículos y, por lo tanto, el resultado potencial de venta.<br /><br /> 
 <b>Galería Plus</b><br /><br /> 
 Galería Plus significa una ventana emergente con una vista más grande del artículo, cuando el cliente señala con el ratón el artículo dentro de la lista de resultados de búsqueda. ¡
 Ten en cuenta que el tamaño de la imagen debe ser de <b>al menos 800x800 px</b><br /><br /> 
 <b>Cargos de eBay</b><br /><br /> 
 &quot;Gallery Plus&quot; está <span style="color:#e31a1c">sujeto a cargos en eBay</span> en algunas categorías! RedGecko GmbH no se responsabiliza de las tasas de eBay que se produzcan.<br /><br /> 
 <b>Más información</b><br /><br /> 
 Para más información, visita las páginas de ayuda de <a href="http://pages.ebay.com/help/sell/gallery-upgrade.html" target="_blank">eBay</a>.';
MLI18n::gi()->{'ebay_config_prepare__legend__chineseprice'} = '<b>Configuración de la subasta</b>';
MLI18n::gi()->{'ebay_config_price__legend__chineseprice'} = '<b>Configuración de la subasta</b>';
MLI18n::gi()->{'ebay_config_sync__legend__syncchinese'} = '<b>Configuración de la subasta</b>';
MLI18n::gi()->{'ebay_config_prepare__field__ebayplus__help'} = '<a href="http://verkaeuferportal.ebay.de/ebay-plus" target="_blank">eBay Plus</a> puede activarse a través de tu cuenta de eBay si eBay te ha habilitado la función. Actualmente, esta función sólo está disponible para eBay Alemania.<br /><br /> 
 La casilla de verificación que se encuentra aquí es una configuración predeterminada para subir a través de magnalister. Puede marcarse si eBay Plus está activado en tu cuenta. No afecta a la configuración por defecto para los artículos de eBay (ésta sólo puede activarse a través de tu cuenta de eBay).<br /><br /> 
 Si la casilla no está seleccionable aunque hayas activado la función en eBay, guarda tu configuración (magnalister recuerda la última configuración de eBay para esta conexión)br /><br /> 
 <b>Consejo:</b> 
 <ul> 
 <li>Se deben cumplir condiciones adicionales para los listados de eBay Plus:
 Plazo de reenvío de 1 mes, posibilidad de pago por paypal, un <a href="http://verkaeuferportal.ebay.de/versand-bei-ebay-plus" target="_blank">método de envío que esté acreditado por eBay</a>.
 No recibiremos respuesta</b> de eBay si estas condiciones son correctas. Debes encargarte tú mismo de ello. </li>
 <li>Permite el cambio de pedido (mediante la sincronización de pedidos) o utiliza la función &quoimportar pedidos marcados como pagados&quot(vie importación de pedidos). La etiqueta eBay Plus no se transmite con la primera nota de pedido. Se transmite en cuanto el comprador ha seleccionado las formás de pago y envío.</li> 
 <li> A veces, los pedidos de eBay plus se envían sin medios de pago autorizados. En estos casos, se muestra una nota correspondiente en la vista detallada del pedido.</li></ul>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__hint'} = '<a href="http://pages.ebay.com/sell/itemdescription/customizeyoursummary.html" target="_blank">Más información sobre las descripciones para móviles en eBay</a>';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalprofile__option'} = '{#NAME#} ({#AMOUNT#} por artículo adicional)';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__option'} = '{#NAME#} ({#AMOUNT#} por artículo adicional)';
MLI18n::gi()->{'ebay_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'ebay_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__hint'} = '{#i18n:ebay_prepare_apply_form__field__privatelisting__hint#}';
MLI18n::gi()->{'ebay_configform_orderstatus_sync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_sync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_stocksync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_pricesync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_sync_chinese_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_orderstatus_sync_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_sync_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_pricesync_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_sync_chinese_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_config_price__field__strikepriceoptions__label'} = '{#i18n:configform_price_field_strikeprice_label#}';
MLI18n::gi()->{'ebay_config_price__field__strikepriceoptions__help'} = '{#i18n:configform_price_field_strikeprice_help#}';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.kind__label'} = '{#i18n:configform_price_field_priceoptions_kind_label#}';
MLI18n::gi()->{'ebay_config_price__field__fixed.priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ebay_config_price__field__chinese.priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ebay_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ebay_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'ebay_config_producttemplate_mobile_content'} = '#TITLE#<br />
#ARTNR#<br />
#SHORTDESCRIPTION#<br />
#DESCRIPTION#';
MLI18n::gi()->{'ebay_config_sync__field__syncrelisting__help'} = 'Con la activación de esta función, tus artículos se pondrán automáticamente en eBay si:
 <ul>
 <li>Tu oferta termina sin que se haga una oferta </li>
 <li>Cancelar la transacción </li>
 <li>Terminas tu oferta antes de tiempo</li>
 <li>el artículo no fue vendido o</li>
 <li>el comprador no ha pagado el artículo.</li>
 </ul>
 
 Ten en cuenta que eBay permite un máximo de 2 reinstalaciones.
 <br />
 Puedes encontrar más información sobre este tema en las páginas de ayuda de eBay (busca el término "volver a poner en lista un artículo").';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.refund__help'} = '<p>Con esta función puedes iniciar un reembolso para los pedidos importados de eBay. El requisito para ello es participar en "Pagos gestionados de eBay".</p>
 <p>Para cada motivo de devolución dado por eBay, puedes definir un estado de pedido en la tienda online (botón "+") y asignar un comentario. Este comentario se enviará al comprador y a eBay.</p>
 <p>
 <strong>"Estado del pedido de la tienda"</strong><br>
 Selecciona un estado de pedido de tu tienda web que iniciará un reembolso al comprador.
 </p>
 <p>
 <strong>"Motivo de la devolución"</strong><br>
 Selecciona aquí un motivo de reembolso dado por eBay.
 "Observaciones para el reembolso"</p><p>
 Introduce un comentario, que se transmite junto con el reembolso al comprador y a eBay.
 </p>
 <p>
 <strong>Notas importantes:</strong><br>
 <ul>
 <li>
 La mayoría de los sistemas de tienda no son capaces de dividir un pedido en varios artículos y proporcionar los importes de reembolso correctos. Por lo tanto, no se pueden procesar devoluciones parciales a través de magnalister.
 </li><li>
 Solución: El reembolso parcial debe realizarse directamente en el eBay Seller Hub. Puedes encontrar un enlace directo a tu pedido en el eBay Seller Hub en los detalles del pedido de magnalister.
 </li>
 </ul>
 </p>';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.blacklisting__help'} = '<b>Evitar las notificaciones de envío a los compradores de eBay</b><br /> 
 <br /> 
 La opción "Lista negra de direcciones de correo electrónico de clientes de eBay" se utiliza para suprimir los correos electrónicos enviados por el sistema de compras (para pedidos importados a través de magnalister). Esto significa que no llegarán al comprador de eBay. <br /> 
 <br /> 
 Notas importantes: 
 <ul> 
 <li>La lista negra está desactivada por defecto. Si está activada, recibirás una notificación del servidor de correo de que el correo electrónico no se ha podido entregar en cuanto el sistema de la tienda envíe un correo electrónico al comprador de eBay.<br /><br /></li> 
 <li>magnalister simplemente antepone a la dirección de correo electrónico de eBay el prefijo "blacklisted-" (por ejemplo, blacklisted-12345@ebay.com). Si aún quieres ponerte en contacto con el comprador de eBay, simplemente elimina el prefijo "lista negra-". </li>
 <ul>';
MLI18n::gi()->{'ebay_config_emailtemplate_content'} = '<style><!--
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
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.content__hint'} = 'Marcadores de posición disponibles para la descripción del artículo móvil: 
 <dl> 
 <dt>#TITLE#</dt><dd>Nombre del producto (título)</dd> 
 <dt>#ARTNR#</dt><dd>Número de artículo de la tienda</dd> 
 <dt>#PID#</dt><dd>Identificación del producto</dd> 
 <dt>#SHORTDESCRIPTION#</dt><dd>Descripción breve de la tienda</dd> 
 <dt>#DESCRIPTION#</dt><dd>Descripción de la 
 tienda</dd> 
 <dt>#WEIGHT#</dt><dd>Peso del producto</dd> 
 </dl>';
MLI18n::gi()->{'ebay_config_prepare__field__picturepack__help'} = '<b>Paquete de imágenes</b><br /><br /> 
 Si activas la función &quot;Paquete de imágenes&quot;, puedes mostrar hasta 12 imágenes por cada artículo. El comprador puede ver las fotos en un formato más grande y ampliar partes de la imagen. No se requiere ninguna configuración especial en tus cuentas de eBay..<br /><br /> 
 <b>Imágenes de variación</b><br /><br /> 
 Si tienes imágenes de variación para un artículo, también se pueden transferir a eBay (hasta 12 imágenes por variación).<br /><br /> 
 <b>Nota</b><br /><br /> 
 magnalister sólo puede procesar los datos proporcionados por el sistema de tu tienda. Si tu sistema de tienda no admite imágenes de variación, esta función no estará disponible en magnalister. <br /><br /> 
 <b>&quot;Imágenes de gran tamaño&quot; y &quot;Zoom&quot;</b><br /><br /> 
 Por favor, utiliza imágenes de tamaño suficiente para poder utilizar las funciones &quot;Imágenes grandes&quot; y &quot;Zoom&quot;. Si una imagen es demasiado pequeña (menos de <b>1000px</b> en el lado más largo), se utilizará pero recibirás una advertencia en la vista de registro de errores de magnalister.<br /><br /> 
 <b>Uso de direcciones https para imágenes (URLs seguras)</b><br /><br /> 
 eBay no permite URL seguras para las imágenes si se especifican directamente como dirección en los datos del artículo. Nuestro paquete de imágenes utiliza el servicio de imágenes de eBay para almacenar las imágenes, por lo que admite URL seguras.<br /><br /> 
 <b>Duración del procesamiento</b><br /><br /> 
 Con el paquete de imágenes, las imágenes se suben primero a eBay y luego se adjuntan al artículo correspondiente. Esto puede llevar entre 2 y 5 segundos por imagen, dependiendo del tamaño de la imagen.<br /><br /> 
 Para que la velocidad de procesamiento a través de la tienda sea razonable, los datos se almacenan en el servidor de magnalister. Los posibles mensajes de error de eBay se pueden ver en el registro de errores de magnalister sólo después de que se haya completado la subida a eBay.<br /><br /> 
 <b>Actualización de imágenes en eBay</b><br /><br /> 
 Con el paquete de imágenes, sólo tienes que cambiar la imagen en tu tienda y volver a subir el artículo para que el cambio sea visible en eBay.<br /> 
 Sin ella, una imagen sólo cambiará en eBay si cambias la URL de la imagen (y luego subes el artículo).<br /><br /> 
 <b>Posibles tarifas en la parte de eBay</b><br /><br /> 
 El uso de Picture Pack es gratuito para las páginas de eBay en Alemania y Austria. Para otros países, consulta las páginas de ayuda de eBay o ponte en contacto con el servicio de asistencia de eBay en tu país.<br /><br /> 
 RedGecko GmbH no se hace responsable de las tasas de eBay causadas.';
MLI18n::gi()->{'ebay_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'ebay_configform_orderimport_shipping_values__textfield__textoption'} = '1';

MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__40'} = '40 días';
MLI18n::gi()->{'ebay_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'ebay_config_account__field__oauth.token__label'} = 'Token del catálogo';
MLI18n::gi()->{'ebay_config_prepare__field__mwst.always__label'} = '&quot;IVA incl. &quot; mostrar siempre';
MLI18n::gi()->{'ebay_config_prepare__field__productfield.tecdocktype__help'} = '<strong>Sólo para piezas de coches y motos</strong><br /><br />
                Si quieres incluir el <strong>TecDoc KType</strong> en la base de datos de la tienda y transferirlo a los listados de eBay,
                introduce aquí la columna de la base de datos donde se encuentra el número.<br /><br />
                Éste se transferirá a eBay (si está almacenado para el artículo en cuestión) y el artículo se podrá encontrar más fácilmente utilizando la lista de compatibilidad correspondiente.<br /><br />
                También puede utilizar esta configuración para los <strong>números ePID</strong> (para vehículos de dos ruedas). Basándose en la categoría de eBay, magnalister reconoce si el artículo es una pieza de coche o de dos ruedas y reenvía el número a eBay en consecuencia.';
MLI18n::gi()->{'ebay_config_account__field__oauth.token__help'} = 'A partir de agosto de 2018, la asignación de productos al catálogo de productos de eBay será obligatoria para <b>algunas</b> categorías de eBay. En cuanto seleccione una de estas categorías durante la preparación, verá el mensaje correspondiente. El acceso al catálogo requiere un token separado que no es idéntico al token "normal" (un tipo diferente de autenticación).<br><br>
					<b>El requisito del catálogo sólo se aplica inicialmente a los sitios Web de eBay en inglés y a Alemania</b>. Si utilizas el sitio de otro país, no necesitas este código.<br><br>
					Para solicitar un nuevo código de catálogo de eBay, haz clic en el botón. Si no se abre ninguna ventana de eBay al pulsar el botón, significa que tienes activado un bloqueador de ventanas emergentes.<br><br>
					A partir de ese momento, siga las instrucciones de la página de eBay para solicitar la ficha y poder utilizar el catálogo de eBay con magnalister.';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.addkind__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.addkind__label'} = '';
MLI18n::gi()->{'ebay_config_account__field__username__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.factor__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.active__label'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'ebay_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.kind__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.cancelled__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.factor__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.group__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.factor__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.addkind__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.addkind__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.factor__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price__hint'} = '';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.factor__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.priceoptions__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__updateable.orderstatus__help'} = '';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.group__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.group__label'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shippingmethod__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.paymentmethod__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.factor__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__buyitnowprice__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.addkind__label'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.refund__hint'} = '';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__help'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.priceoptions__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.group__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__updateable.orderstatus__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.priceoptions__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.group__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderupdate__info'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.addkind__hint'} = '';