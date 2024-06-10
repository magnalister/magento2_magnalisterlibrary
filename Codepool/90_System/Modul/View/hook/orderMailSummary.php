<?php
    /**
     * @var array $aOrder
     */
     $oPrice=  MLPrice::factory();
     $blOdd=false;
     $oI18n = MLI18n::gi();
?>
<table class="ordersummary">
    <thead>
        <tr>
            <td class="qty"><?php echo $oI18n->get('ML_GENERIC_QTY')?></td>
            <td class="name"><?php echo $oI18n->get('ML_GENERIC_ITEM')?></td>
            <td class="price"><?php echo $oI18n->get('ML_GENERIC_EACH')?></td>
            <td class="fprice"><?php echo $oI18n->get('ML_GENERIC_TOTAL')?></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($aOrder['Products'] as $aProduct){ ?>
            <tr>
                <td class="qty"><?php echo $aProduct['Quantity'] ?></td>
		<td class="name"><?php echo $aProduct['ItemTitle'] ?></td>
                <td class="price"><?php echo $oPrice->format($aProduct['Price'], $aOrder['Order']['Currency']) ?></td>
		<td class="fprice"><?php echo $oPrice->format($aProduct['Quantity']*$aProduct['Price'], $aOrder['Order']['Currency'] ) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>