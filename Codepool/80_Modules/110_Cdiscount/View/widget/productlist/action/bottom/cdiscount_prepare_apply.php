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
        <div class="ml-container-inner ml-container-wd">
            <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                <?php } ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('execute') ?>" value="unprepare"/>
                <input class="mlbtn-gray fullWidth" type="submit" value="<?php echo $this->__('ML_EBAY_BUTTON_UNPREPARE'); ?>">
            </form>
            <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                <?php } ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('execute') ?>" value="resetdescription" />
                <input class="mlbtn-gray fullWidth" type="submit" value="<?php echo $this->__('ML_EBAY_BUTTON_RESET_DESCRIPTION')?>">
            </form>
        </div>
        <div class="ml-container-inner ml-container-sm">
            <a class="mlbtn-red action" href="<?php echo $this->getUrl(array('controller' => $this->getRequest('controller') . '_form')); ?>">
                <?php echo $this->__('ML_AMAZON_BUTTON_PREPARE') ?>
            </a>
        </div>
    </div>
    <div class="spacer"></div>
<?php } ?>
<?php
