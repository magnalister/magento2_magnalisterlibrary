<?php
/**
 * A class to store and manage session data.
 */
class ML_Core_Model_Session{
    protected $aData = array();
    protected $blIsDestructed = false;
    
    /**
     * Set a session value.
     * @param string $sKey
     * @param mixed $sValue
     * @return self
     */
    public function set($sKey, $sValue){
        $this->aData[$sKey] = $sValue;
        return $this->save();
    }
    
    /**
     * Returns a value for a key or null if it doesn't exist.
     * @return ?mixed
     */
    public function get($sKey) {
        return isset($this->aData[$sKey]) ? $this->aData[$sKey] : null;
    }
    
    /**
     * Returns all session data.
     * @return array
     */
    public function data(){
        return $this->aData;
    }
    
    /**
     * Flushes all session data.
     * @return self
     */
    public function flush() {
        $this->aData = array();
        return $this->save();
    }
    
    /**
     * Deletes a key from the session data.
     * @param string $sKey
     * @return self
     */
    public function delete($sKey) {
        unset($this->aData[$sKey]);
        return $this->save();
    }
    
    /**
     * Creates an instance of this class.
     * @return self
     */
    public function __construct() {
        if (MLCache::gi()->exists(strtoupper(__class__).'__'.MLShop::gi()->getSessionId().'.json')) {
            $this->aData = MLCache::gi()->get(strtoupper(__class__).'__'.MLShop::gi()->getSessionId().'.json');
            $this->aData = is_array($this->aData) ? $this->aData : array();
        }
        /*
         * there was several problems with __destruct
         * so we use register_shutdown_function and save after first shutdown called every change in session
         */
        register_shutdown_function(array(&$this, "destruct")); 
    }
    
    /**
     * An own destruction method. DO NOT CALL FROM EXTERN!
     * @return void
     */
    public function destruct() {
        $this->blIsDestructed = true;
        $this->save();
    }
    
    /**
     * Saves the current session data in the cache.
     * @return self
     */
    protected function save() {
        if ($this->blIsDestructed) { //only save after shutdown
            MLCache::gi()->set(strtoupper(__class__).'__'.MLShop::gi()->getSessionId().'.json', $this->aData, 15 * 60);
        }
        return $this;
    }
}