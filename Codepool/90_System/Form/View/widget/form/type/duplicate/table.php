<?php if (!class_exists('ML', false))
    throw new Exception();
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
            isset($aField['value']) && is_array($aField['value']) ? count($aField['value']) : 0,
            isset($aField['subfields']) && is_array($subfieldsValue) ? count($subfieldsValue) : 0
        );
    }
    if ($iFieldCount == 0) {
        $aMyField = $aField;
        $aMyField['value'] = '';
        $this->includeType($aMyField, array('iValue' => $iAddValue, 'blSub' => false,'blAdd'=>true, 'divId' => $divId));
    } else {
        if ($sAddType == 'add') {
            $blSub = true;
            $blAdd = !isset($aField['duplicate']['max'])||($iFieldCount + 1<$aField['duplicate']['max']);
        } elseif ($sAddType == 'sub') {
            $blSub = ($iFieldCount - 1) > 1;
            $blAdd = true;
        } else {
            $blSub = $iFieldCount > 1;
            $blAdd = !isset($aField['duplicate']['max'])||($iFieldCount<$aField['duplicate']['max']);
        }
        /**
         * @var string $sFieldJson
         * workaround php uses without any reason last element of $aField['subfields'] in template as a reference
         * so remember original here as JSON
         * anyway $this->includeType() dont have references in function header
         */
        $sFieldJson = json_encode($aField);
        for ($iValue = 0; $iValue < $iFieldCount; $iValue++) {
            $aMyField = json_decode($sFieldJson, true);
            if(isset($aField['fieldinfo'][$iValue]) && is_array($aField['fieldinfo'][$iValue])){//additional info to current field eg. style...
                foreach($aField['fieldinfo'][$iValue] as $sKey=>$mValue){
                    $aMyField[$sKey]=$mValue;
                }
            }
            $aMyField['value'] = isset($aField['value'][$iValue]) ? $aField['value'][$iValue] : '';
            if (isset($aField['subfields'])) {
                foreach ($aField['subfields'] as $sSubField => $aSubField) {
                    $aMyField['subfields'][$sSubField]['value'] = isset($aSubField['value'][$iValue]) ? $aSubField['value'][$iValue] : '';
                }
            }

            if ($sAddType == 'sub' && $iAddIdent == $iValue) {
                --$iAddValue;
            } else {
                $this->includeType($aMyField, array('aField' => $aMyField, 'iValue' => $iValue + $iAddValue, 'blSub' => $blSub, 'blAdd'=>$blAdd, 'divId' => $divId));
            }
            if ($sAddType == 'add' && $iAddIdent == $iValue) {
                if (array_key_exists('radiogroup', $aField['duplicate']) && $aField['duplicate']['radiogroup']) {
                    $aMyField['value'][$aField['duplicate']['radiogroup']] = 0;
                }
                ++$iAddValue;
                $this->includeType($aMyField, array('aField' => $aMyField, 'iValue' => $iValue + $iAddValue, 'blSub' => $blSub, 'blAdd' => $blAdd, 'divId' => $divId));
            }
        }
        $aField = json_decode($sFieldJson, true);
    }
    ?></div>

<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('select.ml-form-type-duplicated-norepeat').on('change', function () {
            var myOpt = [];
            jqml('select.ml-form-type-duplicated-norepeat').each(function () {
                if (myOpt.indexOf(jqml(this).val()) >= 0) {
                    jqml(this).find('option:selected').next().attr('selected', 'selected');
                }
                myOpt.push(jqml(this).val());
            });
            jqml('select.ml-form-type-duplicated-norepeat').each(function () {
                jqml(this).find("option").prop('hidden', false);
                var sel = jqml(this);
                let options = [];
                jqml.each(myOpt, function (key, value) {
                    console.log(options, value, options.indexOf(value));
                    if ((value != "" && value != sel.val()) || options.indexOf(value) >= 0) {
                        sel.find("option").filter('[value="' + value + '"]').prop('hidden', true);
                    }
                    if (myOpt.indexOf(value) < myOpt.lastIndexOf(value)) {
                        options.push(value);
                        console.log(myOpt.indexOf(value), myOpt.lastIndexOf(value));
                    }
                });
            });
        });
        jqml('select.ml-form-type-duplicated-norepeat').change();
        //jqml('#<?php //echo $aField['id'].'_ajax' ?>//').parent().on('DOMNodeInserted', 'div', function () {
        //    jqml('select.ml-form-type-duplicated-norepeat').change();
        //});
    });

    /*]]>*/</script>