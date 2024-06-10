<?php
 if (!class_exists('ML', false))
     throw new Exception();
$aMyField = $aField;
$aMyField['type'] = 'select';
$aMyField['select2'] = true;
$aMyField['name'] = $aField['name'].'[]';
$aMyField['value'] = isset($aField['value'][0]) ? $aField['value'][0] : '';
$this->includeType($aMyField);
//    $aMyField['value'] = isset($aField['value'][1]) ? $aField['value'][1] : '';
//    $this->includeType($aMyField);
?>