<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                            m a g n a l i s t e r
 *                                        boost your Online-Shop
 *
 *   -----------------------------------------------------------------------------
 *   @author magnalister
 *   @copyright 2010-2022 RedGecko GmbH -- http://www.redgecko.de
 *   @license Released under the MIT License (Expat)
 *   -----------------------------------------------------------------------------
 */

/**
 * shortcut for handling helper correlating classes, also needed for secure refactoring
 */
class MLHelper {

    /**
     * Returns the instance of a helper class based on its name.
     * @param string $sHelper
     * @return Object
     */
    public static function gi($sHelper) {
        return ML::gi()->instance('helper_'.$sHelper);
    }

    /**
     * Generate a new instance of a helper class based on its name and return the instance
     * @param string $sHelper
     * @return Object
     */
    public static function factory($sHelper) {
        return ML::gi()->factory('helper_'.$sHelper);
    }

    /**
     * Returns the instance of the encoder helper class.
     * @return ML_Core_Helper_Encoder|object
     */
    public static function getEncoderInstance() {
        return ML::gi()->instance('helper_encoder');
    }

    /**
     * Returns the instance of the array helper class.
     * @return ML_Core_Helper_Array|object
     */
    public static function getArrayInstance() {
        return ML::gi()->instance('helper_array');
    }


    /**
     * Returns the instance of the array helper class.
     * @return ML_Core_Helper_Filesystem|object
     */
    public static function getFilesystemInstance() {
        return ML::gi()->instance('helper_filesystem');
    }

    /**
     * return the instance of remove helper class
     * @return ML_Core_Helper_Remote|object
     */
    public static function getRemote() {
        return ML::gi()->instance('helper_remote');
    }

    /**
     * Returns an instance of the invoice helper model.
     * @return ML_Form_Helper_ReceiptUpload|object
     * @throws Exception
     */
    public static function getReceiptUpload() {
        return ML::gi()->instance('helper_receiptupload');
    }

    /**
     * @return Object|ML_Core_Helper_Php8Compatibility
     */
    public static function getPHP8Compatibility() {
        return MLHelper::gi('php8compatibility');
    }

}