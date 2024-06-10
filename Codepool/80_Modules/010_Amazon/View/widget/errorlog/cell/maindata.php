<?php
/* @var $oErrorlog ML_ErrorLog_Model_Table_ErrorLog */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php if(isset($oProduct)) { ?>
    <table>
        <tr>
            <td>SKU</td><td><?php echo $oProduct->getSku() ?></td>
        </tr>
        <tr>
            <td><?php echo MLI18n::gi()->ML_LABEL_SHOP_TITLE; ?></td><td class="product-link"><a title="<?php echo MLI18n::gi()->ML_LABEL_EDIT ?>" target="_blank" href="<?php echo $oProduct->getEditLink() ?>">
                    <?php echo $oProduct->getName() ?></a></td>
        </tr>
    </table>

    <?php
} else {
    $aData = $oErrorlog->get('data');
    ?>
    <table>
        <tr><?php
            $iMLOrderId = null;
            if(!empty($aData['AmazonOrderID'])) {
                $iMLOrderId = $aData['AmazonOrderID'];
            } elseif(!empty($aData['MOrderID'])) {
                $iMLOrderId = $aData['MOrderID'];
            }
            if($iMLOrderId !== null) {
                $oOrder = MLOrder::factory()->getByMagnaOrderId($iMLOrderId);
                if($oOrder->get('orders_id') !== null) {
                    ?>
                    <td><?php echo $this->__('ML_LABEL_ORDER_ID') ?></td>
                    <td class="order-link">
                        <a title="<?php echo $this->__('ML_LABEL_EDIT') ?>"   target="_blank" class="ml-js-noBlockUi" href="<?php echo $oOrder->getEditLink() ?>">    <?php echo $iMLOrderId ?></a>
                    </td><?php
                } else {
                    ?> 
                    <td><?php echo $this->__('ML_LABEL_ORDER_ID') ?></td>
                    <td><?php echo $iMLOrderId ?></td>
                    <?php
                }
            } else {
                ?>
                <td><?php echo is_array($aData) ? fixHTMLUTF8Entities(key($aData)) : fixHTMLUTF8Entities($aData); ?></td>
                <td><?php echo is_array($aData) ? fixHTMLUTF8Entities(current($aData)) : fixHTMLUTF8Entities($aData); ?></td>
                <?php
            }
            ?>
        </tr>
    </table>
    <?php
}