<?php

if (!class_exists('ML', false))
    throw new Exception();
$this->includeView('widget_listings_inventory', get_defined_vars());
