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
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<div class="help">
    <?php echo $this->getHelp(); ?>
    <script type="text/javascript">/*<![CDATA[*/
        jqml(document).ready(function () {
            jqml.get(
                "<?php echo MLHttp::gi()->getUrl(array('controller' => 'guide', 'ajax' => 'true', 'method' => 'getHelp')); ?>",
                function (data) {
                },
                'html'
            );
        });
        /*]]>*/</script>
</div>
<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php
#<iframe id="wikiframe" style="border: 1px solid #ccc;width: 100%;-moz-box-sizing: border-box; box-sizing: border-box; -webkit-box-sizing: border-box; min-height: 500px;margin-bottom: 5px;" src="//wiki.magnalister.com/wiki/Hauptseite">
#	<a href="http://wiki.magnalister.com/wiki/Hauptseite">http://wiki.magnalister.com/</a>
#</iframe>

#<script>/*<![CDATA[*/
#    (function($) {
#        $(window).resize(function() {
#            $('#wikiframe').css('height', ($(window).innerHeight() - 10)+'px');
#        });
#        $(window).load(function() {
#            $(window).resize();
#        });
#    })(jqml);
#/*]]>*/</script>
