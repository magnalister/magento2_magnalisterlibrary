<?php

MLI18n::gi()->set('ricardo_prepare_form__field__dedescription__hint','
    Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:
    <dl>
        <dt>#TITLE#</dt>
        <dd>Produktname (Titel)</dd>
        <dt>#VARIATIONDETAILS#</dt>
        <dd>Da ricardo.ch keine Varianten unterstützt, übermittelt magnalister Varianten als einzelne Artikel zu ricardo.ch. Nutzen Sie diesen Platzhalter, um die Varianten-Details in Ihrer Artikelbeschreibung anzuzeigen</dd>
        <dt>#ARTNR#</dt>
        <dd>Artikelnummer im Shop</dd>
        <dt>#PID#</dt>
        <dd>Products ID im Shop</dd>
        <dt>#SHORTDESCRIPTION#</dt>
        <dd>Kurzbeschreibung aus dem Shop</dd>
        <dt>#DESCRIPTION#</dt>
        <dd>Beschreibung aus dem Shop</dd>
        <dt>#PICTURE1#</dt>
        <dd>erstes Produktbild</dd>
        <dt>#PICTURE2# usw.</dt>
        <dd>zweites Produktbild; mit #PICTURE3#, #PICTURE4# usw. k&ouml;nnen weitere Bilder &uuml;bermittelt werden, so viele wie im Shop vorhanden.</dd>
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
    </dl>
', true);
