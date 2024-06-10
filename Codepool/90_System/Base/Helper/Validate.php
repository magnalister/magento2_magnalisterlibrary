<?php

MLFilesystem::gi()->loadClass("helper_validationtype_regex");
MLFilesystem::gi()->loadClass("helper_validationtype_length");
/**
 * $oValidate = MLHelper::gi("validate");
 * var_dump($oValidate->setValue('test')->add(new ML_Base_Helper_ValidationType_Length(), array ('<'=>5))->add(new ML_Base_Helper_ValidationType_Regex(), array('/[a-z]/'))->validate());
 * var_dump($oValidate->setValue('test more then 5 chars')->add(new ML_Base_Helper_ValidationType_Length(), array ('<'=>5))->add(new ML_Base_Helper_ValidationType_Regex(), array('/[a-z]/'))->validate());
 * var_dump($oValidate->setValue('test')->addArray(array(array(new ML_Base_Helper_ValidationType_Length(), array ('>='=>4)),array(new ML_Base_Helper_ValidationType_Regex(), array('/[a-z]/'))))->validate());
 */
class ML_Base_Helper_Validate {

    protected $mValue;
    protected $aType = array();
    
    public function setValue($mValue) {
        $this->mValue = $mValue;
        return $this;
    }

    /**
     * 
     * @param ML_Base_Helper_ValidationType_Abstract $oType
     * @param array $aInfo
     *         array(
     *              '>' => 3
     *         )
     * or
     *         array(
     *             '/[1-9]/'
     *         )
     * @return ML_Base_Helper_Validate
     */
    public function add(ML_Base_Helper_ValidationType_Abstract $oType, $aInfo ) {
        $this->aType[] = array('type' => $oType, 'info' => $aInfo);       
        return $this;
    }
    
    /**
     * 
     * @param array $aFactors
     * array(
     *      array(
     *         new ML_Base_Helper_ValidationType_Length() ,
     *         array(
     *              '>' => 3
     *         )
     *       ) ,
     *      array(
     *         new ML_Base_Helper_ValidationType_Regex() ,
     *         array(
     *             '/[1-9]/'
     *         )
     *       ) 
     * )
     * @return \ML_Base_Helper_Validate
     */
    public function addArray( $aFactors) {
        foreach ($aFactors as  $aFactor) {
            $oType = array_shift($aFactor);
            $aInfo = array_shift($aFactor);
            $this->add( $oType,  $aInfo);       
        }
        
        return $this;
    }
    /**
     * 
     * @return bool
     */
    function validate() {
        $blResult = true;
        foreach ($this->aType as $aType) {
            $oTaype = $aType['type'];
            $aCondition = $aType['info'];
            if ($oTaype instanceof ML_Base_Helper_ValidationType_Length) {
                $sOparand = (int) reset($aCondition);
                $sOperator = trim(key($aCondition));
                $iLength = strlen((string) $this->mValue);
                switch ($sOperator) {
                    case '>': {
                            $blResult &= $iLength > $sOparand;
                            break;
                        }
                    case '>=': {
                            $blResult &= $iLength >= $sOparand;
                            break;
                        }
                    case '<': {
                            $blResult &= $iLength < $sOparand;
                            break;
                        }
                    case '>=': {
                            $blResult &= $iLength <= $sOparand;
                            break;
                        }
                    case '=': {
                            $blResult &= $iLength == $sOparand;
                            break;
                        }
                    case '!=': {
                            $blResult &= $iLength != $sOparand;
                            break;
                        }
                }
            } elseif ($oTaype instanceof ML_Base_Helper_ValidationType_Regex) {
                $sCondition = array_shift($aCondition);
                $blResult &= preg_match((string) $sCondition, $this->mValue);
            } else {
                MLMessage::gi()->addError("your validation type is not found");
            }
        }
        return (bool) $blResult;
    }

}
