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

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author mba
 */
class ML_Base_Model_Image {

    protected $processingTimePerImage = array();
    protected static $cache = array();
    protected static $imageSizeCache = array();
    protected static $aImageType = array();

    protected function getImageType($sSrc) {
        if (!isset(self::$aImageType[$sSrc])) {
            $this->checkImageFormat($sSrc);
        }
        return self::$aImageType[$sSrc];
    }

    public function __construct() {

    }

    /**
     * @param $sSrc
     * @param $sType
     * @param $iMaxWidth
     * @param $iMaxHeight
     * @param bool $blUrlOnly
     * @return array|string
     * @throws Exception
     */
    public function resizeImage($sSrc, $sType, $iMaxWidth, $iMaxHeight, $blUrlOnly = false) {
        $startTime = microtime(true);
        if (empty($sSrc)) {
            throw new Exception('Image path is empty', 1652878573);
        }
        $originalSrc = $sSrc;
        $sSrc = $this->normalizeURL($sSrc);
        // prevent duplicate generation of same image in same process
        $imgHash = md5($sSrc.$sType.$iMaxWidth.$iMaxHeight.$blUrlOnly);
        try {
            if (array_key_exists($imgHash, self::$cache)) {
                $mResult = self::$cache[$imgHash];
            } else {
                // check if image has supported format
                $this->checkImageFormat($sSrc);

                $sType = strtolower($sType);
                $this->checkDirectory(MLHttp::gi()->getImagePath(''), array($sType, $iMaxWidth.($iMaxWidth === $iMaxHeight ? '' : 'x'.$iMaxHeight).'px'));
                $sDst = $this->getDestinationPath($sSrc, $sType, $iMaxWidth, $iMaxHeight);
                $oTable = MLDatabase::getTableInstance('image')
                    ->init()
                    ->set('sourcePath', $sSrc)
                    ->set('destinationPath', MLHttp::gi()->getImagePath($sDst))
                    ->load();
                if ($oTable->get('skipCheck') == 0 && !$oTable->destinationIsActual()) {// generate
                    if ($this->getimagesize($sSrc)) {//@getimagesize($sSrc) used because file_existed cannot recognize image url which like http://www.usersite.com/image.jpg
                        // some fatal error is not displayed to the customer , so regenerate it with own request to shop controller
                        // eg. $this->callNotExistingMethod();
                        MLCache::gi()->set('Model_Image__BrokenImageResize', array(
                            'sSrc'       => $oTable->get('sourcePath'),
                            'sDst'       => $oTable->get('destinationPath'),
                            'iMaxWidth'  => $iMaxWidth,
                            'iMaxHeight' => $iMaxHeight
                        ));
                        $this->resize($sSrc, $iMaxWidth, $iMaxHeight, MLHttp::gi()->getImagePath($sDst));
                        MLCache::gi()->delete('Model_Image__BrokenImageResize');
                        $oTable->destinationIsActual(true);
                    } else { // delete
                        $oTable->delete();
                        if (MLShop::gi()->getShopSystemName() !== 'shopware') {// in shopware we use fallback method to get image via shopware services
                            MLMessage::gi()->addDebug('Image doesn\'t exist :'.$sSrc);
                        }
                        throw new Exception;
                    }
                } elseif ($oTable->get('skipCheck') == 1) { // setToActual
                    $oTable->destinationIsActual(true);
                }
                if ($blUrlOnly) {
                    self::$cache[$imgHash] = MLHttp::gi()->getImageUrl($sDst);
                    $mResult = self::$cache[$imgHash];
                } else {
                    list($iWidth, $iHeight) = @getimagesize(MLHttp::gi()->getImagePath($sDst));
                    self::$cache[$imgHash] = array(
                        'url'    => MLHttp::gi()->getImageUrl($sDst),
                        'width'  => $iWidth,
                        'height' => $iHeight,
                        'alt'    => basename($sSrc)
                    );
                    $mResult = self::$cache[$imgHash];
                }
            }

        } catch (Throwable $ex) {
            $this->handleExceptions($ex);
            $mResult = false;
        }
        if ($mResult === false) {
            $mResult = $this->resizeImageFallback($sSrc, $sType, $iMaxWidth, $iMaxHeight, $blUrlOnly, $imgHash, $originalSrc);
        }
        $this->processingTimePerImage[$sSrc] = microtime2human(microtime(true) - $startTime);
        return $mResult;
    }

    protected function checkDirectory($sMainDir, $aDirs) {
        $sPath = $sMainDir;
        foreach ($aDirs as $sDir) {
            $sPath .= $sDir . DIRECTORY_SEPARATOR;
            if (!file_exists($sPath)) {
                mkdir($sPath);
            }
        }
    }

    protected function resize($sSrc, $iMaxWidth, $iMaxHeight, $sDst, $iCompression = 95) {
        $this->removeExistingImage($sDst);
        $src = array();
        $dst = array();

        $dimensions = $this->getimagesize($sSrc);

        if (is_array($dimensions)) {
            $src['w'] = $dimensions[0];
            $src['h'] = $dimensions[1];
            if (isset($dimensions[2])) {
                $src['type'] = $dimensions[2];
            }

            if ($iMaxWidth == '0') {
                $iMaxWidth = ($src['w'] / ($src['h'] / $iMaxHeight));
            }

            $thiso = ($src['w'] / $iMaxWidth);
            $thisp = ($src['h'] / $iMaxHeight);
            $dst['w'] = ($thiso > $thisp) ? $iMaxWidth : round($src['w'] / $thisp); // width
            $dst['h'] = ($thiso > $thisp) ? round($src['h'] / $thiso) : $iMaxHeight; // height
            if ($src['w'] < $dst['w'] || $src['h'] < $dst['h']) {
                //we don't increase size of image, that will damage resolution
                $iImageType = $this->getImageType($sSrc);
                if ($iImageType == IMAGETYPE_PNG) {
                    $dst['w'] = $src['w'];
                    $dst['h'] = $src['h'];
                } else {
                    return $this->copyImage($sSrc, $sDst);
                }
            }
        }
        list($warning, $sImageContent) = $this->getImageContent($sSrc);
        ob_start();
        $src['image'] = imagecreatefromstring($sImageContent);
        MLMessage::gi()->addDebug(__LINE__ . ':' . microtime(true), array(ob_get_clean()));
        if (
            !is_resource($src['image'])
            && (!class_exists('GdImage') || !($src['image'] instanceof GdImage))//PHP 8
        ) {
            unset($src);
            unset($dst);
            return false;
        }

        $success = true;
        if (function_exists('imagecreatetruecolor')) {
            $dst['image'] = imagecreatetruecolor($dst['w'], $dst['h']); // created thumbnail reference GD2
        } else {
            $dst['image'] = imagecreate($dst['w'], $dst['h']); // created thumbnail reference GD1
        }
        //use white background when png image has transparent background
        $white = imagecolorallocate($dst['image'], 255, 255, 255);
        imagefilledrectangle($dst['image'], 0, 0, $dst['w'], $dst['h'], $white);

        if (imagecopyresampled($dst['image'], $src['image'], 0, 0, 0, 0, $dst['w'], $dst['h'], $src['w'], $src['h'])) {
            $success = $this->saveGeneratedImage($dst['image'], $sDst, $iCompression);
        } else {
            $success = false;
        }
        imagedestroy($src['image']);
        imagedestroy($dst['image']);

        unset($src);
        unset($dst);

        return $success;
    }

    public function getFallbackUrl($sSrc, $sDst, $iX, $iY) {
        throw new Exception('Not implemented.', 1449231812);
    }

    public function getDestinationPath($sSrc, $sType, $iMaxWidth, $iMaxHeight) {
        if (MLHelper::getRemote()->isUrl($sSrc)) {
            $sSrc = parse_url($sSrc, PHP_URL_PATH);
            $sSrc = rawurldecode($sSrc);
        }
        $sFileName = str_replace(array(' ', "<", ">", ":", '"', "/", "\\", "|", "?", "*"), '', pathinfo($sSrc, PATHINFO_BASENAME));
        $sDst = $sType.'/'.$iMaxWidth.($iMaxWidth === $iMaxHeight ? '' : 'x'.$iMaxHeight).'px/'.$sFileName;
        return $sDst;
    }

    /**
     * Get Image Size
     *
     * @param string $url
     * @param string $referer
     * @return array|bool
     */
    public function getimagesize_curl($url, $referer = '', $blDecoded = false) {
        // Set headers
        $headers = array('Range: bytes=0-131072');
        if (!MLHelper::getRemote()->isUrl($url)) {
            return false;
        }
        if (!empty($referer)) {
            array_push($headers, 'Referer: '.$referer);
        }

        // Get remote image
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $data = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errno = curl_errno($ch);
        $curl_err = curl_error($ch);
        curl_close($ch);

        // Get network status

        if ($http_status != 200) {
            MLMessage::gi()->addDebug('Problem by getting image url:'.$url, array(basename($url), $http_status, $url, $curl_errno, $curl_err));
            //echo 'HTTP Status[' . $http_status . '] Errno [' . $curl_errno . ']';
            return false;
        }

        ob_start();
        // Process image
        $image = imagecreatefromstring($data);
        MLMessage::gi()->addDebug(__LINE__ . ':' . microtime(true), array(ob_get_clean()));
        if (empty($image)) {//a case that happened for a customer, even if the http_status is 200
            MLMessage::gi()->addDebug('Problem by getting image url:'.$url);
            //echo 'HTTP Status[' . $http_status . '] Errno [' . $curl_errno . ']';
            return false;
        }
        ob_start();
        $dims = [imagesx($image), imagesy($image)];
        imagedestroy($image);
        MLMessage::gi()->addDebug(__LINE__ . ':' . microtime(true), array(ob_get_clean()));
        return $dims;
    }

    public function getimagesize($sSrc) {
        $blReturn = false;
        $sSrc = trim($sSrc);

        // check cache
        $imgSourceHash = md5($sSrc);
        if (array_key_exists($imgSourceHash, self::$imageSizeCache)) {
            return self::$imageSizeCache[$imgSourceHash];
        }

        // get image size
        if (
            stripos($sSrc, 'http') !== 0 || //if the image source is file-system path
            ini_get('allow_url_fopen')//if accessing URL object like files is enabled.
        ) {
            $blReturn = @getimagesize($sSrc);
        }
        if ($blReturn === false) {
            $blReturn = $this->getimagesize_curl($sSrc);
        }

        //set cache
        self::$imageSizeCache[$imgSourceHash] = $blReturn;


        return $blReturn;
    }

    /**
     * @param $sSrc
     * @return mixed|string
     */
    protected function normalizeURL($sSrc) {
        if (stripos(trim($sSrc), 'http') === 0) {
            $base = basename($sSrc);
            $base = substr($base, 0, strrpos($base, '.'));
            $sSrc = str_replace($base, rawurlencode(rawurldecode($base)), $sSrc);
        }

        //Note: HTTPS is only supported when the openssl extension is enabled otherwise magnalister replace https with http to prevent error in @getimagesize function.
        if (!($this->getimagesize($sSrc))) {
            $sSrc = trim($sSrc); // Get rid of any accidental whitespace
            $parsed = parse_url($sSrc); // analyse the URL
            if (isset($parsed['scheme']) && strtolower($parsed['scheme']) == 'https') {
                // If it is https, change it to http
                $sSrc = 'http://'.substr($sSrc, 8);
            }
        }
        return $sSrc;
    }

    /**
     * Check if Image has supported format, if not throw exception
     * @param $sSrc
     * @throws Exception
     */
    protected function checkImageFormat($sSrc) {
        $iImageType = function_exists('exif_imagetype') ? @exif_imagetype($sSrc) : false;
        if ($iImageType !== false) {
            $supportedFormats = array(
                1,//IMAGETYPE_GIF
                2,//IMAGETYPE_JPEG
                3,//IMAGETYPE_PNG
                18//IMAGETYPE_WEBP
            );
            if (
                !in_array($iImageType, $supportedFormats) ||
                ($iImageType === 18 && $this->isWebpAnimated($sSrc)
                )
            ) {
                throw new Exception('"'.$iImageType.'" format not supported.', 1652878471);
            }
            self::$aImageType[$sSrc] = $iImageType;
        } else {
            // check if format is supported
            $supportedFormats = array(
                'png' => IMAGETYPE_PNG,
                'jpg' => IMAGETYPE_JPEG,
                'jpeg' => IMAGETYPE_JPEG,
                'gif' => IMAGETYPE_GIF,
                'webp' => IMAGETYPE_WEBP,
            );

            if (MLHelper::getRemote()->isUrl($sSrc)) {
                $aParsedUrl = parse_url($sSrc, PHP_URL_PATH);
                $pathInfo = pathinfo(
                    $aParsedUrl
                );
            } else {
                $pathInfo = pathinfo($sSrc);
            }

            $extension = null;
            if (isset($pathInfo['extension'])) {
                if (extension_loaded('mbstring')) {
                    $extension = mb_strtolower($pathInfo['extension']);
                } else {
                    $extension = strtolower($pathInfo['extension']);
                }
            }
            if (
                !isset($extension) || !isset($supportedFormats[$pathInfo['extension']]) ||
                ($pathInfo['extension'] === 'webp' && $this->isWebpAnimated($sSrc))
            ) {
                throw new Exception((isset($pathInfo['extension']) ? $pathInfo['extension'].' format not supported.' : ''), 1652878471);
            }
            self::$aImageType[$sSrc] = $supportedFormats[$pathInfo['extension']];
        }
    }

    protected function isWebpAnimated($src) {
        list($warning, $webpContents) = $this->getImageContent($src);
        $where = strpos($webpContents, "ANMF");
        if ($where !== FALSE) {
            $isAnimated = true;
        } else {
            $isAnimated = false;
        }
        return $isAnimated;
    }


    /**
     * @param Exception $ex
     * @throws Exception
     */
    protected function handleExceptions($ex) {
        throw $ex;
    }

    protected function resizeImageFallback($sSrc, $sType, $iMaxWidth, $iMaxHeight, $blUrlOnly, $imgHash, $originalSrc) {
        return false;
    }

    protected function removeExistingImage($sDst) {
        if (file_exists($sDst)) {
            unlink($sDst);
        }
    }

    /**
     * @param $sSrc
     * @param $sDst
     * @return bool
     */
    protected function copyImage($sSrc, $sDst) {
        return @copy($sSrc, $sDst);
    }

    /**
     * @param $sSrc
     * @return array
     */
    protected function getImageContent($sSrc) {
        $sImageContent = @MLHelper::getRemote()->fileGetContents($sSrc, $warning, 10, null);
        return array($warning, $sImageContent);
    }

    /**
     * @param $image
     * @param $sDst
     * @param $iCompression
     * @return bool
     */
    protected function saveGeneratedImage($image, $sDst, $iCompression) {
        $success = @imagejpeg($image, $sDst, $iCompression);
        return $success;
    }

    public function getProcessingTimePerImage() {
        return $this->processingTimePerImage;
    }

}
