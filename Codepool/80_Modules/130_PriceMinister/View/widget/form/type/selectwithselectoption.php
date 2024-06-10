<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
$aTextValues = array();
$aSelect = $aField['subfields']['select1'];
$aSelect['type'] = isset($aSelect['type']) ? $aSelect['type'] : 'select';

foreach ($aSelect['values'] as $sKey => &$mValue) {
    if (is_array($mValue)) {
        if (isset($mValue['textoption']) && $mValue['textoption']) {
            $aTextValues[] = $sKey;
        }

        $mValue = $mValue['title'];
    }
}

$aSelect2 = $aField['subfields']['select2'];
$aSelect2['type'] = isset($aSelect2['type']) ? $aSelect2['type'] : 'select';

foreach ($aSelect2['values'] as $sKey => &$mValue) {
    if (is_array($mValue)) {
        if (isset($mValue['textoption']) && $mValue['textoption']) {
            $aTextValues[] = $sKey;
        }

        $mValue = $mValue['title'];
    }
}

MLSetting::gi()->add('aJs', 'jquery.magnalister.form.selectewithtextoption.js');
?>
<table style="width:100%"
       class="ml-selectwithtextoption<?php echo((isset($aField['required']) && empty($aField['value'])) ? ' ml-error' : ''); ?>"
       data-selectwithtextoption="<?php echo implode(' ', $aTextValues); ?>">
    <tbody>
    <tr>
        <td style="width:50%">
            <?php
            $this->includeType($aSelect);
            ?>
        </td>
        <td style="width:50%">
            <div>
                <?php
                $this->includeType($aSelect2);
                ?>
            </div>
        </td>
    </tr>
    </tbody>
</table>
