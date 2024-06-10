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

class ML_Database_Model_Table_PrepareDefaults extends ML_Database_Model_Table_Abstract {

    protected $sTableName = 'magnalister_preparedefaults';
    protected $aFields = array(
        'id' => array(
            'Type' => 'int(11) unsigned',   'Null' => 'NO', 'Default' => NULL, 'Extra' => 'auto_increment',     'Comment'=>''),
        'mpid' => array(
            'isKey' => true,
            'Type' => 'int(10) unsigned',   'Null' => 'NO', 'Default' => NULL, 'Extra' => '',                   'Comment'=>''),
        'name' => array(
            'isKey' => true,
            'Type' => 'varchar(32)',        'Null' => 'NO', 'Default' => NULL, 'Extra' => '',                   'Comment'=>''),
        'values' => array(
            'Type' => 'text',               'Null' => 'NO', 'Default' => NULL, 'Extra' => '',                   'Comment'=>''),
        'active' => array(
            'Type' => 'text',               'Null' => 'NO', 'Default' => NULL, 'Extra' => '',                   'Comment'=>''),
    );
    
    protected $aTableKeys = array(
        'PRIMARY'   => array('Non_unique' => '0', 'Column_name' => 'id'),
        'mpid'      => array('Non_unique' => '1', 'Column_name' => 'mpid'),
    );

    protected function setDefaultValues() {
        try {
            $this->set('mpid', MLModule::gi()->getMarketPlaceId());
        } catch(Exception $oEx) {//global
            $this->set('mpid',0);
        }
        $this->set('name', 'defaultconfig');
        return $this;
    }
    
    /**
     * use $this->cleanFields
     * @return \ML_Database_Model_Table_PrepareDefaults
     */
    public function load() {
        parent::load();
        if ($this->blLoaded) {
            $this->cleanFields();
        }
        return $this;
    }
    
    /**
     * use $this->cleanFields
     * @return \ML_Database_Model_Table_PrepareDefaults
     */
    public function save() {
        $this->cleanFields();
        return parent::save();
    }
    
    /**
     * unset values which are not configured for modul
     * @return \ML_Database_Model_Table_PrepareDefaults
     */
    protected function cleanFields () {
        $aMarketplaces = MLShop::gi()->getMarketplaces();
        foreach (array('OptionalFields' => 'active', 'Fields' => 'values') as $sType => $sField) {//delete entries which are not in preparedefaults
            $aConfig = array_key_exists($this->get('mpid'), $aMarketplaces) ? MLSetting::gi()->get(strtolower($aMarketplaces[$this->get('mpid')]).'_prepareDefaults'.$sType) : array();
            $aField = $this->get($sField);
            $aField = is_array($aField) ? $aField : array();
            foreach (array_keys($aField) as $sFieldName) {
                if (!in_array(strtolower($sFieldName), $aConfig)) {
                    unset($aField[$sFieldName]);
                }
            }
            $this->set($sField, $aField);
        }
        return $this;
    }
    
    public function getActive($sName) {
        $sName = strtolower($sName);
        $mOut = null;
        $aActive = $this->get('active');
        if (isset($aActive[$sName])) {
            $mOut = $aActive[$sName];
        }
        return is_array($mOut) ? $mOut:MLHelper::getEncoderInstance()->decode($mOut);
    }
    
    public function getValue($sName) {
        $sName = strtolower($sName);
        $mOut = null;
        $aValues=$this->get('values');
        if (isset($aValues[$sName])) {
            $mOut=$aValues[$sName];
        }
        return is_array($mOut) ? $mOut : MLHelper::getEncoderInstance()->decode($mOut);
    }
    
    public function setActive($sName,$mValue) {
        $sName=  strtolower($sName);
        $aActive = $this->get('active');
        $aActive = is_array($aActive)?$aActive:array();
        $aActive[$sName] = $mValue;
        $this->set('active', $aActive);
        return $this;
    }
    
    public function setValue($sName,$mValue) {
        $sName=  strtolower($sName);
        $aValues = $this->get('values');
        $aValues = is_array($aValues)?$aValues:array();
        $aValues[$sName] = $mValue;
        $aValues = array_change_key_case($aValues, CASE_LOWER);
        $this->set('values', $aValues);
        return $this;
    }

}
