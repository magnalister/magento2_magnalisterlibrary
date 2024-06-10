<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<table style="width: 100%;">
    <?php foreach ($aField['attributes'] as $sCat => $aAttribute) { ?>
        <tr>
            <th style="border: none; padding: 0; width: 20%; font-weight:normal;"><?php echo $aAttribute['title']; ?>
                :
            </th>
            <td style="border: none; padding: 3px 0; width: 80%;">
                <?php
                $aAttribute['id'] = $aField['id'].'_'.$aAttribute['key'];
                $aAttribute['value'] = isset($aField['value'][$aAttribute['key']]) ? $aField['value'][$aAttribute['key']] : null;
                $aAttribute['name'] = $aField['name'].'['.$aAttribute['key'].']';
                $this->includeType($aAttribute, array(), true, 'string');
                if (isset($aAttribute['desc'])) {
                    ?><div style="text-align: right;color: gray;"><?php echo $aAttribute['desc']; ?></div><?php
                }
                ?>
            </td>
        </tr>
    <?php } ?>
</table>