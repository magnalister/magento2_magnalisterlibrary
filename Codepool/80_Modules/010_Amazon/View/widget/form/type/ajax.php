<?php
 if (!class_exists('ML', false))
     throw new Exception();
/*
 * example 1: $aField['ajax']['field'] is initial set (ajax will not executed by initial load)
 *  $aField['type']='ajax';
 *  $aField['ajax']=array(
 *      'selector'=>'#'.$this->getField('masterFieldName','id'),//input field css-selector which trigger ajax
 *      'trigger'=>'change',// trigger-type (optional, default=change)
 *      'field'=>array(//subfield
 *          'type'=>'string',
 *          'value'=>$this->getFirstValue($aField,$mRequestValue,'')
 *      )
 *  );
 * 
 * example 2: $aField['ajax']['field'] is not initial set (ajax will executed by initial load)
 *  $aField['type']='ajax';
 *  $aField['ajax']=array(
 *      'selector'=>'#'.$this->getField('masterFieldName','id'),//input field css-selector which trigger ajax
 *      'trigger'=>'change',// trigger-type (optional, default=change)
 *      'field'=>array(//subfield
 *          'type'=>'string',
 *          'value'=>$this->getFirstValue($aField,$mRequestValue,'')
 *      )
 *  );
 *  if(MLHttp::gi()->isAjax()){//field will be filled after ajax-request
 *      $aField['ajax']['field']=array(
 *          'type'=>'select',
 *          'values'=>$aValues,
 *          'value'=>$this->getFirstValue($aField,$mRequestValue,key($aValues))
 *      );
 *   }
 */
//    try{
$aMyField = $this->getSubField($aField);
//    }catch(Exception $oEx){
//        $aMyField=array(
//            
//        );
//    }
//    new dBug($aMyField);

// if this is cascading ajax field, render it even if in ajax call
if (MLHttp::gi()->isAjax() && (!isset($aMyField['cascading']) || $aMyField['cascading'] != true)) {
    if (isset($aMyField['type']) && $aMyField['type'] != 'ajax') {
        $this->includeType($aMyField);
    } else {
        echo '<div id="' . $aMyField['id'] . '"></div>';
    }
} else {
    $sDataAjax = htmlentities(json_encode(array(
        array('name' => MLHttp::gi()->parseFormFieldName('method'), 'value' => 'getField'),
        array('name' => MLHttp::gi()->parseFormFieldName('ajax'), 'value' => true),
        array('name' => MLHttp::gi()->parseFormFieldName($this->sAjaxPrefix) . '[method]', 'value' => $aField['realname']),
        array('name' => MLHttp::gi()->parseFormFieldName($this->sAjaxPrefix) . '[field]', 'value' => json_encode($aMyField)),
        array('name' => MLHttp::gi()->parseFormFieldName($this->sAjaxPrefix) . '[additional]', 'value' => null)
    )));
    $sDataAjaxController = htmlentities(json_encode(
        array(
            'trigger' => isset($aField['ajax']['trigger']) ? $aField['ajax']['trigger'] : 'change',
            'selector' => isset($aField['ajax']['selector']) ? $aField['ajax']['selector'] : null,
            'autoTriggerOnLoad' => !empty($aField['ajax']['field']['autoTriggerOnLoad']) ? array('selector' => '#'.$aField['id'], 'trigger' => $aField['ajax']['field']['autoTriggerOnLoad']) : false
        )
    ));
    ?>
    <div class="magnalisterAjaxForm" data-ajax-trigger="<?php echo isset($aField['ajax']['field']) ? 'false' : 'true' ?>"
            data-ajax="<?php echo $sDataAjax ?>" data-ajax-controller="<?php echo $sDataAjaxController ?>" 
            id="<?php echo $aField['id'] ?>_ajax">
        <?php
        if (isset($aField['ajax']['field'])) {
            $this->includeType($aMyField);
        } else {
            // why?
            echo $this->__('ML_TEXT_PLEASE_WAIT');
        }
        ?>
    </div>
    <?php
    MLSettingRegistry::gi()->addJs('magnalister.amazon.form.ajax.js');
}
