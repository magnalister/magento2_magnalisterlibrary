<?php 


MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmar envío con';
MLI18n::gi()->{'mercadolivre_config_account_orderimport'} = 'Pedidos';
MLI18n::gi()->{'mercadolivre_config_account__field__gettoken__label'} = 'Token de autenticación';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__buy_it_now'} = 'Comprar ahora';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'mercadolivre_config_prepare__field__customshipping__valuetitle'} = 'Gastos de envío';
MLI18n::gi()->{'mercadolivre_config_checkin_badshippingcost'} = 'Los gastos de envío deben ser una cifra.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__'} = '{#i18n:ML_AMAZON_LABEL_APPLY_PLEASE_SELECT#}';
MLI18n::gi()->{'mercadolivre_config_price__field__price__help'} = 'Introduce un porcentaje o precio fijo de recargo o rebaja. Descuento con un signo menos delante.';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__used'} = 'Usado';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__importactive__label'} = 'Activar la importación';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.quantity__label'} = 'Número de unidades en stock';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmodecontainer__label'} = 'Tipo de envío';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.content__hint'} = 'Lista de marcadores de posición disponibles para asunto y contenido:
                <dl>
                    <dt>#FIRSTNAME#</dt>
                    <dd>Nombre del comprador</dd>
                    <dt>#LASTNAME#</dt>
                    <dd>Apellido del comprador</dd>
                    <dt>#EMAIL#</dt>
                    <dd>Dirección de correo electrónico del comprador</dd>
                    <dt>#PASSWORD#</dt>
                    <dd>Contraseña del comprador para iniciar sesión en su tienda. Sólo para los clientes que se
                        crean automáticamente, de lo contrario el marcador de posición se sustituye por \'(como se sabe)\'.</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Resumen de los artículos comprados. Debe ir en una línea aparte.<br>
                        <i>¡No se puede utilizar en la línea de asunto!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>Nombre de este marketplace</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>URL de su tienda</dd>
                    <dt>#ORIGINATOR#</dt>
                    <dd>Nombre del remitente</dd>
                </dl>';
MLI18n::gi()->{'mercadolivre_config_account__legend__account'} = 'Datos de acceso';
MLI18n::gi()->{'mercadolivre_config_price__field__price.usespecialoffer__label'} = 'utilizar también precios especiales';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shippingmethod__help'} = 'Forma de envío que se asigna a todos los pedidos de MercadoLivre. Por defecto: "MercadoLivre".<br><br>Este ajuste es importante para la impresión de facturas y albaranes y para el posterior tratamiento del pedido en la tienda y en algunos sistemas de gestión de mercancías.';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__'} = '{#i18n:ML_AMAZON_LABEL_APPLY_PLEASE_SELECT#}';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__label'} = 'Estado del artículo';
MLI18n::gi()->{'mercadolivre_config_orderimport__legend__mwst'} = 'Impuesto sobre el valor añadido';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__preimport.start__label'} = 'por primera vez a partir de';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.copy__label'} = 'Copia al remitente';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.open__help'} = '
                El estado que debe recibir automáticamente en la tienda un nuevo pedido recibido por MercadoLivre.<br>
                Si utiliza un sistema de reclamación conectado, se recomienda que
                establecer el estado del pedido en "Pagado" (Configuración → Estado del pedido).
            ';
MLI18n::gi()->{'mercadolivre_config_account__field__mppassword__label'} = 'contraseña';
MLI18n::gi()->{'mercadolivre_config_orderimport__legend__orderstatus'} = 'Sincronización del estado del pedido desde la tienda a MercadoLivre';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.frommarketplace__label'} = 'Cambio de inventario MercadoLivre';
MLI18n::gi()->{'mercadolivre_config_price__field__priceoptions__label'} = 'Opciones de precios';
MLI18n::gi()->{'mercadolivre_config_account__field__mpusername__label'} = 'Nombre del miembro';
MLI18n::gi()->{'mercadolivre_config_prepare__field__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_sender_email'} = 'ejemplo@tiendaonline.com';
MLI18n::gi()->{'mercadolivre_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_sender'} = 'Ejemplo de tienda';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'mercadolivre_config_prepare__field__prepare.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__help'} = 'El modo de compra seleccionado se elegirá por defecto en el formulario de registro si está disponible.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.status__valuehint'} = 'Solo aceptar artículos activos';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__me1'} = 'MercadoEnvios 1';
MLI18n::gi()->{'mercadolivre_config_price__field__price__label'} = 'Precio';
MLI18n::gi()->{'mercadolivre_config_price__field__price.signal__label'} = 'Posición decimal';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmodecontainer__help'} = 'El modo de envío seleccionado se elegirá por defecto en el formulario de registro si está disponible.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'mercadolivre_config_prepare__field__currency__label'} = 'Moneda';
MLI18n::gi()->{'mercadolivre_config_orderimport__legend__importactive'} = 'Importación de pedidos';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__classified'} = 'Clasificado';
MLI18n::gi()->{'mercadolivre_config_account_sync'} = 'Sincronización de inventario';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__not_specified'} = 'No especificado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__currency__help'} = 'La divisa seleccionada se elegirá por defecto en el formulario de registro si está disponible.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.quantity__help'} = 'Especifica aquí la cantidad de existencias de un artículo que debe estar disponible en el mercado.<br>
                <br>
                Para evitar la sobreventa, puede establecer el valor <br>
                "<i>Tomar stock de la tienda menos el valor del campo derecho</i>".<br>
                <br>
                <strong>Ejemplo:</strong> Establece el valor en "<i>2</i>". Supone → Almacén tienda: 10 → Almacén MeinPaket: 8<br>
                <br>
                <strong>Nota:</strong> Si los artículos que están inactivos en la tienda, independientemente de las cantidades de stock utilizadas<br>
                también deseas tratarlos como stock "<i>0</i>" en el marketplace, procede de la siguiente manera:<br>
                <ul>
                <li>"<i>Sincronización del inventario</i>" > "<i>Cambio de existencias tienda</i>" ajustado a "<i>Sincronización automática mediante CronJob"</i></li>.
                <li>"<i>Configuración global" > "<i>Estado del producto</i>" > "<i>Si el estado del producto es inactivo, el stock se trata como 0" activar</i></li>
                </ul>';
MLI18n::gi()->{'mercadolivre_config_sync__legend__sync'} = 'Sincronización del inventario';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.canceled__label'} = 'Cancelar pedido con';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__custom'} = 'A medida';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.copy__help'} = 'La copia se enviará a la dirección de correo electrónico del remitente.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'mercadolivre_config_price__legend__price'} = 'Cálculo del precio';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.canceled__help'} = '                Establece aquí el estado de la tienda, que debería establecer automáticamente el estado "Cancelar pedido" en MercadoLivre. <br/><br/>
                Nota: La cancelación parcial no es posible aquí. Todo el pedido se cancela utilizando esta función
                y acreditado al comprador.';
MLI18n::gi()->{'mercadolivre_config_account_title'} = 'Datos de acceso';
MLI18n::gi()->{'mercadolivre_config_account__field__gettoken__help'} = 'Para obtener el token de autenticación haz clic en el botón Obtener token, introduce tus datos en la página de MercadoLivre y cuando se cierre la ventana haz clic en el botón Guardar de abajo.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__preimport.start__help'} = 'Hora de inicio a partir de la cual se importarán los pedidos por primera vez. Ten en cuenta que esto no es posible tan lejos en el pasado como desee, ya que los datos sólo están disponibles en MercadoLivre durante unas pocas semanas como máximo.';
MLI18n::gi()->{'mercadolivre_config_sync__field__inventorysync.price__help'} = '                <dl>
                    <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                    <dd>
                        Con la función "Sincronización automática", el precio almacenado en la tienda web se transmite al mercado {#setting:currentMarketplaceName#} (si está configurado en magnalister, con recargos o reducciones de precio). La sincronización tiene lugar cada 4 horas (punto de partida: 0:00 a.m.).<br />
                        Los valores de la base de datos se comprueban y adoptan, incluso si los cambios sólo se realizaron en la base de datos, por ejemplo, por un sistema de gestión de mercancías.<br />
                        <br />
                        Puedes iniciar una sincronización manual haciendo clic en el botón de función correspondiente "Sincronización de precios y existencias" en la esquina superior derecha del plugin magnalister.<br />
                        <br />
                        También puedes activar la sincronización de precios mediante su propio CronJob accediendo al siguiente enlace de su tienda:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Se bloquean las llamadas a CronJob personalizados por parte de clientes que no estén en la tarifa Flat o que se ejecuten con una frecuencia superior a cada cuarto de hora.<br />
                    </dd>
                </dl>
                <br />
                <strong>Nota:</strong> Se tienen en cuenta los ajustes en "Configuración" → "Cálculo de precios".
            ';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__auction'} = 'Subasta';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__mwst.fallback__hint'} = 'Tipo impositivo utilizado para los artículos que no son de la tienda para las importaciones de pedidos en %.';
MLI18n::gi()->{'mercadolivre_config_prepare__legend__prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.tomarketplace__label'} = 'Tienda de cambio de stock';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shippingmethod__label'} = 'Método de envío de los pedidos';
MLI18n::gi()->{'mercadolivre_config_price__field__price.signal__help'} = '                Este campo de texto se utilizará en el precio como decimal al enviar los datos a MercadoLivre.<br><br>
                <strong>Ejemplo:</strong><br>
                Valor en el campo de texto: 99<br>
                Origen del precio: 5,58<br>
                Resultado final: 5,99<br><br>
                Esta función es especialmente útil para aumentos/disminuciones porcentuales de precios.<br>
                Deja el campo vacío si no desea calcular un decimal.<br>
                El formato de entrada es un número entero con un máximo de 2 dígitos.
            ';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__label'} = 'Modo compra';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'mercadolivre_config_prepare__field__listingtype__label'} = 'Tipo de listado';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'mercadolivre_config_prepare__field__prepare.status__valuehint'} = 'aceptar sólo artículos activos';
MLI18n::gi()->{'mercadolivre_config_prepare__field__customshipping__keytitle'} = 'Texto de envío';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__new'} = 'Nuevo';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_content'} = '    <style>
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
    <p>Hola #FIRSTNAME# #LASTNAME#,</p>
    <p>¡Gracias por su pedido! Ha realizado el siguiente pedido a través de #MARKETPLACE# en nuestra tienda:</p>
    #ORDERSUMMARY#
    <p>Sin incluir los gastos de envío.</p>
    <p>Puede encontrar más ofertas interesantes en nuestra tienda en <strong>#SHOPURL#</strong>.</p>
    <p> </p>
    <p>Con un cordial saludo,</p>
    <p>Tu equipo de la tienda online</p>';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.shipped__help'} = 'Establece aquí el estado de la tienda, que debería establecer automáticamente el estado "Confirmar envío" en MercadoLivre.';
MLI18n::gi()->{'mercadolivre_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__customergroup__help'} = 'Grupo de clientes al que deben asignarse los clientes para nuevos pedidos.';
MLI18n::gi()->{'mercadolivre_config_account_price'} = 'Cálculo del precio';
MLI18n::gi()->{'mercadolivre_config_account_prepare'} = 'Preparación del artículo';
MLI18n::gi()->{'mercadolivre_config_account__field__gettoken__buttontext'} = 'Obtener token';
MLI18n::gi()->{'mercadolivre_config_prepare__legend__upload'} = 'Subir artículo: Configuración por defecto';
MLI18n::gi()->{'mercadolivre_config_price__field__price.signal__hint'} = 'Lugar decimal';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__me2'} = 'MercadoEnvios 2';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__not_specified'} = 'No especificado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__listingtype__help'} = 'El tipo de anuncio seleccionado se elegirá por defecto en el formulario de registro si está disponible.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__mwst.fallback__help'} = '
                Si el artículo no se puede encontrar en la tienda web, magnalister utilizará el tipo impositivo almacenado aquí, ya que los marketplaces no proporcionan ninguna información sobre el IVA al importar los pedidos.<br /> <br />
                <br />
                Más explicaciones:<br />
                En principio, magnalister se comporta de la misma manera que el propio sistema de la tienda a la hora de calcular el IVA para la importación de pedidos.<br />
                <br />
                Para que el IVA por país se tenga en cuenta automáticamente, el artículo adquirido debe encontrarse en la tienda web con su rango de números (SKU).
                A continuación, magnalister utiliza las clases de impuestos configuradas en la tienda web.
            ';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_subject'} = 'Tu pedido en #SHOPURL#';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.frommarketplace__help'} = '                Si, por ejemplo, un artículo ha sido comprado 3 veces en MercadoLivre, el stock de la tienda se reduce en 3.<br><br>
                <strong>Importante:</strong> ¡Esta función sólo funciona si has activado la importación de pedidos!
            ';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.tomarketplace__help'} = '                <dl>
                    <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                    <dd>
                        La función "Sincronización automática" ajusta el nivel de existencias actual {#setting:currentMarketplaceName#} al nivel de existencias de la tienda cada 4 horas (a partir de las 0:00 horas) (con deducción si es necesario, en función de la configuración).<br />
                        <br />
                        Los valores de la base de datos se comprueban y adoptan, incluso si los cambios solo se han realizado en la base de datos, por ejemplo, mediante un sistema de gestión de mercancías.<br />
                        <br />
                        Puedes iniciar la sincronización manual haciendo clic en el correspondiente botón de función "Sincronización de precios y existencias" en la esquina superior derecha del plugin magnalister.<br />
                        Además, también puedes activar la sincronización de existencias (desde Tarifa plana - máximo cada cuarto de hora) mediante tu propio CronJob llamando al siguiente enlace de su tienda:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Se bloquean las llamadas a CronJob personalizados de clientes que no estén en la tarifa plana o que se ejecuten con una frecuencia superior a cada cuarto de hora.<br />
                    </dd>
                </dl>
                <br />
                <strong>Nota:</strong> Se tienen en cuenta los ajustes de "Configuración" → "Preparación de artículos" → "Número de artículos en stock".
            ';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__help'} = 'La condición del artículo seleccionado se elegirá por defecto en el formulario de registro si está disponible.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__importactive__help'} = '                Deben importarse los pedidos del marketplace? <br/><br/>Si la función está activada,
                los pedidos se importan por defecto cada hora.<br><br>
				Puedes iniciar una importación manual haciendo clic en el botón de la función correspondiente en la cabecera de magnalister.
                (arriba a la derecha).<br><br>
				También puedes activar la importación de pedidos (desde Tarifa Flat - máximo cada cuarto de hora)
                con tu propio CronJob llamando al siguiente enlace de su tienda: <br>
    			<i>{#setting:sImportOrdersUrl#}</i><br><br>
    			Las llamadas a CronJob propios por parte de clientes que no estén en la tarifa Flat o que llamen a pedidos con una frecuencia superior a
                cada cuarto de hora están bloqueadas.
            ';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__mwst.fallback__label'} = 'IVA Artículo no comercial';
MLI18n::gi()->{'mercadolivre_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'mercadolivre_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'mercadolivre_config_account__legend__tabident'} = '';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__label'} = '';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmodeajax__label'} = '';
MLI18n::gi()->{'mercadolivre_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'mercadolivre_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__import__label'} = '';