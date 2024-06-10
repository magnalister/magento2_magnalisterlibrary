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

class ML_Base_Model_Table_Image extends ML_Database_Model_Table_Abstract {

    protected $sTableName = 'magnalister_image';
    
    protected $aFields = array(
        'sourceMd5' => array(
            'isKey' => true,
            'Type' => 'varchar(32)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => '',
        ),
        'destinationMd5' => array(
            'isKey' => true,
            'Type' => 'varchar(32)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => '',
        ),
        'skipCheck' => array(
            'Type' => 'tinyint(1)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0', 'Extra' => '', 'Comment' => '',
        ),
        'sourcePath' => array(
            'Type' => 'varchar(1024)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => '',
        ),
        'sourceDateCreated' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'sourceDateModified' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'sourceFileSize' => array(
            'Type' => 'int(10)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
        'destinationPath' => array(
            'Type' => 'varchar(1024)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => '',
        ),
        'destinationDateCreated' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'destinationDateModified' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'destinationFileSize' => array(
            'Type' => 'int(10)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
    );
    
    protected $aTableKeys = array(
        'UniqueKey' => array('Non_unique' => '0', 'Column_name' => 'sourceMd5, destinationMd5'),
    );

    protected function setDefaultValues() {
        return $this;
    }
    
    public function set($sName, $mValue) {
        if (in_array(strtolower($sName), array('sourcepath', 'destinationpath'))) {
            if (strtolower($sName) == 'sourcepath') {
                $this->set('sourcemd5', md5($mValue));
            } elseif (strtolower($sName) == 'destinationpath') {
                $this->set('destinationmd5', md5($mValue));
            }
        }
        return parent::set($sName, $mValue);
    }
    
    public function destinationIsActual($blSave = false) {
        $sSrc = $this->get('sourcePath');
        $sDst = $this->get('destinationPath');
        $blSkip = $this->get('skipCheck');
        $this->aOrginData = array();
        $this->aData = array();
        $this->blLoaded = null;
        $this
            ->set('sourcePath', $sSrc)
            ->set('destinationPath', $sDst)
            ->set('skipCheck', $blSkip)
            ->load()
        ;
        if (file_exists($sSrc)) {
            $this
                ->set('sourceDateCreated', date('Y-m-d H:i:s', filemtime($sSrc)))
                ->set('sourceDateModified', date('Y-m-d H:i:s', filectime($sSrc)))
                ->set('sourceFileSize', filesize($sSrc))
            ;
        }
        if (file_exists($sDst)) {
            $this
                ->set('destinationDateCreated', date('Y-m-d H:i:s', filemtime($sDst)))
                ->set('destinationDateModified', date('Y-m-d H:i:s', filectime($sDst)))
                ->set('destinationFileSize', filesize($sDst))
            ;
            $blActual = !$this->isChanged();
        } else {
            $blActual = false;
        }
        if ($blActual) {
            $blSkip = 0;
            $this->set('skipCheck', 0);
        }
        if ($blSave) {
            $this->set('skipCheck', $blSkip === null ? 0 : $blSkip);
            $this->save();
        }
        return $blActual;
    }

}
