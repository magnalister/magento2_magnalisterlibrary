<?php
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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php
if (ML::isInstalled()) { ?>
    <div style="display:none;" id="<?php echo $this->getId(); ?>" class="ml-modal ml-modal-notcloseable" title="<?php echo $this->getTitle(); ?>">
        <div class="ml-js-modalPushMessages ml-js-mlMessages">
            <?php $this->includeView('widget_progressbar_messages'); ?>
        </div>
        <div class="viaAjax">
            <?php $this->includeView('widget_progressbar_content'); ?>
        </div>
        <div class="progressBarContainer">
            <?php $this->includeView('widget_progressbar_bar'); ?>
        </div>
        <?php if (MLSetting::gi()->get('blDebug')) { ?>
            <div id="<?php echo $this->getId(); ?>Log" class="console">
                <div class="console-head">Log</div>
                <div class="console-content">
                    <?php $this->includeView('widget_progressbar_log'); ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <div id="<?php echo $this->getId(); ?>" title="<?php echo $this->getTitle(); ?>">
        <div id="ml-loader-installation-wrap">
            <div id="ml-loader-installation">
                <div class="ml-js-modalPushMessages ml-js-mlMessages">
                    <?php $this->includeView('widget_progressbar_messages'); ?>
                </div>
                <div class="viaAjax">
                    <?php $this->includeView('widget_progressbar_content'); ?>
                </div>
                <div class="progressBarContainer">
                    <?php $this->includeView('widget_progressbar_bar'); ?>
                </div>
                <?php if (MLSetting::gi()->get('blDebug')) { ?>
                    <div id="<?php echo $this->getId(); ?>Log" class="console">
                        <div class="console-head">Log</div>
                        <div class="console-content">
                            <?php $this->includeView('widget_progressbar_log'); ?>
                        </div>
                    </div>
                <?php } ?>
                <h1><?php echo MLI18n::gi()->get('installation_content_title') ?></h1>
                <div id="ml-loader-wrap">
                    <?php
                        try {
                            $partner = '?partner='.MLSetting::gi()->get('magnaPartner');
                        } catch (MLSetting_Exception $oEx) {
                            $partner = '';
                        }
                    ?>
                    <img src="<?php echo MLHttp::gi()->getResourceUrl('images/installation_graphic_' . MLI18n::gi()->getLang() . '.png'); ?>" alt="" title="">
                    <div id="installationBox1" class="installationBox">
                        <p><?php echo MLI18n::gi()->get('installation_content_firststep') ?> <a target="_blank" href="<?php echo MLI18n::gi()->get('installation_content_freetest_url').$partner  ?>"><?php echo MLI18n::gi()->get('installation_content_notcutomer') ?></a></p>
                    </div>
                    <div id="installationBox2" class="installationBox">
                        <p><?php echo MLI18n::gi()->get('installation_content_secondstep') ?></p>
                    </div>
                    <div  id="installationBox3"  class="installationBox">
                        <p><?php echo MLI18n::gi()->get('installation_content_thirdstep') ?><a target="_blank" href="<?php echo MLI18n::gi()->get('installation_content_help_url') ?>"><?php echo MLI18n::gi()->get('installation_content_help') ?></a></p>
                    </div>
                    <div  id="installationBox4"  class="installationBox">
                        <p><?php echo MLI18n::gi()->get('installation_content_fourthstep') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
