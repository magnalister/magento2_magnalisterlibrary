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
    <div style="float:right;margin:.5em; margin-bottom:1.57em;">
        <?php $this->includeType(array('type' => 'reset', 'i18n' => array('label' => MLI18n::gi()->get('ML_BUTTON_RESTORE_DEFAULTS')))); ?>
        &nbsp;
        <?php $this->includeType(array('type' => 'submit', 'id' => $aField['id'].'_testmail', 'name' => 'action[testmailaction]','i18n' => array('label' => MLI18n::gi()->form_config_send_mailcontentcontailner_testmail))); ?>
    </div>
<?php
$aField['type'] = 'wysiwyg';
$this->includeType($aField);