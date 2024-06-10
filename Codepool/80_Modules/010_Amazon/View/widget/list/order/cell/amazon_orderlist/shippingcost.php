<?php
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aOrder array */
 if (!class_exists('ML', false))
     throw new Exception();

echo MLPrice::factory()->format($aOrder['ShippingService']['Rate']['Amount'], $aOrder['ShippingService']['Rate']['CurrencyCode']);
