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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * @var ML_Base_Controller_Widget_Message $this
 * @var array $aMessage
 * @var string $sClass
 * @var bool $blClose shows close-button default=true
 */
if (!class_exists('ML', false))
    throw new Exception();
if (count($aMessages)) {
    foreach ($aMessages as $sKey => $aMessage) {
        if (isset($aMessage['htmlSelector']) && $aMessage['htmlSelector'] !== '') {

            ?>
            <script type="text/javascript">/*<![CDATA[*/
                (function ($) {
                    $(document).ready(function () {
                        $('<?php echo $aMessage['htmlSelector'] ?>').append('<div class="<?php echo $sClass ?>"><?php echo str_replace(array("\n", "\r", "'"), array("", "", "\\'"), $aMessage['message']) ?></div>');
                    });
                })(jqml);
                /*]]>*/</script>
            <?php
            unset($aMessages[$sKey]);
        }
    }
}
if(count($aMessages)){
    ?>
    <div class="<?php echo $sClass ?>">
        <table style="width:100%;border-spacing: 0;">
            <?php
                $blClose = isset($blClose) ? $blClose : true;
                $blLine = false;
                foreach ($aMessages as $aMessage) { ?>
                    <tbody class="hideChild">
                        <tr>
                            <th colspan="<?php echo count($aMessage['additional']) + 1; ?>">
                                <?php 
                                    echo $aMessage['message']; 
                                    if ($sClass != 'debug' && !$blLine && $blClose) {
                                        $blLine = true;
                                        ?>
                                            <a role="button" class="ml-js-noBlockUi close-message" href="#">
                                                <span class="close-message-icon">close</span>
                                            </a>
                                        <?php
                                    }
                                ?>
                            </th>
                        </tr>
                        <?php  if (MLSetting::gi()->get('blDebug')) { ?>
                            <tr class="childToHide">
                                <th rowspan="2">
                                    <input type="checkbox" onchange="var e=jqml(this).closest('tbody');if(jqml(this).is(':checked')){e.removeClass('hideChild');}else{e.addClass('hideChild');}"/>
                                </th>
                                <?php 
                                    foreach (array_keys($aMessage['additional']) as $sHead) {
                                        ?><th><?php echo ucfirst($sHead); ?></th><?php
                                    } 
                                ?>
                            </tr>
                            <tr style="color:gray;" class="childToHide">
                                <?php
                                    foreach($aMessage['additional'] as $sTitle=>$mInfo){
                                        ?><td><?php
                                            if (is_array($mInfo) && class_exists('Kint', false)) {
                                                Kint::dump($mInfo);
                                            } elseif (is_array($mInfo)) {
                                                ?><pre><?php 
                                                echo print_r($mInfo); 
                                                ?></pre><?php
                                            } else {
                                                echo $mInfo;
                                            }
                                        ?></td><?php
                                    }
                                ?>
                            </tr>
                        <?php } else { ?>
                            <?php if ($aMessage['additional']['data'] != '&mdash;') { ?>
                                <tr>
                                    <td>
                                        <?php
                                              if (is_string($aMessage['additional']['data'])) {
                                                  echo $aMessage['additional']['data'];
                                              } elseif (function_exists('print_m')) {
//                                                  echo print_m($aMessage['additional']['data']);
                                              } else {
//                                                  print_r($aMessage['additional']['data']);
                                              }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                <?php 
            } ?>
        </table>
    </div>
<?php } ?>