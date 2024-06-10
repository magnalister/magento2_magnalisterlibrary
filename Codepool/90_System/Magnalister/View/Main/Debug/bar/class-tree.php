<?php
if (!class_exists('ML', false))
    throw new Exception();
ob_start();
?>
    <table>
        <?php foreach ($aContent as $sClass) { ?>
            <tr>
                <th><?php echo str_replace(' ', '_', ucwords(str_replace('_', ' ', $sClass))); ?><br/></th>
                <td>
                    <?php
                    $blDisplayed = true;
                    while ($sClass) {
                        if (!$blDisplayed) {
                            echo str_replace(' ', '_', ucwords(str_replace('_', ' ', $sClass)));
                        }
                        $aImplements = class_implements($sClass);
                        if (!empty($aImplements)) {
                            ?>&nbsp;<i style="color:gray;">implements</i> <?php
                            echo str_replace(' ', '_', ucwords(str_replace('_', ' ', implode(', ', $aImplements))));
                            $blDisplayed = false;
                        }
                        if (!$blDisplayed) {
                            ?><br/><?php
                        }
                        $blDisplayed = false;
                        $sClass = get_parent_class($sClass);
                        if ($sClass) {
                            ?>&nbsp;<i style="color:gray;">extends</i>&nbsp;<?php
                        }
                    }
                    ?>
                    <br/>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php 
    $sOut = ob_get_contents();
    ob_end_clean();    
    try{
        foreach(MLSetting::gi()->get('aClassTreePatterns') as $sPattern){
            $sOut=preg_replace($sPattern, '<strong style="color:green" title="pattern: '.htmlentities($sPattern).'">$0</strong>', $sOut);
        }
        echo $sOut;
        $sPatterns='"'.implode('"<br />"',MLSetting::gi()->get('aClassTreePatterns')).'"';
        ?>
            <span style="float:right;color:gray;">
                Patterns:&nbsp;
                <span style="float:right"><?php echo $sPatterns; ?></span>
            </span>
            <div class="clear"></div>
        <?php
    }  catch (Exception $oEx){}
?>