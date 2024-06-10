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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

abstract class ML_Modul_Helper_Widget_TopTen_Abstract extends ML_Core_Controller_Abstract{

    protected $aParameters = array('controller');
    /**
     * id of current marketplace
     * @var in $iMarketePlaceId
     */
    protected $iMarketPlaceId = null;
    public function __construct() {
        parent::__construct();
        $this->setMarketPlaceId(MLModule::gi()->getMarketPlaceId());
    }
    /**
     * setter
     * @param int $iId
     */
    public function setMarketPlaceId($iId){
        $this->iMarketPlaceId = $iId;
    }
    abstract public function getTopTenCategories($sType, $aConfig = array());
    abstract public function configCopy();
    abstract public function configDelete($aDelete);
    abstract public function renderConfigDelete($aDelete = array());

    protected function getMarketPlaceType(){
        return substr(get_class($this), 0, strlen(get_class($this))-6);//6=strlen(topTen)
    }
    /**
     * render main-config part and button for dialog + js
     * @param string $sKey config-name
     * @param int $iCurrentValue current config value
     * @return string html
     */
    public function renderMain($sKey, $iCurrentValue){
        ob_start();
        ?>
        <select name="conf[<?php echo $sKey ?>]">
            <?php foreach(array(
                              10  => '10',
                              20  => '20',
                              30  => '30',
                              40  => '40',
                              50  => '50',
                              60  => '60',
                              70  => '70',
                              80  => '80',
                              90  => '90',
                              100 => '100',
                              0   => 'Alle',
                          ) as $iKey => $sValue){ ?>
                <option value="<?php echo $iKey.'"'.($iKey==$iCurrentValue?' selected="selected"':'') ?>"><?php echo $sValue ?></option>
            <?php } ?>
        </select>
        <input class="button" type="button" value="<?php echo ML_TOPTEN_MANAGE ?>" id="edit-topTen" />
        <script type="text/javascript">/*<!CDATA[*/
            jqml(document).ready(function(){
                jqml("#edit-topTen").click(function(){
                    //create dialog
                    var eDialog = jqml('<div class="dialog2" title="<?php echo $this->getMarketPlaceType().' '.ML_TOPTEN_MANAGE_HEAD ?>"></div>');
                    eDialog.bind('ml-init', function(event, argument){//behavior
                        jqml( this ).find('.successBox').each(function(){
                            jqml(this).fadeOut(5000);
                        });
                        jqml( this ).find('button').button({'disabled':false});
                        jqml('.ui-widget-overlay').css({zIndex:1001, cursor:'auto'});
                    });
                    eDialog.bind('ml-load', function(event, argument){//behavior
                        jqml('.ui-widget-overlay').css({zIndex:99999, cursor:'wait'});
                    });
                    jqml("body").append(eDialog);
                    eDialog.jDialog({
                        buttons: {},
                        position: { my: "center center", at: "center top+80", of: window },
                        close: function(event, ui){
                            eDialog.remove();
                        }
                    });
                    eDialog.trigger('ml-load');
                    jqml.ajax({
                        method: 'get',
                        url: '<?php echo $this->getCurrentUrl(array_merge(MLHttp::gi()->getNeededFormFields(), array('what' => 'topTenConfig', 'kind' => 'ajax', 'ajax'=>'true')))?>',
                        success: function (data) {
                            //tabs
                            var eData = jqml(data);
                            var eTabs = jqml( eData ).find('.ml-tabs').andSelf();
                            eTabs.tabs({
                                beforeLoad: function(event, ui){
                                    if(jqml.trim(ui.panel.html()) == ''){//have no content
                                        eDialog.trigger('ml-load');
                                        return true;
                                    }else{
                                        return false;
                                    }
                                },
                                load: function(event, ui){
                                    eDialog.trigger('ml-init');
                                    return true;
                                }
                            });
                            eDialog.html(eData);
                            jqml(eDialog).on('submit', 'form', function(){
                                var eForm = jqml(this);
                                jqml(eData).find('button').button('option', 'disabled', true);
                                eDialog.trigger('ml-load');
                                jqml.ajax({
                                    type: this.method,
                                    url: this.action,
                                    data: jqml(this).serialize(),
                                    success: function (data) {
                                        if(eForm.attr('id') == 'ml-config-topTen-init-submit'){//clean all other loaded tabs, top ten have changed
                                            eTabs.find('[role=tabpanel][aria-hidden=true]').html('');
                                        }
                                        jqml(eForm).parents('[role=tabpanel]').html(data);//fill curent tab
                                        eDialog.trigger('ml-init');
                                    }
                                });
                                return false;
                            });
                        }
                    });
                });
            });
            /*]]>*/</script>
        <?php
        $sOut=ob_get_contents();
        ob_end_clean();
        return $sOut;
    }
    public function renderConfig(){
        ob_start();
        ?>
        <div id="ml-config-topTen" class="ml-tabs">
            <ul>
                <li>
                    <a href="<?php echo $this->getCurrentUrl( array_merge(MLHttp::gi()->getNeededFormFields(), array('what' => 'topTenConfig', 'kind' => 'ajax','ajax'=>'true','tab'=>'delete')))?>"><?php echo ML_TOPTEN_DELETE_HEAD ?></a>
                </li>
                <li>
                    <a href="<?php echo $this->getCurrentUrl( array_merge(MLHttp::gi()->getNeededFormFields(), array('what' => 'topTenConfig', 'kind' => 'ajax','ajax'=>'true','tab'=>'init')), true)?>"><?php echo ML_TOPTEN_INIT_HEAD ?></a>
                </li>
            </ul>
        </div>
        <?php
        $sOut = ob_get_contents();
        ob_end_clean();
        return $sOut;
    }
    public function renderConfigCopy($blExecute=false){
        ob_start();
        if($blExecute){
            $this->configCopy();
            ?><p class="successBox"><?php echo ML_TOPTEN_INIT_INFO ?></p><?php
        }
        ?>
        <p><?php echo ML_TOPTEN_INIT_DESC ?></p>
        <form id="ml-config-topTen-init-submit" method="get" action="<?php echo $this->getCurrentUrl(  array('what' => 'topTenConfig', 'kind' => 'ajax','ajax'=>'true','tab'=>'init','executeTT'=>'true'))?>">
            <?php foreach(MLHttp::gi()->getNeededFormFields() as $sName=>$sValue){?>
                <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue?>" />
            <?php }?>
            <button type="submit" ><?php echo ML_TOPTEN_INIT_HEAD ?></button>
        </form>
        <?php
        $sOut = ob_get_contents();
        ob_end_clean();
        return $sOut;
    }
}
