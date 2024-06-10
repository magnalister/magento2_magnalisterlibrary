<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php /** @var array $aField */ ?>


<style>
    .hovertext {
        position: relative;
    }

    .hovertext:before {
        content: attr(data-hover);
        text-transform: none;
        white-space: initial;
        visibility: hidden;
        opacity: 0;
        width: 150px;
        background-color: grey;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px 5px;
        transition: opacity 10ms ease-in-out;
        font-size: 11px;
        position: absolute;
        z-index: 1;
        left: 0;
        top: 110%;
        font-weight: normal;
    }

    .hovertext:hover:before {
        opacity: 1;
        visibility: visible;
    }


</style>

<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<div class="<?php echo $aField['id'] ?>">
    <div>
        <?php
        $aMyField = array_merge($aField, $aField['duplicate']['field']);
        unset($aMyField['duplicate']);
        $aMyField['name'] .= '['.$iValue.']';
        if (isset($aMyField['subfields'])) {
            foreach ($aMyField['subfields'] as &$aSubField) {
                $aSubField['name'] .= '['.$iValue.']';
            }
        }
        $this->includeType($aMyField,  array('iValue' => $iValue));
        ?>
    </div>
    <span>
        <?php
        if (array_key_exists('radiogroup', $aField['duplicate']) && $aField['duplicate']['radiogroup']) {
            echo MLI18n::gi()->get('form_type_duplicate_radiogroup'); ?><input class="ml-js-form-duplicate-radiogroup" type="radio" name="<?php echo md5($aField['name'].'['.$aField['duplicate']['radiogroup'].']'); ?>" value="1"<?php echo is_array($aMyField['value']) && array_key_exists($aField['duplicate']['radiogroup'], $aMyField['value']) && !empty($aMyField['value'][$aField['duplicate']['radiogroup']]) ? ' checked="checked"' : '' ; ?> /><?php
            ?><input class="ml-js-form-duplicate-radiogroup" type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName($aMyField['name'].'['.$aField['duplicate']['radiogroup'].']'); ?>" value="<?php echo is_array($aMyField['value']) && array_key_exists($aField['duplicate']['radiogroup'], $aMyField['value']) ? $aMyField['value'][$aField['duplicate']['radiogroup']] : '' ; ?>" /><?php
        }
        ?>
        <button <?php echo $blAdd? '' : ' disabled="disabled"' ?>class="mlbtn fullfont mlbtnPlus hovertext" type="button" data-hover="<?php echo MLI18n::gi()->get('ML_DUPLICATE_INFO'); ?>" data-ajax-additional="<?php echo htmlentities(json_encode(array('type' => 'add', 'ident' => $iValue, 'divId' => $divId))); ?>">&#043;</button>
        <button <?php echo $blSub ? '' : ' disabled="disabled"' ?>class="mlbtn fullfont mlbtnMinus hovertext" type="button" data-hover="<?php echo MLI18n::gi()->get('ML_DUPLICATE_INFO'); ?>" data-ajax-additional="<?php echo htmlentities(json_encode(array('type' => 'sub', 'ident' => $iValue, 'divId' => $divId))); ?>">&#8211;</button>
    </span>
</div>