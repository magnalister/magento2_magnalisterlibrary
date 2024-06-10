<?php
/**
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Modul_Helper_String {

    /**
     * Removes all html tags of string and converts html <hr>, <br>, "\r" to "\n"
     *      equals to the sanitizeDescription from v2
     * @param string $string
     * @return string
     */
    public function removeHtml($string) {
        $string = preg_replace("#(<\\?div>|<\\?li>|<\\?p>|<\\?h1>|<\\?h2>|<\\?h3>|<\\?h4>|<\\?h5>|<\\?blockquote>)([^\n])#i", "$1\n$2", $string);
        // Replace <br> tags with new lines
        $string = preg_replace('/<[h|b]r[^>]*>/i', "\n", $string);
        $string = trim(strip_tags($string));
        // Normalize space
        $string = str_replace("\r", "\n", $string);
        $string = preg_replace("/\n{3,}/", "\n\n", $string);

        return $string;
    }


    /**
     * @param $str
     * @param string $allowable_tags
     * @param string $allowable_attributes
     * @return mixed|string|string[]|null
     */
    public function sanitizeProductDescription($str, $allowable_tags = '', $allowable_attributes = '') {
        $str = !magnalisterIsUTF8($str) ? utf8_encode($str) : $str;

        $str = stripEvilBlockTags($str);

        /* Convert Gambio-Tabs to H1-Headlines */
        $str = preg_replace('/\[TAB:([^\]]*)\]/', '<h1>${1}</h1>', $str);

        if (stripos($allowable_tags, '<br') === false) {
            /* Convert (x)html breaks with or without atrributes to newlines. */
            $str = preg_replace('/\<br(\s*)?([[:alpha:]]*=".*")?(\s*)?\/?\>/i', "\n", $str);
        } else {
            $str = str_replace('<br/>', '<br />', $str);
        }
        $str = preg_replace("/<([^([:alpha:]|\/)])/", '&lt;\\1', $str);
        $str = strip_tags_attributes($str, $allowable_tags, $allowable_attributes);

        if ($allowable_tags === '') {
            $str = str_replace(array("\n", "\t", "\v", '|'), ' ', $str);
            $str = str_replace(array('&quot;', '&qout;'), '"', $str);

            $str = str_replace(array('&nbsp;'), ' ', $str);

            /* Converts all html entities to "real" characters */
            $str = html_entity_decode($str, null, 'UTF-8');
            $str = str_replace(array(';', "'"), ', ', $str);
        }

        /* Strip excess whitespace */
        $str = preg_replace('/\s\s+/', ' ', trim($str));
        return $str;
    }
}
