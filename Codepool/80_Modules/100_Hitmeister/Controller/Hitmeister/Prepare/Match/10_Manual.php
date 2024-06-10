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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareAbstract');

class ML_Hitmeister_Controller_Hitmeister_Prepare_Match_Manual extends ML_Form_Controller_Widget_Form_PrepareAbstract {

	public function construct() {
		parent::construct();
                $this->aPostGet = MLRequest::gi()->data();
        $this->oPrepareHelper->bIsSinglePrepare = $this->oSelectList->getCountTotal() === '1';
        $this->oPrepareHelper->oSelectList = $this->oSelectList;
	}

        protected $aPostGet; 
    protected $aParameters = array('controller');

    public function render() {
        ob_start();
        $this->getFormWidget();
        $sHtmlForm = ob_get_contents();
        ob_end_clean();

        $this->renderTitle($this->oPrepareHelper->totalPages, $this->oPrepareHelper->currentPage);
        echo $sHtmlForm;
        return $this;
    }

	public function getRequestField($sName = null, $blOptional = false) {
		if (count($this->aRequestFields) == 0) {
			$this->aRequestFields = $this->getRequest($this->sFieldPrefix);
			$this->aRequestFields = is_array($this->aRequestFields)?$this->aRequestFields:array();
		}

		return parent::getRequestField($sName, $blOptional);
	}

    protected function itemConditionField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetUnitConditions'), 60);
	}

    protected function shippingTimeField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetDeliveryTimes'), 60);
	}

    protected function itemCountryField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetDeliveryCountries'), 60);
	}

    protected function callApi($aRequest, $iLifeTime){
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, $iLifeTime);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            } else {
                return array();
            }
		} catch (MagnaException $e) {
            return array();
		}
    }

    protected function getSelectionNameValue() {
        return 'match';
    }

	protected function triggerBeforeFinalizePrepareAction() {
        $this->oPrepareList->set('subtitle', '');
        $this->oPrepareList->set('description', '');
        $this->oPrepareList->set('preparetype', 'manual');
        $this->oPrepareList->set('verified', 'OK');

        if (isset($this->aPostGet['matching_nextpage'])) {
			$this->oPrepareHelper->currentPage = $this->aPostGet['matching_nextpage'];
		} else {
			$this->oPrepareHelper->currentPage = 1;
		}

        if (isset($this->aPostGet['matching_nextpage'])) {
			$this->oPrepareHelper->totalPages = $this->aPostGet['matching_totalpages'];
		} else {
			$this->oPrepareHelper->totalPages = 1;
		}

        $prepareItems = $this->oPrepareList->getList();
        $newPrepareList = array();
        $aMatching = isset($this->aPostGet['match']) && is_array($this->aPostGet['match']) ? $this->aPostGet['match'] : array();
        foreach ($aMatching as $sProductId => $sItemId) {
            if ($sItemId !== 'false') {
                $prepareItems['['.$sProductId.']']->set('ean', $this->aPostGet['matching'][$sProductId]['ean']);
                $prepareItems['['.$sProductId.']']->set('title', $this->aPostGet['matching'][$sProductId]['title']);
                $newPrepareList['['.$sProductId.']'] = $prepareItems['['.$sProductId.']']->data();
            }
        }

        $this->oPrepareList->reset();

        foreach ($newPrepareList as $value) {
            $this->oPrepareList->add($value);
        }

		if (($this->oPrepareHelper->currentPage !== 'null') && ($this->oPrepareHelper->currentPage - 1 !== $this->oPrepareHelper->totalPages)) {
			return false;
		}

        return true;
    }

    protected function callAjaxItemSearchByTitle() {
        $aProduct = array(
            'Id' => $this->aPostGet['productID'],
            'Results' => $this->oPrepareHelper->searchOnHitmeister($this->aPostGet['search'], 'Title')
        );

        MLSetting::gi()->add('aAjax', $this->getSearchResultsHtml($aProduct));
    }

    protected function callAjaxItemSearchByEAN() {
        $aProduct = array(
            'Id' => $this->aPostGet['productID'],
            'Results' => $this->oPrepareHelper->searchOnHitmeister($this->aPostGet['ean'], 'EAN')
        );

        MLSetting::gi()->add('aAjax', $this->getSearchResultsHtml($aProduct));
    }

    public function getSearchResultsHtml($aProduct) {
        if (!isset($aProduct['Results']) || is_array($aProduct['Results']) === false || count($aProduct['Results']) === 0) {
            $aProduct['Results'] = array();
        }

        $iCheckedProductId = count($aProduct['Results']) > 0 ? $aProduct['Results'][0]['id_item'] : null;

        foreach ($aProduct['Results'] as $aResult) {
            if ($aResult['ean_match'] === true) {
                $iCheckedProductId = $aResult['id_item'];
                break;
            }
        }

        ob_start();
        ?>
        <?php foreach ($aProduct['Results'] as $aResult) : ?>
        <tr class="last">
            <td class="input">
                <input type="radio" name="<?php echo MLHTTP::gi()->parseFormFieldName('match['.$aProduct['Id'].']') ?>" id="match_<?php echo $aProduct['Id'] . '_' . $aResult['id_item'] ?>" value="<?php echo $aResult['id_item'] ?>" data-id="<?php echo $aProduct['Id'] ?>"
                    data-ean="<?php echo reset($aResult['eans']) ?>" <?php echo $iCheckedProductId === $aResult['id_item'] ? 'checked' : '' ?>>
            </td>
            <td class="title">
                <label for="match_<?php echo $aProduct['Id'] . '_' . $aResult['id_item'] ?>" data-id="<?php echo fixHTMLUTF8Entities($aResult['title'], ENT_COMPAT, 'UTF-8') ?>"
                       id="title_match_<?php echo $aProduct['Id'] . '_' . $aResult['id_item'] ?>"><?php echo $aResult['title'] ?></label>
            </td>
            <td class="productGroup">
                <?php echo $aResult['category_name'] ?>
            </td>
            <td class="asin">
                <a href="<?php echo $aResult['url'] ?>" title="<?php echo MLI18n::gi()->get('hitmeister_label_product_at_hitmeister'); ?>" target="_blank" onclick="
                    (function(url) {
                        f = window.open(url, '<?php echo MLI18n::gi()->get('hitmeister_label_product_at_hitmeister'); ?>', 'width=1017, height=600, resizable=yes, scrollbars=yes');
                        f.focus();
                    })(this.href);
                    return false;">
                    <?php echo $aResult['id_item'] ?>
                </a>
            </td>
        </tr>
        <?php endforeach ?>
        <tr class="last noItem">
            <td class="input">
                <input type="radio" name="<?php echo MLHTTP::gi()->parseFormFieldName('match['.$aProduct['Id'].']') ?>" id="match_<?php echo $aProduct['Id'] ?>_false" value="false" <?php echo $iCheckedProductId === null ? 'checked' : '' ?>>
            </td>
            <td class="title italic">
                <label for="match_<?php echo $aProduct['Id'] ?>_false"><?php echo MLI18n::gi()->hitmeister_label_not_matched ?></label>
            </td>
            <td class="productGroup">&nbsp;</td>
            <td class="asin">&nbsp;</td>
        </tr>
        <?php

        $sHtml = ob_get_contents();
        ob_end_clean();

        return $sHtml;
	}

    public function renderDetailView($aProduct) {
		$iWidth = 60;
		$iHeight = 60;
        $sHtml = '';

		ob_start();
		?>

		<table class="matchingDetailInfo">
			<tbody>
			<?php if (empty($aProduct['Manufacturer']) === false) : ?>
				<tr>
					<th class="smallwidth"><?php echo ML_GENERIC_MANUFACTURER_NAME ?>:</th>
					<td><?php echo $aProduct['Manufacturer'] ?></td>
				</tr>
			<?php endif ?>
			<?php if (empty($aProduct['Model']) === false) : ?>
				<tr>
					<th class="smallwidth"><?php echo ML_GENERIC_MODEL_NUMBER ?>:</th>
					<td><?php echo $aProduct['Model'] ?></td>
				</tr>
			<?php endif ?>
			<?php if (empty($aProduct['EAN']) === false || (SHOPSYSTEM != 'oscommerce')) : ?>
				<tr>
					<th class="smallwidth"><?php echo ML_GENERIC_EAN ?>:</th>
					<td><?php echo empty($aProduct['EAN']) === true ? '&nbsp;' : $aProduct['EAN'] ?></td>
				</tr>
			<?php endif ?>
			<?php if (empty($aProduct['Description']) === false) : ?>
                <tr>
                    <td style="border: 2px solid transparent;"></td>
                </tr>
                <tr>
					<th colspan="2"><?php echo ML_GENERIC_MY_PRODUCTDESCRIPTION ?></th>
				</tr>
				<tr  class="desc">
                    <td colspan="2">
                        <div class="mlDesc"><?php echo $aProduct['Description'] ?></div>
                    </td>
				</tr>
			<?php endif ?>
			<?php if (empty($aProduct['Images']) === false) : ?>
				<tr>
					<th colspan="2"><?php echo ML_LABEL_PRODUCTS_IMAGES ?></th>
				</tr>
				<tr class="images">
					<td colspan="2">
						<div class="main">
						<?php foreach ($aProduct['Images'] as $sImagePath) : ?>
							<table>
								<tbody>
									<tr>
										<td style="width: <?php echo $iWidth ?>px; height: <?php echo $iHeight ?>px; display: inline-block;">
											<?php echo $this->getProductImageThumb($sImagePath, $iWidth, $iHeight) ?>
										</td>
									</tr>
								</tbody>
							</table>
						<?php endforeach ?>
						</div>
					</td>
				</tr>
			<?php endif ?>
			</tbody>
		</table>

		<?php
		$sHtml .= ob_get_contents();
		ob_end_clean();

		return json_encode(array(
			'title' => ML_LABEL_DETAILS_FOR . ': ' . $aProduct['Title'],
			'content' => $sHtml,
		));
	}

    private function getProductImageThumb($sImagePath, $iWidth, $iHeight) {
        try {
            $aUrl = MLImage::gi()->resizeImage($sImagePath, 'products', $iWidth, $iHeight);
            return "<img width='$iWidth' height='$iHeight' src='{$aUrl['url']}'>";
        } catch(Exception $e) {
            return 'X';
        }
    }

    public function prepareAction($blExecute = true) {
        if ($blExecute) {
            $aSelectionToDelete =  array();
            try {
                $oProductBackup = $this->oProduct;
                $aCols = array_keys($this->oPrepareList->getModel()->getTableInfo());
                $blError =false;
                foreach ($this->oSelectList->get('pid') as $sProductsId) {
                    try {
                        $this->oProduct = MLProduct::factory()->set('id', $sProductsId);
                        $aSelectionToDelete[] = $sProductsId;
                        if ($this->oProduct->exists()) {
                            $aRow = $this->oPrepareHelper
                                    ->setProduct($this->oProduct)
                                    ->setPrepareList(null)//only values from request, and single entree from db
                                    ->getPrepareData($aCols)
                            ;
                            try {
                                $oCurrentPrepared = $this->oPrepareList->getByKey('[' . $sProductsId . ']');
                                foreach ($aRow as $sField => $aCollumn) {
                                    $oCurrentPrepared->set($sField, $aCollumn['value']);
                                }
                            } catch (Exception $oEx) {
                                $aData = array();
                                foreach ($aRow as $sField => $aCollumn) {
                                    $aData[$sField] = $aCollumn['value'];
                                }
                                $this->oPrepareList->add($aData);
                            }
                        } else {//shop-product dont exists                        
                            try {
                                $this->oPrepareList->getByKey('[' . $sProductsId . ']')->delete();
                            } catch(Exception $oEx) {//already deleted?
                            }
                            try {
                                $this->oSelectList->getByKey('[' . $sProductsId . ']')->delete();
                            } catch(Exception $oEx) {//already deleted?
                            }
                            $blError = true;
                        }
                    } catch(Exception $oEx) {
                        MLMessage::gi()->addDebug($oEx);
                        $blError = true;
                    }
                }
                if ($blError) {
                    $this->oPrepareList->reset();
                    $this->oSelectList->reset();
                }
                $blRedirect = $this->triggerBeforeFinalizePrepareAction();
                if ($this->getRequest('saveToConfig') == 'true' && $blRedirect) {
                    $this->oPrepareHelper->saveToConfig();
                }
                if (method_exists($this->oPrepareList->getModel(), 'getPreparedTimestampFieldName')) {
                    // one request = one timestamp, needed for filtering in productlists
                    $this->oPrepareList->set($this->oPrepareList->getModel()->getPreparedTimestampFieldName(), date('Y-m-d H:i:s'));
                }
                $this->oPrepareList->save();
                $this->aRequestFields = array();
                $this->aRequestOptional = array();
                $this->oProduct = $oProductBackup;
                $this->oPrepareHelper
                    ->setRequestFields($this->aRequestFields)
                    ->setRequestOptional($this->aRequestOptional)
                    ->setPrepareList($this->oPrepareList)
                    ->setProduct($this->oProduct)
                ;
                if ($blRedirect) {
                    MLDatabase::factory('selection')->getList()->getQueryObject()->where('pid in ('.  implode(',', $aSelectionToDelete).')')->doDelete();
                    MLHttp::gi()->redirect($this->getParentUrl());
                }
            } catch(Exception $oEx) {
                MLMessage::gi()->addError($oEx);
            }
            return $this;
        } else {
            $label = MLI18n::gi()->get('form_action_prepare_and_next');
            if ($this->oPrepareHelper->currentPage == $this->oPrepareHelper->totalPages) {
                $label =  MLI18n::gi()->get('form_action_prepare');
            }

            return array(
                'aI18n' => array('label' => $label),
                'aForm' => array(
                    'type' => 'submit',
                    'position' => 'right',
                )
            );
        }
    }

    public function renderTitle($totalPages = 1, $currentPage = 1) {
        $html = '<h2>' . MLI18n::gi()->get(
            $this->oPrepareHelper->bIsSinglePrepare ?
                'Hitmeister_Productlist_Match_Manual_Title_Single' :
                'Hitmeister_Productlist_Match_Manual_Title_Multi'
        );

        if ($totalPages > 1) {
            $html .= '<span class="small right successBox" style="margin-top: -13px; font-size: 12px !important;">
				' . ML_LABEL_STEP . ' ' . $currentPage . ' von ' . $totalPages .
			'</span>';
        }

        $html .= '</h2>';
        echo $html;
    }

}