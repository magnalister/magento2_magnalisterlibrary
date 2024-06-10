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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * makes human readable time
 * @param float $time
 * @return string
 */
function microtime2human($time) {
    $str = '';
    if ($time > 3600) {
        $hours = floor($time / 3600);
        $str .= $hours . 'h';
        $time -= $hours * 3600;
    }
    if ($time > 60) {
        $minutes = floor($time / 60);
        $str .= ' ' . $minutes . 'm';
        $time -= $minutes * 60;
    }
    if ($time > 1) {
        $seconds = (int)$time % 60;
        $str .= ' ' . $seconds . 's';
        $time -= $seconds;
    }
    return trim(trim($str) . ' ' . round($time * 1000, 2) . 'ms');
}
