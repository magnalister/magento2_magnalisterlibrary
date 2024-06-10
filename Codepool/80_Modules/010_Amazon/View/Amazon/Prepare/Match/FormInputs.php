<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

$aPreparedData = $this->getCurrentProduct();
$oModul = MLModule::gi();
$oModulHelper = MLFormHelper::getModulInstance();
//    $oShop=  MLShop::gi();
$aRequest = $this->getRequest('amazonProperties');
$sPreparedTs = isset($aRequest['preparedts']) ? $aRequest['preparedts'] : date('Y-m-d H:i:s');
$iShipping = isset($aRequest['shipping']) ? $aRequest['shipping'] : (isset($aPreparedData['WillShipInternationally']) ? $aPreparedData['WillShipInternationally'] : $oModul->getConfig('internationalshipping'));
$sCondition = isset($aRequest['conditiontype']) ? $aRequest['conditiontype'] : (isset($aPreparedData) ? $aPreparedData['ConditionType'] : $oModul->getConfig('itemcondition'));
$sNote = isset($aRequest['ConditionNote']) ? $aRequest['ConditionNote'] : (isset($aPreparedData) && isset($aPreparedData['ConditionNote']) ? $aPreparedData['ConditionNote'] : '');
$iShippingTime = isset($aPreparedData['ShippingTime'])
    ? $this->getPrepareProductHelper()
        ->getTableModel()
        ->init()
        ->set('productsid', $aPreparedData['Id'])
        ->get('shippingtime')
    : MLModule::gi()->getConfig('leadtimetoship');
$bB2bActive = isset($aRequest['B2BActive']) ? $aRequest['B2BActive'] : (isset($aPreparedData) && isset($aPreparedData['B2BActive']) ? $aPreparedData['B2BActive'] : MLDatabase::factory('preparedefaults')->getValue('b2bactive'));

// Merchant Shipping Group Support
$aTemplates = MLModule::gi()->getConfig('shipping.template');
$aTemplateName = MLModule::gi()->getConfig('shipping.template.name');

$sPreparedTemplate = isset($aPreparedData) && isset($aPreparedData['ShippingTemplate']) ? $aTemplateName[$aPreparedData['ShippingTemplate']] : '';

$aMSGValues = array();
foreach ($aTemplates as $iKey => $aValue) {
    if ($aValue['default'] == '1' && empty($sPreparedTemplate)) {
        $sPreparedTemplate = $aTemplateName[$iKey];
    }
    $aMSGValues[$iKey] = $aTemplateName[$iKey];
}

$shopData = MLShop::gi()->getShopInfo();

?>
<div class="clear"></div>
<input  type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[preparedts]'); ?>" value="<?php echo $sPreparedTs; ?>" />
<table class="amazon_properties amazon_properties2">
    <thead><tr><th colspan="2"><?php echo $this->__('ML_GENERIC_PRODUCTDETAILS'); ?></th></tr></thead>
    <tbody>
    <tr>
        <td class="label">
            <?php echo $this->__('ML_AMAZON_CONDITION_DESCRIPTION') ?><br>
            <span class="normal"><?php echo sprintf($this->__('ML_AMAZON_X_CHARS_LEFT'), '<span id="charsLeft">0</span>') ?></span>
        </td>
        <td class="options">
            <textarea id="item_note" name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[ConditionNote]') ?>" wrap="soft" cols="100" rows="10" class="fullwidth"><?php echo $sNote ?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label"><?php echo $this->__('ML_GENERIC_CONDITION'); ?></td>
        <td class="options">
            <select id="item_condition" name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[conditiontype]') ?>">
                <?php foreach ($oModulHelper->getConditionValues() as $sKey => $sValue) { ?>
                    <option <?php echo ($sCondition == $sKey ? 'selected="selected" ' : '') ?>value="<?php echo $sKey ?>"><?php echo $sValue; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label"><?php echo $this->__('ML_AMAZON_SHIPPING_TIME'); ?></td>
        <td class="options">
            <select name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[ShippingTime]') ?>">
                <option <?php echo($iShippingTime == '-' ? 'selected="selected" ' : '') ?> value="-"><?php echo $this->__('ML_AMAZON_SHIPPING_TIME_DEFAULT_VALUE'); ?></option>
                <option <?php echo($iShippingTime == 'config' || $iShippingTime == null ? 'selected="selected" ' : '') ?> value="config"><?php echo $this->__('ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_CONFIGURATION'); ?></option>
                <option <?php echo($iShippingTime == '0' ? 'selected="selected" ' : '') ?> value="0"><?php echo $this->__('ML_AMAZON_SHIPPING_TIME_SAMEDAY_VALUE'); ?></option>
                <?php for ($i = 1; $i < 31; $i++) { ?>
                    <option <?php echo($iShippingTime == $i ? 'selected="selected" ' : '') ?>value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">
            <?php echo  $this->__('amazon_prepare_apply_form__field__b2bactive__label'); ?><br>
            <span class="normal"><?php echo sprintf($this->__('amazon_prepare_apply_form__field__b2bactive__help_matching')) ?></span>
        </td>
        <td class="radio">
            <input type="radio" id="b2bactive_true" value="true" name="b2bactive" <?php echo ($bB2bActive) ? 'checked="checked"': '' ?>>
            <label for="b2bactive_true"><?php echo  $this->__('amazon_config_price__field__b2bactive__values__true'); ?></label>
            <input type="radio" id="b2bactive_false" value="false" name="b2bactive" <?php echo (!$bB2bActive) ? 'checked="checked"': '' ?>>
            <label for="b2bactive_false"><?php echo  $this->__('amazon_config_price__field__b2bactive__values__false'); ?></label>
            <script type="text/javascript">
                (function ($) {
                    jqml(document).ready(function() {
                        jqml('input[name="b2bactive"]').on('change', function () {
                            jqml('#b2bactive').val(jqml(this).val());
                        });
                    });
                })(jqml);
            </script>
            <input type="hidden" id="b2bactive" name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[B2BActive]') ?>" value="<?php echo $bB2bActive ? 'true' : 'false'; ?>">
        </td>
    </tr>
    <?php if (!empty($aMSGValues)) { ?>
        <tr>
            <td class="label"><?php echo $this->__('ML_AMAZON_MERCHANT_SHIPPING_GROUP'); ?></td>
            <td class="options">
                <select name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[ShippingTemplate]') ?>">
                    <?php foreach($aMSGValues as $iKey => $MSGValue) { ?>
                        <option <?php echo($MSGValue == $sPreparedTemplate ? 'selected="selected" ' : '') ?>value="<?php echo $iKey ?>"><?php echo $MSGValue ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
    <?php } ?>
    <?php if ($shopData['DATA']['IsBopisPilot'] === 'yes') {
        $bopisStores = MLModule::gi()->GetBopisStores();
        $preparedStores = isset($aPreparedData['BopisStores']) ? $aPreparedData['BopisStores'] : array();
        if (!empty($preparedStores)) {
            if (is_string($preparedStores)) {
                $preparedStores = explode(',', $preparedStores);
            }
        }
        ?>
        <tr class="last">
            <td class="label"><?php echo $this->__('ML_AMAZON_BOPIS_STORES'); ?></td>
            <td class="options">
                <select name="<?php echo MLHttp::gi()->parseFormFieldName('amazonProperties[BopisStores]') ?>" multiple="multiple" size="12" style="width: 100%; height: 100%">
                    <?php foreach($bopisStores as $storeId => $store) { ?>
                        <option <?php echo(in_array($storeId, $preparedStores) ? 'selected="selected" ' : '') ?>value="<?php echo $storeId ?>"><?php echo $store ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div class="clear"></div>
<?php MLSettingRegistry::gi()->addJs('magnalister.amazon.countChars.js'); ?>
