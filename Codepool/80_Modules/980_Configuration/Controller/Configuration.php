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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Configuration_Controller_Configuration extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    protected function isAuthed($aAuthKeys = array()) {
        return true;
    }

    public static function getTabActive() {
        return true;
    }

    public function getValue(&$aField) {
        if (!isset($aField['value'])) {
            $aField['value'] = MLDatabase::factory('config')->set('mkey', $aField['realname'])->set('mpid', 0)->get('value');

        }
    }

    protected function construct() {
        if(
            MLDatabase::factory('config')->isGCConfigured('general.passphrase') &&
            !MLDatabase::factory('config')->isGCConfigured('general.keytype')
        ) {
            MLMessage::gi()->addWarn(MLI18n::gi()->sWarningGlobalConfigurationIsNotConfigured);
        }
        $this->oConfigHelper = MLHelper::gi('model_table_configuration_configdata');
        $this->oConfigHelper
                ->setIdent($this->getIdent())
                ->setRequestFields($this->aRequestFields)
                ->setRequestOptional($this->aRequestOptional)
        ;
        if (MLI18n::gi()->isTranslationActive()) {
            MLI18n::gi()->addGlobalTranslationData(array(
                'form_text_addon_success',
                'form_text_addon_error',
                'ML_GENERIC_STATUS_LOGIN_SAVED',
                'ML_GENERIC_STATUS_LOGIN_SAVEERROR',
                'ML_GENERIC_TESTMAIL_SENT',
                'ML_GENERIC_TESTMAIL_SENT_FAIL',
            ));
        }
    }

    protected function isWizard() {
        return false;
    }

    public function saveAction($blExecute = true) {
        if ($blExecute) {
            try {
                MLShop::gi()->getShopInfo();
                foreach ($this->aRequestFields as $sName => $mValue) {
                    if ($sName == 'general.passphrase') {
                        $mValue = trim($mValue);
                    }
                    MLDatabase::factory('config')->set('mpId', 0)->set('mkey', $sName)->set('value', $this->getField($sName, 'value'))->save();
                    MLMessage::gi()->addSuccess(MLI18n::gi()->ML_TEXT_CONFIG_SAVED_SUCCESSFULLY);
                }
                MLModul::gi()->sendConfigToApi();
            } catch (Exception $ex) {//if authentification is failed, magnalister saves only passphrase 
                    MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.passphrase')->set('value', $this->aRequestFields['general.passphrase'])->save();
            }
            $this->aFields = array();
            return $this;
        } else {
            $translationKey = 'form_action_save';
            return array(
                'aI18n' => array('label' => MLI18n::gi()->get('form_action_save')),
                'aForm' => array(
                    'type' => 'submit',
                    'position' => 'right',
                    'translation_key' => $translationKey,
                    'fieldposition' => array('after' => 1)//keep save button at the right side and reset button before that
                )
            );
        }
    }

    /**
     * This is used to hide reset button on Global Configuration
     */
    public function resetAction($blExecute = true) {
        if ($blExecute) {
            return $this;
        } else {
            return array(
                'aI18n' => array(),
                'aForm' => array()
            );
        }
    }
    
}
