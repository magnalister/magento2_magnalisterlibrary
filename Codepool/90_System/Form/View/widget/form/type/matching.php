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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception();
/**
 * @param array $aField array(
 *      ...,
 *      'i18n' => array(
 *          ...,
 *          'matching' => array(
 *              'titlesrc' => (string),
 *              'titledst' => (string)
 *          )
 *      )
 *      'valuessrc' => array (
 *          (string) $key => array(
 *              (string)'i18n' => (string),
 *              'required' => (bool)
 *          ),
 *          ...
 *      )
 * )
 */
if (isset($aField['postname']) && isset($aField['ajax']['duplicated'])) {
    // this means filed is inside "duplicate" control and this is ajax call.
    // field inside "duplicate" has "[X]" which was deleted in ajax handler function (callAjaxGetField)
    // we need that name because of this suffix in order to generate proper name of child controls
    $aField['name'] = $aField['postname'];
}
$cssError  = '';
if (empty($aField['valuessrc']) && isset($aField['required']) && $aField['required'] === true) {
    $aField['cssclass'] = 'ml-error';
}
?>
<table style="width:100%;"<?php echo isset($aField['cssclass']) ? ' class="'.$aField['cssclass'].'"' : '' ?>>
    <?php if (!empty($aField['i18n']['matching']['titlesrc']) || !empty($aField['i18n']['matching']['titledst'])) { ?>
    <thead>
        <th><?php echo $aField['i18n']['matching']['titlesrc']; ?></th>
        <th><?php echo $aField['i18n']['matching']['titledst']; ?></th>
    </thead>
    <?php } ?>
    <tbody>
        <?php foreach ($aField['valuessrc'] as $sKey => $aValue) { ?>
            <tr>
                <td><?php echo $aValue['i18n'] ?></td>
                <td>
                    <?php
                        $aFieldValue = isset($aField['value']) ? $aField['value'] : '';
                        if (is_array($aFieldValue) && is_array(reset($aFieldValue))) {
                            // this means that matching field is inside "duplicate" field so value has 2 dimensions
                            // so we determine key for first dimension and take second dimension
                            // get control's number by parsing name (expected format: field[__field_name__][x])
                            $postName = explode('][', $aField['name']);
                            $valueKey = (int)rtrim(end($postName), ']');
                            $aFieldValue = isset($aFieldValue[$valueKey]) ? $aFieldValue[$valueKey] : reset($aFieldValue);
                        }

                        $sValue = isset($aFieldValue[$sKey]) ? $aFieldValue[$sKey] : key($aField['valuesdst']);
                        $aSelect = array(
                            'name' => $aField['name'].'['.$sKey.']',
                            'type' => 'select',
                            'i18n' => array(),
                            'values' => $aField['valuesdst'],
                            'value' => $sValue,
                            'cssclass' => isset($aField['cssclass']) ? $aField['cssclass'] . ' ' : ''
                        );

						if (isset($aField['error'][$sKey])) {
							$aSelect['cssclass'] .= 'error';
						}

                        if (!isset($aValue['required']) || $aValue['required'] === false) {
                            // Changed because in previous implementation array keys are recreated.
                            $aNewArray = array(MLI18n::gi()->get('form_type_matching_optional'));
                            foreach ($aSelect['values'] as $sSelectKey => $sSelectValue) {
                                $aNewArray[$sSelectKey] = $sSelectValue;
                            }
                            $aSelect['values'] = $aNewArray;
                        }

                        if (isset($aField['addonempty']) && $aField['addonempty'] === true && count($aField['valuesdst']) == 0) {
                            $aSelect['values'][$sKey] = $aValue['i18n'];
                            $aSelect['value'] = $aSelect['value'] != '' ? $aSelect['value'] : $sKey;
                        }
                        
                        if (!isset($aFieldValue[$sKey]) && isset($aField['automatch']) && $aField['automatch'] === true
                                && count($aField['valuesdst']) > 0) {
                            $aSelect['value'] = null;
                            foreach ($aField['valuesdst'] as $sDstKey => $sDstValue) {
                                if ($aValue['i18n'] == $sDstValue) {
                                    $aSelect['value'] = $sDstKey;
                                    break;
                                }
                            }
                        }

                        $this->includeType($aSelect);
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
