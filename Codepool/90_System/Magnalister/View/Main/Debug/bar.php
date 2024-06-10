<?php
if (!class_exists('ML', false))
    throw new Exception();
try {
    if (MLSetting::gi()->get('blDebug')) {
        $aContents = array();
        if (class_exists('MagnaConnector', false) && class_exists('ML_Database_Model_DB', false)) {
            $aContents[] = array(
                'title'    => 'Time',
                'template' => 'time',
                'content'  => array(),
                'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'time'
            );
        }
        if (!MLHttp::gi()->isAjax()) {
            $aContents[] = array(
                'title'    => 'Dev-Settings',
                'template' => 'setting',
                'content'  => '',
                'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'settings'
            );
        }
        if (class_exists('ML_Database_Model_DB', false)) {
            $aContents[] = array(
                'title'    => 'SQL-Log',
                'template' => 'sql-log',
                'content'  => array(),
                'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'sql'
            );
        }
        if (class_exists('MagnaConnector', false)) {
            $aContents[] = array(
                'title'        => 'API-Requests',
                    'template' => 'api-requests',
                    'content' => array(),
                    'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'api'
                );
            }
            if (class_exists('\ML_Shopify_Helper_ShopifyInterfaceRequestHelper', false)) {
                $aContents[] = array(
                    'title' => 'Shopify-API-Requests',
                    'template' => 'shopify-api-requests',
                    'content' => array(),
                    'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'shopify-api'
                );
            }
            if (class_exists('\ML_ShopwareCloud_Helper_ShopwareCloudInterfaceRequestHelper', false)) {
                $aContents[] = array(
                    'title' => 'Shopware-Cloud-API-Requests',
                    'template' => 'shopwarecloud-api-requests',
                    'content' => array(),
                    'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'shopwarecloud-api'
                );
            }
        try {
            MLImage::gi();
            $aContents[] = array(
                'title' => 'Image Processing Time',
                'template' => 'image',
                'content' => array(),
                'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'image'
            );
        } catch (Exception $ex) {

        }
            if (!MLHttp::gi()->isAjax()) {
                try {
                    $aContents[] = array(
                        'title'    => 'Modul-Config',
                        'template' => 'print_m',
                        'content'  => MLModule::gi()->getConfigAndDefaultConfig(),
                        'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'config'
                    );
                } catch (Exception $oEx) {
                }
            }
            try {
                $aData=MLRequest::gi()->data();
                $aContents[] = array(
                    'title' => 'HTTP-Request', 
                    'template' => 'dbug',
                    'content' => array(
                        'Controller' => MLSetting::gi()->sMainController.(isset($aData['method']) ? '::callAjax'.ucfirst($aData['method']).'()' : ''), 
                        'Request'=>$aData
                    ),
                    'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'request'
                );
            } catch (Exception $oEx) {
            }
            if (!MLHttp::gi()->isAjax()) {
                $aContents[] = array(
                    'id' => 'ajax',
                    'title' => 'Ajax', 
                    'template' => 'ajax',
                    'content' => array()
                );
            }
            $aContents[] = array(
                'title' => 'Messages',
                'template' => 'Messages',
                'content' => array(),
                'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'messages'
            );
            if (!MLHttp::gi()->isAjax()) {
                $aContents[] = array(
                    'title' => 'Session', 
                    'template' => 'print_m',
                    'content' => MLSession::gi()->data(),
                    'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'session'
                );
            }
            try {
                $aContents[] = array(
                    'title' => 'Class-Tree',
                    'template' => 'class-tree',
                    'content' => MLSetting::gi()->get('aDevBar-ClassTree'),
                    'selected' => MLSetting::gi()->data('sShowToolsMenu') == 'tree'
                );
            } catch (Exception $oEx) {
            }
            $blStatic = false;
            foreach ($aContents as $iContent=>$aContent) {        
                $aContents[$iContent]['id'] = array_key_exists('id', $aContents[$iContent]) ? $aContents[$iContent]['id'] : (MLHttp::gi()->isAjax() ? uniqid().'_ajax' : md5($aContent['title']));        
                $aContents[$iContent]['rendered'] = trim($this->includeViewBuffered('main_debug_bar_'.strtolower($aContent['template']), array('aContent'=>$aContent['content'])));
                if (
                    !empty($aContents[$iContent]['rendered']) && 
                    MLSetting::gi()->data('sShowToolsMenu') != '' && 
                    isset($aContents[$iContent]['selected']) && 
                    $aContents[$iContent]['selected']
                ) {
                    $blStatic = true;
                } else {
                    $aContents[$iContent]['selected'] = false;
                }
            }
            if (!empty($aContents)) {
                ?>
                    <div<?php echo MLHttp::gi()->isAjax()?'':' id="devBar"';?> class="ml-js-noBlockUi magnamain<?php echo MLHttp::gi()->isAjax()?'':' dialog2' ?><?php echo $blStatic ? ' static' : '' ?>" title="Debug">
                        <div class="magnaTabs2">
                            <ul>
                                <?php 
                                    foreach ($aContents as $iContent=>$aContent) {
                                        if (!empty($aContent['rendered'])) {
                                            ?><li<?php echo $aContent['selected'] ? ' class="selected"' : ''; ?>><a href="#devBar-<?php echo $aContent['id']; ?>"><?php echo $aContent['title'] ?></a></li><?php
                                        }
                                     } 
                                ?>
                            </ul>
                        </div>
                        <div class="clear"></div>
                        <div class="devContent">
                            <?php 
                                foreach($aContents as $aContent) {
                                    if (!empty($aContent['rendered'])) { 
                                        ?><div id="devBar-<?php echo $aContent['id'] ?>"<?php echo $aContent['selected'] ? ' style="display:block;"' : ''; ?>><?php 
                                            echo $aContent['rendered']
                                        ?></div><?php 
                                    }
                                } 
                            ?>
                        </div>
                    </div>
                <?php
            }
        }else{
            ?><!--<?php echo "\n".strip_tags(str_replace('&nbsp;',' ',$this->includeViewBuffered('main_debug_bar_time', array('aContent'=>array()))))."\n"; ?>--><?php
        }
    } catch (Exception $oEx) {
        echo $oEx->getMessage();
    }
    if(!MLHttp::gi()->isAjax()){
        MLSettingRegistry::gi()->addJs('magnalister.debugbar.js');
        MLSetting::gi()->add('aCss', 'magnalister.debugbar.css?%s', true);
    }
?>