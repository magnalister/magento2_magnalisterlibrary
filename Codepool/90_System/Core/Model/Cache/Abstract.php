<?php
/**
 * Defines an interface for a cache driver class.
 */
abstract class ML_Core_Model_Cache_Abstract {
    /**
     * Get a value from the cache using a cache id.
     * @param string $sKey
     * @return mixed
     */
    abstract public function get($sKey);
    
    /**
     * Set a cache value.
     * @param string $sKey
     *    Cache id
     * @param mixed $mValue
     *    Value that will be cached
     * @param int $iLifeTime
     *    Life time in seconds
     * @return ML_Magnalister_Model_Cache_Abstract
     */
    abstract public function set($sKey, $mData, $iLifetime);
    
    /**
     * Checks if a cache id exists.
     * @param string $sKey
     * @return bool
     */
    abstract public function exists($sKey);

    /**
     * Flushes the cache.
     *
     * @param $pattern
     * @return mixed
     */
    abstract public function flush($pattern = '');
    
    /**
     * Delete a cache id from the cache.
     * @param string $sKey
     * return ML_Magnalister_Model_Cache_Abstract
     *    A list of deleted keys
     */
    abstract public function delete($sKey);
    
    /**
     * Checks the availabillty of the cache driver.
     * @return bool
     */
    abstract public function checkAvailablity();
    
    /**
     * Get a list of all cached cache ids.
     * @return array
     */
    abstract public function getList();
}
