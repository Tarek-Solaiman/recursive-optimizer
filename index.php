<?php
ini_set('max_execution_time', 3000);
require_once'optimizer.php';
$path = $_GET['path'];

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
$dirs = [];
$optimized = [];
foreach($objects as $name => $object){
    if ($object->getFilename() == '.') {
        $filtered_dir = str_ireplace('.','',$object);
       $dirs[] = $filtered_dir;
    }
    $optimized[]= $object;
  }

foreach ($dirs as $dir) {
    if(!file_exists("optimized\\".$dir)){
        mkdir("optimized\\".$dir, 0777, true);
    }
}
$success = 0;
$fail = 0;

foreach($optimized as $item){
    if(stripos($item,'\.') || stripos($item,'\..')){
		continue;
		}
	if(compressImage($item,"optimized\\".$item,75)){
		$success++;
	}else{
		$fail++;
	}
}
echo "Optimization Complete <br> Successful: ".$success ."<br> Failed: ".$fail;
