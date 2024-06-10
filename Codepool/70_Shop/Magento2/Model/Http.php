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

use Magento\Framework\App\ObjectManager;

if (!class_exists('MLMagento2Alias')) {//it is important if ClientVersion is deleted and init won't be included
    require_once __DIR__.'/../Init/loadMagento2InitializingClass.php';
}

/**
 * Magento2 specific implementation of the Http Model.
 */
class ML_Magento2_Model_Http extends ML_Shop_Model_Http_Abstract {

    /**
     * Gets the url to a file in the resources folder.
     * @param string $sFile
     *    Filename
     * @param bool $blAbsolute
     *
     * @return string
     */
    public function getResourceUrl($sFile = '', $blAbsolute = true) {

        $fileSystem = MLMagento2Alias::ObjectManagerProvider('\Magento\Framework\Filesystem\DirectoryList');
        $mediaPath = $fileSystem->getPath(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);


        $store = MLMagento2Alias::ObjectManagerProvider('Magento\Store\Model\StoreManagerInterface');

        if ($sFile == '') {
            if ($blAbsolute) {
                return $mediaPath;
            } else {
                return '';
            }
        }

        //$sBaseURL = $store->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $sUrl = $store->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $aResource = MLFilesystem::gi()->findResource('resource_'.$sFile);

        $sRelLibPath = substr($aResource['path'], strlen(MLFilesystem::getLibPath().'Codepool'));
        $sResourceType = strtolower(preg_replace('/^.*\/resource\/(.*)\/.*$/Uis', '$1', $sRelLibPath));

        if (basename($sResourceType) === 'js') {
            $mediaPath = $mediaPath;
            $sDstPath = $mediaPath . '/magnalister' . $sRelLibPath;
        }
        if (basename($sResourceType) === 'css') {

            $mediaPath = $mediaPath;
            $sDstPath = $mediaPath . '/magnalister' . $sRelLibPath;
        }
        if (basename($sResourceType) === 'images') {
            $mediaPath = $mediaPath;
            $sDstPath = $mediaPath . '/magnalister' . $sRelLibPath;
        }
        if (!file_exists($sDstPath)) {// we copy complete resource-type-folder if one file not exists
            $sSubPath = preg_replace('/^(.*\/resource\/.*)\/.*$/Uis', '$1', $sRelLibPath);
            $sSrcPath = substr($aResource['path'], 0, stripos($aResource['path'], $sSubPath) + strlen($sSubPath) + 1);
            $sDstPath = substr($sDstPath, 0, stripos($sDstPath, $sSubPath) + strlen($sSubPath) + 1);
            try {
                MLHelper::getFilesystemInstance()->cp($sSrcPath, $sDstPath);
            } catch (Exception $oEx) {
                MLMessage::gi()->addDebug($oEx, array(
                    '$sSrcPath' => $sSrcPath,
                    '$sDstPath' => $sDstPath,
                    '$sSubPath' => $sSubPath
                ));
                MLMessage::gi()->addError(MLI18n::gi()->get('sMessageCannotLoadResource'));
                MLSetting::gi()->set('blInlineResource', true, true);
            }
        }

        if ($sResourceType === 'js') {
            $sUrl .= 'magnalister'.$sRelLibPath;
        } elseif ($sResourceType === 'css') {
            $sUrl .= 'magnalister'.$sRelLibPath;
        } else {
            $sUrl .= 'magnalister'.$sRelLibPath;
        }

        return str_replace('\\', '/', $sUrl);
    }

    /**
     * just used for cUrl referer for api request .
     * @return string
     */
    public function getBaseUrl() {
        if (MLSetting::gi()->sDebugHost !== null) {
            return MLSetting::gi()->get('sDebugHost');
        } else {
            $store = MLMagento2Alias::ObjectManagerProvider('Magento\Store\Model\StoreManagerInterface');
            return $store->getStore()->getBaseUrl();
        }
    }

    /**
     * Not used anywhere, implement later if needed
     * @return string
     */
//    public function getAdminUrl(): string {
//          return ''
//    }

    /**
     * Gets the backend url of the magnalister app.
     * @param array $aParams
     *    name => value
     * @return string
     */
    public function getUrl($aParams = array()) {
        $objectManager = ObjectManager::getInstance();
        $AdminBaseURL = $objectManager->get('\Magento\Backend\Model\UrlInterface');
        /**  @var $AdminBaseURL \Magento\Backend\Model\UrlInterface */
        $sParent = parent::getUrl($aParams);
        return $AdminBaseURL->getUrl('magnalister/iframe').(($sParent == '') ? '' : '?'.$sParent);
    }

    /**
     * Gets the request params merged from _POST and _GET.
     * @return array
     */
    public function getRequest() {
        $objectManager = ObjectManager::getInstance();
        $Request = $objectManager->get('\Magento\Framework\App\RequestInterface');
        //'\Magento\Framework\App\Request\Http';
        //'\Magento\Framework\HTTP\PhpEnvironment\Request'
       // Kint::dump($Request->getParams());
       // Kint::dump($Request->getPost()->toArray());
        /**  @var $Request \Magento\Framework\App\RequestInterface */
        $aOut = MLHelper::getArrayInstance()->mergeDistinct($Request->getParams(),$Request->getPost()->toArray());
        return $this->filterRequest($aOut);
    }

    /**
     * Returns _SERVER.
     * @return array
     */
    public function getServerRequest() {
        return $_SERVER;
    }

    /**
     * Parse hidden fields that are wanted by different shop systems for security measurements.
     * @return array
     *    Assoc of hidden neccessary form fields array(name => value, ...)
     */
    public function getNeededFormFields() {
        $formKey = MLMagento2Alias::ObjectManagerProvider('\Magento\Backend\Block\Template');

        return array(
            'form_key' =>$formKey->getFormKey()
        );
    }

    /**
     * Gets the magnalister cache FS url.
     * @return string
     */
    public function getCacheUrl($sFile = '') {
        if (substr($sFile, 0, 7) == '../log/') {
            $sFile = substr($sFile, 7);
        }

        if (substr($sFile, 0, 11) == '../log/old/') {
            $sFile = substr($sFile, 7);
        }

        return $this->getBackendUrl('magnalister/backend/cache', ['fileName' => $sFile]);
    }

    public function getBackendUrl($sRoutePath = 'admin/dashboard', $sRouteParams = array()) {
        return MLMagento2Alias::ObjectManagerProvider('\Magento\Backend\Model\Url')->getUrl($sRoutePath, $sRouteParams);
    }

    /**
     * Gets the frontend url of the magnalister app.
     * @param array $aParams
     * @return string
     */
    public function getFrontendDoUrl($aParams = array()) {
        $sConfig = $this->getConfigFrontCronURL($aParams);
        if ($sConfig !== '') {
            return $sConfig;
        }
        $objectManager = ObjectManager::getInstance();
        $store = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $sParent = parent::getUrl($aParams);
        return $store->getStore()->getBaseUrl().'magnalister/'.(($sParent == '') ? '' : '?'.$sParent);;
    }

    /**
     * return directory or path (file system) of specific shop images
     * @return string
     */
    public function getShopImagePath() {
        $fileSystem = MLMagento2Alias::ObjectManagerProvider('\Magento\Framework\Filesystem\DirectoryList');
        $mediaPath = $fileSystem->getPath(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        return $mediaPath . '/';
    }

    /**
     * return url of specific shop images
     * @param string $sFiles
     */
    public function getShopImageUrl() {
        $storeManager = MLMagento2Alias::ObjectManagerProvider('\Magento\Store\Model\StoreManagerInterface');
        return $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getOriginalShopImageUrl($sSrc) {
        // TODO: return original image URL
        return $this->getBaseUrl() . ltrim($sSrc, $_SERVER['DOCUMENT_ROOT']);
    }

}
