<?php
MLSetting::gi()->add('aButtons', array(
    array(
        'title' => 'ML_LABEL_IMPORT_ORDERS',
        'warningTitle' => 'ML_MESSAGE_BEFORE_IMPORT_ORDERS_TITLE',
        'warningText' => 'ML_MESSAGE_BEFORE_IMPORT_ORDERS_TEXT',
        'icon' => 'cart',
        'link' => array('do' => 'ImportOrders'),
        'type' => 'cron',
        'enabled' => true,
    ),
    array(
        'title' => 'ML_LABEL_SYNC_ORDERSTATUS',
        'warningTitle' => 'ML_MESSAGE_BEFORE_SYNC_ORDERSTATUS_TITLE',
        'warningText' => 'ML_MESSAGE_BEFORE_SYNC_ORDERSTATUS_TEXT',
        'icon' => 'upload',
        'link' => array('do' => 'SyncOrderStatus'),
        'type' => 'cron',
        'enabled' => true,
    ),
    array(
        'title' => 'ML_LABEL_SYNC_INVENTORY',
        'warningTitle' => 'ML_MESSAGE_BEFORE_SYNC_INVENTORY_TITLE',
        'warningText' => 'ML_MESSAGE_BEFORE_SYNC_INVENTORY_TEXT',
        'icon' => 'sync',
        'link' => array('do' => 'SyncInventory'),
        'type' => 'cron',
        'enabled' => true,
    ),
    array(
        'title' => 'ML_LABEL_UPDATE',
        'warningTitle' => 'ML_MESSAGE_BEFORE_UPDATE_TITLE',
        'warningText' => 'ML_MESSAGE_BEFORE_UPDATE_TEXT',
        'icon' => 'update',
        'link' => array('do' => 'update', 'method' => 'init'),
        'enabled' => true,
    ),
));