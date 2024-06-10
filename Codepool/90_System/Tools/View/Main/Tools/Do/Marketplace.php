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
?>
    <table class="datagrid">
        <?php
        $aExceptions = array();
        $aTabIdents = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.tabident')->get('value');
        $aActions = array('ImportOrders', 'UpdateOrders', 'SyncOrderStatus', 'SyncInventory', 'SyncProductIdentifiers', 'ImportCategories', 'UploadInvoices');
        $oService = new MLService;
        $sBg = '';
        ?>
        <thead>
        <tr>
            <th>Marketplace</th>
            <th>Name</th>
            <th>ID</th>
            <th colspan="<?php echo count($aActions) ?>">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (MLHelper::gi('Marketplace')->magnaGetInvolvedMarketplaces() as $sMarketPlace) {
            $aMarketplaceIds = MLHelper::gi('Marketplace')->magnaGetInvolvedMPIDs($sMarketPlace);
            foreach ($aMarketplaceIds as $iMarketPlace) {
                ?>
                <tr class="<?php $sBg = $sBg == 'even' ? 'odd' : 'even';
                echo $sBg; ?>"><?php
                ?>
                <td><?php echo $sMarketPlace ?></td><?php
                ?>
                <td><?php echo(isset($aTabIdents[$iMarketPlace]) && $aTabIdents[$iMarketPlace] != '' ? $aTabIdents[$iMarketPlace] : '') ?></td><?php
                ?>
                <td><?php echo $iMarketPlace ?></td><?php
                foreach ($aActions as $sDo) {
                    ?>
                    <td><?php
                    ML::gi()->init(array('mp' => $iMarketPlace));
                    try {
                        $oService->{'get'.$sDo.'Instance'}();
                        if (!MLModule::gi()->isConfigured()) {
                            throw new MLAbstract_Exception($sMarketPlace.'::'.$iMarketPlace.' is not configured.');
                        }
                        ?>
                        <a class="ml-js-noBlockUi" style="float:left;" target="_blank" href="<?php echo $this->getUrl(array('do' => $sDo, 'mpid' => $iMarketPlace, 'offset' => 0)); ?>"><?php echo $sDo; ?></a><?php
                        ?>
                    <a class="ml-js-noBlockUi" style="float:right;" target="_blank" href="<?php echo $this->getFrontendDoUrl(array('do' => $sDo, 'mpid' => $iMarketPlace, 'auth' => md5(MLShop::gi()->getShopId().trim(MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value'))), 'offset' => 0)); ?>">
                            (Frontend)</a><?php
                    } catch (MLAbstract_Exception $oEx) {
                        $aExceptions[] = $oEx;
                        echo $sDo;
                    } catch (Exception $oEx) {
                        $aExceptions[] = new Exception('Exception for: '.$sMarketPlace.'::'.$iMarketPlace);
                        $aExceptions[] = $oEx;
                        echo $sDo;
                    }
                    ?></td><?php
                }
                ?></tr><?php
            }
        }
        ?>
        </tbody>
    </table>
    <span class="right">
    Add this link to your bookmarks to see result:
    <a href="javascript:%20(function(){function%20base64_decode(data){var%20b64='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';var%20o1,o2,o3,h1,h2,h3,h4,bits,i=0,ac=0,dec='',tmp_arr=[];if(!data){return%20data;}%20data+='';do{h1=b64.indexOf(data.charAt(i++));h2=b64.indexOf(data.charAt(i++));h3=b64.indexOf(data.charAt(i++));h4=b64.indexOf(data.charAt(i++));bits=h1<<18|h2<<12|h3<<6|h4;o1=bits>>16&0xff;o2=bits>>8&0xff;o3=bits&0xff;if(h3==64){tmp_arr[ac++]=String.fromCharCode(o1);}else%20if(h4==64){tmp_arr[ac++]=String.fromCharCode(o1,o2);}else{tmp_arr[ac++]=String.fromCharCode(o1,o2,o3);}}while(i<data.length);dec=tmp_arr.join('');return%20dec;}%20function%20extractLastMarker(c){var%20startpos=c.lastIndexOf('{#'),endpos=c.slice(startpos).lastIndexOf('#}');return%20c.slice(startpos+2,startpos+endpos);}%20var%20c=document.getElementsByTagName('pre')[0].innerHTML,m=extractLastMarker(c);b=JSON.parse(base64_decode(m));alert(JSON.stringify(b));}())">
        magnalister-Encode-Bookmarklet
    </a>
</span>
    <div class="clear"></div>
<?php ML::gi()->init();
//Add messages after init, if you did before that, they will be cleared
foreach ($aExceptions as $oException) {
    MLMessage::gi()->addDebug($oException);
}
?>