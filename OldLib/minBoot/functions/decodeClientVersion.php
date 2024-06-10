<?php
function decodeClientVersion($str) {
	$ret = array();
	
	if (!preg_match('/^\{([^\}]*)\}$/', $str, $match)) return $ret;
	if (!preg_match_all('/"([^\"]*)":"?([^\"]*)"?,/', $match[1].',', $match)) return $ret;

	foreach ($match[1] as $i => $key) {
		$ret[$key] = $match[2][$i];
	}
	return $ret;
}