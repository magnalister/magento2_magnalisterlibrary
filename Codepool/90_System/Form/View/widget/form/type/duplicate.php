<?php
if (!class_exists('ML', false))
    throw new Exception();
/*
 * example:
 *  $aField['type']='duplicate';
 *  $aField['duplicate']['field']['type']='string';//type for duplicate
 *  $aField['duplicate']['radiogroup] = 'string';//optional here can set a radiogroup over all duplicated
 *  $aField['value']=$this->getFirstValue($aField, $mRequestValue, '');
 */
MLSettingRegistry::gi()->addJs('jquery.magnalister.form.duplicate.js');
MLSetting::gi()->add('aCss', 'magnalister.form.duplicate.css', true);
$aMyField = $aField;
$aMyField['type'] = 'ajax';
$aMyField['ajax'] = array(
    'type'     => 'duplicate_table',
    'trigger'  => 'duplicate',
    'selector' => '#'.$aField['id'].'_duplicate button',
    'field'    => array(
        'type'      => 'duplicate_table',
        'duplicate' => $aField['duplicate']
    )
);
$this->includeType($aMyField);