<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php
MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
?>
<form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="ml-plist ml-js-plist">
    <div>
        <?php
        foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
            ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
        }
        ?>
    </div>
    <?php
    $this->initAction();
    $this->prepareData();
    ?>
    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
    <?php } ?>
    <?php $this->includeView('widget_errorlog_misc_pagination'); ?>
    <table class="datagrid ml-plist-old-fix">
        <thead>
        <tr>
            <th class="nowrap" style="width: 5px;">
                <input type="checkbox" id="selectAll"/><label for="selectAll"><?php echo $this->__('ML_LABEL_CHOICE') ?></label>
            </th>
            <?php foreach ($this->getFields() as $aFiled) { ?>
                <th>
                    <div class="ml-errorlog-th">
                        <div> <?php
                            echo $aFiled['Label'];
                            if (isset($aFiled['Sorter']) && $aFiled['Sorter'] != null) {
                            ?>
                        </div>
                            <div style="width: 42px;">
                                <input class="noButton ml-right arrowAsc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-asc" title="<?php echo $this->__('Productlist_Header_sSortAsc') ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>"/>
                                <input class="noButton ml-right arrowDesc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-desc" title="<?php echo $this->__('Productlist_Header_sSortDesc') ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>"/>
                            </div>

                        <?php } ?>
                    </div>

                </th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if (empty($this->aData)) {
            ?>
            <tr>
                <td colspan="<?php echo count($this->getFields()) + 1; ?>">
                    <?php echo $this->__($this->getEmptyDataLabel()) ?>
                </td>
            </tr>
            <?php
        } else {
            $oddEven = false;
            foreach ($this->aData as $oErrorlog) {
                $sDetails = htmlspecialchars(str_replace('"', '\\"', serialize(array(
                    'SKU' => $oErrorlog->get('products_model'),
                ))));
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="<?php echo MLHttp::gi()->parseFormFieldName('ids[]') ?>" value="<?php echo $oErrorlog->get('id') ?>">
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName("details[".$oErrorlog->get('products_model')."]") ?>" value="<?php echo $sDetails ?>">
                    </td>
                    <?php
                    foreach ($this->getFields() as $aField) {
                        if ($aField['Field'] != null) {
                            ?>
                            <td><?php
                                if (method_exists($this, 'get'.ucfirst($aField['Field']))) {
                                    $this->{'get'.ucfirst($aField['Field'])}($oErrorlog);
                                } else {
                                    $sString = '';
                                    if ($aField['Field'] && $oErrorlog->get($aField['Field'])) {
                                        $sString = MLHelper::getPHP8Compatibility()->restrictToString($oErrorlog->get($aField['Field']));
                                    }
                                    if (strpos(htmlentities(html_entity_decode($sString, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8'), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8'), '&lt;div') !== false) {
                                        echo html_entity_decode($sString, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8');
                                    } else {
                                        echo htmlentities(html_entity_decode($sString, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8'), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8');
                                    }
                                }
                                ?></td>
                            <?php
                        } else {
                            echo call_user_func(array($this, $aField['Getter']), $oErrorlog);
                        }
                    }
                    ?>

                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
    <?php $this->includeView('widget_errorlog_misc_action'); ?>

    <script type="text/javascript">/*<![CDATA[*/
        jqml(document).ready(function () {
            jqml('#selectAll').click(function () {
                state = jqml(this).attr('checked') !== undefined;
                jqml('.ml-js-plist input[type="checkbox"]:not([disabled])').each(function () {
                    jqml(this).attr('checked', state);
                });
            });
        });
        /*]]>*/</script>
</form>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('form.ml-js-plist').submit(function () {
            jqml.blockUI(blockUILoading);
        });
    });
    /*]]>*/</script>
