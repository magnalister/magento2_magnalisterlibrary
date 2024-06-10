<?php 
    /* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
    /* @var $oProduct ML_Shop_Model_Product_Abstract */
    /* @var $aAdditional array */
     if (!class_exists('ML', false))
         throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {?>
    <?php $oI18n = MLI18n::gi();

    $oHelper = MLHelper::gi('Model_Service_Product');
    $oHelper->setProduct($oProduct);
    $dbPrepareData = MLHelper::gi('Model_Service_Product')->addVariant($oProduct)->getData();
    $prepareData = current($dbPrepareData);
    ?>
    <?php if (isset($aAdditional['aAmazonResult']) &&  is_array($aAdditional['aAmazonResult'])){ ?>
        <?php foreach($aAdditional['aAmazonResult'] as $iRow => $aResult){?>
            <?php $sInputId='amazonItemSearch_'.$oProduct->get('id').'_'.$iRow ?>
            <tr>
                <td class="select">
                    <input id="<?php echo $sInputId ?>"<?php echo($aResult['ASIN'] == $prepareData['ASIN'])?' checked="checked"':''?> type="radio" name="<?php echo MLHttp::gi()->parseFormFieldName('data')?>" value="<?php echo str_replace('"',"'",str_replace("'","\'",json_encode($aResult)))?>" />
                </td>
                <td class="title"><label for="<?php echo $sInputId ?>"><?php echo $aResult['Title']?></label></td>
                <td class="category"><label for="<?php echo $sInputId ?>"><?php echo $aResult['CategoryName']?></label></td>
                <td class="price"><label for="<?php echo $sInputId ?>"><?php echo $aResult['LowestPriceFormated']?></label></td>
                <td class="asin ml-js-noBlockUi">
                    <label for="<?php echo $sInputId ?>"><a href="<?php echo $aResult['URL'] ?>" target="_blank"><?php echo $aResult['ASIN'] ?></a></label>
                </td>
            </tr>
        <?php } ?>
        <tr class="notMatch">
            <?php $sInputId = 'amazonItemSearch_'.$oProduct->get('id').'_empty' ?>
            <td class="select">
                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                <?php } ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id') ?>"/>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="Update"/>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true"/>
                <input id="<?php echo $sInputId ?>" type="radio" name="<?php echo MLHttp::gi()->parseFormFieldName('data') ?>"<?php echo empty($aAdditional['aAmazonResult']) ? ' checked="checked"' : '' ?>/>
            </td>
            <td class="title" colspan="4">
                <label for="<?php echo $sInputId ?>"><?php echo $oI18n->get('Amazon_Productlist_Itemsearch_DontMatch') ?></label>
            </td>
        </tr>
    <?php }else{ ?>
        <tr class="ml-amazon-itemsearch child">
            <td colspan="2"></td>
            <td colspan="<?php echo count($this->getProductList()->getHead())-1?>">
                <div class="content">
                    <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                        <table>
                            <thead>
                                <tr>
                                    <th class="select"><?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Select') ?></th>
                                    <th class="title"><?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Title') ?></th>
                                    <th class="category"><?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Category') ?></th>
                                    <th class="price"><?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Price') ?></th>
                                    <th class="asin"><?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Asin') ?></th>
                                </tr>
                            </thead>
                            <?php
                            $sCacheId= 'performItemSearch_'.md5(json_encode(array(null, $oProduct->getModulField('general.ean',true), $oProduct->getName())));
                            $blCache=  MLCache::gi()->exists($sCacheId);
                            ?>
                            <tbody class="js-row-action<?php echo !$blCache?' startform':''?>">
                                <?php 
                                    if($blCache){
                                        $this->includeView(
                                            'widget_productlist_list_variantarticleadditional_amazon_itemsearch', 
                                            array(
                                                'oProduct'=>$oProduct,
                                                'aAdditional' => array('aAmazonResult' => MLModule::gi()->performItemSearch(null, $oProduct->getModulField('general.ean', true), $oProduct->getName()))
                                            )
                                        );
                                    }else {
                                        ?>
                                        <tr>
                                            <td colspan="5">
                                                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                                                <?php } ?>
                                                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true"/>
                                                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="AmazonItemSearch"/>
                                                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id'); ?>"/>
                                            </td>
                                        </tr>
                                        <?php
                                    }     
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="search">
                    <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                        <?php } ?>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true"/>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id'); ?>"/>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="AmazonItemSearch"/>
                        <input name="<?php echo MLHttp::gi()->parseFormFieldName('search') ?>" placeholder="<?php echo $oI18n->get('Amazon_Productlist_Itemsearch_SearchAsin_Field') ?>" value="" class="ml-searchbox-size"/>
                        <input class="mlbtn mlbtn-md" type="submit" value="<?php echo $oI18n->get('Amazon_Productlist_Itemsearch_SearchAsin') ?>"/>
                    </form>
                </div>
                <div class="search">
                    <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                        <?php } ?>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>" value="true"/>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('id') ?>" value="<?php echo $oProduct->get('id'); ?>"/>
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="AmazonItemSearch"/>
                        <input name="<?php echo MLHttp::gi()->parseFormFieldName('search') ?>" placeholder="<?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Search_Field') ?>" value="" class="ml-searchbox-size"/>
                        <input class="mlbtn mlbtn-md" type="submit" value="<?php echo $oI18n->get('Amazon_Productlist_Itemsearch_Search') ?>"/>
                    </form>
                </div>
            </td>
        </tr>
        <?php
        if (MLSetting::gi()->blDebug) {
            ?>
            <script type="text/javascript">
                function mlSubmitAmazonManualMatchingForm(eForm) {
                    if (confirm('Do you want to redirect?') === true) {
                        eForm.trigger('submit');
                    }
                }
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                function mlSubmitAmazonManualMatchingForm(eForm) {
                    eForm.trigger('submit');
                }
            </script>
            <?php
        }
        MLSettingRegistry::gi()->addJs('magnalister.amazon.itemsearch.js'); ?>
        <?php MLSetting::gi()->add('aCss', array('magnalister.amazon.itemsearch.css'), true); ?>
    <?php } ?>
<?php } ?>
