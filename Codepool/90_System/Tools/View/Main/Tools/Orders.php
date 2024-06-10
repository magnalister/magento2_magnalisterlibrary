<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
/**
 * @var $this ML_Tools_Controller_Main_Tools_Orders
 */
?>
<table class="attributesTable">
<tr>
    <td>
    <form method="post" action="<?php echo $this->getCurrentUrl(); ?>">
        <div style="display:none">
            <?php foreach (MLHttp::gi()->getNeededFormFields() as $sKey => $sValue) { ?>
                <input type="hidden" name="<?php echo $sKey ?>" value="<?php echo $sValue ?>"/>
            <?php } ?>
        </div>
        <table style="float: left">
            <tr>
                <td>
                    <label for="ml-sku">OrderSpecial :</label>
                </td>
                <td>
                    <input type="text" name="<?php echo MLHttp::gi()->parseFormFieldName('orderspecial') ?>" value="<?php echo $this->getRequestedOrderSpecial() ?>">
                </td>
                <td>
                    <button type="sumit" class="mlbtn">Search Order</button>
                </td>
            </tr>
        </table>
        <?php if (!$this->isExpert()) { ?>
        <table style="float: right;">
            <tr>
                <td>
                        <button type="submit" class="mlbtn" name="<?php echo MLHttp::gi()->parseFormFieldName('mode') ?>" value="expert">
                            Show expert tool
                        </button>

                </td>
            </tr>
        </table>
        <?php } ?>
        <?php if ($this->isExpert()) { ?>
            <table style="float: right">
                <tr>
                    <td>
                        <h3 style="color: red">Expert tools, be careful to use them</h3>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('mode') ?>" value="expert"/>
                        <button type="submit" class="mlbtn" name="<?php echo MLHttp::gi()->parseFormFieldName('action') ?>" value="resetOrderStatus">
                            Reset Order Status
                        </button>
                    </td>
                    <td style="width: min-content">
                        Use this action to set order status to open status, to sent order status to marketplace again
                    </td>
                </tr>
                <?php if (MLSetting::gi()->blDev) { ?>
                    <tr>
                        <td>
                        <select name="<?php echo MLHttp::gi()->parseFormFieldName('apirequest') ?>">
                            <option value="yes">send request on API</option>
                            <option value="no">don't send request on API</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" class="mlbtn" name="<?php echo MLHttp::gi()->parseFormFieldName('action') ?>" value="unacknowledge">
                            UnAcknowledge Imported Order
                        </button>
                    </td>
                </tr>
                    <!--                <tr>-->
                    <!--                    <td></td>-->
                    <!--                    <td>-->
                    <!--                        <button type="sumit" class="mlbtn" name="--><?php //echo MLHttp::gi()->parseFormFieldName('action') ?><!--" value="recreateProducts">-->
                    <!--                            Delete and recreate order products-->
                    <!--                        </button>-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                <?php } ?>
            </table>
        <?php } ?>

    </form>
<?php
$aData = $this->getOrderData();
if (is_array($aData)) { ?>
    <table style="width:100%">
        <tr>
            <td style="vertical-align:top">
                <h3> magnalister Order Table Data</h3><?php
                Kint::dump($aData['$oOrder->data()']);
                ?>
            </td>

            <?php
            ?>
            <td style="vertical-align:top">
                <h3> Shop Order Data</h3><?php
                    Kint::dump($aData['Shop']); ?>
            </td>
        </tr>

        <?php
        if (isset($aData['Attributes'])) {
            ?>
            <tr>
            <td></td>
            <td style="vertical-align:top">
                <h3> Shop Order Freetext Attributes</h3><?php
                Kint::dump($aData['Attributes']);
                ?>
            </td>
            </tr><?php
        }
        ?>
    </table>
    <?php
} else if ($this->getRequestedOrderSpecial() !== null) { ?>
    <table style="clear:left;">

        <tr>
            <td>
                <h3>Result of search</h3>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Order not found.
            </td>
            <td>

            </td>
        </tr>
    </table>
    <?php
}
?>
    </td>
</tr>
</table>
<?php
//foreach (MLShop::gi()->getMarketplaces() as $iMarketPlace => $sMarketplace) {
//    try {
//        ML::gi()->init(array('mp' => $iMarketPlace));
//        $aMarketplacesName = $sMarketplace.' '.(isset($aTabIdents[$iMarketPlace]) && $aTabIdents[$iMarketPlace] != '' ? ': '.$aTabIdents[$iMarketPlace].' ' : '').'('.$iMarketPlace.')';
//        $aToBeSynchronized =  MLOrder::factory()->getOutOfSyncOrdersArray();
//        Kint::dump(array("To be synchronized [$aMarketplacesName]"=>$aToBeSynchronized));
//        ML::gi()->init(array());
//        if(!empty($aToBeSynchronized)){
//            break;
//        }
//
//    } catch (Exception $oEx) {//modul dont exists or not configured - do nothing
//    }
//}

?>
<?php
/**
 * @deprecated this is only for ebay-order bug from 17.07.2017
 */
//if ($this->getRequestedOrderSpecial() === 'GetWrongOrdersWithDuplicatedItems') {
//
?>
    <!--        <table border="1">
            <tr><th>Marketplace</th><th>Marketplace-ID</th><th>order</th><th>response</th></tr>-->
<?php
//        foreach (MLShop::gi()->getMarketplaces() as $iMpId => $sMpName) {
//            if ($sMpName === 'ebay') {
//                $aOrders = MagnaConnector::gi()->submitRequest(array(
//                    'ACTION' =>'GetWrongOrdersWithDuplicatedItems',
//                    'SUBSYSTEM' => 'eBay',
//                    'MARKETPLACEID' => $iMpId,
//                ));
//                foreach(array_key_exists('DATA', $aOrders) ? $aOrders['DATA'] : array() as $aOrder) {
//
?>
    <!--        <tr><td><?php // echo $sMpName      ?></td><td><?php // echo $iMpId;      ?></td><td><?php // new dBug($aOrder);      ?></td><td>-->
<?php
//                        try {
//                            if (MLOrder::factory()->unAcknowledgeImportedOrder($sMpName, $iMpId, $aOrder['MOrderID'], $aOrder['ShopOrderID'])) {
//                                echo 'success';
//                            } else {
//                                echo 'fail';
//                            }
//                        } catch (Exception $oEx) {
//                            new dBug('Error: '. $oEx->getMessage());
//                        }
//
?>
    <!--        </td></tr>-->
<?php
//                }
//            }
//        }
//
?>
    <!--</table>-->
<?php
//}
