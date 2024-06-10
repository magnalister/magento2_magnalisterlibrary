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
MLI18n::gi()->{'googleshopping_config_account_sync'} = 'Sincronización';
MLI18n::gi()->{'googleshopping_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'googleshopping_methods_not_available'} = 'Añade primero el código de compra directa en "Datos de acceso" y guárdalo.';
MLI18n::gi()->{'googleshopping_config_orderimport1__legend__dummy__title'} = 'Orden de Importación';
MLI18n::gi()->{'googleshopping_config_account_orderimport'} = 'Importación de pedidos';
MLI18n::gi()->{'googleshopping_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'googleshopping_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'googleshopping.choose.language'} = 'Selecciona el idioma...';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customergroup__help'} = 'Grupo de clientes al que deben asignarse los clientes para nuevos pedidos.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shippingmethod__label'} = 'Método de envío de los pedidos';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shippingmethod__help'} = 'Método de envío que se asigna a todos los pedidos de GoogleShopping. Por defecto: "GoogleShopping".<br><br>Este ajuste es importante para la impresión de facturas y albaranes y para el posterior procesamiento del pedido en la tienda y en algunos sistemas de gestión de mercancías.';
MLI18n::gi()->{'ML_GOOGLESHOPPING_ERROR_GOOGLESHOPPING_LANGUAGE_SET'} = 'El idioma de vinculación de Google Shopping no está definido en la configuración del marketplace (Preparación del artículo > Vinculación del idioma del producto).';
MLI18n::gi()->{'googleshopping_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'googleshopping_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'googleshopping_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'googleshopping_config_account__field__mpusername__label'} = 'ID de cuenta de comerciante';
MLI18n::gi()->{'googleshopping_config_account__field__mppassword__label'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__apikey__label'} = 'Aplicación&#8209;clave';
MLI18n::gi()->{'googleshopping_config_prepare__legend__prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'googleshopping_config_prepare__legend__upload'} = 'Subir artículo: Configuración por defecto';
MLI18n::gi()->{'googleshopping_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'googleshopping_config_prepare__field__prepare.status__valuehint'} = 'Sólo se aceptan artículos activos';
MLI18n::gi()->{'googleshopping_config_prepare__field__producttype__label'} = 'Tipo de producto';
MLI18n::gi()->{'googleshopping_config_prepare__field__returnpolicy__label'} = 'Política de anulación';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.status__valuehint'} = 'Sólo se aceptan artículos activos';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__label'} = 'Descripción del artículo';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__matching__titlesrc'} = 'GoogleLenguaje de compra';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__matching__titledst'} = 'Idioma de la tienda';
MLI18n::gi()->{'googleshopping_config_prepare__field__quantity__label'} = 'Número de unidades en stock';
MLI18n::gi()->{'googleshopping_config_prepare__field__quantity__help'} = '
                Especifique aquí cuánta cantidad de existencias de un artículo debe estar disponible en el mercado.<br/>
                <br/>
				Para evitar la sobreventa, puede establecer el valor<br/>
				"<i>Tomar el stock de la tienda menos el valor del campo derecho</i>".<br/>
				<br/>
				<strong>Ejemplo:</strong> Establezca el valor en "<i>2</i>". Resulta en &#8594; existencias de la tienda: 10 &#8594; existencias de DaWanda: 8<br/>.
				<br/>
				<strong>Nota:</strong> Si establece artículos que están inactivos en la tienda, independientemente de las cantidades de stock utilizadas<br/>
				también desea tratarlos como existencias "<i>0</i>" en el mercado, proceda de la siguiente manera:<br/>
				<ul>
                    <li>"<i>Sincronización del inventario</i>" > "<i>Tienda de cambio de existencias</i>" ajustado a "<i>Sincronización automática mediante CronJob"</i></li>.
                    <li>"<i>Configuración global" > "<i>Estado del producto</i>" > "<i>Si el estado del producto es inactivo, el stock se trata como 0" activar</i></li>
				</ul>
            ';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.leadtimetoship__label'} = 'Envío';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.manufacturerfallback__label'} = 'Fabricante alternativo';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.manufacturerfallback__help'} = 'Si un producto no tiene un fabricante introducido, se utilizará el fabricante especificado aquí.';
MLI18n::gi()->{'googleshopping_config_prepare__field__imagesize__label'} = '{#i18n:form_config_orderimport_imagesize_lable#}';
MLI18n::gi()->{'googleshopping_config_prepare__field__imagesize__help'} = '{#i18n:form_config_orderimport_imagesize_help#}';
MLI18n::gi()->{'googleshopping_config_prepare__field__imagesize__hint'} = '{#i18n:form_config_orderimport_imagesize_hint#}';
MLI18n::gi()->{'googleshopping_config_price__legend__price'} = 'Cálculo del precio';
MLI18n::gi()->{'googleshopping_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'googleshopping_config_price__field__price__help'} = 'Introduzca un porcentaje o precio fijo de recargo o rebaja. Descuento con un signo menos delante.';
MLI18n::gi()->{'googleshopping_config_price__field__price.signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'googleshopping_config_price__field__price.signal__hint'} = 'Lugar decimal';
MLI18n::gi()->{'googleshopping_config_price__field__price.signal__help'} = '
                Este campo de texto se utilizará como decimal en su precio al enviar los datos a DaWanda.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Origen del precio: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                Esta función es especialmente útil para aumentos/disminuciones porcentuales de precios.<br />
                Deje el campo vacío si no desea calcular un decimal.<br />
                El formato de entrada es un número entero con un máximo de 2 dígitos.
            ';
MLI18n::gi()->{'googleshopping_config_price__field__priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'googleshopping_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'googleshopping_config_price__field__price.usespecialoffer__label'} = 'utilice también precios especiales';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__label'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__help'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__exchangerate_update__alert'} = '';
MLI18n::gi()->{'googleshopping_config_sync__legend__sync'} = 'Sincronización del inventario';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.tomarketplace__label'} = 'Tienda de cambio de stock';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.tomarketplace__help'} = '
                <dl>
                    <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                    <dd>
                        La función "Sincronización automática" ajusta el nivel de existencias actual {#setting:currentMarketplaceName#} al nivel de existencias de la tienda cada 4 horas (a partir de las 0:00 horas) (con deducción si es necesario, en función de la configuración).<br />
                        <br />
                        Los valores de la base de datos se comprueban y adoptan, incluso si los cambios solo se han realizado en la base de datos, por ejemplo, mediante un sistema de gestión de mercancías.<br />
                        <br />
                        Puede iniciar la sincronización manual haciendo clic en el correspondiente botón de función "Sincronización de precios y existencias" en la parte superior derecha del plugin magnalister.<br />
                        Además, también puede activar la sincronización de existencias (desde Tarifa plana - máximo cada cuarto de hora) mediante su propio CronJob llamando al siguiente enlace de su tienda:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Se bloquean las llamadas a CronJob personalizados de clientes que no estén en la tarifa plana o que se ejecuten con una frecuencia superior a cada cuarto de hora.<br />
                    </dd>
                </dl>
                <br />
                <strong>Nota:</strong> Se tienen en cuenta los ajustes de "Configuración" → "Preparación de artículos" → "Número de artículos en stock".
            ';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.frommarketplace__label'} = 'Cambio de existencias DaWanda';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.frommarketplace__help'} = '
                Por ejemplo, si un artículo se ha comprado 3 veces en DaWanda, las existencias en la tienda se reducen en 3.<br /><br />
                <strong>Importante:</strong> ¡Esta función sólo funciona si ha activado la importación de pedidos!
            ';
MLI18n::gi()->{'googleshopping_config_sync__field__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'googleshopping_config_sync__field__inventorysync.price__help'} = '                <dl>
                    <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                    <dd>
                        Con la función "Sincronización automática", el precio almacenado en la tienda web se transmite al marketplace {#setting:currentMarketplaceName#} (si está configurado en magnalister, con recargos o reducciones de precio). La sincronización tiene lugar cada 4 horas (punto de partida: 0:00 a.m.).<br />
                        Los valores de la base de datos se comprueban y adoptan, incluso si los cambios sólo se realizaron en la base de datos, por ejemplo, por un sistema de gestión de mercancías.<br />
                        <br />
                        Puedes iniciar una sincronización manual haciendo clic en el botón de función correspondiente "Sincronización de precios y existencias" en la esquina superior derecha del plugin magnalister.<br />
                        <br />
                        También puedes activar la sincronización de precios mediante su propio CronJob accediendo al siguiente enlace de su tienda:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Se bloquean las llamadas a CronJob personalizados por parte de clientes que no estén en la tarifa plana o que se ejecuten con una frecuencia superior a cada cuarto de hora.<br />
                    </dd>
                </dl>
                <br />
                <strong>Nota:</strong> Se tienen en cuenta los ajustes en "Configuración" → "Cálculo de precios".';
MLI18n::gi()->{'googleshopping_config_orderimport__legend__importactive'} = 'Importación de pedidos';
MLI18n::gi()->{'googleshopping_config_orderimport__legend__mwst'} = 'Impuesto sobre el valor añadido';
MLI18n::gi()->{'googleshopping_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido de la tienda con DaWanda';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.shipped__label'} = 'Confirme el envío con';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.shipped__help'} = 'Establece aquí el estado de la tienda, que debería establecer automáticamente el estado "Confirmar envío" en DaWanda.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'googleshopping_config_orderimport__field__mwst.fallback__label'} = 'IVA Artículo no comercial';
MLI18n::gi()->{'googleshopping_config_orderimport__field__mwst.fallback__hint'} = 'Tipo impositivo utilizado para los artículos que no son de la tienda para las importaciones de pedidos en %.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__mwst.fallback__help'} = '
                Si el artículo no se puede encontrar en la tienda web, magnalister utilizará el tipo impositivo almacenado aquí, ya que los marketplaces no proporcionan ninguna información sobre el IVA al importar los pedidos.<br /> <br />
                <br />
                Más explicaciones:<br />
                En principio, magnalister se comporta de la misma manera que el propio sistema de la tienda a la hora de calcular el IVA para la importación de pedidos.<br />
                <br />
                Para que el IVA por país se tenga en cuenta automáticamente, el artículo adquirido debe encontrarse en la tienda web con su rango de números (SKU).
                A continuación, magnalister utiliza las clases de impuestos configuradas en la tienda web.
            ';
MLI18n::gi()->{'googleshopping_config_orderimport__field__importactive__label'} = 'Activar la importación';
MLI18n::gi()->{'googleshopping_config_orderimport__field__importactive__help'} = '
                ¿Deben importarse los pedidos del mercado? <br/><br/>Si la función está activada, los pedidos se importan continuamente por defecto.
                importados por defecto.<br><br>
				Puede iniciar una importación manual haciendo clic en el botón de la función correspondiente en la cabecera de magnalister (arriba a la derecha).<br><br>
				Además, también puede activar la importación de pedidos (desde Tarifa plana - máximo trimestral) con su propio CronJob haciendo clic en el siguiente enlace
    			a su tienda: <br>
    			<i>{#setting:sImportOrdersUrl#}</i><br><br>
    			Se bloquean las llamadas de CronJob propios de clientes que no estén en la tarifa Plana o que se ejecuten con una frecuencia superior a la trimestral.
				';
MLI18n::gi()->{'googleshopping_config_orderimport__field__preimport.start__label'} = 'por primera vez a partir de';
MLI18n::gi()->{'googleshopping_config_orderimport__field__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'googleshopping_config_orderimport__field__preimport.start__help'} = 'Hora de inicio a partir de la cual deben importarse las órdenes por primera vez. Ten en cuenta que esto no es posible retroceder tanto en el tiempo como desee, ya que DaWanda sólo dispone de los datos de unas pocas semanas como máximo.';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.open__help'} = '
                El estado que debe recibir automáticamente en la tienda un nuevo pedido recibido de DaWanda.<br />
                Si utiliza un sistema de reclamación conectado, se recomienda establecer el estado del pedido en "Pagado" (Configuración → Estado del pedido).
            ';
MLI18n::gi()->{'googleshopping_config_orderimport__field__order.importonlypaid__label'} = 'Importar sólo pedidos pagados';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__label'} = 'Clientes habituales';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__help'} = '
                DaWanda crea una nueva dirección de correo electrónico del comprador (reenvío) con cada pedido, que se puede utilizar para comunicarse por pedido.
                <br />
                En el menú desplegable, seleccione si la dirección de correo electrónico y otros datos maestros de los clientes recurrentes deben actualizarse y, por tanto, sobrescribirse, o si debe crearse un registro de datos de cliente completamente nuevo.
            ';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__values__1'} = 'Actualizar los datos de los clientes';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__values__0'} = 'Crear nuevos datos de clientes';

MLI18n::gi()->{'googleshopping_config_account__field__mpusername__help'} = 'Si tiene una cuenta multicliente de Google Shopping, introduzca el ID de la subcuenta que desea utilizar.';
MLI18n::gi()->{'googleshopping_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'googleshopping_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.leadtimetoship__hint'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__apikey__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__langs__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'googleshopping_config_account__legend__tabident'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__mpusername__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customersync__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__checkin.manufacturerfallback__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__returnpolicy__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__quantity__hint'} = '';
MLI18n::gi()->{'googleshopping_config_prepare__field__producttype__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'googleshopping_config_account__field__tabident__hint'} = '';
MLI18n::gi()->{'googleshopping_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__order.importonlypaid__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__price__hint'} = '';
MLI18n::gi()->{'googleshopping_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'googleshopping_config_orderimport__field__orderstatus.open__hint'} = '';