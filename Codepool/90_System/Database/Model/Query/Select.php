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

/**
 * SQL query builder
 */
class ML_Database_Model_Query_Select {

    const JOIN_TYPE_LEFT = 1;
    const JOIN_TYPE_INNER = 2;
    const JOIN_TYPE_OUTER = 3;
    /**
     * prefix of name of the tables could be magnalister by default of could be empty string 
     */
    protected $sMlDbPrefix;
    /**
     *
     * @var ML_Database_Model_Db
     */
    static protected $oDB;
    protected $aResult = null;
    protected $aResultAll = null;
    protected $iResult = null;
    protected $iResultAll = null;
    static protected $aJoinType = array(
        1 => 'LEFT',
        2 => 'INNER',
        3 => 'OUTER'
    );
    protected $sExecutedSql = '';
    protected $aSelect = array();
    protected $aFrom = array();
    protected $aJoin = array();
    protected $aWhere = array();
    protected $aOrderBy = array();
    protected $aLimit = array('from' => 0, 'limit' => null);
    protected $aUpdate = array();
    protected $aUpdateSet = array();
    protected $aDelete = array();
    protected $aGroupBy = array();
    protected $aHaving = array();
    protected $aGenericFunctions = array(
        'Select',
        'From',
        'Join',
        'Where',
        'OrderBy',
        'Having',
        'GroupBy',
        'Limit'
    );
    
    public function __construct() {
        self::$oDB = MLDatabase::getDbInstance();
    }
    
    protected function getFunctions($aFilters){
        $aFuncs = $this->aGenericFunctions;
        foreach( $aFilters as $aFilter){
            if (($key = array_search($aFilter, $aFuncs)) !== false) {
                unset($aFuncs[$key]);
            }            
        }
        return $aFuncs;
    }

    /**
     * if we want to use tablenames with different prefix
     * @param string $sPrefix
     * @return $this
     */
    public function setPrefix($sPrefix) {
        $this->sMlDbPrefix = $sPrefix;
        return $this;
    }

    /**
     * initial class variables
     * @param type $sProperty
     * @return $this
     */
    public function init($sProperty = null) {
            $oRef = new ReflectionClass($this);
            $aStaticfieldKeys = array_keys($oRef->getStaticProperties());
            foreach ($oRef->getDefaultProperties() as $sKey => $mValue) {
                if (!in_array($sKey, $aStaticfieldKeys)) {
                    if($sProperty !== null && $sKey != $sProperty){
                        continue;
                    }
                    $this->$sKey = $mValue;
                }
            }
        return $this;
    }
    
    /**
     * reset all result vaiables
     */
    public function reset(){
        $this->iResult=null;
        $this->iResultAll=null;
        $this->aResult = null;
        $this->aResultAll = null;
    }

    /**
     * Add fields in query selection
     *
     * @param mixed $fields List of fields to concat to other fields
     * @return ML_Database_Model_Query_Select
     */
    public function select($mFields, $blReset = false) {
        if ($blReset) {
            $this->aSelect = array();
        }
        $this->aResult = null;
        $this->aResultAll = null;
        if (is_array($mFields) && count($mFields) > 0) {
            $this->aSelect = array_merge($this->aSelect, $mFields);
        } else if (!empty($mFields)) {
            $this->aSelect[] = $mFields;
        }
        return $this;
    }

    /**
     * Set table for FROM clause
     *
     * @param string $sTable Table name
     * @return ML_Database_Model_Query_Select
     */
    public function from($sTable, $sAlias = null) {
        $this->aResult = null;
        $this->aResultAll = null;
        $this->iResult=null;
        $this->iResultAll=null;
        if (!empty($sTable)) {
            $this->aFrom[] = '`' . $this->sMlDbPrefix . $sTable . '`' . ($sAlias ? ' ' . $sAlias : '');
        }
        return $this;
    }

    /**
     * 
     * @param string|array $mJoin
     *      if is string like this 'LEFT JOIN '._DB_PREFIX_.'product p ON ...' , 
     *      if is array like this array( tablename , alias , join condition )
     * @param int $iType can be one the const join type
     * @return ML_Database_Model_Query_Select
     * @throws Exception
     */
    public function join($mJoin, $iType = 0) {
        $this->aResult = null;
        $this->aResultAll = null;
        $this->iResult=null;
        $this->iResultAll=null;
        $sJoinPrefix = '';
        if (isset(self::$aJoinType[$iType])) {
            $sJoinPrefix = self::$aJoinType[$iType];
        }
        if (is_array($mJoin)) {
            if(!isset($mJoin[2])){                
                MLMessage::gi()->addWarn('ON clause is missing');
                throw new Exception();
            }
            $sConditon = is_array($mJoin[2]) ? $this->createCondition($mJoin[2]) : $mJoin[2];
            $this->aJoin[] = " $sJoinPrefix JOIN `" . $this->sMlDbPrefix . $mJoin[0] . '`' . ($mJoin[1] ? ' ' . $mJoin[1] : '') . " ON " . $sConditon;
        } elseif (!empty($mJoin)) {
            $this->aJoin[] = " $sJoinPrefix JOIN " .$mJoin;
        }
        return $this;
    }

    /**
     * see createCondition document
     * @param mixed $mCondition
     * @return ML_Database_Model_Query_Select
     */
    public function where($mCondition) {
        $this->aResult = null; //result all don't change
        $this->iResult = null;
        $this->aWhere[] = $this->createCondition($mCondition);
        return $this;
    }

    /**
     * if $mCondition =  array( field1 => value1 , field2 => value2 , ... ) add to where clause field1 = value1 AND field2 = value2 AND ...
     * if $mCondition =  array('or' => array( field1 => value1 , field2 => value2 , ... ) )add to where clause field1 = value1 OR field2 = value2 OR ...
     * if $mCondition =  array('prodcuts_id','not in','(100,200,501)' )add to where clause prodcuts_id not in (100,200,501)
     *  
     *  if $mCondition = array('or' => array( 'field1' => 'value1' , "field2 LIKE '%value2%'" , array('or'=>array( array('field4','<>','value4') ,'field5' => 'value5' )  ) ))
     *  WHERE ( ( field1 = 'value1' ) or (field2 LIKE '%value2%') or ( ( field4 <> 'value4' ) or ( field5 = 'value5' ) ) )
     *  
     * if $mCondition = array('or' => array( 'field1' => 'value1' , "field2 LIKE '%value2%'" , array( array('field4','<>','value4') ,'field5' => 'value5' )  ) )
     *  WHERE ( ( field1 = 'value1' ) or (field2 LIKE '%value2%') or ( ( field4 <> 'value4' ) AND ( field5 = 'value5' ) ) )
     * 
     * 
     * if
     * 
     * @param mixed $mCondition
     *     1st form :if is string add to where clause normally
     *     2nd form : if array( field1 => value1 , field2 => value2 , ... ) add to where clause field1 = value1 AND field2 = value2 AND ...
     *     3rd form : if array( array(field1 , '=' , value1) , array(field2, '<>' , value2) , array(field3, 'oparator' , value3) , ... ) 
     *           add to where clause like this field1 = value1 AND field2 <> value2 AND  field3 operator value3 AND ...
     * 
     *     4th form : if array(or => (array(1st or 2nd or 3rd form))  )
     *     5th form : if array(AND => (1st or 2nd or 3rd form) ) == if array(1st or 2nd or 3rd form )
     * @return ML_Database_Model_Query_Select
     */
    protected function createCondition($mCondition, $sBoolOperator = 'AND') {
        $oDB = self::$oDB;
        $sWhere = '';
        if (is_array($mCondition)) {
            $aWhere = array();
            foreach ($mCondition as $sMixed => $mValue) {
                //fieldname, oprator , value 
                if (gettype($sMixed) === "integer" && gettype($mValue) === "string") {
                    //use prefix N' because of Natinal language http://www.9lessons.info/2011/08/foreign-languages-using-mysql-and-php.html
                    $sStartQoute = strpos($mCondition[1], "in") === FALSE ? "N'" : '';
                    $sQoute = strpos($mCondition[1], "in") === FALSE ? "'" : '';
                    $aWhere[] = " " . $oDB->escape($mCondition[0]) . " " . $oDB->escape($mCondition[1]) . " $sStartQoute" . $oDB->escape($mCondition[2]) . "$sQoute ";
                    break;
                } else if (gettype($sMixed) === "string" && (gettype($mValue) === "string" || gettype($mValue) === "integer")) {
                    //fieldname ,value
                    $sQoute = gettype($mValue) === "string" ? "'" : '';
                    $aWhere[] = " " . $oDB->escape($sMixed) . " = $sQoute" . $oDB->escape($mValue) . "$sQoute ";
                } elseif(gettype($sMixed) === 'string' && $mValue === null) { 
                    $aWhere[] = " ".$oDB->escape($sMixed). " is null ";
                } else if (is_array($mValue)) {
                    //or , and
                    if (in_array(strtolower($sMixed), array('or', 'and'))) {
                        $sBoolOperator = $sMixed;
                        foreach ($mValue as $sKey => $mWhereClause) {
                            if (gettype($sKey) === "string") {
                                $aWhere[] = $this->createCondition(array("$sKey" => $mWhereClause), $sBoolOperator, true);
                            } elseif (gettype($mWhereClause) === "string") {
                                $aWhere[] = $this->createCondition($mWhereClause, $sBoolOperator, true);
                            } else if (is_array($mWhereClause)) {
                                $aWhere[] = $this->createCondition($mWhereClause, 'AND', true);
                            }
                        }
                    } else {
                        $aWhere[] = $this->createCondition($mValue, $sBoolOperator, true);
                    }
                }
            } 
            if (count($aWhere) > 1) {
                $sWhere = ' (' . implode(") $sBoolOperator (", $aWhere) . ")\n";
            } elseif (isset($aWhere[0])) {
                $sWhere = $aWhere[0];
            } else {
                // echo "<div  class='noticeBox'>".print_m($aWhere)."</div>";
            }
        } elseif (!empty($mCondition)) {
            $sWhere = $mCondition; //echo "333:<br>".print_m($sWhere)."<br>";
        }

        return $sWhere;
    }

    /**
     * Add an ORDER B restriction
     *
     * @param string $sFields List of fields to sort. E.g. $this->order('myField, b.mySecondField DESC')
     * @return ML_Database_Model_Query_Select
     */
    public function orderBy($sFields) {
        $this->aResult = null;
        $this->aResultAll = null;
        if (!empty($sFields)) {
            $this->aOrderBy[] = $sFields;
        }
        return $this;
    }

    /**
     * Limit results in query
     * @param int $iFrom
     * @param int $iLimit
     * @return ML_Database_Model_Query_Select
     * @todo refactor to natural speech
     * - limit from, count
     * - limit count
     */
    public function limit( $iFrom ,$iLimit=null) {
        $this->aResult = null;
        $this->iResult=null;
        $this->aLimit = array(
            'from' => $iLimit===null?'0':$iFrom ,
            'limit' =>  $iLimit===null?$iFrom:$iLimit ,
        );
        return $this;
    }
    
    /**
     * see createCondition document
     * @param type $mCondition
     * @return ML_Database_Model_Query_Select
     */
    public function having($mCondition) {
        $this->aResult = null;
        $this->iResult = null;
        $this->aHaving[] = $this->createCondition($mCondition);
        return $this;
    }

    /**
     * Add a GROUP BY restriction
     *
     * @param string $sFields List of fields to groupby
     * @return ML_Database_Model_Query_Select
     */
    public function groupBy($sFields) {
        $this->aResult = null;
        $this->iResult = null;
        if (!empty($sFields)) {
            $this->aGroupBy[] = $sFields;
        }

        return $this;
    }
    
    /**
     * Add Table in delete query 
     *
     * @param mixed $mTable List of fields to concat to other $mTable that should be deleted from
     * @return ML_Database_Model_Query_Select
     */
    public function delete($mTable) {
        if (is_array($mTable) && count($mTable) > 0) {
            $this->aDelete = array_merge($this->aDelete, $mTable);
        } else if (!empty($mTable)) {
            $this->aDelete[] = $mTable;
        }
        return $this;
    }
    
    /**
     * Add Table in update query and add SET part
     * @param mixed $mTable  table name or list of tabel that sould be updated
     * @param array $aSet 
     *      normal use       : array(
     *                             'fieldname' => 'value'
     *                         ) 
     * 
     *      use sql function : array(
     *                             fieldname => array('func' => '<mysql function>(<parameter ...>)')
     *                         )
     * @return ML_Database_Model_Query_Select
     */
    public function update($mTable , $aSet ) {
        if (is_array($mTable) && count($mTable) > 0) {
            $this->aUpdate = array_merge($this->aUpdate, $mTable);
        } else if (!empty($mTable)) {
            $this->aUpdate[] = $mTable;
        }
        $this->aUpdateSet = $aSet;
        return $this;
    }
    
    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildDelete() {
        return 'DELETE ' . ((count($this->aDelete) > 0) ? implode(",\n", $this->aDelete) : '' ) . "  ";
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildUpdate() {
        return 'UPDATE ' . ((count($this->aUpdate) > 0) ? implode(",\n", $this->aUpdate) : '' ) . "  ";
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildUpdateSet() {
        $sUpdateSet = 'SET ';
        foreach($this->aUpdateSet as $sKey => $sValue ){
            if(is_array($sValue)){
                $sUpdateSet .= " $sKey =  {$sValue['func']} , ";
            }else{
                $sUpdateSet .= " $sKey =  '$sValue' , ";
            }
        }
        return substr($sUpdateSet, 0,-2);
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildSelect() {
        return 'SELECT ' . ((count($this->aSelect) > 0) ? implode(",\n", $this->aSelect) : '*' ) . "\n";
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildFrom() {
        if (count($this->aFrom) > 0) {
            return 'FROM ' . implode(', ', $this->aFrom) . "\n";
        } else {
            throw new Exception('buildFrom() missed tables');
        }
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildJoin() {
        if (count($this->aJoin) > 0) {
            return implode("\n", $this->aJoin) . "\n";
        } else {
            return '';
        }
    }
    
    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildWhere() {
        if (count($this->aWhere) > 0) {
            return 'WHERE (' . implode(') AND (', $this->aWhere) . ")\n";
        } else {
            return '';
        }
    }


    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildOrderBy() {
        if (count($this->aOrderBy) > 0) {
            return 'ORDER BY ' . implode(', ', $this->aOrderBy) . "\n";
        } else {
            return '';
        }
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildLimit() {
        if ($this->aLimit['limit'] || $this->aLimit['from']) {
            $limit = $this->aLimit;
            return 'LIMIT ' . (($limit['from']) ? $limit['from'] . ', ' . $limit['limit'] : $limit['limit']);
        } else {
            return '';
        }
    }
    
    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildGroupBy() {
        if (count($this->aGroupBy) > 0) {
            return 'GROUP BY ' . implode(', ', $this->aGroupBy) . "\n";
        } else {
            return '';
        }
    }

    /**
     * build sql query regardings variable value
     * @return string
     */
    protected function buildHaving() {
        if (count($this->aHaving) > 0) {
            return 'HAVING (' . implode(') AND (', $this->aHaving) . ")\n";
        } else {
            return '';
        }
    }

    /**
     * Generate and get the query
     * @var type $blCount if true the function return count of rows that is selected
     * @return string
     */
    protected function buildSql($aBuilderFunction ) {
        $sSql = '';
        foreach ($aBuilderFunction as $sBuilder) {
            $sSql .= $this->{"build$sBuilder"}();
        }

        return $sSql;
    }

    /**
     * return array of rows
     * @todo long query log
     * @return array 
     */
    public function getResult() {
        if ($this->aResult === null) {
            $this->sExecutedSql = $this->buildSql(
                    $this->aGenericFunctions
            );
//            $i=microtime(true);
            $this->aResult = self::$oDB->fetchArray($this->sExecutedSql);
//            echo microtime(true)-$i.'<br />';
//            if(microtime(true)-$i>1){
//                echo $this->buildSql();
//            }
        }
        return $this->aResult;
    }

    
    /**
     * return array of rows
     * @todo long query log
     * @return array 
     */
    public function getRowResult() {
        if ($this->aResult === null) {
            $this->sExecutedSql =
                    $this->buildSql(
                    $this->aGenericFunctions
            );
//            $i=microtime(true);
            $this->aResult = self::$oDB->fetchRow($this->sExecutedSql);
//            echo microtime(true)-$i.'<br />';
//            if(microtime(true)-$i>1){
//                echo $this->buildSql();
//            }
        }
        return $this->aResult;
    }
    
    /**
     * return array of rows
     * @return array 
     */
    public function getAll() {
        if ($this->aResultAll === null) {
            $this->sExecutedSql = $this->buildSql(
                    $this->getFunctions(array(
                        'Limit',
                        'GroupBy',
                    ))
            );
            $this->aResultAll = self::$oDB->fetchArray($this->sExecutedSql);
        }
        return $this->aResultAll;
    }

    /**
     * Return count of selected row according to with limit included or excluded
     *
     * @param bool $blTotal , if true exclude limit from select and otherwise it will be included
     * @param string $sField
     * @return int|bool
     */
    public function getCount($blTotal = true, $sField = '*') {
        if (!$blTotal) {
            if ($this->iResult === null) {
                $this->iResult = count($this->getResult());
            }
            return $this->iResult;
        } else {
            if ($this->iResultAll === null) {
                $this->sExecutedSql = "SELECT COUNT($sField) AS count " . $this->buildSql(
                    $this->getFunctions(
                            array(
                                'Select',
                                'Limit',
                                'OrderBy'
                            )
                    )
                );
                $this->iResultAll = self::$oDB->fetchOne($this->sExecutedSql);
            }
            return $this->iResultAll;
        }
    }

    /**
     * create delete query and execute this query
     */
    public function doDelete(){
        $this->sExecutedSql = $this->buildSql(
                    array(
                        'Delete',
                        'From',
                        'Join',
                        'Where'
                    )
            );
            self::$oDB->query($this->sExecutedSql);
            return self::$oDB->affectedRows();
    }    
        
    /**
     * create update query and execute this query
     */
    public function doUpdate(){
        $this->sExecutedSql = $this->buildSql(
                    array(
                        'Update',
                        'Join',
                        'UpdateSet',
                        'Where'
                    )
            );
            self::$oDB->query($this->sExecutedSql);
            MLMessage::gi()->addDebug(self::$oDB->getLastError());
            return self::$oDB->affectedRows();
    }
    
    /**
     * 
     * @param bool $blExecuted ?executed query:calculated query
     * @return string
     */
    public function getQuery($blExecuted = true) {
        if ($blExecuted === true) {
            return $this->sExecutedSql;
        } else {
            return $this->buildSql(
                    $this->aGenericFunctions
            );
        }
    }

}
