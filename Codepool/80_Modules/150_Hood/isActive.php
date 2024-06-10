<?php
global $magnaConfig;
return (
    isset($magnaConfig['maranon']['Marketplaces'][MLRequest::gi()->data('mp')])
    && $magnaConfig['maranon']['Marketplaces'][MLRequest::gi()->data('mp')] == 'hood'
) ? true : false;