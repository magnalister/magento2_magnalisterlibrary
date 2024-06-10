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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
/** @var $this ML_Rookie_Controller_Rookie */
 if (!class_exists('ML', false))
     throw new Exception();

$requestTariff = MLRequest::gi()->data('Tariff');

if (!empty($requestTariff)) {
    if ($this->bookNewTariff()) {
        MLMessage::gi()->addSuccess(MLI18n::gi()->get('sUpgradedTariffSuccessful'));
        echo '<meta http-equiv="refresh" content="5; url='.$this->getUrl().'" />';
    } else {
        MLMessage::gi()->addError(MLI18n::gi()->get('sUpgradedTariffFailed'));
    }
} else {
?>

<div id="ml-<?php echo $this->getIdent(); ?>" class="rookie">
    <?php echo $this->getRookieInfo(); ?>
</div>

    <?php
    $y = MLHttp::gi()->getNeededFormFields();
    $x = '';
    foreach ($y as $sName => $sValue) {
        $x .= '<input type="hidden" name="'.$sName.'" value="'.$sValue.'" />';
    }
    $jsFormFields = json_encode($x);
    ?>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $("div.submitFormRight form")
                .append(<?php echo $jsFormFields; ?>)
                .attr('action', <?php echo json_encode($this->getUrl(array('controller' => 'rookie'))); ?>);
        })
    })(jqml);
</script>

<?php }
