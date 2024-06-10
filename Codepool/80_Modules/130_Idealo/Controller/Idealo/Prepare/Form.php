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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareAbstract');

class ML_Idealo_Controller_Idealo_Prepare_Form extends ML_Form_Controller_Widget_Form_PrepareAbstract {

    protected $aParameters = array('controller');

    protected function getSelectionNameValue() {
        return 'match';
    }

    protected function setPreparedStatus($verified, $productIDs = array()) {
        $this->oPrepareList->set('iscomplete', $verified ? 'true' : 'false');
    }

    protected function paymentMethodField(&$aField) {
        $request = MLRequest::gi()->data();
        // check if form was saved or if it was inital load
        if(isset($request['field']) && !isset($request['field']['paymentmethod'])) {
            $aField['required'] = true;
            MLMessage::gi()->addError($this->__('ML_AMAZON_TEXT_APPLY_DATA_INCOMPLETE'));
        }
    }

    protected function triggerBeforeFinalizePrepareAction() {
        $blReturn = true;
        $aActions = $this->getRequest($this->sActionPrefix);
        $savePrepare = $aActions['prepareaction'] === '1';
        $request = MLRequest::gi()->data();

        $sMessage = '';
        $oddEven = true;
        $i = 0;
        foreach ($this->oPrepareList->getList() as $oPrepared) {
            $this->oProduct = MLProduct::factory()->set('id', $oPrepared->get('products_id'));
            $aMissingValues = array();
            foreach (array(
                         MLI18n::gi()->get('ML_LABEL_MARKETPLACE_PAYMENT_METHOD') => 'paymentmethod',
                     ) as $sMissingText => $sFieldName) {
                $mValue = $oPrepared->get($sFieldName);
                if (empty($mValue) || !isset($request['field'][$sFieldName])) {
                    $blReturn = false;
                    $aMissingValues[] = $sMissingText;
                }
            }

            if (!empty($aMissingValues)) {
                $this->setPreparedStatus(false);
            }

            if (!empty($aMissingValues) && $i <= 20) {
                $sMessage .= '
                    <tr class="'.(($oddEven = !$oddEven) ? 'odd' : 'even') . '">
                        <td>' . $this->oProduct->get('id') . '</td>
                        <td>' . $this->oProduct->getMarketPlaceSku() . '</td>
                        <td>' . $this->oProduct->getName() . '</td>
                        <td>' . implode(', ', $aMissingValues) . '</td>
                    </tr>
                ';
            } elseif(!empty($aMissingValues) && $i == 21) {
                $sMessage .= '
                    <tr class="' . (($oddEven = !$oddEven) ? 'odd' : 'even') . '">
                        <td colspan="5" class="textcenter bold">&hellip;</td>
                    </tr>
                ';
            }

            ++$i;
        }


        if ($savePrepare && !empty($sMessage)) {
            $sMessage = '
                <table class="datagrid">
                    <thead>
                        <tr>
                            <th>' . $this->__('ML_LABEL_PRODUCTS_ID') . '</th>
                            <th>' . $this->__('ML_LABEL_ARTICLE_NUMBER') . '</th>
                            <th>' . $this->__('ML_LABEL_PRODUCT_NAME') . '</th>
                            <th>' . $this->__('ML_AMAZON_LABEL_MISSING_FIELDS') . '</th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $sMessage . '
                    </tbody>
                </table>
            ';
            MLMessage::gi()->addWarn($sMessage);
        }


        if ($savePrepare) {
            $this->oPrepareList->set('applydata', '');
        }

        if($savePrepare && empty($sMessage)) {
            $this->oPrepareList->set('verified', 'OK');
        }

        return $blReturn;
    }

    public function render() {
        $this->getFormWidget();
        return $this;
    }

    protected function shippingTimeField(&$aField) {
        // set key to value.title
        foreach ($aField['subfields']['select']['i18n']['values'] as $sKey => $sValue) {
            if ($sKey === '__ml_lump') {
                $aField['subfields']['select']['values'][$sKey] = array(
                    'textoption' => true,
                    'title'      => $sValue['title'],
                );
            } else {
                $aField['subfields']['select']['values'][$sValue['title']] = $sValue['title'];
            }
        }
    }

    protected function shippingCountryField(&$aField) {
        $aField['values'] = array();
        try {
            $aData = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION'    => 'GetCountries',
                'SUBSYSTEM' => 'Core',
                'DATA'      => array(
                    'Language' => MLModul::gi()->getConfig('marketplace.lang')
                )
            ), 60 * 60 * 24 * 30);
            if ($aData['STATUS'] == 'SUCCESS' && isset($aData['DATA'])) {
                $aField['values'] = $aData['DATA'];
            }
        }  catch (Exception $oEx){}

    }
}
