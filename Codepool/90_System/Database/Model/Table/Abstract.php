<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                            m a g n a l i s t e r
 *                                        boost your Online-Shop
 *
 *   -----------------------------------------------------------------------------
 *   @author magnalister
 *   @copyright 2010-2022 RedGecko GmbH -- http://www.redgecko.de
 *   @license Released under the MIT License (Expat)
 *   -----------------------------------------------------------------------------
 */

abstract class ML_Database_Model_Table_Abstract {

    const IS_NULLABLE_YES = 'YES';
    const IS_NULLABLE_NO = 'NO';

    /**
     * simular to show columns
     * @var array eg: array('fieldname'=>array(
     *                         'isKey' => <boolean>
     *                         'isExpited'=> <boolean>
     *                         'Type' => 'int(8) unsigned',  'Null' => 'NO', 'Default' => 0,    'Extra' => 'auto_increment', 'Comment'=>''  )
     *                      ,...)
     */
    protected $aFields = array();

    /**
     * simular to show keys
     * @var array('UniqueKey' => array('Non_unique' => '0', 'Column_name' => 'foo, bar'),'PRIMARY'    => array('Non_unique' => '0', 'Column_name' => 'id'),)
     */
    protected $aTableKeys = array();

    /**
     * data is loaded?
     * @var bool
     * @var null init value, don't have try to load
     */
    protected $blLoaded = null;

    /**
     * name of table
     * @var string $sTableName
     */
    protected $sTableName = '';

    /**
     * insert all data to backuptable, if data are changed or deleted and sBackupTableName!=''
     * @var string
     */
    protected $sBackupTableName = '';

    /**
     * Orginal data that loaded from table (key=>value)
     * @var array assoc
     */
    protected $aOrginData = array();

    /**
     * data of row (key=>value)
     * @var array assoc
     */
    protected $aData = array();

    /**
     * all keys where needed to filter single entree
     * @var array
     */
    protected $aKeys = array();

    /**
     * datetime in future - will delete old entries
     * @var string $sExpirableFieldName
     */
    protected $sExpirableFieldName = '';

    /**
     * @var bool $aExpiredDeleted delete entries one time per request for each table
     */
    protected static $aExpiredDeleted = array();

    protected $sInsertCurrentTimeFieldNames = array();

    public function __construct() {
        $this->init(true);
        if (MLSession::gi()->get('runOncePerSession') === null) {
            MLSession::gi()->set('runOncePerSession', array());
        }
        $aSession = MLSession::gi()->get('runOncePerSession');
        if (
            (!(isset($aSession['schema']) && in_array($this->sTableName, $aSession['schema']))) ||
            (
                MLRequest::gi()->data('updateTables') !== null &&
                ML::gi()->isAdmin()
            )
        ) {
            $aSession['schema'][] = $this->sTableName;
            $this->runOnceSession();
            MLSession::gi()->set('runOncePerSession', $aSession);
        }
        if (!in_array($this->sTableName, self::$aExpiredDeleted)) {
            self::$aExpiredDeleted[] = $this->sTableName;
            $this->runOncePerRequest();
        }
        $this->setDefaultValues();
    }
     
    protected function runOncePerRequest() {
        if ($this->sExpirableFieldName != '') {
            $oList = $this->getList();
            $oList->getQueryObject()->where($this->sExpirableFieldName."<'".date('Y-m-d H:i:s')."'");
            $oList->delete();
        }
        return $this;
    }

    protected function runOnceSession(){
        ML::gi()->factory('model_query_tableschema')
            ->setTable($this->sTableName)
            ->setColumns($this->aFields)
            ->setKeys($this->aTableKeys)
            ->update()
        ;
    }

    /**
     * cleans data
     * @param bool $blForce new calculation of complete table-definition
     * @return \ML_Database_Model_Table_Abstract
     */
    public function init($blForce = false) {
        if ($blForce) {
            $oRef = new ReflectionClass($this) ;
            $this->aKeys = array();
            foreach ($oRef->getDefaultProperties() as $sKey => $mValue) {
                $oRefProp = new ReflectionProperty($this, $sKey);

                if(!$oRefProp->isStatic()){
                    $this->$sKey = $mValue;
                }
                
            }
            foreach ($this->aFields as $sName => $aData) {
                if (isset($aData['isKey']) && $aData['isKey']) {
                    $this->aKeys[]= strtolower($sName);
                }
                if (isset($aData['isExpirable']) && $aData['isExpirable']) {
                    $this->sExpirableFieldName = strtolower($sName);
                }
                if (isset($aData['isInsertCurrentTime']) && $aData['isInsertCurrentTime']) {
                    $this->sInsertCurrentTimeFieldNames[] = strtolower($sName);
                }
            }
            $this->setDefaultValues();
        } else {
            $this->blLoaded = null;
            $this->aOrginData = array();
            foreach (array_keys($this->aData) as $sKey) {
                if (!in_array($sKey, $this->aKeys)) { //if data is also a key, don't change
                    unset($this->aData[$sKey]);
                }
            }
        }
        return $this ;
    }

     /**
      *
      * @param array $aArray
      * @return $this
      */
    public function setKeys($aArray) {
        $this->aKeys = $aArray;
        return $this->init();
    }

    /**
     *
     * @param bool $blCurrent current set keys or default set keys
     * @return array
     */
    public function getKeys($blCurrent = true) {
        if ($blCurrent) {
            return $this->aKeys;
        } else {
            $aKeys = array();
            foreach ($this->aFields as $sName => $aData) {
                if (isset($aData['isKey']) && $aData['isKey']) {
                    $aKeys[] = strtolower($sName);
                }
            }
            return $aKeys;
        }
    }

    /**
     * setting default values. these can be come by request or session. its possible to overwrite these values
     * @return $this
     */
    abstract protected function setDefaultValues();

    /**
     * get all current data
     * @return array
     */
    public function data($blLoad = true) {
        if ($blLoad) {
            $this->load() ;
        }
        $aOut = array();
        foreach (array_keys($this->aData) as $sKey) {
            try {
                $aOut[$sKey] = $this->get($sKey);
            } catch (Exception $oEx) {
                if ($blLoad) {
                    throw $oEx;
                }
            }
        }
        return $aOut;
    }

    /**
     * makes a select query by all filters
     * @throws Exception not all keys are set
     * @return $this
     */
    public function load() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo(), 1550742082);
        } elseif ($this->blLoaded === null) {
            $this->blLoaded = false;
            $oSelect = MLDatabase::factorySelectClass();
            $aData = $oSelect->select("*")->from($this->sTableName)->where($this->buildWhere())->getResult();
            //echo "<br>".MLDatabase::getDbInstance()->getLastQuery();
            if (!empty($aData)) {
                $aData = array_shift($aData);
                $this->blLoaded = true;
                foreach ($aData as $sKey => $sValue) {
                    if (!array_key_exists(strtolower($sKey), $this->aData)) { //don't overwrite manual set data
                        $this->__set($sKey, $sValue);
                    }
                    $this->aOrginData[strtolower($sKey)] = $sValue;
                }
            }
        }
        return $this ;
    }

    protected function getMissingKeysInfo () {
        $sInfo = '';
        foreach ($this->aKeys as $sKey) {
            if (!array_key_exists($sKey, $this->aData)) {
                $sInfo .= $sKey.', ';
            }
        }
        if ($sInfo != '') {
            $sInfo = ' ('.$this->sTableName.': '.substr($sInfo, 0, -2).')';
        }
        return $sInfo;
    }

    /**
     * builds where array key => value
     * @final ML_Database_Model_List should create same where condition
     * @return array
     */
    final protected function buildWhere() {
        $aWhere = array ();
        foreach ($this->aKeys as $sKey) {
            $aWhere[$sKey] = $this->blLoaded === true ? $this->aOrginData[$sKey] : $this->aData[$sKey]; // if loaded and a key is changed, where condition should hit origin data
        }
        return $aWhere;
    }

    /**
     * makes a query to save data - if a row already exists, get these row and save merged data
     * @throws Exception not all keys are set
     * @return $this
     */
    public function save() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo()) ;
        } else {
            if (!$this->exists()) { //really don't exists?
                $this->blLoaded = null;
            }
            $this->load() ; //merging existing data with current
            if (
                   $this->blLoaded === true
                && count($this->aOrginData) > 0
            ) {
                if ($this->isChanged()) {
                    if ($this->sBackupTableName != '') {
                        MLDatabase::getDbInstance()->insert($this->sBackupTableName, $this->aOrginData);
                    }
                    $this->update();
                }
            } else {
                $this->insert();
            }
            $this->blLoaded = null;
            $this->load();//insert id, origin-data, casting of sql-fields
        }
        return $this ;
    }

    protected function insert() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo());
        } else {
            if (!empty($this->sInsertCurrentTimeFieldNames)) {
                foreach ($this->sInsertCurrentTimeFieldNames as $fieldName) {
                    if (empty($this->aData[$fieldName])) {
                        //MLMessage::gi()->addDebug($fieldName);
                        $this->set($fieldName, date('Y-m-d H:i:s'));
                    }
                }
            }
            $aData = array();
            $aKeys = array_keys(array_change_key_case($this->aFields, CASE_LOWER));
            foreach (array_keys($this->aData) as $sKey) {
                if (in_array(strtolower($sKey), $aKeys)) {
                    $aData[$sKey] = $this->aData[$sKey];
                }
            }
            MLDatabase::getDbInstance()->insert($this->sTableName, $aData) ;
            return $this;
        }
    }

    protected function update() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo()) ;
        } else {
            $aData = array();
            $aKeys = array_keys(array_change_key_case($this->aFields, CASE_LOWER));
            foreach (array_keys($this->aData) as $sKey) {
                if (in_array(strtolower($sKey), $aKeys)) {
                    $aData[$sKey] = $this->aData[$sKey];
                }
            }
            MLDatabase::getDbInstance()->update($this->sTableName, $aData, $this->buildWhere());
            $this->aOrginData = $this->aData;
            return $this;
        }
    }

    /**
     * checks if all keys($this->aKeys) are set in $this->aData
     * @return bool
     */
    protected function allKeysExists() {
        $blReturn = true;
        foreach ($this->aKeys as $sKey) {
            if (!array_key_exists(strtolower($sKey), $this->aData)) {
                //echo $sKey;
                $blReturn = false;
                break;
            }
        }
        return $blReturn ;
    }

    public function getMissingKeys(){
        $aOut = array();
        foreach ($this->aKeys as $sKey) {
            if (!array_key_exists(strtolower($sKey), $this->aData)) {
                $aOut[] = strtolower($sKey);
            }
        }
        return $aOut;
    }

    /**
     * returns value of this->aData
     * @param string $sName
     * @return mixed|null
     */
    public function get($sName) {
        $sName = strtolower($sName);
        if (!isset($this->aData[$sName])) {
            $this->load();
        }
        return array_key_exists($sName, $this->aData) ? MLHelper::getEncoderInstance()->decode($this->aData[$sName]) : null;
    }

    public function __get($sName) {
        return $this->get($sName);
    }

    /**
     * set $this->aData[$sName]
     * It is already overrided in ML_Database_Model_Table_VariantMatching_Abstract
     * may be in future we need a same logic here,
     * because of testing time touse this new logic for all we do it only in this specific class that need that
     * @param string $sName
     * @param mixed
     *      null $mValue => null
     *      array $mValue => json
     *      object $mValue => serialize
     *      mixed $mValue => string
     * @return $this
     */
    public function set($sName, $mValue) {
        $this->aData[strtolower($sName)] = MLHelper::getEncoderInstance()->encode($mValue);
        return $this;
    }

    public function __set($sName, $sValue) {
        $this->set($sName, $sValue) ;
    }

    /**
     * delete current item
     */
    public function delete() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo());
        } else {
            if ($this->sBackupTableName != '') {
                $this->load();
                MLDatabase::getDbInstance()->insert($this->sBackupTableName, $this->aOrginData);
            }
            MLDatabase::getDbInstance()->delete($this->sTableName, $this->buildWhere());
        }
        $this->init(true);
        return $this;
    }

    /**
     * compare orgin array with data array
     * @return boolean if they are different it'll return true and otherwise return true
     */
    protected function isChanged() {
        $this->load();
        ksort($this->aData);
        ksort($this->aOrginData);
        if (json_encode($this->aData) != json_encode($this->aOrginData)) {
            return true;
        } else {
            return false;
        }
    }

    public function exists() {
        return $this->load()->blLoaded;
    }

    public function getTableName() {
        return $this->sTableName;
    }

    /**
     *
     * @return ML_Database_Model_List|object
     */
    public function getList() {
        $sIdent = MLFilesystem::getIdent($this);
        if (strpos($sIdent, '_table_') === false) {//extended table-class eg. product, order
            $sIdent .= '_list';
        } else {
            $sIdent = str_replace('_table_', '_list_', $sIdent);
        }
        try {
            $oList = ML::gi()->factory($sIdent, array('Database_Model_List'));
        } catch (Exception $oEx) {//use common list
            $oList = ML::gi()->factory('model_list');
        }
        $oList->setModel($this);
        return $oList;
    }

    public function getTableInfo($sField = null) {
        if ($sField === null) {
            return $this->aFields;
        } else {
            $aFields = array_change_key_case($this->aFields);
            return isset($aFields[strtolower($sField)]) ? $aFields[strtolower($sField)] : array();
        }
    }

}
