<?php
if (!defined('KINT_DIR')) {// decompressed version of kint can make problems with opcache so compressed version is in 10_customer/core and KINT_DIR is defined
    if (defined('MAGNALISTER_VENDOR_DIRECTORY')) {//used now for Shopware 6
        require_once MAGNALISTER_VENDOR_DIRECTORY.'Kint/Kint.php';
    } else {
        require_once __DIR__.'/Kint/Kint.php';
    }
}