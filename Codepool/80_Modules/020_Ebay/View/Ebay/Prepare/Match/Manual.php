<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php $aStatistic = $this->getProductlist()->getStatistic(); ?>
<?php $this->getProductListWidget();