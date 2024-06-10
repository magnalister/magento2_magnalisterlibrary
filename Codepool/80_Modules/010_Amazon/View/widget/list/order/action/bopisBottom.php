<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();

$templateHeader = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ChangeOrderStatus_Header');
$templateBody = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ChangeOrderStatus_Body');
$refundReasons = array(
    'NoInventory' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NoInventory'),
    'CustomerReturn' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CustomerReturn'),
    'GeneralAdjustment' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_GeneralAdjustment'),
    'CouldNotShip' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CouldNotShip'),
    'DifferentItem' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_DifferentItem'),
    'Abandoned' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Abandoned'),
    'CustomerCancel' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CustomerCancel'),
    'PriceError' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PriceError')
);

$cancellationReasons = array(
    'NoInventory' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NoInventory'),
    'GeneralAdjustment' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_GeneralAdjustment'),
    'ShippingAddressUndeliverable' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ShippingAddressUndeliverable'),
    'CustomerExchange' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CustomerExchange'),
    'BuyerCanceled' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_BuyerCanceled'),
    'PriceError' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PriceError')
);
?>

<table class="actions">
    <tbody class="firstChild">
        <tr>
            <td>
                <div class="actionBottom" >
                    <button class="mlbtn action right" id="executeSelectedAction" disabled>
                       <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ExecuteSelectedAction') ?>
                    </button>
                    <label class="left" style="margin-top:3px; font-weight: bold;">
                        <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_StatusDropdown') ?>
                        <select style="margin-left:7px;" id="newOrderStatusBatchUpdate">
                            <option value="ReadyForPickup"><?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ReadyForPickup') ?></option>
                            <option value="PickedUp"><?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PickedUp') ?></option>
                            <option value="RefusedPickup"><?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_RefusedPickup') ?></option>
                            <option value="Cancel"><?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Cancelled') ?></option>
                            <option value="Refund"><?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Refunded') ?></option>
                        </select>
                    </label>
                    <div class="clear"></div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div id="js-ml-modal-changeShippingStatusWarningBatchUpdate" style="display:none;" title="<?php echo $templateHeader; ?>">
    <div style="width: 100%; margin-bottom: 0.25rem" id="changeShippingStatusBatchUpdate">
        <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_NewShippingStatusBatchUpdateContainer') ?>
        <p style="font-weight: normal" id="unprocessableOrdersToBatchUpdate">
        </p>
    </div>
</div>
<div id="js-ml-modal-cancelOrRefundBatchUpdate" style="display:none;" title="<?php echo $templateHeader; ?>">
    <div style="display: flex; flex-wrap: wrap; flex-direction: column">
        <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_NewShippingStatusBatchUpdateContainerCancelOrRefund') ?>
        <label style="width: 100%; margin-bottom: 0.25rem" for="refundReasonSelectorBatchUpdate" id="refundReasonSelectorBatchUpdateLabel">
            <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_RefundReasonSelectorBatchUpdateLabel') ?>
        </label>
        <select id="refundReasonSelectorBatchUpdate">
            <?php foreach ($refundReasons as $reason => $text) { ?>
                <option value="<?php echo $reason; ?>"<?php if ($reason == '') {?> selected="selected"<?php } ?>><?php echo $text; ?></option>
            <?php } ?>
        </select>
        <label style="width: 100%; margin-bottom: 0.25rem" for="cancelReasonSelectorBatchUpdate" id="cancelReasonSelectorBatchUpdateLabel">
            <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CancelReasonSelectorBatchUpdateLabel') ?>
        </label>
        <select id="cancelReasonSelectorBatchUpdate">
            <?php foreach ($cancellationReasons as $reason => $text) { ?>
                <option value="<?php echo $reason; ?>"<?php if ($reason == '') {?> selected="selected"<?php } ?>><?php echo $text; ?></option>
            <?php } ?>
        </select>
        <p style="font-weight: normal" id="unprocessableOrdersToBatchUpdateCancelOrRefund">
        </p>
    </div>
</div>

<script>
    jqml(document).ready(function() {
        jqml("input:checkbox[id=selectAll]").change(function () {
            if (jqml("input:checkbox[class=js-mlFilter-activeRowCheckBox]:checked").length) {
                jqml('#executeSelectedAction').prop('disabled', false)
            } else {
                jqml('#executeSelectedAction').prop('disabled', true)
            }
        })
        jqml("input:checkbox[class=js-mlFilter-activeRowCheckBox]").change(function() {
            if (jqml("input:checkbox[class=js-mlFilter-activeRowCheckBox]:checked").length) {
                jqml('#executeSelectedAction').prop('disabled', false)
            } else {
                jqml('#executeSelectedAction').prop('disabled', true)
            }
        })

        jqml('#executeSelectedAction').click(function() {
            const orderIds = []
            const orderDetails = {}
            const errorMessages = []
            const newStatusVal = jqml('#newOrderStatusBatchUpdate option:selected').val();
            const newStatusText = jqml('#newOrderStatusBatchUpdate option:selected').text();
            jqml("input:checkbox[class=js-mlFilter-activeRowCheckBox]:checked").each(function(){
                let [orderId, orderItemId, currentStatus, currency, itemPriceAdj] = jqml(this).val().split('_')
                if(currentStatus === 'Cancelled') {
                    errorMessages.push({[orderId]:"<?php echo MLI18n::gi()->get('ML_Amazon_Bopis_OrderAlreadyCancelledHover')?>"})
                    return
                }
                if (currentStatus === 'Refunded') {
                    errorMessages.push({[orderId]:"<?php echo MLI18n::gi()->get('ML_Amazon_Bopis_OrderAlreadyRefundedHover')?>"})
                    return
                }
                if('Open' === currentStatus && newStatusVal === 'Refund') {
                    errorMessages.push({[orderId]:"<?php echo MLI18n::gi()->get('ML_Amazon_Bopis_CantRefundOrderHover') ?>"})
                    return
                }
                if('Open' !== currentStatus && newStatusVal === 'Cancel') {
                    errorMessages.push({[orderId]:"<?php echo MLI18n::gi()->get('ML_Amazon_Bopis_CantCancelOrderHover')?>".replace('{#currentStatus#}', currentStatus)})
                    return
                }
                orderIds.push(orderId);
                orderDetails[orderId] = {'AmazonOrderItemID':orderItemId, 'Currency':currency, 'ItemPriceAdj':itemPriceAdj};
            });
            sendStatusToApi(newStatusVal, newStatusText, orderDetails, orderIds, errorMessages)
        });

        const sendStatusToApi = function(newStatusVal, newStatusText, orderDetails, orderIds, errorMessages) {
            let url;
            let dataObj;
            let modal;
            let selectorExtension = '';
            if(['Cancel', 'Refund'].includes(newStatusVal)) {
                selectorExtension = 'CancelOrRefund'
                modal = 'js-ml-modal-cancelOrRefundBatchUpdate'
            } else {
                modal = 'js-ml-modal-changeShippingStatusWarningBatchUpdate'
            }
            if(orderIds.length) {
                jqml('#newShippingStatusBatchUpdate'+selectorExtension).text('"'+newStatusText+'"');
                if(newStatusVal === 'Cancel') {
                    jqml('#refundReasonSelectorBatchUpdateLabel').hide();
                    jqml('#refundReasonSelectorBatchUpdate').hide();
                } else {
                    jqml('#cancelReasonSelectorBatchUpdateLabel').hide();
                    jqml('#cancelReasonSelectorBatchUpdate').hide();
                }
                const orderIdList = jqml('<ul>', ).append(
                    orderIds.map(orderId =>
                        jqml("<li>").text(orderId)
                    )
                )
                jqml('#allOrdersToBatchUpdate'+selectorExtension).append(orderIdList);
            } else {
                jqml('#newShippingStatusBatchUpdateContainer'+selectorExtension).children().hide()
                jqml('#allOrdersToBatchUpdate'+selectorExtension).hide()
                jqml('#cancelReasonSelectorBatchUpdateLabel').hide();
                jqml('#cancelReasonSelectorBatchUpdate').hide();
                jqml('#refundReasonSelectorBatchUpdateLabel').hide();
                jqml('#refundReasonSelectorBatchUpdate').hide();
            }
            if (errorMessages.length) {
                const unprocessableOrderIdList =
                    jqml('<p>' ).text("<?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_UnprocessableOrderIdListLabel') ?>").append(
                        jqml('<ul>', ).append(
                            errorMessages.map(error => {
                                console.log(error)
                                const orderId = Object.keys(error)[0]
                                return jqml("<li>").text(orderId).prop('title', error[orderId]).tooltip()
                            }
                        )
                    )
                )
                jqml('#unprocessableOrdersToBatchUpdate'+selectorExtension).append(unprocessableOrderIdList);
            }
            var eModal = jqml('#'+modal);
            eModal.dialog({
                modal: true,
                width: '600px',
                buttons: [
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                        click: function () {
                            jqml(eModal).dialog("close");
                            jqml('#allOrdersToBatchUpdate'+selectorExtension).children("ul").remove()
                            jqml('#unprocessableOrdersToBatchUpdate'+selectorExtension).children("p").remove()
                            jqml('#newShippingStatusBatchUpdateContainer'+selectorExtension).children().show()
                            jqml('#allOrdersToBatchUpdate'+selectorExtension).show()
                            jqml('#cancelReasonSelectorBatchUpdateLabel').show();
                            jqml('#cancelReasonSelectorBatchUpdate').show();
                            jqml('#refundReasonSelectorBatchUpdateLabel').show();
                            jqml('#refundReasonSelectorBatchUpdate').show();
                            return false
                        }
                    },
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                        click: function () {
                            if (['Cancel', 'Refund'].includes(newStatusVal)) {
                                url = '<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'CancelOrRefundOrder', 'kind' => 'ajax')) ?>'
                                dataObj = {
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AmazonOrderID'); ?>': orderIds,
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AmazonOrderDetails'); ?>': orderDetails,
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AdjustmentReasonCode'); ?>': jqml('#'+newStatusVal.toLowerCase()+'ReasonSelectorBatchUpdate option:selected').val(),
                                    '<?php echo MLHttp::gi()->parseFormFieldName('BopisAction'); ?>': newStatusVal.toLowerCase()
                                }
                            } else {
                                url = '<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'UpdateShippingStatus', 'kind' => 'ajax')) ?>'
                                dataObj = {
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AmazonOrderID'); ?>': orderIds,
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AmazonOrderDetails'); ?>': orderDetails,
                                    '<?php echo MLHttp::gi()->parseFormFieldName('ShipmentStatus'); ?>': newStatusVal,
                                }
                            }
                            jqml.ajax({
                                type: "POST",
                                url: url,
                                data: dataObj
                            }).then(
                                function (data) {
                                    jqml.unblockUI();
                                    let error = false;
                                    try {
                                        data = jqml.parseJSON(data);
                                        error = data.Status === 'ERROR'
                                    } catch (e) {
                                        console.log(e);
                                        error = true;
                                    }
                                    if (error) {
                                        jqml('<div></div>')
                                            .attr('title', '<?php echo $this->__s('ML_AMAZON_ERROR_BOPIS_ORDERSTATUS_UPDATE_FAILED_HEADLINE', array('\'', "\n", "\r")) ?>')
                                            .html('<?php echo $this->__s('ML_AMAZON_ERROR_BOPIS_ORDERSTATUS_UPDATE_FAILED_TEXT', array('\'', "\n", "\r"));  ?>')
                                            .jDialog();
                                    }
                                    jqml(eModal).dialog("close");
                                    jqml('#allOrdersToBatchUpdate'+selectorExtension).children("ul").remove()
                                    jqml('#unprocessableOrdersToBatchUpdate'+selectorExtension).children("p").remove()
                                    jqml('#newShippingStatusBatchUpdateContainer'+selectorExtension).children().show()
                                    jqml('#allOrdersToBatchUpdate'+selectorExtension).show()
                                    jqml('#cancelReasonSelectorBatchUpdateLabel').show();
                                    jqml('#cancelReasonSelectorBatchUpdate').show();
                                    jqml('#refundReasonSelectorBatchUpdateLabel').show();
                                    jqml('#refundReasonSelectorBatchUpdate').show();
                                }
                            );
                        }
                    }
                ]
            });
        }
    });
</script>
