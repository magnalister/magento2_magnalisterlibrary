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

    /* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
    /* @var $oList ML_Productlist_Model_ProductList_Abstract */
    /* @var $oProduct ML_Shop_Model_Product_Abstract */
     if (!class_exists('ML', false))
         throw new Exception();

    $aStatus = array(
        '1'   => 'red',
        '2-3' => 'orange',
        '>3'  => 'green'
    );

    # Get store
    $supplySourceCodes = MLModule::gi()->getConfig('bopis.array.supplysourcecode');
    $storeKey = array_search($aOrder['SupplySourceCode'], $supplySourceCodes);

    # Get effective days until pickup
    $daysTillPickup = isset($aOrder['InventoryHoldPeriodInDays']) ? $aOrder['InventoryHoldPeriodInDays']:5;
    $now = new DateTime;
    $purchaseDate = new DateTime($aOrder['PurchaseDate']);
    $deadlineDate = $purchaseDate->add(new DateInterval('P1D'))->add(new DateInterval('P'.$daysTillPickup.'D'));
    $useFromMaster = MLModule::gi()->getConfig('bopis.array.capabilities.pickupchannel.operationalconfiguration.usefrommaster');
    if($useFromMaster[$storeKey] === 'yes') {
        $deadlineDateOpeningHours = MLModule::gi()->getConfig('bopis.array.configuration.operationalconfiguration.'.strtolower($deadlineDate->format('l').'.starttime'));
    } else {
        $deadlineDateOpeningHours = MLModule::gi()->getConfig('bopis.array.capabilities.pickupchannel.operationalconfiguration.'.strtolower($deadlineDate->format('l').'.starttime'));
    }

    while (!$deadlineDateOpeningHours[$storeKey] && $daysTillPickup < 7) {
        MLMessage::gi()->addDebug('$daysTillPickup', $daysTillPickup);
        $daysTillPickup++;
        $deadlineDate->add(new DateInterval('P1D'));
        $deadlineDateOpeningHours = MLModule::gi()->getConfig('bopis.capabilities.pickupchannel.operationalconfiguration.operatinghoursbyday.'.strtolower($deadlineDate->format('l').'.starttime'));
    }
    # Get remaining days for pickup
    $startDate = new DateTime($aOrder['PurchaseDate']);

    $remainingDaysForPickup = round(max($daysTillPickup - ((new \DateTime)->getTimestamp() - $startDate->getTimestamp())/60/60/24,0),2);

    # Get color
    if ($remainingDaysForPickup <= 1) {
        $color = $aStatus['1'];
    } else if ($remainingDaysForPickup <= 3 ) {
        $color = $aStatus['2-3'];
    } else {
        $color = $aStatus['>3'];
    }
?>

<p style="color:<?php echo $color?>"><?php echo $remainingDaysForPickup." days"?></p>


