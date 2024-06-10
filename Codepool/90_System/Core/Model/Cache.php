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
 * A generic cache class that is using drivers to access various cache systems.
 */
class ML_Core_Model_Cache {

    /** @var ML_Core_Model_Cache_Abstract  $oCacheClass  */
    protected $oCacheClass = null;
    protected $aRequestCached = array();
    
    /**
     * Creates an instance of this class.
     * @return self
     */
    public function __construct() {
        $this->setDriver(); //Memcache Fs Apc Xcache, this is default type of cach it could be set in config table then get the default from config
    }

    /**
     * Set a driver class by the class name.
     * @param string $sClassName
     * @return self;
     */
    protected function setDriver($sClassName = '') {
        $aClasses = ML::gi()->getChildClassesNames('model_cache', false);
        if (!in_array($sClassName, $aClasses)) {
            $sClassName = current($aClasses);
        }
        $sClass = MLFilesystem::gi()->loadClass("model_cache_" . $sClassName);
        $this->oCacheClass = new $sClass;
        return $this;
    }
    
    protected function useCache ($sKey) {
        return 
            MLSetting::gi()->get('blUseCache') // default behavior
            || preg_match('/^ML_CORE_MODEL_SESSION__.*\.json/', $sKey) // variables from session
            || MLHttp::gi()->isAjax() // use cache in ajax. some sequenzes are cached like updater or marketplace-status-filter
        ;
    }

    /**
     * Get a value from the cache using a cache id.
     * @param string $sId
     * @return mixed
     * @throws ML_Filesystem_Exception
     *    In case the cache is disabled.
     */
    public function get($sId) {
        if ($this->useCache($sId)) {
             return MLHelper::getEncoderInstance()->decode($this->oCacheClass->get($sId));
        } else {
            if (isset($this->aRequestCached[$sId])) {
                return $this->aRequestCached[$sId];
            } else {
                throw new ML_Filesystem_Exception('Cache is deactivated');
            }
        }
    }

    /**
     * Set a cache value.
     * @param string $sId
     *    Cache id
     * @param mixed $mValue
     *    Value that will be cached
     * @param int $iLifeTime
     *    Life time in seconds
     * @return self
     */
    public function set($sId, $mValue, $iLifeTime = 0) {
        $sValue = MLHelper::getEncoderInstance()->encode($mValue);
        $this->oCacheClass->set($sId, $sValue, $iLifeTime);
        $this->aRequestCached[$sId] = $mValue;
        return $this;
    }

    /**
     * Checks if a cache id exists.
     * @param string $sKey
     * @return bool
     */
    public function exists($sKey) {
        if ($this->useCache($sKey)) {
            return $this->oCacheClass->exists($sKey);
        } else {
            return isset($this->aRequestCached[$sKey]);
        }
    }

    /**
     * Get Information about expiration
     *
     * @param string $sKey
     * @return array
     */
    public function getInfo($sKey) {
        return $this->oCacheClass->getInfo($sKey);
    }

    /**
     * Flushes the cache.
     *
     * @param string $pattern
     */
    public function flush($pattern = '*') {
        $this->oCacheClass->flush($pattern);

        if (get_class(MLShop::gi()->getCacheObject()) !== get_class($this)) {
            MLShop::gi()->getCacheObject()->flush();
        }
        $this->aRequestCached = array();
    }
    
    /**
     * Get a list of all cached cache ids.
     * @return array
     */
    public function getList() {
        return $this->oCacheClass->getList();
    }

    /**
     * Delete a cache id from the cache.
     * @param string $sKey
     * return object
     *    instance of the cache driver class
     */
    public function delete($sKey) {
        unset($this->aRequestCached[$sKey]);
        return $this->oCacheClass->delete($sKey);
    }

}
