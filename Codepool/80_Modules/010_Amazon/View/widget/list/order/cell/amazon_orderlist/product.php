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


/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Overview */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aOrder array */

 if (!class_exists('ML', false))
     throw new Exception();
?>
<div class="ml-hidden-detail">
    <span style="text-decoration: underline"> <?php echo $aOrder['Product'] ?></span>
    <div class="tooltip">
        <?php
        foreach ($aOrder['ItemList'] as $aItem) {
            echo $aItem['Quantity'] . ' x ' . $aItem['ProductName'] . '<br>';
        }
        ?>
    </div>
</div>
