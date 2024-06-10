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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
abstract class ML_Modul_Helper_Model_Service_ItemsFee {
    protected $oPrepare = null;
    protected $oSelection = null;
    protected $aData = null;

    public function __construct() {
        $this->oPrepare = MLDatabase::factory($this->getPrepareTableName());
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->aData = null;
        $this->oVariant = $oProduct;
        return $this;
    }

    public function resetData () {
        $this->aData = null;
        return $this;
    }

    public function getData() {
        if ($this->aData === null) {
            $this->oPrepare->init()->set('products_id', $this->oVariant->get('id'));
            $aData = array();

            foreach ($this->getFields() as $sField) {
                if (method_exists($this, 'get' . $sField)) {
                    $mValue = $this->{'get' . $sField}();

                    if (is_array($mValue)) {
                        $mValue = empty($mValue) ? null : $mValue;
                    }

                    if ($mValue !== null) {
                        $aData[$sField] = $mValue;
                    }
                } else {
                    MLMessage::gi()->addWarn('function ' . __CLASS__ . '::get' . $sField . '() doesn\'t exist');
                }
            }

            $this->aData = $aData;
        }

        return $this->aData;
    }

    /**
     * Returns prepare table name for specific marketplace.
     */
    protected abstract function getPrepareTableName();

    /**
     * Returns array of field names to create articles fee data for item.
     */
    protected abstract function getFields();
}
