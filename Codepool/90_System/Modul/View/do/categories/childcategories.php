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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
$sOut = $this->includeViewBuffered('do_categories_childcategories_tree', array('sType' => $sType, 'sParentId' => $sParentId));
$sIdent = 'ml-ajax-catContainer_' . MLModule::gi()->getMarketPlaceName() . '_' . MLModule::gi()->getMarketPlaceId() . '_' . $sType . '_';
if (MLHttp::gi()->isAjax()) {
    MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('.'.$sIdent.str_replace(array(':', '.', ' '), array('_', '\.', '_'), $sParentId) => $sOut)));
} else { 
    try {
        MLSetting::gi()->get('catModalJSInit');
    } catch (Exception $oEx) {
        MLSetting::gi()->set('catModalJSInit', true);
        ob_start();
        ?>
            <script type="text/javascript">//<![CDATA[
                (function($) {
                    jqml(document).ready(function() {
                        jqml('.magna .ml-catMatch').magnalisterCategory();
                    });
                })(jqml);
            //]]></script>
        <?php
        $sScript = ob_get_contents();
        ob_end_clean();
        MLSetting::gi()->add('aScripts', $sScript);
    }
    MLSettingRegistry::gi()->addJs('jquery.magnalister.category.js');
    MLSetting::gi()->add('aCss', 'magnalister.category.css');
    ?>
        <table class="ml-catMatch">
            <tbody>
                <tr>
                    <td class="ml-catMatch-treeContainer">
                        <form>
                            <ul class="ml-js-catMatch-tree <?php echo $sIdent.$sParentId; ?>">
                                <?php echo $sOut;?>
                            </ul>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td style="height: 0.5em"></td>
                </tr>
                <tr>
                    <td class="ml-js-catMatch-visual"></td>
                </tr>
            </tbody>
        </table>
    <?php
}
