<?php
if (!class_exists('ML', false))
    throw new Exception();
MLSettingRegistry::gi()->addJs(array('jquery.magnalister.form.tabs.js'));
$blActive = false;
if(count($aField['subfields']) > 1){
?><div class="ml-js-tab-container"><?php
    ?><div class="ml-js-tab-container-control"><?php
        foreach ($aField['subfields'] as $aSubfield) {
            ?><a class="mlbtn ml-js-noBlockUi<?php echo $blActive ? '': ' active'; $blActive = true; ?>" href="#tab__<?php echo $aSubfield['id']; ?>" style="border-radius: 3px 3px 0 0;border-bottom:none;"><?php
                echo $aSubfield['i18n']['label'];
            ?></a><?php
        }
    ?></div><?php
    ?><div class="ml-js-tab-container-content" style="border-top:1px solid rgba(0, 0, 0, 0.25);padding-top:.5em;"><?php
        foreach ($aField['subfields'] as $aSubfield) {
            ?><div id="tab__<?php echo $aSubfield['id']; ?>"><?php
                ?><div class="ml-js-toInfo"><?php
                    echo $aSubfield['i18n']['hint'];
                ?></div><?php
                $this->includeType($aSubfield);
            ?></div><?php
        }
    ?></div><?php
?></div><?php
} else {
    $aSubfield = current($aField['subfields']);
    $this->includeType($aSubfield);
}
