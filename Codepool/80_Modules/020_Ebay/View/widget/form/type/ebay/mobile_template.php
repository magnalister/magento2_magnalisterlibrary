<?php
if (!class_exists('ML', false))
    throw new Exception();
$aField['type'] = 'wysiwyg';
// mobile shoul be a little thinner
?><div style="display:table-cell;width:85%;"><?php 
    $this->includeType($aField);
?></div><?php
?><div style="display:table-cell;vertical-align:top;padding-left:5px;"><?php 
    echo $aField['i18n']['hint2']; 
?></div><?php
