<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <div class="ml-container-action-head">
        <h4>
            <?php echo $this->__('ML_LABEL_ACTIONS') ?>
        </h4>
    </div>
    <div class="ml-container-action">
        <div class="ml-container-inner ml-container-md"></div>
        <div class="ml-container-inner ml-container-md">
            <form class="right" action="<?php echo $this->getCurrentUrl() ?>" method="post"
                  title="<?php echo MLI18n::gi()->ML_STATUS_FILTER_SYNC_ITEM ?>">
                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                <?php } ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>"
                       value="checkinAdd"/>
                <input type="submit" value="<?php echo $this->__('ML_BUTTON_LABEL_CHECKIN_ADD') ?>"
                       class="ml-js-noBlockUi js-marketplace-upload mlbtn-red action"/>
            </form>
            <form class="right" action="<?php echo $this->getCurrentUrl() ?>" method="post"
                  title="<?php echo MLI18n::gi()->ML_STATUS_FILTER_SYNC_ITEM ?>">
                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                <?php } ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>"
                       value="checkinPurge"/>
                <input type="submit"
                       value="<?php echo $this->__('ML_BUTTON_LABEL_CHECKIN_PURGE') ?>"
                       class="ml-js-noBlockUi js-marketplace-upload mlbtn-gray"/>
            </form>
        </div>
    </div>
    <div class="spacer"></div>
    <?php $this->includeView('widget_upload_ajax', array(
            'sProcess'  => $this->__('ML_STATUS_FILTER_SYNC_CONTENT'),
            'sError'  => $this->__('ML_ERROR_SUBMIT_PRODUCTS'),
            'sSuccess'  => $this->__('ML_STATUS_FILTER_SYNC_SUCCESS'),
            'sInfo' => $this->__('cdiscount_upload_explanation'))
    ); ?>
<?php }