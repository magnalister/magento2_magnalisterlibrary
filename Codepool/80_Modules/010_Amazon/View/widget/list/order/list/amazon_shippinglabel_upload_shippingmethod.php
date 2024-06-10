<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?><?php
$aOrders = $oList->getList();

foreach ($aOrders as $aOrder) {
    ?>
    <table class="ml-plist-table">
        <thead >
            <tr>
                <th colspan="6">
                    <div style="float:left"><?php echo 'Amazon-' . $this->__('ML_LABEL_ORDER_ID') . ' : ' . $aOrder['MPSpecific']['MOrderID']; ?></div>
                    <div style="float:right"><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Customer_Name_Label') . ' : ' . $aOrder['AddressSets']['Main']['Firstname'] . " " . $aOrder['AddressSets']['Main']['Lastname']; ?></div>
                </th>
            </tr>
        </thead>
        <?php
        if (!empty($aOrder['shippingservice'])) {
            $this->includeView('widget_list_order_list_head', array('oList' => $oList));
            ?>

            <?php
            $this->includeView('widget_list_order_list_order', array('aOrder' => $aOrder, 'oList' => $oList));
            ?>
            <tbody class="even ml-shippinglabel-form" id="orderlist-<?php echo $aOrder['MPSpecific']['MOrderID'] ?>">
                <tr>
                    <td colspan="6">
        <!--                    <table>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td colspan="2">
                        <?php echo $this->__('ML_Amazon_Shippinglabel_Form_Shipping_Information_Label') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                        <?php echo $this->__('ML_Amazon_Shippinglabel_Shippingmethod_ExtraditionWarning_Label') ?>
                                            </td>
                                            <td>
                                                <input name="<?php echo MLHttp::gi()->parseFormFieldName('shippinglabel-extradition[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" type="checkbox" ><br>
                        <?php echo $this->__('ML_Amazon_Shippinglabel_Shippingmethod_ExtraditionWarning_Information') ?>
                                                <p>
                        <?php echo $this->__('ML_Amazon_Shippinglabel_Shippingmethod_ExtraditionWarning_Information') ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                        <?php echo $this->__('ML_Amazon_Shippinglabel_ShippingMethod_ShippingMethodOfCutomer_Label') ?>:
                                            </td>
                                            <td>
                        <?php //echo $aOrder['ShippingServiceName']; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                        <?php echo $this->__('ML_Amazon_Shippinglabel_ShippingMethod_Disclaimer_Label') ?>:
                                            </td>
                                            <td>
                                                    <input name="<?php echo MLHttp::gi()->parseFormFieldName('Disclaimer[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" type="checkbox" ><br>

                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                        <?php echo $this->__('ML_Amazon_Shippinglabel_ShippingMethod_StandardService_Label') ?>:
                                            </td>
                                            <td>
                                                    <input name="<?php echo MLHttp::gi()->parseFormFieldName('standardservice[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" type="checkbox" ><br>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>-->
                    </td>
                </tr>
            </tbody>
        <?php } else { ?>
            <tbody class="even ml-shippinglabel-form" id="orderlist-<?php echo $aOrder['MPSpecific']['MOrderID'] ?>">
                <tr>
                    <td colspan="6" class="error">
                            <?php echo $this->__('ML_Amazon_Shippinglabel_ShippingMethod_Warning_ShippingServiceNotAvailable') ?>
                    </td>
                </tr>
            </tbody>
        <?php }
        ?>
    </table>
    <?php
}
