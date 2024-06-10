<?php
$pages = $this->getTotalPage();

$currentPage = $this->getCurrentPage();
$offset = $this->aSetting['itemLimit'] * ($currentPage - 1) + 1;
$limit = $offset + count($this->aData) - 1;
$style = ' <div style="padding: 6px 10px 5px 10px; margin-top: 3px; margin-bottom: 3px; background: #e9e9ed; display: inline;" >...</div>';
$html = '';
$pageName = MLHttp::gi()->parseFormFieldName('page');
$class = ($currentPage == 1) ? 'class="bolder"' : '';
if ($pages > 7) {
    if ($currentPage > 1) {
        $html .= ' <button type="submit" '.$class.' name="'.$pageName.'" value="'.($currentPage-1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage-1).'"/><</button>';
    }
    $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="1" title="'.MLI18n::gi()->ML_LABEL_PAGE.' 1"/>';
    if ($currentPage < 3) {
        for ($i = 2; $i <= 3; ++$i) {
            $class = ($currentPage == $i) ? 'class="bolder"' : '';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        $html .= $style;
    } elseif ($currentPage == 3 ) {
        for ($i = $currentPage-1; $i <= $currentPage+1; ++$i) {
            $class = ($currentPage == $i) ? 'class="bolder"' : '';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        $html .= ' <div style="padding: 6px 10px 5px 10px; margin-top: 3px; margin-bottom: 3px; background: #e9e9ed; display: inline;" >...</div>';
    } elseif ($currentPage == 4 ) {
        for ($i = $currentPage-2; $i <= $currentPage+1; ++$i) {
            $class = ($currentPage == $i) ? 'class="bolder"' : '';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        $html .= $style;
    }
    elseif ($currentPage == $pages-1) {
        $html .= $style;
        for ($i = $currentPage-1; $i < $pages; ++$i) {
            $class = ($currentPage == $i) ? 'class="bolder"' : '';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
    } elseif ($currentPage == $pages) {
        $html .= $style;
        for ($i = $currentPage-2; $i < $pages; ++$i) {
            $class = ($currentPage == $i) ? 'class="bolder"' : '';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
    }
    else {
        $addPage = ($currentPage == $pages-3) ? 2 : 1;
        $html .= $style;
        for ($i = $currentPage - 1; $i <= $currentPage + $addPage; ++$i) {
            $class = ($currentPage == $i) ? 'class="bolder"' : '';
            $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
        }
        if ($pages - $currentPage > 2 && $addPage === 1) {
            $html .= $style;
        }
    }
    $class = ($currentPage == $pages) ? 'class="bolder"' : '';
    $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$pages.'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.$pages.'"/>';
    if ($currentPage < $pages) {
        $html .= ' <button type="submit" '.$class.' name="'.$pageName.'" value="'.($currentPage+1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage+1).'"/>></button>';
    }
} else {
    if ($currentPage > 1) {
        $html .= ' <button type="submit" '.$class.' name="'.$pageName.'" value="'.($currentPage-1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage-1).'"/><</button>';
    }
    for ($i = 1; $i <= $pages; ++$i) {
        $class = ($currentPage == $i) ? 'class="bolder"' : '';
        $html .= ' <input type="submit" '.$class.' name="'.$pageName.'" value="'.$i.'" title="' .MLI18n::gi()->ML_LABEL_PAGE.' '.$i.'"/>';
    }
    if ($currentPage < $pages) {
        $html .= ' <button type="submit" '.$class.' name="'.$pageName.'" value="'.($currentPage+1).'" title="'.MLI18n::gi()->ML_LABEL_PAGE.' '.($currentPage+1).'"/>></button>';
    }
}
?> 
<table class="listingInfo">
    <tbody>
        <tr>
            <td class="pagination">
                <?php if (isset($this->iNumberOfItems) && $this->iNumberOfItems > 0) { ?> 
                    <span class="bold">
                        <?php echo MLI18n::gi()->ML_LABEL_PRODUCTS . ':&nbsp; ' . $offset . ' '.MLI18n::gi()->errorlog_pagination_to .' ' . $limit . ' '.MLI18n::gi()->errorlog_pagination_of.' ' . ($this->iNumberOfItems) . '&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
                    </span>
                <?php } ?>
                <span class="bold">
                    <?php echo MLI18n::gi()->ML_LABEL_CURRENT_PAGE . ':&nbsp; ' . $currentPage ?>
                </span>
            </td>
            <td class="textright">
                <?php
                echo $html ;
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