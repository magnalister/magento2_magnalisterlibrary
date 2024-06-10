<?php


MLI18n::gi()->{'form_config_orderimport_exchangerate_update_help'} = '<strong>Básicamente:</strong>
<p>
Si la moneda predeterminada de la tienda web difiere de la moneda del mercado, magnalister calcula la importación de pedidos y la carga de artículos utilizando el tipo de moneda almacenado en la tienda web.
Al importar los pedidos, magnalister guarda las divisas y los importes 1:1 de la misma forma que lo hace la tienda web al recibir los pedidos.
</p>

<strong>Atención:</strong>
<p>
Al activar esta función aquí, el tipo de cambio almacenado en la tienda web se actualiza con el servicio de importación que está activado en Magento en "Sistema" > "Gestionar divisas".
<u>Así también se mostrarán los precios en su tienda web a la venta con el tipo de cambio actualizado:</u>
</p>
<p>
Las siguientes funciones activan la actualización
<ul>
<li>Importación de pedidos</li>
<li>Preparación de artículos</li>
<li>Carga de artículos</li>
<li>Sincronización de existencias/precios</li>
</ul>
</p>
<p>
Si el tipo de moneda de un marketplace no se ha creado en la configuración de moneda de la tienda web, magnalister emite un mensaje de error.
</p>';
MLI18n::gi()->{'form_config_orderimport_exchangerate_update_alert'} = '<strong>Atención:</strong>
<p>
Al activar, el tipo de cambio almacenado en la tienda web se actualiza con el servicio de importación, que se activa en Magento en "Sistema" > "Gestionar divisas".
<u>Así también se mostrarán los precios en su tienda web con el tipo de cambio actualizado para la venta:</u
</p>
<p>
Las siguientes funciones activan la actualización
<ul>
<li>Importación de pedidos</li>
<li>Preparación de artículos</li>
<li>Carga de artículos</li>
<li>Sincronización de existencias/precios</li>
</ul>
</p>
';