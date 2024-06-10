<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="js-mlFilter">
        <div>
            <?php
            foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
                ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
            }
            ?>
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[current]') ?>" value="<?php echo $aStatistic['iCurrentPage'] ?>"/><?php
            foreach ($oList->getFilters() as $sFilterName => $mFilter) {
                if (is_object($mFilter)) {
                    echo $mFilter->renderFilter($this, $sFilterName);
                } else {
                    /** @deprecated productlist-depenendcies */
                    try {
                        $this->includeView('widget_productlist_filter_'.$mFilter['type'].'_snippet', array('aFilter' => $mFilter));
                    } catch (ML_Filesystem_Exception $oEx) {
                        print_r($mFilter);
                    }
                }
            }
            ?>
        </div>
    </form>
<?php } ?>