<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
/* @var $aVariants array */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract && $oProduct->exists()) {
    $iVariantCount = $this->getVariantCount($oProduct);

    $sClassName = get_class($this);
    if (substr($sClassName, -15) === 'Checkin_Summary' && $oProduct->isSingle()) {
        $iRealVariantsCount = 1;
    }
    $sError = $this->includeViewBuffered('widget_productlist_list_articleerror', array('oProduct' => $oProduct));
    $sVariantError = $this->includeViewBuffered('widget_productlist_list_variantarticleerror', array('oProduct' => $oProduct, 'oList' => $oList));
    $sProduct = $this->includeViewBuffered('widget_productlist_list_maincells', array('oProduct' => $oProduct, 'oList' => $oList));
    $sKey = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value');
    $sCurrSku = $oProduct->getSku();
    $bSkuError = (empty($sCurrSku) && $sKey !== 'pID');
    ?>
    <tr class="main" data-actionTopForm="<?php echo $this->getRowAction($oProduct); ?>">
        <th class="<?php echo !$oProduct->isSingle() && $iVariantCount > 0 && $sError == '' ? 'switch' : 'no-switch' ?>">
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('render') ?>" value="true"/>
            <?php
            if (!$oProduct->isSingle() && $iVariantCount > 0 && $sError == '') {
                if (!$this->renderVariants()) {
                    ?>
                    <a class="ml-js-noBlockUi" href="<?php echo $this->getCurrentUrl(array('ajax' => 'true', 'method' => 'renderProduct', 'pid' => $oProduct->get('id'))) ?>">
                        &#x25bc;
                    </a>
                    <?php
                } else {
                    ?>&#x25b2;<?php
                }
            }
            ?>
        </th>
        <?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection) { ?>
            <th class="cell-magnalisterSelectionRow">
                <?php
                if (
                $this->productSelectable($oProduct, true)
                ) {
                    foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
                        ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
                    }
                    ?>
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="deleteFromSelection" /><?php
                    if ($oProduct->isSingle()) {
                        $iVariantCount = 1;
                    }
                    $iCountSelectedVariants = (int)$this->countSelectedVariants($oProduct);
                    $blChecked = $iVariantCount <= $iCountSelectedVariants;
                    $hasError = $bSkuError || !empty($sError) || !empty($sVariantError);
                    ?>
                    <input <?php echo $blChecked ? 'checked="checked"' : '' ?> title="<?php echo $oProduct->get('id') ?>" class="js-mlFilter-activeRowCheckBox" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="addToSelection" type="checkbox" <?php echo $hasError ? 'disabled' : '' ?>/><?php
                }
                ?>
            </th>
        <?php }
        echo $sProduct; ?>
    </tr>
    <?php
}
?>
