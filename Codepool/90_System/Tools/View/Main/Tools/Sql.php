<?php
if (!class_exists('ML', false))
    throw new Exception();
MLSettingRegistry::gi()->addJs('magnalister.tools.sql.js');
MLSettingRegistry::gi()->addCss('magnalister.tools.sql.css');
?>
<div id="magnaToolsSql">
    <h2>SQL</h2>
    <p><b>Vorsicht:</b> SQL Anfragen werden ohne Sicherung ausgef&uuml;hrt. Es gibt kein r&uuml;ckg&auml;nig machen!</p>
    <table>
        <tr>
            <td class="query">
                <form action="#" method="post">
                    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                    <?php } ?>
                    <textarea id="magnaSql" name="<?php echo MLHttp::gi()->parseFormFieldName('SQL') ?>"><?php echo((MLRequest::gi()->SQL !== null) ? MLRequest::gi()->get('SQL') : ''); ?></textarea>
                    <input class="button" type="submit" value="CTRL + enter (senden)">
                </form>
            </td>
            <td class="predefinedQuerys">
                <ul id="preparedQuerys" title="click(edit) doubleclick(execute)">
                    <?php foreach ($this->getPredefinedQuerys() as $aQuery) { ?>
                        <li class="<?php echo ($aQuery['active']) ? 'active current' : '' ?>" data-sql="<?php echo $aQuery['data-sql'] ?>" title="<?php echo $aQuery['title'] ?>">
                            <?php echo $aQuery['name'] ?>
                        </li>
                    <?php } ?>
                </ul>
            </td>
        </tr>
    </table>
    <?php if (MLRequest::gi()->SQL!==null) {?>
        <div id="sql_out">
            <?php if($this->getError()=='' && count($this->getResult())>0){ ?>
                <?php $aData=$this->getResult();?>
                    <table class="datagrid autoOddEven hover">
                        <thead><tr><th><?php echo implode('</th><th>', array_keys($aData[0]))?></th></tr></thead>
                        <tbody>
                            <?php foreach ($aData as $aRow) {?>
                                <tr>
                                    <?php foreach ($aRow as $sKey => $sItem) {?>
                                    <td class="<?php echo strtolower($sKey)?>"><?php echo htmlspecialchars(var_export($sItem, true),ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8') ?></td>
                                    <?php } ?>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
            <?php }else{ ?>
                <?php echo $this->getError();?>
            <?php } ?>
        </div>
        <div id="sql_out_after"></div>
    <?php } ?>
</div>
