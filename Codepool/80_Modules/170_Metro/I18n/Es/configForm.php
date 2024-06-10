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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLI18n::gi()->{'metro_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'metro_config_account_emailtemplate'} = 'Plantilla de correo electrónico de promoción';
MLI18n::gi()->{'metro_config_account_producttemplate'} = 'Plantilla de producto';
MLI18n::gi()->{'metro_config_priceandstock__field__price__label'} = 'Precio';
MLI18n::gi()->{'metro_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'metro_config_account_sync'} = 'Precio y existencias';
MLI18n::gi()->{'formfields_metro_freightforwarding_values__false'} = 'No';
MLI18n::gi()->{'metro_config_sync_inventory_import__false'} = 'No';
MLI18n::gi()->{'metro_config_priceandstock__field__price.signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_general_nosync'} = 'sin sincronización';
MLI18n::gi()->{'formfields_metro_freightforwarding_values__true'} = 'Si';
MLI18n::gi()->{'metro_config_sync_inventory_import__true'} = 'Si';
MLI18n::gi()->{'metro_config_invoice'} = 'Facturas';
MLI18n::gi()->{'metro_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'metro_config_priceandstock__field__price__help'} = 'Introduce un porcentaje o un recargo o descuento de precio fijo. Descuento con signo menos antepuesto.<br><br><span style="color: red">El recargo por envío seleccionado en "Preparación del artículo" se añade al precio definido aquí.</span>.';
MLI18n::gi()->{'metro_config_priceandstock__field__price.signal__help'} = 'Este campo de texto será tomado como un decimal en su precio al transmitir los datos a ebay.<br/><br/>
 <strong>Ejemplo:</strong> <br />
 Valor en el campo de texto: 99 <br />
 Precio de origen: 5.58 <br />
 Resultado final: 5.99 <br /><br />
 La función ayuda especialmente con los porcentajes de aumento/disminución de precios.<br/>
 Deja el campo vacío si no quieres transmitir un decimal.<br/>
 El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_account_orderimport'} = 'Pedidos';
MLI18n::gi()->{'metro_configform_stocksync_values__rel'} = 'El pedido reduce el stock de la tienda (recomendado)';
MLI18n::gi()->{'formfields_metro__orderstatus.accepted__label'} = 'Pedido aceptado con';
MLI18n::gi()->{'metro_config_account_emailtemplate_sender'} = 'Tienda de ejemplo';
MLI18n::gi()->{'metro_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.de';
MLI18n::gi()->{'metro_configform_orderimport_payment_values__matching__title'} = 'Asignación automática';
MLI18n::gi()->{'metro_configform_orderimport_shipping_values__matching__title'} = 'Asignación automática';
MLI18n::gi()->{'metro_config_general_autosync'} = 'Sincronización automática mediante CronJob (recomendado)';
MLI18n::gi()->{'metro_configform_orderimport_payment_values__textfield__title'} = 'Del campo de texto';
MLI18n::gi()->{'metro_configform_orderimport_shipping_values__textfield__title'} = 'Del campo de texto';
MLI18n::gi()->{'metro_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'metro_config_priceandstock__field__price__hint'} = '<span style="color: red">Al precio definido aquí se le añade el importe de la factura del artículo que se ha elegido</span>.';
MLI18n::gi()->{'metro_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'metro_configform_orderstatus_sync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_sync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_stocksync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_pricesync_values__no'} = '{#i18n:metro_config_general_nosync#}';
MLI18n::gi()->{'metro_configform_orderstatus_sync_values__auto'} = '{#i18n:metro_config_general_autosync#}';
MLI18n::gi()->{'metro_configform_sync_values__auto'} = '{#i18n:metro_config_general_autosync#}';
MLI18n::gi()->{'metro_configform_pricesync_values__auto'} = '{#i18n:metro_config_general_autosync#}';
MLI18n::gi()->{'metro_config_emailtemplate_content'} = '<style><!--
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
MLI18n::gi()->{'metro_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'metro_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'metro_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'metro_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'formgroups_metro__account'} = 'Datos de acceso';
MLI18n::gi()->{'metro_config_account__field__clientkey__label'} = 'Clave de cliente Makro';
MLI18n::gi()->{'metro_config_account__field__clientkey__help'} = 'Introduce aquí la "Clave de Cliente Makro".\nEn la actualidad, sólo puedes solicitarla al Soporte al Vendedor del marketplace Makro. Por favor, envíe un e-mail a: seller@metro-marketplace.eu';
MLI18n::gi()->{'metro_config_account__field__secretkey__label'} = 'Clave secreta de Makro';
MLI18n::gi()->{'metro_config_account__field__secretkey__help'} = 'Introduce aquí la "Clave secreta de Makro". Actualmente, sólo puedes solicitarla al Servicio de Atención al Vendedor de Makro Marketplace. Para ello, envíe un correo electrónico a: seller@metro-marketplace.eu';
MLI18n::gi()->{'metro_config_account__field__shippingdestination__label'} = 'Sitio Makro';
MLI18n::gi()->{'metro_config_account__field__shippingdestination__help'} = 'Makro por defecto: Actualmente no es posible el Comercio Transfronterizo.';
MLI18n::gi()->{'metro_config_account__field__shippingorigin__label'} = 'Envío desde';
MLI18n::gi()->{'metro_config_account__field__shippingorigin__help'} = 'Makro por defecto: Actualmente no es posible el Comercio Transfronterizo.';
MLI18n::gi()->{'formgroups_metro__prepare'} = 'Vista previa del artículo';
MLI18n::gi()->{'metro_config_prepare__field_prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'metro_config_prepare__field_prepare.status__help'} = 'En la tienda web puede configurar los artículos como activos o inactivos. Dependiendo de la configuración aquí, sólo se muestran los artículos activos al preparar los productos.';
MLI18n::gi()->{'metro_config_prepare__field_prepare.status__hint'} = 'Aceptar sólo artículos activos';
MLI18n::gi()->{'metro_config_prepare__field__processingtime__label'} = 'Plazo de entrega mín. en días laborables';
MLI18n::gi()->{'metro_config_prepare__field__processingtime__help'} = 'Introduce el número mínimo de días laborables desde que el cliente realiza el pedido hasta que recibe el paquete.';
MLI18n::gi()->{'metro_config_prepare__field__maxprocessingtime__label'} = 'Máx. Plazo de entrega en días laborables';
MLI18n::gi()->{'metro_config_prepare__field__maxprocessingtime__help'} = 'Introduce aquí el número máximo de días laborables desde que el cliente realiza el pedido hasta que recibe el paquete.';
MLI18n::gi()->{'metro_config_prepare__field__businessmodel__label'} = 'Determinar el grupo de compradores';
MLI18n::gi()->{'metro_config_prepare__field__businessmodel__help'} = 'Asignar el producto a un grupo de compradores: <ul><li>B2C y B2B: el producto se dirige a ambos grupos de compradores</li><li>B2B: El producto se dirige a clientes finales comerciales</li></ul>.';
MLI18n::gi()->{'metro_config_prepare__field__freightforwarding__label'} = 'Entrega por transportista';
MLI18n::gi()->{'metro_config_prepare__field__freightforwarding__help'} = 'Indica si tu producto se enviará por un transportista.';
MLI18n::gi()->{'metro_config_prepare__legend__shipping'} = 'Envío';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile__label'} = 'Perfiles de gastos de envío';
MLI18n::gi()->{'metro_config_prepare__field__shippinggroup__label'} = 'Grupos de envío';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile__help'} = 'Crea aquí tus perfiles de gastos de envío. Puedes especificar diferentes gastos de envío para cada perfil (ejemplo: 4.95) y definir un perfil estándar. Los gastos de envío especificados se añadirán al precio del artículo cuando se cargue el producto, ya que los artículos sólo pueden cargarse en el marketplace Makro libres de gastos de envío.';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile.name__label'} = 'Nombre del perfil de gastos de envío';
MLI18n::gi()->{'metro_config_prepare__field__shippingprofile.cost__label'} = 'Recargo de gastos de envío (bruto)';
MLI18n::gi()->{'metro_config_prepare__field__shipping.group__label'} = 'Grupos de envío';
MLI18n::gi()->{'metro_config_prepare__field__shipping.group__hint'} = 'Grupo específico de ajustes de envío que se define en función del vendedor para una oferta. El grupo de envío del vendedor es creado y gestionado por el vendedor en la interfaz de usuario para los ajustes de envío.';
MLI18n::gi()->{'metro_config_prepare__field__shipping.group__help'} = 'Los vendedores pueden crear un grupo con diferentes configuraciones de envío en función de sus necesidades empresariales y casos de uso. Se pueden seleccionar diferentes grupos de configuraciones de envío para diferentes regiones, con diferentes condiciones de envío y tarifas para cada región.<br /><br />
Cuando el vendedor crea un producto como oferta, puede especificar uno de los grupos de configuración de envío creados para ese producto. Los ajustes de envío de este grupo se utilizan entonces para mostrar la opción de envío aplicable para cada producto en el sitio web.<br /><br />
<strong>Importante</strong>: Copia el nombre de grupo de envío de su cuenta Makro en los campos correspondientes aquí. Sólo se utilizarán éstos. La descripción sólo se utiliza aquí para mostrarlos en la preparación del producto.<br /><br />
Para más detalles sobre la creación de grupos de envío, consulta <a href="https://developer.metro-selleroffice.com/docs/offer-data/shipping/" target="_blank">la documentación de Makro</a>';
MLI18n::gi()->{'metro_config_prepare__field__shipping.group.name__label'} = 'Designación del grupo de envío';
MLI18n::gi()->{'metro_config_prepare__field__shipping.group.id__label'} = 'ID de grupos de envío';
MLI18n::gi()->{'formgroups_metro__upload'} = 'Subir artículos: Preferencias';
MLI18n::gi()->{'metro_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'metro_config_prepare__field__checkin.status__help'} = 'En la tienda web puedes establecer que los artículos estén activos o inactivos. Dependiendo de la configuración aquí, sólo se muestran los artículos activos al preparar los productos.';
MLI18n::gi()->{'metro_config_prepare__field__checkin.status__hint'} = 'Tomar sólo artículos activos';
MLI18n::gi()->{'metro_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'metro_config_prepare__field__lang__help'} = 'Precio y existencias';
MLI18n::gi()->{'formgroups_legend_quantity'} = 'Stock';
MLI18n::gi()->{'metro_config_priceandstock__field__quantity__label'} = 'Stock';
MLI18n::gi()->{'metro_config_priceandstock__field__quantity__help'} = 'Especifique aquí la cantidad de existencias de un artículo que debe estar disponible en Makro.<br />
            <br />
            Para evitar la sobreventa, puede activar el valor<br />.
            Adquirir existencias de la tienda menos el valor del campo derecho".<br />
<br />
            <strong>Ejemplo:</strong> Establece el valor en "2". Resultados → Almacén de tienda: 10 → Almacén Makro: 8<br />
            <br />
          Nota: Si desea tratar los artículos que están inactivos en la tienda como existencias "0" también en el marketplace, independientemente de las cantidades de existencias utilizadas, proceda como se indica a continuación:<br />
            <br />
            <ul>
                <li>"Sincronización del inventario" > "Configurar tienda de cambio de existencias" a "sincronización automática mediante CronJob</li>
                <li>"Configuración global" > "Estado del producto" > "Si el estado del producto es inactivo, el stock se trata como 0" activar</li>
            </ul>';
MLI18n::gi()->{'metro_config_priceandstock__field__maxquantity__label'} = 'Límite de cantidad';
MLI18n::gi()->{'metro_config_priceandstock__field__maxquantity__help'} = 'Aquí puedes limitar el número de artículos que puedes colocar en Makro.<br /><br />
            <strong>Ejemplo:</strong> En "Número de artículos" configure "Asumir stock de la tienda" e introduce 20 aquí. Luego, al cargar, se ponen tantas piezas como estén disponibles en la tienda, pero no más de 20. La sincronización de existencias (si está activada) ajusta el número de artículos {#setting:currentMarketplaceName#} a las existencias de la tienda siempre que éstas sean inferiores a 20 artículos. Si hay más de 20 artículos en stock en la tienda, la cantidad {#setting:currentMarketplaceName#} se fijará en 20.<br /><br />
            Deje este campo en blanco o introduzca 0 si no desea un límite.<br /><br />
            <strong>Nota:</strong> Si el ajuste "Número de piezas" es "Suma global (del campo derecho)", el límite no tiene efecto.';
MLI18n::gi()->{'formgroups__comparisonprice'} = 'Cálculo de precios';
MLI18n::gi()->{'metro_config_priceandstock__field__price__label'} = 'Precio';
MLI18n::gi()->{'metro_config_priceandstock__field__price__help'} = 'Introduce un porcentaje o precio fijo de recargo o reducción. Marcado con un signo menos delante.<br><br><span style="color:red">El recargo de envío seleccionado en "Preparación del artículo" se añade al precio definido aquí.</span>"';
MLI18n::gi()->{'metro_config_priceandstock__field__price.addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__price.factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__priceoptions__label'} = 'Precio de venta del grupo de clientes';
MLI18n::gi()->{'metro_config_priceandstock__field__priceoptions__help'} = '<p>Con esta función puedes establecer diferentes precios para {#setting:currentMarketplaceName#} y sincronizarlos automáticamente..</p>
<p>Para ello, seleccione un grupo de clientes de su tienda web utilizando el menú desplegable de al lado. </p>
<p>Si no introduce un precio en el nuevo grupo de clientes, se utilizará automáticamente el precio estándar de la tienda online. Esto hace que sea muy fácil introducir un precio diferente para unos pocos artículos. También se aplican las demás configuraciones para el precio.</p>
<p><b>Ejemplo de aplicación:</b></p>
<ul>
<li>Almacene un grupo de clientes en su tienda web, por ejemplo {#setting:currentMarketplaceName#} clientes".</li>
<li>En su tienda web, introduce los precios deseados para los artículos del nuevo grupo de clientes.</li>
 </ul>';
MLI18n::gi()->{'metro_config_priceandstock__field__price.usespecialoffer__label'} = 'utilizar también precios especiales';
MLI18n::gi()->{'metro_config_priceandstock__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'metro_config_priceandstock__field__exchangerate_update__help'} = '<strong>Básicamente:</strong>
<p>
Si la moneda por defecto de la tienda web difiere de la moneda del marketplace, magnalister calcula la importación del pedido y la carga del artículo utilizando el tipo de moneda almacenado en la tienda web. 
Al importar pedidos, magnalister guarda las divisas y los importes 1:1 de la misma forma que la tienda web los crea cuando se recibe un pedido.
</p>

<strong>Atención:</strong>
<p>
Al activar esta función aquí, el tipo de cambio almacenado en la tienda web se actualiza con el servicio web de Prestashop para los tipos de cambio.
<u>Esto también muestra los precios en su tienda web con el tipo de cambio actualizado para la venta.</u>
</p>
<p>
Las siguientes funciones activan la actualización:
<ul>
<li>Importación de pedidos</li>
<li>Preparación del artículo</li>
<li>Carga del artículo</li>
<li>Sincronización de precios y existencias</li>
</ul>
</p>
<p>
Si el tipo de moneda de un marketplace no se ha creado en la configuración de moneda de la tienda web, magnalister emitirá un mensaje de error.
</p>';
MLI18n::gi()->{'metro_config_priceandstock__field__exchangerate_update__alert'} = '<strong>Atención:</strong>
<p>
Al activarlo, el tipo de cambio almacenado en la tienda web se actualiza con el servicio web de Prestashop para tipos de cambio.
<u>Esto también mostrará los precios en su tienda web con el tipo de cambio actualizado para la venta.</u>
</p>
<p>
Las siguientes funciones activan la actualización:
<ul>
<li>Importación de pedidos</li>
<li>Preparación del artículo</li>
<li>Carga del artículo</li>
<li>Sincronización de precios y existencias</li>
</ul>
</p>';
MLI18n::gi()->{'metro_config_priceandstock__field__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'formgroups__sync'} = 'Sincronización del inventario';
MLI18n::gi()->{'metro_config_priceandstock__field__stocksync.tomarketplace__label'} = 'Cambio de existencias de la tienda';
MLI18n::gi()->{'metro_config_priceandstock__field__stocksync.tomarketplace__help'} = '<dl>
                <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                <dd>
                    La función &quot;Sincronización automática&quot; ajusta el nivel de existencias actual {#setting:currentMarketplaceName#} al nivel de existencias de la tienda cada 4 horas (comienza a las 0:00 a.m.) (dependiendo de la configuración, con deducción si es necesario).<br />
                    <br />
                    Los valores de la base de datos se comprueban y se asumen, aunque los cambios sólo se hayan realizado en la base de datos, por ejemplo, mediante un sistema de gestión de mercancías.<br />
                    <br />
                    Puedes iniciar una sincronización manual haciendo clic en el botón de función correspondiente &quot;Sincronización de precios y existencias&quot; en la esquina superior derecha del plugin magnalister.<br />
                    Además, también puede activar el balance de existencias (desde tarifa plana - máximo cada cuarto de hora) mediante su propio CronJob llamando al siguiente enlace de su tienda:<br />
                    <i>{#setting:sSyncInventoryUrl#}</i><br />
                    Se bloquean las llamadas CronJob propias de clientes que no están en el plano tarifario, o que se ejecutan con una frecuencia superior al cuarto de hora.<br />
                </dd>
            </dl>
            <br />
            <strong>Nota:</strong> Se tienen en cuenta los ajustes de &quot;Configuración&quot; → &quot;Preparación de artículos&quot; → &quot;Cantidad de existencias&quot;.';
MLI18n::gi()->{'metro_config_priceandstock__field__stocksync.frommarketplace__label'} = 'Importación de pedidos de Makro';
MLI18n::gi()->{'metro_config_priceandstock__field__stocksync.frommarketplace__help'} = 'Por ejemplo, si un artículo se ha comprado 3 veces en Makro, las existencias de la tienda se reducen en 3.<br />
            <br />
            <strong>Importante:</strong>Esta función sólo funciona si ha activado la importación de pedidos.';
MLI18n::gi()->{'metro_config_priceandstock__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'metro_config_priceandstock__field__inventorysync.price__help'} = '<dl>
                <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                <dd>
                    Con la función &quot;Sincronización automática&quot; el precio almacenado en la tienda web se transmite al marketplace Makro (si está configurado en magnalister, con aumentos o reducciones de precio). La sincronización tiene lugar cada 4 horas (punto de partida: 0:00 horas).
                    Los valores de la base de datos se comprueban y se asumen, aunque los cambios sólo se hayan realizado en la base de datos, por ejemplo, mediante un sistema de gestión de mercancías.<br />
                    <br />
                    Puedes iniciar una comparación manual haciendo clic en el botón de función correspondiente &quot;Sincronización de precios y existencias&quot; en la esquina superior derecha del plugin magnalister..<br />
                    <br />
                    Además, también puede activar la comparación de precios a través de su propio CronJob llamando al siguiente enlace de su tienda:<br />
                    <i>{#setting:sSyncInventoryUrl#}</i><br />
                    Se bloquean las llamadas CronJob propias de clientes que no están en el plano tarifario, o que se ejecutan con una frecuencia superior al cuarto de hora.<br />
                </dd>
            </dl>
            <br />
            <strong>Nota:</strong> Se tienen en cuenta los ajustes de &quot;Configuración&quot; → &quot;Cálculo de precios&quot;.';
#MLI18n::gi()->{'formgroups_metro__volumeprices'} = 'Precios escalonados';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricesenable__label'} = 'Precios escalonados';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricesenable__help'} = '<p>Los precios escalonados se utilizan para ofrecer descuentos a los compradores que adquieren cantidades mayores. Para configurar los precios escalonados, dispone de las siguientes opciones en magnalister:</p>
            <p><br></p>
            <ol>
                <li>
                    <p>Utilizar a partir de la siguiente configuración<br><br>Seleccione esta opción si desea<strong>en el plugin magnalister</strong> desea establecer descuentos de precio escalonados para todos los productos que cargue en el marketplace Makro.<br><br>Al seleccionar la opción, aparece una lista en la que puedes elegir en el primer paso qué tipo de descuento por precio escalonado quieres conceder:</p> 
                    <ol style="list-style-type: lower-alpha;">
                        <li>
                            <p>Porcentaje de recargo/descuento sobre el precio<br><br>Introduce aquí un porcentaje de descuento para el número de piezas respectivo (por ejemplo, a partir de 2 piezas -&gt; &ldquo;5&rdquo; para un descuento del 5%). El precio transferido de magnalister a Makro &uuml;bert por una compra de 2 piezas se reducirá entonces un 5%.<br><br>Makro especifica las opciones de graduación para los precios. Una escala es posible entre 2 y 5 piezas, además puede introducir sus propias escalas bajo &ldquo;A partir de una pieza&uuml;ck&rdquo; y &ldquo;A partir de una pieza B&uuml;ck&rdquo; (por ejemplo, 15% de descuento a partir de una compra de 10 piezas).<br><br>Además, puedes manipular la visualización del precio en el rango de céntimos a través del decimal. Encontrará más información al respecto en el icono de información situado junto a &ldquo;Lugar decimal&rdquo.</p>
                        </li>
                        <li>
                            <p>Precio fijo con recargo/descuento<br><br>Esta opción funciona de forma análoga a a. En lugar de un porcentaje de descuento, puede introducir aquí un importe fijo en euros (por ejemplo, A partir de 2 piezas -&gt; &ldquo;5&rdquo; para un descuento de 5 euros).</p>
                        </li>
                        <li>
                            <p>Grupo de clientes<br><br>En su sistema de tienda tienes la posibilidad de asignar artículos a determinados grupos de clientes. Dentro de los grupos de clientes puedes entonces realizar ajustes en el precio. Si almacena un grupo de clientes en magnalister para una determinada escala (por ejemplo &ldquo;A partir de 5 unidades&rdquo;), los ajustes de precio del grupo de clientes se aplican a esta escala.</p>
                        </li>
                    </ol>
                </li>
                <li>
                    <p>Tomar el relevo de la tienda web<br><br>Algunos sistemas de tiendas ofrecen ellos mismos opciones de precios graduados. Si selecciona &ldquo;Aplicar desde tienda web&rdquo; en magnalister, puedes aplicar la configuración del precio de escala <strong>desde un grupo de clientes de la tienda</strong>.</p>
                </li>
                <li>
                    <p>No utilizar<br><br>Si no desea ofrecer precios escalonados en Makro, seleccione esta opción..<br><br><br></p>
                </li>
            </ol>
            <p><strong>Importante:</strong></p>
            <p>El precio graduado debe ser inferior al precio estándar del producto, de lo contrario las ofertas serán rechazadas por Makro..</p>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricesenable__hint'} = '<span style=color: red">Atención nota importante: Los recargos por envío no afectan a los precios de la báscula</span>"';
MLI18n::gi()->{'formfields_metro__volumeprices_enable_useconfig'} = 'Utilizar a partir de la siguiente configuración';
MLI18n::gi()->{'formfields_metro__volumeprices_enable_webshop'} = 'Transferencia desde la tienda web';
MLI18n::gi()->{'formfields_metro__volumeprices_enable_dontuse'} = 'No utilizar';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2__label'} = 'A partir de 2 piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2__help'} = 'Si se selecciona la opción "Subir / Bajar", independientemente de si se trata de un porcentaje o de un valor fijo, se ignora el ajuste "Precio" seleccionado en "Cálculo de precios", pero las "Opciones de precio" (como grupo de clientes, precios especiales) permanecen activas.<br>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice2signal__help'} = 'Este campo de texto se tomará como decimal en su precio cuando envíe los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Precio de origen: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                La función es especialmente útil para los aumentos/disminuciones porcentuales de precios.<br/>
                Deje el campo vacío si no desea determinar un decimal.<br/>
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3__label'} = 'A partir de 3 piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3__help'} = 'Si se selecciona la opción "Subir / Bajar", independientemente de si se trata de un porcentaje o de un valor fijo, se ignora el ajuste "Precio" seleccionado en "Cálculo de precios", pero las "Opciones de precio" (como grupo de clientes, precios especiales) permanecen activas.<br>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice3signal__help'} = 'Este campo de texto se tomará como decimal en su precio cuando envíe los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Precio de origen: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                La función es especialmente útil para los aumentos/disminuciones porcentuales de precios.<br/>
                Deje el campo vacío si no desea determinar un decimal.<br/>
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4__label'} = 'A partir de 4 piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4__help'} = 'Si se selecciona la opción "Subir / Bajar", independientemente de si se trata de un porcentaje o de un valor fijo, se ignora el ajuste "Precio" seleccionado en "Cálculo de precios", pero las "Opciones de precio" (como grupo de clientes, precios especiales) permanecen activas.<br>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice4signal__help'} = 'Este campo de texto se tomará como decimal en su precio cuando envíe los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Precio de origen: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                La función es especialmente útil para los aumentos/disminuciones porcentuales de precios.<br/>
                Deje el campo vacío si no desea determinar un decimal.<br/>
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5__label'} = 'A partir de 5 piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5__help'} = 'Si se selecciona la opción "Subir / Bajar", independientemente de si se trata de un porcentaje o de un valor fijo, se ignora el ajuste "Precio" seleccionado en "Cálculo de precios", pero las "Opciones de precio" (como grupo de clientes, precios especiales) permanecen activas.<br>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5addkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5factor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepriceprice5signal__help'} = 'Este campo de texto se tomará como decimal en su precio cuando envíe los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Precio de origen: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                La función es especialmente útil para los aumentos/disminuciones porcentuales de precios.<br/>
                Deje el campo vacío si no desea determinar un decimal.<br/>
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricea__label'} = 'A partir de A piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricea__help'} = 'Si se selecciona la opción "Subir / Bajar", independientemente de si se trata de un porcentaje o de un valor fijo, se ignora el ajuste "Precio" seleccionado en "Cálculo de precios", pero las "Opciones de precio" (como grupo de clientes, precios especiales) permanecen activas.<br>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceaaddkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceafactor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceasignal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceasignal__help'} = 'Este campo de texto se tomará como decimal en su precio cuando envíe los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Precio de origen: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                La función es especialmente útil para los aumentos/disminuciones porcentuales de precios.<br/>
                Deje el campo vacío si no desea determinar un decimal.<br/>
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceastart__label'} = 'A partir de A piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceastart__help'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceb__label'} = 'A partir de B piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepriceb__help'} = 'Si se selecciona la opción "Subir / Bajar", independientemente de si se trata de un porcentaje o de un valor fijo, se ignora el ajuste "Precio" seleccionado en "Cálculo de precios", pero las "Opciones de precio" (como grupo de clientes, precios especiales) permanecen activas.<br>';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebaddkind__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebfactor__label'} = '';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebsignal__label'} = 'Lugar decimal';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebsignal__help'} = 'Este campo de texto se tomará como decimal en su precio cuando envíe los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Precio de origen: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                La función es especialmente útil para los aumentos/disminuciones porcentuales de precios.<br/>
                Deje el campo vacío si no desea determinar un decimal.<br/>
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebstart__label'} = 'A partir de B piezas';
MLI18n::gi()->{'metro_config_priceandstock__field__volumepricepricebstart__help'} = '';
MLI18n::gi()->{'formgroups__orderimport'} = 'Pedidos de importación';
MLI18n::gi()->{'formgroups__mwst'} = 'Impuesto sobre el valor añadido';
MLI18n::gi()->{'formgroups_metro__orderstatus'} = 'Sincronización del estado del pedido desde la tienda a Makro';
MLI18n::gi()->{'formfields_metro__orderstatus.carrier__label'} = 'Transportista';
MLI18n::gi()->{'formfields_metro__orderstatus.carrier__help'} = 'Transportista preseleccionado al confirmar el envío a Makro.';
MLI18n::gi()->{'formfields_metro__orderstatus.cancellationreason__label'} = 'Cancelar pedido - motivo';

MLI18n::gi()->{'metro_config_prepare__field__shippingprofile__hint'} = '<span style="color: red">El recargo de envío definido aquí se añade al "Cálculo de precio" (pestaña: "Precio y existencias")</span><br><br>Por favor, utiliza el punto (.) como separador para los decimales.';
MLI18n::gi()->{'metro_config_account__legend__tabident'} = 'Pestaña';
MLI18n::gi()->{'formfields__price__hint'} = '<span style="color: red">El recargo de envío seleccionado en "Preparación del artículo" se añade al precio definido aquí</span>.';
MLI18n::gi()->{'metro_config_prepare__legend__pictures'} = 'Ajustes de las imágenes';
MLI18n::gi()->{'formfields__price__help'} = 'Introduce un porcentaje o precio fijo de recargo o rebaja. Descuento con un signo menos delante.<br><br><span style="color: red">El recargo de expedición seleccionado en "Preparación del artículo" se añade al precio definido aquí</span>';
MLI18n::gi()->{'metro_config_account__field__shippingdestination__hint'} = '¿En qué país del marketplace de Makro deben venderse tus productos?';
MLI18n::gi()->{'metro_config_prepare__legend__prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'formfields__importactive__hint'} = 'Nota: Los pedidos del marketplace Makro se aceptan automáticamente cuando se transfieren a la tienda web (importación de pedidos).';
MLI18n::gi()->{'metro_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'metro_config_account__field__shippingorigin__hint'} = 'Desde qué país se envían tus productos';
MLI18n::gi()->{'metro_config_prepare__legend__upload'} = 'Subir artículo: Configuración por defecto';
MLI18n::gi()->{'formfields_metro__orderstatus.accepted__help'} = '';