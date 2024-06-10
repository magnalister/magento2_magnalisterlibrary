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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

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
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php
if(!isset($sClass)){
    $sClass = '';
}
    if(!isset($aField['id'])){
        return;
    }
    if(isset($aField['type'])){
        if (
                (
                    isset($aField[$aField['type']]) 
                    && !isset($aField[$aField['type']]['field']['type'])
                )
                ||
                $aField['type']==='hidden'
                ||
                (empty($aField['multiprepareonlyswitch']) && isset($aField['singleproduct']) && $aField['singleproduct'] && $this->oProduct == null)

        ) {
            $blDisplay=false;
        } else {
            $blDisplay=true;
        }
    }else{
        $blDisplay=false;
    }
    $blShowTitle = !array_key_exists('fullwidth', $aField) || $aField['fullwidth'] == false;
    $blShowDescription = !array_key_exists('showdesc', $aField) || $aField['showdesc'] == true;
    if ($blShowTitle && $blShowDescription) {
        $aColumnDefinations = array(
            'column1' => array('element' => 'th', 'attributes' => array(
                'class' => 'ml-translate-toolbar-wrapper',
            )),
            'column2' => array('element' => 'td', 'attributes' => array(
                'class' => 'mlhelp ml-js-noBlockUi ml-translate-toolbar-wrapper'
             )),
            'column3'  => array('element' => 'td', 'attributes' => array(
                'class' => 'input',
            )),
            'column4' => array('element' => 'td', 'attributes' => array(
                'class' => 'info ml-translate-toolbar-wrapper'.(empty($translationData['hint']['missing_key']) ? '' : ' missing_translation')
            )),//desc
        );
    } elseif($blShowTitle && !$blShowDescription) {
        $aColumnDefinations = array(
            'column1'  => array('element' => 'th', 'attributes' => array(
                'class' => 'ml-translate-toolbar-wrapper'
            )),
            'column2' => array('element' => 'td', 'attributes' => array(
                'class' => 'mlhelp ml-js-noBlockUi ml-translate-toolbar-wrapper'
            )),
            'column3' => array('element' => 'td', 'attributes' => array(
                'class' => 'input', 
                'colspan' => 2
            )),
            'column4' => array(),
        );
    } elseif (!$blShowTitle && $blShowDescription) {
        $aColumnDefinations = array(
            'column1' => array(),
            'column2' => array(),
            'column3'  => array('element' => 'th', 'attributes' => array(
                'class' => 'input', 
                'colspan' => 3,
            )),
            'column4' => array('element' => 'td', 'attributes' => array(
                'class' => 'info ml-translate-toolbar-wrapper'.(empty($translationData['hint']['missing_key']) ? '' : ' missing_translation')
           )),
        );
    } elseif (!$blShowTitle && !$blShowDescription) {
        $aColumnDefinations = array(
            'column1'  => array(),
            'column2' => array(),
            'column3'  => array('element' => 'th', 'attributes' => array(
                'class' => 'input', 
                'colspan' => 4,
                'style' => 'border-right: 1px solid #747474;',
            )),
            'column4' => array(),
        );
    }

$translationData = array(
    'label' => array(),
    'help' => array(),
    'hint' => array(),
);
if(MLI18n::gi()->isTranslationActive()) {
    try{
        MLSetting::gi()->get('blFormWysiwigLoaded');
    }catch(Exception $oEx){
        MLSetting::gi()->set('blFormWysiwigLoaded',true);
        MLSettingRegistry::gi()->addJs(array('tiny_mce/tiny_mce.js','jquery.magnalister.form.wysiwyg.js'));
        ?>
        <script type="text/javascript">/*<![CDATA[*/
            <?php echo getTinyMCEDefaultConfigObject(); ?>;
            /*]]>*/</script>
        <?php
    }

    $translationData = array(
        'label' => MLI18n::gi()->getTranslationData($aField['id'] . '_label'),
        'help' => MLI18n::gi()->getTranslationData($aField['id'] . '_help'),
        'hint' => MLI18n::gi()->getTranslationData($aField['id'] . '_hint'),
    );
}
?>
<tr class="js-field <?php echo $sClass.(isset($aField['classes']) ? ' '.implode(' ', $aField['classes']) : ''); ?>"<?php echo $blDisplay?'':' style="display:none"' ?>>
    <?php
        foreach ($aColumnDefinations as $sColumnName => $aColumnDefination) {
            if (!empty($aColumnDefination)) {
                ?><<?php echo $aColumnDefination['element']; foreach($aColumnDefination['attributes'] as $sAttribteName => $sAttributeValue) {echo ' '.$sAttribteName.'="'.$sAttributeValue.'"';} ?>><?php
                $this->includeView('widget_form_field_' . $sColumnName, array('aField' => $aField, 'translationData' => $translationData));
                ?></<?php echo $aColumnDefination['element']; ?>><?php
            }
        }
    ?>
</tr>