<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <div>
        <?php if ($sUrl = $oProduct->getImageUrl()) { ?>
            <img src="<?php echo $sUrl ?>" title="<?php echo htmlentities($oProduct->getName()) ?>" alt="<?php echo htmlentities($oProduct->getName()) ?>"/>
        <?php } else { ?>
            <img src="<?php echo MLHttp::gi()->getResourceUrl('images/noimage.png') ?>" title="<?php echo $this->__('Productlist_Cell_sNoImage') ?>" alt="<?php echo $this->__('Productlist_Cell_sNoImage') ?>"/>
        <?php } ?>
    </div>
<?php } 