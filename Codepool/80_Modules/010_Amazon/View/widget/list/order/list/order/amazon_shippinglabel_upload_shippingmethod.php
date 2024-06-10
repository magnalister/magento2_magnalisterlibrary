<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
 if (!class_exists('ML', false))
     throw new Exception();

$iRow = 0;
foreach ($aOrder['shippingservice'] as $aShippingMethod) {
    ?>
    <tbody class=" <?php echo $iRow % 2 == 0 ? 'even' : 'odd' ?>">
        <tr class="main">
            <td>
                <input <?php echo $iRow == 0 ? ' checked="checked" ' : '' ?> name="<?php echo MLHttp::gi()->parseFormFieldName('shippingserviceid[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" type="radio" value="<?php echo htmlentities(json_encode($aShippingMethod),ENT_COMPAT | ENT_HTML401 | ENT_QUOTES,'UTF-8') ?>" />
            </td>
            <?php foreach ($oList->getHead() as $sHead => $aHead) { ?>
                <td class="cell-<?php echo $aHead['type']; ?>">
                    <?php $this->includeView('widget_list_order_cell_amazon_shippingmethod_' . $aHead['type'], array('aOrder' => $aOrder, 'aShippingMethod' => $aShippingMethod)); ?>
                </td>
            <?php
            }
            $iRow++;
            ?>
        </tr>
    </tbody> <?php
        }