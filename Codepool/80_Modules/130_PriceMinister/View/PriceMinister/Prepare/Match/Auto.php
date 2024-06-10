<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<h1><?php echo MLI18n::gi()->get('PriceMinister_Productlist_Match_Auto_Title') ?></h1>
<form id="js-priceminister-auto" action="<?php echo $this->getCurrentUrl() ?>" method="post" title="<?php echo $this->__('ML_AMAZON_LABEL_AUTOMATIC_MATCHING'); ?>">
    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
    <?php } ?>
    <?php $this->includeView('priceminister_prepare_match_forminputs', get_defined_vars()); ?>
    <input type="submit" value="<?php echo $this->__('ML_AMAZON_LABEL_AUTOMATIC_MATCHING') ?>" class="mlbtn"/>
</form>
<script type="text/javascript">/*<![CDATA[*/
    (function ($) {
        $('#js-priceminister-auto').submit(function () {
            $(this).magnalisterRecursiveAjax({
                sOffset: '<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                sAddParam: '<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                oI18n: {
                    sProcess: '<?php echo $this->__s('ML_STATUS_FILTER_SYNC_CONTENT', array('\'')) ?>',
                    sError: '<?php echo $this->__s('ML_ERROR_LABEL', array('\'')) ?>',
                    sSuccess: '<?php echo $this->__s('ML_STATUS_FILTER_SYNC_SUCCESS', array('\'')) ?>',
                },
                onProgessBarClick: function (data) {
                    console.dir({data: data});
                }
            });
            return false;
        });
    })(jqml);
    /*]]>*/</script>

