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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
$localClientBuild = MLSetting::gi()->data('sClientBuild');
$localClientBuild = empty($localClientBuild) ? $this->__('ML_LABEL_UNKNOWN') : $localClientBuild;
$currentClientBuild = MLSetting::gi()->data('sCurrentBuild');
/** @var ML_Core_Controller_Abstract $this */
$currentClientBuild = empty($currentClientBuild) ? $this->__('ML_LABEL_UNKNOWN') : $currentClientBuild;
$iCustomerId = MLShop::gi()->getCustomerId();
$iShopId = MLShop::gi()->getShopId();

?>
<div id="magnafooter">
    <table class="magnaframe small center">
        <tbody>
        <tr>
            <td rowspan="2" class="ml-td-left">
				<span class="customerinfo"><?php
					echo $this->__('ML_LABEL_CUSTOMERSID').': '.(($iCustomerId > 0) ? $iCustomerId : $this->__('ML_LABEL_UNKNOWN')).' :: '.
					'Shop ID: '.(($iShopId > 0) ? $iShopId : $this->__('ML_LABEL_UNKNOWN'))
				?></span>
			</td>
			<td class="ml-td-center">
                <?php $this->includeView('main_foot_footer_version') ?>
			</td>
			<td rowspan="2" class="ml-td-right">
				<span class="build">
                    <?php if((!MLSetting::gi()->blHideUpdate && MLShop::gi()->getShopSystemName() !== 'shopware') || MLSetting::gi()->blDev) {?>
                        Build: <?php echo $localClientBuild; ?> ::
                        <a href="<?php echo $this->getUrl(array('content'=>'changelog')); ?>" title="Changelog">Latest: <?php echo $currentClientBuild; ?></a>
                    <?php }else {?>
                        <a href="<?php echo $this->getUrl(array('content'=>'changelog')); ?>" title="Changelog">Build: <?php echo $localClientBuild; ?></a>
                     <?php }?>
				</span>
			</td>
		</tr>
		<tr>
			<td class="ml-td-center">
				<div class="copyleft"><?php echo $this->__('ML_LABEL_COPYLEFT'); ?></div>
			</td>
		</tr>
	</tbody></table>
</div>

<?php
MLMessage::gi()->addDebug(MLI18n::gi()->getLang());
switch (strtolower(MLI18n::gi()->getLang())) {
    case 'de': {
        // German
        $sUrl = 'https://embed.tawk.to/5b73efaaafc2c34e96e7976e/default';
        break;
    }
    case 'fr': {
        // French
        $sUrl = 'https://embed.tawk.to/5b73f645f31d0f771d83cf15/default';
        break;
    }
    default: {
        // English
        $sUrl = 'https://embed.tawk.to/5b73f63aafc2c34e96e79794/default';
        break;
    }
}
?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='<?php echo $sUrl; ?>';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
