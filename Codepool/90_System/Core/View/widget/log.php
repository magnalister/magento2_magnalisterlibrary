 <?php
 /* 
  * At the moment this view just show order sync log.
  * If desided to show other type of log , 
  * at first  I18n stuff should be added to ./Codepool/90_System/Base/I18n/De/log.php .
  * And then please change this document too
  */ 
 if(count(MLLog::gi()->getAllCached('ordersSync'))>0){ ?>
        <div class="successBoxBlue">
            <?php foreach(MLLog::gi()->getAllCached('ordersSync') as $sType=>$aLogs){ ?>
                <div class="ml-log">
                    <?php $aI18n = MLI18n::gi()->get('aLog_'.$sType); ?>
                    <strong class="left"><?php echo $aI18n['title'] ?>:</strong>
                    <strong class="right close" style="cursor:pointer">x</strong>
                    <div class="clear"></div>
                    <table style="width:100%;">
                        <thead>
                        <tr>
                            <th><?php echo MLI18n::gi()->get('sLog_timeStamp'); ?></th>
                            <?php
                            if (isset($aLogs[0]['data']) && is_array($aLogs[0]['data'])) {
                                foreach (array_keys($aLogs[0]['data']) as $sKey) { ?>
                                    <th><?php
                                        if (isset($aI18n[$sKey])) {
                                            if (is_array($aI18n[$sKey])) {
                                                echo $aI18n[$sKey]['title'];
                                            } else {
                                                echo $aI18n[$sKey];
                                            }
                                        } else {
                                            echo $sKey;
                                        }
                                        ?></th>
                                <?php }
                            } ?>
                            <th><?php echo MLI18n::gi()->get('ML_LABEL_ACTION') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($aLogs as $aLog) { ?>
                            <tr>
                                <th>
                                    <?php echo date('Y-m-d h:i:s', $aLog['time']) ?>
                                </th>
                                <?php
                                if (isset($aLog['data']) && is_array($aLog['data'])) {
                                    foreach ($aLog['data'] as $sKey => $sValue) { ?>
                                        <td><?php
                                            if (isset($aI18n[$sKey]['values'][$sValue])) {
                                                echo $aI18n[$sKey]['values'][$sValue];
                                            } else {
                                                echo $sValue;
                                            }
                                            ?></td>
                                    <?php }
                                } ?>
                                <td>
                                    <a class="delete" href="<?php echo MLHttp::gi()->getUrl(array('controller' => 'main_tools_filesystem_cache', 'delete' => 'true', 'selected' => array($aLog['name']))) ?>"><?php echo MLI18n::gi()->get('sLog_delete') ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            <?php } ?>
        </div>
        <script type="text/javascript">/*<![CDATA[*/
            (function($) {
                $('.ml-log').find('.close').click(function(){
                    $(this).parent().parent().find('a.delete').trigger('click'); 
                });
                $('.ml-log').find('a.delete').click(function(){
                    var e=$(this);
                    $.ajax ({
                            url: e.attr('href'),
                            success: function(data) {
                                if(e.parentsUntil('tbody').parent().find('>tr').length===1){
                                    if(e.parentsUntil('.successBoxBlue').parent().find('>.ml-log').length===1){
                                        e.parentsUntil('.successBoxBlue').parent().remove();
                                    }else{
                                        e.parentsUntil('.ml-log').parent().remove(); 
                                    }
                                }else{
                                    e.parentsUntil('tr').parent().remove();
                                }
                            }
                    });
                    return false;
                });
            })(jqml);
        /*]]>*/</script>
    <?php } ?>