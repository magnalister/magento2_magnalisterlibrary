<?php
function fileGetContentsPHP($path, &$warnings = null, $timeout = 10) {
	//echo __METHOD__."\n";
	if ($timeout > 0) {
		$context = stream_context_create(array(
			'http' => array('timeout' => $timeout)
		));
	} else {
		$context = null;
	}
	$timeout_ts = time() + $timeout;
	$next_try = false;
	
	ob_start();
	do {
		if ($next_try) usleep(rand(500000, 1500000));
		$return = file_get_contents($path, false, $context);
		$warnings = ob_get_contents();
		$next_try = true;
	} while ((false === $return) && (time() < $timeout_ts));
	ob_end_clean();
	
	return $return;
}