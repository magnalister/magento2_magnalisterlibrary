<?php
MLSetting::gi()->add('aPredefinedQuerys',array(
    '<dl><dt>General:</dt><dd>processlist()</dd></dl>'=>"SELECT concat ('<a href=\"".MLHttp::gi()->getUrl(array('mp'=>'tools','tools'=>'sql', 'SQL'=>"KILL QUERY"))." ',ID,'"."; \">Kill</a>') as `Kill`, pl.* FROM INFORMATION_SCHEMA.PROCESSLIST pl",
    '<dl><dt>General:</dt><dd>Show all magnalister products</dd></dl>'=>'SELECT * FROM magnalister_products;',
    '<dl><dt>General:</dt><dd>Show all magnalister orders</dd></dl>'=>'SELECT * FROM magnalister_orders;',
    '<dl><dt>General:</dt><dd>Count orders per marketplace</dd></dl>'=>'SELECT platform, mpid, COUNT(*) AS order_count FROM magnalister_orders GROUP BY platform,mpid;',
    '<dl><dt>Amazon:</dt><dd>Show amazon prepare</dd></dl>'=>'SELECT * FROM magnalister_amazon_prepare;',
));
