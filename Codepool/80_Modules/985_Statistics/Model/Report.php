<?php

class ML_Statistics_Model_Report {

    protected $iMaxOrder = 0;
    protected $iChartHeight = 0;
    protected $iChartWidth = 0;
    protected $iUnitHeight = 0;
    protected $iRatio = 0;
    protected $aData = null;
    protected $sLegend = '';

    public function __construct() {
        $this->iChartHeight = (int) MLSetting::gi()->get('chart_height') - 60;
        $this->iChartWidth = (int) MLSetting::gi()->get('chart_width') - 10;
    }

    /** @var string $sChartType can be orders , percent */
    protected $sChartType = 'orders';

    
    public function showLegend() {
        $sHtml = $this->sLegend;
        if ( $sHtml === '') {
            $aModules = MLSetting::gi()->get('aModules');
            $aResult = $this->getData();
            if (count($aResult) > 0) {
                $aPlatform = array();
                $aKeys = array_keys($aResult[0]);
                foreach ($aResult as $aRow) {
                    $sPlatform = '';
                    if (empty($aRow[$aKeys[1]])) {
                        $aPlatform['shop'] = 'Shop';
                    } else {
                        $aPlatform[$aRow[$aKeys[1]]] = 
                            isset($aModules[$aRow[$aKeys[1]]]) && isset($aModules[$aRow[$aKeys[1]]]['title']) 
                            ? $aModules[$aRow[$aKeys[1]]]['title'] 
                            : $aRow[$aKeys[1]]
                        ;
                    }
                }
                $sHtml .= '<ul>';
                foreach ($aPlatform as $sPlatform => $sLabel) {
                    $sHtml .=
                    '<li class="legendcontainer">
                         <div class="legendcolor orderbarout report_border_'.$sPlatform.'">
                              <div class="orderbar report_'.$sPlatform.'"></div>
                         </div>   
                         <div class="legendlabel">'.$sLabel.'</div>
                     </li>';
                }
                $sHtml .= '</ul>';
            }
            $this->sLegend = $sHtml;
        }
        return $sHtml;
    }
    public function showChart($sType) {
        $this->sChartType = $sType;
       
        $aPlatformResult = magnaGetInvolvedMarketplaces(); // array('amazon', 'ebay', 'meinpaket');

        if (empty($aPlatformResult)) {
            return '<div style="text-align:center;margin-top: 70px;">'.MLI18n::gi()->ML_LABEL_NO_DATA.'</div>';
        }

        $platforms = array('label' => '', 'total' => 0, 'shop' => 0);
        foreach ($aPlatformResult as $item) {
            $platforms[$item] = 0;
        }
        $aResult = $this->getData();
        
        $shopOrderExists = false;
        $semiFinal = array();
        if (count($aResult) > 0) {
            $aKeys = array_keys($aResult[0]);
            foreach ($aResult as $aRow) {
                $date = strtotime($aRow[$aKeys[0]]);
                $key = gmdate('Ym', $date);
                if (!isset($semiFinal[$key])) {
                    $semiFinal[$key] = $platforms;
                    $semiFinal[$key]['label'] = gmdate('M y', $date);
                }
                if (empty($aRow[$aKeys[1]])) {
                    $aRow[$aKeys[1]] = 'shop';
                    $shopOrderExists = true;
                }
                ++$semiFinal[$key][$aRow[$aKeys[1]]];
                ++$semiFinal[$key]['total'];
            }
        }

        if (empty($semiFinal)) {
            return '<div style="text-align:center;margin-top: 70px;">'.MLI18n::gi()->ML_LABEL_NO_DATA.'</div>';
        }
        ksort($semiFinal);
        $finalData = array();
        $iMaxOrder = 0;
        foreach ($semiFinal as $item) {
            $fItem = array();
            $fItem[] = $item['label'];
            $total = ($this->sChartType === "percent")?((int) $item['total']):1;
            if ($shopOrderExists) {
                $fItem['shop'] = (int) $item['shop']/$total;
            }
            $iMaxOrder = ($iMaxOrder < (int) $item['total']) ? (int) $item['total'] : $iMaxOrder;

            unset($item['label'],$item['total'],$item['shop']);
            ksort($item);

            foreach ($item as $key => $val) {
                if ($val !== 0) {
                    $fItem[$key] = (int) $val/$total;
                }
            }
            $finalData[] = $fItem;
        }
        $aChartData = array();
        $aChartData['legend'] = array();
        if($this->sChartType === 'percent'){
            $aChartData['unitcount'] =  10;
            $aChartData['unit'] = $this->iChartHeight / $aChartData['unitcount'];
            $aChartData['legend'] = array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100);
            $aChartData['ratio'] = 1;
        }elseif($this->sChartType === 'orders'){
            $aChartData['unitcount'] =  (($iMaxOrder<11 )? $iMaxOrder :10) + 1;  // 1 for top empty line        
            $aChartData['unit'] = $this->iChartHeight / $aChartData['unitcount'] ;
            $aChartData['ratio'] = ($aChartData['unitcount']-1)/$iMaxOrder;
            $iIncreaseRate = $iMaxOrder/($aChartData['unitcount']-1);
            for($i =0 ;$i < $aChartData['unitcount']+1;$i++){ //to add 0 to first legend
                $aChartData['legend'][] = round($i * $iIncreaseRate);
            }            
        }
        $aChartData['data'] = $finalData;
        return $this->createBars($aChartData);
    }

    
    protected function createBars($finalData) {
        $iColumnMaxHeight = $this->iChartHeight;
        $sHtmlBar = '
            <div class="fl left"><span>'.
                ($this->sChartType == 'percent'?MLI18n::gi()->ML_LABEL_STATS_PERCENT_OF_ORDERS:MLI18n::gi()->ML_LABEL_STATS_ORDERS).
            '</span></div>
        ';
        $sHtmlBar .= '<div class="leftline"></div>';
        $sHtmlBar .= '<div class="barscontainer">';
        $iLeft = 20;
        $iCountData = count($finalData['data']);
        foreach ($finalData['data'] as $aMonthStatic) {
            $iTop = 210;
            $sMounthLegend = array_shift($aMonthStatic);
            //add horizental labels
            $sHtmlBar .= '<div class="horizental_lable'.(($iCountData > 6) ? ' transform' : '').'" style="left:'.$iLeft.'px;">'.$sMounthLegend.'</div>';
            $sHtmlBar .= '<div class="columncontainer">';
            $iTotalHeight = 0;
            $iTotalVales = 0;
            $sColumnHtml = '';
            foreach ($aMonthStatic as $iKey => $iHeight) {
                if ($iHeight != 0) {
                    $sValue = $iHeight;
                    $iHeight *= $finalData['unit'] * $finalData['ratio'] ;
                    $sSpan = '';
                    if ($this->sChartType == 'percent') {
                        $iHeight *= 10;
                        $sValue = 100 * round($sValue, 2);
                    } else if ($iHeight > $finalData['unit']) {
                        $sSpan .= '<span>'.$sValue.'</span>';
                    }
                    $iTop = $iTop - $iHeight - 2;
                    $sColumnHtml .= '
                        <div class="orderbarout report_border_'.$iKey.'" style="top:'.$iTop.'px;">'.$sSpan.'
                            <div class="orderbar report_'.$iKey.'" style="height:'.($iHeight - 2).'px; left:'.$iLeft.'px;" title="'.$iKey.', '.$sValue.'"></div>
                        </div>
                    ';
                    $iTotalVales += $sValue;
                    $iTotalHeight += ($iHeight);
                }
            }
            //fill black spcae on top of column
            if ($iTotalHeight < $iColumnMaxHeight) {
                $iDif = $iColumnMaxHeight - $iTotalHeight;
                $sHtmlBar .= '<div class="orderbarout report_blank" style="top:0px;height:'.$iDif.'px;">';
                         
                if (count($aMonthStatic) > 1 && $this->sChartType == 'orders') {
                    $sHtmlBar .= '<div class="report_blank" style="top:'.($iColumnMaxHeight - $iTotalHeight-15).'px;position:absolute;">'.$iTotalVales.'</div>';
                }
                $sHtmlBar .= '</div>';
            }
            //show total orders of month on top of bar
            
            $sHtmlBar .=$sColumnHtml;
            $iLeft = $iLeft + 40;
            $sHtmlBar .= '</div>';
        }
        $sHtmlBar .= $this->createDashed($finalData).'<div class="sublegend">'.$this->showLegend().'</div></div>';
        return $sHtmlBar;
    }
    
    
    protected function createDashed($finalData) {

        $sHtmlDash = '';
        $iTop = $this->iChartHeight;

        $aVerticalLegent = $finalData['legend'];
        $sFirstLegend = array_shift($aVerticalLegent);
        $sHtmlDash .="<div class='vertical_lable' style='top:" . ($iTop - 5) . "px;'>$sFirstLegend</div><div class='dashed firsth' style='top:{$iTop}px'></div>";

        $iStep = $finalData['unit'];
        $iTop -= $iStep;
        $iLastPrintedLegend = 0;
        foreach ($aVerticalLegent as $sLegend) {
            $iLastPrintedLegend = $sLegend;
            $sHtmlDash .="<div class='vertical_lable' style='top:" . ($iTop - 5) . "px;'>$sLegend</div><div class='dashed' style='top:{$iTop}px'></div>";
            $iTop -= $iStep;
        }
        
        return $sHtmlDash;
    }

    protected function getDateBack() {
        $dateBack = (int) getDBConfigValue('general.stats.backwards', '0', 6);

        $date = new DateTime();
        $date->modify('- '.$dateBack.' month');
        return $date->format('Y-m-01 00:00:00');
    }

    protected function getData(){
        if($this->aData === null){
            $this->aData = MLShop::gi()->getOrderSatatistic($this->getDateBack());
        }
        return $this->aData;
    }
}
