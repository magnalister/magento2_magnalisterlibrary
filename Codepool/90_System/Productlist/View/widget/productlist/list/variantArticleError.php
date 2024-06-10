<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();

if ($oProduct->get('parentid') == 0 && $this->renderVariantsError() && $this instanceof ML_Productlist_Controller_Widget_ProductList_Selection) {
    $iCountVariants = 0;
    $aMessages = array();
    $aVariants = $oList->getVariants($oProduct);
    foreach ($aVariants as $oVariant) {
        foreach (MLMessage::gi()->getObjectMessages($oVariant) as $sMessage) {
            $aMessages[$sMessage] = isset($aMessages[$sMessage]) ? $aMessages[$sMessage] + 1 : 1;
        }
    }
    if (!empty($aMessages)) {
        echo MLI18n::gi()->get('Productlist_ProductMessage_sVariantsHaveError');
        foreach ($aMessages as $sMessage => $iCount) {
            echo "\n".$sMessage;
        }
    }
}