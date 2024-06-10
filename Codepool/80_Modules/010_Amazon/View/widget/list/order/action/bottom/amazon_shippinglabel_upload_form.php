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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
     throw new Exception();
?>
<?php
/* @var $this ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Form|ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Summary|ML_Amazon_Controller_Amazon_ShippingLabel_Upload_ShippingMethod */
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
        <a class="mlbtn-gray backbtn right" href="<?php echo $this->getUrl(array('controller' => "{$sUrlPrefix}shippinglabel_upload_orderlist")); ?>"><?php echo $this->__('ML_BUTTON_LABEL_BACK') ?></a>
    </div>
    <div class="ml-container-inner ml-container-wd">
        <button class="mlbtn-red action right" type="submit" ><?php echo sprintf($this->__('form_action_wizard_save'), $this->__("{$sI18nPrefix}Shippinglabel_Upload_Shippingmethod")); ?></button>
    </div>
</div>
<div class="spacer"></div>
