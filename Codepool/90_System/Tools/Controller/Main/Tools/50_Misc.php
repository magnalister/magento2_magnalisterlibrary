<?php
/**
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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Misc extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');

    protected function getAjaxMethods() {
        $aMethods = array();
        $oReflection = new ReflectionClass($this);
        foreach ($oReflection->getMethods(ReflectionMethod::IS_PROTECTED) as $oReflectionMethod) {
            if (strpos($oReflectionMethod->name, 'callAjax_') === 0) {
                $aMethods[] = substr($oReflectionMethod->name, 9);
            }
        }
        return $aMethods;
    }

    public function callAjaxExecuteMethod() {
        MLSetting::gi()->add('aAjaxPlugin', array(
            'dom' => array(
                '#ml-'.$this->getIdent().' .ml-result-head' => MLRequest::gi()->data('callAjaxMethod').'():',
                '#ml-'.$this->getIdent().' .ml-result-content' => $this->{'callAjax_'.MLRequest::gi()->data('callAjaxMethod')}(),
            ),
        ));
    }

    protected function callAjax_phpinfo() {
        ob_start();
        phpinfo();
        return preg_replace('/.*(<div\sclass\=\"center\">.*<\/div>).*/Uis', '$1', ob_get_clean());
    }

    protected function callAjax_functionsExists() {
        ob_start();
        new dBug(array(
            'bin2hex' => function_exists('bin2hex'),
            'random_bytes' => function_exists('random_bytes'),
            'openssl_random_pseudo_bytes' => function_exists('openssl_random_pseudo_bytes'),
        ), '', true);
        return ob_get_clean();
    }

    protected function callAjax_getCurrencies() {
        ob_start();
        new dBug(MLCurrency::gi()->getList(), '', true);
        return ob_get_clean();
    }

    protected function callAjax_customerodule() {
        $sCustomerFolder = MLFilesystem::getLibPath('Codepool/10_Customer');
        $aCustomerFolder = $this->getDir($sCustomerFolder);
        ob_start();
        echo $sCustomerFolder.'<br />';
        new dBug($aCustomerFolder, '', true);
        return ob_get_clean();
    }

    protected function getDir($sFolder) {
        $aOut = array();
        if (is_readable($sFolder)) {
            foreach (MLFilesystem::glob($sFolder.'/*') as $sPath) {
                if (is_readable($sPath)) {
                    $sPath = realpath($sPath);
                    $sRealPath = basename($sPath);
                    if (is_dir($sPath)) {
                        $aOut[$sRealPath] = $this->getDir($sPath);
                    } else {
                        $aOut[$sRealPath] = '<pre>'.htmlentities(file_get_contents($sPath), ENT_IGNORE).'</pre>';
                    }
                }
            }
        }
        return $aOut;
    }

    protected function callAjax_fixCollations() {
        $oMlDb = MLDatabase::getDbInstance();

        $tbls = $oMlDb->getAvailableTables();
        if (empty($tbls)) {
            MLMessage::gi()->addWarn('
			<h2>Fix Collations &mdash; No tables found</h2>
			<p>No tables found...</p>');
        } else {
            $magnaTables = array();
            foreach ($tbls as $tbl) {
                if (strpos($tbl, 'magnalister_') === false) {
                    continue;
                }
                $magnaTables[] = $tbl;
            }
            $aConnectionInfo = MLShop::gi()->getDbConnection();
            $sDBName = $aConnectionInfo['database'];
            $aCollationTableInfo = MLShop::gi()->getDBCollationTableInfo();

            $collation = $oMlDb->fetchRow(eecho('
                SELECT `CHARACTER_SET_NAME`, `COLLATION_NAME`
                  FROM `information_schema`.`COLUMNS`
                 WHERE TABLE_SCHEMA=\''.$sDBName.'\' 
                       AND TABLE_NAME=\''.$aCollationTableInfo['table'].'\'
                       AND COLUMN_NAME=\''.$aCollationTableInfo['field'].'\'
            ', false));

            if (!is_array($collation) || empty($collation)) {
                MLMessage::gi()->addWarn('
			<h2>Fix Collations &mdash; Failed to get default collation</h2>
			<p>The collation for the shop database '.$sDBName.' could not be read.</p>');
                return;
            }
            MLMessage::gi()->addInfo('shop database collation', $collation);
            $errors = array();
            $_timer = microtime(true);
            foreach ($magnaTables as $tbl) {
                @set_time_limit(60);
                $res = $oMlDb->fetchArray('
			SELECT `COLUMN_NAME`, `COLUMN_DEFAULT`, `IS_NULLABLE`, `COLUMN_TYPE`, `CHARACTER_SET_NAME`, `COLLATION_NAME`
			  FROM `information_schema`.`COLUMNS`
			 WHERE TABLE_SCHEMA=\''.$sDBName.'\' 
			       AND TABLE_NAME=\''.$tbl.'\'
			       AND COLLATION_NAME IS NOT NULL
		');
                if (empty($res)) {
                    continue;
                }
                foreach ($res as $col) {
                    $col['COLUMN_DEFAULT_ORG'] = $col['COLUMN_DEFAULT'];
                    $col['COLUMN_DEFAULT'] = ltrim($col['COLUMN_DEFAULT'], "'");
                    $col['COLUMN_DEFAULT'] = rtrim($col['COLUMN_DEFAULT'], "'");
                    if (($col['COLUMN_DEFAULT'] === null || $col['COLUMN_DEFAULT'] === "NULL" || $col['COLUMN_DEFAULT_ORG'] === "") && ($col['IS_NULLABLE'] == 'NO')) {
                        $append = 'NOT NULL';
                    } else if (($col['COLUMN_DEFAULT'] === null || $col['COLUMN_DEFAULT'] === "NULL" || $col['COLUMN_DEFAULT_ORG'] === "") && ($col['IS_NULLABLE'] == 'YES')) {
                        $append = 'DEFAULT NULL';
                    } else if (($col['COLUMN_DEFAULT'] !== null && $col['COLUMN_DEFAULT'] !== "NULL") && ($col['IS_NULLABLE'] == 'NO')) {
                        $append = 'NOT NULL DEFAULT \''.$col['COLUMN_DEFAULT'].'\'';
                    } else if (($col['COLUMN_DEFAULT'] !== null && $col['COLUMN_DEFAULT'] !== "NULL") && ($col['IS_NULLABLE'] == 'YES')) {
                        $append = 'DEFAULT \''.$col['COLUMN_DEFAULT'].'\'';
                    } else {
                        $append = '';
                        $errors[] = 'Unable to determine DEFAULT for table `'.$tbl.'` column '.$col['COLUMN_NAME'].'.';
                    }
                    if (!empty($append)) {
                        $query = '
                            ALTER TABLE `'.$tbl.'` CHANGE `'.$col['COLUMN_NAME'].'` `'.$col['COLUMN_NAME'].'` '.$col['COLUMN_TYPE'].' 
                                CHARACTER SET '.$collation['CHARACTER_SET_NAME'].' COLLATE '.$collation['COLLATION_NAME'].' '.$append;
                        if (!$oMlDb->query($query)) {
                            $errors[] = 'Failed to fix table `'.$tbl.'` column '.$col['COLUMN_NAME'].'.'."\n".$query."\n".var_dump_pre($col, '$col');
                        }
                    }
                }
                $query = 'ALTER TABLE `'.$tbl.'` DEFAULT CHARACTER  SET '.$collation['CHARACTER_SET_NAME'].' COLLATE '.$collation['COLLATION_NAME'];
                if (!$oMlDb->query($query)) {
                    $errors[] = 'Failed to fix charset of table `'.$tbl.'.';
                }
            }
//            $query = 'ALTER DATABASE `' . $sDBName . '` DEFAULT CHARACTER SET ' . $collation['CHARACTER_SET_NAME'] . ' COLLATE ' . $collation['COLLATION_NAME'];
//            if (!$oMlDb->query($query)) {
//                $errors[] = 'Failed to fix charset of database `' . $sDBName . '.';
//            }

            $time = microtime2human(microtime(true) - $_timer);

            if (empty($errors)) {
                MLMessage::gi()->addSuccess('
			<h2>Collations fixed</h2>
			<p>All collations have been successfully fixed.</p><p>Time used: '.$time.'</p>');
            } else {
                MLMessage::gi()->addError('
			<h2>Error</h2>
			<p>Some errors occured. Please contact the magnalister support team.</p>
			<ul><li>'.implode('</li><li>', $errors).'</li></ul>
			<p>Time used: '.$time.'</p>');
            }
        }
    }

}
