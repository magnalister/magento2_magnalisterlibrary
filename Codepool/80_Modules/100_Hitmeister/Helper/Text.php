<?php
class ML_Hitmeister_Helper_Text {
    public function encodeText($sText, $blLower = true) {
        $text = str_replace('=', '_', base64_encode($sText));
        if ($blLower) {
            return strtolower($text);
        }
        
        return $text;
    }
    
    public function decodeText($sText) {
        return base64_decode(str_replace('_', '=', $sText));
    }
}
