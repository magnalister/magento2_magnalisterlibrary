<?php
/*
 * This class will be overwritten by shopify module see (if you change something here consider this)
 *      magnalister/git/v3/magnalister/Codepool/70_Shop/Shopify/View/Main/Debug/bar/time.php
 */

if (!class_exists('ML', false))
    throw new Exception();
?>
    processing Images time:
    <pre><?php print_r(MLImage::gi()->getProcessingTimePerImage()) ?></pre>
<?php
