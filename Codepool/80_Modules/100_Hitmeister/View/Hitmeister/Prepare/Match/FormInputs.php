<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php
$oModul = MLModul::gi();
$oModulHelper = MLFormHelper::getModulInstance();
//    $oShop=  MLShop::gi();
$aRequest = $this->getRequest('hitmeisterProperties');
$sPreparedTs = isset($aRequest['preparedts']) ? $aRequest['preparedts'] : date('Y-m-d H:i:s');
$iShipping = isset($aRequest['shipping']) ? $aRequest['shipping'] : $oModul->getConfig('internationalshipping');
$sCondition = isset($aRequest['conditiontype']) ? $aRequest['conditiontype'] : $oModul->getConfig('itemcondition');
$sNote = isset($aRequest['conditionnote']) ? $aRequest['conditionnote'] : '';
?>
<div class="clear"></div>
<input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('hitmeisterProperties[preparedts]'); ?>" value="<?php echo $sPreparedTs; ?>"/>
<table class="hitmeister_properties hitmeister_properties2">
    <thead>
    <tr>
        <th colspan="2"><?php echo $this->__('ML_GENERIC_PRODUCTDETAILS'); ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="label top">
            <?php echo $this->__('ML_AMAZON_CONDITION_DESCRIPTION') ?><br>
            <span class="normal"><?php echo sprintf($this->__('ML_AMAZON_X_CHARS_LEFT'), '<span id="charsLeft">0</span>') ?></span>
        </td>
        <td class="options">
            <textarea id="item_note" name="<?php echo MLHttp::gi()->parseFormFieldName('hitmeisterProperties[conditionnote]') ?>" wrap="soft" cols="100" rows="10" class="fullwidth"><?php echo $sNote ?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label"><?php echo $this->__('ML_GENERIC_CONDITION'); ?></td>
        <td class="options">
            <select id="item_condition" name="<?php echo MLHttp::gi()->parseFormFieldName('hitmeisterProperties[conditiontype]') ?>">
                <?php foreach ($oModulHelper->getConditionValues() as $sKey => $sValue) { ?>
                    <option <?php echo($sCondition == $sKey ? 'selected="selected" ' : '') ?>value="<?php echo $sKey ?>"><?php echo $sValue; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr class="last">
        <td class="label"><?php echo $this->__('ML_GENERIC_SHIPPING'); ?></td>
        <td class="options">
            <select id="hitmeister_shipping" name="<?php echo MLHttp::gi()->parseFormFieldName('hitmeisterProperties[shipping]') ?>">
                <?php foreach ($oModulHelper->getShippingLocationValues() as $iKey => $sValue) { ?>
                        <option <?php echo ($iShipping == $iKey ? 'selected="selected" ' : '') ?>value="<?php echo $iKey ?>"><?php echo $sValue; ?></option>
                    <?php } ?>
                </select>
                &nbsp;<?php echo $this->__('ML_LABEL_MARKETPLACE_SHIPPING_TIME')?>:
                <select name="<?php echo MLHttp::gi()->parseFormFieldName('hitmeisterProperties[HandlingTime]') ?>">
                    <?php $iHandlingTime = MLModul::gi()->getConfig('leadtimetoship') ?>
                    <option>—</option>
                    <?php for($i=0;$i<100;$i++){?>
                        <option <?php echo($iHandlingTime == $i?'selected="selected" ':'') ?>value="<?php echo $i ?>"><?php echo $i?></option>
                    <?php } ?>    
                </select>
            </td>
        </tr>
    </tbody>
</table>
<div class="clear"></div>
<?php MLSettingRegistry::gi()->addJs('magnalister.hitmeister.countChars.js'); ?>
