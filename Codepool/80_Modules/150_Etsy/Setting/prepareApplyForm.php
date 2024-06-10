<?php

MLSetting::gi()->add('etsy_prepare_apply_form', array(
    'details' => '{#setting:formgroups_etsy__prepare_details#}',
    'category' => '{#setting:formgroups_etsy__prepare_variations#}',
    'variationmatching' => '{#setting:formgroups_etsy__prepare_variationmatching#}',
    'general' => '{#setting:formgroups_etsy__prepare_general#}',
    'shippingprofile' => '{#setting:formgroups_etsy__prepare_shippingprofile#}',
), false);

MLSetting::gi()->add('etsy_prepare_variations', array(
    'variations' => '{#setting:formgroups_etsy__prepare_variations#}',
    'variationmatching' => '{#setting:formgroups_etsy__prepare_variationmatching#}',
    'action' => '{#setting:formgroups_etsy__prepare_action#}',
), false);
