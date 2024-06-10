<?php


MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__hint'} = '
    Lista de marcadores de posición disponibles para la descripción del producto:
    <dl>
        <dt>#TITLE#</dt>
        <dd>Nombre del producto (título)</dd>
        <dt>#VARIATIONDETAILS#</dt>
        <dd>Dado que ricardo.ch no soporta variantes, magnalister transmite las variantes como artículos individuales a ricardo.ch. Utilice este marcador de posición para mostrar los detalles de la variante en la descripción de su artículo</dd>
        <dt>#ARTNR#</dt>
        <dd>Número de artículo en la tienda</dd>
        <dt>#PID#</dt>
        <dd>ID del producto en la tienda</dd>
        <dt>#SHORTDESCRIPTION#</dt>
        <dd>Breve descripción de la tienda</dd>
        <dt>#DESCRIPCIÓN#</dt>
        <dd>Descripción de la tienda</dd>
        <dt>#Imagen1#</dt>
        <dd>Primera imagen del producto</dd>
        <dt>#Imagen2# etc.</dt>
        <dd>segunda imagen del producto; con #Imagen3#, #Imagen4# etc. se pueden transmitir más imágenes, tantas como haya disponibles en la tienda.</dd>
        <dt>#PROPIEDADES#</dt>
        <dd>Una lista de todos los atributos del producto que son "Visibles en la página de información del producto en frontend". La apariencia se puede controlar mediante CSS (ver código de la plantilla estándar)</dd>
        <dt>Magento arttibutes también están disponibles. Estos pueden ser integrados de acuerdo con el siguiente patrón:</dt
        <dd>
            #ATTRIBUTE_TITLE:<span style="font-style:italic;">código del atributo</span>#<br />
            #ATTRIBUTE_VALUE:<span style="font-style:italic;">código del atributo</span>#<br />
            Ejemplo:<br />
            #ATTRIBUTE_TITLE:sku#<br />
            #ATTRIBUTE_VALUE:sku#<br />
        </dd>
    </dl>
';