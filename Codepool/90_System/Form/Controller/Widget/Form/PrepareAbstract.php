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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_Abstract');
abstract class ML_Form_Controller_Widget_Form_PrepareAbstract extends ML_Form_Controller_Widget_Form_Abstract {

    protected static $valueIsSaved = null;
    /**
     * @var ML_Form_Helper_Model_Table_PrepareData_Abstract $oPrepareHelper
     */
    protected $oPrepareHelper=null;
    
    /**
     * @var ML_Shop_Model_Product_Abstract $oProduct 
     */
    protected $oProduct = null;
    
    /** 
     * @var ML_Database_Model_List $oSelectList 
     */
    protected $oSelectList = null;
    
    /** 
     * @var ML_Database_Model_list $oPrepareList 
     */
    protected $oPrepareList = null;

    /**
     * value of magnalister_selection.selectionname for create list-object
     * @return string
     */
    abstract protected function getSelectionNameValue();
    
    /**
     * here can be set some specific values for preparelist or other stuff
     * @return bool (true=redirect to parent controller, false=re-edit form)
     */
    abstract protected function triggerBeforeFinalizePrepareAction();
    
    protected function construct() {
        $this->oPrepareHelper = MLHelper::gi('Model_Table_' . MLModule::gi()->getMarketPlaceName() . '_PrepareData');
        $oTable = MLDatabase::factory('selection')->set('selectionname', $this->getSelectionNameValue());
        $this->oSelectList = $oTable->getList();
        if ($this->oSelectList->getCountTotal() == 0) {
            MLMessage::gi()->addDebug('no product is selected');
            MLHttp::gi()->redirect($this->getParentUrl());
        }
        $this->oPrepareList = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_prepare')->getList();
        $this->oPrepareList->getQueryObject()->where($this->oPrepareHelper->getPrepareTableProductsIdField()." in ('" . implode("', '", $this->oSelectList->get('pid')) . "')");
        if ($this->oSelectList->getCountTotal() == 1) {
            $aList = $this->oSelectList->getList();
            $this->oProduct = MLProduct::factory()->set('id', current($aList)->get('pid'));
        } else {
            $oProductList = MLDatabase::factory('product')->getList();
            $oProductList->getQueryObject()->where('id in('.  implode(', ', $this->oSelectList->get('pid')).')');
            $aParentIds = $oProductList->get('parentid', true);
            if (count($aParentIds) == 1) {
                $this->oProduct = MLProduct::factory()->set('id', current($aParentIds));
            } else {
                $this->oProduct = null;
        }
        }
        $this->oPrepareHelper
            ->setRequestFields($this->aRequestFields)
            ->setRequestOptional($this->aRequestOptional)
            ->setPrepareList($this->oPrepareList)
            ->setProduct($this->oProduct)
        ;
    }
    
    protected function getFieldMethods($aField) {
        if (
            !isset($aField['singleproduct']) 
            || $aField['singleproduct'] == false
            || $this->oProduct instanceof ML_Shop_Model_Product_Abstract // only single products
        ) {
            $aMethods = array('triggerBeforeField', $aField['name'].'Field', 'triggerAfterField');
        }else{
            $aMethods = array('triggerAfterField');
        }
        return $aMethods;
    }

    protected function triggerBeforeField(&$aField) {
        $aResultHelper = $this->oPrepareHelper->getField($aField['name']);
        $aResultHelper = array_change_key_case($aResultHelper, CASE_LOWER);
        $aField = array_merge($aField, $aResultHelper);
    }
    
    protected function triggerAfterField(&$aField) {
        // with this code all db-fields which are null are optional
        if (
                isset($aField['type']) && $aField['type'] != 'optional'
                &&
                (!isset($aField['autooptional'])||$aField['autooptional']==true)
        ) {
            $aInfo = $this->oPrepareList->getModel()->getTableInfo($aField['realname']);
            if (isset($aInfo['Null']) && $aInfo['Null'] == 'YES') {
                $aField['optional']['field']['type'] = $aField['type'];
                if(!isset($aField['optional']['defaultvalue'])) {
                    $aField['optional']['defaultvalue'] = true;//autogenerated optional is default=true
                }
                $aField['type'] = 'optional';
            }
        }
    }
    
    public function prepareAction($blExecute = true) {
        if ($blExecute) {
            $aSelectionToDelete =  array();
            try {
                $oProductBackup = $this->oProduct;
                $aCols = array_keys($this->oPrepareList->getModel()->getTableInfo());
                $blError =false;                
                foreach ($this->oSelectList->get('pid') as $sProductsId) {
                    try {
                        $this->oProduct = MLProduct::factory()->set('id', $sProductsId);
                        $aSelectionToDelete[] = $sProductsId;
                        if ($this->oProduct->exists()) {
                            $aRow = $this->oPrepareHelper
                                    ->setProduct($this->oProduct)
                                    ->setPrepareList(null)//only values from request, and single entree from db
                                    ->getPrepareData($aCols, 'value')
                            ;
                            try {
                                $oCurrentPrepared = $this->oPrepareList->getByKey('[' . $sProductsId . ']');
                                foreach ($aRow as $sField => $aCollumn) {
                                    $oCurrentPrepared->set($sField, $aCollumn);
                                }
                            } catch (Exception $oEx) {
                                $aData = array();
                                foreach ($aRow as $sField => $aCollumn) {
                                    $aData[$sField] = $aCollumn;
                                }
                                $this->oPrepareList->add($aData);
                            }
                        } else {//shop-product dont exists                        
                            try {
                                $this->oPrepareList->getByKey('[' . $sProductsId . ']')->delete();
                            } catch(Exception $oEx) {//already deleted?
                            }
                            try {
                                $this->oSelectList->getByKey('[' . $sProductsId . ']')->delete();
                            } catch(Exception $oEx) {//already deleted?
                            }
                            $blError = true;
                        }
                    } catch(Exception $oEx) {
                        MLMessage::gi()->addDebug($oEx);
                        $blError = true;
                    }
                }
                if ($blError) {
                    $this->oPrepareList->reset();
                    $this->oSelectList->reset();
                }
                $blRedirect = $this->triggerBeforeFinalizePrepareAction();
                if ($this->getRequest('saveToConfig') == 'true' && $blRedirect) {
                    $this->oPrepareHelper->saveToConfig();
                }
                if (method_exists($this->oPrepareList->getModel(), 'getPreparedTimestampFieldName')) {
                    // one request = one timestamp, needed for filtering in productlists
                    $this->oPrepareList->set($this->oPrepareList->getModel()->getPreparedTimestampFieldName(), date('Y-m-d H:i:s'));
                }
                $this->oPrepareList->save();
                $this->aRequestFields = array();
                $this->aRequestOptional = array();
                $this->oProduct = $oProductBackup;
                $this->oPrepareHelper
                    ->setRequestFields($this->aRequestFields)
                    ->setRequestOptional($this->aRequestOptional)
                    ->setPrepareList($this->oPrepareList)
                    ->setProduct($this->oProduct)
                ;
                if ($blRedirect && !(MLSetting::gi()->blPreventRedirect)) {
                    MLDatabase::factory('selection')->getList()->getQueryObject()->where('pid in ('.implode(',', $aSelectionToDelete).')')->doDelete();
                    MLHttp::gi()->redirect($this->getParentUrl());
                }
            } catch(Exception $oEx) {
                MLMessage::gi()->addError($oEx);
            }
            return $this;
        } else {
            return array(
                'aI18n' => array('label' => MLI18n::gi()->get('form_action_prepare')),
                'aForm' => array(
                    'type' => 'submit', 
                    'position' => 'right',
                )
            );
        }
    }
    
    public function unprepareAction($blExecute = true) {
        if ($blExecute) {
            $this->oPrepareList->delete();
            $this->aRequestFields=array();
            $this->aRequestOptional=array();
            $this->oPrepareHelper
                ->setRequestFields($this->aRequestFields)
                ->setRequestOptional($this->aRequestOptional)
                ->setPrepareList($this->oPrepareList)
            ;
            return $this;
        } else {
            return array(
                'aI18n' => array('label' => MLI18n::gi()->get('form_action_unprepare')),
                'aForm' => array(
                    'type' => 'submit', 
                    'position' => 'left',
                )
            );
        }
    }
    
    /**
     * checks if a field is active, or not
     *
     * @param string|array $aField
     *
     * @return bool
     */
    protected function optionalIsActive($aField) {
        return $this->oPrepareHelper->optionalIsActive($aField);
    }

    protected function includeType($aField, $aVars = array(), $blAddFileErrorToMessage = true, $sAltType = null) {
//        new dBug($aField);
        if (isset($aField['type']) && (isset($this->oProduct) || !isset($aField['singleproduct']) || !$aField['singleproduct'] || (isset($aField['multiprepareonlyswitch']) && $aField['multiprepareonlyswitch']))) {
            return parent::includeType($aField, $aVars, $blAddFileErrorToMessage, $sAltType);
        }
        return $this;
    }

    public function valueIsSaved() {
        if (self::$valueIsSaved === null) {
            self::$valueIsSaved = $this->oPrepareList->getCountTotal() > 0;
        }
        return self::$valueIsSaved;
    }

    public function getSavedValue($aField) {
        $sField = $aField['realname'];
        $aData = $this->oPrepareList->get(str_replace('.', '_', $sField), true);

        return is_array($aData) ? current($aData) : $aData;
    }
}
