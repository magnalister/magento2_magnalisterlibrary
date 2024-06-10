<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$aTests = $this->tests();;
?><table border="1">
    <thead>
        <?php 
            $sErrorLink = '%s';
            $blResult = true;
            foreach ($aTests as $iTest => $aTest) {
                if (is_array($aTest) && !$aTest['success']) {
                    $blResult = false;
                    $sErrorLink = '<a href="#'.get_class($this).$iTest.'">%s</a>';
                    break;
                }
            }
        ?>
        <tr style="background-color:<?php echo $blResult ? '#54F42C' : '#F42C4D' ?>;" class="ml-js-noBlockUi">
            <th><?php echo sprintf($sErrorLink, 'Command'); ?></th>
            <th><?php echo sprintf($sErrorLink, 'Info'); ?></th>
            <th><?php echo sprintf($sErrorLink, 'Expected result'); ?></th>
            <th><?php echo sprintf($sErrorLink, 'Result'); ?></th>
            <th><?php echo sprintf($sErrorLink, 'Message'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($aTests as $iTest => $aTest) { ?>
            <?php if (is_string($aTest)) {?>
                <tr>
                    <th colspan="5" style="color:gray;"><?php echo $aTest; ?></th>
                </tr>
            <?php } else { ?>
                <tr id="<?php echo get_class($this).$iTest; ?>" style="background-color:<?php echo $aTest['success'] ? '#54F42C' : '#F42C4D' ?>;">
                    <td><?php echo $aTest['command']; ?>(<br /><?php
                        foreach ($aTest['parameters'] as $iParam => $mParam) {
                            ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php
                            if (is_bool($mParam)) {
                                echo $mParam ? 'TRUE' : 'FALSE';
                            } else {
                                echo '"'.$mParam.'"';
                            }
                            if ($iParam + 1 != count($aTest['parameters'])) {
                                echo ', <br />';
                            }
                        }
                        ?><br />)
                    </td>
                    <td>
                        <?php echo $aTest['info']; ?>
                    </td>
                    <td><?php
                        if (is_bool($aTest['expectedResult'])) {
                            echo $aTest['expectedResult'] ? 'TRUE' : 'FALSE';
                        } elseif (in_array($aTest['expectedResult'], array('object', 'exception'))) {
                            echo strtoupper($aTest['expectedResult']);
                        } else {
                            echo '"'.$aTest['expectedResult'].'"';
                        } 
                    ?></td>
                    <td><?php
                        if (is_bool($aTest['result'])) {
                            echo $aTest['result'] ? 'TRUE' : 'FALSE';
                        } elseif (in_array($aTest['result'], array('object', 'exception'))) {
                            echo strtoupper($aTest['result']);
                        } else {
                            echo '"'.$aTest['result'].'"';
                        } 
                    ?></td>
                    <td><?php echo $aTest['message']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>