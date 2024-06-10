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

if (isset($aField['postname']) && isset($aField['ajax']['duplicated'])) {
    // this means filed is inside "duplicate" control and this is ajax call.
    // field inside "duplicate" has "[X]" which was deleted in ajax handler function (callAjaxGetField)
    // we need that name because of this suffix in order to generate proper name of child controls
    $aField['name'] = $aField['postname'];
}
?>
<table style="width:100%;"<?php echo isset($aField['cssclasses']) ? ' class="'.implode(' ', $aField['cssclasses']).'"' : '' ?>>
    <?php if (!empty($aField['i18n']['matching']['titlesrc']) || !empty($aField['i18n']['matching']['titledst'])) { ?>
        <thead>
        <th style="width:50%;"><?php echo $aField['i18n']['matching']['titlesrc']; ?></th>
        <th style="width:50%;"><?php echo $aField['i18n']['matching']['titledst']; ?></th>
        </thead>
    <?php } ?>
    <tbody>
        <tr>
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
                $sValue = isset($aFieldValue['marketplaceValue']) ? $aFieldValue['marketplaceValue'] : '';

                $aSelect = array(
                    'name' => $aField['name'].'[marketplaceValue]',
                    'type' => 'string',
                    'i18n' => array(),
                    'required' => true,
                    'value' => $sValue,
                );

                if (isset($aField['error'])) {
                    $aSelect['cssclass'] .= 'error';
                }

                $this->includeType($aSelect);
                ?>
            </td>
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

                $sValue = isset($aFieldValue['shopCarrier']) ? $aFieldValue['shopCarrier'] : key($aField['valuesdst']);
                $aSelect = array(
                    'name' => $aField['name'].'[shopCarrier]',
                    'type' => 'select',
                    'required' => true,
                    'i18n' => array(),
                    'values' => $aField['valuesdst'],
                    'value' => $sValue,
                );

                if (isset($aField['error'])) {
                    $aSelect['cssclass'] .= 'error';
                }

                $this->includeType($aSelect);
                ?>
            </td>
        </tr>
    </tbody>
</table>
