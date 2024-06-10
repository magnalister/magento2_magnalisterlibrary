<?php
if (!class_exists('ML', false))
    throw new Exception();

MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
/* @var $this   ML_Listings_Controller_Listings_Inventory */
ob_start();
?>
<form action="<?php echo $this->getCurrentUrl() ?>"  method="post" class="ml-plist ml-js-plist">
    <div>
        <?php
        foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
            ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
        }

        if (isset($this->aPostGet['sorting'])) {
            ?>
            <input type="hidden" name="ml[sorting]" value="<?php echo $this->aPostGet['sorting'] ?>" />
            <?php
        }
        ?>
    </div>
    <?php
    $this->initAction();
    $this->prepareData();
    $this->includeView('widget_listings_misc_pagination');
    ?>
    <table class="datagrid ml-plist-old-fix">
        <thead >
            <tr>
                    <?php foreach ($this->getFields() as $aFiled) { ?>
                    <td> <?php
                    echo $aFiled['Label'];
                    if ($aFiled['Sorter'] != null) {
                            ?>
                            <input class="noButton ml-right arrowAsc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-asc" title="<?php echo $this->__('Productlist_Header_sSortAsc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                            <input class="noButton ml-right arrowDesc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-desc" title="<?php echo $this->__('Productlist_Header_sSortDesc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
    <?php } ?>
                    </td>
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
                foreach ($this->aData as $i => $item) {
                    ?>
                    <tr <?php echo isset($addStyle) ? $addStyle : '' ?> <?php echo empty($item['PublicText']) ? '' : 'data-ml-modal="#changelogInfo_' . $i . '"'; ?>>
                            <?php
                            foreach ($this->getFields() as $aField) {
                                if ($aField['Field'] != null) {
                                    ?>
                                <td><?php
                                if (array_key_exists($aField['Field'], $item)) {
                                    echo $item[$aField['Field']];
                                }
                                ?></td>
                                <?php
                            } else {
                                echo call_user_func(array($this, $aField['Getter']), $item);
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
<?php
foreach ($this->aData as $i => $item) {
    if (!empty($item['PublicText'])) {
        ?>
            <div id="<?php echo 'changelogInfo_' . $i; ?>" style="display:none;" title="<?php echo $item['Project'] . ' (' . $item['Revision'] . ')'; ?>">
                <dl>
                    <dt><?php echo $item['DateAdded'] ?></dt>
                    <dd><br /><?php echo $item['PublicText']; ?></dd>
                </dl>
            </div>
        <?php
    }
}
?>
    <input type="hidden" id="action" name="<?php echo MLHttp::gi()->parseFormFieldName('action') ?>" value="">
    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('timestamp') ?>" value="<?php echo time() ?>">
    <table class="actions">
        <thead><tr><th><?php echo $this->__('ML_LABEL_ACTIONS') ?></th></tr></thead>
        <tbody>
            <tr>
                <td>
                    <div class="actionBottom">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
<?php if ($this->isSearchable()) { ?>
                                            <div class="newSearch">
                                                <input id="tfSearch" placeholder="<?php $this->__('Productlist_Filter_sSearch') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('tfSearch') ?>" type="text" value="<?php echo fixHTMLUTF8Entities($this->search, ENT_COMPAT) ?>"/>
                                                <button type="submit" class="mlbtn action">
                                                    <span></span>
                                                </button>
                                            </div>
<?php } ?>
                                    </td>
                                    <td class="lastChild">
                                        <table class="right">
                                            <tbody>
                                                <tr>
                                                    <td class="firstChild">
                                                        <!--   @todo hook rightaction -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('form.ml-js-plist').submit(function () {
            jqml.blockUI(blockUILoading);
        });
    });
    /*]]>*/</script>
<?php
$html = ob_get_contents();
ob_end_clean();

echo $html;
?>
