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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * Class for handling translations.
 */
class MLI18n extends MLRegistry_Abstract {
    
    protected $blDefaultValue=true;
    
    protected $aIncludedFiles = array();

    protected $aIncludedDefaultFiles = array();

    protected $aTranslationData = array();

    protected $aGlobalTranslationData = array();

    protected $blIncludingDefault = false;
    protected $aDefaultData = array();
    private $aTranslationDefaultData = array();

    /**
     * Singleton. Returns the created instance.
     * @return MLI18n
     */
    public static function gi($sInstance = null) {
        return parent::getInstance('MLI18n', $sInstance);
    }
    
    /**
     * Boots the class, gets the language and loads all language files.
     * @return void
     */
    protected function bootstrap() {
        $this->getLang();

        if ($this->isTranslationActive()) {
            $this->includeFilesDefaultLang();
        }

        $this->includeFiles();
    }
    
    /**
     * Returns all languages which have translations.
     * @return array
     */
    public static function getPossibleLanguages() {
        $aAllLanguages = array();
        foreach (MLFilesystem::gi()->getBasePaths('i18n') as $aModul){//getting all availible languages
            foreach ($aModul as $aModulInfo) {
                $sPathLang = strtolower(basename(dirname($aModulInfo['path'])));
                if (!in_array($sPathLang, $aAllLanguages)) {
                    $aAllLanguages[] = $sPathLang;
                }
            }
        }
        return $aAllLanguages;
    }
    
    /**
     * Alias getter for shoptype.
     * Find out what shop type and set $sShopType eg. magento, oscommerce.
     * Sets config value sLibPath (path/to/ML/Lib).
     * @return string
     * @todo Exeption unknown shoptype
     */
    public function getLang()
    {
        try {
            $sLang = MLSetting::gi()->get('sLang');
        } catch (Exception $oEx) {
            $sLang = MLLanguage::gi()->getCurrentIsoCode();
            $aAllLanguages = self::getPossibleLanguages();
            if (!in_array($sLang, $aAllLanguages)) {
                if (in_array('en', $aAllLanguages)) {//default
                    $sLang = 'en';
                } else {
                    $sLang = 'de';
                }
            }
            MLSetting::gi()->set('sLang', $sLang);
        }
        return $sLang;
    }

    public function getDefaultLang()
    {
        return 'De';
    }

    /**
     * Part of bootstrap
     * Reads all files in config folders, customerspecific first.
     * @return void
     */
    public function includeFiles() {
        $aFiles = array_diff(
            MLFilesystem::gi()->getLangFiles($this->getLang()),
            $this->aIncludedFiles
        );
        // To override translation in file with lower priority from file high priority in file-system we need to reverse file default order
        // For example
        // ".../Codepool/80_Modules/020_Ebay/I18n/En/configForm.php" should executed before ".../Codepool/65_ShopModule/ShopwareEbay/I18n/En/configForm.php"
        $aFiles = array_reverse($aFiles);
        foreach ($aFiles as $sPath) {
            $this->aIncludedFiles[]=$sPath;
            if (pathinfo($sPath, PATHINFO_EXTENSION) == 'php') {
                include($sPath);
            } else {
                $rPath = fopen($sPath,'r');
                while ($aI18n = fgetcsv($rPath)) {
                    if (substr($aI18n[0], 0, 1) != '[') {
                        $this->$aI18n[0] = $aI18n[1];
                    }
                }
                fclose($rPath);
            }
        }
    }

    /**
     * Includes all translation files for default language (DE).
     * Reads all files in config folders, customer specific first.
     * Part of bootstrap.
     */
    public function includeFilesDefaultLang() {
        $this->blIncludingDefault = true;
        $aPathFiles = array_diff(MLFilesystem::gi()->getLangFiles($this->getDefaultLang()), $this->aIncludedDefaultFiles);
        foreach ($aPathFiles as $sPath) {
            $this->aIncludedDefaultFiles[] = $sPath;
            if (pathinfo($sPath, PATHINFO_EXTENSION) == 'php') {
                include($sPath);
            } else {
                $rPath = fopen($sPath,'r');
                while ($aI18n = fgetcsv($rPath)) {
                    if (substr($aI18n[0], 0, 1) != '[') {
                        $this->$aI18n[0] = $aI18n[1];
                    }
                }

                fclose($rPath);
            }
        }

        $this->blIncludingDefault = false;
    }

    /**
     * Finds a language file based of its name, and the specified prefixes.
     *
     * return string
     */
    public function find($sName, $aPrefixes = array('')) {
        foreach ($aPrefixes as $sPrefix) {
            if ($this->__get($sPrefix.$sName) != $sPrefix.$sName) {
                return $this->__get($sPrefix.$sName);
            }
        }
        return $sName;
    }
    
    /**
     * override set to use array_replace_recursive instead of array_merge_recursive
     * to prevent converting existed non array value to array
     * array_merge_recursive(
     *      array('Title' => 'Produktname' ),
     *      array('Title' => 'Product name' )
     * )
     * result : array(
     *     'Title' => array( 
     *         0=>'Produktname',
     *         1=>'Product name' 
     *     ) 
     * )
     *       ****
     * array_replace_recursive(
     *      array('Title' => 'Produktname' ),
     *      array('Title' => 'Product name' )
     * )
     * result : array(
     *    'Title' => 'Product name'
     * )
     * @param string $sName
     * @param mixed $mValue
     * @param bool $blForce
     * @return MLRegistry_Abstract
     * @throws MLAbstract_Exception
     */
    public function set($sName, $mValue, $blForce = false) {
        $aTempData = $this->aData;
        $data = 'aData';
        if ($this->blIncludingDefault) {
            $data = 'aDefaultData';
            $aTempData = $this->aDefaultData;
        }

        $this->setTranslationData($sName, $mValue);

        if (strpos($sName,'__')!==false ) {
            $aData = MLHelper::getArrayInstance()->flat2Nested(array($sName => $mValue));
            if (!function_exists('array_replace_recursive')){
                $aTempData = $this->array_replace_recursive($aTempData, $aData);
            }else{
                $aTempData = array_replace_recursive($aTempData, $aData);
            }
        } else {
            if (!isset($aTempData[$sName]) || $blForce) {
                $aTempData[$sName] = $mValue;
            } else {
                throw new $this->sExceptionClass('Value `'.$sName.'` alerady exists.', 1356259108);
            }
        }

        $this->$data = $aTempData;
        return $this;
    }
    
    /**
     * alternative for array_replace_recursive in php < 5.3
     * http://stackoverflow.com/questions/2874035/php-array-replace-recursive-alternative
     * @param array $array
     * @param array $array1
     * @return array
     */
    public function array_replace_recursive($array, $array1) {
        // handle the arguments, merge one by one
        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array)) {
            return $array;
        }
        for ($i = 1; $i < count($args); $i++) {
            if (is_array($args[$i])) {
                $array = $this->recurse($array, $args[$i]);
            }
        }
        return $array;
    }

    /**
     * walk array recursive
     * @param array $array
     * @param array $array1
     * @return array
     */
    protected function recurse($array, $array1) {
        foreach ($array1 as $key => $value) {
            // create new key in $array, if it is empty or not an array
            if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))) {
                $array[$key] = array();
            }

            // overwrite the value in the base array
            if (is_array($value)) {
                $value = $this->recurse($array[$key], $value);
            }
            $array[$key] = $value;
        }
        return $array;
    }

    /**
     * Gets value indicating whether inline translation module is active.
     *
     * @return bool
     */
    public function isTranslationActive()
    {
        return MLSetting::gi()->blTranslateInline;
    }

    /**
     * Sets translation data used in inline translations. Should be called from set method.
     *
     * @param string $sKey Translation key
     * @param string|array $mValue Translation value
     * @param string $sCallingPath If set, path for translation file from which value is being set.
     */
    protected function setTranslationData($sKey, $mValue, $sCallingPath = '')
    {
        if ($this->isTranslationActive()) {
            if (!$sCallingPath) {
                $sCallingPath = $this->findTranslationKeyFile();
            }

            // if $mValue is array, move it to flat and save all generated keys
            if (is_array($mValue)) {
                foreach ($mValue as $key => $value) {
                    $this->setTranslationData($sKey . '__' . $key, $value, $sCallingPath);
                }
            } else {
                $sFixedKey = str_replace(array('__', '.'), '_', $sKey);

                $defaultValue = $mValue;
                if (!$this->blIncludingDefault && (strtolower($this->getLang()) !== strtolower($this->getDefaultLang()))) {
                    $defaultValue = $this->getDefaultValue($sKey, $sCallingPath);
                }

                $translationData = array(
                    'language' => $this->getLang(),
                    'key' => $sKey,
                    'source' => str_replace(MLFilesystem::getLibPath(), '', $sCallingPath),
                    'text' => $mValue,
                    'default_text' => $defaultValue,
                    'missing_key' => false,
                );
                if ($this->blIncludingDefault) {
                    $translationData['missing_key'] = true;
                    $this->aTranslationDefaultData[$sFixedKey] = $translationData;
                } else {
                    $this->aTranslationData[$sFixedKey] = $translationData;
                }
            }
        }
    }

    /**
     * Gets translation data for given translation key.
     *
     * @param string $sKey Translation key
     * @return array
     */
    public function getTranslationData($sKey)
    {
        if (!empty($this->aTranslationData[$sKey])) {
            $this->addTranslationDataPlaceholders($this->aTranslationData[$sKey]);
            return $this->aTranslationData[$sKey];
        }

        if (!empty($this->aTranslationDefaultData[$sKey])) {
            $this->addTranslationDataPlaceholders($this->aTranslationDefaultData[$sKey]);
            return $this->aTranslationDefaultData[$sKey];
        }

        return array();
    }

    private function addTranslationDataPlaceholders(&$translationData)
    {
        if (!isset($translationData['placeholders'])) {
            $translationData['placeholders'] = array();

            $aMatch = array();
            if (preg_match_all('/\{#i18n:\s*(.*)#\}/Uis', $translationData['text'], $aMatch) > 0) {
                foreach ($aMatch[0] as $iI18n => $sSearch) {
                    if (isset($this->aData[$aMatch[1][$iI18n]])) {
                        $translationData['placeholders'][$sSearch] = MLI18n::gi()->get($aMatch[1][$iI18n]);
                    } else {
                        $translationData['placeholders'][$sSearch] = MLI18n::gi()->getDefault($aMatch[1][$iI18n]);
                    }
                }
            }
        }
    }

    /**
     * Getter for default set values, Content can be replaced.
     * @param string $sName
     * @param array $aReplace
     * @return mixed
     * @throws MLAbstract_Exception
     */
    private function getDefault($sName)
    {
        if (isset($this->aDefaultData[$sName])) {
            return $this->replaceDefault($this->aDefaultData[$sName]);
        }

        return $this->replaceDefault($sName);
    }

    /**
     * looks in mdata for {#i18n:i18nkey#} and replace results with $this->getDefault('i18nkey')
     * @param mixed $mData string or array
     * @return mixed
     */
    private function replaceDefault($mData)
    {
        if (is_string($mData)) {
            $aMatch = array();
            if (preg_match_all('/\{#i18n:\s*(.*)#\}/Uis', $mData, $aMatch) > 0) {
                foreach ($aMatch[0] as $iI18n => $sSearch) {
                    $mData = str_replace($sSearch, MLI18n::gi()->getDefault($aMatch[1][$iI18n]), $mData);
                }
            }
        } elseif(is_array($mData)) {
            foreach ($mData as &$mValue) {
                $mValue = $this->replaceDefault($mValue);
            }
        }

        return $mData;
    }

    /**
     * Gets global translation keys for given namespace.
     * This includes messages/text that is not directly displayed on a page but comes from API, marketplace or shop system.
     *
     * @return array
     */
    public function getGlobalTranslationKeys()
    {
        return $this->aGlobalTranslationData;
    }

    /**
     * Sets translation data keys used in inline translations for messages/text that is not directly displayed on a page
     * but comes from API, marketplace or shop system.
     *
     * @param array $aValue Global translation keys to set
    */
    public function setGlobalTranslationData($aValue)
    {
        if ($this->isTranslationActive()) {
            $this->aGlobalTranslationData = $aValue;
        }
    }

    /**
     * Adds translation data keys used in inline translations for messages/text that is not directly displayed on a page
     * but comes from API, marketplace or shop system.
     *
     * @param string $sKey Global translation key namespace
     * @param array $aValue Global translation keys to set
    */
    public function addGlobalTranslationData($aValue)
    {
        if (!$this->isTranslationActive()) {
            return;
        }

        $this->aGlobalTranslationData = array_unique(array_merge($this->aGlobalTranslationData, $aValue));
    }

    /**
     * Gets default value for supplied $key. If not found, tries to load file for default language and reads it.
     *
     * @param string $sKey Translation key
     * @param string $sCallingPath Path to the file containing translation
     * @param bool $blRepeat If set to true, load default file path and try to read value from it.
     *                       Here to break recursion if file is loaded and translation is not found.
     * @return string|null Default translation for given key.
     */
    protected function getDefaultValue($sKey, $sCallingPath, $blRepeat = true)
    {
        if (strpos($sKey, '__')) {
            // nested translation, go through array and find value
            $aKeyParts = explode('__', $sKey);
            $value = $this->aDefaultData;
            foreach ($aKeyParts as $sKeyPart) {
                if (isset($value[$sKeyPart])) {
                    $value = $value[$sKeyPart];
                } else {
                    $value = null;
                    break;
                }
            }
        } else {
            $value = isset($this->aDefaultData[$sKey]) ? $this->aDefaultData[$sKey] : null;
        }

        if ($value === null && $blRepeat) {
            // Default value not found. Maybe file with default translation is not loaded.
            // Load it and it will populate $this->aDefaultData array. Then try getting value again.
            $this->blIncludingDefault = true;
            $sDefaultPath = str_replace('/' . ucfirst($this->getLang()) . '/', '/' . $this->getDefaultLang() . '/', $sCallingPath);
            if (file_exists($sDefaultPath) && $sDefaultPath != $sCallingPath) {
                // including file will trigger set method which will populate $this->aDefaultData array
                // because $this->blIncludingDefault is set to true
                include($sDefaultPath);
            } else {
                $this->blIncludingDefault = false;
                return null;
            }

            $this->blIncludingDefault = false;

            $value = $this->getDefaultValue($sKey, $sCallingPath, false);
        }

        return $value;
    }

    /**
     * Saves new text for translation with specified key from specified file.
     *
     * Translation can be stored in file as a single line with key.
     *   Example: MLI18n::gi()->hitmeister_config_account_title = 'Zugangsdaten';
     *
     * Or it can be nested. This is separated because a key for nested translations is in different format
     * that indicates nesting (double underscore).
     *   Example:
     *     $key = hitmeister_config_account__legend__account
     *   In file:
     *     MLI18n::gi()->add('hitmeister_config_account', array(
     *         'legend' => array(
     *             'account' => 'Account',
     *             'tabident' => ''
     *          ),
     *     ...
     *
     * @param string $path A full path to the translation file
     * @param string $key A key for translation
     * @param string $text New text to save to file.
     * @return bool TRUE if translation successfully updated; otherwise, FALSE
     */
    public function saveTranslation($path, $key, $text, $newKey = false)
    {
        if ($newKey) {
            return $this->insertTranslation($path, $key, $text);
        }

        $key = trim($key);
        $text = $this->prepareTranslationText($text);
        $keyParts = explode('__', $key);
        $source = fopen($path, 'r');
        $temp = fopen($path . '.tmp', 'w');

        $replaced = false;
        $deleteLine = false;
        $currentLevel = 0;
        // depth of nested levels
        $maxLevels = count($keyParts) - 1;
        $possibleSingleLineSetters = array("MLI18n::gi()->{$key}", "MLI18n::gi()->{'{$key}'}");
        while (!feof($source)) {
            $line = fgets($source);
            $trimmedLine = trim($line);
            if (!$replaced) {
                // we must always check for single line translation because of
                //single line cases like "amazon_config_emailtemplate__field__mail.send__label"
                // first split by '=' and then trim first value
                $parts = explode('=', $line);
                if (in_array(trim($parts[0]), $possibleSingleLineSetters)) {
                    $line = sprintf("MLI18n::gi()->{'%s'} = '%s';\n", $key, $text);
                    $deleteLine = substr($trimmedLine, -2) !== "';";
                    $replaced = true;
                }
                if (($maxLevels > 0) && !$replaced) {
                    // nested translation
                    if ($currentLevel === 0 && strstr($line, "MLI18n::gi()->add('{$keyParts[0]}'")) {
                        $currentLevel = 1;
                    } else {
                        if (strpos($trimmedLine, "'{$keyParts[$currentLevel]}'") === 0) {
                            if ($currentLevel < $maxLevels) {
                                $currentLevel++;
                            } else {
                                // add white space at the beginning to keep formatting and append key => value pair
                                $line = str_pad('', $currentLevel * 4, ' ', STR_PAD_LEFT)
                                    . "'{$keyParts[$currentLevel]}' => '$text',\n";
                                $deleteLine = substr($trimmedLine, -2) !== "',";
                                $replaced = true;
                            }
                        }
                    }
                }
            } else if ($deleteLine) {
                $lineEnding = substr($trimmedLine, -2);
                $deleteLine = !in_array($lineEnding, array("';", "',"), true);
                continue;
            }

            fputs($temp, $line);
        }

        fclose($source);
        fclose($temp);

        $replaced ? rename($path . '.tmp', $path) : unlink($path . '.tmp');

        return $replaced;
    }

    public function insertTranslation($path, $key, $text)
    {
        $key = trim($key);
        $text = $this->prepareTranslationText($text);

        $keyParts = explode('__', $key);
        $maxLevels = count($keyParts) - 1;
        $currentLevel = 0;

        if ($maxLevels <= 0) {
            return false !== file_put_contents($path, sprintf("\nMLI18n::gi()->{'%s'} = '%s';\n", $key, $text), FILE_APPEND);
        }

        $insertDone = false;

        $source = fopen($path, 'r');
        $temp = fopen($path . '.tmp', 'w');

        $contentToWrite = '';
        while (!feof($source)) {
            $line = fgets($source);

            if ($insertDone) {
                fputs($temp, $line);
                continue;
            }

            if ($currentLevel === 0 && strstr($line, "MLI18n::gi()->add('{$keyParts[0]}'")) {
                $currentLevel = 1;
            }

            $trimmedLine = trim($line);
            if (strpos($trimmedLine, "'{$keyParts[$currentLevel]}'") === 0) {
                $currentLevel++;
            }

            if (!empty($contentToWrite) && strstr($line, "), false);")) {
                $replace = "'{$keyParts[$currentLevel - 1]}' => array(\n";

                $replaceWith = "{$replace}{#INSERT_POINT#}";
                for ($i = $currentLevel; $i < $maxLevels; $i++) {
                    $padding = str_pad('', $i * 4, ' ', STR_PAD_LEFT);
                    $newValue =  "{$padding}'{$keyParts[$i]}' => array(\n{#INSERT_POINT#}\n{$padding}),\n";
                    $replaceWith = str_replace('{#INSERT_POINT#}', $newValue, $replaceWith);
                }

                $padding = str_pad('', ($maxLevels) * 4, ' ', STR_PAD_LEFT);
                $newValue = "{$padding}'{$keyParts[$maxLevels]}' => '{$text}',";
                $replaceWith = str_replace('{#INSERT_POINT#}', $newValue, $replaceWith);

                $contentToWrite = str_replace($replace, $replaceWith, $contentToWrite);

                fputs($temp, $contentToWrite);

                $contentToWrite = '';
                $currentLevel = 0;
                $insertDone = true;
            }

            if ($currentLevel === 0) {
                fputs($temp, $line);
            } else {
                $contentToWrite .= $line;
            }
        }

        if (!$insertDone) {
            $contentToWrite = "\nMLI18n::gi()->add('$keyParts[0]', array(\n{#INSERT_POINT#}\n), false);";

            for ($i = 1; $i < $maxLevels; $i++) {
                $padding = str_pad('', $i * 4, ' ', STR_PAD_LEFT);
                $newValue =  "{$padding}'{$keyParts[$i]}' => array(\n{#INSERT_POINT#}\n{$padding}),";
                $contentToWrite = str_replace('{#INSERT_POINT#}', $newValue, $contentToWrite);
            }

            $padding = str_pad('', ($maxLevels) * 4, ' ', STR_PAD_LEFT);
            $newValue = "{$padding}'{$keyParts[$maxLevels]}' => '{$text}',";
            $contentToWrite = str_replace('{#INSERT_POINT#}', $newValue, $contentToWrite);

            fputs($temp, $contentToWrite);
        }

        fclose($source);
        fclose($temp);

        return rename($path . '.tmp', $path);
    }

    /**
     * Prepares translation text for saving.
     *
     * @param string $text
     * @return string
     */
    protected function prepareTranslationText($text)
    {
        // be careful for umlauts, special characters HTML tags and quotes
        // umlauts: html_entity_decode
        return html_entity_decode(str_replace("'", "\\'", trim($text)));
    }

    /**
     * @return mixed
     */
    private function findTranslationKeyFile()
    {
        $t = debug_backtrace();
        $sCallingPath = $t[0]['file'];
        foreach ($t as $file) {
            $objectEqualToThis = !empty($file['object']) && (get_class($file['object']) === get_class($this));
            if ($objectEqualToThis && ($file['function'] === 'add' || $file['function'] === '__set')) {
                $sCallingPath = $file['file'];
            }
        }
        return $sCallingPath;
    }

    public function get($sName, $aReplace = array()) {
        $value = parent::get($sName, $aReplace);
        if (MLSetting::gi()->blShowTranslationKeys) {
            if (is_array($value)) {
                $aFlat = array();
                foreach (MLHelper::getArrayInstance()->nested2Flat($value) as $k => $v) {
                    $aFlat[$k] = $sName . '__' . $k;
                }
                return MLHelper::getArrayInstance()->flat2Nested($aFlat);
            } else {
                return $sName;
            }
        } else {
            return $value;
        }
    }
}
