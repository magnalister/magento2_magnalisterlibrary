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
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_matching'} = 'Vincula números de factura con el campo de texto libre';
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_magnalister'} = 'Crear números de factura a través de magnalister';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_webshop'} = '<li><p>Las facturas generadas en la tienda web se transmiten a {#setting:currentMarketplaceName#}</p>
 <p>Si tu sistema de tienda tiene la capacidad de crear facturas, todas las facturas se procesarán automáticamente en los 60 minutos siguientes a su carga en {#setting:currentMarketplaceName#}.</p></li>';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_erp'} = '<li><p>Las facturas generadas por sistemas de terceros (por ejemplo, sistema ERP) se transfieren a {#setting:currentMarketplaceName#}</p>
 <p>Las facturas que crees con tu sistema de terceros (por ejemplo, ERP) se pueden enviar a tu servidor de la tienda web y magnalister las puede recuperar y cargar en {#setting:currentMarketplaceName#}. Mas información tras seleccionar esta opción en el icono de informacion en «Ajustes para la transmisión de facturas de un sistema de terceros [...]».</p></li>';
MLI18n::gi()->{'formfields__importactive__label'} = 'Activar la importación';
MLI18n::gi()->{'formfields__importactive__help'} = '¿Deben importarse los pedidos de {#setting:currentMarketplaceName#}?<br />
            <br />
            Si la función está activada, las órdenes se importan cada hora por defecto.<br />
            <br />
            Puedes iniciar una importación manual haciendo clic en el botón de función correspondiente "Importar pedidos" en la esquina superior derecha del plugin magnalister.<br />';
MLI18n::gi()->{'formfields__preimport.start__label'} = 'Hora de inicio';
MLI18n::gi()->{'formfields__preimport.start__help'} = 'Hora de inicio a partir de la cual se importarán las órdenes por primera vez. Tenga en cuenta que esto no es posible tan lejos en el pasado como desee, ya que los datos en {#setting:currentMarketplaceName#} sólo están disponibles para unas pocas semanas como máximo.';
MLI18n::gi()->{'formfields__preimport.start__hint'} = 'Hora de inicio';
MLI18n::gi()->{'formfields__customergroup__label'} = 'Grupo de clientes';
MLI18n::gi()->{'formfields__customergroup__help'} = 'Grupo de clientes al que deben asignarse los clientes para los nuevos pedidos.';
MLI18n::gi()->{'formfields__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'formfields__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'formfields__orderstatus.open__label'} = 'Estado del pedido en la tienda';
MLI18n::gi()->{'formfields__orderstatus.open__help'} = 'El estado que un nuevo pedido recibido de {#setting:currentMarketplaceName#} debe recibir automáticamente en la tienda.<br />
            Si utilice un sistema de reclamación conectado, se recomienda establecer el estado del pedido en "Pagado" (Configuración → Estado del pedido)."';
MLI18n::gi()->{'formfields__mwst.fallback__label'} = 'IVA de artículo extranjero';
MLI18n::gi()->{'formfields__mwst.fallback__help'} = 'Si el número de artículo de una compra no se reconoce en la tienda web durante la importación del pedido, no se podrá calcular el IVA.<br />
            Como solución, el valor especificado aquí se almacena como porcentaje para todos los productos cuyo tipo de IVA se desconoce al importar pedidos de {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'formfields__mwst.fallback__hint'} = 'Tipo impositivo utilizado para los artículos que no son de la tienda para la importación de pedidos en %.';
MLI18n::gi()->{'formfields__orderstatus.sync__label'} = 'Estado de la sincronización';
MLI18n::gi()->{'formfields__orderstatus.sync__help'} = '<dl>
                <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                <dd>
                    La función "Sincronización automática mediante CronJob" transmite el estado actual de los envíos a {#setting:currentMarketplaceName#} cada 2 horas.<br/>';
MLI18n::gi()->{'formfields__orderstatus.shipped__label'} = 'Confirma el envío con';
MLI18n::gi()->{'formfields__orderstatus.shipped__help'} = 'Establezca aquí el estado de la tienda, que debería establecer automáticamente el estado en "Enviado" en {#setting:currentMarketplaceName#}."';
MLI18n::gi()->{'formfields__orderstatus.canceled__label'} = 'Cancelar pedido con';
MLI18n::gi()->{'formfields__orderstatus.canceled__help'} = 'Seleccione aquí el estado de la tienda que debe transmitir automáticamente el estado "Pedido cancelado" a {#setting:currentMarketplaceName#}.<br />
            <br />
            <strong>Nota:</strong> No es posible realizar anulaciones parciales. Con esta función se cancela todo el pedido.';
MLI18n::gi()->{'formfields__config_uploadInvoiceOption__label'} = 'Opciones de transmisión de facturas';
MLI18n::gi()->{'formfields__config_uploadInvoiceOption__help'} = '<p>Aquí puede elegir si desea enviar sus facturas a {#setting:currentMarketplaceName#} y cómo hacerlo. Puede elegir entre las siguientes
    opciones:</p>

<ol>
    <li>
        <p>No envíes facturas a {#setting:currentMarketplaceName#}.</p>
        <p>Si seleccionas esta opción, tus facturas no se enviarán a {#setting:currentMarketplaceName#}. Medios: Organiza la
            provisión de facturas por tu cuenta.</p>
    </li>
    
    {#i18n:formfields_config_uploadInvoiceOption_help_webshop#}
    {#i18n:formfields_config_uploadInvoiceOption_help_erp#}

    <li><p>magnalister debe hacerse cargo de la creación de la factura y transmitirla a {#setting:currentMarketplaceName#}.</p>

        <p>Selecciona esta opción si deseas que magnalister cree y envíe facturas por ti.
            Para ello, rellena los campos del apartado "Datos para la generación de facturas por magnalister". La transferencia
            se realiza
            cada 60 minutos.</p>
    </li>
</ol>';
MLI18n::gi()->{'formfields_uploadInvoiceOption_values__off'} = 'No enviar facturas a {#setting:currentMarketplaceName#}';
MLI18n::gi()->{'formfields_uploadInvoiceOption_values__webshop'} = 'Las facturas creadas en la tienda online se envían a {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'formfields_uploadInvoiceOption_values__erp'} = 'Las facturas creadas en el sistema de terceros (por ejemplo, ERP) se transmiten a {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'formfields_uploadInvoiceOption_values__magna'} = 'La creación y transmisión de facturas se realiza mediante magnalister';
MLI18n::gi()->{'formfields__config_invoice_invoiceDir__label'} = 'Facturas transmitidas';
MLI18n::gi()->{'formfields__config_invoice_invoiceDir__buttontext'} = 'Visualización';
MLI18n::gi()->{'formfields__config_invoice_mailCopy__label'} = 'Copia de la factura a';
MLI18n::gi()->{'formfields__config_invoice_mailCopy__help'} = 'Introduce aquí tu dirección de correo electrónico para recibir una copia de la factura cargada.';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumberPrefix__label'} = 'Prefijo del número de factura';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumberPrefix__hint'} = 'Si introduce un prefijo aquí, se colocará delante del número de factura. Ejemplo: R10000. Las facturas generadas por magnalister comienzan con el número 10000.';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumberPrefix__default'} = 'R';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumberPrefix__label'} = 'Prefijo factura de anulación';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumberPrefix__hint'} = 'Si introduce un prefijo aquí, se colocará delante del número de factura de anulación. Ejemplo: S20000. Las facturas de anulación generadas por magnalister comienzan con el número 20000.';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumberPrefix__default'} = 'S';
MLI18n::gi()->{'formfields__config_invoice_companyAddressLeft__label'} = 'Campo con la dirección de la empresa (izquierda)';
MLI18n::gi()->{'formfields__config_invoice_companyAddressLeft__default'} = 'Tu nombre, Calle 1, 12345 Tu ciudad';
MLI18n::gi()->{'formfields__config_invoice_companyAddressRight__label'} = 'Bloque de información de la dirección (derecha)';
MLI18n::gi()->{'formfields__config_invoice_companyAddressRight__default'} = 'Tu nombre
Tu calle 1

12345 Tu ciudad';
MLI18n::gi()->{'formfields__config_invoice_headline__label'} = 'Encabezado Factura';
MLI18n::gi()->{'formfields__config_invoice_headline__default'} = 'Tu factura';
MLI18n::gi()->{'formfields__config_invoice_invoiceHintHeadline__label'} = 'Encabezado Información de la factura';
MLI18n::gi()->{'formfields__config_invoice_invoiceHintHeadline__default'} = 'Nota de la factura';
MLI18n::gi()->{'formfields__config_invoice_invoiceHintText__label'} = 'Texto de la nota';
MLI18n::gi()->{'formfields__config_invoice_invoiceHintText__hint'} = 'Déjalo en blanco si no va a aparecer ningún texto de nota en la factura';
MLI18n::gi()->{'formfields__config_invoice_invoiceHintText__default'} = 'Texto de la nota para la factura';
MLI18n::gi()->{'formfields__config_invoice_footerCell1__label'} = 'Pie de página columna 1';
MLI18n::gi()->{'formfields__config_invoice_footerCell1__default'} = 'Tu nombre
Tu calle 1

12345 Tu ciudad';
MLI18n::gi()->{'formfields__config_invoice_footerCell2__label'} = 'Columna 2 a pie de página';
MLI18n::gi()->{'formfields__config_invoice_footerCell2__default'} = 'Tu número de teléfono
Tu número de fax
Tu página de inicio
Tu dirección de correo electrónico';
MLI18n::gi()->{'formfields__config_invoice_footerCell3__label'} = 'Pie de página columna 3';
MLI18n::gi()->{'formfields__config_invoice_footerCell3__default'} = 'Tu número de identificación fiscal
Tu NIF
Tu jurisdicción
Tus datos personales';
MLI18n::gi()->{'formfields__config_invoice_footerCell4__label'} = 'Columna 4 a pie de página';
MLI18n::gi()->{'formfields__config_invoice_footerCell4__default'} = 'Información
adicional en
la cuarta
columna';
MLI18n::gi()->{'formfields__config_invoice_preview__label'} = 'Vista previa de la factura';
MLI18n::gi()->{'formfields__config_invoice_preview__buttontext'} = 'Vista previa';
MLI18n::gi()->{'formfields__erpInvoiceSource__label'} = 'Carpeta de origen de las facturas (ruta del servidor)';
MLI18n::gi()->{'formfields__erpInvoiceSource__help'} = '<p>Selecciona aquí la ruta del servidor a la carpeta donde cargar las facturas de su sistema de terceros (por ejemplo, ERP) como PDF.</p>

<p>
    <b>Nota importante:</b> <br>
<p>Para que magnalister pueda asignar una factura PDF a un pedido de una tienda, los archivos PDF deben denominarse según uno de los dos patrones siguientes:</p>
<ol>
    <li><p>Nomenclatura según el pedido de la tienda</p>

        <p>Patrón: #numerar-el-pedido#.pdf</p>

        <p>Ejemplo: <br>
            Número de pedido: 12345678<br>
            El PDF de la factura debe ser: 12345678.pdf</p>
    </li>
    <li>
        <p>Nomenclatura según el pedido de tienda + número de factura del sistema ERP</p>

        <p>Patrón: #numero-de-pedido-de-tienda#_#numero-de-factura#.pdf</p>

        <p>Ejemplo:<br>
            Número de pedido: 12345678<br>
            Número de factura del ERP: 9876543<br>
            El PDF de la factura debe ser: 12345678_9876543.pdf</p>
    </li>
</ol>
</p>';
MLI18n::gi()->{'formfields__erpInvoiceSource__buttontext'} = '{#i18n:form_text_choose#}';
MLI18n::gi()->{'formfields__erpInvoiceDestination__label'} = 'Carpeta de destino para las facturas enviadas a {#setting:currentMarketplaceName#} (ruta del servidor)';
MLI18n::gi()->{'formfields__erpInvoiceDestination__help'} = '<p>Después de que magnalister haya subido una factura desde la carpeta de origen a {#setting:currentMarketplaceName#}, se moverá a la carpeta de destino. Esto te permite hacer un seguimiento de las facturas que ya han sido enviadas a {#setting:currentMarketplaceName#}..</p>

<p>Seleccione la ruta del servidor a la carpeta de destino a la que se moverán las facturas cargadas en {#setting:currentMarketplaceName#}.</p>

<p><b>Nota importante:</b> Si no seleccione una carpeta de destino diferente para las facturas cargadas en {#setting:currentMarketplaceName#}, no podrá ver qué facturas se han cargado ya en {#setting:currentMarketplaceName#}.</p>';
MLI18n::gi()->{'formfields__erpInvoiceDestination__buttontext'} = '{#i18n:form_text_choose#}';
MLI18n::gi()->{'formfields__erpReversalInvoiceSource__label'} = 'Carpeta de origen de los abonos (ruta del servidor)';
MLI18n::gi()->{'formfields__erpReversalInvoiceSource__help'} = '&apos;<p>Seleccione aquí la ruta del servidor a la carpeta donde se guardan las notas de crédito de su sistema de terceros (por ejemplo, ERP) en formato PDF.</p>

<p>
    <b>Aviso importante:</b> <br>
<p>Para que magnalister asigne un crédito PDF a un pedido de una tienda, los archivos PDF deben tener uno de los dos nombres siguientes:</p>
<ol>
    <li><p>Nomenclatura según el pedido de la tienda</p>

        <p>Muestra: #numerar-el-pedido#.pdf</p>

        <p>Ejemplo: <br>
            Número de pedido: 12345678<br>
            Nota de crédito PDF debe decir: 12345678.pdf</p>
    </li>
    <li>
        <p>Nomenclatura según el pedido de la tienda + número de la nota de crédito del sistema ERP</p>

        <p>Ejemplo: #numero-de-pedido#_#numero-de-crédito#.pdf</p>

        <p>Ejemplo:<br>
            Número de pedido de la tienda: 12345678<br>
            Número de la nota de crédito de ERP: 9876543<br>
            El PDF de la nota de crédito debe leerse: 12345678_9876543.pdf</p>
    </li>
</ol>
</p>';
MLI18n::gi()->{'formfields__erpReversalInvoiceSource__buttontext'} = '{#i18n:form_text_choose#}';
MLI18n::gi()->{'formfields__erpReversalInvoiceDestination__label'} = 'Carpeta de destino para los créditos enviados a {#setting:currentMarketplaceName#} (ruta del servidor)';
MLI18n::gi()->{'formfields__erpReversalInvoiceDestination__help'} = '<p>Después de que magnalister haya subido una nota de crédito de la carpeta de origen a {#setting:currentMarketplaceName#}, se moverá a la carpeta de destino. Esto te permite realizar un seguimiento de los créditos que ya se han enviado a {#setting:currentMarketplaceName#}.</p>

<p>Selecciona aquí la ruta del servidor a la carpeta de destino donde se moverán los créditos cargados en {#setting:currentMarketplaceName#}.</p>

<p><b>Nota importante:</b> Si no seleccionas una carpeta de destino diferente para los créditos cargados en {#setting:currentMarketplaceName#}, no podrás ver qué créditos se han cargado ya en {#setting:currentMarketplaceName#}..</p>';
MLI18n::gi()->{'formfields__erpReversalInvoiceDestination__buttontext'} = '{#i18n:form_text_choose#}';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_webshop'} = '<li><p>Las facturas creadas en la tienda online se transmiten a {#setting:currentMarketplaceName#}.</p>

    <p>Si tu sistema de tienda tiene la opción de crear facturas, éstas se cargan automáticamente en {#setting:currentMarketplaceName#} cada 60 minutos.</p></li>';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_erp'} = '<li><p>Las facturas creadas por sistemas de terceros (por ejemplo, un sistema ERP) se transmiten a {#setting:currentMarketplaceName#}.</p>

            <p>Las facturas que cree con su sistema de terceros (por ejemplo, ERP) pueden cargarse en el servidor de su tienda virtual, ser recuperadas por magnalister y cargarse en {#setting:currentMarketplaceName#}. Aparecerá más información después de seleccionar esta opción en el icono de información en "Ajustes para la transmisión de facturas generadas desde un sistema de terceros [...]".</p></li>';

MLI18n::gi()->{'formfields__mail.originator.name__default'} = 'Ejemplo de tienda';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumber__help'} = '<p>
Selecciona aquí si deseas que magnalister genere sus números de factura o si deben tomarse de un {#i18n:shop_order_attribute_name#}.
</p><p>
<b>Generar números de factura a través de magnalister</b>
</p><p>
magnalister genera números de factura consecutivos al crear facturas. Se puede definir un prefijo que se coloca delante del número de factura. Ejemplo: R10000.
</p><p>
Nota: Las facturas creadas por magnalister comienzan con el número 10000.
</p><p>
<b>Comparar números de factura con {#i18n:shop_order_attribute_name#}</b>
</p><p>
Cuando se crea la factura, se adopta el valor del {#i18n:shop_order_attribute_name#} seleccionado.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Importante:</b><br/> magnalister genera y transmite la factura en cuanto el pedido se marca como enviado. Por favor, asegúrate de que el campo de texto libre se rellena en este momento, de lo contrario se generará un error (salida en la pestaña "Registro de errores").
<br/><br/>
Si utilizas el matching de campos de texto libre, magnalister no se hace responsable de la creación correcta y consecutiva de los números de factura.
</p>';
MLI18n::gi()->{'formfields__price.signal__help'} = '
                Este campo de texto se toma como decimal en su precio cuando envía los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Origen del precio: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                Esta función es especialmente útil para aumentos/disminuciones porcentuales de precios.<br />
                Deje el campo vacío si no desea calcular un decimal.<br />
                El formato de entrada es un número entero con un máximo de 2 dígitos.
            ';
MLI18n::gi()->{'formfields__checkin.status__help'} = 'Puedes configurar los artículos como activos o inactivos en la tienda web. Dependiendo de la configuración aquí, solo se mostrarán los artículos activos al cargar productos.';
MLI18n::gi()->{'formfields__mail.send__label'} = '¿Enviar un correo electrónico?';
MLI18n::gi()->{'formfields__prepare.status__label'} = '{#i18n:formfields__checkin.status__label#}';
MLI18n::gi()->{'formfields__inventorysync.price__label'} = 'Precio del artículo';
MLI18n::gi()->{'formfields__quantity__help'} = '            Especifica aquí la cantidad de existencias de un artículo que debe estar disponible en {#setting:currentMarketplaceName#}.<br />
            <br />
            Para evitar la sobreventa, puedes introducir el valor<br />
            "Transferir existencias de la tienda menos el valor del campo de la derecha".<br />
            <br />
            <strong>Ejemplo:</strong> Establece el valor en "2". El resultado es → Stock de la tienda: 10 → stock de {#setting:currentMarketplaceName#}: 8<br />
            <br />
            Nota: Si deseas tratar los artículos que están configurados como inactivos en la tienda como stock "0" en el marketplace, independientemente de las cantidades de stock utilizadas, procede de la siguiente manera:<br />
            <br />
            <ul>
                <li>"Sincronización del inventario" > "Cambio de stock tienda" establecido en "sincronización automática a través de CronJob"</li>.
                <li>"Configuración global" > "Estado del producto" > "Si el estado del producto es inactivo, el stock se trata como 0" </li> <li>"Estado del producto" > "Si el estado del producto es inactivo, el stock se trata como 0".
            </ul>
        ';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumberMatching__label'} = 'Campos de texto libre del pedido Shopware';
MLI18n::gi()->{'formfields__checkin.status__valuehint'} = 'sólo aceptar artículos activos';
MLI18n::gi()->{'formfields__stocksync.frommarketplace__label'} = 'Orden importar de {#setting:currentMarketplaceName#}';
MLI18n::gi()->{'formfields__config_invoice_preview__hint'} = 'Aquí puede visualizar una vista previa de su factura con los datos que ha introducido.';
MLI18n::gi()->{'formfields__quantity__label'} = 'Stock';
MLI18n::gi()->{'formfields__priceoptions__label'} = 'Precio de venta del grupo de clientes';
MLI18n::gi()->{'formfields__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'formfields__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'formfields__mail.send__help'} = '¿Debería enviarse un correo electrónico desde su tienda al comprador para promocionar su tienda?';
MLI18n::gi()->{'formfields__orderimport.shippingmethod__label'} = 'Método de envío de los pedidos';
MLI18n::gi()->{'formfields__checkin.status__label'} = 'Filtro de estado';
MLI18n::gi()->{'formfields__orderstatus.carrier.default__label'} = 'Transportista';
MLI18n::gi()->{'formfields__stocksync.frommarketplace__help'} = '            Por ejemplo, si un artículo se ha comprado 3 veces en {#setting:currentMarketplaceName#}, las existencias de la tienda se reducen en 3.<br />
            <br />
            <strong>Importante:</strong> Esta función sólo funciona si has activado la importación de pedidos.';
MLI18n::gi()->{'formfields__orderimport.paymentmethod__help'} = '            Forma de pago que se asigna a todos los pedidos de {#setting:currentMarketplaceName#}. Estándar: "{#i18n:marketplace_configuration_orderimport_payment_method_from_marketplace#}".<br /><br />
            Esta configuración es importante para la impresión de facturas y albaranes y para el posterior tratamiento del pedido en la tienda y en algunos sistemas de gestión de mercancías.';
MLI18n::gi()->{'formfields__price__help'} = 'Introduce un porcentaje o precio fijo de recargo o rebaja. Descuento con un signo menos delante.';
MLI18n::gi()->{'formfields__mail.originator.name__label'} = 'Nombre del remitente';
MLI18n::gi()->{'formfields__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'formfields__price.usespecialoffer__label'} = 'utilizar también precios especiales';
MLI18n::gi()->{'formfields__price__label'} = 'Precio';
MLI18n::gi()->{'formfields__prepare.status__valuehint'} = '{#i18n:formfields__checkin.status__valuehint#}';
MLI18n::gi()->{'formfields__mail.subject__label'} = 'Asunto';
MLI18n::gi()->{'formfields__mail.copy__help'} = 'La copia se enviará a la dirección de correo electrónico del remitente.';
MLI18n::gi()->{'formfields__mail.content__label'} = 'Contenido del correo electrónico';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumber__label'} = 'Número de factura de anulación';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumberPrefixValue__label'} = 'Prefijo del número de factura';
MLI18n::gi()->{'formfields__exchangerate_update__valuehint'} = 'Actualizar automáticamente el tipo de cambio';
MLI18n::gi()->{'formfields__maxquantity__help'} = '       Aquí puedes limitar el número de artículos colocados en {#setting:currentMarketplaceName#}.
            <strong>Ejemplo:</strong> En "Cantidad" selecciona "Adoptar stock de la tienda" e introduce 20 unidades. A continuación, al cargar, establece tantas piezas como haya disponibles en la tienda, pero no más de 20. La sincronización del almacén (si está activada) ajusta la cantidad a de piezas de {#setting:currentMarketplaceName#} al stock de la tienda siempre que el stock de la tienda sea inferior a 20 piezas. Si hay más de 20 piezas en stock en la tienda, la cantidad se ajusta a 20.<br /><br />
            Deja este campo vacío o introduce 0 si no deseas un límite.
            <strong>Nota:</strong> si la configuración de "Cantidad" es "Tarifa plana (del campo de la derecha)", el límite no tiene efecto.';
MLI18n::gi()->{'formfields__exchangerate_update__label'} = 'Tipo de cambio';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumberMatching__label'} = 'Campos de texto libre del pedido Shopware';
MLI18n::gi()->{'formfields__inventorysync.price__help'} = '            <dl>
                <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                <dd>
                    Con la función "Sincronización automática", el precio almacenado en la tienda web se transmite al marketplace {#setting:currentMarketplaceName#} (si está configurado en magnalister, con recargos o reducciones de precio). La sincronización tiene lugar cada 4 horas (punto de partida: 0:00 horas).
                    Los valores de la base de datos se comprueban y adoptan, incluso si los cambios sólo se realizaron en la base de datos, por ejemplo, por un sistema de gestión de mercancías.<br />
                    <br />
                    Puede iniciar una sincronización manual haciendo clic en el botón de función correspondiente "Sincronización de precios y existencias" en la esquina superior derecha del plugin magnalister.<br />
                    <br />
                    También puede activar la sincronización de precios mediante su propio CronJob accediendo al siguiente enlace de su tienda:<br />
                    <i>{#setting:sSyncInventoryUrl#}</i><br />
                    Se bloquean las llamadas a CronJob personalizados por parte de clientes que no estén en la tarifa plana o que se ejecuten con una frecuencia superior a cada cuarto de hora.<br />
                </dd>
            </dl>
            <br />
            <strong>Nota:</strong> Se tienen en cuenta los ajustes en "Configuración" → "Cálculo de precios".
        ';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumber__help'} = '<p>
Selecciona aquí si deseas que magnalister genere su número de factura de anulación o si debe tomarse de un {#i18n:shop_order_attribute_name#}.
</p><p>
<b>Generar número de factura de anulación a través de magnalister</b>
</p><p>
magnalister genera números de factura de anulación consecutivos cuando se crea la factura. Se puede definir un prefijo que se coloca delante del número de factura. Ejemplo: R10000.
</p><p>
Nota: Las facturas creadas por magnalister comienzan con el número 10000.
</p><p>
<b>Coincidir número de factura de anulación con {#i18n:shop_order_attribute_name#}</b>
</p><p>
Cuando se crea la factura, se transfiere el valor del {#i18n:shop_order_attribute_name#} seleccionado.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Importante:</b><br/> magnalister genera y transmite la factura en cuanto el pedido se marca como enviado. Por favor, asegúrate de que el campo de texto libre se rellena en este momento, de lo contrario se generará un error (salida en la pestaña "Registro de errores").
<br/><br/>
Si utilizas la coincidencia de campos de texto libre, magnalister no se hace responsable de la creación correcta y consecutiva de números de factura de anulación.
</p>';
MLI18n::gi()->{'formfields__orderimport.shippingmethod__help'} = '
            Método de envío que se asigna a todos los pedidos {#setting:currentMarketplaceName#}. Por defecto: "{#setting:currentMarketplaceName#}".<br>
            <br>
            Este ajuste es importante para la impresión de facturas y albaranes y para el posterior procesamiento del pedido en la tienda y en algunos sistemas de gestión de mercancías.
        ';
MLI18n::gi()->{'formfields__mail.content__default'} = '<style><!--
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
<p>Hola #FIRSTNAME# #LASTNAME#,</p>
<p>¡Gracias por su pedido! Ha realizado el siguiente pedido a través de #MARKETPLACE# en nuestra tienda:</p>
#ORDERSUMMARY#
<p>Además de los posibles gastos de envío.</p>
<p> </p>
<p>Con un cordial saludo,</p>
<p>Tu equipo de la tienda online</p>';
MLI18n::gi()->{'formfields__orderimport.paymentmethod__label'} = 'Forma de pago de los pedidos';
MLI18n::gi()->{'formfields__mail.originator.adress__default'} = 'ejemplo@tiendaonline.com';
MLI18n::gi()->{'formfields__mail.subject__default'} = 'Su pedido en #SHOPURL#';
MLI18n::gi()->{'formfields__mail.originator.adress__label'} = 'Dirección de correo electrónico del remitente';
MLI18n::gi()->{'formfields__mail.content__hint'} = '            Lista de marcadores de posición disponibles para asunto y contenido:
            <dl>
                <dt>#MARKETPLACEORDERID#</dt>
                <dd>Número de pedido del marketplace</dd>
                <dt>#FIRSTNAME#</dt>
                <dd>Nombre del comprador</dd>
                <dt>#LASTNAME#</dt>
                <dd>Apellido del comprador</dd>
                <dt>#EMAIL#</dt>
                <dd>Dirección de correo electrónico del comprador</dd>
                <dt>#PASSWORD#</dt>
                <dd>Contraseña del cliente para iniciar sesión en su tienda. Sólo para los clientes que se crean automáticamente, de lo contrario el marcador de posición se sustituye por \'(guardado)\'.</dd>
                <dt>#ORDERSUMMARY#</dt>
                <dd>
                    Resumen de los artículos comprados. Debe estar en una línea separada.<br>
                    <i>No se puede utilizar en la línea de asunto</i>
                </dd>
                <dt>#MARKETPLACE#</dt>
                <d>Nombre de este marketplace</dd>
                <dt>#SHOPURL#</dt>
                <dd>URL de su tienda</dd>
                <dt>#ORIGINATOR#</dt>
                <dd>Nombre del remitente</dd>
            </dl>
        ';
MLI18n::gi()->{'formfields__lang__label'} = 'Descripción del artículo';
MLI18n::gi()->{'formfields__price.signal__label'} = 'Lugar decimal';
MLI18n::gi()->{'formfields__orderstatus.carrier.default__help'} = 'Transportista preseleccionado al confirmar el envío a {#setting:currentMarketplaceName#}.';
MLI18n::gi()->{'formfields__prepare.status__help'} = 'Puedes configurar los artículos como activos o inactivos en la tienda web. En función de la configuración realizada aquí, al preparar los productos solo se mostrarán los artículos activos.';
MLI18n::gi()->{'formfields__mail.copy__label'} = 'Copia al remitente';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumber__label'} = 'Número de factura';
MLI18n::gi()->{'formfields__maxquantity__label'} = 'Límite de cantidad';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumberPrefixValue__label'} = 'Prefijo del número de factura';
MLI18n::gi()->{'formfields__stocksync.tomarketplace__help'} = '            <dl>
                <dt>Sincronización automática mediante CronJob (recomendado)</dt>
                <dd>
                    La función "Sincronización automática" ajusta el nivel de existencias actual de {#setting:currentMarketplaceName#} al nivel de existencias de la tienda cada 4 horas (a partir de las 0:00 horas) con deducción si es necesario, en función de la configuración.<br />
                    <br />
                    Los valores de la base de datos se comprueban y adoptan, incluso si los cambios sólo se han realizado en la base de datos, por ejemplo, mediante un sistema de gestión de mercancías.<br />
                    <br />
                    Puede iniciar una sincronización manual haciendo clic en el botón de función correspondiente "Sincronización de precios y existencias" en la esquina superior derecha del plugin magnalister.<br />
                    Además, también puede activar la sincronización de existencias (desde Tarifa plana - máximo cada cuarto de hora) mediante su propio CronJob llamando al siguiente enlace de su tienda:<br />
                    <i>{#setting:sSyncInventoryUrl#}</i><br />
                    Se bloquean las llamadas a CronJob propios de clientes que no estén en la tarifa Plana o que se ejecuten con una frecuencia superior a cada cuarto de hora.<br />
                </dd>
            </dl>
            <br />
            <strong>Nota:</strong> Se tienen en cuenta los ajustes en "Configuración" → "Preparación de artículos" → "Número de artículos en stock".';
MLI18n::gi()->{'formfields__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'formfields__stocksync.tomarketplace__label'} = 'Cambio de existencias de la tienda';
MLI18n::gi()->{'formfields__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'formfields__config_invoice_invoiceNumberOption__label'} = '';
MLI18n::gi()->{'formfields__price.addkind__label'} = '';
MLI18n::gi()->{'formfields__erpInvoiceDestination__hint'} = '';
MLI18n::gi()->{'formfields__erpReversalInvoiceSource__hint'} = '';
MLI18n::gi()->{'formfields__erpInvoiceSource__hint'} = '';
MLI18n::gi()->{'formfields__erpReversalInvoiceDestination__hint'} = '';
MLI18n::gi()->{'formfields__config_invoice_reversalInvoiceNumberOption__label'} = '';
MLI18n::gi()->{'formfields__price.factor__label'} = '';