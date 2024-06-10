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
Select the shipping carrier that will be assigned to Amazon orders by default.<br>
<br>
You have the following options:<br>
<ul>
	<li><span class="bold underline">Shipping carriers suggested by Amazon</span></li>
</ul>
Select a shipping carrier from the drop-down list. Companies recommended by Amazon are displayed.<br>
<br>
You should choose this option if you <strong>always</strong> want to <strong>use the same shipping carrier</strong> for Amazon orders.<br>
<ul>
	<li><span class="bold underline">Match shipping carriers suggested by Amazon with carriers defined in webshop system (shipping module)</span></li>
</ul>
You can match the shipping carriers suggested by Amazon with the service providers created in the Magento shipping module. Add more than one match by clicking the "+" symbol.<br>
<br>
For information on which entry from the Magento shipping module is used for the Amazon order import, please refer to the info icon under "Order Import" -> "Shipping Service of the Orders".<br>
<br>
Choose this option if you want to use <strong>existing shipping settings from the Magento shipping module</strong>.<br>
<ul>
    <li><span class="bold underline">magnalister adds a free text field in the order details</span></li>
</ul>
If you select this option, magnalister will add a field in the order details of the Magento order when importing it. You can enter the shipping carrier in this field.<br>
<br>
Choose this option if you want to use different shipping carriers for Amazon orders.<br>
<ul>
	<li><span class="bold underline">Manually enter a shipping carrier for all orders in a magnalister text field</span></li>
</ul>
If you select "Other" under "Shipping carriers" in magnalister, you can manually enter the name of a shipping carrier in the right text field.<br>
<br>
Choose this option if you want to <strong>manually enter the same shipping carrier</strong> for all Amazon orders.<br>
<br>
<span class="bold underline">Important notes:</span>
<ul>
	<li>Providing a shipping carrier is mandatory for shipping confirmations on Amazon.<br><br></li>
	<li>Failure to provide the shipping carrier may result in temporary suspension of the sales permission on Amazon.</li>
</ul>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__help'} = '
Select the shipping method that will be assigned to Amazon orders by default.<br>
<br>
You have the following options:
<ul>
	<li><span class="bold underline">Match shipping method with entries from webshop shipping module</span></li>
</ul>
You can match any shipping method with the entries created in the Magento shipping module. Add more than one match by clicking the "+" symbol.<br>
<br>
For information on which entry from the Magento shipping module is used for the Amazon order import, please refer to the info icon under "Order Import" -> "Shipping Service of the Orders".<br>
<br>
Choose this option if you want to use <strong>existing shipping settings from the Magento shipping module.</strong><br>
<ul>
	<li><span class="bold underline">magnalister adds a free text field in the order details</span></li>
</ul>
If you select this option, magnalister will add a field in the order details  in the Magento order when importing it. You can enter the shipping method in this field.<br>
<br>
Choose this option if you want to use different shipping methods for Amazon orders.<br>
<ul>
	<li><span class="bold underline">Manually enter a shipping method for all orders in a magnalister text field</span></li>
</ul>
If you select this option in magnalister, you can manually enter the name of a shipping method in the right text field. <br>
<br>
Choose this option if you want to <strong>manually enter the same shipping method</strong> for all Amazon orders.<br>
<br>
<span class="bold underline">Important notes:</span>
<ul>
	<li>Providing a shipping method is mandatory for shipping confirmations on Amazon.<br><br></li>
	<li>Failure to provide the shipping method may result in temporary suspension of the sales permission on Amazon.</li>
</ul>
';
