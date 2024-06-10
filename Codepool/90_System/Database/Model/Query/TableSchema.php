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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Database_Model_Query_TableSchema{
    protected $sTable='';
    protected $aColumns=array();
    protected $aKeys=array();
    public function setTable($sTable){
        $this->sTable=$sTable;
        return $this;
    }
    public function setColumns($aColumns){
        // Implemented only in magento 2 because it has some restrictions regarding the allowed column types
        $aRestrictedTypes = MLShop::gi()->getDBRestrictedTypes();
        foreach ($aColumns as $sKey=>$aValue){
            if (!empty($aRestrictedTypes)) {
                foreach ($aRestrictedTypes as $restrictedType => $replacementValue) {
                    $aValue['Type'] = $restrictedType === substr($aValue['Type'], 0 , strlen($restrictedType)) ?
                        $replacementValue : $aValue['Type'];
                }
            }

            $this->aColumns[$sKey]=array(
                'Type'=>$aValue['Type'],
                'Null'=>$aValue['Null'],
                'Default'=>$aValue['Default'],
                'Extra'=>$aValue['Extra'],
                'Comment'=>$aValue['Comment']
            );
            if (isset($aValue['Collation'])) {
                $this->aColumns[$sKey]['Collation'] = $aValue['Collation'];
            }
        }
        return $this;
    }
    public function setKeys($aKeys){
        foreach($aKeys as $sKey=>$aValue){
            $this->aKeys[$sKey]=array(
                'Non_unique'=>$aValue['Non_unique'],
                'Column_name'=>$aValue['Column_name'],
            );
        }
        return $this;
    }
    public function update(){
        if(MLDatabase::getDbInstance()->tableExists($this->sTable)){
            $this->alterTable();
        }else{
            $this->createTable();
        }
        return $this;
    }
    protected function alterTable(){
        $sPrefixSql = "ALTER TABLE `".$this->sTable."`\n";
        // 1. check columns
        $aSql = array();
        $aCurrentColumns = array();
        foreach (MLDatabase::getDbInstance()->fetchArray("SHOW FULL COLUMNS FROM `".$this->sTable."`") as $aColumn) {

            // When get empty string from query we get "''" back so we will translate this to an real empty string
            if ($aColumn['Default'] === "''") {
                $aColumn['Default'] = "";
            }

            $aCurrentColumns[$aColumn['Field']] = array(
                'Type' => $aColumn['Type'],
                'Null' => $aColumn['Null'],
                'Default' => $aColumn['Default'],
                'Extra' => $aColumn['Extra'],
                'Comment' => $aColumn['Comment'],
                'Collation' => $aColumn['Collation']
            );
            if (isset($this->aColumns['Collation'])) {
                $aCurrentColumns[$aColumn['Field']]['Collation'] = $aColumn['Collation'];
            }
        }
        // 1.1 drop column
        foreach(array_keys($aCurrentColumns) as $sCurrent){
            if(!isset($this->aColumns[$sCurrent])){
                $aSql[] = "    DROP COLUMN `".$sCurrent."`,\n";
            }
        }
        // 1.2 add column, modify columns
        foreach($this->aColumns as $sColumn=>$aColumn){

            /*
             * Instead of using "array_diff_assoc" we use now "array_udiff_assoc" because the normal function will not check for empty or null values
             *  In anonymous function will compare also be type
             */
            if (isset($aCurrentColumns[$sColumn])) {
                $diffArray = array_udiff_assoc(
                    $aColumn, $aCurrentColumns[$sColumn],
                    function ($a, $b) {
                        /**
                         * compare by exact - but also allow to compare int 0 with string "0" to be the same
                         *  because all default values from database will be just string
                         */
                        if ($a === $b || (is_numeric($a) && (float)$a === (float)$b)) {
                            return 0;
                        }
                        return $a > $b ? 1 : -1;
                    }
                );
            } else {
                $diffArray = array();
            }

            if (
                !isset($aCurrentColumns[$sColumn])
                || count($diffArray) > 0
            ) {
                MLMessage::gi()->addDebug(
                    ' Different of Columns between code and database ',
                    array(
                        'Column Name' => $sColumn,
                        'Model Class' => $aColumn,
                        'Database' => isset($aCurrentColumns[$sColumn]) ? $aCurrentColumns[$sColumn] : $aCurrentColumns,
                        'Diff' => $diffArray)
                );
                if (!isset($aCurrentColumns[$sColumn])) {
                    $sSql = "   ADD COLUMN";
                } else {
                    $sSql = "   MODIFY COLUMN ";
                }
                $sSql .= $this->buildColumn($sColumn, $aColumn).", \n";
                $aSql[] = $sSql;
            }
        }
        // 2. check keys
        $aCurrentKeys=array();
        foreach(MLDatabase::getDbInstance()->fetchArray("SHOW INDEX FROM `".$this->sTable."`") as $aKey){
            $aCurrentKeys[$aKey['Key_name']]=array(
                'Non_unique' => $aKey['Non_unique'],
                'Column_name' => isset($aCurrentKeys[$aKey['Key_name']]['Column_name'])
                    ?$aCurrentKeys[$aKey['Key_name']]['Column_name'].', '.$aKey['Column_name']
                    :$aKey['Column_name'],
            );
        }
        // 2.1 drop key
        foreach(array_keys($aCurrentKeys) as $sCurrent){
            if(!isset($this->aKeys[$sCurrent])){
                MLMessage::gi()->addDebug(
                    ' Different of keys between code and database ',
                    array(
                        'Key Name' => $sCurrent,
                        'Model Class' => $this->aKeys,
                        'Database' => $aCurrentKeys,
                    )
                );
                $aSql[] = "    DROP KEY `".$sCurrent."`,\n";
            }
        }
        
        // 1.2 drop changed key and add new or changed Key
        foreach($this->aKeys as $sKey=>$aKey){
            $aKey = $this->normalizeKeys($aKey);
            $aCurrentKey = $this->normalizeKeys($aCurrentKeys[$sKey]);
            if(
                !isset($aCurrentKeys[$sKey])
                || count(array_diff_assoc($aKey, $aCurrentKey)) > 0
            ) {
                if (isset($aCurrentKeys[$sKey])) {
                    MLMessage::gi()->addDebug(
                        ' Different of primary keys between code and database ',
                        array(
                            'Key Name' => $sKey,
                            'Model Class' => $this->aKeys,
                            'Database' => $aCurrentKeys,
                        )
                    );
                    if ($sKey == 'PRIMARY') {
                        $aSql[] = "    DROP PRIMARY KEY,\n";
                    } else {
                        $aSql[] = "    DROP KEY `".$sKey."`,\n";
                    }
                }
                $aSql[] = "    ADD ".$this->buildKey($sKey, $aKey).",\n";
            }
        }

        if (count($aSql) > 0) {
            foreach ($aSql as $sSql) {
                $sSql = $sPrefixSql.$sSql;
                if (strrpos($sSql, ',') !== false) {
                    $sSql = substr($sSql, 0, strrpos($sSql, ','))."\n";
                    MLDatabase::getDbInstance()->query($sSql);
                    MLMessage::gi()->addDebug('Schema:<br />'.$sSql);
                }
            }
        }
    }
    protected function createTable(){
        $sSql = "CREATE TABLE `".$this->sTable."`(\n";
        foreach ($this->aColumns as $sColumn => $aColumn) {
            $sSql .= "    ".$this->buildColumn($sColumn, $aColumn).",\n";
        }
        foreach ($this->aKeys as $sKey => $aKey) {
            $sSql .= "    ".$this->buildKey($sKey, $aKey).",\n";
        }
        $sSql = substr($sSql, 0, strrpos($sSql, ','))."\n";
        $sSql .= ")";
        try {
            $aConnectionInfo = MLShop::gi()->getDbConnection();
            $sDBName = $aConnectionInfo['database'];
            $aCollationTableInfo = MLShop::gi()->getDBCollationTableInfo();
            if (!empty($aCollationTableInfo)) {// for shopify and shopware cloud we don't need that
                $collation = MLDatabase::getDbInstance()->fetchRow('
                            SELECT `CHARACTER_SET_NAME`, `COLLATION_NAME`
                              FROM `information_schema`.`COLUMNS`
                             WHERE TABLE_SCHEMA=\'' . $sDBName . '\' 
                                   AND TABLE_NAME=\'' . $aCollationTableInfo['table'] . '\'
                                   AND COLUMN_NAME=\'' . $aCollationTableInfo['field'] . '\'
                        ');
                if (!empty($collation) && is_array($collation)) {
                    $sSql .= "\n" . 'CHARACTER SET ' . $collation['CHARACTER_SET_NAME'] . ' COLLATE ' . $collation['COLLATION_NAME'] . ' ';
                }
            }
        } catch (Exception $ex) {
            MLMessage::gi()->addDebug($ex);
        }
        $sSql .= ";";
        MLDatabase::getDbInstance()->query($sSql);
        if (MLDatabase::getDbInstance()->tableExists($this->sTable, true)) {
            MLMessage::gi()->addDebug('Schema:<br />'.$sSql);
        } else {
            MLMessage::gi()->addDebug('Schema:<br />'.$sSql);
            MLMessage::gi()->addWarn('Schema:<br />'.MLDatabase::getDbInstance()->getLastError());
        }
    }

    protected function buildColumn($sColumn, $aColumn) {
        return
            "`".$sColumn."` ".
            $aColumn['Type']." ".
            ($aColumn['Null'] == 'NO' ? "NOT" : "")." Null".
            $this->getDefaultOfColumn($aColumn).
            ($aColumn['Extra'] != '' ? " ".$aColumn['Extra'] : "").
            ' COMMENT ' . ($aColumn['Comment'] != '' ? " '" . $aColumn['Comment'] . "' " : "''") .
            (empty($aColumn['Collation']) ? "" : " COLLATE " . $aColumn['Collation']);
    }

    protected function getDefaultOfColumn($aColumn) {
        if (in_array($aColumn['Default'], array('CURRENT_TIMESTAMP'), true)) {
            return ' DEFAULT '.$aColumn['Default']." ";
        } else if ($aColumn['Default'] !== null) {
            return " DEFAULT '".$aColumn['Default']."' ";
        }
        return '';
    }

    protected function buildKey($sKey, $aKey) {
        if ($sKey == 'PRIMARY') {
            $sSql = "PRIMARY KEY (";
        } elseif ($aKey['Non_unique'] == '0') {
            $sSql = "UNIQUE KEY `".$sKey."` (";
        } else {
            $sSql = "KEY `".$sKey."` (";
        }
        $sSql .= $aKey['Column_name'].")";
        return $sSql;
    }

    /**
     * @param $aKey array
     * @return array
     */
    protected function normalizeKeys($aKey) {
        $aKey['Column_name'] = strtolower($aKey['Column_name']);
        $aColumns = explode(',', $aKey['Column_name']);
        if (isset($aKey['Column_name']) && strpos($aKey['Column_name'], ',') !== false) {
            $aColumns = array_map('trim', $aColumns);
            $aKey['Column_name'] = implode(', ', $aColumns);
        }
        return $aKey;
    }
}
