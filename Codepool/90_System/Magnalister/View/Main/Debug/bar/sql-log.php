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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception();
ob_start();
$totaltime = 0;
$tpR = MLDatabase::getDbInstance()->getTimePerQuery();
$tpR = is_array($tpR) ? $tpR : array();

if (!empty($tpR)) {
    ?>
    <table style="width:100%">
        <tr>
            <th>Time</th>
            <th>Query</th>
            <th>Backtrace</th>
        </tr>
        <?php foreach ($tpR as $item) { ?>
            <tr>
                <td<?php echo $item['error'] ? ' class="error"' : '' ?>><?php echo microtime2human($item['time']) ?></td>
                <td>
                    <textarea style="width:100%;"><?php echo trim(htmlentities($item['query'], ENT_COMPAT, 'UTF-8')); ?></textarea>
                    <?php echo $item['error'] ?: ''; ?>
                </td>
                <td>
                    <textarea style="width:100%;"><?php echo trim(htmlentities($item['back-trace'], ENT_COMPAT, 'UTF-8')); ?></textarea>
                </td>
            </tr>
            <?php $totaltime += $item['time']; ?>
        <?php } ?>
    </table>
    <?php
}
$sContent = ob_get_contents();
ob_end_clean();
echo "Total query execution time :<b> ".microtime2human($totaltime).'</b><br /><br />'.$sContent;
