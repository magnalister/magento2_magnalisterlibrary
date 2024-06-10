<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    $oPrepare = $this->getPrepareData($oProduct);
    $aI18n = $this->__('PriceMinister_CheckinForm');
    ?>
    <table style="width:100%">
        <tr>
            <th>
                <?php echo $aI18n['Price'] ?>:
            </th>
            <td>
                <input style="width:100%" disabled="disabled" id='<?php echo $this->getIdent() ?>_price_<?php echo $oProduct->get('id')?>'
                       name="<?php echo MLHttp::gi()->parseFormFieldName('selection[data][price]') ?>" value="<?php echo $this->getPrice($oProduct) ?>" />
            </td>
            <td style="color:gray;font-style: italic;float:right;">
                (
                <?php echo $aI18n['ShopPrice'] ?>: <?php echo $oProduct->getShopPrice(true, false); ?>, 
                <?php echo $aI18n['SuggestedPrice'] ?>: <?php echo $oProduct->getSuggestedMarketplacePrice($this->getPriceObject($oProduct), true, false) ?>
                )
            </td>
        </tr>
        <tr>
            <th><?php echo $aI18n['Amount'] ?>:</th>
            <td><input style="width:100%" disabled="disabled" id='<?php echo $this->getIdent() ?>_stock_<?php echo $oProduct->get('id')?>'
                       name="<?php echo MLHttp::gi()->parseFormFieldName('selection[data][stock]') ?>" 
                       value="<?php echo $this->getStock($oProduct) ?>"/></td>
            <td style="color:gray;font-style: italic;float:right;">
                (
                <?php echo $aI18n['AvailibleAmount'] ?>: <?php echo $oProduct->getStock() ?>, 
                <?php echo $aI18n['SuggestedAmount'] ?>: <?php echo $this->getStock($oProduct) ?>
                )
            </td>
        </tr>
   </table>
<?php }