<?php
if (!class_exists('dBug', false)) {
    return false;
}

/**
 * @decrepated use Kint directly
 */
class dBug {
    function __construct($var,$forceType="",$bCollapsed=false,$blShowTitel=true) {
        if ($bCollapsed) {
            Kint::dump($var);
        } else {
            !Kint::dump($var);
        }
        
    }
}
