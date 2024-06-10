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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Filesystem_Tests extends ML_Core_Controller_Abstract {
    
    /**
     * tests for ML_Core_Helper_Filesystem
     * @return array of results
     */
    protected function tests() {
        $oFilesystem = MLHelper::getFilesystemInstance();
        /* @var $oFilesystem ML_Core_Helper_Filesystem */
        $oReflection = new ReflectionClass($oFilesystem);
        $aReflectionMethods = array();
        foreach ($oReflection->getMethods() as $oReflectionMethod) {
            /* @var $oReflectionMethod ReflectionMethod */
            $oReflectionMethod->setAccessible(true);
            $aReflectionMethods[$oReflectionMethod->getName()] = $oReflectionMethod;
        }
        $aOut = array();
        try {
            foreach ($this->test('getMetaTestsAll', $oFilesystem, $aReflectionMethods) as $aResult) {
                $aOut[] = $aResult;
            }
        } catch (Exception $oEx) {
            MLMessage::gi()->addError($oEx);
        }
        return $aOut;
    }
    
    /**
     * execute single test or call meta tests
     * @return array
     */
    protected function test($mTestConf, $oFilesystem, $aReflectionMethods) {
        if (is_string($mTestConf)) { //meta-tests
            $iTime = microtime(true);
            $aOut = array(
                htmlentities('<'.$mTestConf.'>')
            );
            foreach ($this->{$mTestConf}() as $aTestConf) {
                foreach ($this->test($aTestConf, $oFilesystem, $aReflectionMethods) as $aResult) {
                    if (is_array($aResult)) {
                        $aOut[] = $aResult;
                    } else {
                        $aOut[] = str_repeat('&nbsp;', 4).$aResult;
                    }
                }
            }
            $aOut[0] .= htmlentities(' <!-- '.microtime2human(microtime(true)-$iTime).' --->');
            $aOut[] = htmlentities('</'.$mTestConf.'>');
            return $aOut;
        } else {
            try {
                $mResult = $aReflectionMethods[$mTestConf['command']]->invokeArgs($oFilesystem, $mTestConf['parameters']);
                $mTestConf['result'] = is_object($mResult) ? 'object' : $mResult;
                $mTestConf['message'] = '';
            } catch (Exception $oEx) {
                    $mTestConf['result'] = 'exception';
                    $mTestConf['message'] = $oEx->getMessage();
            }
            $mTestConf['command'] = get_class($oFilesystem).'::'.$mTestConf['command'];
            $mTestConf['success'] = (bool) ($mTestConf['result'] === $mTestConf['expectedResult']);
            $mTestConf['info'] = isset($mTestConf['info']) ? $mTestConf['info'] : '';
            return array($mTestConf);
        }
    }
    
    /**
     * get all tests
     * @return array
     */
    protected function getMetaTestsAll() {
        return array(
            'getMetaTestsFullPaths',
            'getMetaTestsReadable',
            'getMetaTestsWritable',
            'getMetaTestsCp',
            'getMetaTestsMv',
            'getMetaTestsClean',
        );
    }
    
    protected function getMetaTestsFullPaths () {
        $aOut = array('getMetaTestsClean');
        $aOut[] = array(
            'command' => 'getFullPath',
            'parameters' => array('/'),
            'expectedResult' => '/',
        );
        $aOut[] = array(
            'command' => 'getFullPath',
            'parameters' => array('/../'),
            'expectedResult' => 'exception',
        );
        $sPath = MLFilesystem::gi()->getCachePath('test');
        $aSeparators = array('/', '\\', '/%s\..\/', '//', '/%s\..\%s/..////');
        $aNotUsedSeparators = $aSeparators;
        foreach (explode('_', 'path_to_some_folder_much_more_deeper_not_reached_limit_yet_but_yet')  as $sSubPath) {
            if (count($aNotUsedSeparators)) {
                $sSeparator = array_pop($aNotUsedSeparators);
            } else {
                $sSeparator = $aSeparators[rand(0, count($aSeparators)-1)];
            }
            $sSeparator = 
            $aOut[] = array(
                'command' => 'getFullPath',
                'parameters' => array($sPath.sprintf($sSeparator, $sSubPath, $sSubPath).$sSubPath),
                'expectedResult' => $sPath.'/'.$sSubPath
            );
            $sPath .= '/'.$sSubPath;
        }
        return $aOut;
    }
    
    protected function getMetaTestsReadable () {
        return array(
            'getMetaTestsClean',
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => 'exception',
                'info' => 'readable::start'
            ),
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => 'exception',
            ),
            array(
                'command' => 'write',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php'), "<?php\n"),
                'expectedResult' => 'object',
                'info' => 'create file'
            ),
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'addNotReadablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => 'object',
            ),
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => false,
            ),
            array(
                'command' => 'addNotReadablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => 'object',
            ),
            array(
                'command' => 'isReadable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => false,
            ),
        );
    }
        protected function getMetaTestsWritable () {
        return array(
            'getMetaTestsClean',
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => true,
                'info' => 'writable::start'
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'write',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php'), "<?php\n"),
                'expectedResult' => 'object',
                'info' => 'create file'
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'write',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php'), "?>", true),
                'expectedResult' => 'object',
                'info' => 'append'
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'addNotWritablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => 'object',
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder/file.php')),
                'expectedResult' => false,
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => true,
            ),
            array(
                'command' => 'addNotReadablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => 'object',
            ),
            array(
                'command' => 'isWritable',
                'parameters' => array(MLFilesystem::getCachePath('test/folder')),
                'expectedResult' => false,
                'info' => ''
            ),
        );
    }
    /**
     * init
     * @return array
     */
    protected function getMetaTestsClean() {
        return array(
            array(
                'command' => 'addNotReadablePath',
                'parameters' => array(false),
                'expectedResult' => 'object',
            ),
            array(
                'command' => 'addNotWritablePath',
                'parameters' => array(false),
                'expectedResult' => 'object',
            ),
            array(
                'command' => 'rm',
                'parameters' => array(MLFilesystem::getCachePath('test')),
                'expectedResult' => 'object',
            )
        );
    }
    
    /**
     * test for create needed files and folders
     * @return array
     */
    protected function getMetaTestsCreateFilesAndFolders() {
        $aOut = array('getMetaTestsClean');
        foreach (array(
            'folderNotReadable', 'folderNotWritable', 'folderSrcCp', 'folderDstCp', 'folderSrcMv', 'folderDstMv'
        ) as $sPath) {
            $aOut[] = array(
                'command' => 'write',
                'parameters' => array(MLFilesystem::getCachePath('test/'.$sPath)),
                'expectedResult' => 'object'
            );
        }
        foreach (array(
            'folderNotReadable', 'folderNotWritable', 'folderSrcCp', 'folderSrcMv', 
        ) as $sPath) {
            $aOut[] = array(
                'command' => 'write',
                'parameters' => array(MLFilesystem::getCachePath('test/'.$sPath.'/file.php'), "<?php\n"),
                'expectedResult' => 'object'
            );
        }
        $aOut [] = 
            array(
                'command' => 'addNotWritablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folderNotWritable')),
                'expectedResult' => 'object',
            )
        ;
        $aOut [] = 
            array(
                'command' => 'addNotWritablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folderNotWritable/file.php')),
                'expectedResult' => 'object',
            )
        ;
        $aOut [] = 
            array(
                'command' => 'addNotReadablePath',
                'parameters' => array(MLFilesystem::getCachePath('test/folderNotReadable')),
                'expectedResult' => 'object',
            )
        ;
        return $aOut;
    }
    
    /**
     * tests for copy
     * @return array
     */
    protected function getMetaTestsCp () {
        $aOut = array('getMetaTestsCreateFilesAndFolders');
        foreach (array(
            array('folderNotReadable',          'folderDstCp', 'exception'),
            array('folderNotWritable',          'folderDstCp', 'object'),
            array('folderSrcCp',                'folderDstCp', 'object'),
            array('folderNotWritable/file.php', 'folderDstCp', 'object'),
            array('folderSrcCp/file.php',       'folderDstCp', 'object'),
        ) as $aTest) {
            $aOut[] = array(
                'command' => 'cp',
                'parameters' => array(
                    MLFilesystem::getCachePath('test/'.$aTest[0]),
                    MLFilesystem::getCachePath('test/'.$aTest[1]),
                ),
                'expectedResult' => $aTest[2]
            );
        }
        return $aOut;
    }
    
    /**
     * tests for rename
     * @return array
     */
    protected function getMetaTestsMv () {
        $aOut = array('getMetaTestsCreateFilesAndFolders');
        foreach (array(
            array('folderNotReadable',          'folderDstMv', 'exception'),
            array('folderNotWritable',          'folderDstMv', 'exception'),
            array('folderSrcMv/file.php',       'folderDstMv/file.php', 'object'),
            array('folderSrcMv',                'folderDstMv', 'exception'),
            array('folderNotWritable/file.php', 'folderDstMv', 'exception'),
        ) as $aTest) {
            $aOut[] = array(
                'command' => 'mv',
                'parameters' => array(
                    MLFilesystem::getCachePath('test/'.$aTest[0]),
                    MLFilesystem::getCachePath('test/'.$aTest[1]),
                ),
                'expectedResult' => $aTest[2]
            );
        }
        return $aOut;
    }
    
}