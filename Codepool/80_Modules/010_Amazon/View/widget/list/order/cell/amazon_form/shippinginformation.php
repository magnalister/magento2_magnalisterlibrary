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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aOrder array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<tbody class="even ml-shippinglabel-form ml-shippinglabel-form-upload" id="orderlist-<?php echo $aOrder['MPSpecific']['MOrderID'] ?>">
    <tr>
        <td colspan="6">
            <table class="fullWidth">
                <tr>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2"><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Shipping_Information_Label') ?>:</td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Package_Size_Label') ?>:</td>
                                    <td>
                                        <?php
                                        $sIdent = MLHttp::gi()->parseFormFieldName($aOrder['MPSpecific']['MOrderID']);
                                        $sHtmlId = str_replace(array('[', ']'), '_', $sIdent);
                                        $aDefault = MLModule::gi()->getConfig('shippinglabel.default.dimension');
                                        $aText = MLModule::gi()->getConfig('shippinglabel.default.dimension.text');
                                        $aLength = MLModule::gi()->getConfig('shippinglabel.default.dimension.length');
                                        $aWidth = MLModule::gi()->getConfig('shippinglabel.default.dimension.width');
                                        $aHeight = MLModule::gi()->getConfig('shippinglabel.default.dimension.height');
                                        $fLength = 0;
                                        $fWidth = 0;
                                        $fHeight = 0;
                                        ?>
                                        <select class="ml-shippinglabel-configshipping" id="<?php echo $sHtmlId ?>">
                                            <?php
                                            $sSizeUnit = MLModule::gi()->getConfig('shippinglabel.size.unit');
                                            $sSizeUnit = ($sSizeUnit == 'centimeters' ? 'cm' : ($sSizeUnit == 'inches' ? 'in' : ''));
                                            foreach ($aDefault as $iKey => $sValue) {
                                                if ($aDefault[$iKey]['default'] == '1' ? 'selected=selected' : '') {
                                                    $fLength = $aLength[$iKey];
                                                    $fWidth = $aWidth[$iKey];
                                                    $fHeight = $aHeight[$iKey];

                                                    if (!empty($aOrder['Length']) && $fLength == '{#Length#}') {
                                                        $fLength = $aOrder['Length'];
                                                    }
                                                    if (!empty($aOrder['Width']) && $fWidth == '{#Width#}') {
                                                        $fWidth = $aOrder['Width'];
                                                    }
                                                    if (!empty($aOrder['Height']) && $fHeight == '{#Height#}') {
                                                        $fHeight = $aOrder['Height'];
                                                    }
                                                }
                                                ?>
                                                <option <?php echo $aDefault[$iKey]['default'] == '1' ? 'selected=selected' : '' ?> value="<?php echo $aLength[$iKey] . '-' . $aWidth[$iKey] . '-' . $aHeight[$iKey] ?>">
                                                    <?php echo $aText[$iKey] . ' (' . $aLength[$iKey] . ' ' . $sSizeUnit . ' x ' . $aWidth[$iKey] . ' ' . $sSizeUnit . ' x ' . $aHeight[$iKey] . ' ' . $sSizeUnit . ')'; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Package_Dimension_Label') ?>:</td>
                                    <td>

                                                <div class="ml-amazon-shipping-size">
                                                    <div class="normal size"><label for="<?php echo $sHtmlId . 'length' ?>"><?php echo $this->__('ML_Amazon_Shippinglabel_Package_Length') ?>:</label><input class="ml-shippinglabel-size" id="<?php echo $sHtmlId . 'length' ?>" type="text" name="<?php echo MLHttp::gi()->parseFormFieldName('length[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" value="<?php echo $fLength ?>"/><?php echo $sSizeUnit ?>&nbsp;&nbsp;</div>
                                                    <div class="normal size"><label for="<?php echo $sHtmlId . 'width' ?>"><?php echo $this->__('ML_Amazon_Shippinglabel_Package_Width') ?>:</label><input class="ml-shippinglabel-size" type="text" id="<?php echo $sHtmlId . 'width' ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('width[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" value="<?php echo $fWidth ?>"/><?php echo $sSizeUnit ?>&nbsp;</div>
                                                    <div class="normal size"><label for="<?php echo $sHtmlId . 'height' ?>"><?php echo $this->__('ML_Amazon_Shippinglabel_Package_Height') ?>:</label><input class="ml-shippinglabel-size" type="text" id="<?php echo $sHtmlId . 'height' ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('height[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" value="<?php echo $fHeight ?>"/><?php echo $sSizeUnit ?>&nbsp;&nbsp;</div>
                                                </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->__('ML_GENERIC_WEIGHT') ?>:</td>
                                    <td>
                                        <input type="text"
                                               class="ml-shippinglabel-size ml-shippinglabel-weight-<?php echo $aOrder['MPSpecific']['MOrderID'] ?>"
                                               name="<?php echo MLHttp::gi()->parseFormFieldName('weight[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>"
                                               value="<?php echo $aOrder['TotalWeight'] ?>"/> <span
                                                class="normal"><?php echo MLModule::gi()->getConfig('shippinglabel.weight.unit') ?></span>
                                        <span class="infoTextGray"><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Weight_Notice') ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->__('ML_LABEL_SHIPPING_DATE') ?>:</td>
                                    <td>
                                        <select name="<?php echo MLHttp::gi()->parseFormFieldName('date[' . $aOrder['MPSpecific']['MOrderID'] . ']'); ?>">
                                            <?php
                                            foreach (array(
                                                date('d.m.Y', time()),
                                                date('d.m.Y', time() + 24 * 60 * 60)
                                             ) as $sDate) {
                                                ?>
                                                <option value="<?php echo $sDate ?>"><?php echo $sDate ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>                    
                                <td class="input">
                                    <label ><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Package_Carrierwillpickup_Label') ?>:</label>
                                </td>
                                <td class="normal">
                                    <?php
                                    $aService = MLModule::gi()->MfsGetConfigurationValues('ServiceOptions');
                                    $aOptions = array_key_exists('CarrierWillPickUp', $aService) ? $aService['CarrierWillPickUp'] : array();
                                    $sSelected = MLModule::gi()->getConfig('shippingservice.carrierwillpickup');
                                    foreach ($aOptions as $sKey => $sValue) {
                                        ?>
                                        <input type="radio" <?php echo $sSelected == $sKey ? 'checked=checked' : '' ?> name="<?php echo MLHttp::gi()->parseFormFieldName('carrierwillpickup[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" value="<?php echo $sKey ?>" id="amazon_config_shippinglabel_<?php echo $sKey ?>">
                                        <label for="amazon_config_shippinglabel_<?php echo $sKey ?>"><?php echo $sValue ?></label>
                                    <?php } ?>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td class="input">
                                    <label><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Package_Deliveryexperience_Label') ?>:</label>
                                </td>
                                <td>
                                    <select name="<?php echo MLHttp::gi()->parseFormFieldName('deliveryexperience[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" >
                                        <?php
                                        $aService = MLModule::gi()->MfsGetConfigurationValues('ServiceOptions');
                                        $aOptions = array_key_exists('DeliveryExperience', $aService) ? $aService['DeliveryExperience'] : array();
                                        $sSelected = MLModule::gi()->getConfig('shippingservice.deliveryexperience');
                                        foreach ($aOptions as $sKey => $sValue) {
                                            ?>
                                            <option <?php echo $sSelected == $sKey ? 'selected=selected' : '' ?> value="<?php echo $sKey ?>"> <?php echo $sValue ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->__('ML_Amazon_Shippinglabel_Form_Package_SenderAddress_Label') ?>:</td>
                                <td>
                                    <?php
                                    $aDefaultAddress = MLModule::gi()->getConfig('shippinglabel.address');
                                    $aStreet = MLModule::gi()->getConfig('shippinglabel.address.streetandnr');
                                    $aZip = MLModule::gi()->getConfig('shippinglabel.address.zip');
                                    $aCity = MLModule::gi()->getConfig('shippinglabel.address.city');
                                    ?>
                                    <select name="<?php echo MLHttp::gi()->parseFormFieldName('addressfrom[' . $aOrder['MPSpecific']['MOrderID'] . ']') ?>" >
                                        <?php
                                        foreach ($aDefaultAddress as $iKey => $sValue) {
                                            ?>
                                            <option <?php echo $aDefaultAddress[$iKey]['default'] == '1' ? 'selected=selected' : '' ?> value="<?php echo $iKey ?>">
                                                <?php echo $aStreet[$iKey] . ' - ' . $aZip[$iKey] . ' - ' . $aCity[$iKey]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</tbody>