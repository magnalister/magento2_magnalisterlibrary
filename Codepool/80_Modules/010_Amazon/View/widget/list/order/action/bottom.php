<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?>

                        

        <table class="actions">
            <tbody class="firstChild">
                <tr>
                    <td>
                        <div class="actionBottom">
                            <a class="mlbtn action right" href="<?php
                            $sMpId = MLModule::gi()->getMarketPlaceId();
                            $sMpName = MLModule::gi()->getMarketPlaceName();
                                                echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_shippinglabel"));
                                                ?>">
                               <?php echo $this->__('form_action_wizard_save') ?>
                            </a>
                            <a class="mlbtn ml-js-config-reset right" href="<?php
                            $sMpId = MLModule::gi()->getMarketPlaceId();
                            $sMpName = MLModule::gi()->getMarketPlaceName();
                                                echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_shippinglabel"));
                                                ?>">
                               <?php echo $this->__('ML_BUTTON_LABEL_BACK') ?>
                            </a>
                            <div class="clear"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>