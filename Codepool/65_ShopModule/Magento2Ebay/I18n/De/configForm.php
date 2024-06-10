<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->ebay_config_producttemplate_content =
'<style>
ul.magna_properties_list {
    margin: 0 0 20px 0;
    list-style: none;
    padding: 0;
    display: inline-block;
    width: 100%
}
ul.magna_properties_list li {
    border-bottom: none;
    width: 100%;
    height: 20px;
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
    line-height: 20px;
    text-align: left;
    font-size: 12px;
    width: 50%;
}
ul.magna_properties_list li span.magna_property_value {
    color: #666;
    line-height: 20px;
    text-align: left;
    font-size: 12px;
    width: 50%;
}
</style>
<p>#TITLE#</p>
<p>#ARTNR#</p>
<p>#SHORTDESCRIPTION#</p>
<p>#PICTURE1#</p>
<p>#PICTURE2#</p>
<p>#PICTURE3#</p>
<p>#DESCRIPTION#</p>
<p>#MOBILEDESCRIPTION#</p>
<div>#PROPERTIES#</div>';

MLI18n::gi()->add('ebay_config_producttemplate__field__template.content', array(
    'hint' => '
        Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:
        <dl>
            <dt>#TITLE#</dt><dd>Produktname (Titel)</dd>
            <dt>#ARTNR#</dt><dd>Artikelnummer im Shop</dd>
            <dt>#PID#</dt><dd>Produkt ID im Shop</dd>
            <dt>#SHORTDESCRIPTION#</dt><dd>Kurzbeschreibung aus dem Shop</dd>
            <dt>#DESCRIPTION#</dt><dd>Beschreibung aus dem Shop</dd>
            <dt>#WEIGHT#</dt><dd>Produktgewicht</dd>
            <dt>#PROPERTIES#</dt>
            <dd>Eine Liste aller Attribute des Produktes welche "Sichtbar auf Produkt-Infoseite im Frontend" sind. Aussehen kann &uuml;ber CSS gesteuert werden (siehe Code vom Standard Template)</dd>
            <dt>Desweiteren stehen Magento-Arttibute zur Verfügung. Diese können nach folgenden Muster eingebunden werden:</dt>
            <dd>
                #ATTRIBUTE_TITLE:<span style="font-style:italic;">Attributecode</span>#<br />
                #ATTRIBUTE_VALUE:<span style="font-style:italic;">Attributecode</span>#<br />
                Beispiel:<br />
                #ATTRIBUTE_TITLE:sku#<br />
                #ATTRIBUTE_VALUE:sku#<br />
            </dd>
        </dl>',
), false);

/*
 * difference to other shop systems:
 * magento has no base price data, so we leave out the base price help text here
 */
MLI18n::gi()->add('ebay_config_producttemplate', array(
    'field' => array(
        'template.name' => array(
			'label' => 'Template Produktname',
			'help' => '<dl>
						<dt>Name des Produkts auf eBay</dt>
							<dd>Einstellung, wie das Produkt auf eBay hei&szlig;en soll.
							Der Platzhalter <b>#TITLE#</b> wird automatisch durch den Produktnamen aus dem Shop ersetzt.</dd>
			</dl>'
		)
	)
), true);
