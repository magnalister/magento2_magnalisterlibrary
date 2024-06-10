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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
/**
 *  @abstract needs dynamicly calculated method{
 *  @parm null $mRequestValue no request
 *  @return array will be merged with &$aField
 *  @throws Exception Field not in use
 *  protected function do{'nameAttribute'}(&$aField, $sRequestValue)
 * }
 */
abstract class ML_Form_Controller_Widget_Form_Abstract extends ML_Core_Controller_Abstract{

    protected $sFieldPrefix='field';
    protected $sActionPrefix='action';
    protected $sAjaxPrefix='ajaxData';
    protected $sOptionalIsActivePrefix='optional';
    protected $aRequestFields=array();
    protected $aRequestOptional=array();
    protected $aFields=array();
    protected $sActionTemplate = 'action-col-col-col';

    public function __construct() {
        parent::__construct();
        $this->aRequestFields   = $this->getRequest($this->sFieldPrefix);
        $this->aRequestFields   = is_array($this->aRequestFields)?$this->aRequestFields:array();
        $this->aRequestOptional = $this->getRequest($this->sOptionalIsActivePrefix);
        $this->aRequestOptional = is_array($this->aRequestOptional)?$this->aRequestOptional:array();
        $this->construct();
        $aActions=$this->getRequest($this->sActionPrefix);
        $aActions=is_array($aActions)?$aActions:array();
        foreach ($aActions as $sKey => $sValue) {
            if (method_exists($this, $sKey)) {
                $this->{$sKey}();
            } else {
                MLMessage::gi()->addDebug(get_class($this) . '::' . $sKey . '() does not exists.');
            }
        }
    }
    abstract protected function construct();

    /**
     * for type=bool2type
     */
    protected abstract function optionalIsActive($aField);
    protected function getFormWidget() {
        $this->includeView('widget_form');
    }

    protected function getAjaxData(){
        $aAjaxData=  $this->getRequest($this->sAjaxPrefix);
        $aAjaxData=is_array($aAjaxData)?$aAjaxData:null;
        if(isset($aAjaxData['method'])){
            if (isset($aAjaxData['field'])) {
                $aAjaxData['field'] = json_decode($aAjaxData['field'], true);
                $aAjaxData['field']['postname'] = $aAjaxData['field']['name'];
                $aAjaxData['field']['name'] = $aAjaxData['field']['realname'];
                unset($aAjaxData['field']['realname']);
                $aAjaxData['additional'] = json_decode($aAjaxData['additional'], true);
            }
        }
        return $aAjaxData;
    }

    public function getRequestField($sName = null, $blOptional = false) {
        // Helper for php8 compatibility - can't pass null to strtolower 
        $sName = MLHelper::gi('php8compatibility')->checkNull($sName);
        $sName = strtolower($sName);
        if ($blOptional) {
            $aFields = $this->aRequestOptional;
        } else {
            $aFields = $this->aRequestFields;
        }
        $aFields = array_change_key_case($aFields, CASE_LOWER);
        if ($sName == null) {
            return $aFields;
        } else {
            return isset($aFields[$sName]) ? $aFields[$sName] : null;
        }
    }

    public function callAjaxGetField() {
        try {
            $aAjaxData = $this->getAjaxData();
            if (isset($aAjaxData['method'])) {
                if (isset($aAjaxData['field'])) {
                    $aField = $aAjaxData['field'];
                } else {
                    $aField = array('name' => $aAjaxData['method']);
                }
                unset($aField['value']);// value will come from do-method (request-isset value)
                if (array_key_exists('subfields', $aField)) {
                    // Change August 27, 2021 from
                    // foreach ($aField['subfields'] as &$aSubField) { unset($aSubField['value']); }
                    // // Pointer will change the field names if brackets in cluded in names from field[paymentcost.price] to field[paymentcost.price][0] for no reason
                    foreach ($aField['subfields'] as $key => $aSubField) {
                        unset($aField[$key]['value']);// value will come from do-method (request-isset value)
                    }
                }
                $aField = $this->getField($aField);
                MLMessage::gi()->addDebug('ajax-field: '.$aField['realname'], $aField);
                if (isset($aField['type'])) {
                    $selector = '#'.$aField['id'].'_ajax';
                    if (isset($aField['postname'])
                        && isset($aField['ajax']['duplicated']) && $aField['ajax']['duplicated']
                    ) {
                        // if field is inside duplicate control, there are several blocks with the same ID
                        // so ID selector cannot be used. In that case, pick directly specific ajax div
                        // maybe it could always be switched to this?
                        $selector = '[data-name="'.$aField['postname'].'"]';
                    }

                    MLSetting::gi()->add('aAjaxPlugin', array(
                        'dom' => array($selector => $this->includeTypeBuffered($aField))
                    ));
                    parent::finalizeAjax();
                }
            }
        } catch (Exception $oEx) {
            MLMessage::gi()->addError($oEx->getMessage());
        }
    }
    /**
     * gets form data if current ident
     * if there is no fieldset with key == action, it makes reflection and creates this row by all public methods with name *action
     * @return array('aForm'=>array(),'aI18n'=>array())
     */
    protected function getFormArray($sType = null) {
        $aForm = MLSetting::gi()->get($this->getIdent());
        if (is_array($aForm)) {
            $aForm = array_change_key_case($aForm, CASE_LOWER);
        }
        $aI18n = MLI18n::gi()->get($this->getIdent());
        if (is_array($aI18n)) {
            $aI18n = array_change_key_case($aI18n, CASE_LOWER);
        } else {
            $aI18n = array();
        }
        if (!isset($aForm['action'])) {// adding actions by reflection
            $aActionMethods = array();
            $aActions = array();
            $oRef = new ReflectionClass($this);
            foreach ($oRef->getMethods() as $oRefMethod) {
                if (
                    strtolower(substr($oRefMethod->name, -6)) == 'action'
                    && $oRefMethod->isPublic()
                ) {
                    if (!isset($aForm['action'])) {
                        $aForm['action'] = array(
                            'row'             => array('template' => $this->sActionTemplate),
                            'translation_key' => 'form_action_default_legend',
                        );
                        $aI18n['legend']['action'] = MLI18n::gi()->get('form_action_default_legend');
                    }

                    $aMethodValues = $this->{$oRefMethod->name}(false);
                    $aFieldDataToBeMerged = array();
                    if (is_array($aMethodValues) && isset($aMethodValues['aForm'])) {
                        $aFieldDataToBeMerged = $aMethodValues['aForm'];
                    }
                    $aForm['action']['fields'][] = MLHelper::getArrayInstance()->mergeDistinct(
                        array(
                            'name'  => strtolower($oRefMethod->name),
                            'value' => strtolower(substr($oRefMethod->name, 0, -6)),
                        ),
                        $aFieldDataToBeMerged
                    );
                    if (is_array($aMethodValues) && isset($aMethodValues['aI18n'])) {
                        $aI18n['field'][strtolower($oRefMethod->name)] = $aMethodValues['aI18n'];
                    }
                }
            }
        }
        MLFormHelper::getShopInstance()->manipulateForm($aForm);
        MLFormHelper::getShopInstance()->manipulateForm($aI18n);
        $this->correctPosition($aForm);
        if ($sType === null) {
            return array(
                'aForm' => $aForm,
                'aI18n' => $aI18n,
            );
        } elseif ($sType == 'aForm') {
            return $aForm;
        } else {
            return $aI18n;
        }
    }

    /**
     * change position of some field when there fieldposition data for one of field
     * @param array $aForm
     * @throws Exception
     */
    protected function correctPosition(&$aForm) {
        foreach ($aForm as $sKeyMainGroup => $aMainGroup) {
            if(isset($aMainGroup['fields'])){
                foreach ($aMainGroup['fields'] as $sKey => $aField) {
                    if (isset($aField['fieldposition']) ) {
                        $iPos = 0;
                        if (isset($aField['fieldposition']['after'])) {
                            $sReferenceKey = $aField['fieldposition']['after'];
                            $iPos ++;
                        } elseif (isset($aField['fieldposition']['before'])) {
                            $sReferenceKey = $aField['fieldposition']['before'];
                        } else {
                            throw new Exception('You should specify to put element after or before element');
                        }
                        $aAllKeys = array_keys($aMainGroup['fields']);
                        $iPos += array_search($sReferenceKey, $aAllKeys, true);
                        unset($aForm[$sKeyMainGroup]['fields'][$sKey]);
                        array_splice($aForm[$sKeyMainGroup]['fields'], $iPos, 0, array($sKey => $aField));
                    }
                }
            }
        }
    }

    /**
     * prefill value and values of form-fields
     * remove not neccessary / /possible fields and fieldsets
     * add i18n fields
     * @return array normalized form with fieldsets, i18n, fields...
     *  array(
     *      [%fieldsetident%] => array(
     *          [fields] => array(
     *              @see $this->getField($sFieldName),
     *              ...more-fields
     *          )
     *          [id] => id-of-fieldset,
     *          [legend] => array(
     *              [i18n] => legend-content
     *              [template] => template-for-legend(default=h4 @see View/widget/form/legend/*)
     *          )
     *          [row] => array(
     *              [template] => template-for-row(default=default @see View/widget/form/row/*)
     *          )
     *      ),
     *      ...more fieldsets,
     *  )
     */
    protected function getNormalizedFormArray(){
        $sPrefix=$this->getIdent();
        extract($this->getFormArray());
        foreach($aForm as $sFieldSet=>&$aFieldSet){
            $aFieldSet=  array_change_key_case($aFieldSet,CASE_LOWER);
            $aFieldSet['id']=  str_replace('.', '_', strtolower($sPrefix.'_fieldset_'.$sFieldSet));
            $aFieldSet['translation_key'] = empty($aFieldSet['translation_key']) ? strtolower($sPrefix.'_legend_'.$sFieldSet) : $aFieldSet['translation_key'];
            if(isset($aI18n['legend'][$sFieldSet])){
                $aFieldSet['legend']['i18n']=$aI18n['legend'][$sFieldSet];
            }elseif(!isset($aFieldSet['legend']['i18n'])){
                $aFieldSet['legend']['i18n']=
                    MLSetting::gi()->get('blDebug')
                        ?'<div class="noticeBox">MLI18n: missing value<br />'.$this->getIdent().'[legend]['.$sFieldSet.']</div>'
                        :$sFieldSet
                ;
            }
            if(!isset($aFieldSet['row']['template'])){
                $aFieldSet['row']['template']='default';//default
            }
            if(!isset($aFieldSet['legend']['template'])){
                $aFieldSet['legend']['template']='h4';//default
            }
            if(isset($aFieldSet['fields'])){
                foreach ($aFieldSet['fields'] as &$aField) {
                    $aField=$this->getField($aField);
                }
            }
        }
        $aClean = $this->cleanForm($aForm);
        MLMessage::gi()->addDebug('Normalized form array', $aClean);
        return $aClean;
    }
    protected function cleanForm($aForm){
        MLFormHelper::getShopInstance()->manipulateFormAfterNormalize($aForm);
        return $aForm;
    }

    /**
     * return normalized field with i18n, template data ....
     * @param array|string $aField min: array('name'=>'fieldName') or array('realname'=>'fieldName')
     * @param string $sVector which part of field or NULL to return the whole field
     * @return array|string normalized $aField - with i18n, template data...
     *  array(
     *      [name] => html-input-parameter-name
     *      [realname] => original-name
     *      [id] => html-input-parameter-id
     *      [hint] => array([template] => template-for-hint-template(default=text) @see View/widget/form/hint/*)
     *      [i18n] => array(
     *          [label] => label-for-html-input-field
     *          [hint] => label-for-html-hint-template
     *      )
     *      [value] => value-of-html-input-field
     *      [type] => template-for-html-input-field (@see View/widget/form/type/*)
     *      [%subtype%]=>vector is eqaul to type (only if type provides subtypes eg. optional)
     *      [%%]=>depend on type template (@see View/widget/form/type/*)
     *  )
     * @throws Exception
     */
    protected function getField($aField, $sVector = null) {
        $aField = is_array($aField) ? $aField : array('name'=>$aField);
        $aField = array_change_key_case($aField, CASE_LOWER);
        $sName = strtolower(isset($aField['realname']) ? $aField['realname'] : $aField['name']);
        if (!isset($this->aFields[$sName])) {
            $sPrefix = $this->getIdent();
            $aField['realname'] = $sName;
            $aField['id'] = str_replace('.', '_', strtolower($sPrefix.'_field_'.$sName));
            if (!isset($aField['hint'])) {
                $aField['hint'] = array('template' => 'text');
            } elseif (!isset($aField['hint']['template'])) {
                $aField['hint'] = array('template' => 'text');
            }
            $aI18n = $this->getFormArray('aI18n');
            if (array_key_exists($sName, $aI18n['field'])) {
                $aI18n = $aI18n['field'][$sName];//specific i18n
            } elseif (array_key_exists('i18n', $aField)) {
                $aI18n = $aField['i18n'];// i18n defined in field
            } else {
                $aI18n = array();
            }
            foreach (array('label' => $sName) as $sI18n => $sDefaultI18n) {
                if (!isset($aI18n[$sI18n])) {
                    if (isset($aField['i18n'][$sI18n])) {//no i18n
                        $aI18n[$sI18n] = $aField['i18n'][$sI18n];
                    } else {
                        if (!is_array($aI18n)) {
                            $aI18n = array();
                        }
                        $aI18n[$sI18n] = MLSetting::gi()->get('blDebug')
                            ? '<div class="noticeBox">MLI18n: missing value<br />'.$sPrefix.'[field]['.$sName.']['.$sI18n.']</div>'
                            : $sDefaultI18n;
                    }
                }
            }
            $aField['i18n'] = $aI18n;
            if (isset($aField['subfields'])) {
                foreach ($aField['subfields'] as &$aSubField) {
                    $aSubField = $this->getField($aSubField);
                }
                unset($aSubField);
            }
            foreach ($this->getFieldMethods($aField) as $sMethod) {
                $sMethod = str_replace('.', '_', $sMethod);// no points
                if (method_exists($this, $sMethod) && !empty($aField)) {
                    $aResult = $this->{$sMethod}($aField);
                    if (is_array($aResult)) {
                        $aResult = array_change_key_case($aResult, CASE_LOWER);
                        $aField = array_merge($aField, $aResult);
                    }
                } elseif (!isset($aField['type'])){//can only happen in $sName.'Field' method. beforedo and afterdo are abstract methods
                    //                    MLMessage::gi()->addDebug('class: ' . get_class($this) . '<br />' . 'Method `' .$sMethod. '()` doesn\'t exist or type not set');
                }
            }
            $aField['name'] =
                (
                isset($aField['type']) && in_array($aField['type'],array('submit'))//submit is not a field, its a action
                    ?$this->sActionPrefix
                    :$this->sFieldPrefix
                ). '[' . $sName . ']'
            ;
            $this->aFields[$sName]=$aField;
        }
        if($sVector===null){
            return $this->aFields[$sName];
        }else{
            $sVector = strtolower($sVector);
            return isset($this->aFields[$sName][$sVector])?$this->aFields[$sName][$sVector]:null;
        }
    }
    /**
     * @return array of methods, wich fills field-info
     * eg: fieldname='hellomessage';//$this->helloMessageField($aField); //will executed
     */
    protected function getFieldMethods($aField){
        return array($aField['name'].'Field',);
    }
    /**
     * includes 'widget_form_type_'.$aField['type]
     * @param array $aField
     * @param array $aVars
     * @param bool $blAddFileErrorToMessage
     * @param string $sAltType alternative type for input rendering, in case that type is not implemented eg. api
     * @return \ML_Form_Controller_Widget_Form_Abstract
     */
    protected function includeType ($aField, $aVars=array(), $blAddFileErrorToMessage = true, $sAltType = null) {
        if(isset($aField['type'])){
            $aVars = array_merge(array('aField'=>$aField), $aVars);
            $aTypes = array('widget_form_type_'.$aField['type']);
            if ($sAltType) {
                $aTypes[] = 'widget_form_type_'.$sAltType;
            }
            parent::includeView($aTypes, $aVars, $blAddFileErrorToMessage);
        }
        return $this;
    }
    protected function includeTypeBuffered ($aField, $aVars=array(), $blAddFileErrorToMessage = true) {
        ob_start();
        $this->includeType($aField, $aVars, $blAddFileErrorToMessage);
        $sHtml = ob_get_contents();
        ob_end_clean();
        return $sHtml;
    }

    /**
     * return field-array depends on orig. type
     * @param array $aField
     * @param string $sSubType
     * @return array
     * @throws Exception
     */
    protected function getSubField($aField, $sSubType = null) {
        $sSubType === null ? $sSubType = $aField['type'] : $sSubType;
        if (isset($aField[$sSubType]['field'])) {
            $aSubfield = array_merge($aField, $aField[$sSubType]['field']);
            unset($aSubfield[$sSubType]);
            if (!isset($aSubfield['type'])) {
                throw new Exception('no subtype `'.$sSubType.'`');
            }
            return $aSubfield;
        } else {
            unset($aField['type']);
            return $aField;
            //            throw new Exception('no subfield `'.$sSubType.'`');
        }
    }

    public function valueIsSaved() {
        return null;
    }

}
