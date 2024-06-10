<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
 if (!class_exists('ML', false))
     throw new Exception();

$iRow = 0;
foreach ($aOrder['Products'] as $aProduct) {
    ?>
    <tbody class=" <?php echo $iRow % 2 == 0 ? 'even' : 'odd' ?>">
        <tr class="main">
            <?php foreach ($oList->getHead() as $sHead => $aHead) { ?>
                <th class="cell-<?php echo $aHead['type']; ?>">
                    <?php $this->includeView('widget_list_order_cell_amazon_form_' . $aHead['type'], array('aOrder' => $aOrder, 'aProduct' => $aProduct)); ?>
                </th>
                <?php
            }
            $iRow++;
            ?>
        </tr>
    </tbody> <?php
}