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
        '1/3'   => 'red',
        '2/3'   => 'orange',
        '3/3'   => 'green',
    );

    $percentile = 0.00;

    /** @var array $aOrder */
    if ($aOrder['HandlingTimeInMinutes'] != 0) { // exception for DivisionByZeroError
        $percentile = $aOrder['RemainingTimeForReadyForPickup'] / $aOrder['HandlingTimeInMinutes'];
    }

    # Get color range
    if ($percentile <= 0.333) {
        $color = $aStatus['1/3'];
    } else if ($percentile <= 0.666) {
        $color = $aStatus['2/3'];
    } else {
        $color = $aStatus['3/3'];
    }
?>

<p style="color:<?php echo $color?>"><?php echo $aOrder['RemainingTimeForReadyForPickup']." min"?></p>


