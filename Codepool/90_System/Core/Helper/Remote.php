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

/**
 * A helper class for remote http(s) requests.
 */
class ML_Core_Helper_Remote {
    protected $aCURLStatus = array();
    protected $blIterativeRequest = true;

    /**
     * Creates the class
     */
    public function __construct() {
        $this->aCURLStatus = MLSession::gi()->get('ML_UseCURL');
        $this->blIterativeRequest = MLSetting::gi()->blIterativeRequest;
        #echo print_m($this->aCURLStatus, '$this->aCURLStatus:'.__LINE__);
        
        if (!is_array($this->aCURLStatus)
            || !isset($this->aCURLStatus['ForceCurl'])
            || !isset($this->aCURLStatus['UseCurl'])
        ) {
            $this->aCURLStatus = array(
                'ForceCurl' => false,
                'UseCurl' => function_exists('curl_init'),
            );
        }
        
        #echo print_m($this->aCURLStatus, '$this->aCURLStatus:'.__LINE__);
    }
    
    /**
     * Gets the status of the cURL library.
     * @return bool
     *    true if cURL should be used, false for the php file functions.
     */
    public function getCURLStatus() {
        if (isset($this->aCURLStatus['ForceCurl']) && ($this->aCURLStatus['ForceCurl'] === true)) {
            // READ ForceCurl === true
            return true;
        }
        if (isset($this->aCURLStatus['UseCurl']) && is_bool($this->aCURLStatus['UseCurl'])) {
            // READ UseCurl (bool)
            return $this->aCURLStatus['UseCurl'];
        }
        //echo "NO READ\n";
        return function_exists('curl_init');
    }
    
    /**
     * Set the status for the cURL library.
     * @param mixed $mState
     *     * 'ForceCurl' to force enable the use of cURL.
     *     * bool otherwise.
     * @return bool
     *    The new status
     */
    public function setCURLStatus($mState) {
        if (!isset($this->aCURLStatus['ForceCurl']) || !isset($this->aCURLStatus['UseCurl'])) {
            $this->aCURLStatus = array(
                'ForceCurl' => false,
                'UseCurl' => function_exists('curl_init')
            );
        }
        
        if ($mState === 'ForceCurl') {
            $this->aCURLStatus['ForceCurl'] = true;
            $this->aCURLStatus['UseCurl'] = true;
        } else if ($this->aCURLStatus['ForceCurl'] !== true) {
            $this->aCURLStatus['UseCurl'] = (bool)$mState;
        }
        
        MLSession::gi()->set('ML_UseCurl', $this->aCURLStatus);
        
        return $this->aCURLStatus['UseCurl'];
    }
    
    /**
     * Get a remote file using the php native file wrapper functions.
     * @param string $path
     * @param ?string $warnings
     * @param int $timeout
     * @return string
     */
    protected function fileGetContentsPHP($path, &$warnings = null, $timeout = 10) {
        #echo print_m(func_get_args(), __METHOD__.'['.__LINE__.']');
        if ($timeout > 0) {
            $context = stream_context_create(array(
                'http' => array(
                    'timeout' => $timeout
                )
            ));
        } else {
            $context = null;
        }
        $timeout_ts = time() + $timeout;
        $next_try = false;
        
        ob_start();
        do {
            if ($next_try) {
                usleep(rand(500000, 1500000));
            }
            $return = file_get_contents($path, false, $context);
            // maybe we should check $http_response_header http://php.net/manual/de/reserved.variables.httpresponseheader.php for 200 ok
            $warnings = ob_get_contents();
            $next_try = true;
        } while ($this->blIterativeRequest && (false === $return) && (time() < $timeout_ts));
        ob_end_clean();
        
        return $return;
    }
    
    /**
     * Get a remote file using the cURL library.
     * @param string $path
     * @param ?string $warnings
     * @param int $timeout
     * @param mixed $forceSSL (true = forceSSL, false = forceNoSSL, null = use protocol from $path)
     * @return string
     */
    protected function fileGetContentsCURL($path, &$warnings = null, $timeout = 10, $forceSSL = true) {
        #echo print_m(func_get_args(), __METHOD__.'['.__LINE__.']');
        $UseCurl = $this->getCURLStatus();
        if ($UseCurl === false) {
            $warnings = 'cURL disabled';
            return false;
        }
        
        //echo __METHOD__."\n";
        if (!function_exists('curl_init') || (strpos($path, 'http') !== 0)) {
            return false;
        }
        $cURLVersion = curl_version();
        if (!is_array($cURLVersion) || !array_key_exists('version', $cURLVersion)) {
            return false;
        }
        
        $warnings = '';
        $ch = curl_init();
        
        $supportsSSL = is_array($cURLVersion) && array_key_exists('protocols', $cURLVersion) && in_array('https', $cURLVersion['protocols']);
        
        if (
            $supportsSSL 
            && (
                $forceSSL === true
                || ($forceSSL === null && stripos($path, 'https://') !== false)
            )    
        ) {
            $path = str_replace('http://', 'https://', $path);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            if (defined('MAGNA_CURLOPT_SSLVERSION')) {
                curl_setopt($ch, CURLOPT_SSLVERSION, MAGNA_CURLOPT_SSLVERSION);
            }
        } else {
            $path = str_replace('https://', 'http://', $path);
        }
        
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($timeout > 0) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $timeout_ts = time() + $timeout;
        $next_try = false;
        $return = false;
        
        do {
            //break;
            if ($next_try) {
                usleep(rand(500000, 1500000));
            }
            $return = curl_exec($ch);
            $next_try = true;
        } while ($this->blIterativeRequest && curl_errno($ch) && (time() < $timeout_ts));
        
        if (curl_errno($ch) == CURLE_OPERATION_TIMEOUTED) {
            $this->setCURLStatus(false);
            $return = false;
        }
        
        $warnings = curl_error($ch);
        /*
        __ml_UseCurl(false);
        $return = false;
        $warnings = 'Timeout';
        //*/
        
        if (!empty($return)) {
            $this->setCURLStatus('ForceCurl');
        }
        
        curl_close($ch);
        
        return $return;
    }
    
    /**
     * Gets a remote file.
     * @param string $path
     * @param ?string $warnings
     * @param int $timeout
     * @param mixed $forceSSL (true = forceSSL, false = forceNoSSL, null = use protokoll from $path)
     * @return string
     */
    public function fileGetContents($path, &$warnings = null, $timeout = 10, $forceSSL = true) {
        #echo print_m(func_get_args(), __METHOD__.'['.__LINE__.']');

        if ($this->isUrl($path) && strpos($path, ' ') !== false) {
            $path = str_replace(' ', '%20', $path);
        }

        if (($contents = $this->fileGetContentsCURL($path, $warnings, $timeout, $forceSSL)) !== false) {
            return $contents;
        }
        return $this->fileGetContentsPHP($path, $warnings, $timeout);
    }

    public function isUrl($sImagePath) {
        return preg_match("/^https?:\\/\\//", $sImagePath) === 1;
    }

    /**
     * Get the file list of the magnalister update server.
     * @param string $sRemote
     * return array
     *    The file list content
     * @return array
     * @throws Exception
     */
    public function getFileList($sRemote) {
        if (strpos($sRemote, 'http') === 0) {
            $aRemoteFiles = array('__plugin' => array(), '__external' => array());

            $sExternalListParamAddition = '';
            //shopware specific
            if (method_exists(MLShop::gi(), 'isComposerInstallation') && MLShop::gi()->isComposerInstallation()) {
                $sExternalListParamAddition = '&composer';
            }

            foreach (array(
                'files.list?format=json&shopsystem='.MLShop::gi()->getShopSystemName() => '__plugin',
                'external.list?format=json&shopsystem='.MLShop::gi()->getShopSystemName().$sExternalListParamAddition => '__external'
            ) as $sRequest => $sType) {
                $warnings = null;
                $sContent = $this->fileGetContents($sRemote.$sRequest, $warnings, 20);
                $aContent = json_decode($sContent, true);
                if (!is_array($aContent)) {
                    throw new Exception("Can't read json");
                } else { //ff
                    foreach ($aContent as $aRow) {
                        if ($aRow['Destination'] !== '') {//lib-folder
                            if ($sType == '__plugin') {
                                $sOutPath = $aRow['Source'];
                            } else {
                                $sOutPath = str_replace( '../', '__/', $aRow['Destination']);
                                if (empty($aRow['Hash']) && substr($sOutPath,-1) != '/') {
                                    $sOutPath .= '/';
                                }
                            }
                            $aRemoteFiles[$sType][$sOutPath] = array(
                                'src' => $aRow['Source'],
                                'dst' => ($aRow['Destination'] === false) ? $aRow['Source'] : $aRow['Destination'],
                                'hash' => $aRow['Hash'],
                            );
                        }
                    }
                }
            }
            if (isset($aRemoteFiles['__external'])) { // adding missing folders
                $aMissingRemoteFolders = array();
                foreach (array_keys($aRemoteFiles['__external']) as $sIdent ) {
                    $sFolder = substr($sIdent,0,strrpos($sIdent, '__/')).'__/';
                    if (
                        !isset($aRemoteFiles[$sFolder])
                        && !in_array($sFolder, $aMissingRemoteFolders)
                    ) {
                        $aMissingRemoteFolders[] = $sFolder;
                    }
                }
                foreach ($aMissingRemoteFolders as $sFolder) {
                    $aRemoteFiles['__external'][$sFolder] = array(
                        'src' => $sFolder,
                        'dst' => str_replace('__/', '../', $sFolder),
                        'hash' => 0,
                    );
                }
            }
            return $aRemoteFiles;
        } else {
            $aLocalFiles = MLHelper::getFilesystemInstance()->readDir($sRemote, array());
            for ($i = 0; $i < count($aLocalFiles); $i++) {
                if (is_dir($aLocalFiles[$i])) {
                    $add = MLHelper::getFilesystemInstance()->readDir($aLocalFiles[$i].'/', array());
                    $aLocalFiles = array_merge($aLocalFiles, $add);
                }
            }
            $aOut = array('__plugin' => array(), '__external' => array());
            foreach($aLocalFiles as $sPath){
                $blIsDir = is_dir($sPath);
                $sPath = MLHelper::getFilesystemInstance()->getFullPath($sPath);
                $sOutPath = substr($sPath, strlen($sRemote)).($blIsDir ? '/' : '');
                if (strlen($sOutPath) >9 && substr($sOutPath, 0, 9) == 'writable/') {
                    continue;
                }
                if (strpos($sOutPath, '__external') === 0 || strpos($sOutPath, '__plugin') === 0) {//staging area
                    $sType = strpos($sOutPath, '__external') === 0 ? '__external' : '__plugin';
                    $sOutPath = substr($sOutPath, strlen($sType)+1);
                    if (empty($sOutPath)) {
                        continue; // basepath of type
                    }
                } else {
                    $sType = '__plugin';
                }
                if ($sType == '__plugin') {
                    $sDest = $sOutPath;
                } else {
                    $sDest = preg_replace('/(\/\/)/', '/', str_replace('__/', '../', $sOutPath));
                }
                $aOut[$sType][str_replace(DIRECTORY_SEPARATOR, '/', $sOutPath)] = array(
                    'src' => $sOutPath,
                    'dst' => $sDest,
                    'hash' => ($blIsDir?0:md5_file($sPath)),
                );
            }
            return $aOut;
        }
    }

}
