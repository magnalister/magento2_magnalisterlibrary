<?php

MLFilesystem::gi()->loadClass("model_db_abstract" );
class ML_Database_Model_Db_Mysql extends ML_Database_Model_Db_Abstract {
	protected $rLink = null;
	
	protected $access = array(
		'host' => '',
		'user' => '',
		'pass' => '',
		'persistent' => false,
	);
	
	public function __construct($access) {
		$this->access = array_merge($this->access, $access);
	}
	
	public function isConnected() {
		return is_resource($this->rLink) && mysql_ping($this->rLink);
	}
	
	public function connect($force = false) {
		$this->rLink = $this->access['persistent']
			? mysql_pconnect($this->access['host'], $this->access['user'], $this->access['pass'])
			: mysql_connect($this->access['host'], $this->access['user'], $this->access['pass']);
		
		if (!empty($this->charset)) {
			$this->setCharset($this->charset);
		}
	}
	
	public function close() {
		if ($this->isConnected()) {
			return mysql_close($this->rLink);
		}
		return false;
	}
	
	
	public function getLastErrorMessage() {
		if ($this->isConnected()) {
			return mysql_error($this->rLink);
		}
		return '';
	}
	
	public function getLastErrorNumber() {
		if ($this->isConnected()) {
			return mysql_errno($this->rLink);
		}
		return 0;
	}
	
	public function getServerInfo() {
		if ($this->isConnected()) {
			return mysql_get_server_info($this->rLink);
		}
		return false;
	}
	
	public function setCharset($charset) {
		$this->charset = $charset;
		if ($this->isConnected()) {
			if (function_exists('mysql_set_charset')) {
				mysql_set_charset($this->charset, $this->rLink);
			} else {
				$this->query('SET NAMES '.$this->charset);
			}
		}
		return false;
	}
	
	public function query($query) {
		if ($this->isConnected()) {
			return mysql_query($query, $this->rLink);
		}
		return false;
	}
	
	public function escape($str) {
		if ($this->isConnected()) {
			return mysql_real_escape_string($str, $this->rLink);
		}
		return self::fallbackEscape($str);
	}
	
	public function affectedRows() {
		if ($this->isConnected()) {
			mysql_affected_rows($this->rLink);
		}
		// re-establishing a connection doesn't make sense here as the new connection
		// can't return the affected row count of the old connection.
		return false;
	}
	
	public function getInsertId() {
		if ($this->isConnected()) {
			return mysql_insert_id($this->rLink);
		}
		// same reason as in $this->affectedRows();
		return false;
	}
	
	public function isResult($m) {
		return is_resource($m);
	}
	
	public function numRows($result) {
		return mysql_num_rows($result);
	}
	
	public function fetchArray($result) {
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}
	
	public function freeResult($result) {
		return mysql_free_result($result);
	}
}
