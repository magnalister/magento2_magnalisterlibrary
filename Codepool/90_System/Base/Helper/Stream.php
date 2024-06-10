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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Base_Helper_Stream {
    protected $iLength = 175;
    protected static $iDeph = 0;
    protected static $blOut = false;

    public function activateOutput() {
        self::$blOut = microtime(true);
        return $this;
    }

    public function stream($sIn, $blTime = true) {
        $aArray = explode("\n", $sIn);
        $iDeph = self::$iDeph * 2;
        $iDeph = max(0, $iDeph);
        $iLength = $this->iLength - $iDeph;
        $sOut = '';
        foreach ($aArray as $iKey => $sString) {
            $sOut .= str_repeat(' ', $iDeph).'## '.$sString;
            if ($iKey == 0 && $blTime !== false) {
                if ($blTime === true) {
                    $fTime = (string)microtime(true);
                    $fTime = substr($fTime, -(strlen($fTime) - strrpos($fTime, '.') - 1));
                    if (strlen($fTime) < 4) {
                        $fTime .= str_repeat('0', 4 - strlen($fTime));
                    }
                    $sDate = date('Y-m-d H:i:s').'.'.$fTime;
                } else {
                    $sDate = $blTime;
                }
                $iRepeatTime = $iLength - strlen($sDate) - strlen($sString);
                $sOut .= ($iRepeatTime >= 0 ? str_repeat(' ', $iRepeatTime) : '')." ".$sDate;
            }
            $sOut .= "\n";
        }
        $this->out($sOut);
        return $this;
    }

    public function streamCommand($aArray) {
        $sString = json_encode($aArray);
        $this->stream($sString, '{#'.base64_encode($sString).'#}');
        return $this;
    }

    public function deeper($sMessage = '') {
        $this->stream($sMessage.'{', false);
        ++self::$iDeph;
        return $this;
    }

    public function higher($sMessage = '') {
        --self::$iDeph;
        $this->stream('}'.$sMessage, false);
        return $this;
    }

    protected function out($sOut) {
        if (self::$blOut) {
            echo $sOut,
            flush();
        }
        return $this;
    }

    public function outWithNewLine($sOut) {
        return $this->out($sOut."\n");
    }
}
