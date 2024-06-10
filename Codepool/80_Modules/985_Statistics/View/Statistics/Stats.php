<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<div class='stat' style='position:relative;height:<?php echo MLSetting::gi()->get('chart_height'); ?>px;' title='<?php echo $this->__('ML_LABEL_STATS_ORDERS_PER_MARKETPLACE') ?>'>
    <h3><?php echo $this->__('ML_LABEL_STATS_ORDERS_PER_MARKETPLACE') ?> </h3><?php echo $this->getOrderChartHtml(); ?>
</div>