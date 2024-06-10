<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php
MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
/* @var $this   ML_Listings_Controller_Listings_Deleted */
$this->includeView('widget_listings_misc_listingbox');
?>
<form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="ml-plist ml-js-plist">
    <div>
        <?php
        foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
            ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
        }

        if (isset($this->aPostGet['sorting'])) { ?>
            <input type="hidden" name="ml[sorting]" value="<?php echo $this->aPostGet['sorting'] ?>"/>
            <?php
        }
        ?>
    </div>
    <?php
    $this->initAction();
    $this->prepareData();
    $this->includeView('widget_listings_misc_pagination'); ?>
    <table class="datagrid ml-plist-old-fix">
        <thead>
        <tr>
            <td class="nowrap" style="width: 5px;">
                <input type="checkbox" id="selectAll"/><label for="selectAll"><?php echo $this->__('ML_LABEL_CHOICE') ?></label>
                </td>
                <?php foreach ($this->getFields() as $aFiled) { ?>            
                    <td>
                        <div class="ml-inventory-th">
                            <div> <?php
                                echo $aFiled['Label'];
                                if (isset($aFiled['Sorter'])) {
                                if ($aFiled['Sorter'] != null) {
                                ?>
                            </div>
                            <div style="min-width: 42px">
                                <input class="noButton ml-right arrowAsc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-asc" title="<?php echo $this->__('Productlist_Header_sSortAsc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                                <input class="noButton ml-right arrowDesc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-desc" title="<?php echo $this->__('Productlist_Header_sSortDesc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                            </div>
                                <?php } } ?>
                        </div>

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
                foreach ($this->aData as $item) {
                    $commissiondate = strtotime($item['timestamp']);
                    ?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo MLHttp::gi()->parseFormFieldName('delIDs[]') ?>" value="<?php echo $item['id'] ?>"></td>
                        <td><?php echo fixHTMLUTF8Entities(empty($item['title']) ? $item['productsSku'] : $item['title']) ?></td>
                        <td>
                            <ul>
                                <li>
                                    <?php echo $item['categorypath'] ?>
                                </li>
                            </ul>
                        </td>
                        <td><?php echo MLPrice::factory()->format($item['price'], $this->sCurrency) ?></td>
                        <td> <?php echo date("d.m.Y", $commissiondate) ?> &nbsp;&nbsp;<span class="small"><?php echo date("H:i", $commissiondate) ?></span></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php $this->includeView('widget_listings_misc_action'); ?>

    <script type="text/javascript">/*<![CDATA[*/
        jqml(document).ready(function() {
            jqml('#selectAll').click(function() {
                state = jqml(this).attr('checked') !== undefined;
                jqml('.ml-js-plist input[type="checkbox"]:not([disabled])').each(function() {
                    jqml(this).attr('checked', state);
                });
            });
        });
        /*]]>*/</script>
</form>