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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */


MLI18n::gi()->{'form_config_orderimport_exchangerate_update_help'} = '<strong>General:</strong>
<p>
If the currency of the web-shop differs from the marketplace currency, during the order import process and during product uploading, magnalister calculates accordingly to the web-shop default currency.
When importing marketplace orders, concerning the currency settings, magnalister simulates exactly the same behavior like the web-shop saves any frontend-orders.
</p>

<strong>Caution:</strong>
<p>
By activating this function, the currency settings in your web-shop will be updated and overwritten by Magento’s internal Import Service (System > Manage Currencies).
<u>As a result, this will affect your foreign currency in the web-shop frontend.</u>
</p>
<p>
The following magnalister functions trigger the exchange-rate update:
<ul>
<li>Order import</li>
<li>Preparation of products</li>
<li>Upload of products</li>
<li>Synchronization of stock and prices</li>
</ul>
</p>
<p>
If an exchange-rate of a marketplace is not configured in the web-shop currency settings, magnalister will display an error message.
</p>';
MLI18n::gi()->{'form_config_orderimport_exchangerate_update_alert'} = '<strong>Caution:</strong>
<p>
By activating this function, the currency settings in your web-shop will be updated and overwritten by Magento’s internal Import Service (System > Manage Currencies).
<u>As a result, this will affect your foreign currency in the web-shop frontend.</u>
</p>
<p>
The following magnalister functions trigger the exchange-rate update:
<ul>
<li>Order import</li>
<li>Preparation of products</li>
<li>Upload of products</li>
<li>Synchronization of stock and prices</li>
</ul>
</p>';
