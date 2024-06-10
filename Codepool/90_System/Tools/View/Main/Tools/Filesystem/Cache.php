<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<form action="<?php echo $this->getCurrentUrl() ?>" method="post">
    <div>
        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
        <?php } ?>
        <table style="width:100%;">
            <colgroup>
                <col style="width:50%; text-align: left;"/>
                <col style="width:50%; text-align: left;"/>
            </colgroup>
            <tr>
                <td>
                    <input class="mlbtn" type="submit" name="<?php echo MLHttp::gi()->parseFormFieldName('deleteallcache'); ?>" value='Delete All Cache'/>
                    <input class="mlbtn" type="submit" name="<?php echo MLHttp::gi()->parseFormFieldName('deleteallsession'); ?>" value='Delete All Session'/>
                </td>
                 <td >
                    <input class="mlbtn" type="submit" name="<?php echo MLHttp::gi()->parseFormFieldName('showlist'); ?>" value='Show All'/>
                </td>
            </tr>
            <?php if ($this->blShowList) {?>  
            <tr>
                <td colspan="2">
                    <input class="mlbtn" type="submit" name="<?php echo MLHttp::gi()->parseFormFieldName('delete'); ?>" value='Delete Selected'/>
                </td>
            </tr>
            <tr>
                <th>
                    <input type="checkbox" id='selectCache'/>&nbsp;Cache: Select all
                </th>
                <th>
                    <input type="checkbox" id='selectSession'/>&nbsp;Session: Select all
                </th>
            </tr>     
            <tr>
                <td>
                    <table style="border-spacing: 0;width:100%;table-layout: fixed">
                        <colgroup>
                            <col style="width:20px" />
                        </colgroup>
                            
                        <?php foreach ($this->cacheList() as $sKey) {?>       
                            <tr>
                                <td>
                                    <input type="checkbox" class="cacheslector" value="<?php echo $sKey; ?>" name='<?php echo MLHttp::gi()->parseFormFieldName('selected[]');?>' >
                                </td>
                                <td class="expandcontent">
                                    &nbsp;<?php echo $sKey ?>
                                        <pre style='display: none;background:silver;max-height:10em;overflow: auto'><?php 
                                            try {
                                                echo var_export(MLCache::gi()->get($sKey), true);
                                            } catch (ML_Filesystem_Exception $oExc) {
                                                echo $oExc->getMessage();
                                            }
                                        ?></pre>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
                <td>
                    <table style="border-spacing: 0;width:100%;table-layout: fixed">
                        <colgroup>
                            <col style="width:20px";
                        </colgroup>
                            
                        <?php foreach ($this->sessionList() as $sKey =>$aData) {?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="sessionslector" value="<?php echo $sKey ?>" name='<?php echo MLHttp::gi()->parseFormFieldName('sessionselected[]');?>' >
                                </td>
                                <td class="expandcontent">
                                    &nbsp;<?php echo $sKey ?>
                                        <pre style='display: none;background:silver;max-height:10em;overflow: auto;width:300px'><?php
                                            try {
                                                echo var_export($aData, true);
                                            } catch (ML_Filesystem_Exception $oExc) {
                                                echo $oExc->getMessage();
                                            }
                                        ?></pre>
                                </td>
                            </tr>
                        <?php }?>
                    </table>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</form>
<script type='text/javascript'>
    (function($) {
        $('#selectCache').click(function(){
         if($(this).is(':checked')){
             $('.cacheslector').attr("checked",true);
         }else{
             $('.cacheslector').attr("checked",false);
         }   
        }); $('#selectSession').click(function(){
         if($(this).is(':checked')){
             $('.sessionslector').attr("checked",true);
         }else{
             $('.sessionslector').attr("checked",false);
         }   
        });
        $(".expandcontent").click(function(e) {
            e.preventDefault();
            var eSiblings=$(this).parent().find('pre');
            if (eSiblings.css('display')==='none') {
                eSiblings.css('display','block');
            } else {
                eSiblings.css('display','none');
            }
        });
    })(jqml);
</script>