<?php

abstract class ML_Database_Model_Db_Abstract {
	protected $charset = '';
	
	abstract public function __construct($access);
	
	abstract public function isConnected();
	abstract public function connect();
	abstract public function close();
	abstract public function getLastErrorMessage();
	abstract public function getLastErrorNumber();
	abstract public function getServerInfo();
	abstract public function setCharset($charset);
	abstract public function query($query);
	abstract public function escape($str);
	abstract public function affectedRows();
	abstract public function getInsertId();
	abstract public function isResult($m);
	abstract public function numRows($result);
	abstract public function fetchArray($result);
	abstract public function freeResult($result);
	
	public function getDriverDetails() {
		$access = $this->access;
		unset($access['user']);
		unset($access['pass']);
		return $access;
	}
	
	/**
	 * mimics mysql_real_escape_string
	 */
	public function fallbackEscape($str) {
		return str_replace(
			array('\\',   "\0",  "\n",  "\r",  "'",   '"',   "\x1a"),
			array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z' ),
			$str
		);
	}
}
