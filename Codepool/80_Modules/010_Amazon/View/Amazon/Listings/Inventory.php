<?php if (!class_exists('ML', false))
    throw new Exception();
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
/* @var $this   ML_Listings_Controller_Listings_Inventory */
ob_start();
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
    ?>
    <table class="fullWidth nospacing nopadding valigntop topControls"><tbody><tr>
        <td class="actionLeft">
        </td>
        <td>
            <table class="nospacing nopadding right"><tbody><tr>
                <td class="filterRight">
                    <div class="filterWrapper">
                        <form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="js-mlFilter">
                            <select id="filter_business_feature_select">
                                <option value="AMAZON_BUSINESS_ALL"
                                    <?php if (isset($this->aPostGet['businessFeature']) && $this->aPostGet['businessFeature'] === 'AMAZON_BUSINESS_ALL') {
                                        echo 'selected="selected"';
                                    }?>
                                ><?php echo MLI18n::gi()->get('AMAZON_BUSINESS_ALL')?></option>
                                <option value="AMAZON_BUSINESS_STANDARD"
                                    <?php if (isset($this->aPostGet['businessFeature']) && $this->aPostGet['businessFeature'] === 'AMAZON_BUSINESS_STANDARD') {
                                        echo 'selected="selected"';
                                    }?>
                                ><?php echo MLI18n::gi()->get('AMAZON_BUSINESS_STANDARD')?></option>
                                <option value="AMAZON_BUSINESS_B2B"
                                    <?php if (isset($this->aPostGet['businessFeature']) && $this->aPostGet['businessFeature'] === 'AMAZON_BUSINESS_B2B') {
                                        echo 'selected="selected"';
                                    }?>
                                ><?php echo MLI18n::gi()->get('AMAZON_BUSINESS_B2B')?></option>
                                <option value="AMAZON_BUSINESS_B2B_B2C"
                                    <?php if (isset($this->aPostGet['businessFeature']) && $this->aPostGet['businessFeature'] === 'AMAZON_BUSINESS_B2B_B2C') {
                                        echo 'selected="selected"';
                                    }?>
                                ><?php echo MLI18n::gi()->get('AMAZON_BUSINESS_B2B_B2C')?></option>
                            </select>
                            <input type="hidden" id="filter_business_feature_input" name="<?php echo MLHttp::gi()->parseFormFieldName('businessFeature') ?>" value="">
                        </form>
                    </div>
                </td>
            </tr></tbody></table>
        </td>
    </tr></tbody></table>
    <script type="text/javascript">/*<![CDATA[*/
        (function ($) {
            jqml('#filter_business_feature_select').change(function () {
                jqml('#filter_business_feature_input').val(this.value);
                this.closest('form').submit();
            });
        })(jqml);
    /*]]>*/</script>

    <?php $this->includeView('widget_listings_misc_pagination'); ?>
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
                            if ($aFiled['Sorter'] != null) {
                            ?>
                        </div>
                        <div style="min-width: 42px;">
                            <input class="noButton ml-right arrowAsc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-asc" title="<?php echo $this->__('Productlist_Header_sSortAsc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                            <input class="noButton ml-right arrowDesc" type="submit" value="<?php echo $aFiled['Sorter'] ?>-desc" title="<?php echo $this->__('Productlist_Header_sSortDesc') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('sorting'); ?>" />
                        </div>
                        <?php } ?>
                    </div>
                </td>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if (empty($this->aData)) { ?>
            <tr>
                <td colspan="<?php echo count($this->getFields()) + 1; ?>">
                    <?php echo $this->__($this->getEmptyDataLabel()) ?>
                </td>
            </tr>
            <?php
        } else {
            $oddEven = false;
            // Not needed as Link to product can be build without calling the API
            // $asins = implode(',', array_column($this->aData, 'ASIN'));
            // $asinLinks = $this->getASINLinks($asins);
            foreach ($this->aData as $item) {

                $sDetails = htmlspecialchars(str_replace('"', '\\"', serialize(array(
                    'SKU' => $item['SKU'],
                    'Price' => $item['Price'],
                    'Currency' => isset($item['Currency']) ? $item['Currency'] : '',
                ))));
                $addStyle = $item['exits'] ? '' : 'style="color:#e31e1c;"';

                ?>
                <tr <?php echo $addStyle ?>>
                    <td>
                        <input type="checkbox" name="<?php echo MLHttp::gi()->parseFormFieldName('SKUs[]') ?>" value="<?php echo $item['SKU'] ?>">
                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName("details[{$item['SKU']}]") ?>" value="<?php echo $sDetails ?>">
                    </td>
                    <?php
                    foreach ($this->getFields() as $aField) {
                        if ($aField['Field'] != null) {?>
                            <td><?php
                                if (array_key_exists($aField['Field'], $item)) {
                                    echo $item[$aField['Field']] ;
                                }?></td>
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
    <?php if (isset($this->aPostGet['listing']['import'])) { ?>
        <div id="reloaddiag" class="dialog2" title="<?php echo $this->__('ML_LABEL_NOTE') ?>"><?php echo  $this->__('ML_AMAZON_TEXT_REFRESH_REQUEST_SEND') ?></div>
        <script type="text/javascript">
            /*<![CDATA[*/
            jqml(document).ready(function() {
                jqml('#reloaddiag').jDialog();
            });
            /*]]>*/
        </script>
    <?php } ?>
</form>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function() {
        jqml('form.ml-js-plist').submit(function() {
            jqml.blockUI(blockUILoading);
        });
    });
    /*]]>*/</script>
<?php
$html = ob_get_contents();
ob_end_clean();

$this->includeView('widget_listings_misc_listingbox');
$this->includeView('widget_listings_misc_lastreport');
echo $html;
?>
