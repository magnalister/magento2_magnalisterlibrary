<?php
if (!class_exists('ML', false))
    throw new Exception();
if (isset($aField['i18n']['hint'])) {
    echo $aField['i18n']['hint'];
}
