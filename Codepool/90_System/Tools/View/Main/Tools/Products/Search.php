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
/**
 * @var $this ML_Tools_Controller_Main_Tools_Products_Search
 */
if (!class_exists('ML', false))
    throw new Exception();
$iSelectedMpid = $this->getRequestedMpid();
$aMessages = array();
if ($iSelectedMpid != null) {
    ML::gi()->init(array('mp' => $iSelectedMpid));
    if (!MLModule::gi()->isConfigured()) {
        throw new Exception('module is not configured');
    }
}
?>

    <style>
        table.ml-productSearchToolsForm td {
            padding: 5px 10px;
        }

        table.ml-productSearchToolsResult {
            table-layout: fixed;
            width: 100%;
        }

        table.ml-productSearchToolsResult td {
            border-bottom: 1px solid #aaa;
            padding: 10px 60px 50px 30px;
        }
    </style>
    <form method="post" action="<?php echo $this->getCurrentUrl(); ?>">
        <div style="display:none">
            <?php foreach (MLHttp::gi()->getNeededFormFields() as $sKey => $sValue) { ?>
                <input type="hidden" name="<?php echo $sKey ?>" value="<?php echo $sValue ?>"/>
            <?php } ?>
        </div>
        <table class="attributesTable">
            <tr>
                <td>
                    <label for="ml-sku">SKU :</label>
                </td>
                <td>
                    <input type="text" name="<?php echo MLHttp::gi()->parseFormFieldName('sku') ?>"
                           value="<?php echo $this->getRequestedSku() ?>">
                </td>
                <td>
                    Sku of product that you are looking for
                </td>
            </tr>
            <tr>
                <td><label for="ml-marketplace">marketplace :</label></td>
                <td>
                    <select name="<?php echo MLHttp::gi()->parseFormFieldName('mpid') ?>">
                        <option value="">--</option>
                        <?php
                        $aTabIdents = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.tabident')->get('value');
                        foreach (MLHelper::gi('Marketplace')->magnaGetInvolvedMarketplaces() as $sMarketPlace) {
                            foreach (MLHelper::gi('Marketplace')->magnaGetInvolvedMPIDs($sMarketPlace) as $iMarketPlace) {
                                ?>
                                <option value="<?php echo $iMarketPlace ?>" <?php echo $iSelectedMpid == $iMarketPlace ? ' selected=selected ' : '' ?>>
                                    <?php echo $sMarketPlace . ' (' . (isset($aTabIdents[$iMarketPlace]) && $aTabIdents[$iMarketPlace] != '' ? $aTabIdents[$iMarketPlace] . ' - ' : '') . $iMarketPlace . ')'; ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    Select a marketplace, then title, price and ... field will be displayed regarding to configuration
                    of specific marketplace
                    <br><span style="color: red;">To see correct marketplace price\quantity, tax, EAN, MPN and manufacture you should select a module</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ml-pricetype">price type</label></td>
                <td>
                    <input type="text" id="ml-pricetype"
                           name="<?php echo MLHttp::gi()->parseFormFieldName('pricetype') ?>"
                           value="<?php echo $this->getRequest('pricetype') ?>">
                </td>
                <td>
                    It is important for some marketplace like eBay that has different price type, e.g. 'fixed',
                    'chinese', 'buyitnow' and ...
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ml-countrycode">Country code to calculate tax</label></td>
                <td>
                    <input type="text" id="ml-countrycode"
                           name="<?php echo MLHttp::gi()->parseFormFieldName('countrycode') ?>"
                           value="<?php echo $this->getRequest('countrycode') !== null ? $this->getRequest('countrycode') : 'DE' ?>">
                </td>
                <td>
                    Country code to calculate tax for specific country, e.g. 'DE', 'IT' and ...
                </td>
            </tr>
            <tr>
                <td><label for="ml-attribute">Attributes :</label></td>
                <td>
                    <select id="ml-attribute" name="<?php echo MLHttp::gi()->parseFormFieldName('attributeCode') ?>">
                        <option value="">--</option>
                        <?php
                        $selectedAttribute = MLRequest::gi()->data('attributeCode');
                        foreach (MLFormHelper::getShopInstance()->getGroupedAttributesForMatching() as $key => $attribute) {
                            ?>
                            <optgroup label="<?php echo $key ?>">
                                <?php
                                if (is_array($attribute)) {
                                    foreach ($attribute as $attributeKey => $attributeValue) {
                                        if (is_array($attributeValue)) {
                                            ?>
                                            <option value="<?php echo $attributeKey ?>" <?php echo $selectedAttribute === $attributeKey ? 'selected=selected' : '' ?>>
                                                <?php echo $attributeValue['name'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </optgroup>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <button type="sumit" class="mlbtn">Search SKU</button>
                </td>
                <td></td>
            </tr>
        </table>
    </form>
    <hr/>
    <table class="attributesTable">
        <thead>
        <tr>
            <th>Product data to send to Marketplace<sup>from <?php echo get_class(MLProduct::factory()) ?></sup></th>
            <th><span>Master Product functions<span><sup>from <?php echo get_class(MLProduct::factory()) ?></sup></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="vertical-align: top">
                <?php

                if (($oProduct = $this->getProduct(false)) !== null) {
                    $aDataToSendToMarketplace = array();
                    if ($oProduct->exists()) {
                        /* @var  $oProduct ML_Shop_Model_Product_Abstract
                         */
                        $aDataToSendToMarketplace = $this->getVariantProductFieldAndMethods($oProduct);
                        $aDataToSendToMarketplace = $this->getVariantProductModuleDependentFieldAndMethods($oProduct, $aDataToSendToMarketplace);
                        if (method_exists(MLFormHelper::getShopInstance(), 'getProductFreeTextFieldsAttributes') && method_exists($oProduct, 'getAttributeValue')) {
                            $aDataToSendToMarketplace['Attributes'] = array();
                            foreach (MLFormHelper::getShopInstance()->getProductFreeTextFieldsAttributes() as $sKey => $sLabel) {
                                //                                var_dump($sKey, $sLabel);
                                $aDataToSendToMarketplace['Attributes'][$sLabel] = $oProduct->getProductField($sKey);
                            }
                        }
                    }
                    !Kint::dump($aDataToSendToMarketplace);
                }
                ?>
            </td>
            <td style="vertical-align: top">

                <?php
                try {

                    if (($oProduct = $this->getProduct(true)) !== null) {
                        $aDataToSendToMarketplace = array();
                        if ($oProduct->exists()) {
                            /* @var  $oProduct ML_Shop_Model_Product_Abstract */
                            try {
                                $aDataToSendToMarketplace = $this->getMasterProductModuleDependentFieldAndMethods($oProduct, $aDataToSendToMarketplace);
                            } catch (Exception $oExc) {

                            }
                            $aDataToSendToMarketplace += $this->getMasterProductFieldAndMethods($oProduct);
                        }
                        !Kint::dump($aDataToSendToMarketplace, '', true);
                    }

                } catch (\Exception $ex) {
                    MLMessage::gi()->addDebug($ex);
                }
                ?>
            </td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <th>Found master product (From "magnalister_products" table)</th>
            <th><sup>Variants of found master product (From "magnalister_products" table)</sup></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="vertical-align: top">
                <?php
                if (($oProduct = $this->getProduct(true)) !== null) {
                    $aData = $oProduct->getAllData();
                    if ($oProduct->exists()) {
                        if (count($aData) > 1) {
                            $aData['methods'][get_class($oProduct) . '::getTax(4)'] = $oProduct->getTax();
                        }
                        $aData['methods'][get_class($oProduct) . '::getBasePriceString(20)'] = $oProduct->getBasePriceString(20);
                        $aData['methods'][get_class($oProduct) . '::getImages()'] = $oProduct->getImages();
                    }
                    new dBug($aData, '', true);
                }
                ?>
            </td>
            <td style="vertical-align: top">
                <?php
                if ($oProduct instanceof ML_Shop_Model_Product_Abstract) {
                    try {
                        foreach ($oProduct->getVariants() as $oVariant) {
                            new dBug($oVariant->data(), '', true);
                        }
                    } catch (Exception $oEx) {
                        echo $oEx->getMessage();
                    }
                }
                ?>
            </td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <th>Found variant (From "magnalister_products" table)</th>
            <th><sup>Master product of found variant (From "magnalister_products" table)</sup></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="vertical-align: top">
                <?php
                if (($oProduct = $this->getProduct(false)) !== null) {
                    $aData = $oProduct->data();
                    new dBug($aData, '', true);
                }
                ?>
            </td>
            <td style="vertical-align: top">
                <?php
                if ($oProduct instanceof ML_Shop_Model_Product_Abstract) {
                    try {
                        new dBug($oProduct->getParent()->getAllData(), '', true);
                    } catch (Exception $oEx) {
                        echo $oEx->getMessage();
                    }
                }
                ?>
            </td>
        </tr>
        </tbody>

    </table>
<?php

ML::gi()->init(array());
foreach ($this->aMessages as $mMessage) {
    MLMessage::gi()->addDebug($mMessage);
}