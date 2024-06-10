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
if (!class_exists('ML', false))
    throw new Exception();
?>
<form class="magnalisterForm" action="<?php echo $this->getCurrentUrl() ?>" id="<?php echo strtolower($this->getIdent()) ?>" method="post">
    <div style="display:none">
        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sKey => $sValue) { ?>
            <input type="hidden" name="<?php echo $sKey ?>" value="<?php echo $sValue ?>" />
        <?php } ?>
        <?php foreach ($this->aParameters as $sKey => $sValue) { ?>
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName($sKey) ?>"
                   value="<?php echo MLRequest::gi()->data($sValue);?>" />
        <?php } ?>
    </div>
    <?php //new dBug($this->getNormalizedFormArray(),'',true);?>
    <table class="attributesTable">
        <?php
            foreach ($this->getNormalizedFormArray() as $aFieldset) {
                $sFieldType = isset($aFieldset['type']) ? $aFieldset['type'] : 'fieldset';
                $this->includeView('widget_form_' . $sFieldType, array('aFieldset'=>$aFieldset));
            }
        ?>
    </table>
</form>
<?php
    MLSettingRegistry::gi()->addJs('jquery.magnalister.form.js');
MLSetting::gi()->add('aCss', 'magnalister.form.css?%s', true);