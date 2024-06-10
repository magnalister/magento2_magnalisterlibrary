<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Sql extends ML_Core_Controller_Abstract {
    protected $aParameters=array('controller');
    protected $aResult=array();
    protected $sError='';
    protected $aPredefinedQuerys=array();
    
    public function __construct() {
        if (!self::getTabVisibility()) {
            MLHttp::gi()->redirect(array());
        } else {
            parent::__construct();
        }
    }
    
    public static function getTabVisibility () {
        try {
            $blShow = MLSetting::gi()->get('blDev');
        } catch (MLSetting_Exception $oEx) {//not setted
            $blShow = false;
        }
        return $blShow;
    }
    protected function getPredefinedQuerys(){
        $sQuery=MLRequest::gi()->SQL;
        $this->executeQuery();
        $aQuerys=MLSetting::gi()->get('aPredefinedQuerys');
        if(MLSession::gi()->get('aPredefinedQuerys')!==null){
            $aCachedQuerys=  MLSession::gi()->get('aPredefinedQuerys');
        }else{
            $aCachedQuerys=array();
        }
        if(
                $sQuery!==null
                &&
                $this->getError()==''
                &&
                !in_array($sQuery,$aQuerys)
                &&
                !in_array($sQuery,$aCachedQuerys)
        ){
            $sName=preg_replace('/\r\n|\r|\n/m',' ',$sQuery);
            $sName=preg_replace('/\s{2,}/m',' ',$sName);
            $sName=htmlentities($sName);
            $aCachedQuerys['<dl><dt>'.date(MLI18n::gi()->get('sDateTimeFormat')).':</dt><dd>'.$sName.'</dd></dl>'] = $sQuery;
            MLSession::gi()->set('aPredefinedQuerys', $aCachedQuerys);
        }
        $aOut=array();
        foreach(array_merge($aQuerys,$aCachedQuerys) as $sName=>$sCurrentQuery){
            $aOut[]=array(
                'active'=>$sCurrentQuery==$sQuery,
                'data-sql'=>urlencode($sCurrentQuery),
                'title'=>strip_tags($sName),
                'name'=>$sName
            );
        }
        return $aOut;
    }
    /**
     * @return array
     */
    protected function getResult(){
        return $this->executeQuery()->aResult;
    }
    protected function getError(){
        return $this->executeQuery()->sError;
    }

    protected function executeQuery() {
        if (
            count($this->aResult) === 0
            &&
            $this->sError === ''
            &&
            MLRequest::gi()->SQL !== null
        ) {
            try {
                $rQuery = MLDatabase::getDbInstance()->query(MLRequest::gi()->SQL);
                if ($rQuery === true) {
                    $this->aResult = array(array('Affected Rows' => MLDatabase::getDbInstance()->affectedRows()));
                } else {
                    $this->aResult = MLDatabase::getDbInstance()->fetchArray($rQuery);
                    if (!is_array($this->aResult)) {
                        $this->aResult = array();
                    }
                }
            } catch (Exception $oEx) {
                $this->sError = $oEx->getMessage();
            }
        }
        return $this;
    }

}