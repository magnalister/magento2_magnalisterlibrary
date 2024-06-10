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
/** @var ML_Hitmeister_Controller_Hitmeister_Prepare_Variations $this */
if (!class_exists('ML', false))
    throw new Exception();
$marketplaceName = MLModule::gi()->getMarketPlaceName();
$aRequestData = MLRequest::gi()->data();
if (isset($aRequestData['action']['deleteaction'])) {
    return;
}

$mParentValue = $this->getRequestField('PrimaryCategory');
if (is_array($mParentValue)) {
    reset($mParentValue);
    $mParentValue = key($mParentValue);
}

// Helper for php8 compatibility - can't pass null to strip_tags 
$mParentValue = MLHelper::gi('php8compatibility')->checkNull($mParentValue);
$blCustom = $mParentValue === 'new' || strpos($mParentValue, ':');

if (!empty($mParentValue) && $mParentValue !== 'none' && !$blCustom) {
    $this->includeView('widget_form_type_variations', array('aField' => $aField));
} else if ($blCustom) {
    $i18n = $this->getFormArray('aI18n');
    $aFieldset = array(
        'id' => $this->getIdent() . '_fieldset_custom_identifier',
        'legend' => array(
            'i18n' => $i18n['legend']['attributes'],
            'template' => 'h4',
        ),
        'row' => array(
            'template' => 'default',
        ),
    );

    $aAttributeName = $this->getField('attributename');
    $aCustomIdent = $this->getField('customidentifier');
    $aDeleteButton = null;
    if (isset($aCustomIdent['value']) && $mParentValue != 'new') {
        $aCustomIdent['type'] = 'hidden';
        $aDeleteButton = $this->getField('deleteaction');
    } else {
        $aCustomIdent['type'] = 'string';
        $this->aFields['customidentifier'] = $aCustomIdent;
    }

    $aFieldset['fields'][] = $aCustomIdent;
    $aFieldset['fields'][] = $aAttributeName;
    if ($aDeleteButton != null) {
        $aFieldset['fields'][] = $aDeleteButton;
    }
    ?>
    <table class="attributesTable">
        <?php $this->includeView('widget_form_fieldset', array('aFieldset' => $aFieldset)); ?>
    </table>
    <?php $this->includeType($this->getField('attributenameajax'));

    if ($aDeleteButton != null) { ?>
        <script type="text/javascript">
            /*<![CDATA[*/
            jqml(document).ready(function() {
                jqml('#<?php echo $aDeleteButton['id'] ?>').click(function() {
                    if (!confirm(unescape('<?php echo html_entity_decode(MLI18n::gi()->get($marketplaceName . '_prepare_match_variations_delete')) ?>'))) {
                        return false;
                    }
                });
            });
            /*]]>*/
        </script>
        <?php
    }
}
