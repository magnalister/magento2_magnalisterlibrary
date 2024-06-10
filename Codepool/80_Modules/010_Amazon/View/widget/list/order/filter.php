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

/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="js-mlFilter">
    <div>
        <?php
        foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
            ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
        }
        ?><input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[current]') ?>" value="<?php echo $aStatistic['iCurrentPage'] ?>" /><?php
       
        foreach ($oList->getFilters() as $sFilterName => $mFilter) {
            if (is_object($mFilter)) {
                /** @var $mFilter ML_Productlist_Model_ProductListDependency_Abstract */
                echo $mFilter->renderFilter($this, $sFilterName);
            } else {
                try {
                    $this->includeView('widget_list_order_filter_' . $mFilter['type'] . '_snippet', array('aFilter' => $mFilter));
                } catch (ML_Filesystem_Exception $oEx) {
                    print_r($mFilter);
                }
            }
        }
        ?>
    </div>
</form>