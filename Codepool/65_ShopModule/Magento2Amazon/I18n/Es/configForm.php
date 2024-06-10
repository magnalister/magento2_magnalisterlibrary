<?php


MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__help'} = '
Seleccione aquí el servicio de entrega ( = método de envío), que se asigna por defecto a todos los pedidos de Amazon.<br>
<br>
Tienes las siguientes opciones:
<ul>
	<li><span class="negrita subrayada">Coincidir el servicio de entrega con las entradas del módulo de envío de la tienda web</span></li>.
</ul>
Puede hacer coincidir cualquier servicio de entrega con las entradas creadas en el módulo de gastos de envío de Magento. Puede hacer múltiples coincidencias utilizando el símbolo "+".<br>
<br>
Para obtener información sobre qué entrada del módulo de gastos de envío de Magento se utiliza para la importación de pedidos de Amazon, consulte el icono de información en "Importación de pedidos" -> "Método de envío de pedidos".<br>
<br>
Esta opción es útil si desea utilizar <strong>configuraciones de gastos de envío existentes de</strong> el módulo de gastos de envío de <strong>Magento</strong>.<br>
<ul>
	<li><span class="negrita subrayada">magnalister añade un campo de texto libre en los detalles del pedido</span></li>.
</ul>
Si selecciona esta opción, magnalister añade un campo en los detalles del pedido de Magento durante la importación del pedido. En este campo puede introducir el servicio de entrega.<br>
<br>
Esta opción es útil si desea utilizar <strong>diferentes servicios de entrega</strong> para los pedidos de Amazon.<br>
<ul>
	<li><span class="negrita subrayada">Introduzca manualmente un servicio de entrega para todos los pedidos en un campo de texto magnalister</span></li>.
</ul>
Si selecciona esta opción en magnalister, puede introducir manualmente el nombre de un servicio de entrega en el campo de texto situado a la derecha del mismo.<br>
<br>
Esta opción es útil si <strong>desea introducir manualmente el mismo servicio de entrega para todos los pedidos de Amazon</strong>.<br>
<br>
<span class="negrita subrayada">Notas importantes:</span
<ul>
	<li>La especificación de un servicio de entrega es obligatoria para las confirmaciones de envío en Amazon.<br><br></li>.
	<li>El no proporcionar el servicio de entrega puede dar lugar a una retirada temporal de la autorización de venta.</li> <li><li>Por favor, tenga en cuenta que el servicio de entrega es obligatorio.
</ul>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__help'} = '
Seleccione aquí la empresa de transporte que se asigna por defecto a los pedidos de Amazon.<br>
<br>
Tiene las siguientes opciones:<br>
<ul>
	<li><span class="negrita subrayada">Transportista sugerido por Amazon</span></li>.
</ul>
Selecciona una empresa de transporte de la lista desplegable. Aparecerán las empresas recomendadas por Amazon.<br>
<br>
Esta opción es útil si <strong>quieres utilizar siempre la misma empresa de transporte</strong> para los pedidos de Amazon.<br>
<ul>
	<li><span class="negrita subrayada">Coincidir empresas de transporte sugeridas por Amazon con proveedores de servicios de envío del módulo de gastos de envío de la tienda web</span></li>.
</ul>
Puedes hacer coincidir las empresas de transporte recomendadas por Amazon con los proveedores de servicios creados en el módulo de gastos de envío de Magento. Puede realizar múltiples coincidencias utilizando el símbolo "+".<br>
<br>
Para obtener información sobre qué entrada del módulo de gastos de envío de Magento se utiliza para la importación de pedidos de Amazon, consulte el icono de información en "Importación de pedidos" -> "Método de envío de pedidos".<br>
<br>
Esta opción es útil si desea utilizar <strong>configuraciones de gastos de envío existentes</strong> del módulo de gastos de envío de <strong>Magento</strong>.<br>
<ul>
    <li><span class="negrita subrayada">magnalister añade un campo de texto libre en los detalles del pedido</span></li>.
</ul>
Si seleccionas esta opción, magnalister añadirá un campo en los detalles del pedido de Magento. En este campo puede introducir la empresa de transporte.<br>
<br>
Esta opción es útil si desea utilizar <strong>diferentes empresas de transporte</strong> para los pedidos de Amazon.<br>
<ul>
	<li><span class="negrita subrayada">Introduzca manualmente una empresa de transporte para todos los pedidos en un campo de texto magnalister</span></li>.
</ul>
Si selecciona la opción "Otros" en "Empresa de transporte" en magnalister, puede introducir manualmente el nombre de una empresa de transporte en el campo de texto situado a su derecha.<br>
<br>
Esta opción es útil si <strong>desea introducir manualmente la misma empresa de transporte para todos los pedidos de Amazon</strong>.<br>
<br>
<span class="negrita subrayada">Notas importantes:</span
<ul>
	<li>La especificación de una empresa de transporte es obligatoria para las confirmaciones de envío en Amazon.<br><br></li>
	<li>El hecho de no proporcionar la empresa de transporte puede dar lugar a la retirada temporal de la autorización de venta.</li> <li><li>Si la empresa de transporte no se especifica, se le retirará la autorización de venta.
</ul>
';