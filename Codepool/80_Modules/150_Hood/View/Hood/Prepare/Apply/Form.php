<?php
 if (!class_exists('ML', false))
     throw new Exception();
if (!MLHttp::gi()->isAjax()) {
    MLSetting::gi()->add('aCss', 'magnalister.hoodprepareform.css?%s', true);
}

$this->getFormWidget();
