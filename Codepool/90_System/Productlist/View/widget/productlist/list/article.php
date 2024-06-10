<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    if ($this->renderVariantsError() || $this->renderVariants()) {
        $aVariants = $oList->getVariants($oProduct);
    }
    $this->includeView('widget_productlist_list_mainarticle', array('oList' => $oList, 'oProduct' => $oProduct));
    if (
        $this->renderVariants()
        && $oProduct->exists() && count($aVariants) > 0 && count(MLMessage::gi()->getObjectMessages($oProduct)) == 0 //in safari(10.0.2) there is problem to show dotted style for several td, here we tried to solve it to show dotted only for one td and solved the problem
    ) { ?>
        <tr class="ml-h-separator">
            <td></td>
            <td class="ml-hl-dotted" colspan="<?php echo count($oList->getHead()) + ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection ? 1 : 0); ?>"></td>
        </tr>
        <tr class="child">
            <td></td>
            <td class="next-child" colspan="<?php echo count($oList->getHead()) + ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection ? 1 : 0); ?>"><?php echo $this->__("Productlist_Variation_Label") ?></td>
        </tr>
        <?php
        $oCurrentProduct = $oProduct;
        //in safari(10.0.2) there is problem to show dotted style for several td, here we tried to solve it to show dotted only for one td and solved the problem
        foreach ($aVariants as $oProduct) {
            ?>
            <tr class="ml-h-separator">
                <td></td>
                <td class="ml-hl-dotted" colspan="<?php echo count($oList->getHead()) + ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection ? 1 : 0); ?>"></td>
            </tr>
            <tr class="child">
                <td></td>
                <td class="next-child" colspan="<?php echo count($oList->getHead()) + ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection ? 1 : 0); ?>"></td>
            </tr>
            <?php
            $this->includeView('widget_productlist_list_variantarticle', array('oList' => $oList, 'oProduct' => $oProduct));
            foreach ($oList->additionalRows($oProduct) as $sAddRow) {
                $this->includeView('widget_productlist_list_variantarticleadditional_'.$sAddRow, array('oProduct' => $oProduct, 'aAdditional' => isset($aAdditional) ? $aAdditional : array()));
            }
        }
    }
}
