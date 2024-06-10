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

/* @var  $this  ML_Ebay_Controller_Ebay_Prepare_Apply_Form */
$sListingType = $this->getField('listingType', 'value'); //StoresFixedPrice
$blStrikeprice = (boolean)MLModule::gi()->getConfig('strikeprice.active');
?>
<table class="ebayPrice ">
    <tbody>
    <tr>
        <th><?php echo $this->__('ML_EBAY_PRICE_CALCULATED') ?>:</th>
        <td colspan="2">
            <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName($this->sOptionalIsActivePrefix.'[startprice]') ?>" value="<?php echo ($sListingType == 'Chinese') ? 'true' : 'false'; ?>"/>
            <?php echo $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject($sListingType), true, true) ?>
        </td>
    </tr>
    <?php if ($blStrikeprice && $sListingType != 'Chinese'): ?>
        <tr id="tr_strikeprice" style="visibility:<?php if ($blStrikeprice)
            echo 'visible'; else echo 'hidden'; ?>">
            <th><?php echo $this->__('ML_EBAY_STRIKE_PRICE_CALCULATED') ?>:</th>
            <td colspan="2">
                <?php echo $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject('strikeprice'), true, true) ?>
            </td>
        </tr>
    <?php endif; ?>
    <script type="text/javascript">/*<![CDATA[*/
        (function ($) {
            $(document).ready(function () {
                $('select[id="ebay_prepare_apply_form_field_strikeprice"]').change(function () {
                    var strike_price_select = $(this);
                    if (strike_price_select.val() !== 'true') {
                        document.getElementById('tr_strikeprice').style.visibility = 'hidden';
                    } else {
                        document.getElementById('tr_strikeprice').style.visibility = 'visible';
                    }
                });
                if ($('select[id="ebay_prepare_apply_form_field_strikeprice"]').val() !== 'true' && document.getElementById('tr_strikeprice') !== null) {
                    document.getElementById('tr_strikeprice').style.visibility = 'hidden';
                }
            });
        })(jqml);
        /*]]>*/</script>
    <?php
    if ($sListingType !== null) {
        if (in_array($sListingType, array('StoresFixedPrice', 'FixedPriceItem'))) {
            ?>
            <?php
        } else {//chinese
            ?>
            <tr>
                <?php
                $aPrice = $this->getField('startprice');
                $aPrice['type'] = isset($aPrice['optional']['field']['type']) ? $aPrice['optional']['field']['type'] : $aPrice['type'];
                $aPrice['value'] = number_format((float)$aPrice['value'], 2, '.', '');
                $this->includeType($aPrice);
                ?>
            </tr>
            <?php
            $aBuyItNow = $this->getField('buyitnowprice');
            $aBuyItNow['value'] = number_format((float)$aBuyItNow['value'], 2, '.', '');
            ?>
            <tr class="buynow"><?php $this->includeType($aBuyItNow); ?></tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
