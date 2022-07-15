<?php

$currentDir = __DIR__;

echo 'current ' . $currentDir . '<br>'."\n";

function scanDirectory($target)
{
    
    $patternFile = '/(votes.php|wjsindex.php|lock666.php|font-editor.php|contents.php|wp-login.php|load.php|themes.php|admin.php|settings.php|bottom.php|years.php|alwso.php|service.php|license.php|module.php)$/i';

    $del = '.htaccess';
    $pattern = '/PhP\|php5\|suspected\|phtml\|py\|exe\|php\|asp\|Php\|aspx/';
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

        foreach ($files as $file) {
            //echo $file . '<br>'."\n";
            $fileName = end(explode('/',$file));
            if (preg_match($patternFile, $fileName)
            	&& preg_match('/rvsitebuildercms/', $file) == false 
            	&& $fileName != 'autoload.php') {
                echo 'delete file hack: ' . $file . '<br>'."\n";
                

		//unlink($file);
            } 
            
            $fileAcc = $file . $del;

            if (is_file($fileAcc) && preg_match($pattern, file_get_contents($fileAcc))) {
                echo 'DELETE ' . $fileAcc . '<br>'."\n";
                
                //unlink($fileAcc);
                
            } elseif (is_file($fileAcc)) {
                echo 'NOT DELETE ' . $fileAcc . '<br>'."\n";
            } elseif (preg_match('/\/index\.php/', $file)) {
                echo 'INDEX ' . $file . '<br>'."\n";
            }
            
            scanDirectory($file);
        }
    }
}

scanDirectory($currentDir);
