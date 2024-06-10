<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<div class="hood-shipping">
    <div>
        <div class="type">
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

$aType = $aField;
            $aType['type'] = 'select';
            $aType['name'] .= '[ShippingService]';
            $aType['value'] = isset($aType['value']['ShippingService']) ? $aType['value']['ShippingService'] : '';
            $this->includeType($aType);
            ?>
        </div>
        <div class="text"><?php echo $aField['i18n']['cost'] ?>:</div>
        <div class="cost">
            <?php
            $aCost = $aField;
            $aCost['type'] = 'string';
            $aCost['name'] .= '[ShippingServiceCost]';
            $aCost['value'] = isset($aCost['value']['ShippingServiceCost']) ? $aCost['value']['ShippingServiceCost'] : '';
            unset($aCost['values']);
            $this->includeType($aCost);
            ?>
        </div>
    </div>
    <br/>
</div>
