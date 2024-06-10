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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Abstract
 *
 * @author mba
 */
abstract class ML_Shop_Model_ConfigForm_Shop_Abstract {


    const Shop_Attribute_Type_Key_Text = 'text';
    const Shop_Attribute_Type_Key_Select = 'select';

    /**
     * you can override this function and edit form mask in each shop specific class
     * @param array $aForm
     */
    public function manipulateForm(&$aForm) {
    }


    /**
     * This function works like manipulateForm, but it changes array exactly in last step,
     * and after that all other changes are already applied
     * @param array $aForm
     */
    public function manipulateFormAfterNormalize(&$aForm) {
    }

    /**
     * Returns grouped attributes for attribute matching
     * It will be executed by selecting a category in attribute matching
     * @param ML_Database_Model_List $oSelectedProducts
     * @return array
     * e.g.
     * {
     *     "Variations": {
     *        "a_2": {
     *           "name": "Color",
     *           "type": "select"
     *        },
     *        "a_1": {
     *            "name": "Size",
     *            "type": "select"
     *         },
     *         "optGroupClass": "variation"
     *     },
     *     "Product default fields": {
     *         "condition": {
     *             "name": "Condition",
     *             "type": "select"
     *         },
     *         "description": {
     *             "name": "Description",
     *             "type": "text"
     *         },
     *         "ean13": {
     *             "name": "Ean13",
     *             "type": "text"
     *         },
     *         "id_product": {
     *             "name": "Id product",
     *             "type": "text"
     *         },
     *         "manufacturer_name": {
     *             "name": "Manufacturer name",
     *             "type": "select"
     *         },
     *         "meta_description": {
     *             "name": "Meta description",
     *             "type": "text"
     *         },
     *         "name": {
     *             "name": "Name",
     *             "type": "text"
     *         },
     *         "optGroupClass": "default"
     *     },
     *     "Properties": {
     *         "f_1": {
     *             "name": "Composition",
     *             "type": "selectAndText"
     *         },
     *         "f_2": {
     *             "name": "Property",
     *             "type": "selectAndText"
     *         },
     *         "optGroupClass": "property"
     *     }
     * }
     */
    abstract public function getGroupedAttributesForMatching($oSelectedProducts = null);

    /**
     * @param null $attributeCode
     * @param null $product
     * @return array
     *
     * {
     *     "a_2": {
     *         "name": "Color",
     *         "type": "select"
     *     },
     *     "a_1": {
     *         "name": "Size",
     *         "type": "select"
     *     },
     *     "available_date": {
     *         "name":  "Available date",
     *         "type": "text"
     *     },
     *     "condition": {
     *         "name":  "Condition",
     *         "type": "select"
     *     },
     *     "description": {
     *         "name":  "Description",
     *         "type": "text"
     *     },
     *     "ean13": {
     *         "name":  "Ean13",
     *         "type": "text"
     *     },
     *     "id_product": {
     *         "name":  "Id product",
     *         "type": "text"
     *     },
     *     "meta_keywords": {
     *         "name":  "Meta keywords",
     *         "type": "text"
     *     },
     *     "tax_rate": {
     *         "name":  "Tax rate",
     *         "type": "text"
     *     },
     *     "upc": {
     *         "name":  "Upc",
     *         "type": "text"
     *     },
     *     "f_1": {
     *         "name":  "Composition",
     *         "type": "selectAndText"
     *     },
     *     "f_2": {
     *         "name":  "Property",
     *         "type": "selectAndText"
     *     }
     * }
     */
    abstract public function getFlatShopAttributesForMatching($attributeCode = null, $product = null);

    /**
     * Gets the list of product attributes prefixed with attribute type.
     *
     * @param bool $getProperties Indicates whether to get properties with attributes
     * @return array
     * Here is example from Prestashop, prefix a_ means the search group is a Prestashop attribute and 2 is id of that attribute in Prestashop
     * Here you can see different kinds of attribute group, Prestashop attribute (variation), Prestashop product table field, Prestashop feature.
     * {
     *       "a_2": "Color",
     *       "a_1": "Size",
     *       "": "Do not use",
     *       "active": "Active",
     *       "base_price": "Base price",
     *       "cache_default_attribute": "Cache default attribute",
     *       "cache_has_attachments": "Cache has attachments",
     *       "cache_is_pack": "Cache is pack",
     *       "category": "Category",
     *       "condition": "Condition",
     *       "customizable": "Customizable",
     *       "default_on": "Default on",
     *       "description": "Description",
     *       "ean13": "Ean13",
     *       "height": "Height",
     *       "id": "Id",
     *       "isbn": "Isbn",
     *       "manufacturer_name": "Manufacturer name",
     *       "meta_keywords": "Meta keywords",
     *       "meta_title": "Meta title",
     *       "minimal_quantity": "Minimal quantity",
     *       "name": "Name",
     *       "visibility": "Visibility",
     *       "weight": "Weight",
     *       "wholesale_price": "Wholesale price",
     *       "width": "Width",
     *       "f_1": "Composition",
     *       "f_2": "Property"
     * }
     * @return array Collection of prefixed attributes
     *
     * @TODO Check all usage of this method and if properties should always be present, remove this parameter,
     *      since it is used only in Shopware.
     */
    abstract public function getPrefixedAttributeList($getProperties = false);
    //
    //    /**
    //     * @deprecated function only used in AYN24
    //     * Gets the list of product attributes that have options (displayed as dropdown or multiselect fields).
    //     * {
    //     *       "a_2": "Color",
    //     *       "a_1": "Size",
    //     *       "f_1": "Composition",
    //     *       "f_2": "Property"
    //     * }
    //     * @return array Collection of attributes with options
    //     */
    //    abstract public function getAttributeListWithOptions();

    /**
     * @param $sAttributeCode
     * @param $iLangId
     * @return array
     * @example return
     * Here is example from Prestashop, prefix a_ means the search group is a Prestashop attribute and 2 is id of that attribute in Prestashop
     * and In return array you can see pair of attribute-value-id and attribute-value-name
     * e.g. $sAttributeCode = a_2
     * {
     *     "5": "Grey",
     *     "6": "Taupe",
     *     "7": "Beige",
     *     "8": "White",
     *     "9": "Off White",
     *     "10": "Red",
     *     "11": "Black",
     *     "12": "Camel",
     *     "13": "Orange",
     *     "14": "Blue",
     *     "15": "Green",
     *     "16": "Yellow",
     *     "17": "Brown",
     *     "18": "Pink"
     * }
     */
    abstract public function getPrefixedAttributeOptions($sAttributeCode, $iLangId = null);

    /**
     * It is important to show options of selected attribute
     * Gets the list of specific product attribute values.
     * If $iLangId is set, use translation for attribute options' labels.
     * This function is already used only in Amazon
     * @param $sAttributeCode
     * @param null $iLangId
     * @return array
     * @see getPrefixedAttributeOptions
     * @example
     * Here is return example from Prestashop, prefix a_ means the search group is a Prestashop attribute and 2 is id of that attribute in Prestashop
     * and In return array you can see pair of attribute-value-id and attribute-value-name
     * e.g. $sAttributeCode = a_2
     * {
     *     "5": "Grey",
     *     "6": "Taupe",
     *     "7": "Beige",
     *     "8": "White",
     *     "9": "Off White",
     *     "10": "Red",
     *     "11": "Black",
     *     "12": "Camel",
     *     "13": "Orange",
     *     "14": "Blue",
     *     "15": "Green",
     *     "16": "Yellow",
     *     "17": "Brown",
     *     "18": "Pink"
     * }
     *
     */
    abstract public function getAttributeOptions($sAttributeCode, $iLangId = null);

    /**
     * @return array
     * @example return
     * Here as an example you can see sample of return for Prestashop. They are pairs of attribute-group-id and attribute-group-name
     * {
     *    "2": "Color",
     *    "3": "Dimension",
     *    "4": "Paper Type",
     *    "1": "Size"
     * }
     */
    abstract public function getPossibleVariationGroupNames();

    /**
     * return true if variation could be a variation
     * @param $sAttributeKey key of selected attribute
     * @return bool
     */
    public function shouldBeDisplayedAsVariationAttribute($sAttributeKey) {
        return true;
    }

    /**
     * return pair of language and id
     * in some shop like Magento and Shopware language is equal to sub shop
     * @return array
     */
    abstract public function getDescriptionValues();

    /**
     * Get list of order attributes. Till now only Shopware 5 support that
     * @return array
     */
    public function getOrderFreeTextFieldsAttributes() {
        return array();
    }

    /**
     * @param $aVariationOption array ('name'=> ..., 'value'=> ... ,'code'=> ... ,'valueid'=> ...)
     * @return mixed
     */
    public function getVariationValueID($aVariationOption) {
        return $aVariationOption['valueid'];
    }

    abstract public function getDefaultCancelStatus();

    /**
     * Return a list of tax classes id and name pair in Shopware
     * @return array
     */
    abstract public function getTaxClasses();

}