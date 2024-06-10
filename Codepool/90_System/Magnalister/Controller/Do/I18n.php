<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract') ;

class ML_Magnalister_Controller_Do_I18n extends ML_Core_Controller_Abstract {
    public function callAjaxSave()
    {
        $translation = $this->getRequest('translation');
        $source = isset($translation['source']) ? $translation['source'] : false;
        $key = isset($translation['key']) ? $translation['key'] : false;
        $missingKey = isset($translation['missing_key']) ? ('true' === $translation['missing_key']) : false;
        $text = isset($translation['text']) ? $translation['text'] : false;
        $text = html_entity_decode($text);

        if (!$source || !$key || !$text) {
            MLSetting::gi()->add('aAjax', array(
                'success' => false,
                'error' => 'missing params',
            ));
        } else {
            $source = MLFilesystem::getLibPath($source);
            MLSetting::gi()->add('aAjax', array(
                'success' => MLI18n::gi()->saveTranslation($source, $key, $text, $missingKey),
            ));
        }

        return $this;
    }
}
