<?php

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_ListingAbstract');

class ML_Magnalister_Controller_Main_Content_Changelog extends ML_Listings_Controller_Widget_Listings_ListingAbstract {

    protected $aParameters = array('content');
    protected $aPostGet = array();
    protected $aSetting = array();
    protected $aSort = array(
        'type' => null,
        'order' => null
    );
    protected $iOffset = 0;
    protected $aData = array();
    protected $iNumberofitems = 0;
    protected $search = '';
    protected $sCurrency = '';

    public function __construct() {
        parent::__construct();
        $this->setCurrentState();
        $this->aPostGet = MLRequest::gi()->data();
        $this->aSetting['maxTitleChars'] = 40;
        $this->aSetting['itemLimit'] = 50;
        if (array_key_exists('tfSearch', $this->aPostGet) && !empty($this->aPostGet['tfSearch'])) {
            $this->search = $this->aPostGet['tfSearch'];
        }
    }

    public function getUrlParams() {
        return $this->aPostGet;
    }

    public function prepareData() {
        try {
            $request = array(
                'ACTION' => 'GetChangelog',
                'SUBSYSTEM' => 'core',
                'SEARCH' => $this->search,
                'LIMIT' => $this->aSetting['itemLimit'],
                'OFFSET' => $this->iOffset,
                'ORDERBY' => $this->aSort['order'],
                'SORTORDER' => $this->aSort['type']
            );
            $result = MagnaConnector::gi()->submitRequest($request);
            $this->iNumberofitems = (int) $result['NUMBEROFITEMS'];
            $this->aData = isset($result['DATA']) ? $result['DATA'] : false;
        } catch (MagnaException $e) {
            return false;
        }
    }

    public function initAction() {

        MLI18n::gi()->set('ML_LABEL_PRODUCTS', MLi18n::gi()->get('ML_LABEL_CHANGELOG_ITEMS'), true);
        $this->getSortOpt();

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])) {
            $this->iOffset = ($this->aPostGet['page'] - 1) * $this->aSetting['itemLimit'];
        } else {
            $this->iOffset = 0;
        }
    }

    protected function postDelete() { /* Nix :-) */
    }

    protected function isSearchable() {
        return true;
    }

    protected function getFields() {
        return array(
            'thema' => array(
                'Label' => MLi18n::gi()->get('ML_LABEL_CHANGELOG_THEMA'),
                'Sorter' => null,
                'Getter' => null,
                'Field' => 'Title'
            ),
            'project' => array(
                'Label' => MLi18n::gi()->get('ML_LABEL_CHANGELOG_PROJECT'),
                'Sorter' => 'project',
                'Getter' => null,
                'Field' => 'Project',
            ),
            'Revision' => array(
                'Label' => MLi18n::gi()->get('ML_LABEL_CHANGELOG_REVISION'),
                'Sorter' => 'Revision',
                'Getter' => null,
                'Field' => 'Revision',
            ),
            'DateAdded' => array(
                'Label' => MLi18n::gi()->get('ML_LABEL_CHANGELOG_DATE'),
                'Sorter' => 'DateAdded',
                'Getter' => 'parseDate',
                'Field' => 'DateAdded'
            ),
        );
    }

    public function parseDate($date) {
        echo $date;
        return date('Y-m-d', $date);
    }

    protected function getSortOpt() {
        if (isset($this->aPostGet['sorting'])) {
            $sorting = $this->aPostGet['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }
        $sortFlags = array();
        foreach ($this->getFields() as $fieldConfig) {
            if ($fieldConfig['Sorter'] !== null) {
                $sortFlags[$fieldConfig['Sorter']] = $fieldConfig['Field'];
            }
        }
        $order = 'ASC';
        if (strpos($sorting, '-asc') !== false) {
            $sorting = str_replace('-asc', '', $sorting);
        } else if (strpos($sorting, '-desc') !== false) {
            $order = 'DESC';
            $sorting = str_replace('-desc', '', $sorting);
        }

        if (array_key_exists($sorting, $sortFlags)) {
            $this->aSort['order'] = $sortFlags[$sorting];
            $this->aSort['type'] = $order;
        } else {
            $this->aSort['order'] = 'DateAdded';
            $this->aSort['type'] = 'DESC';
        }
    }

    public function getEmptyDataLabel() {
        return (empty($this->search) ? ML_GENERIC_NO_INVENTORY : ML_LABEL_NO_SEARCH_RESULTS);
    }

    protected function getCurrentPage() {
        if (isset($this->aPostGet['page']) && (1 <= (int) $this->aPostGet['page']) && ((int) $this->aPostGet['page'] <= $this->getTotalPage())) {
            return (int) $this->aPostGet['page'];
        }

        return 1;
    }

    protected function getTotalPage() {
        return ceil($this->iNumberofitems / $this->aSetting['itemLimit']);
    }

    public function getData() {
        return $this->aData;
    }

    public function getNumberOfItems() {
        return $this->iNumberofitems;
    }

    public function getOffset() {
        return $this->iOffset;
    }

}
