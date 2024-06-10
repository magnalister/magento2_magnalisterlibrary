<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
/* @var $this   ML_Listings_Controller_Listings_Deleted */
$this->includeView('widget_listings_misc_listingbox');
?>
<form action="<?php echo $this->getCurrentUrl() ?>"  method="post" class="ml-plist ml-js-plist">
    <div>
        <?php
        foreach(MLHttp::gi()->getNeededFormFields() as $sName=>$sValue ){
            ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue?>" /><?php
        }

        if (isset($this->aPostGet['sorting'])) { ?>
            <input type="hidden" name="ml[sorting]" value="<?php echo $this->aPostGet['sorting'] ?>" />
            <?php
        }
        ?>
    </div>
    <?php
    $this->initAction();
    $this->prepareData();
    $langCode = MLLanguage::gi()->getCurrentIsoCode();
    $fromDate = date('Y', $this->delFromDate).', '.(date('n', $this->delFromDate) - 1).', '.date('j', $this->delFromDate);
    $toDate   = date('Y', $this->deToDate).', '.(date('n', $this->deToDate) - 1).', '.date('j', $this->deToDate);
    ?>
    <table class="datagrid ml-plist-old-fix">
        <thead>
            <tr>
                <th><?php echo $this->__('Productlist_Time_Period'); ?></th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td class="fullWidth">
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php echo $this->__('Productlist_From'); ?>:</td>
                                    <td>
                                        <input type="text" id="fromDate" readonly="readonly"/>
                                        <input type="hidden" id="fromActualDate" name="<?php echo MLHttp::gi()->parseFormFieldName('date[from]') ?>" value=""/>
                                    </td>
                                    <td><?php echo $this->__('Productlist_To'); ?>:</td>
                                    <td>
                                        <input type="text" id="toDate" readonly="readonly"/>
                                        <input type="hidden" id="toActualDate" name="<?php echo MLHttp::gi()->parseFormFieldName('date[to]') ?>" value=""/>
                                    </td>
                                    <td><input class="mlbtn" type="submit" value="<?php echo $this->__('Productlist_Submit'); ?>"/></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
    </table>
    <script type="text/javascript">
        (function($){
            jqml(document).ready(function() {
                jqml.datepicker.setDefaults(jqml.datepicker.regional['']);
                jqml("#fromDate").datepicker(
                    jqml.datepicker.regional['<?php echo $langCode?>']
                ).datepicker(
                    "option", "altField", "#fromActualDate"
                ).datepicker(
                    "option", "altFormat", "yy-mm-dd"
                ).datepicker(
                    "option", "defaultDate", new Date(<?php echo $fromDate?>)
                );
                var dateFormat = jqml("#fromDate").datepicker("option", "dateFormat");
                jqml("#fromDate").val(jqml.datepicker.formatDate(dateFormat, new Date(<?php echo $fromDate?>)));
                jqml("#fromActualDate").val(jqml.datepicker.formatDate("yy-mm-dd", new Date(<?php echo $fromDate?>)));

                jqml("#toDate").datepicker(
                    jqml.datepicker.regional['<?php echo $langCode?>']
                ).datepicker(
                    "option", "altField", "#toActualDate"
                ).datepicker(
                    "option", "altFormat", "yy-mm-dd"
                ).datepicker(
                    "option", "defaultDate", new Date(<?php echo $toDate?>)
                );
                jqml("#toDate").val(jqml.datepicker.formatDate(dateFormat, new Date(<?php echo $toDate?>)));
                jqml("#toActualDate").val(jqml.datepicker.formatDate("yy-mm-dd", new Date(<?php echo $toDate?>)));
            });
        })(jqml);
    </script>
    <table class="datagrid ml-plist-old-fix">
        <thead>
        <tr>
            <?php foreach ($this->getFields() as $aFiled) { ?>
                <td> <?php
                    echo $aFiled['Label'];
                    if (isset($aFiled['Sorter'])) {
                        if ($aFiled['Sorter'] != null) {
                            ?>
                            <input class="noButton ml-right arrowAsc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-asc" title="<?php echo $this->__('Productlist_Header_sSortAsc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                            <input class="noButton ml-right arrowDesc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-desc" title="<?php echo $this->__('Productlist_Header_sSortDesc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                        <?php } } ?>
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
                ?>
                <tr class="<?php echo(($oddEven = !$oddEven) ? 'odd' : 'even') ?>">
                    <?php
                    foreach ($this->getFields() as $aField) {
                        if ($aField['Field'] != null) {?>
                        <td><?php
                            if (array_key_exists($aField['Field'], $item)) {
                                echo $item[$aField['Field']] ;
                            }?>
                        </td>
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
