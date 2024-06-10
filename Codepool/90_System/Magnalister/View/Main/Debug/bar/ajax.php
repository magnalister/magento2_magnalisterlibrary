<?php
if (!class_exists('ML', false))
    throw new Exception();
if (MLHttp::gi()->isAjax()) {
    $sHash = uniqid();
    $sController = strtolower(
        '<strong>'.preg_replace('/^(.*_){3}(.*)$/Uis', '$2', MLSetting::gi()->sMainController).'</strong>'.
        (MLRequest::gi()->data('method') === null ? '' : '<small>::'.MLRequest::gi()->data('method').'()</small>')
    );

    MLSetting::gi()->add('aAjaxPlugin', array(
        'dom' => array(
            '#debug-ajax>.magnaTabs2>ul' => array(
                'action'  => 'append',
                'content' => '<li><a href="#'.$sHash.'">'.$sController.'<sup>x</sup></a></li>'
            )
        )
    ));
    MLSetting::gi()->add('aAjaxPlugin', array(
        'dom' => array(
            '#debug-ajax>.devContent' => array(
                'action'  => 'append',
                'content' => '<div id="'.$sHash.'">'.mb_convert_encoding($this->includeViewBuffered('main_debug_bar'), 'UTF-8').'</div>'
            )
        )
    ));
}else{
    ?>
        <div id="debug-ajax" class="magnamain">
            <div class="magnaTabs2">
                <ul></ul>
            </div>
            <div class="clear"></div>
            <div class="devContent"></div>
        </div>
    <?php
}
?>
