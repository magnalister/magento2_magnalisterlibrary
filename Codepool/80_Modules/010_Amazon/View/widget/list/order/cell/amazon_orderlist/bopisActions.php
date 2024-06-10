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

    $templateHeaderReplace = '';
    $templateBodyReplace = '';
    $reasons = array();
    if ($aOrder['OrderStatus'] === 'Open') {
        $aOrder['BopisAction'] = array('id'=> 'cancel','text' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Cancel'));
        $templateHeaderReplace = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_CancellationVerb');
        $templateBodyReplace = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_CancellationNoun');
        $reasons = array(
            'NoInventory' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NoInventory'),
            'GeneralAdjustment' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_GeneralAdjustment'),
            'ShippingAddressUndeliverable' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ShippingAddressUndeliverable'),
            'CustomerExchange' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CustomerExchange'),
            'BuyerCanceled' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_BuyerCanceled'),
            'PriceError' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PriceError')
        );
    }  else if($aOrder['OrderStatus'] === 'Cancelled') {
        $aOrder['BopisAction'] = array('id'=> 'cancel','text' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Cancelled'));
    }  else if($aOrder['OrderStatus'] ===  'Refunded') {
        $aOrder['BopisAction'] = array('id'=> 'refund','text' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Refunded'));
    } else {
        $aOrder['BopisAction'] = array('id'=> 'refund','text' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_RefundVerb'));
        $templateHeaderReplace = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_RefundVerb');
        $templateBodyReplace = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_RefundNoun');
        $reasons = array(
            'NoInventory' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_NoInventory'),
            'CustomerReturn' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CustomerReturn'),
            'GeneralAdjustment' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_GeneralAdjustment'),
            'CouldNotShip' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CouldNotShip'),
            'DifferentItem' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_DifferentItem'),
            'Abandoned' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Abandoned'),
            'CustomerCancel' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_CustomerCancel'),
            'PriceError' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PriceError')
        );
    }




    $templateHeader = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_TemplateHeader').' '.$templateHeaderReplace;
    $templateBody = MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_TemplateBody').' '.$templateBodyReplace.":";
?>
<table>
    <tr>
        <td >
            <div title="orderActions">
                <button class="mlbtn" id="<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>" <?php echo in_array($aOrder['OrderStatus'], array('Cancelled', 'Refunded')) ? 'disabled':''?>>
                    <?php echo ucfirst($aOrder['BopisAction']['text']); ?>
                </button>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div id="js-ml-modal-cancelOrRefund_<?php echo $aOrder['AmazonOrderID']?>" style="display:none;" title="<?php echo $templateHeader; ?>">
                <div style="display: flex; flex-wrap: wrap">
                    <label style="width: 100%; margin-bottom: 0.25rem" for="cancelOrRefundReasonSelector_<?php echo $aOrder['AmazonOrderID']?>"><?php echo $templateBody; ?></label>
                    <select id="cancelOrRefundReasonSelector_<?php echo $aOrder['AmazonOrderID']?>">
                        <?php foreach ($reasons as $reason => $text) { ?>
                            <option value="<?php echo $reason; ?>"<?php if ($reason == '') {?> selected="selected"<?php } ?>><?php echo $text; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </td>
    </tr>
</table>

<script type="text/javascript">
    jqml(document).ready(function() {
        jqml('#<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>').click(function(e) {
            e.preventDefault();
            var eModal = jqml('#js-ml-modal-cancelOrRefund_<?php echo $aOrder['AmazonOrderID']?>');
            eModal.dialog({
                modal: true,
                width: '600px',
                buttons: [
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                        click: function () {
                            console.log(jqml('#cancelOrRefundReasonSelector_<?php echo $aOrder['AmazonOrderID']?>').val())
                            jqml(this).dialog("close");
                            return false;
                        }
                    },
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                        click: function () {
                            jqml.ajax({
                                type: "POST",
                                url: '<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'CancelOrRefundOrder', 'kind' => 'ajax')) ?>',
                                data: {
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AmazonOrderID'); ?>': '<?php echo $aOrder['AmazonOrderID']?>',
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AmazonOrderDetails'); ?>': JSON.parse('<?php echo json_encode(array($aOrder['AmazonOrderID'] => array('AmazonOrderItemID' => $aOrder['AmazonOrderItemID'], 'Currency' => $aOrder['Currency'], 'ItemPriceAdj' => $aOrder['ItemPriceAdj'])))?>'),
                                    '<?php echo MLHttp::gi()->parseFormFieldName('AdjustmentReasonCode'); ?>': jqml('#cancelOrRefundReasonSelector_<?php echo $aOrder['AmazonOrderID']?> option:selected').val(),
                                    '<?php echo MLHttp::gi()->parseFormFieldName('BopisAction'); ?>': '<?php echo $aOrder['BopisAction']['id']?>'
                                }
                            }).then(
                                // resolve/success callback
                                function(response)
                                {
                                    console.log(response)
                                    jqml(eModal).dialog("close");
                                    return false;
                                },
                                // reject/failure callback
                                function()
                                {
                                    alert('There was some error!');
                                }
                            );
                        }
                    }
                ]
            });
        });
        jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').change(function() {
            var current = jqml('#orderStatusSelector_<?php echo $aOrder['AmazonOrderID']?>').val();
            switch(current) {
                case 'Open':
                    jqml('#<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>').text(<?php MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Cancel')?>);
                    break;
                case 'Ready For Pickup':
                    jqml('#<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>').text(<?php MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Refund')?>);
                    break;
                case 'Picked Up':
                    jqml('#<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>').text(<?php MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Refund')?>);
                    break;
                case 'Refused Pickup':
                    jqml('#<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>').text(<?php MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Refund')?>);
                    break;
                default:
                    jqml('#<?php echo $aOrder['BopisAction']['id']."_".$aOrder['AmazonOrderID']?>').text(<?php MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Action_Cancel')?>);
            }
        });
    });
</script>
