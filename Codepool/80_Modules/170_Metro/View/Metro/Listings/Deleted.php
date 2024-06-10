<?php if (!class_exists('ML', false))
    throw new Exception();
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
/* @var $this   ML_Listings_Controller_Widget_Listings_InventoryAbstract */
$this->includeView('widget_listings_misc_listingbox');
$this->includeView('widget_listings_misc_lastreport');
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
            <?php foreach ($this->getFields() as $aFiled) { ?>
                <td>
                    <div class="ml-inventory-th">
                        <div> <?php
                            echo $aFiled['Label'];
                            if ($aFiled['Sorter'] != null) {
                            ?>
                        </div>
                            <div style="min-width: 42px;">
                                <input class="noButton ml-right arrowAsc" type="submit"
                                       value="<?php echo $aFiled['Sorter'] ?>-asc"
                                       title="<?php echo $this->__('Productlist_Header_sSortAsc') ?>"
                                       name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>"/>
                                <input class="noButton ml-right arrowDesc" type="submit"
                                       value="<?php echo $aFiled['Sorter'] ?>-desc"
                                       title="<?php echo $this->__('Productlist_Header_sSortDesc') ?>"
                                       name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>"/>
                            </div>

                        <?php } ?>
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
                $sDetails = htmlspecialchars(str_replace('"', '\\"', serialize(array(
                    'SKU' => $item['ArticleSKU'],
                    'Price' => $item['Price'],
                    'Currency' => isset($item['Currency']) ? $item['Currency'] : '',
                ))));
                ?>
                <tr class="<?php echo(($oddEven = !$oddEven) ? 'odd' : 'even') ?>">
                    <?php
                    foreach ($this->getFields() as $aField) {
                        if ($aField['Field'] != null) { ?>
                            <td><?php
                                if (array_key_exists($aField['Field'], $item)) {
                                    echo $item[$aField['Field']];
                                } ?></td>
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
</form>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('form.ml-js-plist').submit(function () {
            jqml.blockUI(blockUILoading);
        });
    });
    /*]]>*/</script>

