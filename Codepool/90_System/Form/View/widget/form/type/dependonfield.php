<?php
if (!class_exists('ML', false))
    throw new Exception();
$aMyField = $this->getSubField($aField);
$sDepend = $this->getField($aField['dependonfield']['depend'], 'value');
$aMyField['name'] = $aField['name'].'['.$sDepend.']';
$aMyField['value'] = isset($aField['value']) && is_array($aField['value']) ? current($aField['value']) : '';
//new dBug(array($aField,$aMyField),'',true);
$this->includeType($aMyField);
?>
