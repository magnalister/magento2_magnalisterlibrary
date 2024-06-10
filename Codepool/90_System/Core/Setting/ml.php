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

// default config
$sClientVersionFile = MLFilesystem::getLibPath('ClientVersion');
if (file_exists($sClientVersionFile)) {
    $aClientVersion = json_decode(file_get_contents(MLFilesystem::getLibPath('ClientVersion')), true);
} else {
    $aClientVersion = array();
}

MLSetting::gi()->sClientVersion = isset($aClientVersion['CLIENT_VERSION']) ? $aClientVersion['CLIENT_VERSION'] : false;
MLSetting::gi()->sClientBuild = isset($aClientVersion['CLIENT_BUILD_VERSION']) ? $aClientVersion['CLIENT_BUILD_VERSION'] : false;

MLSetting::gi()->sShowToolsMenu = '';
MLSetting::gi()->blTranslateInline = false;
MLSetting::gi()->blShowTranslationKeys = false;
MLSetting::gi()->blDebug = false;
MLSetting::gi()->blPreventRedirect = false;
MLSetting::gi()->aServiceVars=array(
    'sShowToolsMenu'            => array('validation' => ('/^$|^time$|^settings$|^sql$|^api$|^config$|^request$|^messages$|^session$|^tree$/'),   'ajax' => true, ),
    'blDebug'                   => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => false /*because ajax-forms (additems) are js*/, ),
    'blShowInfos'               => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blTemplateDebug'           => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => false /*because template dont update completely*/, ),
    'blShowWarnings'            => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blShowFatal'               => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blUseCache'                => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blCronDryRun'              => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blJsonBase64'              => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blDryAddItems'             => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blCleanRunOncePerSession'  => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blShowTranslationKeys' => array('validation' => FILTER_VALIDATE_BOOLEAN, 'ajax' => true,),
    //'blTranslateInline'         => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => true, ),
    'blPreventRedirect'         => array('validation' => FILTER_VALIDATE_BOOLEAN,   'ajax' => false, ),
    'sTranslationLanguage'      => array('validation' => ('/^' . implode('$|^', MLI18n::gi()->getPossibleLanguages()) . '$/'),   'ajax' => true, ),
    'sUpdateUrl'                => array('validation' => FILTER_VALIDATE_URL,       'ajax' => true, ),
    'sApiUrl'                   => array('validation' => FILTER_VALIDATE_URL,       'ajax' => true, ),
    'iOrderPastInterval'        => array('validation' => FILTER_VALIDATE_INT,       'ajax' => true, ),
);

MLSetting::gi()->blCronDryRun = false;
MLSetting::gi()->blDryAddItems = false;
MLSetting::gi()->blJsonBase64 = false;
MLSetting::gi()->blShowInfos = false;
MLSetting::gi()->blShowWarnings = false;
MLSetting::gi()->blShowFatal = false;
MLSetting::gi()->blTemplateDebug = false;
MLSetting::gi()->blCleanRunOncePerSession = false;
MLSetting::gi()->sTranslationLanguage = MLLanguage::gi()->getCurrentIsoCode();

/**
 * (de)activate cache-class.
 * except (force cache):
 *  ajax-requests
 *  session-vars
 * @var bool MLSetting::gi()->blUseCache
 */
MLSetting::gi()->blUseCache = true;

MLSetting::gi()->sApiUrl = 'http://api.magnalister.com/API/';
MLSetting::gi()->sDefaultApiUrl = 'http://api.magnalister.com/API/';
MLSetting::gi()->sApiRelatedUrl = 'http://api.magnalister.com/APIRelated/';
MLSetting::gi()->sUpdateUrl = 'http://api.magnalister.com/update/v3/';
MLSetting::gi()->sPublicUrl = 'https://www.magnalister.com/';
MLSetting::gi()->blUseCurl = function_exists('curl_init');

MLSetting::gi()->sRequestPrefix = 'ml';//all parameters have a prefix yet

MLSetting::gi()->iDefaultCacheLifeTime = 7200;// 2 hour
MLSetting::gi()->iOrderPastInterval = 60 * 60 * 24 * 7;
MLSetting::gi()->iOrderMinTime = time() - 60 * 60 * 24 * 30;
MLSetting::gi()->MAGNA_SUPPORT_URL = '<a href="{#setting:sPublicUrl#}" title="{#setting:sPublicUrl#}">{#setting:sPublicUrl#}</a>';
MLSetting::gi()->sMemoryLimit = '512M';
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
    MLSetting::gi()->blSaveMode = false;
} else {
    $safeMode = ini_get('safe_mode');
    switch ($safeMode) {
        case 'on':
        case 'yes':
        case 'true':
            MLSetting::gi()->blSaveMode = true;
            break;
        default:
            MLSetting::gi()->blSaveMode = (bool)(int)$safeMode;
            break;
    }
}

MLSetting::gi()->blInlineResource = false;

MLSetting::gi()->blIterativeRequest = true;