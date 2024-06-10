<?php
if (!function_exists('ctype_digit')) {
	function ctype_digit($string) {
		return (boolean)preg_match('/^[0-9]*$/', $string);
	}
}
