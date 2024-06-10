<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php
$aOrders = $oList->getList();
foreach ($aOrders as $aOrder) {
    ?>
    <table class="ml-plist-table">
        <thead >
            <tr>
                <th colspan="6" class="dark">
                    <div style="float:left"><?php echo 'Amazon-' . $this->__('ML_LABEL_ORDER_ID') . ' ' . $aOrder['MPSpecific']['MOrderID']; ?></div>
                    <div style="float:right"><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Customer_Name_Label') . ': ' . $aOrder['AddressSets']['Main']['Firstname'] . " " . $aOrder['AddressSets']['Main']['Lastname']; ?></div>
                </th>
            </tr>
        </thead>
        <?php
        $this->includeView('widget_list_order_list_head', array('oList' => $oList));
        ?>

        <?php
        $this->includeView('widget_list_order_list_order', array('aOrder' => $aOrder, 'oList' => $oList));
        $this->includeView('widget_list_order_cell_amazon_form_shippinginformation', array('aOrder' => $aOrder, 'oList' => $oList));
        ?>

    </table>
    <?php
}
