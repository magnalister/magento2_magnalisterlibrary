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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
ob_start();
?>
    <table style="width:100%;">
        <tr>
            <td style="width:50%" id="ajax_register_products_button">
                <?php
                    if ($this->getPercent() == 100) {
                        ?>
                            <span disabled="disabled" id="ajax_register_products_button" class="mlbtn">
                                All products registered.
                            </span>
                        <?php
                    } else {
                        ?>
                            <form class="global-ajax" method="GET" action="<?php echo $this->getCurrentUrl(array('method' => 'registerProducts')); ?>">
                                <select name="<?php echo MLHttp::gi()->parseFormFieldName('chunksize')?>">
                                    <?php foreach (array(1, 2, 5, 10, 25, 50, 75, 100) as $i) { ?>
                                        <option<?php echo $i == $this->getChunksPerPage() ? ' selected="selected"' : ''; ?> value="<?php echo $i ?>"><?php echo $i ?> per page</option>
                                    <?php } ?>
                                </select>
                                <button type="sumit" class="mlbtn">Register products in table `magnalister_products`.</button>
                            </form>
                        <?php 
                    } 
                ?>
            </td>
            <td>
                <div id="ajax_register_products" class="progressBarContainer">
                    <div class="progressBar" style="width: <?php echo $this->getPercent(); ?>%;">
                        <span class="progressDebug">
                            <?php echo $this->getInfo(); ?>
                        </span>
                    </div>
                    <div class="progressPercent">
                        <?php echo $this->getPercent(); ?>%
                    </div>
                </div> 
            </td>
        </tr>
    </table>
<?php
$sOut = ob_get_contents();
ob_end_clean();
if (MLHttp::gi()->isAjax()) {
    MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('#ml-registerProducts' => $sOut)));
} else {
    ?>
        <div id="ml-registerProducts">
            <?php echo $sOut; ?>
        </div>
    <?php
}