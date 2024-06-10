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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Core_Update_Abstract');
/**
 * puts data from magnalister_amazon_prepare.ApplyData to specific columns and brings images to new format
 */
class ML_Amazon_Update_ApplyDataToColumns extends ML_Core_Update_Abstract {

    protected $aDependOnFields = array(
        'ProductType' => 'MainCategory',
        'BrowseNodes' => 'MainCategory',
        'Attributes' => 'MainCategory',
    );

    protected $aParameters = null;

    protected function applyDataToColumns (&$aPrepareData) {
        if (!array_key_exists('ApplyData', $aPrepareData) || !is_array($aPrepareData['ApplyData'])) {
            return false;
        }
        foreach ($aPrepareData['ApplyData'] as $sItemApplyKey => $mItemApplyValue) {
            if (array_key_exists($sItemApplyKey, $aPrepareData)) {
                if ($sItemApplyKey == 'Images' && is_array($mItemApplyValue)) {
                    $aImages = array();
                    foreach ($mItemApplyValue as $sImagePath => $blActive) {
                        if ($blActive) {
                            $aImages[] = $sImagePath;
                        }
                    }
                    $aPrepareData[$sItemApplyKey] = $aImages;
                } elseif (
                    array_key_exists($sItemApplyKey, $this->aDependOnFields)
                    && array_key_exists($this->aDependOnFields[$sItemApplyKey], $aPrepareData)
                ) {
                    $aPrepareData[$sItemApplyKey] = array((string)$aPrepareData[$this->aDependOnFields[$sItemApplyKey]] => $mItemApplyValue);
                } elseif (!array_key_exists($sItemApplyKey, $this->aDependOnFields)) {
                    $aPrepareData[$sItemApplyKey] = $mItemApplyValue;
                }
            }
        }
        $aPrepareData['ApplyData']['ApplyDataToColums'] = true;
        return true;
    }

    public function execute() {
        if (MLDatabase::getDbInstance()->tableExists('magnalister_amazon_prepare')) {
            $aPrepareDatas = MLDatabase::getDbInstance()->fetchArray("
                 SELECT *
                 FROM  `magnalister_amazon_prepare`
                 WHERE `preparetype` = 'apply'
                   AND `applydata` not like '%\"ApplyDataToColums\":true%' AND `applydata` != '' AND `applydata` != '0'
                 LIMIT 100;
             ");
            if (count($aPrepareDatas) > 0) {
                $this->aParameters = array('again' => true); // found entries
                foreach ($aPrepareDatas as $aPrepareData) {
                    foreach ($aPrepareData as &$mApplyDataColumn) {
                        $mApplyDataColumn = MLHelper::getEncoderInstance()->decode($mApplyDataColumn);
                        unset($mApplyDataColumn);
                    }
                    if ($this->applyDataToColumns($aPrepareData)) {
                        foreach ($aPrepareData as &$mApplyDataColumn) {
                            $mApplyDataColumn = MLHelper::getEncoderInstance()->encode($mApplyDataColumn);
                            unset($mApplyDataColumn);
                        }
                        MLDatabase::getDbInstance()->update(
                            'magnalister_amazon_prepare',
                            $aPrepareData,
                            array(
                                'mpID' => $aPrepareData['mpID'],
                                'ProductsID' => $aPrepareData['ProductsID'],
                                'PrepareType' => $aPrepareData['PrepareType']
                            )
                        );
                    }
                }
            }
        }
        return parent::execute();
    }

    public function getParameters() {
        return $this->aParameters;
    }
}
