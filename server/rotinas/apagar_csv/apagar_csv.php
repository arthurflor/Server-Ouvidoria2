<?php 
/** 
* Recursively delete a directory 
* Funçao retirada do proprio site do PHP: http://php.net/manual/en/function.unlink.php#87045
* @author Jon Hassall
* @param string $dir Nome do diretório 
* @param boolean $deleteRootToo Ponha True se quiser deletar a pasta 
*/ 
function unlinkRecursive($dir, $deleteRootToo) 
{ 
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) 
        { 
            unlinkRecursive($dir.'/'.$obj, true); 
        } 
    } 
    closedir($dh); 
    if ($deleteRootToo) 
    { 
        @rmdir($dir); 
    } 
    return; 
} 

unlinkRecursive("../../reclamacoes/temp/", false);
?>