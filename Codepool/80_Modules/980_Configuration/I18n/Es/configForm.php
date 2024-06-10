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

MLI18n::gi()->add('configuration', array(
    'legend' => array(
        'general' => 'Configuración general',
        'sku' => 'Rangos de números de sincronización',
        'stats' => 'Estadísticas',
        'orderimport' => 'Pedidos',
        'crontimetable' => 'Otros',
        'articlestatusinventory' => 'Inventario',
        'productfields' => 'Características del producto',
    ),
    'field' => array(
        'general.passphrase' => array(
            'label' => 'PassPhrase',
            'help' => 'Recibirá la PassPhrase después de registrarse en www.magnalister.com.',
        ),
        'general.keytype' => array(
            'label'  => 'Seleccione una opción',
            'help'   => 'Dependiendo de la selección, el número de artículo de la tienda se utiliza como SKU en el mercado o el ID de producto de la tienda se utiliza como SKU del mercado para poder asignar el producto durante la sincronización del almacén y la importación de pedidos.<br/><br/>
                         Esta función tiene un efecto significativo en el procesamiento posterior a través de un a través de un sistema de gestión de mercancías, así como en la conciliación de los inventarios de la tienda y del mercado.<br /><br />
                         <strong>Atención.</strong> La sincronización de cantidades de stock y precios depende de esta configuración. Si ya ha cargado artículos, <strong>no debe modificar este ajuste</strong>, ya que de lo contrario los artículos "antiguos" ya no se podrán sincronizar.',
            'values' => array(
                'pID'   => 'ID de producto (tienda) = SKU (mercado)<br>',
                'artNr' => 'Número de artículo (tienda) = SKU (mercado)'
            ),
            'alert'  => array(
                'pID'   => '{#i18n:sChangeKeyAlert#}',
                'artNr' => '{#i18n:sChangeKeyAlert#}'
            ),
        ),
        'general.stats.backwards' => array(
            'label' => 'Meses anteriores',
            'help' => '¿A cuántos meses deben remontarse las estadísticas?',
            'values' => array(
                '0' => '1 mes',
                '1' => '2 meses',
                '2' => '3 meses',
                '3' => '4 meses',
                '4' => '5 meses',
                '5' => '6 meses',
                '6' => '7 meses',
                '7' => '8 meses',
                '8' => '9 meses',
                '9' => '10 meses',
                '10' => '11 meses',
                '11' => '12 meses',
                '12' => '13 meses',
                '13' => '14 meses',
            ),
        ),
        'general.order.information' => array(
            'label' => 'Información para pedidos',
            'valuehint' => 'Guarde el número de pedido del comprador, el nombre del mercado y el mensaje del pedido (si está disponible) en el comentario del cliente.',
            'help' => 'Si activa la función, el número de pedido del mercado, el nombre del mercado y, si se transmite, el mensaje del comprador se guardarán en el comentario del cliente tras la importación del pedido.<br />
                En muchos sistemas, el comentario del cliente puede incluirse en la factura para que el cliente final reciba automáticamente información sobre la procedencia original del pedido.<br />
                También puede utilizarlo para programar extensiones para posteriores evaluaciones estadísticas de ventas.<br />
                <b>Importante:</b> Algunos sistemas de gestión de mercancías no importan los pedidos para los que se ha configurado el comentario del cliente. Para más información, póngase en contacto directamente con su proveedor de gestión de mercancías.',
        ),
        'general.editor'                                  => array(
            'label' => 'Editor',
            'help' => 'Editor de descripciones de artículos, plantillas y correos electrónicos a compradores.<br /><br />
                                <strong>TinyMCE Editor:</strong><br />Utilice un editor cómodo que muestre HTML ya formateado y corrija automáticamente las rutas de las imágenes en la descripción del artículo, por ejemplo.<br /><br />
                                <strong>Campo de texto simple, ampliar enlaces locales:</strong><br />Utiliza un simple campo de texto. Útil en casos en los que el editor TinyMCE provoca cambios no deseados en las plantillas introducidas (por ejemplo, en la plantilla de productos de eBay).<br />
                                Sin embargo, las imágenes o enlaces cuyas direcciones no empiecen por <strong>http://</strong>, <strong>javascript:</strong>, <strong>mailto:</strong> o <strong>#</strong> se amplían con la dirección de la tienda.<br /><br />
                                <strong>Campo de texto simple, acepta datos directamente:</strong><br />No se amplían las direcciones ni se realizan otros cambios en el texto introducido.',
            'values' => array(
                'tinyMCE' => 'TinyMCE Editor<br>',
                'none' => 'Campo de texto simple, ampliar enlaces locales<br />',
                'none_none' => 'Campo de texto simple, acepta datos directamente'
            ),
        ),
        'general.cronfronturl'                            => array(
            'label' => 'Base CRON Url',
            'help'  => 'Esta URL se calcula automáticamente a partir de los ajustes del sistema de la tienda y se llama para realizar la sincronización del inventario, la importación de pedidos y otras sincronizaciones de los servidores de magnalister. Sólo si no se puede acceder a la URL actual, puede cambiar la URL aquí. Para restablecer la URL original, borre la entrada y guarde la configuración.',
        ),
        'general.inventar.productstatus'                  => array(
            'label'  => 'Estado del producto',
            'help'   => 'Puede utilizar esta función para determinar si los artículos que están configurados como "<i>Inactivo</i>" en la tienda Web también han finalizado en el mercado (eBay),<br />
                                                        o también se establecen como "inactivos" (otros).<br /
>
<br />
                                                        Para que esta función surta efecto, actívela también en el módulo correspondiente del mercado en<br/>
                                                        "<i>Sincronización del inventario</i>" > "<i>Cambio de existencias tienda</i>" >
                                                        "<i>Sincronización automática mediante CronJob</i>".<br/>',
            'values' => array(
                'true'  => 'Si el estado del producto es inactivo, el stock se trata como 0<br>',
                'false' => 'Utilice siempre las existencias actuales',
            ),
        ),
        'general.manufacturer'                            => array(
            'label' => 'Fabricante',
            'help' => 'Seleccione aquí el atributo del producto / campo de texto libre en el que se almacena el nombre del fabricante del producto.
            Puede definir los atributos / campos de texto libre directamente en la administración de su tienda web.',
        ),
        'general.manufacturerpartnumber'                  => array(
            'label' => 'Número de modelo del fabricante',
            'help' => 'Seleccione aquí la propiedad del artículo / campo de texto libre en el que se almacena el número de modelo del fabricante del producto.
                Defina las propiedades del artículo / campos de texto libre directamente a través de la administración de su tienda web.',
        ),
        'general.ean' => array(
            'label' => 'EAN',
            'help' => 'European Article Number<br/><br/>
                                                   <b>Nota:</b> Estos datos no se comprueban. Si son incorrectos, se producirán errores en la base de datos.',
        ),
        'general.upc' => array(
            'label' => 'UPC',
            'help' => 'Universal Product Code<br/><br/>
                                                   <b>Nota:</b> Estos datos no se comprueban. Si son incorrectos, se producirán errores en la base de datos.',
        ),
    ),
));
