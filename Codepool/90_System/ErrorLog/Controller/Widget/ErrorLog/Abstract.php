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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_ListingAbstract');

class ML_ErrorLog_Controller_Widget_ErrorLog_Abstract extends ML_Listings_Controller_Widget_Listings_ListingAbstract {

    protected $aParameters = array('controller');
    protected $sMarketplace = '';
    protected $aSetting = array();
    protected $aPostGet = array();
    protected $aData = array();
    protected $sCurrency = '';
    protected $iNumberOfItems = 0;
    protected $offset = 0;
    protected $iPages = 0;
    protected $iCurrentPage = 0;
    protected $aSort = array();
    protected $sSearch = '';
    protected $blDeleteAction = false;

    public function __construct() {
        parent::__construct();
        $this->setCurrentState();
        $aConfig = MLModule::gi()->getConfig();
        $this->aPostGet = MLRequest::gi()->data();
        $this->sMarketplace = MLModule::gi()->getMarketPlaceName();
        $this->aSetting['maxTitleChars'] = 40;
        $this->aSetting['itemLimit'] = 50;
        $this->aSetting['language'] = $aConfig['lang'];
        $this->sCurrency = $aConfig['currency'];
    }

    public function initAction() {
        if (isset($this->aPostGet['action'])) {
            if(in_array($this->aPostGet['action'], array('deleteall','delete'), true)){
                $this->blDeleteAction = true;
            }
            if (method_exists($this, 'action'.$this->aPostGet['action'])) {
                $this->{'action'.$this->aPostGet['action']}();
            }
        }
        $this->getSortOpt();
    }

    public function actionDelete() {
        if (!empty($this->aPostGet['ids']) && is_array($this->aPostGet['ids'])) {
            foreach ($this->aPostGet['ids'] as $id) {
                $ids[] = (int)$id;
            }

            $ids = array_unique($ids);
            MLDatabase::getDbInstance()->query("
                DELETE FROM ".TABLE_MAGNA_ERRORLOG."
                      WHERE id IN ('".implode("', '", $ids)."')
            ");
        }
    }

    public function actionDeleteAll() {
        $oErrorLogList = MLErrorLog::gi()->init(true)->getList();
        $oSelect = $oErrorLogList->getQueryObject();
        $oSelect->doDelete();
    }

    public function prepareData() {
        $this->importErrorLog();
        $oErrorlogList = MLErrorLog::gi()->init(true)->getList();
        $oSelect = $oErrorlogList->getQueryObject();

        if (array_key_exists('tfSearch', $this->aPostGet) && !empty($this->aPostGet['tfSearch'])) {
            $this->sSearch = $this->aPostGet['tfSearch'];
            $oSelect->where("`data` LIKE '%".$this->sSearch."%' OR `errormessage` LIKE '%".$this->sSearch."%'");
        }

        $this->iNumberOfItems = (int)$oSelect->getCount();
        $this->iPages = ceil($this->iNumberOfItems / $this->aSetting['itemLimit']);
        $this->iCurrentPage = 1;

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page']) && (1 <= (int)$this->aPostGet['page']) && ((int)$this->aPostGet['page'] <= $this->iPages)) {
            $this->iCurrentPage = (int)$this->aPostGet['page'];
        }

        $this->offset = ($this->iCurrentPage - 1) * $this->aSetting['itemLimit'];
        $oErrorlogList->getQueryObject()->limit($this->offset, $this->aSetting['itemLimit'])->orderBy(" {$this->aSort['order']} {$this->aSort['type']} ");
        $this->aData = $oErrorlogList->getList();
    }

    public function getFields() {
        return array(
            'SKU' => array(
                'Label' => MLI18n::gi()->get('ML_AMAZON_LABEL_ADDITIONAL_DATA'),
                'Sorter' => 'products_model',
                'Field' => 'SKU',
            ),
            'ErrorMessage' => array(
                'Label' => MLI18n::gi()->get('ML_GENERIC_ERROR_MESSAGES'),
                'Sorter' => 'errormessage',
                'Field' => 'errormessage',
            ),
            'DateAdded' => array(
                'Label' => MLI18n::gi()->get('ML_LABEL_CHANGELOG_DATE'),
                'Sorter' => 'dateadded',
                'Field' => 'dateadded',
            ),
        );
    }

    /**
     * Returns the Marketplace Title
     *
     * @return mixed|string
     */
    public function getShopTitle() {

        try {
            $aModules = MLSetting::gi()->get('aModules');
            if (isset($aModules[$this->sMarketplace]['title'])) {
                $title = $aModules[$this->sMarketplace]['title'];
            } elseif (!isset($aModules[$this->sMarketplace]['settings']['subsystem'])) {
                throw new Exception;
            } else {
                $title = $aModules[$this->sMarketplace]['settings']['subsystem'];
            }
            return $title;
        } catch (Exception $exc) {
            return $this->sMarketplace;
        }
    }

    public function getErrorLogWidget() {
        $this->includeView('widget_errorlog_errorlog', get_defined_vars());
    }

    public function getData() {
        return $this->aData;
    }

    public function getNumberOfItems() {
        return $this->iNumberOfItems;
    }

    public function getOffset() {
        return $this->offset;
    }

    protected function getSortOpt() {
        $sorting = isset($this->aPostGet['sorting']) ? $this->aPostGet['sorting'] : '';
        $order = 'DESC';
        if (strpos($sorting, '-asc') !== false) {
            $order = 'ASC';
            $sorting = str_replace('-asc', '', $sorting);
        } else if (strpos($sorting, '-desc') !== false) {
            $sorting = str_replace('-desc', '', $sorting);
        } else {
            // Show error log by date added as default
            $sorting = 'dateadded';
        }

        $this->aSort['order'] = $sorting;
        $this->aSort['type'] = $order;
    }

    protected function isSearchable() {
        return true;
    }

    protected function getCurrentPage() {
        return $this->iCurrentPage;
    }

    protected function getTotalPage() {
        return $this->iPages;
    }

    public function getEmptyDataLabel() {
        return 'ML_GENERIC_NO_ERRORS_YET';
    }

    public function getSKU($oErrorlog) {
        $oProduct = null;
        $aData = $oErrorlog->get('data');
        $sSku = '';
        if (isset($aData['SKU']) && $aData['SKU'] != '') {
            $sSku = $aData['SKU'];
        } else if ($oErrorlog->get('products_model') != '') {
            $sSku = $oErrorlog->get('products_model');
        }
        if ($sSku != '') {
            $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku);
            if (!$oProduct->exists()) {
                $oProduct = null;
            }
        }
        $this->includeView('widget_errorlog_cell_maindata', array('oErrorlog' => $oErrorlog, 'oProduct' => $oProduct));
    }

    protected function importErrorLog() {
        $begin = MLModule::gi()->getConfig('errorlog.lastdate');
        if($this->blDeleteAction){// if user is trying to delete error, means he received all errors, we don't need to get older errors
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('Europe/Berlin'));
            $begin = $now->format('Y-m-d H:i:s');
        } else {
            if ($begin === false || $begin === null) {
                $begin = time() - 60 * 60 * 24 * 12;
            } else {
                $begin = strtotime($begin.' +0000') + 1;
            }

            $begin = gmdate('Y-m-d H:i:s', max($begin, time() - 60 * 60 * 24 * 12));
        }

        $request = array(
            'ACTION' => 'GetErrorLogForDateRange',
            'BEGIN' => $begin,
            'OFFSET' => array(
                'COUNT' => 1000,
                'START' => 0
            ),
        );
        #echo print_m($request, '$request');
        try {
            $result = MagnaConnector::gi()->submitRequest($request);
        } catch (MagnaException $e) {
            $result['DATA'] = array();
        }
        #echo print_m($result, '$result');
        #return;
        $newbegin = '';
        if (array_key_exists('DATA', $result) && !empty($result['DATA'])) {
            foreach ($result['DATA'] as $item) {
                $this->processErrorAdditonalData($item);
                $marketplaceId = array_key_exists('MarketplaceId', $item) ? $item['MarketplaceId'] : $item['MpId'];
                $data = array(
                    'mpID' => $marketplaceId,
                    'BatchId' => !empty($item['BatchId']) ? $item['BatchId'] : null,
                    'products_id' => isset($item['ErrorData']['SKU']) ? magnaSKU2pID($item['ErrorData']['SKU']) : 0,
                    'products_model' => isset($item['ErrorData']['SKU']) ? $item['ErrorData']['SKU'] : '',
                    'dateadded' => $item['DateAdded'],
                    'errormessage' => $item['ErrorMessage'],
                    'errorrecommendation' => isset($item['ErrorRecommendation']) ? $item['ErrorRecommendation'] : '',
                    'data' => json_encode($item['ErrorData']),
                );
                $sMd5 = md5(json_encode($data));
                $data['md5'] = $sMd5;
                if (!MLDatabase::getDbInstance()->recordExists(TABLE_MAGNA_ERRORLOG, array('md5' => $sMd5))) {
                    MLDatabase::getDbInstance()->insert(TABLE_MAGNA_ERRORLOG, $data, true);
                }
                if ($begin < $item['DateAdded']) {
                    $begin = $item['DateAdded'];
                }
            }
            $newbegin = $item['DateAdded'];
        }
        if (!empty($newbegin)) {
            MLModule::gi()->setConfig('errorlog.lastdate', $begin);
        }
    }

    /**
     * @todo in V3 dont use serialize please use/create model for this table and just use save function (it uses json_encode).
     *       also extend data-field there are already keys existing like MOrderID, we need it for sync orders
     *       and test it, in shopadmin order view magnalister-tab
     */
    protected function processErrorAdditonalData(&$item) {
        //        $data = $item['ErrorData'];
        //		if (isset($data['MOrderID'])) {
        //			$o = MLDatabase::getDbInstance()->fetchOne('
        //				SELECT data FROM ' . TABLE_MAGNA_ORDERS . '
        //				WHERE special=\''.MLDatabase::getDbInstance()->escape($data['MOrderID']).'\'
        //			');
        //			if ($o === false) return;
        //			$o = @unserialize($o);
        //			if (!is_array($o)) {
        //				$o = array();
        //			}
        //			$o['ML_ERROR_LABEL'] = 'ML_GENERIC_ERROR_ORDERSYNC_FAILED';
        //			#echo print_m($o);
        //			$o = serialize($o);
        //			MLDatabase::getDbInstance()->update(TABLE_MAGNA_ORDERS, array('data' => $o), array('special' => $data['MOrderID']));
        //		}
    }
}
