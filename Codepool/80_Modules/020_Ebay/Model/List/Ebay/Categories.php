<?php
require_once MLFilesystem::getOldLibPath('php/modules/ebay/ebayFunctions.php');
class ML_Ebay_Model_List_Ebay_Categories extends ML_Database_Model_List{
    protected $sOrder='leafcategory asc, categoryname';

}