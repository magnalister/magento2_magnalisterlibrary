<?php

foreach ($_GET as $key => $param) {
    if ($key == 'ml') {
        foreach ($_GET['ml'] as $mlKey => $mlParam) {
            $mlDEBUG[$mlKey] = $mlParam;
        }
    }
}
$mlDEBUG['MLDEBUG'] = 'true';