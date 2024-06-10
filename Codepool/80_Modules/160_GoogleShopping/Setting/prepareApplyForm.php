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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLSetting::gi()->add('googleshopping_prepare_apply_form', array(
    'details' => '{#setting:formgroups_googleshopping__prepare_details#}',
    'category' => '{#setting:formgroups_googleshopping__prepare_variations#}',
    'variationmatching' => '{#setting:formgroups_googleshopping__prepare_variationmatching#}',
    //'general' => '{#setting:formgroups_googleshopping__prepare_general#}',
), false);

MLSetting::gi()->add('googleshopping_prepare_variations', array(
    'variations' => '{#setting:formgroups_googleshopping__prepare_variations#}',
    'variationmatching' => '{#setting:formgroups_googleshopping__prepare_variationmatching#}',
    'action' => '{#setting:formgroups_googleshopping__prepare_action#}',
), false);

MLI18n::gi()->{'googleshopping_prepare_apply_form__field__title__optional__checkbox__labelNegativ'} = 'Use always product title from web-shop';
