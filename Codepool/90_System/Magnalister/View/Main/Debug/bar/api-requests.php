<?php
if (!class_exists('ML', false))
    throw new Exception();
$tpR = MagnaConnector::gi()->getTimePerRequest();
if (!empty($tpR)) {
    $totaltime = 0;
    ob_start();
    ?>
    <table class="ml-css-apirequests">
        <tr class="ml-css-head">
            <th class="ml-css-time">Time</th>
            <th class="ml-css-action">Action</th>
            <th class="ml-css-status">Status</th>
            <th class="ml-css-request">Request</th>
            <th class="ml-css-response">Response</th>
        </tr>
        <?php foreach ($tpR as $item) {
            $sTrace = '';
            if (isset($item['response']['plugin-trace'])) {
                $sTrace = $item['response']['plugin-trace'];
                unset($item['response']['plugin-trace']);
            }
            ?>
            <tr class="ml-css-row ml-css-<?php echo strtolower($item['status']); ?>">
                <td class="ml-css-time"><?php echo microtime2human($item['time']) ?></td>
                <td class="ml-css-action"><?php echo isset($item['request']['ACTION']) ? $item['request']['ACTION'] : ''; ?></td>
                <td class="ml-css-status"><?php echo $item['status']; ?></td>
                <td class="ml-css-request">
                    <textarea><?php echo htmlspecialchars((isset($item['url']) ? $item['url'] . "\n" : '') . json_indent($item['request'])) . "\n" . $sTrace; ?></textarea>
                </td>
                <td class="ml-css-response">
                    <textarea><?php echo htmlspecialchars(isset($item['response']) ? json_indent($item['response']) : '--'); ?></textarea>
                </td>
            </tr>
            <?php $totaltime += $item['time']; ?>
        <?php } ?>
    </table>
        <?php
        $sContent=  ob_get_contents();
        ob_end_clean();
        echo 'Total request time :<b> '.microtime2human($totaltime).'</b><br /><br />'.$sContent;
    }
?>