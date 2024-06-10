<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php $aStatistic = $this->getProductlist()->getStatistic(); ?>
    <h1><?php echo MLI18n::gi()->get(
            $this->isSingleMatching() ?
                'Hitmeister_Productlist_Match_Manual_Title_Single' :
                'Hitmeister_Productlist_Match_Manual_Title_Multi'
        ) ?></h1>
<?php $this->getProductListWidget(); ?>