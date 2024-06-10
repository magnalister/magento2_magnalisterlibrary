<?php 
/**
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

    /* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
    /* @var $oList ML_Productlist_Model_ProductList_Abstract */
    /* @var $oProduct ML_Shop_Model_Product_Abstract */
     if (!class_exists('ML', false))
         throw new Exception();
    $aStatus = array(
        'Open' => array(
            'text'  => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Open'),
            'color' => 'black'
        ),
        'ReadyForPickup' => array(
            'text'  => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ReadyForPickup'),
            'color' => 'blue'
        ),
        'PickedUp' => array(
            'text'  => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PickedUp'),
            'color' => 'green'
        ),
//        'RefusedPickup' => array(
//            'text'  => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_RefusedPickup'),  --> NOT YET SUPPORTED BY AMAZON
//            'color' => 'red'
//        ),
//        'Refunded' => array(
//            'text'  => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Refunded'),       --> WE HAVE ACTION BUTTONS FOR THAT
//            'color' => 'red'
//        ),
//        'Cancelled' => array(
//            'text'  => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Cancelled'),      --> WE HAVE ACTION BUTTONS FOR THAT
//            'color' => 'red'
//        ),
    );

$templateHeader = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ChangeOrderStatus_Header');
$templateBody = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ChangeOrderStatus_Body');
?>

<table>
    <tr>
        <td >
            <div title="orderActions">
                <label>
                    <?php if (!in_array($aOrder['OrderStatus'], array('Cancelled', 'Refunded'))) { ?>
                        <select id="orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>">
                            <?php foreach ($aStatus as $id => $status) {
                                if(in_array($status['text'], array('Cancelled', 'Refunded'))) continue;?>
                                <option value="<?php echo $id; ?>"<?php if ($status['text'] == $aStatus[$aOrder['OrderStatus']]['text']) {?> selected="selected"<?php } ?>><?php echo $status['text']; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else {?>
                        <p style="color:indianred; font-weight: bold; text-align: center"><?php echo $aStatus[$aOrder['OrderStatus']]['text']; ?></p>
                    <?php } ?>
                </label>
            </div>
            <div id="js-ml-modal-changeShippingStatusWarning_<?php echo $aOrder['AmazonOrderID']?>" style="display:none;" title="<?php echo $templateHeader; ?>">
                <div style="width: 100%; margin-bottom: 0.25rem" id="changeShippingStatus_<?php echo $aOrder['AmazonOrderID']?>">
                    <?php echo $templateBody; ?>
                    <ul>
                        <li>
                            <?php echo $aOrder['AmazonOrderID']?>
                        </li>
                    </ul>
                    <div style="display: flex" >
                        <p >
                            <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NewShippingStatusSingleUpdateContainerFirstPart') ?>
                        </p>
                        <p id="oldShippingStatus_<?php echo $aOrder['AmazonOrderID']?>" style="font-weight: bold; margin-left : 4px ;margin-right: 4px">
                            "<?php echo $aStatus[$aOrder['OrderStatus']]['text']; ?>"
                        </p>
                        <p >
                            <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NewShippingStatusSingleUpdateContainerSecondPart') ?>
                        </p>
                        <p id="newShippingStatus_<?php echo $aOrder['AmazonOrderID']?>" style="font-weight: bold; margin-left : 4px ;margin-right: 4px">
                        </p>
                        <p>
                            <?php echo MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NewShippingStatusSingleUpdateContainerThirdPart') ?>
                        </p>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>

<script>
    jqml(document).ready(function() {
        jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','<?php echo $aStatus[$aOrder['OrderStatus']]['color']?>');
        jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').change(function() {
            var current = jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').val();
            console.log(current)
            switch(current) {
                case 'Open':
                    jqml('#<?php echo $aOrder['BopisAction']."_".$aOrder['AmazonOrderID']?>').val('');
                    jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','black');
                    break;
                case 'ReadyForPickup':
                    jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','blue');
                    sendStatusToApi('ReadyForPickup', '<?php echo $aOrder['AmazonOrderID']?>')
                    break;
                case 'PickedUp':
                    jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','green');
                    sendStatusToApi('PickedUp', '<?php echo $aOrder['AmazonOrderID']?>')
                    break;
                case 'RefusedPickup':
                    jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','red');
                    sendStatusToApi('RefusedPickup', '<?php echo $aOrder['AmazonOrderID']?>')
                    break;
                default:
                    jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','black');
            }
        });

        const sendStatusToApi = function(status, orderId) {
            var newStatus = jqml('#orderStatusSelector_'+orderId+' option:selected').text();
            jqml('#newShippingStatus_'+orderId).text('"'+newStatus+'"');
            var eModal = jqml('#js-ml-modal-changeShippingStatusWarning_<?php echo $aOrder['AmazonOrderID']?>');
            eModal.dialog({
                modal: true,
                width: '600px',
                buttons: [
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                        click: function () {
                            jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>')
                                .prop("selectedIndex", '<?php echo array_search($aOrder['OrderStatus'],array_keys($aStatus)); ?>')
                            jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','<?php echo $aStatus[$aOrder['OrderStatus']]['color']?>');
                            jqml(this).dialog("close")
                            return false
                        }
                    },
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                        click: function () {
                            let requestData = <?php echo json_encode(array_merge(
                                MLHttp::gi()->getNeededFormFields(),
                                array(
                                    MLHttp::gi()->parseFormFieldName('AmazonOrderID') => $aOrder['AmazonOrderID'],
                                    MLHttp::gi()->parseFormFieldName('AmazonOrderDetails') => array(
                                        $aOrder['AmazonOrderID'] => array(
                                            'AmazonOrderItemID' => $aOrder['AmazonOrderItemID'],
                                            'Currency' => $aOrder['Currency']
                                        )
                                    ),
                                )
                            )); ?>;
                            requestData['<?php echo MLHttp::gi()->parseFormFieldName('ShipmentStatus'); ?>'] = status;

                            jqml.ajax({
                                type: "POST",
                                url: '<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'UpdateShippingStatus', 'kind' => 'ajax')) ?>',
                                data: requestData
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
                                        jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>')
                                            .prop("selectedIndex", '<?php echo array_search($aOrder['OrderStatus'],array_keys($aStatus)); ?>')
                                        jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').css('color','<?php echo $aStatus[$aOrder['OrderStatus']]['color']?>');
                                        const action = '<?php echo $aOrder['OrderStatus'] === 'Open' ? 'Cancel' : 'Refund' ?>'
                                        jqml('#'+action.toLowerCase()+'<?php echo "_".$aOrder['AmazonOrderID']?>').text(action)
                                        jqml('<div></div>')
                                            .attr('title', '<?php echo $this->__s('ML_AMAZON_ERROR_BOPIS_ORDERSTATUS_UPDATE_FAILED_HEADLINE', array('\'', "\n", "\r")) ?>')
                                            .html('<?php echo $this->__s('ML_AMAZON_ERROR_BOPIS_ORDERSTATUS_UPDATE_FAILED_TEXT', array('\'', "\n", "\r"));  ?>')
                                            .jDialog();
                                    }
                                    jqml(eModal).dialog("close");
                                }
                            );
                        }
                    }
                ]
            });
        }
    });
</script>



