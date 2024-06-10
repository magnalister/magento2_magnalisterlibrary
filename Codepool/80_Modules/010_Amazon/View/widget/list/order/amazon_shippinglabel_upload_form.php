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

/* @var $this ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Form */
 if (!class_exists('ML', false))
     throw new Exception();
//        new dBug($aStatistic);
//        new dBug($oList->getHead());
//        new dBug(array('product'=>$oList->getList()->current(),'data'=>$oList->getList()->current()->mixedData()));
?>
<div class="ml-plist <?php echo MLModule::gi()->getMarketPlaceName(); ?>">
    <?php
    $sMpId = MLModule::gi()->getMarketPlaceId();
    $sMpName = MLModule::gi()->getMarketPlaceName();
    $aStatistic = isset($aStatistic) ? $aStatistic : array();
    ?>
    <form action="<?php echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_shippinglabel_upload_shippingmethod")); ?>" method="post">

        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
        <?php } ?>
        <?php
        $this->includeView('widget_list_order_list', get_defined_vars());
        $this
                ->includeView('widget_list_order_action_bottom', array('oList' => $oList, 'aStatistic' => $aStatistic))
        ;
        MLSettingRegistry::gi()->addJs('magnalister.productlist.js');
        MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
        ?>
        <script type="text/javascript">/*<![CDATA[*/
            (function ($) {
                jqml(document).ready(function () {
                    jqml('.ml-shippinglabel-configshipping').change(function (e) {
                        var element = jqml(this)[0];
                        var index = element.selectedIndex;
                        var selectedValue = element.options[index].value;
                        var sizes = selectedValue.split("-");
                        jqml('#' + jqml(this).attr('id') + 'length').val(sizes[0]);
                        jqml('#' + jqml(this).attr('id') + "width").val(sizes[1]);
                        jqml('#' + jqml(this).attr('id') + "height").val(sizes[2]);
                    });

                    jqml('.ml-shippinglabel-quantity').change(function (e) {
                        var totalweight = 0; 
                        jqml('.ml-shippinglabel-quantity.ml-shippinglabel-orderid-'+jqml(this).attr('data')).each(function(index){
                            var element = jqml(this)[0];
                            var index = element.selectedIndex;
                            var quantity = element.options[index].value;
                            var weight = jqml(this).parent().find('.ml-shippinglable-product-weight').val();
                            totalweight += quantity * weight;
                        });
                        jqml('.ml-shippinglabel-weight-'+jqml(this).attr('data')).val(totalweight);
                    });

                });
            })(jqml);
            /*]]>*/</script>

    </form>
</div>