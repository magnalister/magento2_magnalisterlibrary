<?php
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */

$sMpId = MLModule::gi()->getMarketPlaceId();
$sMpName = MLModule::gi()->getMarketPlaceName();

$sUrlPrefix = "{$sMpName}:{$sMpId}_";
$sI18nPrefix = 'ML_'.ucfirst($sMpName).'_';
?>
<div class="ml-container-action-head">
    <h4>
        <?php echo $this->__('ML_LABEL_ACTIONS') ?>
    </h4>
</div>
<div class="ml-container-action">
    <div class="ml-container-inner ml-container-sm">
        <a class="mlbtn-gray backbtn" href="<?php echo $this->getUrl(array('controller' => "{$sUrlPrefix}shippinglabel_upload_form")); ?>">
            <?php echo $this->__('ML_BUTTON_LABEL_BACK') ?>
        </a>
    </div>
    <div class="ml-container-inner ml-container-md">
        <button class="mlbtn-red action" type="submit" ><?php echo sprintf($this->__('form_action_wizard_save'), $this->__("{$sI18nPrefix}Shippinglabel_Upload_Summary")); ?></button>
    </div>
</div>
<div class="spacer"></div>