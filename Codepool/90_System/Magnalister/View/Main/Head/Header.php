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

/* @var $this  ML_Core_Controller_Abstract */
if (!class_exists('ML', false))
    throw new Exception(); ?>
<style>
    @-moz-keyframes ml-css-spin {
        0% {
            -moz-transform: rotate(0deg);
        }
        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes ml-css-spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes ml-css-spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .ml-css-loading {
        -o-box-sizing: border-box;
        -ie-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -moz-animation: ml-css-spin .8s infinite linear;
        -webkit-animation: ml-css-spin .8s infinite linear;
        animation: ml-css-spin .8s infinite linear;
    }
</style>
<script type="text/javascript">/*<![CDATA[*/
    var debugging = <?php echo (MLSetting::gi()->get('blDebug')) ? 'true' : 'false'; ?>;
    if ((debugging === true) && window.console) {
        var myConsole = console;
    } else {
        var myConsole = {
                log: function(){},
                debug: function(){},
                info: function(){},
                warn: function(){},
                error: function(){},
                assert: function(){},
                dir: function(){},
                dirxml: function(){},
                trace: function(){},
                table: function(){},
                group: function(){},
                groupEnd: function(){},
                time: function(){},
                timeEnd: function(){},
                profile: function(){},
                profileEnd: function(){},
                count: function(){},
                table: function(){}
            }
        }

        var blockUICSS = {
            'border': 'none',
            'padding': '15px',
            'background-color': '#deded7',
            'border-radius': '10px',
            '-moz-border-radius': '10px',
            '-webkit-border-radius': '10px',
            'opacity': '0.8',
            'color': '#000',
            'font-size': '15px',
            'font-weight': 'bold'
        };
        var blockUIMessage = '<span><?php echo MLI18n::gi()->get('ML_TEXT_PLEASE_WAIT'); ?></span>';
        var numberOfLoading = 0;
        var blockUILoading = {
            overlayCSS: {
                'background-color': '#fff',
                'opacity': '0.8',
                'z-index': '9000'
            },
            css: {
                'width': '32px',
                'height': '32px',
                'border-width': '4px',
                'border-style': 'solid',
                'border-color': 'rgba(199, 53, 47, 0.25) rgba(199, 53, 47, 0.25) rgba(199, 53, 47, 0.25) rgba(199, 53, 47, 1)',
                'border-radius': '32px',
                'padding': '0',
                'left': '50%',
                'margin': '0 0 0 -16px',
                'padding': '0',
                'top': '300px',
                'z-index': '9999',
                'background': 'transparent'
            },
            blockMsgClass: 'ml-css-loading',
            message: '<div></div>',
            onBlock: function() {
                jqml('.blockUI.ml-css-loading.blockPage').bind('dblclick', function() {
                    jqml.unblockUI();
                });
            }
        };
        var blockUIProgress = {
            overlayCSS: {
                'background': '#000',
                'opacity': '0.1',
                'z-index': '9000'
            },
            css: {
                'background': '#fff',
                'width': '300px',
                'margin-left': '-150px',
                'height': '25px',
                'left': '50%',
                'padding': '10px',
                'border': 'none',
                'border-radius': '10px',
                '-moz-border-radius': '10px',
                '-webkit-border-radius': '10px',
                'box-shadow': '0 0 20px #000000',
                '-moz-box-shadow': '0 0 20px #000000',
                '-webkit-box-shadow': '0 0 20px #000000',
                'z-index': '9001'
            },
            message: '<div class="progressBarContainer"><div class="progressBar"></div><div class="progressPercent">0%</div></div>'
        };

        /* Preload Loading Animation */
        progressbarImage = new Image();
        progressbarImage.src = "<?php echo MLHttp::gi()->getResourceUrl('images/progressbar.png')?>";
        jqml(document).ready(function() {
        jqml("body").everyTime('120s', 'keepAlive', function(i) {
            jqml.get(
                "<?php echo MLHttp::gi()->getUrl(); ?>", {
                    '<?php echo MLHttp::gi()->parseFormFieldName('do')?>':'keepAlive'
                },
                function(data) {
                //myConsole.log(data);
                }
            ).fail(function() {
                jqml("body").stop(true).stopTime('keepAlive');
            });
        });
    });
/*]]>*/</script>
<!--[if lt IE 9]><script type="text/javascript">/*<![CDATA[*/
    (function($) {
        jqml(document).ready(function() {
            jqml('div.magnamain').each(function() {
                jqml(this).css({height: this.scrollHeight < 181 ? "180px" : "auto"});
            });
        });
    })(jqml);
/*]]>*/</script><![endif]-->
<!--<devBar />-->
<h1 id="magnalogo" data-mlNeededFormFields='<?php echo count(MLHttp::gi()->getNeededFormFields()) == 0 ? '{}' : json_encode(MLHttp::gi()->getNeededFormFields());?>'>
    <a href="<?php echo $this->getUrl() ?>" title="<?php echo $this->__('ML_HEADLINE_MAIN'); ?>">
        <img src="<?php echo MLHttp::gi()->getResourceUrl('images/magnalister_logo.svg') ; ?>" alt="<?php echo $this->__('ML_HEADLINE_MAIN'); ?>" width="166"/>
    </a>
</h1>
<?php if(MLSetting::gi()->get('blShowInfos')){
    try {
        $aModul = MLModule::gi()->getConfig();
    } catch (Exception $oEx) {
        $aModul = null;
    }
    ?>
<?php } ?>
<?php
    $oProgress =
        MLController::gi('widget_progressbar')
        ->setId('updatePlugin')
        ->setTitle(MLI18n::gi()->get('sModal_'.(ML::gi()->isUpdate() ? 'update' : 'install' ).'Plugin_title'))
        ->setContent(MLI18n::gi()->get('sModal_'.(ML::gi()->isUpdate() ? 'update' : 'install' ).'Plugin_content_init'))
        ->setTotal(isset($aAjaxData['Total']) ? $aAjaxData['Total'] : 100)
        ->setDone(isset($aAjaxData['Done']) ? $aAjaxData['Done'] : 0)
        ->render()
    ;

    // had issues on Magento 2 with exists function that is why ewe change it to this query
    if (!MLDatabase::getDbInstance()->fetchOne('SELECT value FROM ' . MLDatabase::factory('config')->getTableName() . ' WHERE mkey = "after-update" AND mpID = "0"')) {// be sure update-scripts are done
        ?>
            <a id="ml-js-after-update" data-ml-modal="#<?php echo $oProgress->getId(); ?>" href="<?php echo $this->getUrl(array('do'=>'update', 'method'=>'afterUpdate')); ?>" data-ml-global-ajax='{"triggerAfterSuccess":"currentUrl"}' title="After update"  class="global-ajax ml-js-noBlockUi" style="display:none;"></a>
            <script type="text/javascript">/*<![CDATA[*/
            (function($) {
                jqml(document).ready(function(){
                    jqml('#ml-js-after-update').trigger('click');
                });
            })(jqml);
            /*]]>*/</script>
        <?php
    }
?>
<div id="globalButtonBox"><?php
    require_once MLFilesystem::getOldLibPath('php/callback/callbackFunctions.php');
    $aSteps=array();
    if(!MLMessage::gi()->haveFatal()){
        $aTabIdents=  MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.tabident')->get('value');
        foreach(MLHelper::gi('Marketplace')->magnaGetInvolvedMarketplaces() as $sMarketPlace){
            foreach(MLHelper::gi('Marketplace')->magnaGetInvolvedMPIDs($sMarketPlace) as $iMarketPlace){
                $aSteps['all'][] =
                $aSteps[$sMarketPlace] [] = array(
                    'sKey' =>  MLHttp::gi()->parseFormFieldName('mpid'),
                    'sValue' => $iMarketPlace,
                    'sI18n' => MLI18n::gi()->get('sModuleName'.ucfirst($sMarketPlace)).' ('.(isset($aTabIdents[$iMarketPlace])&&$aTabIdents[$iMarketPlace]!=''?$aTabIdents[$iMarketPlace].' - ':'').$iMarketPlace.')'
                );
            }
        }
    }
    foreach ($this->getButtons() as $blargh) {
        if (isset($blargh['type']) && $blargh['type'] === 'cron' ) {
            if ($blargh['enabled'] === true) {
                if(isset($aSteps[(isset($blargh['mpFilter']) ? $blargh['mpFilter'] : 'all')])){?>
                <a data-warning-title="<?php echo isset($blargh['warningTitle'])?htmlentities(json_encode( MLI18N::gi()->{$blargh['warningTitle']})):''; ?>"  data-warning-text="<?php echo isset($blargh['warningText'])?htmlentities(json_encode( MLI18N::gi()->{$blargh['warningText']})):''; ?>"  data-steps="<?php echo htmlentities(json_encode($aSteps[(isset($blargh['mpFilter']) ? $blargh['mpFilter'] : 'all')])); ?>" class="gfxbutton border cron ml-js-noBlockUi <?php echo $blargh['icon']; ?>" href="<?php echo $this->getUrl($blargh['link']); ?>" title="<?php echo $this->__($blargh['title']); ?>"></a>
                <?php }
            }else{ ?>
                <a style="opacity:0.4"  id ="<?php echo $blargh['id']  ?>"  class="gfxbutton border ml-js-noBlockUi <?php echo $blargh['icon']; ?>" href="<?php echo $this->getCurrentUrl(); ?>" title="<?php echo $this->__($blargh['title']); ?>"></a>
                <script type="text/javascript">/*<![CDATA[*/
                    (function ($) {
                        jqml(document).ready(function () {
                            jqml('<?php echo '#' . $blargh['id'] ?>').click(function (event) {
                                event.preventDefault();
                                jqml('<div><?php echo str_replace(array("\n", "\r", "'"), array('', '', "\\'"), '<div class="ml-addAddonError"></div>' . $blargh['disablemessage']) ?></div>').dialog({
                                    modal: true,
                                    width: '600px',
                                    buttons: {
                                        "<?php echo str_replace('"', '\"', $this->__('ML_BUTTON_LABEL_OK')); ?>": function () {
                                            jqml(this).dialog("close");
                                        }
                                    }
                                });
                            });
                        });
                    })(jqml);
                /*]]>*/</script><?php
            }
        } elseif(!MLSetting::gi()->blHideUpdate || MLSetting::gi()->blDev) {
            $blUpdate = true;
            if ($blargh['title'] == 'ML_LABEL_UPDATE') {
                try {
                    MLHelper::getFilesystemInstance()->updateTest();
                } catch (ML_Core_Exception_Update $oEx) {
                    ?><a data-ml-modal="#ml-notUpdateable" href="#ml-notUpdateable" class="gfxbutton border global-ajax ml-js-noBlockUi <?php echo $blargh['icon']; ?> " title="<?php echo $this->__($blargh['title']) ?>"></a><?php
                    ?>
                        <div id="ml-notUpdateable" class="ml-modal" title="<?php echo $this->__('sNotUpdateable_title'); ?>"><?php echo $oEx->getTranslation(); ?></div>
                    <?php
                    continue;
                }
            }
            ?>
            <a id="ml-show-update-admission" href="<?php echo $this->getUrl($blargh['link']); ?>" class="gfxbutton border ml-js-noBlockUi <?php echo $blargh['icon']; ?> " title="<?php echo $this->__($blargh['title']) ?>"></a>
            <a id="ml-run-update" data-ml-modal="#<?php echo $oProgress->getId(); ?>" class="global-ajax ml-js-noBlockUi"  href="<?php echo $this->getUrl($blargh['link']); ?>" data-ml-global-ajax='{"triggerAfterSuccess":"currentUrl", "retryOnError": true}'></a><?php
        }
    }
    if (MLSetting::gi()->get('blDebug')) {
        ?>
        <a data-ml-modal="#<?php echo $oProgress->getId(); ?>" href="<?php echo $this->getUrl(array('do' => 'update', 'method' => 'afterUpdate')); ?>" data-ml-global-ajax='{"triggerAfterSuccess":"currentUrl", "retryOnError": true}' title="After update"  class="gfxbutton border global-ajax ml-js-noBlockUi update" style="background-color:#cdd4ff;"></a><?php
        ?>
        <a href="<?php echo $this->getUrl(array('controller' => 'main_tools_filesystem_cache', 'deleteallcache' => 'Delete All Cache')); ?>" title="Delete All Cache" target="_blank" class="gfxbutton border ml-js-noBlockUi deletecache" style="background-color:#cdd4ff;background-image: none"></a><?php
    }
    MLSettingRegistry::gi()->addJs('jquery.magnalisterRecursiveAjax.js');
    ?>
    <script type="text/javascript">/*<![CDATA[*/

        jqml(document).ready(function(){
            jqml('#globalButtonBox a.cron').click(function(){
                var cronWarning = JSON.parse(jqml(this).attr('data-warning-text'));
                var cronTitle = JSON.parse(jqml(this).attr('data-warning-title'));
                var hasCron = jqml(this).hasClass('cron');
                var steps = jqml(this).data('steps');
                var currentA = jqml(this);
                jqml('<div class="ml-modal dialog2" title="' + cronTitle + '">' + cronWarning + '</div>').jDialog({
                    width: '500px',
                    buttons: {
                        Cancel: {
                            'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>',
                            click: function () {
                                jqml(this).dialog('close');
                            }
                        },
                        Ok: {
                            'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_OK')); ?>',
                            click: function () {

                                var aSteps=[];
                                if(hasCron){
                                    aSteps = steps;
                                }
                                currentA.magnalisterRecursiveAjax({
                                    sOffset:'<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                                    sAddParam:'<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                                    aSteps: aSteps,
                                    oI18n:{
                                        sProcess    : '<?php echo $this->__s('ML_STATUS_FILTER_SYNC_CONTENT',array('\'')) ?>',
                                        sError      : '<?php echo $this->__s('ML_ERROR_LABEL',array('\'')) ?>',
                                        sSuccess    : '<?php echo $this->__s('ML_STATUS_FILTER_SYNC_SUCCESS',array('\'')) ?>'
                                    },
                                    onFinalize: function(){
                                        window.location=window.location;//reload without post
                                    },
                                    onProgessBarClick:function(data){
                                        console.dir({data:data});
                                    },
                                });
                                jqml(this).dialog('close');
                            }
                        }
                    }
                });
                return false;
            });

            jqml('#ml-show-update-admission').click(function(event) {
                event.preventDefault();
                jqml('<div class="ml-modal dialog2" title="<?php echo addslashes(MLI18n::gi()->get('ML_MESSAGE_BEFORE_UPDATE_TITLE')) ?>"><?php echo addslashes(MLI18n::gi()->get('ML_MESSAGE_BEFORE_UPDATE_TEXT')) ?></div>').jDialog({
                    width: '500px',
                    buttons: {
                        Cancel: {
                            'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>',
                            click: function () {
                                jqml(this).dialog('close');
                            }
                        },
                        Ok: {
                            'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_OK')); ?>',
                            click: function () {
                                jqml('#ml-run-update').click();
                                jqml(this).dialog('close');
                            }
                        }
                    }
                });
            });
        });
    /*]]>*/</script>
</div>
<div class="visualClear">&nbsp;</div>
