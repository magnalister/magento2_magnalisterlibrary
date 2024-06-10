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
 * $Id$
 *
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */


/**
 * A helper class for handle with files inside filesystem
 */
class ML_Core_Helper_Filesystem {
    
    /**
     * path who are not writable, needed for tests
     * @var array $aNotWritable
     */
    protected $aNotWritable = array();
    
    /**
     * path who are not readable, needed for tests
     * @var array $aNotReadable
     */
    protected $aNotReadable = array();
    
    /**
     * force some path for not writable only use for testing
     * @param string $sPath
     * @param bool $sPath if false reset
     * @return \ML_Core_Helper_Filesystem
     */
    protected function addNotWritablePath($sPath) {
        if ($sPath === false) {
            $this->aNotWritable = array();
        } else {
            $sPath = $this->getFullPath($sPath);
            if (!in_array($sPath, $this->aNotWritable)) {
                $this->aNotWritable[] = $sPath;
            }
        }
        return $this;
    }
    /**
     * force some path for not writable only use for testing
     * @param string $sPath
     * @param bool $sPath if false reset
     * @return \ML_Core_Helper_Filesystem
     */
    protected function addNotReadablePath($sPath) {
        $this->addNotWritablePath($sPath);
        if ($sPath === false) {
            $this->aNotReadable = array();
        } else {
            $sPath = $this->getFullPath($sPath);
            if (!in_array($sPath, $this->aNotReadable)) {
                $this->aNotReadable[] = $sPath;
            }
        }
        return $this;
    }


    /**
     * get full path to file (clean)
     * if file not starts with / it will prepend path/to/lib
     * @param string $sInputPath
     * @return string 
     * @throws Exception path outside root
     * @see http://php.net/manual/en/function.realpath.php#81935
     */
    public function getFullPath($sInputPath) {
        if (
            (strpos($sInputPath, '/') !== 0 && DIRECTORY_SEPARATOR === '/') // linux
            ||
            (strpos($sInputPath, ':') === false && DIRECTORY_SEPARATOR === '\\') // windows
        ) { // not root-path
            $sInputPath = MLFilesystem::getLibPath($sInputPath); // adding lib folder
        }        
        $sInputPath = str_replace(array('\\'), array('/'), $sInputPath); // to linux separator

        $aPath = array();
        $iDeep = 0;
        foreach (explode('/', $sInputPath) as $iCount => $sSubPath) {
            if ($sSubPath == '' || $sSubPath == '.') {
                continue;
            }
            if ($sSubPath == '..' && $iCount > 0 && end($aPath) != '..') {
                $iDeep--;
                array_pop($aPath);
            } else {
                $iDeep++;
                $aPath[] = $sSubPath;
            }
        }
        if ($iDeep < 0) {
            throw MLException::factory('update', 'Path `{#path#}` outside root-folder.', 1424244622)->setData(array('path' => $sInputPath));
        }
        $sInputPath = (DIRECTORY_SEPARATOR === '/' ? '/' : '') . implode(DIRECTORY_SEPARATOR, $aPath);
        return $sInputPath;
    }
    
    /**
     * checks if $sPath is readable
     * @param string $sPath
     * @return bool
     * @throws Exception path not exists
     */
    public function isReadable($sPath) {
        $sPath = $this->getFullPath($sPath);
        if (in_array($sPath, $this->aNotReadable)) {//tests
            return false;
        }
        if (!file_exists($sPath)) {
            throw MLException::factory(
                'update', 
                'File `{#path#}` not exists.', 
                1423821549
            )->setData(array('path' => $sPath));
        }
        return is_readable($sPath);
    }

    /**
     * checks if $sPath is writable
     * @param string $sPath
     * @return bool
     */
    public function isWritable($sPath) {
        $sPath = $this->getFullPath($sPath);
        if (in_array($sPath, $this->aNotWritable)) {//tests
            return false;
        }
        if (!file_exists($sPath)) {
            return $this->isWritable(dirname($sPath));
        }
        return is_writable($sPath);
    }
    
    /**
     * clean stat cache of given path(s)
     * @param array $mPath 
     * @param string $mPath 
     * @return \ML_Core_Helper_Filesystem
     */
    protected function clearStatCache ($mPath) {
        if (is_array($mPath)) {
            foreach ($mPath as $sPath) {
                $this->clearStatCache($sPath);
            }
        } else {
            if (version_compare(PHP_VERSION, '5.3', '<')) {
                @clearstatcache(true);
            } else {
                @clearstatcache(true, $mPath);
            }
        }
        return $this;
    }
    
    /**
     * reads complete folder including hidden files
     * @param string $sFolder
     * @param array $aExclude exclude filenames | default = index.php
     * @return array
     */
    public function readDir ($sFolder, $aExclude = array('index.php')) {
        $aDir = array();
        if (file_exists($sFolder)) {
            $rDir = opendir($sFolder);
            $aExclude[] = '.';
            $aExclude[] = '..';
            while ($sPath = readdir($rDir)) {
                if (!in_array($sPath, $aExclude)) {
                    $aDir[] = $sFolder.'/'.$sPath;
                }
            }
            closedir($rDir);
            sort($aDir);
        }
        return $aDir;
    }
    
    /**
     * move file or folder $sSrcPath to $sDstPath
     * @param string $sSrcPath
     * @param string $sDstPath
     * @return \ML_Core_Helper_Filesystem
     */
    public function mv($sSrcPath, $sDstPath) {
        $sSrcPath = $this->getFullPath($sSrcPath);
        $sDstPath = $this->getFullPath($sDstPath);
        
        // check permissions
        foreach (array($sSrcPath, $sDstPath) as $sPath) {
            if (!$this->isWritable($sPath)) {
                throw MLException::factory('update', 'Path `{#path#}` is not writable.', 1407759765)->setData(array('path' =>$sPath));
            }
        }
        if (
            file_exists(is_dir($sSrcPath) ? $sDstPath : dirname($sDstPath)) 
            && count($this->readDir(is_dir($sSrcPath) ? $sDstPath : dirname($sDstPath).'/', array())) == 0
        ) {
            $this->rm($sDstPath);
        }
        // create destination folder
        $this->write(dirname($sDstPath));
//         $this->write(is_dir($sSrcPath) ? $sDstPath : dirname($sDstPath));
        // execute
        if (!@rename($sSrcPath, $sDstPath)) {
            throw MLException::factory(
                'update', 
                'Can\t rename `{#srcPath#}` to `{#dstPath#}`.', 
                1410962251
            )->setData(array(
                'srcPath' => $sSrcPath, 
                'dstPath' => $sDstPath,
            ));
        } else {
            // check
            $this->clearStatCache(array($sSrcPath, $sDstPath));
            if (file_exists($sSrcPath) || !file_exists($sDstPath)) {
                throw MLException::factory(
                    'update', 
                    'Can\t rename `{#srcPath#}` to `{#dstPath#}`.', 
                    1410962251
                )->setData(array(
                    'srcPath' => $sSrcPath, 
                    'dstPath' => $sDstPath,
                ));
            }
            return $this;
        }
    }
    
    /**
     * copy file or complete folder from $sSrcPath to $sDstPath
     * @param string $sSrcPath
     * @param string $sDstPath
     * @return \ML_Core_Helper_Filesystem
     */
    public function cp($sSrcPath, $sDstPath, $blCleanDst = true) {
        $sSrcPath = $this->getFullPath($sSrcPath);
        $sDstPath = $this->getFullPath($sDstPath);
        // check
        if (!$this->isReadable($sSrcPath, true)) {
            throw MLException::factory('update', 'Path `{#path#}` is not readable.', 1423819826)->setData(array('path' => $sSrcPath));
        }
        if (!$this->isWritable($sDstPath)) {
            throw MLException::factory('update', 'Path `{#path#}` is not writable.', 1407759765)->setData(array('path' => $sDstPath));
        }
        // clean destination path
        if ($blCleanDst) {
            try {
                $this->rm($sDstPath);
            } catch (Exception $oEx) {
                if (is_dir($sDstPath)) {
                    throw $oEx;
                }
            }
        }
        try {
            // create destination folder
            $this->write(is_dir($sSrcPath) ? $sDstPath : dirname($sDstPath));
        } catch (Exception $oEx) {
            
        }
        // excecute
        if (is_dir($sSrcPath)) {
            $blResult = true;// otherwise throws exception
            foreach($this->readDir($sSrcPath, array()) as $sPath) {
                $sSubPath = basename($sPath);
                $this->cp($sSrcPath.'/'.$sSubPath, $sDstPath.'/'.$sSubPath);
            }
        } else {
            $blResult = @copy($sSrcPath, $sDstPath);
        }
        $this->clearStatCache($sDstPath);
        // check
        if (!file_exists($sDstPath) || !$blResult) {
            throw MLException::factory(
                'update', 
                'Can\t copy `{#srcPath#}` to `{#dstPath#}`.', 
                1407761504
            )->setData(array(
                'srcPath' => $sSrcPath, 
                'dstPath' => $sDstPath,
            ));
        } else {
            return $this;
        }
    }

    /**
     * writes $sContent to file in $sPath, if $sContent = null creates folder $sPath
     * @param string $sPath
     * @param string $mContent content to write
     * @param null $mContent file is folder
     * @param bool $blAppend only use, if $mContent ! null $sContent will appended, otherwise replaced
     * @return \ML_Core_Helper_Filesystem
     */
    public function write($sPath, $mContent = null, $blAppend = false) {
        $sPath = $this->getFullPath($sPath);
        // check permissions
        if (!$this->isWritable($sPath)) {
            if (is_dir($sPath)) {
                throw MLException::factory(
                    'update', 
                    'Can\'t create folder `{#path#}`.', 
                    1407752557
                )->setData(array('path' => $sPath));
            } else {
                throw MLException::factory(
                    'update', 
                    'File `{#path#}` is not writable.', 
                    1407759765
                )->setData(array('path' => $sPath));
            }
        }
        // create folder
        if (!file_exists(dirname($sPath))) {
            $this->write(dirname($sPath));
        }
        if ($mContent === null) {
            $oldumask = umask(0);
            @mkdir($sPath, 0777);
            umask($oldumask);
        } else {
            @file_put_contents($sPath, MLHelper::getEncoderInstance()->encode($mContent), ($blAppend ? FILE_APPEND : 0));
        }
        $this->clearStatCache($sPath);
        if (!file_exists($sPath)) {
            if (is_dir($sPath)) {
                throw MLException::factory(
                    'update', 
                    'Can\'t create folder `{#path#}`.', 
                    1407752557
                )->setData(array('path' => $sPath));
            } else {
                throw MLException::factory(
                    'update', 
                    'File `{#path#}` is not writable.', 
                    1407759765
                )->setData(array('path' => $sPath));
            }
        } else {
            return $this;
        }
    }
    
    /**
     * removes file or complete folder of $sPath
     * @param string $sPath
     * @return \ML_Core_Helper_Filesystem
     */
    public function rm($sPath) {
        $sPath = $this->getFullPath($sPath);
        if ($this->isWritable($sPath)) {
            if (file_exists($sPath)) {
                if (is_dir($sPath)) {
                    foreach ($this->readDir($sPath.'/', array()) as $sSubPath) {
                        $this->rm($sSubPath);
                    }
                    @rmdir($sPath);
                } else {
                    @unlink($sPath);
                }
                $this->clearStatCache($sPath);
            }
            if (file_exists($sPath)) {
                if (is_dir($sPath)) {
                    MLMessage::gi()->addDebug($sPath, $this->readDir($sPath.'/', array()));
                    throw MLException::factory(
                        'update', 
                        'Can\t delete folder `{#path#}`.', 
                        1407761097
                    )->setData(array('path' => $sPath));
                } else {
                    throw MLException::factory(
                        'update', 
                        'Can\t delete file `{#path#}`.', 
                        1407762193
                    )->setData(array('path' => $sPath));
                }
            } else {
                return $this;
            }
        } else {
            throw MLException::factory(
                'update', 
                'File `{#path#}` is not writable.', 
                1407759765
            )->setData(array('path' => $sPath));
        }
    }
    
    /**
     * quick test for update capacity
     * @return bool
     * @throws Exception
     */
    public function updateTest() {
        if (MLSetting::gi()->get('blSaveMode')) {
            throw MLException::factory('update', 'save mode', 1424074789);
        }
        if (!$this->isWritable(MLFilesystem::getCachePath())) {//needed for tests
            throw MLException::factory('update', 'Path `{#path#}` is not writable.', 1407759765)->setData(array('path' => MLFilesystem::getCachePath()));
        }
        try {// cache is writable, so no exception should come 
            $blUpdate = true;
            // clean
            $blUpdate = $blUpdate ? ($this->rm(MLFilesystem::getCachePath('test'))) : false;
            // create file
            $blUpdate = $blUpdate ? ($this->write(MLFilesystem::getCachePath('test/folder/included.php'), "<?php\nreturn basename(__file__);\n")) : false;
            // includes file
            $blUpdate = $blUpdate ? ('included.php' == (@include MLFilesystem::getCachePath('test/folder/included.php'))) : false;
            // move file
            $blUpdate = 
                $blUpdate 
                ? $this->mv(
                    MLFilesystem::getCachePath('test/folder/included.php'),
                    MLFilesystem::getCachePath('test/folder/moved.php')
                )
                : false 
            ;
            // include file
            $blUpdate = $blUpdate ? ('moved.php' == (@include MLFilesystem::getCachePath('test/folder/moved.php'))) : false;
            // move folder
            $blUpdate = 
                $blUpdate 
                ? $this->mv(
                    MLFilesystem::getCachePath('test/folder'),
                    MLFilesystem::getCachePath('test/otherfolder')
                )
                : false 
            ;
            // include file
            $blUpdate = $blUpdate ? ('moved.php' == (@include MLFilesystem::getCachePath('test/otherfolder/moved.php'))) : false;
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
            $blUpdate = false;
        }
        if (!$blUpdate) {
            throw MLException::factory(
                'update', 
                'Misc update error', 
                1424075291
            );
        }
        return $this;
    }
    
}
