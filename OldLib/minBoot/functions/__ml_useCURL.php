<?php
function __ml_useCURL($bl = null) {
	global $__ml_useCURL;
	
	/* read */
	if ($bl === null) {
		if (isset($_SESSION['ML_UseCURL']) && is_bool($_SESSION['ML_UseCURL'])) {
			//echo "READ SESSION\n";
			return $_SESSION['ML_UseCURL'];
		} else if (isset($__ml_useCURL) && is_bool($__ml_useCURL)) {
			//echo "READ GLOBAL\n";
			return $__ml_useCURL;
		}
		//echo "NO READ\n";
		return function_exists('curl_init');
	
	/* write */
	} else {
		$bl = (bool)$bl;
		if (!empty($_SESSION)) {
			//echo "WRITE SESSION\n";
			$_SESSION['ML_UseCURL'] = $bl;
		} else {
			//echo "WRITE GLOBAL\n";
			$__ml_useCURL = $bl;
		}
		return $bl;
	}
}