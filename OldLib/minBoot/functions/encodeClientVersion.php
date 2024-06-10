<?php
function encodeClientVersion($arr) {
	$str = '';
	if (!is_array($arr) || empty($arr)) return '{}';
	$str = '{';
	foreach ($arr as $key => $value) {
		if (!is_int($value) && !ctype_digit($value)) {
			$value = '"'.(string)$value.'"';
		}
		$str .= '"'.$key.'":'.$value.',';
	}
	$str = rtrim($str, ',');
	return $str.'}';
}