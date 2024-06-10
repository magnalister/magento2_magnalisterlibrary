<?php

if (defined('MAGNALISTER_VENDOR_DIRECTORY')) {//used now for Shopware 6
    require_once MAGNALISTER_VENDOR_DIRECTORY.'magnalister/MagnalisterFunctions.php';
} else {
    require_once __DIR__.'/magnalister/MagnalisterFunctions.php';
}