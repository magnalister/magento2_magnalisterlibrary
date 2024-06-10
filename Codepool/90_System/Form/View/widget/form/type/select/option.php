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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
$sDataMlAlert =
    (
        isset($aField['i18n']) && $aField['i18n'] != null && array_key_exists('alert', $aField['i18n'])
        && is_array($aField['i18n']['alert'])
        && array_key_exists($aOption['key'], $aField['i18n']['alert'])
        && is_array($aField['i18n']['alert'][$aOption['key']])
        && array_key_exists('title', $aField['i18n']['alert'][$aOption['key']])
        && array_key_exists('content', $aField['i18n']['alert'][$aOption['key']])
    )
        ? json_encode($aField['i18n']['alert'][$aOption['key']])
        : '';
// allow '*' for all (or all remaining) options
if (       empty($sDataMlAlert)
        && isset($aField['i18n']) && $aField['i18n'] != null && array_key_exists('alert', $aField['i18n'])
        && is_array($aField['i18n']['alert'])
        && array_key_exists('*', $aField['i18n']['alert'])
        && is_array($aField['i18n']['alert']['*'])
        && array_key_exists('title', $aField['i18n']['alert']['*'])
        && array_key_exists('content', $aField['i18n']['alert']['*'])
    ) {
        $sDataMlAlert = json_encode($aField['i18n']['alert']['*']);
}

?>

<option
    <?php echo empty($sDataMlAlert) ? '' : 'data-ml-alert="'.htmlentities($sDataMlAlert).'" ' ?>
    <?php echo empty($aOption['dataType']) ? '' : 'data-type="'.$aOption['dataType'].'" ' ?>
    <?php echo isset($aOption['disabled']) && $aOption['disabled'] ? ' disabled ' : '' ?>
        value="<?php echo fixHTMLUTF8Entities($aOption['key'], ENT_COMPAT) ?>"
    <?php echo $aOption['selected'] ? ' selected="selected"' : '' ?>
><?php echo $aOption['value'] ?></option>
