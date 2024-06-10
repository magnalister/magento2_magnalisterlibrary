<?php
function fileGetContents($path, &$warnings = null, $timeout = 10) {
	if (($contents = fileGetContentsCURL($path, $warnings, $timeout)) !== false) {
		return $contents;
	}
	return fileGetContentsPHP($path, $warnings, $timeout);
}