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

/* @var $this ML_Amazon_Controller_Amazon_ShippingLabel_Overview|ML_Amazon_Controller_Amazon_ShippingLabel_Upload */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php
if (
        !isset($aStatistic['blPagination']) ||
        (
        isset($aStatistic['blPagination']) &&
        $aStatistic['blPagination'] == true
        )
) {
?>
    <?php
    $offSet = $aStatistic['iCountPerPage']*$aStatistic['iCurrentPage']+1;
    $limit = ($aStatistic['iCountPerPage']*($aStatistic['iCurrentPage']+1)) < $aStatistic['iCountTotal'] ? $aStatistic['iCountPerPage']*($aStatistic['iCurrentPage']+1) : $aStatistic['iCountTotal']; ;
    $space = '<input type="submit" class="ml-pagButton space" value="..."/>';
    ?>
    <div>
        <span class="bold">
           <?php echo MLI18n::gi()->get('ML_LABEL_PRODUCTS') . ':&nbsp; ' . $offSet . ' '.MLI18n::gi()->errorlog_pagination_to .' ' . $limit . ' '.MLI18n::gi()->errorlog_pagination_of.' '. $aStatistic['iCountTotal'] . '&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
        </span>
        <span class="bold">
           <?php echo MLI18n::gi()->get('ML_LABEL_CURRENT_PAGE') . ':&nbsp; ' . ($aStatistic['iCurrentPage']+1); ?>
        </span>
    </div>
    <div id="paginationBox" style="display: inline-flex">
        <?php
        if (
            !isset($aStatistic['blPagination'])
            ||
            (
                isset($aStatistic['blPagination'])
                &&
                $aStatistic['blPagination'] == true
            )
        ) {
            ?>
            <?php
            $iPageCount = ((int)($aStatistic['iCountTotal'] / $aStatistic['iCountPerPage'])) - ($aStatistic['iCountTotal'] % $aStatistic['iCountPerPage'] > 0 ? 0 : 1);
            $iPageCount = ($iPageCount < 0) ? 0 : $iPageCount;
            ?>
            <?php
            // first page
            if ($iPageCount >= 1 && $aStatistic['iCurrentPage'] > 0) {
                $this->includeView(
                    'widget_list_order_pagination_form_snippet',
                    array(
                        'oList'       => $oList,
                        'iLinkedPage' => $aStatistic['iCurrentPage']-1,
                        'sLabel'      => '<',
                        'aStatistic'  => $aStatistic
                    )
                );
            }
            if ($iPageCount > 1) {
                $this->includeView(
                    'widget_list_order_pagination_form_snippet',
                    array(
                        'oList' => $oList,
                        'iLinkedPage' => 0,
                        'sLabel' => 1,
                        'aStatistic' => $aStatistic
                    )
                );
            }
            ?>
            <?php
            if ($iPageCount > 7) {
                if ($aStatistic['iCurrentPage'] < 2) { // for the first 3 pages
                    $iStart = 1;
                    $iEnd = 2;
                } elseif ($aStatistic['iCurrentPage'] == 2) { // for 3rd page
                    $iStart = $aStatistic['iCurrentPage'] - 1;
                    $iEnd = $aStatistic['iCurrentPage'] + 1;
                } elseif ($aStatistic['iCurrentPage'] == 3) {
                    $iStart = $aStatistic['iCurrentPage'] - 2;
                    $iEnd = $aStatistic['iCurrentPage'] + 1;
                } elseif ($aStatistic['iCurrentPage'] == $iPageCount - 3) { //for third last page
                    $iStart = $aStatistic['iCurrentPage'] - 1;
                    $iEnd = $aStatistic['iCurrentPage'] + 2;
                } elseif ($aStatistic['iCurrentPage'] == $iPageCount - 2) { //for second last page
                    $iStart = $aStatistic['iCurrentPage'] - 1;
                    $iEnd = $aStatistic['iCurrentPage'] + 1;
                } elseif ($aStatistic['iCurrentPage'] == $iPageCount - 1) { // last page
                    $iStart = $aStatistic['iCurrentPage'] - 2;
                    $iEnd = $aStatistic['iCurrentPage'];
                } else {
                    $iStart = $aStatistic['iCurrentPage'] == $iPageCount ? $aStatistic['iCurrentPage'] - 2 : $aStatistic['iCurrentPage'] - 1;
                    $iEnd = $aStatistic['iCurrentPage'] == $iPageCount ? $aStatistic['iCurrentPage'] - 1 : $aStatistic['iCurrentPage'] + 1;
                }
                $sLabel = $iPageCount;
            } elseif ($iPageCount > 1) {
                $iStart = 1;
                $iEnd = $iPageCount;
            } else {
                $iStart = 0;
                $iEnd = $iPageCount;
            }

            echo $aStatistic['iCurrentPage'] > 3 && $iPageCount > 7 ? $space : '';
            for ($iCount = $iStart; $iCount <= $iEnd; ++$iCount) { ?>
                <?php
                $this->includeView(
                    'widget_list_order_pagination_form_snippet',
                    array(
                        'oList' => $oList,
                        'iLinkedPage' => $iCount,
                        'sLabel' => $iCount+1,
                        'aStatistic' => $aStatistic
                    )
                );
                ?>
            <?php }
            echo $aStatistic['iCurrentPage'] <= $iPageCount-4 && $iPageCount > 7 ? $space : '';
            ?>
            <?php
            // last page
            if ($iPageCount>7) {
                $this->includeView(
                    'widget_list_order_pagination_form_snippet',
                    array(
                        'oList' => $oList,
                        'iLinkedPage' => $iPageCount,
                        'sLabel' => $iPageCount+1,
                        'aStatistic' => $aStatistic
                    )
                );
            }
            if ($aStatistic['iCurrentPage'] < $iPageCount) {
                $this->includeView(
                    'widget_list_order_pagination_form_snippet',
                    array(
                        'oList'       => $oList,
                        'iLinkedPage' => $aStatistic['iCurrentPage']+1,
                        'sLabel'      => '>',
                        'aStatistic'  => $aStatistic
                    )
                );
            }
            ?>
        <?php } ?>
    </div>
<?php } ?>
