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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__help'} = '
Wählen Sie hier das Transportunternehmen, das den Amazon Bestellungen standardmäßig zugeordnet wird.<br>
<br>
Sie haben folgende Optionen:<br>
<ul>
	<li><span class="bold underline">Von Amazon vorgeschlagene Transportunternehmen</span></li>
</ul>
Wählen Sie ein Transportunternehmen aus der Dropdown-Liste. Es werden die Unternehmen angezeigt, die von Amazon empfohlen werden.<br>
<br>
Diese Option bietet sich an, wenn Sie für Amazon Bestellungen <strong>immer das gleiche Transportunternehmen nutzen</strong> möchten.<br>
<ul>
	<li><span class="bold underline">Von Amazon vorgeschlagene Transportunternehmen mit Versanddienstleistern aus Webshop Versandkosten-Modul matchen</span></li>
</ul>
Sie können die von Amazon empfohlenen Transportunternehmen mit den im Magento Versandkosten-Modul angelegten Dienstleistern matchen. Über das “+” Symbol können Sie mehrere Matchings vornehmen.<br>
<br>
Infos, welcher Eintrag aus dem Magento Versandkosten-Modul beim Amazon Bestellimport verwendet wird, entnehmen Sie bitte dem Info Icon unter “Bestellimport” -> “Versandart der Bestellungen”.<br>
<br>
Diese Option bietet sich an, wenn Sie auf <strong>bestehende Versandkosten-Einstellungen</strong> aus dem <strong>Magento</strong> Versandkosten-Modul zurückgreifen möchten.<br>
<ul>
    <li><span class="bold underline">magnalister fügt ein Freitextfeld in den Bestelldetails hinzu</span></li>
</ul>
Wenn Sie diese Option wählen, fügt magnalister beim Bestellimport ein Feld in den Bestelldetails bei der Magento Bestellung hinzu. In dieses Feld können Sie das Transportunternehmen eintragen.<br>
<br>
Diese Option bietet sich an, wenn Sie für Amazon Bestellungen <strong>unterschiedliche Transportunternehmen</strong> nutzen möchten.<br>
<ul>
	<li><span class="bold underline">Manuelle Eingabe eines Transportunternehmens für alle Bestellungen in ein magnalister Textfeld</span></li>
</ul>
Wenn Sie in magnalister unter “Transportunternehmen” die Option “Andere” wählen, können Sie im Textfeld rechts daneben manuell den Namen eines Transportunternehmens eingeben.<br>
<br>
Diese Option bietet sich an, wenn Sie <strong>für alle Amazon Bestellungen ein und dasselbe Transportunternehmen manuell hinterlegen</strong> möchten.<br>
<br>
<span class="bold underline">Wichtige Hinweise:</span>
<ul>
	<li>Die Angabe eines Transportunternehmens ist für Versandbestätigungen bei Amazon verpflichtend.<br><br></li>
	<li>Die Nicht-Übermittlung des Transportunternehmens kann zu einem vorübergehenden Entzug der Verkaufsberechtigung führen.</li>
</ul>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__help'} = '
Wählen Sie hier den Lieferservice ( = Versandart), der allen Amazon Bestellungen standardmäßig zugeordnet wird.<br>
<br>
Sie haben folgende Optionen:
<ul>
	<li><span class="bold underline">Lieferservice mit Einträgen aus Webshop Versandkosten-Modul matchen</span></li>
</ul>
Sie können einen beliebigen Lieferservice mit den im Magento Versandkosten-Modul angelegten Einträgen matchen. Über das “+” Symbol können Sie mehrere Matchings vornehmen.<br>
<br>
Infos, welcher Eintrag aus dem Magento Versandkosten-Modul beim Amazon Bestellimport verwendet wird, entnehmen Sie bitte dem Info Icon unter “Bestellimport” -> “Versandart der Bestellungen”.<br>
<br>
Diese Option bietet sich an, wenn Sie auf <strong>bestehende Versandkosten-Einstellungen aus</strong> dem <strong>Magento</strong> Versandkosten-Modul zurückgreifen möchten.<br>
<ul>
	<li><span class="bold underline">magnalister fügt ein Freitextfeld in den Bestelldetails hinzu</span></li>
</ul>
Wenn Sie diese Option wählen, fügt magnalister beim Bestellimport ein Feld in den Bestelldetails bei der Magento Bestellung hinzu. In dieses Feld können Sie den Lieferservice eintragen.<br>
<br>
Diese Option bietet sich an, wenn Sie für Amazon Bestellungen <strong>unterschiedliche Lieferservices</strong> nutzen möchten.<br>
<ul>
	<li><span class="bold underline">Manuelle Eingabe eines Lieferservices für alle Bestellungen in ein magnalister Textfeld</span></li>
</ul>
Wenn Sie diese Option in magnalister wählen, können Sie im Textfeld rechts daneben manuell den Namen eines Lieferservices eingeben.<br>
<br>
Diese Option bietet sich an, wenn Sie <strong>für alle Amazon Bestellungen ein und denselben Lieferservice manuell hinterlegen</strong> möchten.<br>
<br>
<span class="bold underline">Wichtige Hinweise:</span>
<ul>
	<li>Die Angabe eines Lieferservices ist für Versandbestätigungen bei Amazon verpflichtend.<br><br></li>
	<li>Die Nicht-Übermittlung des Lieferservices kann zu einem vorübergehenden Entzug der Verkaufsberechtigung führen.</li>
</ul>
';
