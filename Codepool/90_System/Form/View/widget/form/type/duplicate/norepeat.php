<?php if (!class_exists('ML', false))
    throw new Exception();
$divId = $aField['id'].'_duplicate'; ?>
<div class="duplicate" id="<?php echo $divId ?>"><?php
    $aAjaxData = $this->getAjaxData();
    $sAddType = isset($aAjaxData['additional']['type']) ? $aAjaxData['additional']['type'] : '';
    $iAddIdent = isset($aAjaxData['additional']['ident']) ? $aAjaxData['additional']['ident'] : -1;
    $iAddValue = 0;
    $aField['type'] = 'duplicate_row';
    $subfieldsValue = !empty($aField['subfields']) ? $this->getField(current($aField['subfields']), 'value') : array();

    // field count is passed from the front because the other field count was not correct
    // we only use the other count during the first rendering, this was added 15.09.2021
    $iFieldCount = isset($aAjaxData['additional']['numOfRows']) ? $aAjaxData['additional']['numOfRows'] : null;
    if (!isset($iFieldCount)) {
        $iFieldCount = max(
            is_array($aField['value']) ? count($aField['value']) : 0,
            isset($aField['subfields']) && is_array($subfieldsValue) ? count($subfieldsValue) : 0
        );
    }
    if ($iFieldCount == 0) {
        $aMyField = $aField;
        $aMyField['value'] = '';
        $this->includeType($aMyField, array('iValue' => $iAddValue, 'blSub' => false, 'blAdd' => true, 'divId' => $divId));
    } else {
        if ($sAddType == 'add') {
            $blSub = true;
            $blAdd = !isset($aField['duplicate']['max']) || ($iFieldCount + 1 < $aField['duplicate']['max']);
        } elseif ($sAddType == 'sub') {
            $blSub = ($iFieldCount - 1) > 1;
            $blAdd = true;
        } else {
            $blSub = $iFieldCount > 1;
            $blAdd = !isset($aField['duplicate']['max']) || ($iFieldCount < $aField['duplicate']['max']);
        }
        //        $this->cacheDuplicateSelectionList($aField);
        /**
         * @var string $sFieldJson
         * workaround php uses without any reason last element of $aField['subfields'] in template as a reference
         * so remember original here as JSON
         * anyway $this->includeType() dont have references in function header
         */
        $sFieldJson = json_encode($aField);
        $aAddedField = array();
        for ($iValue = 0; $iValue < $iFieldCount; $iValue++) {
            $aMyField = json_decode($sFieldJson, true);
            if (isset($aField['fieldinfo'][$iValue]) && is_array($aField['fieldinfo'][$iValue])) {//additional info to current field eg. style...
                foreach ($aField['fieldinfo'][$iValue] as $sKey => $mValue) {
                    $aMyField[$sKey] = $mValue;
                }
            }
            $aMyField['value'] = isset($aField['value'][$iValue]) ? $aField['value'][$iValue] : '';
            if (isset($aField['subfields'])) {
                $aNewFieldSelection = array();
                foreach ($aField['subfields'] as $sSubField => $aSubField) {
                    $aMyField['subfields'][$sSubField]['value'] = isset($aSubField['value'][$iValue]) ? $aSubField['value'][$iValue] : '';
                    if (isset($aSubField['norepeat']) && $aSubField['norepeat']) {

                        $sCurrentSelectedValue = null;
                        foreach ($aSubField['value'] as $sKey => $sSelectedValue) {
                            if ($sKey === $iValue) {
                                $sCurrentSelectedValue = $sSelectedValue;
                            }
                            if ($aMyField['subfields'][$sSubField]['value'] !== $sSelectedValue && !($sAddType === 'sub' && $iAddIdent === $sKey)) {
                                unset($aMyField['subfields'][$sSubField]['values'][$sSelectedValue]);
                            }
                        }

                        if ($sAddType === 'add') {
                            $aNewFieldSelection[$sSubField] = $aMyField['subfields'][$sSubField]['values'];
                            $aNewItemSelection = $aMyField['subfields'][$sSubField]['values'];
                            unset($aNewFieldSelection[$sSubField][$sCurrentSelectedValue], $aNewItemSelection[$sCurrentSelectedValue], $aMyField['subfields'][$sSubField]['values'][key($aNewItemSelection)]);
                            $blAdd = count($aMyField['subfields'][$sSubField]['values']) === 1 ?  false : $blAdd ;
                        }
                    }
                }
            }

            if ($sAddType === 'sub' && $iAddIdent === $iValue) {
                --$iAddValue;
            } else {
                $this->includeType($aMyField, array('aField' => $aMyField, 'iValue' => $iValue + $iAddValue, 'blSub' => $blSub, 'blAdd' => $blAdd, 'divId' => $divId));
            }

            if ($sAddType === 'add' && $iAddIdent === $iValue) {
                if (array_key_exists('radiogroup', $aField['duplicate']) && $aField['duplicate']['radiogroup']) {
                    $aMyField['value'][$aField['duplicate']['radiogroup']] = 0;
                }
                $blAddNew = true;
                ++$iAddValue;
                foreach ($aField['subfields'] as $sSubField => $aSubField) {
                    if (isset($aSubField['norepeat']) && $aSubField['norepeat']) {
                        if (count($aMyField['subfields'][$sSubField]['values']) === 0) {
                            $blAddNew = false;
                            break;
                        } else {
                            $aMyField['subfields'][$sSubField]['values'] = $aNewFieldSelection[$sSubField];
                            $aMyField['subfields'][$sSubField]['value'] = key($aMyField['subfields'][$sSubField]['values']);
                        }
                    }
                }
                if($blAddNew) {
                    foreach ($aMyField['subfields'] as $sSubField => $aSubField) {
                        $aMyField['subfields'][$sSubField]['id'] = substr($aMyField['subfields'][$sSubField]['id'], 0, -2).'_'.$iFieldCount;
                    }
                    $this->includeType($aMyField, array('aField' => $aMyField, 'iValue' => $iValue + $iAddValue, 'blSub' => $blSub, 'blAdd' => $blAdd, 'divId' => $divId));
                }
            }
        }
        $aField = json_decode($sFieldJson, true);
    }
    ?></div>
