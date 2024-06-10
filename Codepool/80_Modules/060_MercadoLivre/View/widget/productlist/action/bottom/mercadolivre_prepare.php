<?php

/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <table class="actions">
        <tbody class="firstChild">
        <tr>
            <td>
                <div class="actionBottom">
                    <div class="left">
                        <div>
                            <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                                <?php } ?>
                                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('view') ?>" value="unprepare"/>
                                <input class="mlbtn" type="submit" value="<?php echo $this->__('ML_EBAY_BUTTON_UNPREPARE') ?>">
                            </form>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </td>
            <td>
                <div class="actionBottom">
                    <div class="right">
                        <a class="mlbtn action" href="<?php echo $this->getUrl(array('controller' => $this->getRequest('controller').'_form')); ?>">
                            <?php echo $this->__('ML_EBAY_LABEL_PREPARE') ?>
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
                </td>
            </tr>
        </tbody>
    </table>
<?php }