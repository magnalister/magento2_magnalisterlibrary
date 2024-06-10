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
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    $listOfWarningsMessages = $oList->isPreparedDifferently($oProduct);
    $sku = $oProduct->getSku();
    $existingPreparedProduct = MLDatabase::getDbInstance()->fetchArray(
        'SELECT * FROM magnalister_googleshopping_prepare where offerId="' . $sku.'"')[0];
    ?>
    <div class="hideChild">
        <div class="name"><?php echo $existingPreparedProduct ? $existingPreparedProduct['title'] : $oProduct->getName() ?></div>
        <div class="artNr"><?php echo $this->__('Productlist_Header_sSku').': '.$oProduct->getSku()?></div>
        <?php if (count($listOfWarningsMessages) > 0) { ?>
            <div class="warning-wrapper">
                <?php foreach ($listOfWarningsMessages as $warningKey => $warningMessage) { ?>
                    <div class="ml-warning <?php echo $warningKey ?>" title="<?php echo $this->__($warningMessage)?>"></div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if(explode('_',$this->getCurrentUrl())[1] !== 'checkin'){ ?>
        <div class="product-link childToHide">
            <a class="ml-js-noBlockUi" href="<?php echo $oProduct->getEditLink() ?>" target="_blank"><span><?php echo $this->__('Productlist_Cell_sEditProduct')?></span></a>
        </div>
    <?php } ?>
    </div>
<?php } ?>