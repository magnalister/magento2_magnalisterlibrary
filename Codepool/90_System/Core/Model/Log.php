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
 * class for logging
 */
class ML_Core_Model_Log {
    
    /**
     * add a new line to logfile
     * creates zip-file of old log if log goes to big
     * 
     * @param string $sType name of file
     * @param array $aData if key display isset add to cached-log
     * @return $this
     */
    public function add($sType, $aData){
        if(is_array($aData) && isset($aData['display'])){// addLogToCache --- blue box for blDebug
            MLCache::gi()->set(
                strtoupper(get_class($this)).'__'.$sType.'_'.md5(json_encode($aData)).'.json', 
                $aData['display'],
                MLSetting::gi()->get('iDisplayLogLifeTime')
            );
        }
        $blLog = false;
        foreach (MLSetting::gi()->get('aLogPatterns') as $sPattern){
            if (preg_match($sPattern, $sType)) {
                $blLog = true;
            }
        }
        if (!$blLog) {
            return $this;
        }
        $sLogPath=  MLFilesystem::getLogPath($sType.'.log');
        if (!file_exists(dirname($sLogPath))) {
            @mkdir(dirname($sLogPath), 0777, true);
        }
        if (file_exists($sLogPath) && filesize($sLogPath) > (50 * 1024 * 1024)) {
            $sDir = dirname($sLogPath);
            if (!file_exists($sDir . '/old')) {
                @mkdir($sDir.'/old', 0777, true);
            }
            $sBackupPath = MLFilesystem::getLogPath('old/'.$sType.'_%s.log.gz');
            if (function_exists('gzopen')) {
                foreach (MLFilesystem::gi()->glob(sprintf($sBackupPath, '*')) as $sBackupFile) {
                    if (time()-filemtime($sBackupFile) > 60*60*24*14){ //14 days, modifiedtime for remote filesystems (see touch)
                        unlink($sBackupFile);
                    }
                }
                $rLog = fopen($sLogPath, 'r');
                $sFirstLine = fgets($rLog);
                $sStartDate = substr($sFirstLine, 0, 20);
                $sBackupFile = sprintf($sBackupPath, str_replace(array(' ', ':'),array('.', '.'),$sStartDate).'_'.date('Y-m-d.H.i.s'));
                $rBackup = gzopen($sBackupFile, 'wb9');
                gzwrite($rBackup, $sFirstLine);
                while (($sLine = fgets($rLog)) !== false) {
                    gzwrite($rBackup, $sLine);  
                }                              
                fclose($rLog);
                gzclose($rBackup);
                touch($sBackupFile, time());
                unlink($sLogPath);
            } else {
                rename($sLogPath, $sBackupPath);
            }
        }
        $r = fopen($sLogPath, 'a+');
        fwrite($r, date('Y-m-d H:i:s ').'(Build: '.MLSetting::gi()->sClientBuild.') '.MLHelper::getEncoderInstance()->encode($aData)."\n");
        fclose($r);
        return $this;
    }
    
    /**
     * gets list of cached log data
     * 
     * @param string $sType
     * @return array
     */
    public function getAllCached($sType = ''){
        $aOut=array();
        foreach(MLFilesystem::gi()->glob(MLFilesystem::getCachePath(strtoupper(get_class($this))."__$sType*.json")) as $sPath){
            $sName=  basename($sPath);
            $sType=  substr($sName, strpos($sName, '__')+2, -38);
            try{
                $aOut[$sType][]= array(
                    'name' => $sName,
                    'time' => filectime($sPath),
                    'data' => MLCache::gi()->get($sName),
                );
            }catch(Exception $oEx){//to old
            }
        }
        foreach($aOut as $sType=>$aValues){
            $aTime=array();
            foreach($aValues as $aValue){
                $aTime[]=$aValue['time'];
            }
            array_multisort($aTime, SORT_DESC, $aOut[$sType]);
        }
        return $aOut;
    }
    
    /**
     * render log-view_widget_log (cached data)
     * 
     * @return $this
     */
    public function render(){
        if(MLSetting::gi()->get('blDebug')){
            include MLFilesystem::gi()->getViewPath('widget_log');
        }
        return $this;
    }
    
    /**
     * delete log
     * 
     * @param string $sType filename
     */
    public function deleteFile($sType){
        $sLogPath=MLFilesystem::getLogPath($sType.'.log');
        if(file_exists($sLogPath)){
            unlink($sLogPath);
        }
    }
    
    /**
     * get log-data from file
     * 
     * @param string $sType
     * @param bool $blDelete
     * @return array
     */
    public function getFile($sType , $blDelete = true){
        $sLogPath=MLFilesystem::getLogPath($sType.'.log');
        if(file_exists($sLogPath)){
            $aContent =  file($sLogPath);
            if($aContent !== false){
                if ($blDelete) {
                    $this->deleteFile($sType);
                }
                return $aContent;
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
    
    /**
     * writes zip-file of selected log
     * 
     * @param string $sType
     * @return string
     */
    public function getZip($sType){
        $sLogPath=MLFilesystem::getLogPath($sType.'.log');
        $sBackupPath = MLFilesystem::getLogPath($sType.'_%s.log.gz');
        $rLog = fopen($sLogPath, 'r');
        $sFirstLine = fgets($rLog);
        $sStartDate = substr($sFirstLine, 0, 20);
        $sBackupFile = sprintf($sBackupPath, str_replace(array(' ', ':'),array('.', '.'),$sStartDate).'_'.date('Y-m-d.H.i.s'));
        $rBackup = gzopen($sBackupFile, 'wb9');
        gzwrite($rBackup, $sFirstLine);
        while (($sLine = fgets($rLog)) !== false) {
            gzwrite($rBackup, $sLine);  
        }                              
        fclose($rLog);
        gzclose($rBackup);
        touch($sBackupFile, time());
        return $sBackupFile;
    }
}
