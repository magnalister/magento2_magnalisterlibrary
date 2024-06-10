<?php 
    $aAjaxData = MLSetting::gi()->get('aAjax');
    $oProgress = 
        MLController::gi('widget_progressbar')
        ->setId('updatePlugin')
        ->setTitle(MLI18n::gi()->get('sModal_'.(ML::gi()->isUpdate() ? 'update' : 'install' ).'Plugin_title'))
        ->setContent(MLI18n::gi()->get('sModal_'.(ML::gi()->isUpdate() ? 'update' : 'install' ).'Plugin_content_init'))
        ->setTotal(isset($aAjaxData['Total']) ? $aAjaxData['Total'] : 100)
        ->setDone(isset($aAjaxData['Done']) ? $aAjaxData['Done'] : 0)
    ;
?>
<?php if (MLHttp::gi()->isAjax()) { ?>
    <?php $oProgress->render(); ?>
<?php } else { ?>
    <div class="magna" id="magnaInstaller" data-mlNeededFormFields='<?php echo count(MLHttp::gi()->getNeededFormFields()) == 0 ? '{}' : json_encode(MLHttp::gi()->getNeededFormFields()); ?>'>   
    <?php
        $this->includeView('widget_js_i18n');
    ?>
        <?php if (MLMessage::gi()->haveFatal()) { ?>
            <div id="ml-js-pushMessages" style="padding-top: 1em;">
                <?php  MLController::gi('widget_message')->renderFatal(); ?>
            </div>
        <?php } else { ?>
            <?php 
                foreach (MLSetting::gi()->get('aInstallCss') as $sFile) {
                    ?><style type="text/css"><?php
                        $aFile = MLFilesystem::gi()->findResource('resource_css_'.$sFile);
                        echo file_get_contents($aFile['path']);
                    ?></style><?php
                }
                foreach (MLSetting::gi()->get('aInstallJs') as $sFile) {
                    ?><script type="text/javascript">/*<![CDATA[*/<?php
                        $aFile = MLFilesystem::gi()->findResource('resource_js_'.$sFile);
                        echo file_get_contents($aFile['path']);
                    ?>/*]]>*/</script><?php
                }
            ?>
            <div id="ml-js-pushMessages" style="margin-top:0;"><?php 
                MLController::gi('widget_message')
                    ->renderSuccess()
                    ->renderInfo()
                    ->renderWarn()
                    ->renderNotice()
                    ->renderError()
                    ->renderFatal()
                ;
            ?></div>
            <?php $oProgress->render(); ?>
            <a class="global-ajax ml-global-ajax-triggerAfterSuccessCurrentUrl" data-ml-global-ajax='{"triggerAfterSuccess":"currentUrl", "retryOnError": true}' style="display:none;" id="updateMLPlugin" href="<?php echo MLHttp::gi()->getUrl(array('do' => 'update', 'method' => 'init')); ?>"></a>
            <script type="text/javascript">/*<![CDATA[*/ 
                (function($) {
                    $(document).ready(function() {
                        $("#updateMLPlugin").trigger('click');
                    });
                })(jqml);
            /*]]>*/</script>
        <?php } ?>
    </div>
<?php } ?>