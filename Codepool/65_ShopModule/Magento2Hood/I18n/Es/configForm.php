<?php


MLI18n::gi()->{'hood_config_producttemplate__field__template.content__hint'} = '        Lista de marcadores de posición disponibles para la descripción del producto:
        <dl>
            <dt>#TITLE#</dt><dd>Nombre del producto (título)</dd>
            <dt>#ARTNR#</dt><dd>Número de artículo en la tienda</dd>
            <dt>#PID#</dt><dd>Identificación del producto en la tienda</dd>
            <dt>#SHORTDESCRIPTION#</dt><dd>Descripción breve en la tienda</dd>
            <dt>#DESCRIPTION#</dt><dd>Descripción de la tienda</dd>
            <dt>#WEIGHT#</dt><dd>Peso del producto</dd>
            <dt>#PROPERTIES#</dt>
            <dd>Una lista de todos los atributos del producto que son "Visibles en la página de información del producto en frontend". La apariencia se puede controlar mediante CSS (ver código de la plantilla estándar)</dd>
            <dt>Los atributos de Magento también están disponibles. Estos se pueden integrar de acuerdo con el siguiente patrón:</dt
            <dd>
                #ATTRIBUTE_TITLE:<span style="font-style:italic;">código del atributo</span>#<br />
                #ATTRIBUTE_VALUE:<span style="font-style:italic;">código del atributo</span>#<br />
                Ejemplo:<br />
                #ATTRIBUTE_TITLE:sku#<br />
                #ATTRIBUTE_VALUE:sku#<br />
            </dd>
        </dl>';
MLI18n::gi()->{'hood_config_producttemplate__field__template.name__help'} = '<dl>
						<dt>Nombre del producto en la campana</dt>
							<dd>Configuración para el nombre del producto en el capó.
							El marcador de posición <b>#TITLE#</b> se sustituye automáticamente por el nombre del producto de la tienda.</dd>
			</dl>';
MLI18n::gi()->{'hood_config_producttemplate_content'} = '<style>
ul.magna_properties_list {
    margin: 0 0 20px 0;
    list-style: none;
    padding: 0;
    display: inline-block;
    anchura: 100%
}
ul.magna_properties_list li {
    border-bottom: none;
    anchura: 100%;
    altura: 20px;
    padding: 6px 5px;
    float: left;
    list-style: none;
}
ul.magna_properties_list li.odd {
    background-color: rgba(0, 0, 0, 0.05);
}
ul.magna_properties_list li span.magna_property_name {
    display: block;
    float: left;
    margin-right: 10px;
    font-weight: bold;
    color: #000;
    altura de línea: 20px;
    text-align: left;
    font-size: 12px;
    anchura: 50%;
}
ul.magna_properties_list li span.magna_property_value {
    color: #666;
    altura de línea: 20px;
    text-align: left;
    font-size: 12px;
    anchura: 50%;
}
</style>
<p>#TITULO#</p>
<p>#ARTNR#</p>
<p>#SHORTDESCRIPTION#</p>
<p>#Imagen1#</p>
<p>#Imagen2#</p>
<p>#Imagen3#</p>
<p>#DESCRIPCIÓN#</p>
<p>#DescripciónMóvil#</p>
<div>#PROPIEDADES#</div>';
MLI18n::gi()->{'hood_config_producttemplate__field__template.name__label'} = 'Plantilla del nombre del producto';