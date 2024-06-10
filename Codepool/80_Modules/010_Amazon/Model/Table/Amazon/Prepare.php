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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Database_Model_Table_Prepare_Abstract');

class ML_Amazon_Model_Table_Amazon_Prepare extends ML_Database_Model_Table_Prepare_Abstract {

    protected $sTableName = 'magnalister_amazon_prepare';

    protected $aFields = array(
        'mpID'                     => array(
            'isKey' => true,
            'Type'  => 'int(8) unsigned', 'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => 'auto_increment', 'Comment' => 'marketplaceid'
        ),
        'ProductsID'               => array(
            'isKey' => true,
            'Type'  => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => '', 'Comment' => 'magnalister_products.id'
        ),
        'PreparedTS'               => array(
            'isInsertCurrentTime' => true,
            'Type'                => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'PrepareType'              => array(
            'Type' => "enum('manual','auto','apply')", 'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'AIdentID'                 => array(
            'Type' => 'varchar(16)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'AIdentType'               => array(
            'Type' => "enum('ASIN','EAN','UPC')", 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        // @deprecated price comes only from mp-config dont need saving
        'Price'                    => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'LeadtimeToShip'           => array(
            /** @deprecated now shippingtime */
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingTime'             => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Quantity'                 => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'LowestPrice'              => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => 'lowest price (amazon)'
        ),
        'ConditionType'            => array(
            'Type' => 'varchar(50)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'item condition'
        ),
        'ConditionNote'            => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'additional condition info'
        ),
        'Shipping'                 => array(
            'Type' => 'varchar(10)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'old will ship internationally'
        ),
        'MainCategory'             => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply'
        ),
        'ProductType'              => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply'
        ),
        'BrowseNodes'              => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply'
        ),
        'Attributes'               => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'ShopVariation'            => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'variation_theme'          => array(
            'Type' => 'varchar(200)', 'Null' => self::IS_NULLABLE_YES, 'Default' => '{"autodetect":[]}', 'Extra' => '', 'Comment' => ''
        ),
        'ItemTitle'                => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'Manufacturer'             => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'Brand'                    => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'ManufacturerPartNumber'   => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'EAN'                      => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'Images'                   => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'BulletPoints'             => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'Description'              => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'Keywords'                 => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'TopMainCategory'          => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply, for top-ten-categories'
        ),
        'TopProductType'           => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply, for top-ten-categories'
        ),
        'TopBrowseNode1'           => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply, for top-ten-categories'
        ),
        'TopBrowseNode2'           => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => 'only apply, for top-ten-categories'
        ),
        'ApplyData'                => array(
            /** @deprecated */
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => 'only apply'
        ),
        'B2BActive'                => array(
            'Type' => "enum('true','false')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'false', 'Extra' => '', 'Comment' => ''
        ),
        'B2BSellTo'                => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 'b2b_b2c', 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountType'          => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 'no', 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier1Quantity' => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier2Quantity' => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier3Quantity' => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier4Quantity' => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier5Quantity' => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier1Discount' => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier2Discount' => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier3Discount' => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier4Discount' => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
        'B2BDiscountTier5Discount' => array(
            'Type' => 'decimal(15,2)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
        'IsComplete'               => array(
            'Type' => "enum('true','false')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'false', 'Extra' => '', 'Comment' => 'if matching, true'
        ),
        'Verified'                 => array(
            'Type' => "enum('OK','ERROR','OPEN','EMPTY')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'OPEN', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingTemplate'         => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'BopisStores' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        )
    );

    protected $aTableKeys = array(
        'UC_products_id'               => array('Non_unique' => '0', 'Column_name' => 'mpID, ProductsID'),
    );
    
    public function __construct() {
        parent::__construct();
    }

    protected function setDefaultValues() {
        try {
            $sId = MLRequest::gi()->get('mp');
            if (is_numeric($sId)) {
                $this->set('mpid', $sId);
            }
        } catch (Exception $oEx) {
            
        }
        return $this;
    }

    /**
     * get productid by asin or ean
     *
     * @param $sIdentValue
     * @param $sIdentType
     * @param null $iMpId
     * @return mixed
     */
    public function getByIdentifier($sIdentValue , $sIdentType , $iMpId = null) {
         $this->aKeys = array ('mpid' , 'aidenttype' , 'aidentid') ;
         if ( $iMpId === null ) {
             $iMpId = MLModule::gi()->getMarketplaceId();
         }
         $this->set('aidenttype' , $sIdentType)
                 ->set('aidentid' , $sIdentValue);
         return $this->get('productsid') ;
     }
     
    public function getVariantCount($mProduct) {
        $iMasterProductId = (int)(
            $mProduct instanceof ML_Database_Model_Table_Abstract
            ? $mProduct->get('id') 
            : $mProduct
        );
        $sSql = "
            SELECT COUNT(*) 
            FROM magnalister_products p
            INNER JOIN magnalister_amazon_prepare s ON p.id = s.productsid
            WHERE     p.parentid = '".$iMasterProductId."'
                  AND s.mpid = '".MLRequest::gi()->get('mp')."'
                  AND s.iscomplete = 'true'
        ";
        return MLDatabase::getDbInstance()->fetchOne($sSql);
    }
    
    public function resetTopTen($sType , $sValue){
        $oQuery = $this->getList()->getQueryObject();
        $oQuery->update($this->sTableName, array($sType=>''))->where("$sType = '$sValue'")->doUpdate();        
    }


    /**
     * field name for join magnalister_product.id
     * @return string
     */
    public function getProductIdFieldName() {
        return 'productsid';
    }
    
    /**
     * field name for prepared-status
     * @return string
     */
    public function getPreparedStatusFieldName() {
        return 'isComplete';
    }
    
    /**
     * field value for successfully prepared item of $this->getPreparedFieldName()
     * @return string
     */
    public function getIsPreparedValue() {
        return 'true';
    }
    
    /**
     * field name for prepared-type if exists
     * @return string|null
     */
    public function getPreparedTypeFieldName () {
        return 'PrepareType';
    }

    public function isVariationMatchingSupported() {
        return true;
    }

    public function getPrimaryCategoryFieldName() {
        return 'MainCategory';
    }
}
