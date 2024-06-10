<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    $aPrices = $this->getMarketplacePrice($oProduct);
    foreach ($aPrices as $iKey => $aPrice) {

        if ($iKey > 0) {
            echo '<br>';
        }
        ?>

        <span style="<?php echo isset($aPrice['style']) ? $aPrice['style'] : ''; ?>">
        <?php
        echo $aPrice['price'];
        ?>
    </span>
        <?php
    }
}
