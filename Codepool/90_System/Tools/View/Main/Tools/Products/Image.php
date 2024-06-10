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
                    All old images created.
                </span>
                <?php
            }
            ?>
            <form class="global-ajax ml-js-noBlockUi" method="POST" action="<?php echo $this->getCurrentUrl(array('method' => 'createImage')); ?>">
                <table> 
                    <tr>
                        <td>SKU</td>
                        <td><input type="text" value="<?php echo $this->getSku(); ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('sku') ?>"></td>
                        <td>if sku is set, it will create image for only this Product, otherwise it create image for all products</td>
                    </tr>
                    <tr>
                        <td>
                            Start Page</td>
                        <td><input type="text" value="<?php echo $this->getPage(); ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('page') ?>"> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Marketplace</td>
                        <td><select name="<?php echo MLHttp::gi()->parseFormFieldName('platform') ?>" class="ml-js-noBlockUi" >
                                <?php foreach (array('','ebay','amazon', 'idealo') as $i) { ?>
                                    <option<?php echo $i == $this->getPlatform() ? ' selected="selected"' : ''; ?> value="<?php echo $i ?>"><?php echo $i ?> </option>
                                <?php } ?>
                            </select></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Product per request</td>
                        <td><select name="<?php echo MLHttp::gi()->parseFormFieldName('chunksize') ?>" class="ml-js-noBlockUi" >
                                <?php foreach (array(1, 2, 5, 10, 25, 50, 75, 100) as $i) { ?>
                                    <option<?php echo $i == $this->getChunksPerPage() ? ' selected="selected"' : ''; ?> value="<?php echo $i ?>"><?php echo $i ?> per page</option>
                                <?php } ?>
                            </select></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            Type of Image</td>
                        <td><input type="text" value="products" name="<?php echo MLHttp::gi()->parseFormFieldName('imagetype') ?>"> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Size of Image</td>
                        <td><input type="text" value="<?php echo $this->getSizeValue() ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('imagesizes') ?>"></td>
                        <td> <div>separate sizes by "," and separate width and height by "_" (e.g. 420_800,500)</div></td>
                    </tr>
                    <tr>
                        <td><label for="ml-oldimagepath">Use Old Image Path</label></td>
                        <td><input id="ml-oldimagepath" value ="old" type="checkbox" name="<?php echo MLHttp::gi()->parseFormFieldName('oldimage') ?> " <?php echo( $this->oldChecked() ? 'checked=checked' : '') ?> > </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="mlbtn ml-js-noBlockUi">Create all product images path.</button></td>
                        <td></td>
                    </tr>
                </table>
            </form>
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
            <div id="ajax_register_products_image_list">
                <pre><?php
                $aInfo = $this->getCreatedImage();
                    if (!empty($aInfo)) {
                        echo print_r($aInfo, true);
                    }
                    ?></pre>
            </div>
        </td>
    </tr>
</table>
<?php
$sOut = ob_get_contents();
ob_end_clean();
if (MLHttp::gi()->isAjax()) {
    MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('#ml-createImage' => $sOut)));
} else {
    ?>
    <div id="ml-createImage">
    <?php echo $sOut; ?>
    </div>
    <?php
}