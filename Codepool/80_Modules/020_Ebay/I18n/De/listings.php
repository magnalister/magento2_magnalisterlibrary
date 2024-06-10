<?php
/*MLI18n::gi()->Ebay_listings_popup_after_addItem_content = '
    <br />
    <b>Hinweis zur Verarbeitungszeit und Aktivierung:</b>
    <br /><br />
    Die Verarbeitung kann wenige Sekunden bis zu 6 Stunden dauern:
    <br /><br />
    Artikel ohne eBay-Katalogpflicht: eBay ben&ouml;tigt f&uuml;r die Verarbeitung pro Artikel 5-10 Sekunden (inkl. Bilderpaket). 
    <br /><br />
    eBay-Katalog-Artikel (ePID-Pflicht): Die Verarbeitung und Pr&uuml;fung kann seitens eBay 4-6 Stunden dauern, insbesondere wenn ein neues Produkt dem eBay Katalog vorgeschlagen wird (erfolgt automatisch).
    <br /><br />
    Sie k&ouml;nnen den Verarbeitungs-Status jederzeit im Reiter &quot;Inventar&quot; einsehen. Etwaige Fehlermeldungen nach der Verarbeitung werden im Reiter &quot;Fehlerlog&quot; angezeigt.
';
*/
MLI18n::gi()->Ebay_listings_popup_after_addItem_content = '
    <br />
    <b>Hinweis zur Verarbeitungszeit und Aktivierung:</b>
    <br /><br />
    eBay braucht f&uuml;r die Verarbeitung pro Artikel 5-10 Sekunden. Bei Nutzung des Bilderpakets wird zus&auml;tzlich ist die gleiche Zeit pro Bild ben&ouml;tigt.
     <br /><br />
     Die Daten werden zun&auml;chst auf unsere Server hochgeladen, und anschlie&szlig;end von dort aus zu eBay.
     <br /><br />
     Sie k&ouml;nnen den Verarbeitungs-Status jederzeit im Reiter &quot;Inventar&quot; einsehen. Etwaige Fehlermeldungen nach der Verarbeitung werden im Reiter &quot;Fehlerlog&quot; angezeigt.';
MLI18n::gi()->Ebay_listings_status = array(
    'pending' => 'Artikel wird eingestellt<br /><span class="small">Verarbeitung bei magnalister</span>',
    'active' => 'Aktiv',
    'pending_process' => 'Artikel wird aktualisiert<br /><span class="small">Verarbeitung bei magnalister</span>',
    'waiting_catalog' => 'Artikel wird von eBay gepr&uuml;ft',
    'est_until' => 'voraussichtl. bis',
    'not_yet_known' => 'noch nicht bekannt',
);
MLI18n::gi()->Ebay_listings_prepareType = array(
    'matched' => 'Manuell gematcht',
    'automatched'=> 'Automatisch gematcht',
    'applied'=> 'Manuell beantragt',
    'autoapplied'=> 'Automatisch beantragt',
    'notMatched'=> 'Eigene Daten<br/><span class="small">(keine Katalogpflicht)</span>',
);

MLI18n::gi()->sEbayErrorLast5Minute = 'eBay hat in den letzten 5 Minuten Fehlermeldungen erzeugt. Bitte prüfen Sie den Fehlerlog.';
