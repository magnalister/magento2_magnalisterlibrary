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
?>


<table class="attributesTable ml-result" id="ml-<?php echo $this->getIdent(); ?>">
    <thead>
        <tr>
            <td colspan="2">
                <form class="global-ajax ml-js-noBlockUi" method="GET" action="<?php echo $this->getCurrentUrl(); ?>">
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method'); ?>" value="executeMethod" />
                    <select name="<?php echo MLHttp::gi()->parseFormFieldName('callAjaxMethod'); ?>">
                        <?php foreach ($this->getAjaxMethods() as $sAjaxMethod) { ?>
                        <option<?php echo $sAjaxMethod == MLRequest::gi()->data('callAjaxMethod') ? ' selected="selected"' : ''; ?> value="<?php echo $sAjaxMethod ?>"><?php echo $sAjaxMethod ?>()</option>
                        <?php } ?>
                    </select>
                    <button type="sumit" class="mlbtn">callAjax</button>
                </form>
            </td>
            </tr></thead>
    <tbody><tr><th class="ml-result-head" style="background: gray;"></th><td class="ml-result-content" style="background: silver;"></td></tr></tbody>
</table>
