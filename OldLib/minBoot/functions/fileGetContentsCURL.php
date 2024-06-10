<?php
function fileGetContentsCURL($path, &$warnings = null, $timeout = 10) {
	$useCURL = __ml_useCURL();
	if ($useCURL === false) {
		$warnings = 'cURL disabled';
		return false;
	}
	
	//echo __METHOD__."\n";
	if (!function_exists('curl_init') || (strpos($path, 'http') !== 0)) {
		return false;
	}
	$cURLVersion = curl_version();
	if (!is_array($cURLVersion) || !array_key_exists('version', $cURLVersion)) {
		return false;
	}
	
	$warnings = '';
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $path);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if ($timeout > 0) {
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	}
	
	$timeout_ts = time() + $timeout;
	$next_try = false;
	$return = false;
	
	do {
		//break;
		if ($next_try) usleep(rand(500000, 1500000));
		$return = curl_exec($ch);
		$next_try = true;
	} while (curl_errno($ch) && (time() < $timeout_ts));
	
	if (curl_errno($ch) == CURLE_OPERATION_TIMEOUTED) {
		__ml_useCURL(false);
		$return = false;
	}
	
	$warnings = curl_error($ch);
	/*
	__ml_useCURL(false);
	$return = false;
	$warnings = 'Timeout';
	//*/
	curl_close($ch);
	
	return $return;
}