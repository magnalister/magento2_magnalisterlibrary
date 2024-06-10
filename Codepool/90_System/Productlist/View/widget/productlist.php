<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    //        new dBug($aStatistic);
    //        new dBug($oList->getHead());
    //        new dBug(array('product'=>$oList->getList()->current(),'data'=>$oList->getList()->current()->mixedData()));
    ?>
    <div class="ml-plist <?php echo MLModule::gi()->getMarketPlaceName(); ?>">
        <table class="fullWidth nospacing nopadding valigntop topControls">
            <tbody>
            <tr>
                <td class="actionLeft">
                    <?php
                    $this
                        ->includeView('widget_productlist_action_selection', array('oList' => $oList, 'aStatistic' => $aStatistic))
                        ->includeView('widget_productlist_action_top', array('oList' => $oList, 'aStatistic' => $aStatistic));
                    ?>
                </td>
                <td>
                    <table class="nospacing nopadding right">
                        <tbody>
                        <tr>
                            <td class="filterRight">
                                <div class="filterWrapper">
                                    <?php
                                    $this->includeView('widget_productlist_filter', get_defined_vars());
                                    ?>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clear"></div>
        <div class="pagination_bar" style="align-items: center;justify-content: space-between;">
            <?php
            $this->includeView('widget_productlist_pagination', get_defined_vars());
            ?>
        </div>
        <?php
        $this->includeView('widget_productlist_list', get_defined_vars());
        ?>
        <div class="pagination_bar" style="align-items: center;justify-content: space-between;">
            <?php
            $this->includeView('widget_productlist_pagination', get_defined_vars());
            ?>
				</div>
				<?php
					$this
                        ->includeView('widget_productlist_action_eachRow', array('oList' => $oList, 'aStatistic' => $aStatistic))
                        ->includeView('widget_productlist_action_bottom', array('oList' => $oList, 'aStatistic' => $aStatistic))
                    ;
                    MLSettingRegistry::gi()->addJs('magnalister.productlist.js');
                    MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true); 
                ?>
            </div>
            <script>
                const pagination_bar = document.getElementsByClassName('pagination_bar');
                Array.from(pagination_bar).forEach(pagination_bar => {
                    if(pagination_bar.innerHTML.trim() === '') {
                       /* pagination_bar.classList.add('spacer');*/
                        pagination_bar.classList.remove('pagination_bar');

                  /*      pagination_bar.style.margin = 'unset';
                        pagination_bar.style.border = 'unset';*/
                    }
                });
            </script>
        <?php 
    }
?>