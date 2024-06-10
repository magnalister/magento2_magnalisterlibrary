<?php
/* @var $this   ML_Listings_Controller_Widget_Listings_InventoryAbstract */
$pages = $this->getTotalPage();

$currentPage = $this->getCurrentPage();
$offset = $this->getOffset() + 1;//$currentPage * $this->aSetting['itemLimit'] - $this->aSetting['itemLimit'] + 1;
$limit = $offset + count($this->getData()) - 1;
$space = ' <input type="submit" class="ml-pagButton space" value="..." disabled="disabled"/>';
//$space = ' <div class="space">...</div>';
/* @var $this   ML_Listings_Controller_Listings_Inventory */
$html = '';
$pageName = MLHttp::gi()->parseFormFieldName('page');
$class = ($currentPage == 1) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
if ($pages > 7) {
    if ($currentPage > 1) {
        $html .= ' <button type="submit" class="ml-pagButton ml-leftArrow" name="'.$pageName.'" value="'.($currentPage-1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage-1).'"/><</button>';
    }
    $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="1" title="'.MLI18n::gi()->ML_LABEL_PAGE.' 1"/>';
    if ($currentPage < 3) {
        for ($i = 2; $i <= 3; ++$i) {
            $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        $html .= $space;
    } elseif ($currentPage == 3 ) {
        for ($i = $currentPage-1; $i <= $currentPage+1; ++$i) {
            $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        $html .= $space;
    } elseif ($currentPage == 4 ) {
        for ($i = $currentPage-2; $i <= $currentPage+1; ++$i) {
            $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        $html .= $space;
    }
    elseif ($currentPage == $pages-1) {
        $html .= $space;
        for ($i = $currentPage-1; $i < $pages; ++$i) {
            $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
    } elseif ($currentPage == $pages) {
        $html .= $space;
        for ($i = $currentPage-2; $i < $pages; ++$i) {
            $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
    }
    else {
        $addPage = ($currentPage == $pages-3) ? 2 : 1;
        $html .= $space;
        for ($i = $currentPage - 1; $i <= $currentPage + $addPage; ++$i) {
            $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        if ($pages - $currentPage > 2 && $addPage === 1) {
            $html .= $space;
        }
    }
    $class = ($currentPage == $pages) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
    $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$pages.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$pages.'"/>';
    if ($currentPage < $pages) {
        $html .= ' <button type="submit" class="ml-pagButton ml-rightArrow" name="'.$pageName.'" value="'.($currentPage+1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage+1).'"/>></button>';
    }
} else {
    if ($currentPage > 1) {
        $html .= ' <button type="submit" class="ml-pagButton ml-leftArrow" name="'.$pageName.'" value="'.($currentPage-1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage-1).'"/><</button>';
    }
    for ($i = 1; $i <= $pages; ++$i) {
        $class = ($currentPage == $i) ? 'class="ml-pagButton ml-active"' : 'class="ml-pagButton"';
        $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="' .MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
    }
    if ($currentPage < $pages) {
        $html .= ' <button type="submit" class="ml-pagButton ml-rightArrow" name="'.$pageName.'" value="'.($currentPage+1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage+1).'"/>></button>';
    }
}

$iNumberOfItem = $this->getNumberOfItems();
?> 
<table class="listingInfo">
    <tbody>
        <tr style="display: flex; justify-content: space-between; align-items: baseline;">
            <td class="pagination">
                <?php if (isset($iNumberOfItem) && $iNumberOfItem > 0) { ?>
                    <span class="bold">
                        <?php echo MLI18n::gi()->get('ML_LABEL_PRODUCTS') . ':&nbsp; ' . $offset . ' '.MLI18n::gi()->errorlog_pagination_to .' ' . $limit . ' '.MLI18n::gi()->errorlog_pagination_of.' '. ($iNumberOfItem) . '&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
                    </span>                             
                <?php } ?>                        
                <span class="bold">
                    <?php echo MLI18n::gi()->get('ML_LABEL_CURRENT_PAGE') . ':&nbsp; ' . $currentPage ?>
                </span>
            </td>
            <td id="paginationBox"; class="textright"; style="display: inline-flex;">
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