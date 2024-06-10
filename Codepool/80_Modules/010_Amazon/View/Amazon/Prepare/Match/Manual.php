<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php $aStatistic = $this->getProductlist()->getStatistic(); ?>
    <h2><?php echo MLI18n::gi()->get(
            $this->isSingleMatching() ?
                'Amazon_Productlist_Match_Manual_Title_Single' :
                'Amazon_Productlist_Match_Manual_Title_Multi'
        ) ?></h2>
<?php $this->getProductListWidget(); ?>