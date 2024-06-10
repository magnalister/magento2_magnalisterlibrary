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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

/**
 * Updates and installs the magnalister-plugin.
 */
class ML_Core_Controller_Do_Update extends ML_Core_Controller_Abstract {

    protected $blDebug = false;// default = false

    /**
     * @var ML_Core_Update_Abstract
     */
    protected $oCurrentAfterUpdateClass = null;
    /**
     * delete-staging area and count also local files for copy
     * @var array
     */
    protected $aFullUpdate = array(
        'removeStagingArea' => false, // delete staging area before update      | default = false todo
        'runSequence' => false, // count also copy files (default only wget)    | default = false todo
        'ajaxAfterUpdate' => false, // reload after each class                  | default = false todo
    );

    protected $aParameters = array('do');

    /**
     * @var array $aIgnorePattern regex-pattern for files that not will touched
     */
    protected $aIgnorePatterns=array(
        '^writable\/.*',
        '^files.list$',
        '^specialfiles.list$',
        '^permissions.list$',
        '^external.list$',
        '^Update$',
        '\.svn',
        //        'index\.php', //will added automatically to avoid dirlist
        '^((?!__).*index\.php)$', //will added automatically in plugin (not shopspecific) to avoid dirlist
    );


    /**
     * the steps and parameters
     * @var array
     */
    protected $aProgressBar = array(
        'init' => array(
            'weighting' => 9,
        ),
        'calcSequences' => array(
            'weighting' => 29,
        ),
        'copyFilesToStaging' => array(
            'weighting' => 29,
        ),
        'addIndexPhp' => array(
            'weighting' => 10
        ),
        'finalizeUpdate' => array(
            'weighting' => 19,
        ),
        'afterUpdate' => array(
            'weighting' => 10,
        ),
        'success' => array(
            'weighting' => 4,
        ),
    );

    protected $aCopyLocal2Staging = array(
        'Codepool/00_Dev/',
        'Codepool/10_Customer/',
        'OldLib/contribs/',
    );

    /**
     * @var int $iItemsPerRequest max remote items per request
     */
    protected $iItemsPerRequest = 20;// default = 20;

    /**
     * @var int $iMinItems minimal count of items which are in plugin process
     */
    protected $iMinItems = 200;

    /**
     * @var string $sCacheName cach name
     */
    protected $sCacheName = '';

    /**
     * Sequence with actions (staging, plugin)
     * @var array $aSequences
     */
    protected $aSequences = array();

    /**
     * Meta-Data from sequence
     * @var array
     */
    protected $aMeta = array(
        'remoteActions' => array()
    );

    protected $blUseZip = false;

    /**
     * constructor, sets default values, preload classes, to be sure, that them from actual installation
     */
    public function __construct() {
        // be sure, classes are loaded before copy
        MLSession::gi();
        MLSetting::gi();
        MLMessage::gi();
        MLController::gi('widget_message');
        $this->getProgressBarWidget();
        MLHelper::gi('remote');
        MLCache::gi();
        MLShop::gi();
        MLHttp::gi();
        MLLog::gi();
        MLException::factory('update');
        try {
            MLDatabase::factory('config');
        } catch (Exception $oEx) {
            // database is not part of installer
        }
        $this->sCacheName = __CLASS__.'__updateinfo.json';
        parent::__construct();
    }

    /**
     * returns misc. paths
     * @param string $sType
     * @return string path/to/folder
     * @throws Exception
     */
    protected function getPath ($sType) {
        switch ($sType) {
            case 'server': {
                return
                    $this->blUseZip
                        ? $this->getPath('zip')
                        : MLSetting::gi()->get('sUpdateUrl') . 'magnalister/'
                    ;
            }
            case 'plugin': {
                return MLFilesystem::getLibPath();
            }
            case 'staging': {
                return MLFilesystem::getWritablePath('staging/');//dirname be shure not relative to libfolder, it could be renamed
            }
            case 'zip': {
                return MLFilesystem::getWritablePath('zip/');
            }
            case 'clientversion' : {
                $sCurrentVersion = MLSetting::gi()->get('sClientVersion');
                return MLSetting::gi()->get('sUpdateUrl') . 'ClientVersion/'.(empty($sCurrentVersion) ? 'install' : $sCurrentVersion);
            }
            default:
                throw new Exception('Type is not proper');
        }
    }

    /**
     * counts different types for statistic
     * @param string $sType
     * @return int
     */
    protected function getCount($sType) {
        switch ($sType) {
            case 'final' : {
                $sCount = 'plugin';
                $aCount = array('', 'mkdir', 'cp');
                break;
            }
            case 'total_plugin' : {
                $sCount = 'plugin';
                $aCount = array('', 'mkdir', 'cp', 'rm', 'rmdir');
                break;
            }
            case 'action_plugin' : {
                $sCount = 'plugin';
                $aCount = array('mkdir', 'cp', 'rm', 'rmdir');
                break;
            }
            case 'total_staging' : {
                $sCount = 'staging';
                $aCount = array('', 'mkdir', 'cp', 'rm', 'rmdir');
                break;
            }
            case 'action_staging' : {
                $sCount = 'staging';
                $aCount = array('mkdir', 'cp', 'rm', 'rmdir');
                break;
            }
            case 'remote_plugin' : {
                return isset($this->aMeta['remoteActions']['plugin']) ? count($this->aMeta['remoteActions']['plugin']) : 0;
            }
            case 'remote_staging' : {
                return isset($this->aMeta['remoteActions']['staging']) ? count($this->aMeta['remoteActions']['staging']) : 0;
            }
            default : {
                return 0;
            }
        }
        $iCount = 0;
        foreach (array_keys($this->aSequences[$sCount]) as $sAction) {
            if (in_array($sAction, $aCount, true)) {
                $iCount += count($this->aSequences[$sCount][$sAction]);
            }
        }
        return $iCount;
    }

    /**
     * checks if staging folder, creates folder if not exists, checks disk space of needed base-folders
     * @return ML_Core_Controller_Do_Update
     * @throws ML_Core_Exception_Update
     * @throws Exception
     */
    protected function checkStagingFolder () {
        // creating update-folder
        $this->mkdir(array('dst' => $this->getPath('staging')));
        $sListOfFunction = @ini_get('disable_functions');
        if (strpos($sListOfFunction, 'disk_free_space') === false) {
            foreach (array('plugin', 'staging') as $sPath) {
                $iFreeSpace = @disk_free_space($this->getPath($sPath));
                MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE' => __LINE__, '$sPath' => $sPath, $iFreeSpace => $iFreeSpace));
                if ($iFreeSpace === false) {
                    MLMessage::gi()->addDebug('disk_free_space function returns false.');
                } elseif ($iFreeSpace < 70 * 1024 * 1024) {
                    throw MLException::factory(
                        'update',
                        'Insufficient disk space ({#currentDiskSpace#} needed {#neededDiskSpace#}).',
                        1407751100
                    )->setData(array('currentDiskSpace' => disk_free_space($this->getPath($sPath)), 'neededDiskSpace' => 30 * 1024 * 1024));
                }
            }
        } else {
            MLMessage::gi()->addDebug('disk_free_space function cannot be used.');
        }
        return $this;
    }

    /**
     * add plugin-data to $aFolderData if folder-data is external
     * the fileslist dont know about external data, but with info of server or update data we can fill it now
     * @param array $aFolderData
     * @param $sIdentPath string
     * @return ML_Core_Controller_Do_Update
     */
    protected function addPluginDataDynamically (&$aFolderData, $sIdentPath) {
        if (strpos($sIdentPath, '__/') === 0) { //external
            if (isset($aFolderData['server']) || isset($aFolderData['staging'])) {
                $sFrom = isset($aFolderData['server']) ? 'server' : 'staging';
                $sPluginFile = MLFilesystem::getLibPath($aFolderData[$sFrom]['dst']);
                if (file_exists($sPluginFile)) {
                    $aFolderData['plugin'] = array(
                        'src' => $aFolderData[$sFrom]['src'],
                        'dst' => $aFolderData[$sFrom]['dst'],
                        'hash' => empty($aFolderData[$sFrom]['hash']) ? $aFolderData[$sFrom]['hash'] : md5_file($sPluginFile),
                    );
                }
            }
        }
        return $this;
    }

    /**
     * calculates sequence for path to put as a staging-action
     * @param array $aFolderData
     * @param string $sIdentPath
     * @return array(action => string, data => array(for, action))
     * @throws Exception
     */
    protected function calcStagingSequence ($aFolderData, $sIdentPath) {
        $sStaging = $this->getPath('staging');
        $sType = (strpos($sIdentPath, '__/') === 0 ? '__external' : '__plugin');
        if (!isset($aFolderData['server']) && isset($aFolderData['staging'])) {
            //dont exists in server => delete
            $sAction = empty($aFolderData['staging']['hash']) ? 'rmdir' : 'rm';
            $aStaging = array('dst' => $sStaging.'/'.$sType.'/'.$aFolderData['staging']['src']);
        } elseif (
            isset($aFolderData['server'])
            && (!isset($aFolderData['staging']) || $aFolderData['server']['hash'] !== $aFolderData['staging']['hash'])
        ) {//create
            if (empty($aFolderData['server']['hash'])) {// mkdir
                $sAction = 'mkdir';
                $aStaging = array('dst' => $sStaging.'/'.$sType.'/'.$sIdentPath);
            } else {// cp
                $sAction ='cp';
                if (isset($aFolderData['plugin']) && $aFolderData['plugin']['hash'] === $aFolderData['server']['hash']) {
                    $sSrc = $this->getPath('plugin').$aFolderData['plugin']['dst'];//copy from plugin
                } else if ($this->blUseZip) {
                    //copy from zip
                    $sSrc = $this->getPath('server').$sType.'/'.$aFolderData['server']['src'];
                } else {
                    //copy from server
                    $sSrc =
                        $this->getPath('server').(
                        $sType == '__plugin'
                            ? ''
                            : '../shopspecific/'.MLShop::gi()->getShopSystemName().'/'
                        ).$aFolderData['server']['src']
                    ;
                }
                $aStaging = array(
                    'src' => $sSrc,
                    'dst' => $sStaging.'/'.$sType.'/'.$sIdentPath,
                );
            }
        } else {
            $sAction = '';
            $aStaging = array();
        }
        return array('data' => $aStaging, 'action' => $sAction);
    }

    /**
     * calculates sequence for path to put as a plugin
     * @param array $aFolderData
     * @param string $sIdentPath
     * @return array(action => string, data => array(for, action))
     * @throws Exception
     */
    protected function calcPluginSequence($aFolderData, $sIdentPath){
        $sPlugin = $this->getPath('plugin');
        if (!isset($aFolderData['server']) && isset($aFolderData['plugin'])) {//delete - can only come from staging
            $sAction = empty($aFolderData['plugin']['hash']) ? 'rmdir' : 'rm';
            $aPlugin = array('dst' => $sPlugin.str_replace('__.', '../',$aFolderData['plugin']['dst']));
        } elseif (
            isset($aFolderData['server'])
            && (
                !isset($aFolderData['plugin']) || (
                    $aFolderData['plugin']['hash'] !== 0 // if plugin hash === 0 we shouldn't compare hash, and we shouldn't create
                    && $aFolderData['server']['hash'] !== $aFolderData['plugin']['hash']
                )
            )
        ) {//create
            if (empty($aFolderData['server']['hash'])) {// mkdir
                $sAction = 'mkdir';
                $aPlugin = array('dst' => $sPlugin.str_replace('__.', '../',$aFolderData['server']['dst']));
            } else {// cp
                $sAction ='cp';
                $aPlugin = array(
                    'src' => $this->getPath('staging').(strpos($sIdentPath, '__/') === 0 ? '__external' : '__plugin').'/'.$sIdentPath,
                    'dst' => $sPlugin.str_replace('__.', '../',$aFolderData['server']['dst']),
                );
            }
        } else {
            $sAction ='';
            $aPlugin = array();
        }
        return array('data' => $aPlugin, 'action' => $sAction);
    }

    /**
     * calculates all necessary actions and meta data for update process
     *
     * @param bool $blZip
     * @return $this
     * @throws ML_Filesystem_Exception
     * @throws Exception
     */
    protected function prepareSequences ($blZip = true) {
        if (!MLCache::gi()->exists($this->sCacheName)) {
            $this->blUseZip = false;
            if ($blZip && class_exists('ZipArchive', false)) {
                try {
                    if (count(
                            MLHelper::getFilesystemInstance()
                                ->rm($this->getPath('zip'))
                                ->write($this->getPath('zip'))
                                ->readDir($this->getPath('zip').'/', array())
                        ) === 0
                    ) {
                        try {
                            $sBuild = MLSetting::gi()->get('sClientBuild');
                        } catch (Exception $ex) {
                            $sBuild = '';
                        }

                        $sExternalListParamAddition = '';
                        //shopware specific
                        if (method_exists(MLShop::gi(), 'isComposerInstallation') && MLShop::gi()->isComposerInstallation()) {
                            $sExternalListParamAddition = '&composer';
                        }

                        foreach (array(
                                     'files.list?format=zip&shopsystem='.MLShop::gi()->getShopSystemName().'&build='.$sBuild => '__plugin',
                                     'external.list?format=zip&shopsystem='.MLShop::gi()->getShopSystemName().'&build='.$sBuild.$sExternalListParamAddition => '__external'
                                 ) as $sRequest => $sType) {
                            MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(start: $sType = '.$sType.')' => __LINE__, '$sRequest' => $sRequest));
                            @set_time_limit(60 * 10); // 10 minutes
                            $sZipName = 'updater'.$sType.'.zip';
                            MLCache::gi()->delete($sZipName);
                            $warnings = null;
                            MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(start-zip: $sType = '.$sType.')' => __LINE__));
                            $sContent = MLHelper::gi('remote')->fileGetContents($this->getPath('server').$sRequest, $warnings, 20);
                            MLCache::gi()->set($sZipName, $sContent, 60);
                            $oZip = new ZipArchive();
                            $oZip->open(MLFilesystem::getCachePath('updater'.$sType.'.zip'));
                            @set_time_limit(60 * 10); // 10 minutes
                            $oZip->extractTo($this->getPath('zip').$sType);
                            $oZip->close();
                            if (count(MLHelper::getFilesystemInstance()->readDir($this->getPath('zip').'/'.$sType.'/', array())) < 1) {
                                throw new Exception('Problems with archive files.', 1462872613);
                            }
                            MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(end-zip: $sType = '.$sType.')' => __LINE__));
                            MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(end: $sType = '.$sType.')' => __LINE__, '$sRequest' => $sRequest));
                        }
                        @set_time_limit(60 * 10); // 10 minutes
                        MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(start: rm-__plugin-start)' => __LINE__));
                        $this->rm(array('dst' => $this->getPath('staging').'/__plugin/'));// in zip mode dont scan staging again - all data comes from zip
                        MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(end: rm-__plugin-start)' => __LINE__));
                        $this->blUseZip = true;
                    }
                } catch (Exception $oEx) {
                    //                    echo $oEx->getMessage();
                }
            }
            $aMerged = array();
            foreach(array('server', 'plugin', 'staging') as $sFolder ) {
                MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(start: $sFolder = '.$sFolder.')' => __LINE__));
                @set_time_limit(60 * 10); // 10 minutes
                if ($this->blUseZip == true && $sFolder === 'plugin') {// add customer and dev-module to staging, plugin dont have external files
                    foreach ($this->aCopyLocal2Staging as $sCopyLocal2Staging) {
                        $aPluginOrExternal = MLHelper::gi('remote')->getFileList(MLFilesystem::getLibPath($sCopyLocal2Staging));
                        foreach ($aPluginOrExternal['__plugin'] as $sFolderFileIdent => $aFolderFilesData) {
                            $aMerged[$sCopyLocal2Staging.$sFolderFileIdent]['plugin'] = array(
                                'src' => $sCopyLocal2Staging.$aFolderFilesData['src'],
                                'dst' => $sCopyLocal2Staging.$aFolderFilesData['dst'],
                                'hash' => $aFolderFilesData['hash'],
                            );
                        }
                        $aMerged[$sCopyLocal2Staging]['plugin'] = array(
                            'src' => $sCopyLocal2Staging,
                            'dst' => $sCopyLocal2Staging,
                            'hash' => 0,
                        );
                    }
                } else {
                    foreach (MLHelper::gi('remote')->getFileList($this->getPath($sFolder)) as $aPluginOrExternal) {
                        foreach ($aPluginOrExternal as $sIdentPath => $aData) {
                            if ($sIdentPath === '__/') { // path dont comes from server.lst, but path is part of plugin
                                continue;
                            }
                            $aMerged[$sIdentPath][$sFolder] = $aData;
                        }
                    }
                }
                MLLog::gi()->add('update', array('METHOD' => __METHOD__, 'LINE(end: $sFolder = '.$sFolder.')' => __LINE__));
            }
            foreach ($this->aCopyLocal2Staging as $sCopyLocal2Staging) {
                $aPluginOrExternal = MLHelper::gi('remote')->getFileList(MLFilesystem::getLibPath($sCopyLocal2Staging));
                foreach ($aPluginOrExternal['__plugin'] as $sFolderFileIdent => $aFolderFilesData) {
                    $aMerged[$sCopyLocal2Staging.$sFolderFileIdent]['server'] = array(
                        'src' => $sCopyLocal2Staging.$aFolderFilesData['src'],
                        'dst' => $sCopyLocal2Staging.$aFolderFilesData['dst'],
                        'hash' => $aFolderFilesData['hash'],
                    );
                }
                $aMerged[$sCopyLocal2Staging]['server'] = array(
                    'src' => $sCopyLocal2Staging,
                    'dst' => $sCopyLocal2Staging,
                    'hash' => 0,
                );
            }

            /* @var $aSequences array */
            $aSequences = array();

            //setting default actions
            foreach (array(
                         'staging', // (server||plugin) => staging
                         'plugin', // staging => plugin
                     ) as $sDstType) {
                $aSequences[$sDstType] = array(
                    '' => array(), // do nothing just statistic
                    'mkdir' => array(), // create folders before copy
                    'cp' => array(),
                    'rm' => array(),
                    'rmdir' => array(), // delete folders afer delete files
                );
            }
            foreach ($aMerged as  $sIdentPath => &$aFolderData) {

                // check ignore patterns
                foreach($this->aIgnorePatterns as $sPattern){
                    if(preg_match('/'.$sPattern.'/Uis', $sIdentPath)){
                        continue 2;
                    }
                }

                // fill plugin data dynamically, plugin dont know external files before
                $this->addPluginDataDynamically($aFolderData, $sIdentPath);

                // (plugin || server) => staging
                $aStaging = $this->calcStagingSequence($aFolderData, $sIdentPath);
                if ($this->blDebug) {
                    $aStaging['data']['data'] = $aFolderData;
                }
                $aSequences['staging'][$aStaging['action']][$sIdentPath] = $aStaging['data'];

                // now staging is equal to server
                if (isset($aFolderData['server'])) {
                    $aFolderData['staging'] = $aFolderData['server'];
                }

                // staging => plugin
                $aPlugin = $this->calcPluginSequence($aFolderData, $sIdentPath);
                if ($this->blDebug) {
                    $aPlugin['data']['data'] = $aFolderData;
                }
                $aSequences['plugin'][$aPlugin['action']][$sIdentPath] = $aPlugin['data'];
            }
            unset($aFolderData);// referenced foreach variable should be unset to prevent side effect
            //sorting
            foreach ($aSequences as $sSequence => $aSequence) {
                if (isset($aSequence['mkdir'])) { // create dirs ascending
                    ksort($aSequences[$sSequence]['mkdir']);
                }
                if (isset($aSequence['rmdir'])) { // delete dirs descending
                    krsort($aSequences[$sSequence]['rmdir']);
                }
            }
            foreach ($aSequences as $sSequence => $aSequence) {
                foreach ($aSequence as $sSequenceType => $aSequenceData) { // remote actions
                    if (!empty($sSequenceType)) {
                        foreach ($aSequenceData as $sActionIdent => $aActionData) {
                            if (strpos($sActionIdent, '__/') === 0) {
                                $this->aMeta['remoteActions'][$sSequence][$sActionIdent] = array($sSequenceType =>$aActionData);
                            }
                        }
                    }
                }
            }
            $this->aSequences = $aSequences;
        } elseif (empty($this->aSequences)) {// load cached
            $aCached = MLCache::gi()->get($this->sCacheName);
            $this->aSequences = $aCached['sequences'];
            $this->aMeta = $aCached['meta'];
        }
        if (empty($this->aSequences)) {
            MLCache::gi()->delete($this->sCacheName);
        } else {
            MLCache::gi()->set($this->sCacheName, array('sequences' => $this->aSequences, 'meta' => $this->aMeta), 10 * 60);
        }
        return $this;
    }

    /**
     * iterates a sequence
     * @param string $sSequence
     * @return bool
     * @throws ML_Core_Exception_Update
     * @throws ML_Filesystem_Exception
     * @throws Exception
     */
    protected function runSequence ($sSequence) {
        $this->setProgressBarPercent(0, 100, $sSequence === 'plugin' ? 'finalizeUpdate' : 'copyFilesToStaging');
        if ($sSequence === 'plugin') {
            $this->rmDir(array('dst' => $this->getPath('staging').'__swap'));
            $this->rename(array(
                'src' => $this->getPath('plugin'),
                'dst' => $this->getPath('staging').'__swap'
            ));
            try {
                $this->rename(array(
                    'src' => $this->getPath('staging').'__plugin',
                    'dst' => $this->getPath('plugin')
                ));
            } catch (Exception $oEx) {// rollback
                $this->rename(array(
                    'src' => $this->getPath('staging').'__swap',
                    'dst' => $this->getPath('plugin')
                ));
                throw $oEx;
            }
            $this->rename(array(
                'src' => $this->getPath('staging').'__swap',
                'dst' => $this->getPath('staging').'__plugin'
            ));
        }
        $aSequences = $this->aSequences[$sSequence];
        $iActionCountTotal = $this->getCount('total_'.$sSequence);
        $iRemoteActionCount = 0;
        $iActionCount = 0;
        foreach ($aSequences as $sAction => $aAction) {
            if (empty($sAction)) {
                $iActionCount += count($aAction);
            } else {
                foreach ($aAction as $sIdent => $aActionData) {
                    if ($sSequence !== 'plugin' || strpos($sIdent, '__/') === 0) {//plugin files are moved before
                        if (strpos($sIdent, '__/') === 0 && $sAction === 'rmdir') {//only remove empty dir for shopspecific files
                            $this->rmDir($aActionData, true);
                        } else {
                            $this->{$sAction}($aActionData);
                        }
                    }
                    ++$iActionCount;
                    //move action to done
                    $this->aSequences[$sSequence][''][$sIdent] = array();
                    unset($this->aSequences[$sSequence][$sAction][$sIdent]);
                    if ($sSequence === 'staging' && MLSetting::gi()->get('blDebug')
                        //&& isset($aActionData['src']) && preg_match('/http(s{0,1}):\/\//', $aActionData['src'])
                    ) {
                        $this->getProgressBarWidget()
                            ->addLog((isset($aActionData['src']) && preg_match('/http(s{0,1}):\/\//', $aActionData['src']) ? 'wget ' : $sAction).' ./'.$sIdent)
                            ->setBarInfo($iActionCount . ' / ' . $iActionCountTotal)
                        ;
                    }

                    $this->setProgressBarPercent($iActionCount, $iActionCountTotal, $sSequence === 'plugin' ? 'finalizeUpdate' : 'copyFilesToStaging');
                    if (
                        ($sAction === 'cp')
                        && (
                            $this->aFullUpdate['runSequence']
                            || preg_match('/http(s{0,1}):\/\//', $aActionData['src'])
                        )
                    ) {
                        ++$iRemoteActionCount;
                        if ($iRemoteActionCount > $this->iItemsPerRequest) {
                            $this->prepareSequences();//save
                            return false;//next
                        }
                    }
                }
            }
        }
        $this->prepareSequences();//save
        return true;
    }

    /**
     * check file permissions for all actions
     *
     * @return ML_Core_Controller_Do_Update
     * @throws Exception
     */
    protected function checkPermissions () {
        foreach ($this->aSequences as $sType => $aActions) {
            foreach ($aActions as $sAction => $aAction) {
                if (!empty($sAction)) {
                    foreach ($aAction as $sIdent => $aFile) {
                        if (!$this->isWriteable($aFile)) {
                            throw MLException::factory(
                                'update',
                                'File `{#path}` is not writable.',
                                1407759765
                            )->setData(array('path' => MLHelper::getFilesystemInstance()->getFullPath($aFile['dst'])));
                        }
                    }
                }
            }
        }
        return $this;
    }

    /**
     * redirecting for developers
     * @return ML_Core_Controller_Do_Update
     * @throws MLAbstract_Exception
     * @throws ML_Core_Exception_Update
     * @throws Exception
     */
    public function callAjaxSuccess () {
        $this->progressBar('success');
        MLMessage::gi()->addSuccess(
            (
            ML::isUpdate()
                ? MLI18n::gi()->get('ML_TEXT_UPDATE_SUCCESS', array('url'=>  MLHttp::gi()->getUrl(array('content'=>'changelog'))))
                : MLI18n::gi()->get('ML_TEXT_INSTALL_SUCCESS')
            ),
            array('md5' => 'newVersion'),
            false
        );

        $this->progressBar('success', true);
        MLHelper::getFilesystemInstance()->write(
            MLFilesystem::getLibPath('Update'),
            date('Y-m-d H:i:s').' '. MLHelper::gi('remote')->fileGetContents($this->getPath('plugin') . 'ClientVersion'),
            true
        );
        return $this;
    }

    /**
     * @return ML_Core_Controller_Abstract|ML_Core_Controller_Widget_ProgressBar
     */
    protected function getProgressBarWidget(){
        return MLController::gi('widget_progressbar');
    }

    /**
     * method will be triggered via reload after file-update
     * here can some immigration be done (eg. db-data-changes)
     * @return ML_Core_Controller_Do_Update
     * @throws MLAbstract_Exception
     */
    public function callAjaxAfterUpdate () {
        $this->progressBar('afterUpdate');
        try {
            $iStartTime = microtime(true);
            $aUpdateClasses = MLFilesystem::gi()->getClassCollection('/^update_.*$/', false);
            $iTotal = count($aUpdateClasses);
            $aParams = MLRequest::gi()->data();
            unset($aParams['do'], $aParams['method'], $aParams['ajax'], $aParams['unique']);
            $this->getProgressBarWidget()
                ->addLog('Parameters: <span style="color:silver;">'.  json_encode($aParams).'</span>')
            ;
            $iDone = MLRequest::gi()->data('done');
            $iDone = is_numeric($iDone) ? $iDone : 0;
            $iCurrent = 0;
            $this->setProgressBarPercent($iDone, $iTotal, 'afterUpdate');
            $aUpdateClassParameters = array('done' => $iDone);
            foreach ($aUpdateClasses as $sUpdateClassKey => $aUpdateClassValue) {
                ++$iCurrent;
                if ($iCurrent > $iDone) {
                    $iUpdateClassTime = microtime(true);
                    $aUpdateClass = current($aUpdateClassValue);
                    $sLog = 'Ident <span style="color:#32CD32;" title="'.'./'.substr($aUpdateClass['path'], strlen(MLFilesystem::getLibPath())).'">'.$sUpdateClassKey.'</span> ';
                    try {
                        require_once $aUpdateClass['path'];
                        $oReflection = new ReflectionClass($aUpdateClass['class']);
                        if (
                            !$oReflection->isSubclassOf('ML_Core_Update_Abstract')
                            || $oReflection->isAbstract()
                            || $oReflection->isInterface()
                        ) {
                            $aUpdateClassParameters = array('done' => $iCurrent);
                            $sLog .= 'skipped (no concrete update class)';
                        } else {
                            $this->oCurrentAfterUpdateClass = new $aUpdateClass['class'];
                            if($this->oCurrentAfterUpdateClass->getProgress() < 100){
                                -- $iCurrent;
                                $iCurrent += ($this->oCurrentAfterUpdateClass->getProgress() / 100);
                            }
                            /* @var $oUpdateClass ML_Core_Update_Abstract */
                            if ($this->oCurrentAfterUpdateClass->needExecution()) {
                                $this->oCurrentAfterUpdateClass->execute();
                                $sLog .= 'executed in <span style="color:#6495ED;">'.  microtime2human(microtime(true)-$iUpdateClassTime).'</span>.';
                                $aParameters = $this->oCurrentAfterUpdateClass->getParameters();
                                if (is_array($aParameters) && !empty($aParameters)) {
                                    $aUpdateClassParameters = array_merge($aUpdateClassParameters, $aParameters);
                                    $this->getProgressBarWidget()->addLog($sLog);
                                    break;
                                } else {
                                    $aUpdateClassParameters = array('done' => $iCurrent);
                                }
                            } else {
                                $aUpdateClassParameters = array('done' => $iCurrent);
                                $sLog .= 'skipped (don\'t need execution)';
                            }
                            if($this->oCurrentAfterUpdateClass !== null) {// add url parameter of specific update script
                                foreach ($this->oCurrentAfterUpdateClass->getUrlExtraParameters() as $sKey => $aValue) {
                                    $aUpdateClassParameters[$sKey] = $aValue;
                                }
                            }
                        }
                        $this->getProgressBarWidget()->addLog($sLog);
                    } catch (Exception $oEx) {
                        $this->getProgressBarWidget()
                            ->addLog($sLog.'threw Exception with the message "<span style="color: #FF0000">'.$oEx->getMessage().'</span>" after <span style="color:#6495ED;">'. microtime2human(microtime(true)-$iUpdateClassTime).'</span>.')
                            ->addLog('
                                <span>
                                    <a class="global-ajax" data-ml-global-ajax=\'{"triggerAfterSuccess":"currentUrl"}\' onclick="jqml(this).siblings().remove();" style="color:gray;font-size:inherit;" href="'.$this->getCurrentUrl(array('method'=>'afterUpdate', 'done'=>$iCurrent - 1)).'">Again</a>
                                    <span> or </span>
                                    <a class="global-ajax" data-ml-global-ajax=\'{"triggerAfterSuccess":"currentUrl"}\' onclick="jqml(this).siblings().remove();" style="color:gray;font-size:inherit;" href="'.$this->getCurrentUrl(array('method'=>'afterUpdate', 'done'=>$iCurrent)).'">Skip current class.</a>
                                </span>
                            ')
                            ->setContent(MLI18n::gi()->get('sUpdateError_doAgain', array(
                                'link' => $this->getCurrentUrl(array('method'=>'afterUpdate')
                                ))))
                        ;
                        throw new $oEx;
                    }
                    if ($iStartTime + 10 >= microtime(true)) {
                        $this->progressBar('afterUpdate', false);
                        break;
                    }
                    $this->setProgressBarPercent($iCurrent, $iTotal, 'afterUpdate');
                }
            }
            if ($iCurrent >= $iTotal) {
                if (MLSetting::gi()->blHideUpdate !== true) {
                    MLHelper::getFilesystemInstance()->write(
                        $this->getPath('plugin').'ClientVersion', MLHelper::gi('remote')->fileGetContents($this->getPath('clientversion'))
                    );
                }
                //                MLMessage::gi()->addSuccess(
                //                    MLI18n::gi()->get('ML_TEXT_UPDATE_SUCCESS', array('url'=>  MLHttp::gi()->getUrl(array('content'=>'changelog'))))
                //                );
                MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'after-update')->set('value', true)->save();
                $this->progressBar('afterUpdate', true);
            } else {
                $this->progressBar('afterUpdate', $aUpdateClassParameters);
            }
        } catch (Exception $oEx) {
            $this->progressBar('afterUpdate', $oEx);
        }
        return $this;
    }

    /**
     *
     * @param $fW float current value
     * @param $fG float max value
     * @param $sStep string (init, calcSequences, copyFiles, finalizeUpdate, afterUpdate)
     * @return ML_Core_Controller_Do_Update
     */
    protected function setProgressBarPercent ($fW, $fG, $sStep) {
        $fG = empty($fG) ? (float)100 : $fG;
        $fWeightCurrent = 0;
        if (array_key_exists($sStep, $this->aProgressBar)) {
            $fWeightingTotal = $fWeightingPrevious = 0;
            foreach ($this->aProgressBar as $sConfigStep => $aConfigStep) {
                if ($sStep === $sConfigStep) {
                    $fWeightingPrevious = $fWeightCurrent = $fWeightingTotal;
                    $fWeightCurrent += $aConfigStep['weighting'];
                }
                $fWeightingTotal += $aConfigStep['weighting'];
            }
        } else {
            $fWeightingPrevious = 0;
            $fWeightCurrent = $fWeightingTotal = 100;
        }
        $this->getProgressBarWidget()
            ->setTotal($fWeightingTotal)
            ->setDone(
                $fWeightingPrevious + ( ($fWeightCurrent - $fWeightingPrevious) / 100 * ($fW / $fG)) * 100
            )
        ;
        return $this;
    }

    /**
     *
     * @param string $sCurrentStep
     * @param mixed $mFinalize | null: no render, true: render 100%, false:
     * @return ML_Core_Controller_Do_Update
     * @throws MLAbstract_Exception
     * @throws Exception
     */
    public function progressBar ($sCurrentStep, $mFinalize = null) {
        $this->getProgressBarWidget()->setId('updatePlugin')->setContent('');
        $blStepFound = false;
        $sNextStep = '';
        foreach (array_keys($this->aProgressBar) as $sConfigStep) {
            if ($blStepFound) {
                $sNextStep = $sConfigStep;
                break;
            } elseif ($sCurrentStep === $sConfigStep) {
                if(isset($this->oCurrentAfterUpdateClass) && $this->oCurrentAfterUpdateClass->getInfo() !== '') {
                    $this->getProgressBarWidget()->setContent($this->oCurrentAfterUpdateClass->getInfo());
                } else {
                    $this->getProgressBarWidget()->setContent(
                        MLI18n::gi()->get(sprintf('sModal_%sPlugin_content_%s', ML::isUpdate() ? 'update' : 'install', $sCurrentStep))
                    );
                }
                $blStepFound = true;
            }
        }
        if ($mFinalize === true && empty($sNextStep)) {
            $this->setProgressBarPercent(100, 100, $sCurrentStep);
            MLSetting::gi()->add('aAjax', array('success' => true));
            $this->getProgressBarWidget()->render();
        } elseif ($mFinalize === true) {
            if (MLSetting::gi()->get('blDebug')) {// remove automatically redirect, show sequence
                MLSetting::gi()->set('aAjax', array(), true);
                $this->getProgressBarWidget()->addLog('<a style="color:gray;" onclick="jqml(this).html(\'\');return true;" class="global-ajax" data-ml-global-ajax=\'{"triggerAfterSuccess":"currentUrl"}\' href="'.$this->getCurrentUrl(array('method'=>$sNextStep)).'">Click here for next step ('.$sNextStep.').</a>');
            } else {
                MLSetting::gi()->add('aAjax', array('Next' => MLHttp::gi()->getUrl(array('do' => 'update', 'method' => $sNextStep))));
            }
            $this->setProgressBarPercent(100, 100, $sCurrentStep);
            $this->getProgressBarWidget()->render();
        } elseif ($mFinalize === false || is_array($mFinalize)) {
            $aUrl = is_array($mFinalize) ? $mFinalize : array();
            $aUrl['do'] = 'update';
            $aUrl['method'] = $sCurrentStep;
            MLSetting::gi()->add('aAjax', array('Next' => MLHttp::gi()->getUrl($aUrl)));

            $this->getProgressBarWidget()->render();
        } elseif($mFinalize instanceof Exception) {
            if ($mFinalize instanceof ML_Core_Exception_Update) {
                MLMessage::gi()->addError($mFinalize->getTranslation());
            }
            $aAjax = MLSetting::gi()->get('aAjax');
            unset($aAjax['Redirect'], $aAjax['Next']);
            MLSetting::gi()->set('aAjax', $aAjax, true);

            $this->getProgressBarWidget()
                ->setContent(MLI18n::gi()->get('sUpdateError_doAgain', array('link' => $this->getCurrentUrl(array('method'=>'init')))))
                ->addLog('<span style="color:#e31a1c;">An error has occurred<br />&nbsp;&nbsp;&nbsp;&nbsp;Message: '.$mFinalize->getMessage().'<br />&nbsp;&nbsp;&nbsp;&nbsp;Code: '.$mFinalize->getCode().'</span>')
            ;
            $this->getProgressBarWidget()->render();
        } else {
            if (MLSetting::gi()->get('blDebug')) {
                $this->getProgressBarWidget()->addLog('# currentStep: '.$sCurrentStep);
            }
            $this->setProgressBarPercent(0, 100, $sCurrentStep);
        }
        return $this;
    }

    /**
     * creates index.php foreach folder
     * @return $this
     * @throws MLAbstract_Exception
     */
    public function callAjaxAddIndexPhp () {
        $this->progressBar('addIndexPhp');
        try {
            $this->getProgressBarWidget()->addLog('# '.$this->addIndexPhp()." index.php files created.\n");
            $this->progressBar('addIndexPhp', true);
        } catch (Exception $oEx) {
            $this->progressBar('addIndexPhp', $oEx);
        }
        return $this;
    }

    /**
     * creates index.php to avoid directory listing
     * @param string $sCurrentFolder /path/to/folder
     * @return int count of created index.php
     * @throws ML_Core_Exception_Update
     * @throws Exception
     */
    public function addIndexPhp ($sCurrentFolder = null) {
        $iCount = 0;
        if ($sCurrentFolder === null) {
            $sCurrentFolder = $this->getPath('staging').'/__plugin';
        }
        if (!file_exists($sCurrentFolder.'/index.php')) {
            $iCount ++;
            MLHelper::getFilesystemInstance()->write(
                $sCurrentFolder.'/index.php',
                "<?php\n" .
                "header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');\n".
                "header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');\n" .
                "header('Cache-Control: no-store, no-cache, must-revalidate');\n" .
                "header('Cache-Control: post-check=0, pre-check=0', false);\n" .
                "header('Pragma: no-cache');\n" .
                "header('Location: ../');"
            );
        }
        foreach (MLFilesystem::gi()->glob($sCurrentFolder.'/*', GLOB_ONLYDIR) as $sSubFolder) {
            $iCount += $this->addIndexPhp($sSubFolder);
        }
        return $iCount;
    }

    /**
     * just a dummy to show some percents to give feeling that something happen
     * @return ML_Core_Controller_Do_Update
     * @throws MLAbstract_Exception
     */
    public function callAjaxInit () {
        $this->progressBar('init');
        $this->progressBar('init', true);
        return $this;
    }


    /**
     * just a dummy to show some percents to give feeling that something happen
     * @return ML_Core_Controller_Do_Update
     * @throws MLAbstract_Exception
     * @deprecated for compatiblility with old installer
     */
    public function callAjaxUpdate () {
        return $this->callAjaxInit();
    }

    /**
     * just a dummy for afterupdate
     * @deprecated old community-marketplace-installer will use it
     * @throws MLAbstract_Exception
     */
    //    public function callAjaxUpdate () {
    //        return $this->callAjaxAfterUpdate();
    //    }
    //
    public function callAjaxCalcSequences () {
        $this->progressBar('calcSequences');
        try {
            if (MLCache::gi()->exists($this->sCacheName)) {
                MLCache::gi()->delete($this->sCacheName);
            }
            if ($this->aFullUpdate['removeStagingArea']) {
                MLHelper::getFilesystemInstance()->rm($this->getPath('staging'));
            }
            $this->getProgressBarWidget()
                ->addLog('# Plugin-Path: '.$this->getPath('plugin'))
                ->addLog('# Staging-Path: '.$this->getPath('staging'))
                ->addLog('# Remote-Path: '.$this->getPath('server'))
            ;
            $this->checkStagingFolder();
            $aSequences = $this->prepareSequences()->aSequences;
            if ($this->blUseZip) {
                $this->getProgressBarWidget()
                    ->addLog('# Remote-Path changed: '.$this->getPath('server'))
                ;
            }
            if (MLSetting::gi()->get('blDebug')) {// remove autom. redirect, show sequenzes
                MLMessage::gi()->addDebug('Update-Sequences', $aSequences);
                $this->getProgressBarWidget()->addLog('# Sequences are calculated, see debug-bar for more info.');
            }
            $this->progressBar('calcSequences', true);
        } catch (Exception $oEx) {
            $this->progressBar('calcSequences', $oEx);
        }
        return $this;
    }

    /**
     * @return $this
     * @throws MLAbstract_Exception
     */
    public function callAjaxCopyFilesToStaging () {
        $this->progressBar('copyFilesToStaging');
        try {
            if (!MLCache::gi()->exists($this->sCacheName)) {
                throw new Exception('Sequences are not calculated.', 1463140297);
            }
            $aSequences = $this->prepareSequences()->aSequences;
            $this
                ->checkFilesCount()
                ->checkPermissions()
            ;
            if ($this->getCount('action_staging') !== 0) {
                $this->progressBar('copyFilesToStaging', $this->runSequence('staging'));
            } else {
                $this->progressBar('copyFilesToStaging', true);
            }
        } catch (Exception $oEx) {
            $this->progressBar('copyFilesToStaging', $oEx);
        }
        return $this;
    }

    /**
     * @return $this
     * @throws MLAbstract_Exception
     */
    public function callAjaxFinalizeUpdate () {

        $this->progressBar('finalizeUpdate');
        try {
            if (!MLCache::gi()->exists($this->sCacheName)) {
                throw new Exception('Sequences are not calculated.', 1463140297);
            }
            $this->prepareSequences()->aSequences;
            $this
                ->checkFilesCount()
                ->checkPermissions()
            ;
            if ($this->getCount('action_staging') !== 0) {
                throw new Exception('CopyFilesToStaging is not executed completely.', 1463141192);
            }
            if ($this->getCount('action_plugin')) {
                $this->runSequence('plugin');
            }
            MLCache::gi()->flush();
            $this->getProgressBarWidget()->addLog('Check Updated Files.');
            foreach ($this->prepareSequences(false)->aSequences['plugin'] as $sCheckSequenceType => $aCheckSequenceType) {
                if ($sCheckSequenceType != '' && count($aCheckSequenceType) != 0 ) {
                    MLMessage::gi()->addDebug($sCheckSequenceType.' actions', $aCheckSequenceType);
                    throw new Exception('In '.$sCheckSequenceType.' are '.count($aCheckSequenceType).' files not correct, see debug-bar for more info.', 1463141571);
                }
            }
            MLSession::gi()->delete('runOncePerSession');
            if ($this->blDebug) {
                MLSetting::gi()->add('aAjax', array(
                    'debug-updater' => array(
                        'paths' => array(
                            'server' => $this->getPath('server'),
                            'plugin' => $this->getPath('plugin'),
                            'staging' => $this->getPath('staging'),
                        ),
                        'meta' => $this->aMeta,
                        'remoteActions' => $this->getCount('remote_plugin')
                    )
                ));
            }
            MLShop::gi()->triggerAfterUpdate($this->getCount('remote_plugin') > 0);
            try {
                MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'after-update')->delete();
            } catch (Exception $oEx) {
                // database is not part of installer
            }
            $this->progressBar('finalizeUpdate', true);
        } catch (Exception $oEx) {
            $this->progressBar('finalizeUpdate', $oEx);
        }
        return $this;
    }


    /**
     * Checks if the count of files incl. folders after update is over $this->iMinItems.
     * @return ML_Core_Controller_Do_Update
     * @throws MLAbstract_Exception
     * @throws Exception
     * @throws ML_Core_Exception_Update
     */
    protected function checkFilesCount() {
        $iCount = $this->getCount('final');
        if ($iCount < $this->iMinItems) {
            if (MLSetting::gi()->get('blDebug')) {
                MLI18n::gi()->set('sModal_updatePlugin_barInfo', '0 / '. $iCount, true);
                $this->getProgressBarWidget()->addLog('Error. Not enough files for update.');
            }
            $iActionCountTotal = $this->getCount('action_plugin');
            MLSetting::gi()->add('aAjax', array('Done' => 0));
            MLSetting::gi()->add('aAjax', array('Total' => $iActionCountTotal));
            throw MLException::factory(
                'update',
                'Insufficient file count ({#currentFileCount#} needed {#minFileCount#}).',
                1407753851
            )->setData(array('currentFileCount' => $iActionCountTotal, 'minFileCount' => $this->iMinItems));
        } else {
            return $this;
        }
    }

    /**
     * @param $aFile
     * @return $this
     * @throws ML_Core_Exception_Update
     */
    protected function rename($aFile) {
        MLHelper::getFilesystemInstance()->mv($aFile['src'], $aFile['dst']);
        return $this;
    }


    /**
     * delete directory in filesystem
     * checks if there are files existing because with external can be
     * @param array $aFile
     * @param bool $blOnlyEmptyFolders
     * @return ML_Core_Controller_Do_Update
     * @throws ML_Core_Exception_Update
     */
    protected function rmDir ($aFile, $blOnlyEmptyFolders = false) {
        if (!is_array($aFile) || !isset($aFile['dst'])) {
            throw MLException::factory(
                'update',
                'Wrong Parameter for {#method#}.',
                1407833718
            )->setData(array('method' => __METHOD__));
        }
        if ($blOnlyEmptyFolders && count(MLFilesystem::glob($aFile['dst'].'/*')) > 0) {
            return $this;
        }
        MLHelper::getFilesystemInstance()->rm($aFile['dst']);
        return $this;
    }

    /**
     * copy a file in filesystem
     * @param $aFile
     * @return ML_Core_Controller_Do_Update
     * @throws ML_Core_Exception_Update
     */
    protected function cp ($aFile) {
        if (!isset($aFile['dst'], $aFile['src']) || !is_array($aFile)) {
            throw MLException::factory(
                'update',
                'Wrong parameter for {#method#}.',
                1407833718
            )->setData(array('method' => __METHOD__));
        }
        $sSrc = $aFile['src'];
        $sDst = $aFile['dst'];
        if (!file_exists(dirname($sDst))) {
            $this->mkdir(array('dst' => dirname($sDst)));
        }
        if (strpos($sSrc, 'http') === 0) {
            MLHelper::getFilesystemInstance()->write($sDst, MLHelper::gi('remote')->fileGetContents($sSrc));
        } else {
            MLHelper::getFilesystemInstance()->cp($sSrc, $sDst);
        }
        return $this;
    }

    /**
     * delete a file in filesystem
     * @param $aFile
     * @return ML_Core_Controller_Do_Update
     * @throws ML_Core_Exception_Update
     */
    protected function rm($aFile) {
        if (!is_array($aFile) || !isset($aFile['dst'])) {
            throw MLException::factory(
                'update',
                'Wrong parameter for {#method#}.',
                1407833718
            )->setData(array('method' => __METHOD__));
        }
        MLHelper::getFilesystemInstance()->rm($aFile['dst']);
        return $this;
    }

    /**
     * creates a directory in filesystem
     * @param $aFile
     * @return ML_Core_Controller_Do_Update
     * @throws ML_Core_Exception_Update
     */
    protected function mkdir($aFile) {
        if (!is_array($aFile) || !isset($aFile['dst'])) {
            throw MLException::factory(
                'update',
                'Wrong Parameter for {#method#}.',
                1407833718
            )->setData(array('method' => __METHOD__));
        }
        MLHelper::getFilesystemInstance()->write($aFile['dst']);
        return $this;
    }

    /**
     * checks if a path is writeable
     * @param $aFile
     * @return boolean
     * @throws ML_Core_Exception_Update
     */
    protected function isWriteable($aFile) {
        if (!is_array($aFile) || !isset($aFile['dst'])) {
            throw MLException::factory(
                'update',
                'Wrong Parameter for {#method#}.',
                1407833718
            )->setData(array('method' => __METHOD__));
        }
        return MLHelper::getFilesystemInstance()->isWritable($aFile['dst']);
    }

}
