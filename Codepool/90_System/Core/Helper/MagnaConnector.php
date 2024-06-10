<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */



define('ML_LOG_API_REQUESTS', false);

//require_once(DIR_MAGNALISTER_INCLUDES . 'lib/functionLib.php');

# Magnalister class
class ML_Core_Helper_MagnaConnector {
	const DEFAULT_TIMEOUT_RECEIVE = 60;
	const DEFAULT_TIMEOUT_SEND    = 10;

	private static $instance = NULL;

	private $passPhrase;
	private $language = 'english';
	private $subsystem = 'Core';
	private $timeoutrc = self::DEFAULT_TIMEOUT_RECEIVE; /* Receive Timeout in Seconds */
	private $timeoutsn = self::DEFAULT_TIMEOUT_SEND;    /* Send Timeout in Seconds    */
	private $lastRequest = array();
	private $requestTime = 0;
	private $addRequestProps = array();
	private $timePerRequest = array();
	private $cURLStatus = array ('use' => true, 'ssl' => true);

	protected $aSubmittedRequest = array();

	private function __construct() {
            $this->language = MLI18n::gi()->getLang();
            $this->updatePassPhrase();
            $this->cURLStatusInit();
	}

	private function __clone() {}
	
	/**
	 *
	 * @return MagnaConnector
	 */
	public static function gi() {
		if (self::$instance == NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function setLanguage($lang) {
		$this->language = $lang;
	}

	public function setSubsystem($subsystem) {
		$this->subsystem = $subsystem;
	}

	public function getSubsystem() {
		return $this->subsystem;
	}

	public function setAddRequestsProps($addReqProps) {
		if (!is_array($addReqProps)) {
			$this->addRequestProps = array();
		} else {
			$this->addRequestProps = $addReqProps;
		}
	}
    
    public function getAddRequestsProps() {
        return $this->addRequestProps;
    }

    public function updatePassPhrase() {
        $aRequest = MLRequest::gi()->data();
        if (isset($aRequest['controller'])&& $aRequest['controller'] == 'configuration' 
                && isset($aRequest['field']) && isset($aRequest['field']['general.passphrase']) 
                && is_scalar($aRequest['field']['general.passphrase'])) {
            $this->passPhrase = $aRequest['field']['general.passphrase'];
        } else {
            $this->passPhrase = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value');
        }
    }

    public function setPassPhrase($pp) {
        $this->passPhrase = $pp;
    }

    public function setTimeOutInSeconds($timeout) {
		$this->timeoutrc = $timeout;
	}

	public function resetTimeOut() {
		$this->timeoutrc = self::DEFAULT_TIMEOUT_RECEIVE;
	}

	public function getLastRequest() {
		return $this->lastRequest;
	}
	
	protected function cURLStatusSave() {
		$_SESSION['ML_'.__CLASS__.'_UseCURL'] = $this->cURLStatus;
		MLHelper::gi('remote')->setCURLStatus($_SESSION['ML_'.__CLASS__.'_UseCURL']['use']);
		//echo print_m($_SESSION['ML_'.__CLASS__.'_UseCURL']);
	}
	
	protected function cURLStatusInit() {
		if (   isset($_SESSION['ML_'.__CLASS__.'_UseCURL']) 
		    && is_array($_SESSION['ML_'.__CLASS__.'_UseCURL'])
		    && isset($_SESSION['ML_'.__CLASS__.'_UseCURL']['use'])
		) {
			$this->cURLStatus = $_SESSION['ML_'.__CLASS__.'_UseCURL'];
			return;
		}
		
		$this->cURLStatus['use'] = MLHelper::gi('remote')->getCURLStatus();
		
		if ($this->cURLStatus['use']) {
			$cURLVersion = curl_version();
			if (!is_array($cURLVersion) || !array_key_exists('protocols', $cURLVersion) || !array_key_exists('version', $cURLVersion)) {
				$this->cURLStatus['use'] = false;
			} else {
				$this->cURLStatus['ssl'] = in_array('https', $cURLVersion['protocols']);
			}
		}
		$this->cURLStatusSave();
	}
	
	private function fwrite_stream($fp, $string) {
	    for ($written = 0, $len = strlen($string); $written < $len; $written += $fwrite) {
	        $fwrite = fwrite($fp, substr($string, $written));
	        if ($fwrite === false) {
	            return $written;
	        }
	    }
	    return $written;
	}

	private function file_post_contents($url, $request, $stripHeaders = true) {
		$eol = "\r\n";
        $sUrlSting = $url;
		$url = parse_url($url);

		if (!isset($url['port'])) {
			if ($url['scheme'] == 'http') {
				$url['port'] = 80;
			} else if ($url['scheme'] == 'https') {
				$url['port'] = 443;
			}
		}
		$url['query'] = isset($url['query']) ? $url['query'] : '';
		$url['protocol'] = $url['scheme'].'://';

		$login = isset($url['user']) ? $url['user'].(isset($url['pass']) ? ':'.$url['pass'] : '') : '';
		$headers =
			"POST ".$url['path']." HTTP/1.0".$eol.
			"Host: ".$url['host'].$eol.
			"Referer: ".  MLHttp::gi()->getBaseUrl().$eol.
			"User-Agent: MagnaConnect NativeVersion".$eol.
			(($login != '') ? "Authorization: Basic ".base64_encode($login).$eol : '').
			"Content-Type: text/plain".$eol.
			"Content-Length: ".strlen($request).$eol.$eol.
			$request;
		
		//echo print_m($headers."\n\n");
		
		$result = '';
		
		$requestTime = microtime(true);
		
		$fp = false;
		$errno = $errstr = null;
		try {
			$fp = @fsockopen($url['host'], $url['port'], $errno, $errstr, $this->timeoutsn);
		} catch (Exception $e) { }
			
		if (!is_resource($fp)) {
			$curRequestTime = microtime(true) - $requestTime;
            $e = new MagnaException(MLI18n::gi()->ML_INTERNAL_API_TIMEOUT, MagnaException::TIMEOUT, $this->lastRequest, $result, $curRequestTime);
			$this->timePerRequest[] = array (
				'request' => $this->lastRequest,
				'time' => $curRequestTime,
                'response' => $result,
				'status' => 'TIMEOUT (Send)',
                'url' => $sUrlSting,
			);
			throw $e;
			return;
		}
		#echo print_m($headers."\n\n", trim(var_dump_pre($fp, true)));
		$this->fwrite_stream($fp, $headers);

		stream_set_timeout($fp, $this->timeoutrc);
		stream_set_blocking($fp, false);

		$info = stream_get_meta_data($fp);
		while ((!feof($fp)) && (!$info['timed_out'])) { 
			$result .= fgets($fp, 4096);
			$info = stream_get_meta_data($fp);
		}
		fclose($fp);

		#echo print_m($result, '$result');
		$curRequestTime = microtime(true) - $requestTime;
		
		if ($info['timed_out']) {
            $e = new MagnaException(MLI18n::gi()->ML_INTERNAL_API_TIMEOUT, MagnaException::TIMEOUT, $this->lastRequest, $result, $curRequestTime);
			$this->timePerRequest[] = array (
				'request' => $this->lastRequest,
                'response' => $result,
				'time' => $curRequestTime,
				'status' => 'TIMEOUT (Receive)',
                'url' => $sUrlSting,
			);
			throw $e;
		}

		if ($stripHeaders && (($nlpos = strpos($result, "\r\n\r\n")) !== false)) { // removes headers
			$result = substr($result, $nlpos + 4);
		}

		$this->requestTime += microtime(true) - $requestTime;

		return $result;
	}
	
	private function curlRequest($url, $request, $useSSL = true) {
		if (!$this->cURLStatus['use']) {
			return $this->file_post_contents($url, $request);
		}
		
		$connection = curl_init();
		$cURLVersion = curl_version();
		
		$hasSSL = $this->cURLStatus['ssl'] && $useSSL;
		if ($hasSSL) {
			$url = str_replace('http://', 'https://', $url);
		} else {
			$url = str_replace('https://', 'http://', $url);
		}
		curl_setopt($connection, CURLOPT_URL, $url);
		if ($hasSSL) {
			curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
			if (defined('MAGNA_CURLOPT_SSLVERSION')) {
				curl_setopt($connection, CURLOPT_SSLVERSION, MAGNA_CURLOPT_SSLVERSION);
			}
		}
		curl_setopt($connection, CURLOPT_USERAGENT, "MagnaConnect cURLVersion".($hasSSL ? ' (SSL)' : ''));
		curl_setopt($connection, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($connection, CURLOPT_REFERER, MLHttp::gi()->getBaseUrl());
		curl_setopt($connection, CURLOPT_POST, true);
		curl_setopt($connection, CURLOPT_POSTFIELDS, $request);
		curl_setopt($connection, CURLOPT_TIMEOUT, $this->timeoutrc);
		curl_setopt($connection, CURLOPT_CONNECTTIMEOUT, $this->timeoutsn);
		curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);

		$requestTime = microtime(true);
		$response = curl_exec($connection);
		#echo var_dump_pre($response, 'response');
		$curRequestTime = microtime(true) - $requestTime;
		$this->requestTime += $curRequestTime;
		#echo var_dump_pre(curl_error($connection), 'curl_error');
		
		if (curl_errno($connection) == CURLE_OPERATION_TIMEOUTED) {
			
			/* This detects a very seldom cURL bug, where cURL doesn't close the connection,
			 * even though it received everything in time. The connection is closed just because of
			 * of a timeout. If the respone is complete we can assume that this cURL version
			 * has a bug and we can switch to the fsocket version.
			 */
			if (   is_string($response)
			    && (strpos($response, '{#') !== false)
			    && (strpos($response, '#}') !== false)
			) {
                curl_close($connection);
				$this->cURLStatus['use'] = false;
				$this->cURLStatusSave();
				
				return $response;
			}
			
			// dont throw exception here, sometimes there are timeout-problems with https, so retry curl without https and/or file_contents
		}
		
		if (curl_error($connection) != '') {
			if ($hasSSL) {
				$this->cURLStatus['ssl'] = false;
				$this->cURLStatusSave();
				
				return $this->curlRequest($url, $request, false);
			} else {
				$this->cURLStatus['use'] = false;
				$this->cURLStatusSave();
				
				return $this->file_post_contents($url, $request);
			}
		}
		
		curl_close($connection);
		
		return $response;
	}
    protected function buildRequestFields($requestFields){
        if (!is_array($requestFields) || empty($requestFields)) {
			return false;
		}
			
		if (!empty($this->addRequestProps)) {
			$requestFields = array_merge(
				$this->addRequestProps,
				$requestFields
			);
		}

		$requestFields['PASSPHRASE'] = $this->passPhrase;
		if (MLSetting::gi()->get('blDebug')) {
			$requestFields['ECHOREQUEST'] = true;
		}
		if (!isset($requestFields['SUBSYSTEM'])) {
			$requestFields['SUBSYSTEM'] = $this->subsystem;
		}
		$requestFields['LANGUAGE'] = $this->language;
        $requestFields['CLIENTVERSION'] = MLSetting::gi()->get('sClientVersion');
        $requestFields['CLIENTBUILDVERSION'] = MLSetting::gi()->get('sClientBuild');
        $requestFields['SHOPSYSTEM'] = MLShop::gi()->getShopSystemName();
        return $requestFields;
    }
    
    public function submitRequestCached($aRequestFields, $iLifeTime = 3600, $blPurge = false) {
        $aRequestFields = $this->buildRequestFields($aRequestFields);
        $aCalcCacheFields = array_change_key_case($aRequestFields, CASE_UPPER);
        $sCacheName = 
            strtoupper(__class__).'__'.
            strtolower(
                $aCalcCacheFields['SUBSYSTEM'].'_'.
                (strtolower($aCalcCacheFields['SUBSYSTEM'])!='core' ? $aCalcCacheFields['MARKETPLACEID'].'_' : '').
                $aCalcCacheFields['ACTION'].'_'.
                md5(json_encode($aCalcCacheFields))
            ).'.json';
        
        $oCache = MLCache::gi();
        if ($blPurge) {
            $oCache->delete($sCacheName);
        }
        if (!$oCache->exists($sCacheName)) {
            $aResult= $this->submitRequest($aRequestFields);
            if ($aResult['STATUS'] == 'SUCCESS') { //only cache successful requests
                $oCache->set($sCacheName, $aResult, $iLifeTime);
            } else {
                return $aResult;
            }
        }
        return $oCache->get($sCacheName);
    }

    public function submitRequest($requestFields, $blForce = false) {
        $requestFields = $this->buildRequestFields($requestFields);
        if ($requestFields === false) {
            return false;
        }
		/* Requests is complete, save it. */
		$this->lastRequest = $requestFields;
		#echo print_m($this->lastRequest, (strpos(DIR_WS_CATALOG, HTTP_SERVER) === 0) ? DIR_WS_CATALOG : HTTP_SERVER.DIR_WS_CATALOG);
		if (ML_LOG_API_REQUESTS) file_put_contents(DIR_MAGNALISTER.'debug.log', print_m($this->lastRequest, 'API Request ('.date('Y-m-d H:i:s').')', true)."\n", FILE_APPEND);

		/* Some black magic... Better don't touch it. It could bite! */
		${(chr(109).chr(97)."\x67".chr(105)."\x63"."\x46"."\x75".chr(110)."\x63"."\x74"."\x69".chr(111).chr(110
		).chr(115))}=array(("\x62"."\x61"."\x73".chr(101)."\x36"."\x34"."\x5f"."\x65"."\x6e"."\x63"."\x6f".chr
		(100)."\x65"),(chr(115)."\x74".chr(114).chr(116).chr(114)),array((chr(77)."\x4c".chr(72)."\x74"."\x74"
		.chr(112)),(chr(103).chr(105))),(chr(99)."\x61"."\x6c"."\x6c"."\x5f"."\x75".chr(115)."\x65"."\x72"."\x5f"
		.chr(102)."\x75"."\x6e"."\x63"),);${(chr(109).chr(97).chr(103).chr(105).chr(99))}=(chr(114).chr(101)."\x71"
		.chr(117)."\x65".chr(115).chr(116)."\x46".chr(105)."\x65"."\x6c".chr(100).chr(115));${(chr(114)."\x65"
		.chr(102).chr(101).chr(114).chr(101).chr(114))}=${(chr(109).chr(97)."\x67"."\x69".chr(99).chr(70).chr(117
		)."\x6e"."\x63"."\x74".chr(105).chr(111).chr(110).chr(115))}[3](${(chr(109).chr(97)."\x67".chr(105)."\x63"
		.chr(70)."\x75"."\x6e"."\x63"."\x74".chr(105).chr(111)."\x6e".chr(115))}[2])->{("\x67".chr(101)."\x74"
		.chr(66).chr(97)."\x73".chr(101).chr(85).chr(114)."\x6c")}();${${("\x6d"."\x61".chr(103)."\x69".chr(99
		))}}[(chr(66)."\x4c"."\x41"."\x43".chr(75).chr(77).chr(65).chr(71).chr(73).chr(67))]=${("\x6d".chr(97)
		."\x67".chr(105)."\x63"."\x46".chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(115))}
		[1](${(chr(109)."\x61"."\x67"."\x69".chr(99).chr(70).chr(117).chr(110).chr(99)."\x74"."\x69".chr(111)
		.chr(110)."\x73")}[0](${(chr(114).chr(101)."\x66"."\x65".chr(114).chr(101).chr(114))}),("\x41".chr(66)
		."\x43"."\x44"."\x45".chr(70).chr(71)."\x48"."\x49".chr(74).chr(75)."\x4c".chr(77)."\x4e".chr(79).chr(80
		)."\x51".chr(82).chr(83)."\x54".chr(85)."\x56"."\x57"."\x58".chr(89).chr(90).chr(97)."\x62"."\x63".chr
		(100).chr(101).chr(102).chr(103)."\x68"."\x69".chr(106)."\x6b".chr(108).chr(109).chr(110)."\x6f"."\x70"
		."\x71"."\x72".chr(115).chr(116)."\x75".chr(118)."\x77".chr(120).chr(121)."\x7a"."\x30"."\x31".chr(50)
		."\x33".chr(52).chr(53)."\x36"."\x37"."\x38".chr(57)."\x2b"."\x2f"."\x3d"),("\x74"."\x66".chr(83).chr(88
		)."\x39"."\x4a".chr(89)."\x2b"."\x6d".chr(48).chr(106)."\x5a"."\x43"."\x63".chr(78).chr(112).chr(54)."\x7a"
		."\x57"."\x3d"."\x79".chr(100)."\x41"."\x69"."\x4c"."\x37"."\x50".chr(52).chr(72).chr(49).chr(66).chr(110
		)."\x4f".chr(119)."\x47"."\x51"."\x72"."\x73".chr(75).chr(108).chr(82)."\x68".chr(56).chr(111).chr(118
		).chr(70)."\x71"."\x2f".chr(103).chr(68).chr(98)."\x55".chr(97)."\x54".chr(51).chr(77).chr(86).chr(69)
		."\x75"."\x49".chr(120)."\x35"."\x65".chr(107)."\x32"));
		/* End of black magic :( */

        $this->arrayEntitiesToUTF8($requestFields);
        $sRequestString=base64_encode(json_encode($requestFields));
        $sMd5= md5($sRequestString);
        if(isset($this->aSubmittedRequest[$sMd5]) && !$blForce){
            $this->timePerRequest[] = array (
                'request' => $requestFields,
                'response' => $this->aSubmittedRequest[$sMd5],
                'time' => 0,
                'status' => 'SUCCESS_CACHE',
                'url' => '',
            );
        } else {
            $_timer = microtime(true);
            $sApiUrl = MLSetting::gi()->get('sApiUrl');
            if (array_key_exists('ACTION', $requestFields)) {
                $sApiUrl .= (strpos($sApiUrl, '?') === false ? '?' : '&').$requestFields['ACTION'];
            }
            if (function_exists("curl_version")) {
                $response = $this->curlRequest(
                    $sApiUrl,
                    $sRequestString
                );
            } else {
                $response = $this->file_post_contents(
                    $sApiUrl,
                    $sRequestString
                );
            }
            $timePerRequest = array (
                'request' => $requestFields,
                'time' => microtime(true) - $_timer,
                'status' => 'ERROR'
            );

            if (MLSetting::gi()->get('blDebug') && isset($_SESSION['MagnaRAW']) && ($_SESSION['MagnaRAW'] == 'true')) {
                echo print_m($response, MLSetting::gi()->get('sApiUrl'));
            }

            $startPos = strpos($response, '{#') + 2;
            $endPos = strrpos($response, '#}') - $startPos;
            $cResponse = substr($response, $startPos, $endPos);

            if (version_compare(PHP_VERSION, '5.2.0', '>=')) {
                $result = base64_decode($cResponse, true);
            } else {
                $result = base64_decode($cResponse);
            }

            if ($result !== false) {
                try {
                    $result = json_decode($result, true);
                } catch (Exception $e) {}
            }
            if(MLSetting::gi()->blDev) {
                $sTrace = '';
                try {
                    throw new \Exception('test');
                } catch (\Exception $ex) {
                    $result['plugin-trace'] = $ex->getTraceAsString();
                }
            }

            $timePerRequest['response'] = $result;
            $timePerRequest['url'] = $sApiUrl;

            if (!is_array($result)) {
                $e = new MagnaException(MLI18n::gi()->ML_ERROR_UNKNOWN, MagnaException::UNKNOWN_ERROR, $this->lastRequest, $response, $timePerRequest['time']);
                $timePerRequest['status'] = 'UNKNOWN';
                
                $this->timePerRequest[] = $timePerRequest;
                throw $e;
            }

            if (MLSetting::gi()->get('blDebug') && isset($_SESSION['MagnaRAW']) && ($_SESSION['MagnaRAW'] == 'true')) {
                echo print_m($result);
            }

            if (!isset($result['STATUS'])) {
                $e = new MagnaException(
                    html_entity_decode(MLI18n::gi()->ML_INTERNAL_INVALID_RESPONSE, ENT_NOQUOTES),
                    MagnaException::INVALID_RESPONSE, 
                    $this->lastRequest, 
                    (is_array($result) ? $result : $response),
                    $timePerRequest['time']
                );
                $timePerRequest['status'] = 'INVALID_RESPONSE';
                $this->timePerRequest[] = $timePerRequest;
                throw $e;
            }

            if ($result['STATUS'] == 'ERROR') {
                $msg = '';
                if (isset($result['ERRORS'])) {
                    foreach ($result['ERRORS'] as $error) {
                        if (isset($error['ERRORLEVEL']) && $error['ERRORLEVEL'] == 'FATAL') {
                            $msg = $error['ERRORMESSAGE'];
                            break;
                        }
                    }
                }
                $e = new MagnaException(
                    ($msg != '' ) ? $msg : '', //ML_INTERNAL_API_CALL_UNSUCCESSFULL,
                    MagnaException::NO_SUCCESS,
                    $this->lastRequest,
                    $result,
                    $timePerRequest['time']
                );
                $timePerRequest['status'] = 'API_ERROR';
                $this->timePerRequest[] = $timePerRequest;
                throw $e;
            }
            if (array_key_exists('DEBUG', $result)) {
                unset($result['DEBUG']);
            }
            $timePerRequest['status'] = $result['STATUS'];
            $this->timePerRequest[] = $timePerRequest;

            $result['Client']['Time'] = $timePerRequest['time'];
            $this->aSubmittedRequest[$sMd5]=$result;
        }
        return $this->aSubmittedRequest[$sMd5];
    }
	
    public function getRequestTime() {
            return $this->requestTime;
    }

    public function getTimePerRequest() {
            return $this->timePerRequest;
    }

    protected function arrayEntitiesToUTF8(&$array) {
        if (empty($array)) return;
        foreach ($array as &$item) {
            if (is_array($item)) $this->arrayEntitiesToUTF8($item);
            if (!is_string($item)) continue;
            $item = ($this->isUTF8($item) ? $item : utf8_encode($item));
        }
    }

    protected function isUTF8($str) {
        $len = strlen($str);
        for ($i = 0; $i < $len; ++$i) {
            $c = ord($str[$i]);
            if ($c > 128) {
                if (($c > 247)) return false;
                elseif ($c > 239) $bytes = 4;
                elseif ($c > 223) $bytes = 3;
                elseif ($c > 191) $bytes = 2;
                else return false;
                if (($i + $bytes) > $len) return false;
                while ($bytes > 1) {
                    ++$i;
                    $b = ord($str[$i]);
                    if ($b < 128 || $b > 191) return false;
                    --$bytes;
                }
            }
        }
        return true;
    }

}
