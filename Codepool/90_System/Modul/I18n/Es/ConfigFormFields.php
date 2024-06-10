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
MLI18n::gi()->{'configform_price_field_priceoptions_help'} = '<p>Con esta función puedes transferir diferentes precios a {#setting:currentMarketplaceName#} y sincronizarlos automáticamente.
 </p><p>Para ello, selecciona un grupo de clientes de tu tienda online utilizando el menú desplegable de la derecha. </p>
 <p>Si no introduces un precio en el nuevo grupo de clientes, se utilizará automáticamente el precio por defecto de la tienda online. Esto hace que sea muy fácil establecer un precio diferente incluso para un pequeño número de artículos. También se aplican todos los demás ajustes de precio.
 </p><p><b>Ejemplo de aplicación:</b></p>
 <ul>
 <li>Guarda un grupo de clientes en tu tienda online, por ejemplo "{#setting:currentMarketplaceName#}Clientes"</li>.
 <li>Introduce los precios deseados para los artículos del nuevo grupo de clientes en tu tienda online.
 </ul>';
MLI18n::gi()->{'configform_quantity_values__stocksub__title'} = 'Transferir el stock de la tienda menos Valor del campo de la derecha';
MLI18n::gi()->{'configform_quantity_values__stock__title'} = 'Transferir el stock de la tienda';
MLI18n::gi()->{'configform_price_field_priceoptions_kind_label'} = 'El precio rebajado de {#setting:currentMarketplaceName#} se corresponde';
MLI18n::gi()->{'configform_emailtemplate_field_send_help'} = '¿Quieres enviar un correo electrónico desde tu tienda al comprador?';
MLI18n::gi()->{'configform_emailtemplate_field_send_label'} = '¿Quieres enviar un correo electrónico?';
MLI18n::gi()->{'configform_price_field_priceoptions_label'} = 'Precio de venta por grupo de clientes';
MLI18n::gi()->{'configform_stocksync_values__rel'} = 'El pedido reduce el stock de la tienda (recomendado)';
MLI18n::gi()->{'configform_sync_value_no'} = 'Sin sincronización';
MLI18n::gi()->{'configform_price_addkind_values__addition'} = 'x recargo/descuento del precio de la tienda';
MLI18n::gi()->{'configform_price_addkind_values__percent'} = 'x% de recargo/descuento del precio de la tienda';
MLI18n::gi()->{'configform_quantity_values__lump__title'} = 'Total (del campo de la derecha)';
MLI18n::gi()->{'configform_sync_value_fast'} = 'Sincronización automática más rápida con CronJob (en 15 minutos)';
MLI18n::gi()->{'configform_emailtemplate_legend'} = 'Correo electrónico para el comprador';
MLI18n::gi()->{'generic_prepareform_day'} = 'Día';
MLI18n::gi()->{'configform_price_field_strikeprice_label'} = 'Precio anterior: {#setting:currentMarketplaceName#} (precio rebajado)';
MLI18n::gi()->{'configform_sync_value_auto'} = 'Sincronización automática mediante CronJob (recomendado)';
MLI18n::gi()->{'marketplace_configuration_orderimport_payment_method_from_marketplace'} = 'Aplicar el método de pago transmitido por el marketplace';
MLI18n::gi()->{'configform_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'configform_fast_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'configform_stocksync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'configform_sync_values__auto'} = '{#i18n:configform_sync_value_auto#}';
MLI18n::gi()->{'configform_fast_sync_values__auto'} = '{#i18n:configform_sync_value_auto#}';
MLI18n::gi()->{'configform_price_field_strikeprice_help'} = 'La función del precio rebajado de {#setting:currentMarketplaceName#} ofrece la visualización de ofertas especiales o precios minoristas recomendados (PVP). El precio rebajado se muestra junto al precio de venta final.<br /><br />
 <b>Instrucciones importantes:</b><br />
 <ul>
 <li>Si el precio rebajado es inferior al precio de venta, no se enviara ningún precio rebajado.</li>
 <li>Los precios rebajados se muestran en el plufin de magnalister en las descripciones de productos con un precio rebajado en rojo junto al precio de venta.</li>
 <li>De acuerdo con las reglas de {#setting:currentMarketplaceName#}, el precio original se debe de haber utilizado antes en la tienda o en {#setting:currentMarketplaceName#}, o debe ser un PVP del fabricante.
 </li>
 </ul>';
MLI18n::gi()->{'configform_quantity_values__stocksub__textoption'} = '1';
MLI18n::gi()->{'configform_quantity_values__lump__textoption'} = '1';
MLI18n::gi()->{'ML_EBAY_PRICE_CALCULATED'} = '';
MLI18n::gi()->{'configform_price_field_strikeprice_signal_label'} = 'Decimal';
MLI18n::gi()->{'configform_price_field_strikeprice_signal_help'} = '                Este campo de texto se toma como decimal en su precio cuando envía los datos para {#setting:currentMarketplaceName#}.<br/><br/>
                <strong>Ejemplo:</strong> <br />
                Valor en el campo de texto: 99 <br />
                Origen del precio: 5,58 <br />
                Resultado final: 5,99 <br /><br />
                Esta función es especialmente útil para aumentos/disminuciones porcentuales de precios.<br />
                Deja el campo vacío si no deseas calcular un decimal.<br />
                El formato de entrada es un número entero con un máximo de 2 dígitos.';
MLI18n::gi()->{'configform_price_field_strikeprice_signal_hint'} = 'Decimal';
MLI18n::gi()->{'ML_EBAY_STRIKE_PRICE_CALCULATED'} = '';

MLI18n::gi()->{'orderstatus_carrier_defaultField_value_shippingname'} = 'Método de envío como transportista';