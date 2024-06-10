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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
?>
<table style="width:100%;">
    <?php
        $i = 0;
        foreach ($aField['subfields'] as $aCurrentField) {
            ++$i;
            ?>
                <tr>
                    <?php if ($i == 1) { ?>
                        <td style="border:none;"><?php echo MLI18n::gi()->get('ML_OTTO_ORDER_STATUS'); ?>:</td>
                        <td style="border:none; width: 37%">
                            <?php
                            $this->includeType(array_merge($aField, array(
                                'type' => 'select',
                                'subfields' => null,
                            )));
                            ?>
                        </td>
                    <?php } else { ?>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                    <?php } ?>
                    <td style="border:none; vertical-align:middle;"><?php echo $aCurrentField['i18n']['label']; ?>:</td>
                    <td style="border:none;"><?php $this->includeType($aCurrentField); ?></td>
                </tr>
            <?php
        }
    ?>
</table>

<style>
    #otto_config_order_field_orderstatus_shipped_duplicate div {
        display: flex;
        border: 0 !important;
    }

    #otto_config_order_field_orderstatus_shipped_duplicate div div {
        margin-bottom: 5px !important;
        border-right: 1px dashed silver !important;
        border-left: 1px dashed silver !important;
        border-top: 1px solid silver !important;
        border-bottom: 1px solid silver !important;
    }

    #otto_config_order_field_orderstatus_shipped_duplicate div span {
        border: 0 !important;
    }
</style>
