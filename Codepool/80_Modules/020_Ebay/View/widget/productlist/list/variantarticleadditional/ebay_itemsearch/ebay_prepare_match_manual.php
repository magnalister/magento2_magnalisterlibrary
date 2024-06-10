<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
/* @var $aAdditional array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    $oI18n = MLI18n::gi();
    ?>
    <tr class="ml-ebay-itemsearch child" id="ml-ebay-itemsearch-<?php echo $oProduct->get('id') ?>">
        <?php
        if (MLHttp::gi()->isAjax()) {
            ob_start();
        }
        ?>
        <td colspan="2"></td>
        <td colspan="<?php echo count($this->getProductList()->getHead()) - 1 ?>">
            <div class="content">
                <form id="ml-ebay-product-row-form-<?php echo $oProduct->get('id') ?>" action="<?php echo $this->getCurrentUrl() ?>" method="post">
                    <table>
                        <thead>
                            <tr>
                                <th class="select"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_Select') ?></th>
                                <th class="title"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_Title') ?></th>
                                <th class="category"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_SkuOfManufacturer') ?></th>
                                <th class="price"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_Barcode') ?></th>
                                <th class="asin"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_Epid') ?></th>
                            </tr>
                        </thead>
                        <tbody class="js-row-action startform">
                            <?php
                                $sCurrEpid = MLDatabase::factory('ebay_prepare')->set(MLDatabase::factory('ebay_prepare')->getProductIdFieldName(), $oProduct->get('id'))->get('epid');
                                foreach ($aAdditional['aSearchResult'] as $iRow => $aResult) {
                                    ?>
                                    <?php $sInputId = 'ebayItemSearch_' . $oProduct->get('id') . '_' . $iRow ?>
                                    <tr>
                                        <td class="select">
                                            <input id="<?php echo $sInputId ?>"<?php echo($sCurrEpid == $aResult['EPID']) ? ' checked="checked"' : '' ?> type="radio" name="<?php echo MLHttp::gi()->parseFormFieldName('data') ?>" value="<?php echo $aResult['EPID'] ?>" />
                                        </td>
                                        <td class="title"><label for="<?php echo $sInputId ?>"><?php echo $aResult['Title'] ?></label></td>
                                        <td class="category"><label for="<?php echo $sInputId ?>"><?php echo $aResult['MPN'] ?></label></td>
                                        <td class="price"><label for="<?php echo $sInputId ?>"><?php echo $aResult['GTIN'] ?></label></td>
                                        <td class="asin ml-js-noBlockUi"><label for="<?php echo $sInputId ?>"><a href="<?php echo $aResult['URL'] ?>" target="_blank"><?php echo $aResult['EPID'] ?></a></label></td>
                                    </tr>
                                <?php } ?>
                                <tr class="createNewProduct">
                                    <?php $sInputId = 'ebayItemSearch_' . $oProduct->get('id') . '_newproduct' ?>
                                    <td class="select">
                                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                                        <?php } ?>
                                        <input id="<?php echo $sInputId ?>"<?php echo($sCurrEpid == 'newproduct') ? ' checked="checked"' : '' ?> value="newproduct" type="radio" name="<?php echo MLHttp::gi()->parseFormFieldName('data') ?>"/>
                                    </td>
                                    <td class="title" colspan="4"><label for="<?php echo $sInputId ?>"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_CreateNewProduct') ?></label></td>
                                </tr>
                                <tr class="notMatch">
                                    <?php $sInputId = 'ebayItemSearch_' . $oProduct->get('id') . '_empty' ?>
                                    <td class="select">
                                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                                        <?php } ?>
                                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id') ?>" />
                                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="<?php echo MLHttp::gi()->isAjax()? 'saveMatching' :'ebayItemsearch'?>" />
                                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true" />
                                        <input id="<?php echo $sInputId ?>" value="false" type="radio" name="<?php echo MLHttp::gi()->parseFormFieldName('data') ?>"<?php echo (empty($aAdditional['aSearchResult']) && ($sCurrEpid != 'newproduct'))? ' checked="checked"' : '' ?>/>
                                    </td>
                                    <td class="title" colspan="4">
                                        <div>
                                            <label style="float: left;" for="<?php echo $sInputId ?>"><?php echo $oI18n->get('Ebay_Productlist_Itemsearch_DontMatch') ?>
                                            </label>
                                            <a href="#" style="float: left;margin-left: 5px" class="ml-warning ml-ebay-matching-warning ml-js-noBlockUi" >
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="search">
                <form id="ml-ebay-search-epid-form-<?php echo $oProduct->get('id') ?>" class="ml-js-noBlockUi global-ajax" action="<?php echo $this->getCurrentUrl() ?>" method="post">
                    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                    <?php } ?>
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true" />
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id'); ?>" />
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="ebayItemsearch" />
                    <input  name="<?php echo MLHttp::gi()->parseFormFieldName('searchepid') ?>" value="<?php echo $this->getRequest('searchepid')?>" />
                    <input class="mlbtn" type="submit" value="<?php echo $oI18n->get('Ebay_Productlist_Itemsearch_Search_EPID') ?>"/>
                </form>
            </div>
            <div class="search">
                <form id="ml-ebay-search-free-form-<?php echo $oProduct->get('id') ?>" class="ml-js-noBlockUi global-ajax" action="<?php echo $this->getCurrentUrl() ?>" method="post">
                    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                    <?php } ?>
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true" />
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id'); ?>" />
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="ebayItemsearch" />
                    <input  name="<?php echo MLHttp::gi()->parseFormFieldName('searchfree') ?>" value="<?php echo $this->getRequest('searchfree')?>" />
                    <input class="mlbtn" type="submit" value="<?php echo $oI18n->get('Ebay_Productlist_Itemsearch_Search_Free') ?>"/>
                </form>
            </div>
        </td>
        <?php
        if (MLHttp::gi()->isAjax()) {
            $sContent = ob_get_clean();
            MLSetting::gi()->add('aAjaxPlugin', array('dom' => array(
                    '#ml-ebay-itemsearch-' . $oProduct->get('id') => $sContent
            )));
        }
        ?>
    </tr>
    <?php MLSettingRegistry::gi()->addJs('magnalister.ebay.itemsearch.js'); ?>
    <?php MLSetting::gi()->add('aCss', array('magnalister.ebay.itemsearch.css'), true); ?>
<?php }