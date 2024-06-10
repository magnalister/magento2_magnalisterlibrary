<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<div class="ebay-shipping">
    <div>
        <div class="type">
            <?php
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
                $aCost['name'].='[ShippingServiceCost]';
                $aCost['value'] = isset($aCost['value']['ShippingServiceCost']) ? $aCost['value']['ShippingServiceCost'] : '';
                unset($aCost['values']);
                $this->includeType($aCost); 
            ?>
        </div>
    </div>
    <?php
        if (isset($aField['locations'])) {
            $aLocations = $aField;
            $aSelectedLocations = array();
            if (isset($aLocations['value']['ShipToLocation'])) {
                if (is_array($aLocations['value']['ShipToLocation'])) {
                    $aSelectedLocations = $aLocations['value']['ShipToLocation'];
                } else {//deprecated
                    $aSelectedLocations = array($aLocations['value']['ShipToLocation']);
                }
            }
            $iLimit = 4;
            $i = 0;
            $blDivOpen = false;
            $sShippingIndex = str_replace(array(']', '['), '_', strrchr($aLocations['name'], '['));
            foreach ($aLocations['locations'] as $sKey => $sLocation) {
                if ($sKey != 'None') {
                    if ($i % $iLimit === 0) {
                        ?><div><?php
                        $blDivOpen = true;
                    }
                    $aLocation['type'] = 'bool';
                    $aLocation['id'] = $aLocations['id'] . $sShippingIndex . $sKey;
                    $aLocation['name'] = $aLocations['name'] . '[ShipToLocation][]';
                    $aLocation['i18n']['valuehint'] = $sLocation;
                    $aLocation['htmlvalue'] = $sKey;
                    $aLocation['value'] = in_array($sKey, $aSelectedLocations); //isset($aLocation['value']['ShipToLocation'])?$aLocation['value']['ShipToLocation']:'';
                    $this->includeType($aLocation);
                    $i++;
                    if ($i % $iLimit === 0) {
                        ?></div><?php
                        $blDivOpen = false;
                    }
                }
            }
            if ($blDivOpen) {
                ?></div><?php
            }
        }
    ?>
</div>
