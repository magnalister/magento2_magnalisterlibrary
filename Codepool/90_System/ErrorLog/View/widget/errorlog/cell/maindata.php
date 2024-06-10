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
            if(!empty($aData['MOrderID'])) {
                $oOrder = MLOrder::factory()->getByMagnaOrderId($aData['MOrderID']);
                if($oOrder->get('orders_id') !== null) {
                    ?>
                    <td><?php echo $this->__('ML_LABEL_ORDER_ID') ?></td>
                    <td class="order-link">
                        <a title="<?php echo $this->__('ML_LABEL_EDIT') ?>"   target="_blank" class="ml-js-noBlockUi" href="<?php echo $oOrder->getEditLink() ?>">    <?php echo $aData['MOrderID'] ?></a>
                    </td><?php
                } else {
                    ?>
                    <td>MOrderID</td>
                    <td><?php echo $aData['MOrderID']; ?></td>
                    <?php
                }
            } else {
                if(is_array($aData)) {
                    if(isset($aData['SKU'])) {
                        $sLabel = 'SKU';
                        $sValue = $aData['SKU'];
                    } else {
                        $sLabel = key($aData);
                        $sValue = current($aData);
                    }
                } else {
                    $sLabel = '';
                    $sValue = $aData;
                }
                ?>
                <td><?php echo $sLabel; ?></td>
                <td><?php echo $sValue; ?></td>
                <?php
            }
            ?>
        </tr>
    </table>
            <?php
        }