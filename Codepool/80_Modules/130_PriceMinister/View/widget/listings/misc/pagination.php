<?php
/* @var $this   ML_Listings_Controller_Widget_Listings_InventoryAbstract */
$pages = $this->getTotalPage();

$currentPage = $this->getCurrentPage();
$offset = $this->getOffset() + 1;//$currentPage * $this->aSetting['itemLimit'] - $this->aSetting['itemLimit'] + 1;
$limit = $offset + count($this->getData()) - 1;
/* @var $this   ML_Listings_Controller_Listings_Inventory */
$html = '';
$pageName = MLHttp::gi()->parseFormFieldName('page');
if ($pages > 23) {
    for ($i = 1; $i <= 5; ++$i) {
        $class = ($currentPage == $i) ? 'class="bold"' : '';
        $html .= ' <input type="submit" ' . $class . ' name="' . $pageName .'" value="' . $i . '" title="' . ML_LABEL_PAGE . ' ' . $i . '"/>';
    }
    if (($currentPage - 5) < 7) {
        $start = 6;
        $end = 15;
    } else {
        $start = $currentPage - 4;
        $end = $currentPage + 4;
        $html .= ' &hellip; ';
    }
    if (($currentPage + 5) > ($pages - 7)) {
        $start = ($pages - 15);
        $end = $pages;
    }
    for ($i = $start; $i <= $end; ++$i) {
        $class = ($currentPage == $i) ? 'class="bold"' : '';
        $html .= ' <input type="submit" ' . $class . ' name="' . $pageName .'" value="' . $i . '" title="' . ML_LABEL_PAGE . ' ' . $i . '"/>';
    }
    if ($end != $pages) {
        $html .= ' &hellip; ';
        for ($i = $pages - 5; $i <= $pages; ++$i) {
            $class = ($currentPage == $i) ? 'class="bold"' : '';
            $html .= ' <input type="submit" ' . $class . ' name="' . $pageName .'" value="' . $i . '" title="' . ML_LABEL_PAGE . ' ' . $i . '"/>';
        }
    }
} else {
    for ($i = 1; $i <= $pages; ++$i) {
        $class = ($currentPage == $i) ? 'class="bold"' : '';
        $html .= ' <input type="submit" ' . $class . ' name="' . $pageName .'" value="' . $i . '" title="' . ML_LABEL_PAGE . ' ' . $i . '"/>';
    }
}
$iNumberOfItem = $this->getNumberOfItems();
?> 
<table class="listingInfo">
    <tbody>
        <tr>
            <td class="pagination">
                <?php if (isset($iNumberOfItem) && $iNumberOfItem > 0) { ?> 
                    <span class="bold">
                        <?php echo ML_LABEL_PRODUCTS . ':&nbsp; ' . $offset . ' bis ' . $limit . ' von ' . ($iNumberOfItem) . '&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
                    </span>                             
                <?php } ?>                        
                <span class="bold">
                    <?php echo ML_LABEL_CURRENT_PAGE . ':&nbsp; ' . $currentPage ?>
                </span>
            </td>
            <td class="textright">
                <?php
                echo $html . (isset($sChooser) ? $sChooser : '');
                foreach (array('sorting', 'page') as $sInput) {
                    if ($this->getRequest($sInput) !== null) {
                        ?>
                        <input type="hidden"  name="<?php echo MLHttp::gi()->parseFormFieldName('current'.$sInput) ?> " value="<?php echo $this->getRequest($sInput) ?>" />
                        <?php
                    }
                }
                ?>  
            </td>
        </tr>
    </tbody>
</table>