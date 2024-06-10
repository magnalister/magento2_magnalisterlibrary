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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
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
    $sKey = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value');
    if (count(MLMessage::gi()->getObjectMessages($oProduct)) > 0) {
        foreach (MLMessage::gi()->getObjectMessages($oProduct) as $sMessage) {
            $listOfWarningsMessages[] = $sMessage;
        }
    }
    $sVariantMessage = $this->includeViewBuffered('widget_productlist_list_variantarticleerror', array('oProduct' => $oProduct, 'oList' => $oList));
    if (!empty($sVariantMessage)) {
        $listOfWarningsMessages[] = $sVariantMessage;
    }
    ?>

    <div class="hideChild">
        <div class="name"><?php echo $oProduct->setProductlistMode(true)->getName() ?></div>
        <?php $sSku = $oProduct->getProductlistSku(); ?>
        <?php $iProductId = $oProduct->get('MarketplaceIdentId'); ?>
        <div class="artNr" <?php echo $sSku === '' ? 'style="color:#e31a1c"' : ''; ?>><?php echo $this->__('Productlist_Header_sSku').': '.$sSku ?></div>
        <?php if ($sKey === 'pID') { ?>
            <div class="ml-product-id"><?php echo $this->__('ML_LABEL_PRODUCT_ID').': '.$iProductId ?></div>
        <?php } ?>
        <?php if (count($listOfWarningsMessages) > 0) { ?>
            <div class="warning-wrapper">
                <?php foreach ($listOfWarningsMessages as $warningKey => $warningMessage) { ?>
                    <div class="ml-warning <?php echo $warningKey ?>" title="<?php echo $this->__($warningMessage) ?>"></div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="product-link childToHide">
            <a class="ml-js-noBlockUi" href="<?php echo $oProduct->getEditLink() ?>" target="_blank"><span><?php echo $this->__('Productlist_Cell_sEditProduct') ?></span></a>
        </div>
    </div>
<?php } ?>