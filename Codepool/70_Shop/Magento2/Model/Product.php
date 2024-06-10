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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

use Magento\Config\Model\Config\Backend\Admin\Custom;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\TestFramework\Helper\Bootstrap;

class ML_Magento2_Model_Product extends ML_Shop_Model_Product_Abstract {

    /**
     * Object of single product or master product of a variant product
     * @var Magento\Catalog\Model\Product
     */
    protected $oProduct;


    /**
     * It is filled in $this->getCorrespondingProduct, it could contain object of a single, master or variant product, depends on loading data from magnalister_products
     * @var Magento\Catalog\Model\Product
     */
    protected $oRealProduct = null;

    /**
     * array of Mage_Catalog_Model_Product
     * @var array $aMagentoProducts
     */
    protected static $aMagentoProducts = array();

    /**
     * cache for method createModelProductByMarketplaceSku
     * @var array
     */
    protected static $aCreatedModelProductByMarketplaceSku = array();

    /**
     * @return $this|ML_Shop_Model_Product_Abstract
     * @throws Exception
     */
    protected function loadShopProduct() {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productRepository = $objectManager->get('\Magento\Catalog\Model\ProductRepository');
        if ($this->oProduct === null) {//not loaded

            $this->oProduct = false; //not null
            if ($this->get('parentid') == 0) {
                $oProduct = $this;
            } else {
                $oProduct = $this->getParent();
            }

            $sKey = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value');
            if ($sKey == 'pID') {
                $oShopProduct = $productRepository->getById($oProduct->get('productsid'));
            } else {
                $oShopProduct = null;
                if ($oProduct->get('productssku') != null) {
                    $oShopProduct = $productRepository->get($oProduct->get('productssku'));
                    if (!is_object($oShopProduct)) {
                        $oShopProduct = null;
                    }
                }
            }

            if (!($oShopProduct instanceof \Magento\Catalog\Model\Product) && $this->get('id') !== 0) { // $this->get('id')!== 0 because of OldLib/php/modules/amazon/application/applicationviews.php line 556
                $iId = $this->get('id').' + '.$oProduct->get('productsid');
                $this->delete();
                MLMessage::gi()->addDebug('One of selected product was deleted from shop now it is deleted from magnalister list too, please refresh the page : '.$iId);
                throw new Exception;
            }

            $this->oProduct = $oShopProduct;
            $aData = $this->get('shopdata');
            if (!isset($aData['variationObject'])) {
                if (isset($aData['variation_id'])) {
                    //$variantsUsed = $this->getMagentoProduct($aData['variation_id'])->getTypeInstance()->getUsedProducts($this->oProduct);
                    $variantsUsed = $this->getMagentoProduct($aData['variation_id']);
                    /*foreach ($variantsUsed as $aRow) {
                        $aData['variationObject'] = $aRow;
                    }*/
                    $aData['variationObject'] = $variantsUsed;
                } else {
                    $aData['variationObject'] = $this->oProduct;
                }
            }
            // kint::dump($this->oProduct->getId());
            if ($this->get('parentid') != 0) {//is variant
                $this->loadByShopProduct($oShopProduct, $this->get('parentid'), $aData);
            }
        }
        return $this;
    }

    /**
     * @param Magento\Catalog\Model\Product $oShopProductIDCriteria
     * @param $oProduct
     * @return mixed
     */
    protected function getMagentoProduct($iProductID) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $oShopProduct = $objectManager->create('Magento\Catalog\Model\Product')->load($iProductID);
        return $oShopProduct;
    }

    /**
     * @return $this
     * @throws MLAbstract_Exception
     */
    protected function loadShopVariants() {
        $aVariant['variationObject'] = $this->oProduct;
        if ($this->oProduct->getTypeId() != 'configurable') {
            //Adding a Magento simple product for second time to the magnalister_product table, the single product should also have a variant in the magnalister_product table
            $aVariant['variation_id'] = $this->oProduct->getId();
            $aVariant['variationObject'] = $this->oProduct;
            $aVariant['info'][] = array();
            $this->addVariant(
                MLProduct::factory()->loadByShopProduct($this->oProduct, $this->get('id'), $aVariant)
            );
        } else {
            // configurable product type
            $variantsUsed = $this->oProduct->getTypeInstance()->getUsedProducts($this->oProduct);

            foreach ($variantsUsed as $aRow) {
                $aVariant = array();
                $aVariant['variation_id'] = $aRow->getId();
                $aVariant['info'][] = array('name' => '', 'value' => '');
                $aVariant['variationObject'] = $aRow;
                if (isset($aVariant['variation_id'])) {
                    $this->addVariant(
                        MLProduct::factory()->loadByShopProduct($this->oProduct, $this->get('id'), $aVariant)
                    );
                }
            }
        }

        return $this;
    }

    /**
     * @param $oProduct Mage_Catalog_Model_Product
     * @return $this
     */
    public function setProduct($oProduct) {
        if (
            !is_object($this->oProduct)
            || $oProduct->getId() != $this->oProduct->getId()
        ) {
            $this->aMessages = array();
            $this->aProductsConfig = array();
            $this->oProduct = $oProduct;
        }
        return $this;
    }

    /**
     * @param ProductEntity $mProduct
     * @param int $iParentId parent id in magnalister_products
     * @param null $mData
     * @return $this|mixed
     * @throws Exception
     */
    public function loadByShopProduct($mProduct, $iParentId = 0, $mData = null) {
        $this->oProduct = $mProduct;
        /* for product who have no reference number ,random reference is inserted because it will made problem when product key is Article number */
        $sKey = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value');
        if($sKey == 'pID' ){
            $sProductKeyField = 'marketplaceidentid';
        }else{
            //here we use productssku instead of marketplaceidentsku, because if product was single product and now it has several variants we can find old product with productssku
            $sProductKeyField = 'productssku';
        }
        $this->aKeys = array($sProductKeyField, 'parentid');
        $this->set('parentid', $iParentId);
        $sMessage = array();


        if ($iParentId == 0 ) {
            unset($mData['variationObject']);
            $sSku = $this->oProduct->getSku();
            // kint::dump($this->oProduct->getSku());
            $sSku = $sSku === null ? '' : $sSku;
            /* echo '<hr />';
             echo print_m($this->oProduct->getId());
             echo print_m($this->oProduct->getSKU());
             echo '<hr />';*/
            $this
                ->set('marketplaceidentid', $this->oProduct->getId())
                ->set('marketplaceidentsku', $sSku)
                ->set('productsid', $this->oProduct->getId())
                ->set("productssku", $sSku)
                ->set('shopdata', array())
                ->set('data', array('messages' => $sMessage))
                ->save()
                ->aKeys = array('id');
            self::addStaticProduct($this, $this->oProduct);
        } else {

            if (!isset($mData['variation_id'])) {
                throw new Exception('not key set for product variation');
            }

            $oVariation = $mData['variationObject'];
            unset($mData['variationObject']);

            $this
                ->set('marketplaceidentid', $oVariation->getId().'_'.$this->oProduct->getId())
                ->set('marketplaceidentsku', $oVariation->getSKU())
                ->set("productsid", $oVariation->getId())
                ->set("productssku", $oVariation->getSKU())
                //->set('shopdata', $mData)
                ->set('shopdata', $mData)
                ->set('data', array('messages' => $sMessage));
            if ($this->exists()) {
                $this->aKeys = array('id');
                $this->save();
            } else {
                $this->save()->aKeys = array('id');
            }
        }
        return $this;
    }
    /**
     *
     * @param ML_Shop_Model_Product_Abstract $oModel
     * @param Mage_Catalog_Model_Product $oProduct
     */
    protected static function addStaticProduct($oModel, $oProduct) {
        $oProduct->load($oProduct->getId());
        $sKey = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value') == 'pID' ? 'productsid' : 'productssku';
        self::$aMagentoProducts[$oModel->get($sKey)] = $oProduct;
    }
    static protected $createdObjectCache = array();


    /**
     *if there some problems, see getByMarketplaceSKU method of magneto_model_product
     * @param $sSku
     * @return array
     */
    public function createModelProductByMarketplaceSku($sSku) {
        $aOut = array('master' => null, 'variant' => null);
        $sSku = trim($sSku);
        if (empty($sSku)) {
            return $aOut;
        }
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productRepository = $objectManager->get('\Magento\Catalog\Model\ProductRepository');

        $oMyTable = MLProduct::factory();
        /* @var $oMyTable ML_Magento2_Model_Product */
        $oShopProduct = null;
        if (MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value') == 'pID') {
            $sIdent = 'marketplaceidentid';
            if (strpos($sSku, '_') !== false) {
                $aIds = explode("_", $sSku);
                if (is_numeric($aIds[1])) {
                    $oShopProduct = $productRepository->getById($aIds[1]);
                }
            } else if (is_numeric($sSku)) {
                $oShopProduct = $productRepository->getById($sSku);
            }

        } else {
            $sIdent = 'marketplaceidentsku';
            $oShopProduct = $productRepository->get($sSku);
        }

        if ($oShopProduct !== null) {
            if($oShopProduct->getTypeId() != 'configurable') {
                // we are adding only the first parent product
                // we do not handel multiple parent products at the moment
                $aParentIds = $objectManager->create('Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable')->getParentIdsByChild($oShopProduct->getId());
                if (isset($aParentIds[0])) {
                    $oShopProduct = $productRepository->getById($aParentIds[0]);
                }
            }
        }

        try {
            if ($oShopProduct != null && is_object($oShopProduct)) {
                $iShopProductId = $oShopProduct->getId();

                if (!isset(self::$createdObjectCache[$iShopProductId])) {
                    $oMyTable->loadByShopProduct($oShopProduct);
                    $oMyTable->getVariants();
                    self::$createdObjectCache[$iShopProductId]['master'] = $oMyTable;
                    foreach ($oMyTable->getVariants() as $oVariant) {
                        self::$createdObjectCache[$iShopProductId]['variants'][$oVariant->get($sIdent)] = $oVariant;
                    }
                }

                if (self::$createdObjectCache[$iShopProductId]['master']->get($sIdent) === $sSku) {
                    $aOut['master'] = self::$createdObjectCache[$iShopProductId]['master'];
                }
                //moein question: the $sSku is master product sku but here my varient has a diffrent sku and it never run the cindition

                if (isset(self::$createdObjectCache[$iShopProductId]['variants'][$sSku])) {
                    $aOut['variant'] = self::$createdObjectCache[$iShopProductId]['variants'][$sSku];
                }
            }
        } catch (Exception $ex) {
            MLMessage::gi()->addDebug($ex);
        }
        return $aOut;
    }

    /**
     * @param string $sSku
     * @param bool $blMaster
     * @return $this|ML_Shop_Model_Product_Abstract|ML_Magento2_Model_Product
     * @todo implementing later
     */
   /* public function getByMarketplaceSKU($sSku, $blMaster = false) {
        $aCreated = $this->createModelProductByMarketplaceSku($sSku);
        $this->init(true);
        if ($aCreated[$blMaster ? 'master' : 'variant'] instanceof ML_Shop_Model_Product_Abstract ) {
            $this->set('id', $aCreated[$blMaster ? 'master' : 'variant']->get('id'));
        }
        return $this;
    }*/

    /**
     * @return string
     */
    public function getShortDescription() {
        $this->load();
        return  $this->getCorrespondingProductEntity()->getShortDescription();
    }

    /**
     * @return string|string[]|null
     */
    public function getDescription() {
        $this->load();
        return  $this->getCorrespondingProductEntity()->getDescription();
    }

    /**
     * Return a url to edit product in admin panel of Magento 2
     * @return string
     * @throws Exception
     */
    public function getEditLink(): string {
        $this->load();
        $backendHelper = MLMagento2Alias::ObjectManagerProvider('\Magento\Backend\Helper\Data');
        return $backendHelper->getUrl(
            'catalog/product/edit',
            ['id' => $this->getCorrespondingProductEntity()->getId()]
        );
    }

    /**
     * return product front url
     * @return string
     */
    public function getFrontendLink() {
        $oUrlService = MLMagento2Alias::ObjectManagerProvider('\Magento\Framework\Url');
        $oShopProduct = $this->getCorrespondingProductEntity();
        if ($this->get('parentid') != 0 && !$oShopProduct->isVisibleInSiteVisibility()) {
            $aUrlQuery = $this->getVariatonDataOptinalField(array('url_query'));
            $sUrlQuery = implode ('&', $aUrlQuery);
            $url = $oUrlService->getUrl('catalog/product/view', ['id' => $this->getParent()->get('productsid'), '_nosid' => true]) . '#' . $sUrlQuery;
        } else {
            $url = $oUrlService->getUrl('catalog/product/view', ['id' => $oShopProduct->getId(), '_nosid' => true]);
        }

        return $url;
    }

    /**
     * @param int $iX
     * @param int $iY
     * @return array|string
     */
    public function getImageUrl($iX = 40, $iY = 40) {
        $this->load();
        $aImages = $this->getImages();
        return (empty($aImages)) ? '' : MLImage::gi()->resizeImage(current($aImages), 'products', $iX, $iY, true);
    }

    /**
     * @todo : checked amazon image
     * @return array|null
     */
    public function getImages() {
        $helperImport = MLMagento2Alias::ObjectManagerProvider('\Magento\Catalog\Api\ProductRepositoryInterface');
        $storeManager = MLMagento2Alias::ObjectManagerProvider('\Magento\Store\Model\StoreManagerInterface');
        $product = $helperImport->getById($this->getCorrespondingProductEntity()->getId());
        $images = $this->getCorrespondingProductEntity()->getMediaGalleryEntries();

        if ($this->aImages === null) {
            $this->load();
            $aImgs = array();
            $variationaImgs = array();
            if ($this->get('parentid') == 0) {
                //Parent Product
                $CoverImage = array();
                $CoverImage[] = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA). 'catalog/product' . $product->getData('image');
                foreach ($images as $image) {
                    $baseUrl = $product->getMediaConfig()->getBaseMediaUrl();
                    $imageUrl = $baseUrl . $image->getFile();
                    //Note: Images has been sorted by position
                    $aImgs[] = $imageUrl;
                }
                if ($this->getCorrespondingProductEntity()->getTypeId() == 'configurable') {
                    $variantsUsed = $this->getCorrespondingProductEntity()->getTypeInstance()->getUsedProducts($this->getCorrespondingProductEntity());
                    foreach ($variantsUsed as $aRow) {
                        $variationImages = $aRow->getMediaGalleryImages();
                        $variationProduct = $helperImport->getById($aRow->getId());

                        $variationaImgs[] = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA). 'catalog/product' . $variationProduct->getData('image');
                        foreach ($variationImages as $value) {
                            if ($variationProduct->getData('image') != $value->getFile()) {
                                $baseUrl = $variationProduct->getMediaConfig()->getBaseMediaUrl();
                                $variationImageUrl = $baseUrl . $value->getFile();
                                $variationaImgs[] = $variationImageUrl;
                            }
                        }
                    }
                }
                $aImgs = array_merge($CoverImage, $aImgs, $variationaImgs);
            } else {
                $CoverImage = array();
                $CoverImage[] = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA). 'catalog/product' . $product->getData('image');
                foreach ($images as $image) {
                    $baseUrl = $product->getMediaConfig()->getBaseMediaUrl();
                    $imageUrl = $baseUrl . $image->getFile();
                    //Note: Images has been sorted by position
                    $aImgs[] = $imageUrl;
                }
                $aImgs = array_merge($CoverImage, $aImgs);
            }
            $this->aImages = array_unique($aImgs);
        }

        return $this->aImages;
    }

    /**
     * @return string
     */
    public function getMetaDescription() {
        return  $this->getCorrespondingProductEntity()->getMetaDescription();
    }

    /**
     * @return string
     */
    public function getMetaKeywords() {
        return  $this->getCorrespondingProductEntity()->getMetaKeyword();
    }

    /**
     * @param $sFieldName
     * @param bool $blGeneral
     * @return \Doctrine\ORM\PersistentCollection|int|string|null
     * @throws Exception
     */
    public function getModulField($sFieldName, $blGeneral = false, $blMultiValue = false) {
        $this->load();
        if ($blGeneral) {
            $sField = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', $sFieldName)->get('value');
        } else {
            $sField = MLModule::gi()->getConfig($sFieldName);
        }
        $sField = empty($sField) ? $sFieldName : $sField;

        return $this->getProductField($sField);
    }

    /**
     * Check if magnalister product is a variation (MarketplaceIdentId contains "_") then it return ProductEntity object of variation
     * otherwise it returns ProductEntity object of master product($this->oProduct)
     * @return ProductEntity
     * @throws Exception
     */
    public function getCorrespondingProductEntity() {
        $aConf = MLModule::gi()->getConfig();
        if ($this->oProduct === null) {
            $this->load();
        }

        if ($this->oRealProduct === null) {
            $productRepository = MLMagento2Alias::ObjectManagerProvider('\Magento\Catalog\Model\ProductRepository');
            $sku = $this->get('MarketplaceIdentId');
            if (strpos($sku, '_') !== false) {
                //Checked if it is a variation then it fill the "$oProduct" with variation product object .
                $oProduct = $productRepository->getById($this->get('productsid'));
            } else {
                //Else it is a Master product then it fill the "$oProduct" with master product object ."$this->oProduct" is master product object.
                $oProduct = $this->oProduct;
            }
            $oProduct = $this->setProductObjectConfiguration($oProduct);
            $this->oRealProduct = $oProduct;
        }

        return $this->oRealProduct;
    }

    //@todo
    /**
     * @todo Implementing later
     * @return string
     */
    public function getName() {

        $this->load();
        $sMasterProductName = $this->getCorrespondingProductEntity()->getName();
        return $sMasterProductName;
    }

    /**
     * @param bool $blGros
     * @param bool $blFormated
     * @return mixed
     * @throws Enlight_Exception
     */
    public function getShopPrice($blGros = true, $blFormated = false) {
        $this->load();
        $mReturn = $this->getPrice($blGros, $blFormated/* ,false */);
        return $mReturn;
    }

    /**
     *
     * @param \ML_Shop_Model_Price_Interface $oPrice
     * @param bool $blGros
     * @param bool $blFormated
     * @return mixed
     *
     * @throws Exception
     * @todo check price groups for special price
     */
    public function getSuggestedMarketplacePrice(\ML_Shop_Model_Price_Interface $oPrice, $blGros = true, $blFormated = false) {
        $this->load();
        $aConf = $oPrice->getPriceConfig();

        $sCustomerGroup = $aConf['group'];
        $oProduct = $this->getCorrespondingProductEntity();
        $oProduct->setCustomerGroupId($sCustomerGroup);

        $fTax = $aConf['tax'];
        $sPriceKind = $aConf['kind'];
        $fPriceFactor = (float)$aConf['factor'];
        $iPriceSignal = $aConf['signal'];
        if (!$aConf['special']) {
            $oProduct->setSpecialPrice(null);
        }
        $mReturn = $this->getPrice($blGros, $blFormated, $sPriceKind, $fPriceFactor, $iPriceSignal, $fTax);
        return $mReturn;
    }

    /**
     * @param $blGros
     * @param $blFormated
     * @param string $sPriceKind
     * @param float $fPriceFactor
     * @param null $iPriceSignal
     * @param null $fTax
     * @return mixed
     * @throws Exception
     */
    protected function getPrice($blGros, $blFormated, $sPriceKind = '', $fPriceFactor = 0.0, $iPriceSignal = null, $fTax = null) {
        $oProduct = $this->getCorrespondingProductEntity();
        $oPrice = MLPrice::factory();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        try {
            $fPrice = 0;
            if($sPriceKind !== '' && $oProduct->getCustomerGroupId()) {
                $fPrice = $this->oRealProduct->getPriceInfo()->getPrice('tier_price')->getValue();
            }
            if($fPrice == 0) {
                $fPrice = $this->oRealProduct->getPriceInfo()->getPrice('final_price')->getValue();
            }
        } catch (\Exception $ex) {
            if (str_contains($ex->getMessage(), 'Undefined rate from')) {
                MLMessage::gi()->addWarn(sprintf(MLI18n::gi()->ML_MAGENTO2_ERROR_CURRENCY_NO_RATE, MLModule::gi()->getConfig('currency')));
            }
            throw $ex;
        }

        // by getTax - country
        $fPercent = $this->getDefaultCountryOfStore();

        if ($fPercent === null) {
            $fPercent = 0;
        }

        if ($fTax !== null) {
            $fNetOriginalPrice = $oPrice->calcPercentages($fPrice, null, $fPercent);
            $fPrice = $oPrice->calcPercentages(null, $fNetOriginalPrice, $fTax);
            $fPercent = $fTax;
        }

        if ($sPriceKind == 'percent') {
            $fPrice = $oPrice->calcPercentages(null, $fPrice, $fPriceFactor);
        } elseif ($sPriceKind == 'addition') {
            $fPrice = $fPrice + $fPriceFactor;
        }

        if ($iPriceSignal !== null) {
            //If price signal is single digit then just add price signal as last digit
            if (strlen((string)$iPriceSignal) == 1) {
                $fPrice = (0.1 * (int)($fPrice * 10)) + ((int)$iPriceSignal / 100);
            } else {
                $fPrice = ((int)$fPrice) + ((int)$iPriceSignal / 100);
            }
        }

        // 3. calc netprice from modulprice
        $fNetPrice = $oPrice->calcPercentages($fPrice, null, $fPercent);
        // 4. define out price (unformated price of current shop)
        $fUsePrice = $blGros ? $fPrice : $fNetPrice;
        $fUsePrice = $this->priceAdjustment($fUsePrice);
        if ($blFormated) {
            $currencySymbol = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
            $currency = $currencySymbol->getStore()->getCurrentCurrency();

            return "<span class='price'>".$fUsePrice." ".$currency->getCurrencySymbol()."</span>";
        }
        return round($fUsePrice, 2);
    }

    /**
     * Return the volume prices of the webshop
     *
     * @param $sGroup
     * @param $blGross
     * @param $sPriceKind
     * @param $fPriceFactor
     * @param $iPriceSignal
     * @return array
     * @throws Exception
     */
    public function getVolumePrices($sGroup, $blGross = true, $sPriceKind = '', $fPriceFactor = 0.0, $iPriceSignal = null) {
        $oPrice = MLPrice::factory();
        $this->oProduct->setCustomerGroupId($sGroup);
        // by getTax - country
        $fPercent = $this->getDefaultCountryOfStore();
        if ($fPercent === null) {
            $fPercent = 0;
        }
        $aVolumePrices = array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var Magento\Framework\Pricing\PriceCurrencyInterface $oPriceCurrency */
        $oPriceCurrency = $objectManager->get('Magento\Framework\Pricing\PriceCurrencyInterface');

        foreach ($this->getCorrespondingProductEntity()->getTierPrice() as $aMagentoTierPrice) {
            // price kind
            if ($sPriceKind == 'percent') {
                $fNetPrice = $oPrice->calcPercentages(null, $aMagentoTierPrice['price'], $fPriceFactor);
            } elseif ($sPriceKind == 'addition') {
                $fNetPrice = $aMagentoTierPrice['price'] + $fPriceFactor;
            }

            // price signal
            if ($iPriceSignal !== null) {
                //If price signal is single digit then just add price signal as last digit
                if (strlen((string)$iPriceSignal) == 1) {
                    $fNetPrice = (0.1 * (int)($fNetPrice * 10)) + ((int)$iPriceSignal / 100);
                } else {
                    $fNetPrice = ((int)$fNetPrice) + ((int)$iPriceSignal / 100);
                }
            }

            if ($blGross) {
                $fPrice = $oPrice->calcPercentages(null, $fNetPrice, $fPercent);
            } else {
                $fPrice = $fNetPrice;
            }

            $aVolumePrices[(int)$aMagentoTierPrice['price_qty']] = $oPriceCurrency->convert($fPrice, $this->oProduct->getStore());
        }

        return $aVolumePrices;
    }

    public function priceAdjustment($fPrice) {
        return $fPrice;
    }

    /**
     * Gets the tax percentage of the item.
     * if $aAddressData is set, it try to locate tax for $aAddressData['Shipping']
     * @param array|null
     *      $aAddressSets get tax for $aAddressData array('Main' => [], 'Billing' => [], 'Shipping' => []);
     *      if $aAddressSets is null get tax for home country
     * @return float
     */
    public function getTax($aAddressSets = null) {
        //Parameters for testing TAX
       // $aAddressSets['Billing'] = array(
       //     "Gender" => false,
       //     "Firstname" => "Hans",
       //     "Lastname" => "Mustermann",
       //     "Company" => false,
       //     "StreetAddress" => "Teststrasse 43",
       //     "Street" => "Teststrasse",
       //     "Housenumber" => "43",
       //     "Postcode" => "1234",
       //     "City" => "Teststadt",
       //     "Suburb" => 'Hessen',
       //     "CountryCode" => "DE",
       //     "Phone" => "5678 901234",
       //     "EMail" => "test@example.com",
       //     "DayOfBirth" => false,
       //     "DateAdded" => "2020-04-29 09:46:58",
       //     "LastModified" => "2020-04-29 09:46:58");

        return MLHelper::gi('Model_Product_Magento2Tax')->getTax($this->getCorrespondingProductEntity(), $aAddressSets);
    }

    /**
     * @return int
     */
    public function getTaxClassId() {
        return $this->getCorrespondingProductEntity()->getTaxClassId();
    }

    /**
     *
     * @return int
     * @throws Exception
     */
    public function getStock() {

        $oProductStockItem = $this->getCorrespondingProductEntity()->getExtensionAttributes()->getStockItem();

        if ($oProductStockItem->getManageStock() // stock management
            &&
            !$oProductStockItem->getIsInStock() // is not in stock
        ) { // master have no stock
            return 0;
        } elseif ($this->getCorrespondingProductEntity()->getTypeId() == 'configurable') { // master, configurable
            $iStock = 0;
              // exact calc, we dont need
            foreach ($this->getVariants() as $oVariant) {
                $iVariantStock = $oVariant->getStock();
                $iStock += $iVariantStock >= 0 ? $iVariantStock : 0;
            }

            return $iStock;
        } else { // variant
            if (!$oProductStockItem->getManageStock()) {
                return 999;
            } elseif (!$oProductStockItem->getIsInStock()) {
                return 0;
            } else {
                return (int) $oProductStockItem->getQty();
            }
        }
    }

    /**
     * @param string $sType
     * @param float $fValue
     * @param null $iMax
     * @return int
     * @throws Exception
     */
    public function getSuggestedMarketplaceStock($sType, $fValue, $iMax = null) {

        if (
            MLModule::gi()->getConfig('inventar.productstatus') == 'true' && !$this->isActive()
        ) {
            return 0;
        }
        if ($sType == 'lump') {
            $iStock = $fValue;
        } else {
            $iStock = $this->getStock();
            if ($sType == 'stocksub') {
                $iStock = $iStock - $fValue;
            }

            if (!empty($iMax)) {
                $iStock = min($iStock, $iMax);
            }
        }

        $iStock = (int) $iStock;
        return $iStock > 0 ? $iStock : 0;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getVariatonData() {

        return $this->getVariatonDataOptinalField(array('name', 'value'));
    }

    public function getPrefixedVariationData() {

        $variationData = $this->getVariatonDataOptinalField(array('name', 'value', 'code', 'valueid'));

        return $variationData;
    }

    /**
     * @param array $aFields
     * @return mixed
     * @throws Exception
     */
    public function getVariatonDataOptinalField($aFields = array())
    {
        $aOut = array();
        if ($this->get('parentid') != 0) {
            $oShopParentProduct = $this->getParent()->getCorrespondingProductEntity();
            $oShopProduct = $this->getCorrespondingProductEntity();
        } else {
            $oShopParentProduct = $this->getCorrespondingProductEntity();
            $oShopProduct = $oShopParentProduct;
        }
        $oAttributeModel = MLMagento2Alias::ObjectManagerProvider('\Magento\ConfigurableProduct\Model\Product\Type\Configurable');
        $aConfigurableAttributes = $oAttributeModel->getConfigurableAttributesAsArray($oShopParentProduct);
        // Query is used for preselecting the configurable attributes
        foreach ($aConfigurableAttributes as $configurableAttribute) {
            $aData = array();
            if (in_array('code', $aFields)) {//an identifier for group of attributes , that used in Meinpaket at the moment
                $aData['code'] = 'a_' . $configurableAttribute['attribute_id'];
            }
            if (in_array('valueid', $aFields)) {//an identifier for group of attributes , that used in Meinpaket at the moment
                $aData['valueid'] = $configurableAttribute['attribute_id'];
            }
            if (in_array('name', $aFields)) {
                $aData['name'] = $configurableAttribute['label'];
            }
            if (in_array('value', $aFields)) {
                if ($this->get('parentid') != 0) {
                    if ($oShopProduct->getData($configurableAttribute['attribute_code']) !== null) {
                        $aData['value'] = $this->getProductField($configurableAttribute['attribute_code']);
                    } else {
                        $aData['value'] = isset($configurableAttribute['values'][0]) ? $configurableAttribute['values'][0] : 'No values set in shop';
                    }
                }
            }
            if (in_array('url_query', $aFields)) {//used for getting front end link for configurable products
                $aData = $configurableAttribute['attribute_id'] . '=' . $oShopProduct->getData($configurableAttribute['attribute_code']);
            }

            $aOut[] = $aData;
        }
        return $aOut;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isActive() {

        return $this->getCorrespondingProductEntity()->getStatus() == 1 && ($this->get('parentid') == 0 ? true : $this->getParent()->isActive());
    }

    /**
     *
     *
     * @param int $iStock
     */
    public function setStock($iStock) {
        $oProduct = $this->getCorrespondingProductEntity();
        if ($oProduct->isInStock()) {
            $inStock = $iStock > 0 ? true : false;
            return $oProduct
                ->setStockData(array('qty' => $iStock, 'is_in_stock' => $inStock))
                ->setQuantityAndStockStatus(array('qty' => $iStock, 'is_in_stock' => $inStock))
                ->save();
        }

    }

    /**
     * @return string
     */
    public function getCategoryPath() {
        $sPath = '';
        $oProduct = $this->getCorrespondingProductEntity();
        $aCatIds = $oProduct->getCategoryIds();
        $aBaseCatIds = $this->getRootCategoriesIds();

        foreach ($aCatIds as $iCatId) {
            $sInnerCat = '';
            $oCat = MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\Category')->load($iCatId);
            while (!in_array($oCat->getId(), $aBaseCatIds)) {
                $sInnerCat = $oCat->getName().  ' > ' . $sInnerCat;
                $oCat = $oCat->getParentCategory();
            }

            // remove last arrow
            if (substr($sInnerCat, -3) == ' > ') {
                $sInnerCat = substr($sInnerCat, 0, -3);
            }

            // remove last break
            if ($sInnerCat !== '') {
                //Home Category does not exsist
                $sPath .=  'Home > ' . $sInnerCat . '<br>';
            }
        }
        return $sPath;
    }

    /**
     * @param bool $blIncludeRootCats
     * @return array
     */
    public function getCategoryIds($blIncludeRootCats = true) {
        $aCatIds = $this->getCorrespondingProductEntity()->getCategoryIds();
        if (!$blIncludeRootCats) {
            $aRootCatIds = $this->getRootCategoriesIds();

            foreach ($aCatIds as $iCat => $iCatId) {
                if (in_array($iCatId, $aRootCatIds)) {
                    unset ($aCatIds[$iCat]);
                }
            }
        }
        return $aCatIds;
    }

    protected function getRootCategoriesIds() {
        $aOut = array();
        $oBaseCat = $this->getProductsRootCategory();
        while (is_object($oBaseCat) && $oBaseCat->getId() !== null) {
            $aOut[] = $oBaseCat->getId();
            if ($oBaseCat->getParentId() != '0') {
                $oBaseCat = $oBaseCat->getParentCategory();
            } else {
                $oBaseCat = null;
            }
        }
        return $aOut;
    }

    protected function getProductsRootCategory() {
        $oProduct = $this->getCorrespondingProductEntity();
        $storeManager = MLMagento2Alias::ObjectManagerProvider('\Magento\Store\Model\StoreManagerInterface');

        return MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\Category')
            ->load($storeManager->getStore($oProduct->getStoreId())->getRootCategoryId());
    }

    /**
     * @param bool $blIncludeRootCats
     * @return array
     */
    public function getCategoryStructure($blIncludeRootCats = true) {
        $aCategories = array();
        $aRootCatIds = $aExistedCatId = $blIncludeRootCats ? array() : $this->getRootCategoriesIds();
        $oProduct = $this->getCorrespondingProductEntity();
        foreach ($oProduct->getCategoryIds() as $iCatId) {
            $oCat = MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\Category')->load($iCatId);
            do {
                if(in_array($oCat->getId() , $aExistedCatId) ||
                    in_array($oCat->getId(), $aRootCatIds)){
                    break;
                }

                $aCurrentCat = array(
                    'ID' => $oCat->getId(),
                    'Name' => $oCat->getName(),
                    'Description' => $oCat->getDescription(),
                    'Status' => true,
                    'ParentID' => $oCat->getParentId() !== null ? $oCat->getParentId() : ''
                );

                $aExistedCatId[] = $oCat->getId();
                if ($oCat->getParentId() != '0') {
                    $oCat = $oCat->getParentCategory();
                } else {
                    $oCat = null;
                }


                $aCategories[] = $aCurrentCat;
            } while (is_object($oCat) && $oCat->getId() !== null);
        }
        return $aCategories;
    }

    /**
     * @todo Need to discuss with developers about that
     * @param $sName
     * @param null $sMethod
     * @return \Doctrine\ORM\PersistentCollection|int|string|null
     * @throws Exception
     */
    public function getProductField($sName, $sMethod = null) {

        if (strpos($sName, 'a_') === 0) {
            $sName = substr($sName, 2);
        }
        if (strpos($sName, 'p_') === 0) {
            $sName = substr($sName, 2);
        }
        $this->load();
        $oCurrent = $this->getCorrespondingProductEntity();
        if ($oCurrent->getResource()->getAttribute($sName) === false) {
            return null;
        } else {
            $aConf = MLModule::gi()->getConfig();
            //Displaying attributes value by different store
            //$mValue = $oCurrent->getResource()->getAttribute($sName)->setStoreId(0)->getFrontend()->getValue($oCurrent);
            $mValue = $oCurrent->getResource()->getAttribute($sName)->setStoreId($aConf['lang'])->getFrontend()->getValue($oCurrent);
            if ($mValue === null) {
                //Displaying default attributes value when the value is not set in specific store
                $mValue = $oCurrent->getResource()->getAttribute($sName)->getDefaultValue();
            }
        }
        return $mValue;

    }

    /**
     * @return array
     * @throws Exception
     */
    public function getWeight() {

        $sWeight = (float) $this->getCorrespondingProductEntity()->getWeight();
        $sWeightUnit = MLMagento2Alias::ObjectManagerProvider('Magento\Directory\Helper\Data')->getWeightUnit();
        $sWeightUnit = $sWeightUnit == 'kgs' ? strtoupper(substr($sWeightUnit, 0, -1)) : strtoupper($sWeightUnit);
        if ($sWeight > 0) {
            return array(
                "Unit" => $sWeightUnit,
                "Value" => $sWeight,
            );
        } else {
            return array();
        }
    }

    /**
     * Not implemented at the moment because Magento 2 does not support Base price
     *
     * @param float $fPrice
     * @param bool $blLong
     * @return string
     * @throws Exception
     */
    public function getBasePriceString($fPrice, $blLong = false) {
        return '';
    }

    /**
     * Not implemented at the moment because Magento 2 does not support Base price
     *
     *
     * @return array
     * @throws Exception
     */
    public function getBasePrice() {
        return array();
    }

    /**
     * @return int
     */
    public function getVariantCount() {
        $this->load();
        if($this->oProduct->getTypeId() == 'configurable' ){
            $variantsUsed = $this->oProduct->getTypeInstance()->getUsedProducts($this->oProduct);
            $iCount = count($variantsUsed);
        }else{
            $iCount = 1;
        }
        return $iCount;
    }

    /**
     *
     * @param int $iLang
     * @return boolean
     */
    public function setLang($iLang) {
        $productRepository = MLMagento2Alias::ObjectManagerProvider('\Magento\Catalog\Model\ProductRepository');
        $oProduct = $productRepository->getById($this->get('productsid'));

        if ($oProduct->getStoreId() != $iLang) {
            $oProduct->setStoreId($iLang)->load($oProduct->getId());
        }
    }

    /**
     * @param string $mAttributeCode
     * @return float|null
     * @throws Exception
     */
    public function getAttributeValue($mAttributeCode) {
        return $this->getProductField($mAttributeCode);
    }

    /**
     * @return \Doctrine\ORM\PersistentCollection|int|string|null
     */
    public function getManufacturer() {

        return $this->getModulField('manufacturer');
    }

    /**
     * @return \Doctrine\ORM\PersistentCollection|int|string|null
     */
    public function getManufacturerPartNumber() {

        return $this->getModulField('manufacturerpartnumber');
    }

    /**
     * @return int|string|null
     */
    public function getEAN() {

        return $this->getModulField('ean');
    }

    /**
     * @todo Iplementing later
     * @return bool
     */
    public function isSingle() {
        $this->load();
        if($this->oProduct->getTypeId() == 'configurable' ){
            //Product with variations
            return false;
        }else{
            //Single(Simple) product if((int)$iCount == 0)
            return true;
        }
    }

    /**
     * @param $oProduct
     * @return \Magento\Catalog\Model\ProductRepository
     */
    protected function setProductObjectConfiguration($oProduct) {
        $aConf = MLModule::gi()->getConfig();
        if ($oProduct->getStoreId() != $aConf['lang']) {
            $oProduct->setStoreId($aConf['lang'])->load($oProduct->getId());
        }

        $storeObj = MLMagento2Alias::ObjectManagerProvider('Magento\Store\Model\StoreManagerInterface');
        $storeObj->getStore();
        $oCurrency = MLMagento2Alias::ObjectManagerProvider('Magento\Directory\Model\CurrencyFactory')->create()->load($aConf['currency']);
        if ($oProduct->getStore()->getCurrentCurrency()->getCode() != $aConf['currency']) {
            $oProduct->getStore()->setCurrentCurrency($oCurrency);
        }

        return $oProduct;
    }

    public function getBulletPointDefaultField() {
        return 'meta_keyword';
    }

    public function getEanDefaultField() {
        $globalEan = MLModule::gi()->getConfig('ean');
        $matchingAttributeGroups = MLFormHelper::getShopInstance()->getGroupedAttributesForMatching();

        if (isset($globalEan)) {
            $result = '';
            foreach ($matchingAttributeGroups as $matchingAttributeGroup) {
                if (is_array($matchingAttributeGroup) && array_key_exists($globalEan, $matchingAttributeGroup)) {
                    $result = $globalEan;
                    break;
                }
            }
        } else {
            $result = '';
        }

        return $result;
    }

    public function getBrandDefaultField() {
        $globalManufacturer = MLModule::gi()->getConfig('manufacturer');
        $matchingAttributeGroups = MLFormHelper::getShopInstance()->getGroupedAttributesForMatching();

        if (isset($globalManufacturer)) {
            $result = '';
            foreach ($matchingAttributeGroups as $matchingAttributeGroup) {
                if (is_array($matchingAttributeGroup) && array_key_exists($globalManufacturer, $matchingAttributeGroup)) {
                    $result = $globalManufacturer;
                    break;
                }
            }
        } else {
            $result = '';
        }
        return $result;
    }

    protected function getDefaultCountryOfStore(): float {
        $country = $this->oProduct->getStore()->getConfig(Custom::XML_PATH_GENERAL_COUNTRY_DEFAULT);
        $fPercent = $this->getTax(array(
            'Billing'  => ['CountryCode' => $country, 'Postcode' => '*'],
            'Shipping' => ['CountryCode' => $country, 'Postcode' => '*']
        ));

        if ($fPercent === null) {
            $fPercent = $this->getTax(array(
                'Billing'  => ['CountryCode' => $country],
                'Shipping' => ['CountryCode' => $country]
            ));
        }
        return $fPercent;
    }

}
