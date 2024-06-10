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
if (!class_exists('ML', false))
    throw new Exception();
$marketplaceName = MLModule::gi()->getMarketPlaceName();

// Getting type of tab (is it variation tab or apply form)
$selectorArray = explode('_button', $aField['id']);
$selector = $selectorArray[0];
$selector = $this->aFields[strtolower($selector)]['id'];

$sChangedSelector = ' ' . $selector;
$ini = strpos($sChangedSelector, $marketplaceName . '_prepare_');
if ($ini == 0) return '';
$ini += strlen($marketplaceName . '_prepare_');
$len = strpos($sChangedSelector, '_field', $ini) - $ini;
$tabType = substr($sChangedSelector, $ini, $len);

if ($tabType === 'variations') {
    $actionName = 'saveaction';
} else {
    $actionName = 'prepareaction';
}
?>

<button type="submit" value="<?php echo $aField['value'] ?>"
        class="mlbtn action <?php echo (!empty($aField['classes']) ? implode(' ', $aField['classes']) : ''); ?>"
        name="ml[action][<?php echo $actionName ?>]">+</button>
