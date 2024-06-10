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

abstract class ML_Form_Helper_Model_Table_PrepareData_Abstract{

    public $bIsSinglePrepare;
    public $aErrors;
    /**
     * Only set when we are in single preparation, in multi preparation its NULL
     *  During saving of preparation and upload its always set
     *
     * @var ML_Shop_Model_Product_Abstract $oProduct
     */
    protected $oProduct = null;
    
    /**
     * compares all entrees - if all the same, use entry, if not use default or specific
     * @var ML_Database_Model_List $oPrepareList 
     */
    protected $oPrepareList = null;
    
    /**
     * comes from request or use as primary default
     * @var array array('name'=>mValue)
     */
    protected $aRequestFields = array();
    
    /**
     * makes active or not
     * @var array array('name'=>blValue)
     */
    protected $aRequestOptional = array();
    
    /**
     * @var array calculated fields
     */
    protected $aFields = array();

    /**
     * @var array of stored database models during runtime
     */
    protected $databaseModel = array();
    
    /**
     * field names, for save in config which are optional
     * @return array
     */
    protected function getOptionalPrepareDefaultsFields() {
        $aConfigData = MLSetting::gi()->get(strtolower(MLModule::gi()->getMarketPlaceName()) . '_prepareDefaultsOptionalFields');
        return is_array($aConfigData) ? $aConfigData : array();
    }
    
    /**
     * field names, for save in config
     * @return array
     */
    protected function getPrepareDefaultsFields() {
        $aConfigData = MLSetting::gi()->get(strtolower(MLModule::gi()->getMarketPlaceName()) . '_prepareDefaultsFields');
        return is_array($aConfigData) ? $aConfigData : array();
    }
    
    /**
     * field name of preparetable for products_id
     * @return string
     */
    abstract public function getPrepareTableProductsIdField();
    
    public function saveToConfig() {
        $aFieldsToOptional = $this->getOptionalPrepareDefaultsFields();
        $aFieldsToConfig = $this->getPrepareDefaultsFields();
        $aConfig = array();
        $aConfigOptional = array();
        foreach ($aFieldsToConfig as $sName) {
            $aConfig[$sName] = $this->getField($sName,'value');
        }
        foreach ($aFieldsToOptional as $sName) {
            $aConfigOptional[$sName] = $this->optionalIsActive($sName);
        }
        MLDatabase::factory('preparedefaults')
            ->set('values', $aConfig)
            ->set('active', $aConfigOptional)
            ->save()
        ;
        unset($this->databaseModel['preparedefaults']);

        return $this;
    }
    
    /**
     * setting values with high priority eg. request
     * @param array $aRequestFields
     * @return $this
     */
    public function setRequestFields($aRequestFields = array()) {
        $this->aRequestFields = $aRequestFields;
        return $this;
    }
    
    public function setRequestOptional($aRequestOptional = array()){
        $this->aRequestOptional = $aRequestOptional;
        return $this;
    }

    /**
     * @param ML_Database_Model_List $oPrepareList
     * @return $this
     */
    public function setPrepareList($oPrepareList) {
        $this->oPrepareList = $oPrepareList;
        return $this;
    }
    
    public function getPrepareList() {
        if ($this->oPrepareList === null) {
            $oPrepareList = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_prepare')->getList();
            if ($this->oProduct === null) {
                $oPrepareList->getQueryObject()->where("false");
            }else{
                $oPrepareList->getQueryObject()->where($this->getPrepareTableProductsIdField()." = '".$this->oProduct->get('id')."'");
            }
            $this->oPrepareList = $oPrepareList;
        }
        return $this->oPrepareList;
    }
    
    /**
     * @param ML_Shop_Model_Product_Abstract  $oProduct
     * @param null $oProduct
     */
    public function setProduct($oProduct) {
        $this->resetFields();//init new product= new fields
        $this->oProduct = $oProduct;
        return $this;
    }


    protected function getRequestField($sName = null, $blOptional = false){
        $sName = strtolower($sName);
        if ($blOptional) {
            $aFields = $this->aRequestOptional;
        }else{
            $aFields = $this->aRequestFields;
        }
        $aFields = array_change_key_case($aFields, CASE_LOWER);
        if ($sName == null) {
            return $aFields;
        } else {
            return isset($aFields[$sName]) ? $aFields[$sName] : null;
        }
    } 
    
    /**
     * @param array $aFields eg.
     *   array(
     *     'justTheDoMethod' => array(),
     *     'doMethodWithPreconfiguredValues' => array('optional'=>array('active'=>true))
     *   )
     *
     * Another example array value
     *
     * 1. 'Title' => array('optional' => array('active' => true)),
     *     For fields, if they are not prepared or are null, the default value should be fetched from the configuration or default product field
     *
     * 2.  'BuyItNowPrice' => array(),
     *     For fields, if they are not prepared or are null, they shouldn't be submitted or they should submitted as null.
     *
     *
     * @return array
     */
    public function getPrepareData($aFields, $sIndex = null) {
        $aRow = array();
        foreach ($aFields as $sKey => $sField) {
            if (is_array($sField)) {
                $aField = $sField;
                $aField['name'] = $sKey;
            } else {
                $aField = array('name' => $sField);
            }
            
            if ($sIndex === 'value' && !$this->optionalIsActive($aField)) {// performance dont need any information
                $aField['value'] = null;
            } else {
                $aField = array_merge($aField, $this->getField($aField));
                if (array_key_exists('value', $aField)) {
                    $aField['value'] = $this->optionalIsActive($aField) ? $aField['value'] : null;
                }
            }
            if (array_key_exists('value', $aField)) {
                $aRow[$aField['name']] = $aField;
            }
            
        }
        if ($sIndex === null) {
            return $aRow;
        } else {
            $aOut = array();
            $sKey = strtolower($sKey);
            foreach ($aRow as $sKey => $aValue) {
                $aOut[$sKey] = $aValue[$sIndex];
            }
            return $aOut;
        }
    }  
    
    public function getFromConfig($sField, $blOptional = false) {
        if (!array_key_exists('preparedefaults', $this->databaseModel)) {
            $this->databaseModel['preparedefaults'] = MLDatabase::factory('preparedefaults');
        }

        return $blOptional ? $this->databaseModel['preparedefaults']->getActive($sField) : $this->databaseModel['preparedefaults']->getValue($sField);
    }
    
    public function getField ($aField, $sVector = null){
        $aField = is_array($aField) ? $aField : array('name' => $aField);
        $aField = array_change_key_case($aField, CASE_LOWER);
        $sName = strtolower(isset($aField['realname']) ? $aField['realname'] : $aField['name']);
        $aField['realname'] = $sName;
        if (!isset($this->aFields[$sName])) {
            $sMethod = str_replace('.', '_', $sName.'Field');// no points
             if (method_exists($this, $sMethod)) {
                $aResult = $this->{$sMethod}($aField);
                if (is_array($aResult)) {
                    $aResult = array_change_key_case($aResult, CASE_LOWER);
                    $aField = array_merge($aField, $aResult);
                }
             }
            $this->aFields[$sName] = $aField;
        }
        if ($sVector === null) {
            return $this->aFields[$sName];
        } else {
            $sVector = strtolower($sVector);
            return isset($this->aFields[$sName][$sVector]) ? $this->aFields[$sName][$sVector] : null;
        }
    }
    
    /**
     * checks if a field is active, or not
     *
     * @param string|array $aField
     *
     * @return bool
     */
    public function optionalIsActive($aField) {
        if (isset($aField['optional']['active'])) {
            // 1. already set
            $blActive = $aField['optional']['active'];
        } else {
            if (is_string($aField)) {
                $sField = $aField;
            } else {
                if (isset($aField['optional']['name'])) {
                    $sField = $aField['optional']['name'];
                } else {
                    $sField = isset($aField['realname']) ? $aField['realname'] : $aField['name'];
                }
            }
            $sField = strtolower($sField);
            // 2. get from request
            $sActive = $this->getRequestField($sField,true);
            if ($sActive == 'true' || $sActive === true) {
                $blActive = true;
            } elseif ($sActive == 'false' || $sActive === false) {
                $blActive = false;
            } else {
                $blActive = null;
            }
            if ($blActive === null) {//not in request - look in model, if null is possible
                $aFieldInfo = $this->getPrepareList()->getModel()->getTableInfo($sField);
                if (isset($aFieldInfo['Null']) && $aFieldInfo['Null'] == 'NO') {
                    $blActive = true;
                }
            }
            if ($blActive === null) {
                // 3. check if prepared
                $aPrepared = $this->getPrepareList()->get($sField, true);
                if (count($aPrepared) == 0) {//not prepared
                    // 4. is in config
                    $blActive = $this->getFromConfig($sField, true);
                    // 5. optional-field have default-value
                    $blActive = ($blActive === null && isset($aField['optional']['defaultvalue'])) ? $aField['optional']['defaultvalue'] : $blActive;
                    // 6. not prepared, not in config, no default value
                    $blActive = $blActive===null ? false : $blActive;
                } else {
                    // 7. if any null value in prepared => false
                    $blActive = in_array(null, $aPrepared, true) ? false : true;
                }
            }
        }
        return $blActive;
    }
    
    /**
     * Get value based on priority
     *  Second and following parameters will allow you fallback values
     *      first value isn't NULL will be returned
     *
     * @return mixed first not null value of func_get_args
     * @return null no value != null
     */
    protected function getFirstValue($aField) {
        $sField = strtolower(isset($aField['realname']) ? $aField['realname'] : $aField['name']);
        $mRequestValue = $this->getRequestField($sField);
        if (isset($aField['dependonfield'])) {//if depend on other field, array-key should string value of depended field
            $sDependValue = $this->getField(array('name'=>$aField['dependonfield']['depend']), 'value');
        }
        $aArray=array();
        // 1. already set value
        $aArray[__line__] = isset($aField['value'])?$aField['value']:null;
        // 2. request-value (e.g. by POST Form)
        $aArray[__line__] = $mRequestValue;
        if (isset($sDependValue) && !isset($aArray[2][$sDependValue])) {
            $aArray[__line__] = null;
        }
        // 3. is in prepare table and all values are the same
        $aPrepared = $this->getPrepareList()->get(str_replace('.', '_', $sField), true);
        $aArray[__line__] = count($aPrepared) == 1 ? current($aPrepared) : null;
        if (isset($sDependValue) && !isset($aArray[3][$sDependValue])) {
            $aArray[__line__] = null;
        }
        // 4. get from config
        $aArray[__line__] = $this->getFromConfig($sField, false);
        foreach (func_get_args() as $iValue => $sValue) {
            //5. manual added values eg. from product
            if ($iValue > 0) {
                if (isset($sDependValue)) {
                    $aArray[__line__.'('.$iValue.')'] = array($sDependValue => $sValue);
                } else {
                    $aArray[__line__.'('.$iValue.')'] = $sValue;
                }
            }
        }
        $sReturn = null;
        foreach ($aArray as $iValue => $sValue) {
            if ($sValue !== null) {
//                MLMessage::gi()->addDebug(__METHOD__."('".$sField."')".' Line '.$iValue);
                $sReturn = $sValue;
                break;
            }
        }
        if ($sReturn === null) {
            if (isset($aField['dependonfield'])) {
                $sReturn = array($this->getField($aField['dependonfield'], 'value') => null);
            }
        }
        $this->hookPrepareField($sField, $sReturn);
        return $sReturn;
    }
    
    protected function hookPrepareField($sKey, &$mValue) {
        /* {Hook} "preparefield": Enables you to extend or modify the data for the prepare forms for all marketplaces.<br><br>
           The hook will be executed before any templates will be processed (this means eventual placeholders are still intact).
           This hook will be executed in 2 places. One is during the preparation process (the form) and the other during uploading the items.
           If multiple items are prepared in one go, some variables will be null and certain fields will not be prepared (eg. title and product description).
           They will be completed during the uploading process. During the upload process these values will never be null.<br>
           <b>So if you want to append certain fields you have pay attention that your values aren't already appended! Otherwise they will be appended
           multiple times!</b><br><br>
           Variables that can be used: 
           <ul>
               <li>$iMagnalisterProductsId (?int): Id of the product in the database table `magnalister_product`. If null multiple items will be prepared.</li>
               <li>$aProductData (?array): Data row of `magnalister_product` for the corresponding $iMagnalisterProductsId. The field "productsid" is the product id from the shop. If null multiple items will be prepared.</li>
               <li>$iMarketplaceId (int): Id of marketplace</li>
               <li>$sMarketplaceName (string): Name of marketplace</li>
               <li>$sKey (string): name of form field. Use this to make sure you only manipulate the values you intend to.</li>
               <li>&$mValue (?mixed): current value for field. Overwrite the content of this variable for your additions.</li>
           </ul><br>
           Make sure to safeguard your hook for the marketplace and field you want to manipulate using $iMarketplaceId or $sMarketplaceName and $sKey.<br>
           To get a basic idea what values are available in which situation you can use the following code in your contrib file:
           <pre>&lt;?php
MLMessage::gi()->addInfo(basename(__FILE__), get_defined_vars());</pre>
           This adds an info message which can be expanded in order to see all available variables and their content.
           
        */
        if (($sHook = MLFilesystem::gi()->findhook('preparefield', 1)) !== false) {
            $iMagnalisterProductsId = $this->oProduct === null ? null : $this->oProduct->get('id');
            $aProductData = $this->oProduct === null ? null : $this->oProduct->data();
            $iMarketplaceId = MLModule::gi()->getMarketPlaceId();
            $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
            require $sHook;
        }
    }

    /**
     * Truncates HTML text without breaking HTML structure.
     * Source: https://dodona.wordpress.com/2009/04/05/how-do-i-truncate-an-html-string-without-breaking-the-html-code
     *
     * @param string $text String to truncate.
     * @param integer $length Length of returned string, including ellipsis.
     * @param string $ending Ending to be appended to the trimmed string.
     * @param boolean $exact If false, $text will not be cut mid-word
     * @param boolean $considerHtml If true, HTML tags would be handled correctly
     * @return string Trimmed string.
     */
    public function truncateStringHtmlSafe($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
    {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            // splits all html-tags to scannable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum length is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }

        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurrence of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        // add the defined ending to the text
        $truncate .= $ending;
        if ($considerHtml) {
            // delete unclosed tags in the end of string
            $truncate = preg_replace('/]*$/', '', $truncate);

            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }

    public function resetFields() {
        $this->aFields = array();
        return $this;
    }
}
