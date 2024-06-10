<?php
/**
 * Diese Funktion ruft andere hier hinterlegte Funktionen auf. Sinn ist den zu
 * aendernden Code in Shop eigenen Scripten so gering wie moeglich zu halten.
 *
 * @param $functionName	Name der auszufuehrenden Funktion oder Aktion
 * @param $arguments	Assoziatives Array mit Parametern
 */
function magnaExecute($functionName, $arguments = array(), $includes = array(), $opts = 0) {
 	global $magnaConfig;
	if (!(
			(($opts & MAGNA_WITHOUT_AUTH) == MAGNA_WITHOUT_AUTH) || (
				!isset($magnaConfig['maranon']['IsAccessAllowed']) 
 				|| ($magnaConfig['maranon']['IsAccessAllowed'] != 'yes')
 			)
		)
	) {
		return false;
	}
	if (!empty($includes)) {
		foreach ($includes as $incl) {
			require_once(DIR_MAGNALISTER_INCLUDES.'callback/'.$incl);
		}
	}
	if (function_exists($functionName)) {
		return $functionName($arguments);
	}
	return false;
}
