<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php $this->includeView('widget_listings_misc_lastreport', get_defined_vars()); ?>
<?php $this->includeView('widget_listings_inventory', get_defined_vars()); ?>
