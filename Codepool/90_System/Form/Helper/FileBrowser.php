<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Form_Helper_FileBrowser {

    public function getConfiguredBasePath() {
        $dir = MLRequest::gi()->data('configPath');

        // if configuration is not preset -> set default directory
        if (empty($dir)) {
            $dir = $_SERVER['DOCUMENT_ROOT'];
        }

        $dir = ltrim($dir, DIRECTORY_SEPARATOR);
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);

        $explode = explode(DIRECTORY_SEPARATOR, $dir);
        //echo print_m($explode);

        $fullPathCheck = DIRECTORY_SEPARATOR;
        $countDirectories = 0;

        foreach ($explode as $item) {
            $fullPathCheck .= $item.DIRECTORY_SEPARATOR;
            // skip while just a part is in string and it not full match
            if (strstr($_SERVER['DOCUMENT_ROOT'], $fullPathCheck) && ($_SERVER['DOCUMENT_ROOT'] != $fullPathCheck)) {
                continue;
            }
            if (rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) == rtrim($fullPathCheck, DIRECTORY_SEPARATOR)) {
                $item = rtrim($fullPathCheck, DIRECTORY_SEPARATOR);
            }
            /*
            echo $_SERVER['DOCUMENT_ROOT'];
            echo "\n<br>";
            echo $fullPathCheck;
            echo "\n<br>";
            //*/
            if (!is_dir($fullPathCheck)) {
                break;
            }
            $countDirectories++;

            // check if directory has subdirectories
            $subDir = new DirectoryIterator($fullPathCheck);
            $bHasSubDirs = false;
            foreach ($subDir as $subFileInfo) {
                if ($subFileInfo->isDir() && !$subFileInfo->isDot()) {
                    $bHasSubDirs = true;
                    break;
                }
            }
            if ($bHasSubDirs) {
                $class = 'plus';
            } else {
                $class = 'leaf';
            }

            // Select "tick" element which is configured
            if ($class == 'leaf'
                && (trim($dir, DIRECTORY_SEPARATOR) == trim($fullPathCheck, DIRECTORY_SEPARATOR))
            ) {
                $class .= ' tick';
            }

            echo '
                            <div class="catelem" id="y_'.$item.'">
                                <span class="toggle '.$class.'" id="y_toggle_'.$item.'" data-path="'.$fullPathCheck.'">&nbsp;</span>
                                <div class="catname" id="y_select_'.$item.'">
                                    <span class="catname">'.fixHTMLUTF8Entities($item).'</span>
                        ';
        }
        while ($countDirectories > 0) {
            $countDirectories--;
            echo '
                                </div>
                            </div>
                        ';
        }
    }

    /**
     * @param $controller ML_Form_Helper_FileBrowser
     * @return null
     */
    public function getDirectories() {
        // Checks if directory has child's if not return 'leaf'
        $bHasChilds = false;

        $basePath = MLRequest::gi()->data('path');

        $configPath = MLRequest::gi()->data('configPath');
        //echo $configPath."\n<br>";
        $dir = new DirectoryIterator($basePath);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $bHasChilds = true;
                $item = $fileinfo->getFilename();

                //extend current path
                $currentPath = $basePath.$item.DIRECTORY_SEPARATOR;
                #echo "<br>".$configPath;
                #echo "<br>".$currentPath;
                #echo "<br>".var_dump(strpos($configPath, $currentPath));

                // if paths are the same then its already displayed
                if (strpos($configPath, $currentPath) !== false) {
                    continue;
                }

                $subDir = new DirectoryIterator($currentPath);
                $bHasSubDirs = false;
                foreach ($subDir as $subFileInfo) {
                    if ($subFileInfo->isDir() && !$subFileInfo->isDot()) {
                        $bHasSubDirs = true;
                        break;
                    }
                }

                if ($bHasSubDirs) {
                    $class = 'plus';
                } else {
                    $class = 'leaf';
                }

                //echo "\t\t".$fileinfo->getFilename()."\n";
                echo '
                            <div class="catelem" id="y_'.$item.'">
                                <span class="toggle '.$class.'" id="y_toggle_'.$item.'" data-path="'.$currentPath.'">&nbsp;</span>
                                <div class="catname" id="y_select_'.$item.'">
                                    <span class="catname">'.fixHTMLUTF8Entities($item).'</span>
                                </div>
                            </div>
                ';
            }
        }

        if ($bHasChilds === false) {
            echo 'leaf';
        }
    }

}
