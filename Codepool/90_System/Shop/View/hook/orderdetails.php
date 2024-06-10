<?php
/**
 * @var ML_Shop_Model_Order_Abstract $oOrder
 */
$oI18n = MLI18n::gi();
?><table><?php
    $oOrder  = !isset($oOrder) && isset($o_order) ? $o_order:$oOrder;
    foreach ($oOrder->get('data') as $sKey => $mValue) {
        $aPrefixes = array("_platformName_" => $oOrder->get('platform'));
        $sTitle = $oI18n->get($sKey, $aPrefixes);
        $sInfo = '';
        $sDate = null;

        if (in_array($sKey, array('MOrderID', 'MPreviousOrderID', 'MPreviousOrderIDS', 'OttoOrderId'))) {
            if ($sKey == 'MPreviousOrderIDS' && !MLSetting::gi()->get('blDebug')) {
                continue;
            } elseif ($sKey == 'MPreviousOrderID') {
                if (is_array($mValue)) {
                    $sDate = $mValue['date'];
                    $mValue = $mValue['id'];
                }
            } elseif ($sKey == 'MOrderID') {
                $aOrderData = $oOrder->get('orderdata');
                if (isset($aOrderData['Order']['DatePurchased'])) {
                    $oDate = new DateTime($aOrderData['Order']['DatePurchased']);
                    if (is_string(MLShop::gi()->getTimeZoneOnlyForShow())) {
                        $oDate->setTimezone(new DateTimeZone(MLShop::gi()->getTimeZoneOnlyForShow()));
                    }
                    $sDate = $oDate->format('Y-m-d H:i:s');
                } else {
                    $sDate = '--';
                }
            } elseif ($sKey == 'OttoOrderId') {
                //removed duplicated id for OTTO implementation
                continue;
            }
        }
        if (is_array($mValue)) {
            $sInfo .='<ul>';
            foreach ($mValue as $sValueKey => $sValue) {
                $sInfo .='<li>' .(is_numeric($sValueKey) ? '' : $sValueKey.': '). $oI18n->get($sValue, $aPrefixes) . '</li>';
            }
            $sInfo .='</ul>';
        } else {
            $sInfo .= '&nbsp;' .$oI18n->get($mValue, $aPrefixes). (isset($sDate) ? "&nbsp;({$sDate})" : '');;
        }
        ?>
        <tr>
            <th><?php
                echo $sTitle;
                ?><th>
            <th>:</th>
            <td><?php
                echo $sInfo;
                ?></td>
        </tr>
        <?php
    }
    ?></table>
