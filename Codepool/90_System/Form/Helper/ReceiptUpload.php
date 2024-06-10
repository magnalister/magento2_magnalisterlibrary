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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Form_Helper_ReceiptUpload {

    /**
     * @var int
     */
    public static $ReceiptUploadError = 45678765;

    /**
     * @var ML_Form_Helper_ReceiptUpload|null
     */
    private static $instance = null;

    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $processedOrders = array();

    /**
     * Returns the instance
     * @return ML_Form_Helper_ReceiptUpload
     */
    public static function gi() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Required function to set the directories where to pull and place the receipts for and after processing
     *
     * @param $config
     * @throws MLAbstract_Exception
     * @throws MagnaException
     */
    public function setConfig($config) {
        $this->config = $config;
        foreach ($this->config as $key => &$value) {
            if($value !== null) {//in Kaufland there is no refund document
                $value = rtrim($value, DIRECTORY_SEPARATOR);
                $value .= DIRECTORY_SEPARATOR;

                if (!file_exists($value) || scandir($value) === false) {
                    $outputString = str_replace(array('{#ConfigPath#}', '{#ConfigFieldLabel#}'), array($value, $this->getTranslationOfConfigurationType($key)), MLI18n::gi()->get('UploadInvoice_Error_PathNotExists'));
                    throw new MagnaException($outputString, self::$ReceiptUploadError);
                }
            }
        }
    }

    private function getTranslationOfConfigurationType($type) {
        switch ($type) {
            case 'Invoice':
            case 'SHIPMENT': //Amazon
            {
                $configKey = 'formfields__erpInvoiceSource__label';
                break;
            }
            case 'Invoice_DESTINATION':
            case 'SHIPMENT_DESTINATION': //Amazon
            {
                $configKey = 'formfields__erpInvoiceDestination__label';
                break;
            }
            case 'Reversal':
            case 'RETURN': //Amazon
            case 'REFUND': //Amazon
            {
                $configKey = 'formfields__erpReversalInvoiceSource__label';
                break;
            }
            case 'Reversal_DESTINATION':
            case 'RETURN_DESTINATION': //Amazon
            case 'REFUND_DESTINATION': //Amazon
            {
                $configKey = 'formfields__erpReversalInvoiceDestination__label';
                break;
            }
        }

        if (!isset($configKey)) {
            $configKey = $type;
        }

        return MLI18n::gi()->get($configKey);
    }

    /**
     * Returns the all necessary data for an receipt
     *
     * @param $orderId
     * @param $type
     * @return array
     * @throws MagnaException
     */
    public function processReceipt($orderId, $type) {
        if (!array_key_exists($type, $this->config)) {
            throw new MagnaException('Config for type "'.$type.'" is not set!'.json_indent(json_encode($this->config)), self::$ReceiptUploadError);
        }

        $file = $this->getReceiptByOrderId($orderId, $type);

        $this->processedOrders[$orderId] = array(
            'fileName' => $file['fileName'],
            'type'     => $type,
        );

        return array(
            'file'      => $file['fileContent'],
            'receiptNr' => $this->getReceiptNr($file['fileName'], $orderId),
        );
    }

    /**
     * Returns the Path, Content and Name of a File if success
     *  otherwise it throws an Exception that the invoice could not be found
     *
     * @param $orderId
     * @param $type
     * @return array
     * @throws MagnaException
     */
    private function getReceiptByOrderId($orderId, $type) {
        $scanDir = scandir($this->config[$type]);
        if ($scanDir === false) {
            $outputString = str_replace(array('{#ConfigPath#}', '{#ConfigFieldLabel#}'), array($this->config[$type], $this->getTranslationOfConfigurationType($type)), MLI18n::gi()->get('UploadInvoice_Error_PathNotExists'));
            throw new MagnaException($outputString, self::$ReceiptUploadError);
        }

        $files = preg_grep('/^'.$orderId.'_.*\.(pdf|PDF)$/', $scanDir);
        if (empty($files)) {
            if (file_exists($this->config[$type].$orderId.'.pdf')) {
                $files = array($orderId.'.pdf');
            } elseif (file_exists($this->config[$type].$orderId.'.PDF')) {
                $files = array($orderId.'.PDF');
            }
        }

        if (!is_array($files) || count($files) === 0 || empty($files)) {
            $outputString = str_replace(array('{#ShopOrderId#}', '{#ConfigFieldLabel#}'), array($orderId, $this->getTranslationOfConfigurationType($type)), MLI18n::gi()->get('UploadInvoice_Error_NoReceiptsForOneOrder'));
            throw new MagnaException($outputString, self::$ReceiptUploadError);
        }
        if (is_array($files) && count($files) > 1) {
            $outputString = str_replace(array('{#ShopOrderId#}', '{#ConfigFieldLabel#}'), array($orderId, $this->getTranslationOfConfigurationType($type)), MLI18n::gi()->get('UploadInvoice_Error_MultipleReceiptsForOneOrder'));
            throw new MagnaException($outputString, self::$ReceiptUploadError);
        }

        $fileName = current($files);

        return array(
            'fileContent' => base64_encode(file_get_contents($this->config[$type].$fileName)),
            'filePath'    => $this->config[$type].$fileName,
            'fileName'    => $fileName,
        );
    }

    /**
     * Returns the ReceiptsNr
     *  There are two options
     *      - "1.pdf" (1 stands for the order id and is then also the ReceiptNr)
     *      - "1_10001R.pdf" (1 stands for the order id and all after the underscore (_) stands for the ReceiptNr)
     *
     * @param $fileName
     * @param $orderId
     * @return string
     */
    private function getReceiptNr($fileName, $orderId) {
        $fileName = str_replace(array('.pdf', '.PDF'), '', $fileName);
        $receiptNr = $orderId;

        if (strpos($fileName, '_') !== false) {
            $receipt = explode('_', $fileName);

            if ($receipt[0] == $orderId) {
                unset($receipt[0]);
                $receiptNr = implode('_', $receipt);
            }
        }

        return $receiptNr;
    }

    /**
     * Moves the receipt from the processing directory to the final directory
     *
     * @param $orderId
     */
    public function markOrderAsProcessed($orderId) {
        if (array_key_exists($orderId, $this->processedOrders)) {
            $key = $this->processedOrders[$orderId]['type'].'_DESTINATION';
            if (array_key_exists($key, $this->config)) {
                $fileOld = $this->config[$this->processedOrders[$orderId]['type']].$this->processedOrders[$orderId]['fileName'];
                $fileNew = $this->config[$key].$this->processedOrders[$orderId]['fileName'];
                $success = rename($fileOld, $fileNew);

                if (!$success) {
                    $outputString = str_replace(array('{#ReceiptFileName#}', '{#ConfigDestinationPath#}'), array($this->processedOrders[$orderId]['fileName'], $this->config[$key]), MLI18n::gi()->get('UploadInvoice_Error_MoveToDestinationDirectory_Failed'));
                    throw new MagnaException($outputString, self::$ReceiptUploadError);
                }
            }
        }
    }
}
