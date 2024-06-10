<?php


MLI18n::gi()->{'ebay_prepare_apply_form__field__description__hint'} = '        Lista de marcadores de posición disponibles para la descripción del producto:
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
        </dl>
    ';
MLI18n::gi()->{'ebay_prepare_form__field__title__hint'} = 'Título máx. 80 caracteres';
MLI18n::gi()->{'ebay_prepare_form__field__title__label'} = 'Nombre del producto';
MLI18n::gi()->{'ebay_prepare_form__field__title__optional__checkbox__labelNegativ'} = 'Tome siempre el último nombre de artículo de la tienda web';