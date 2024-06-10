<?php


class MagnaException extends Exception {

    const NO_RESPONSE = 0x1;
    const NO_SUCCESS = 0x2;
    const INVALID_RESPONSE = 0x4;
    const UNKNOWN_ERROR = 0x8;
    const TIMEOUT = 0x10;

    protected $response = array();
    protected $request = array();
    protected $time = 0;
    private $isCritical = true;
    private $action = '';
    private $subsystem = '';
    private $apierrors = array();
    private $backtrace = array();

    public function serialize() {
        if ((version_compare(PHP_VERSION, '8.1') >= 0)) {
            return __serialize(get_object_vars($this));
        } else {
            return serialize(get_object_vars($this));
        }
    }

    public function unserialize($sSerialized) {
        if ((version_compare(PHP_VERSION, '8.1') >= 0)) {
            foreach (__unserialize($sSerialized) as $sName => $mValue) {
                $this->{$sName} = $mValue;
            }
        } else {
            foreach (unserialize($sSerialized) as $sName => $mValue) {
                $this->{$sName} = $mValue;
            }
        }
    }

    public function __construct($message, $code = 0, $request = array(), $response = array(), $time = 0) {

        MLLog::gi()->add('MagnaConnector', array(
            'display' => array(
                'Message' => $message,
                'Code' => $code,
                'Request' => $request,
                'Response' => $response,
                'Time' => $time
            )));
        parent::__construct($message, $code);
        $this->response = $response;
        $this->request = $request;
        $this->time = $time;

        if (is_array($this->response) && isset($this->response['ERRORS'])) {
            $this->apierrors = $this->response['ERRORS'];
        }
        $error = array();
        if (count($this->apierrors) == 1) {
            $error = current($this->apierrors);
        }

        $this->action = isset($error['ACTION']) ? $error['ACTION'] : (isset($this->request['ACTION']) ? $this->request['ACTION'] : 'UNKOWN');

        $this->subsystem = isset($error['SUBSYSTEM']) ? $error['SUBSYSTEM'] : (isset($this->request['SUBSYSTEM']) ? $this->request['SUBSYSTEM'] : 'UNKOWN');

        if (function_exists('prepareErrorBacktrace')) {
            $this->backtrace = prepareErrorBacktrace(2);
        } else {
            $this->backtrace = array();
        }
    }

    public function getResponse() {
        return $this->response;
    }

    public function getErrorArray() {
        return $this->response;
    }

    public function getRequest() {
        return $this->request;
    }

    public function getTime() {
        return $this->time;
    }

    public function setCriticalStatus($b) {
        $this->isCritical = $b;
    }

    public function isCritical() {
        return $this->isCritical;
    }

    public function saveRequest() {
        MLDatabase::factory('apirequest')->set('data', $this->request)->save();
    }

    public function getDebugBacktrace() {
        return $this->backtrace;
    }

    public function getAction() {
        return $this->action;
    }

    public function getSubsystem() {
        return $this->subsystem;
    }

}
