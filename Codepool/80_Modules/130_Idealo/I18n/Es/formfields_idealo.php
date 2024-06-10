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

// example for overwriting global element
MLI18n::gi()->add('formfields__quantity', array('help' => 'As stock {#setting:currentMarketplaceName#} supports only "available" or "not available".<br />Here you can define how the threshold for available items.'));

MLI18n::gi()->add('formfields_idealo', array(
    'shippingcountry' => array(
        'label' => 'Shipping to',
    ),
    'shippingmethodandcost' => array(
        'label' => 'Shipping Cost',
        'help' => 'Please specify the default shipping costs here. You can then adjust the values for the chosen items in the item preparation form.',
    ),
    'shippingcostmethod' => array(
        'values' => array(
            '__ml_lump' => MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_LUMP,
            '__ml_weight' => 'Shipping cost = Product weight',
        ),
    ),
    'paymentmethod' => array(
        'label' => 'Payment Methods <span class="bull">•</span>',
        'help' => '
            Select here the default payment methods for comparison shopping portal and direct-buy (multi selection is possible).<br />
            You can change these payment methods during item preparation.<br />
            <br />
            <strong>Caution:</strong> {#setting:currentMarketplaceName#} exclusively accepts PayPal, Sofortüberweisung and credit card as payment methods for direct-buy.',
        'values' => array(
            'PAYPAL' => 'PayPal',
            'CREDITCARD' => 'Credit Card',
            'SOFORT' => 'Sofort&uuml;berweisung',
            'PRE' => 'payment in advance',
            'COD' => 'cash on delivery',
            'BANKENTER' => 'bank enter',
            'BILL' => 'bill',
            'GIROPAY' => 'Giropay',
            'CLICKBUY' => 'Click&Buy',
            'SKRILL' => 'Skrill',
        ),
    ),
    'access.inventorypath' => array(
        'label' => 'Direction to your CSV table',
    ),
    'shippingmethod' => array(
        'label' => 'Direct-buy Shipping Methods',
        'help' => 'Select which shipping method should be used for direct-buy offers.',
        'values' => array(
            'Paketdienst' => 'Parcel Service',
            'Spedition' => 'Haulage',
            'Download' => 'Download',
        ),
    ),
    'shippingtime' => array(
        'label' => 'Shipping Time',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'use from configuration',
            ),
        )
    ),
    'shippingtimetype' => array(
        'values' => array(
            '__ml_lump' => array('title' => 'General (taken from right field)',),
            'immediately' => array('title' => 'immediately',),
            '4-6days' => array('title' => '4-6 days',),
            '1-2days' => array('title' => '1-2 days',),
            '2-3days' => array('title' => '2-3 days',),
            '4weeks' => array('title' => '4 weeks',),
            '24h' => array('title' => '24 houers',),
            '1-3days' => array('title' => '1-3 days',),
            '3days' => array('title' => '3 days',),
            '3-5days' => array('title' => '3-5 days',),
        ),
    ),
    'shippingtimeproductfield' => array(
        'label' => 'Shipping Time (matching)',
    ),
    'campaignlink' => array(
        'label' => 'Campaign link',
        'help' => 'To create a campaign link that can be specifically tracked, please enter a string without special characters (e.g., umlauts, punctuation marks, and spaces), such as "everythingmustgoout.".',
    ),
    'prepare_title' => array(
        'label' => 'Title',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'prepare_description' => array(
        'label' => 'Description',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Product Images',
        'hint' => 'Maximum 3 images',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'currency' => array(
        'label' => 'Moneda',
        'hint' => '',
    ),
));

MLI18n::gi()->{'formfields__stocksync.tomarketplace__help'} = '
    <strong>Nota:</strong> Dado que {#setting:currentMarketplaceName#} sólo conoce "disponible" o "no disponible" para sus ofertas, se tiene en cuenta lo siguiente:<br>
    <br>
    <ul>
        <li>Stock cantidad tienda &gt; 0 = disponible en {#setting:currentMarketplaceName#}</li> <li>
        <li>Stock quantity shop &lt; 1 = no disponible en {#setting:currentMarketplaceName#}</li>
    </ul>
    <br>
    <strong>Función:</strong><br>
    <dl>
        <dt>Sincronización automática mediante CronJob (recomendado)</dt>
        <dd>
            La función "Sincronización automática" ajusta el nivel de existencias actual {#setting:currentMarketplaceName#} al nivel de existencias de la tienda cada 4 horas (a partir de las 0:00 horas) (con deducción si es necesario, en función de la configuración).<br /> <br /> <br />Sincronización automática mediante CronJob.
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
    <strong>Nota:</strong> Los ajustes en "Configuración" → "Procedimiento de ajuste" ...<br>
    <br>
    → "Límite de pedido por día natural" y<br>
    → "Número de artículos en stock" para las dos primeras opciones<br><br>... se tienen en cuenta.
';
MLI18n::gi()->{'formfields_idealo__shippingtimetype__values__immediately__title'} = '';
MLI18n::gi()->{'formfields_idealo__shippingtimeproductfield__help'} = '            Puedes utilizar la coincidencia de hora de envío para cargar automáticamente atributos almacenados en el artículo como hora de envío en {#setting:currentMarketplaceName#}.<br />
            En el dropdown puedes ver todos los atributos que están definidos actualmente para los artículos. Puedes añadir y utilizar nuevos atributos en cualquier momento a través de la administración de la tienda.';