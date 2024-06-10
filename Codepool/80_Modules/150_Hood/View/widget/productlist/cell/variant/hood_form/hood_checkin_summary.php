<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <?php
    $oPrepare = $this->getPrepareData($oProduct);
    $aI18n = $this->__('Hood_CheckinForm');
    ?>
    <table style="width:100%">
        <tr>
            <th>
                <?php echo $aI18n['Price'] ?>:
            </th>
            <td>
                <?php echo $this->getPrice($oProduct) ?>
            </td>
            <td style="color:gray;font-style: italic;float:right;">
                (
                <?php echo $aI18n['ShopPrice'] ?>: <?php echo $oProduct->getShopPrice(true, false); ?>,
                <?php echo $aI18n['SuggestedPrice'] ?>
                : <?php echo $oProduct->getSuggestedMarketplacePrice($this->getPriceObject($oProduct), true, false) ?>,
                )
            </td>
        </tr>
        <tr>
            <th><?php echo $aI18n['Amount'] ?>:</th>
            <td><?php echo $this->getStock($oProduct) ?></td>
            <td style="color:gray;font-style: italic;float:right;">
                (
                <?php echo $aI18n['AvailibleAmount'] ?>: <?php echo $oProduct->getStock() ?>,
                <?php echo $aI18n['SuggestedAmount'] ?>: <?php echo $this->getStock($oProduct) ?>
                )
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $aI18n['ShippingTime'] ?>:
            </th>
            <td>
                <select style="width:100%" name="<?php echo MLHttp::gi()->parseFormFieldName('selection[data][leadtimetoship]') ?>">
                    <?php $iShipping = MLModul::gi()->getConfig('dispatchtimemax') ?>
                    <option>—</option>
                    <?php for ($i = 1; $i < 31; $i++) { ?>
                        <option <?php echo($iShipping == $i ? 'selected="selected" ' : '') ?>value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
    </table>
<?php } ?>
