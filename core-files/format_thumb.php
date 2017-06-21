<?php
include_once 'db_connect.php';

$crnt_image = $_FILES['file']['tmp_name'];
$size = getimagesize($crnt_image);
$measureWidth = intval($size[0]);
$fileLocation = $_GET['dataType'];
if ($fileLocation === "AddProperty") { $filePath = "buy-home"; $dbname = "property"; }
else if ($fileLocation === "AddRental") { $filePath = "rent"; $dbname = "rental"; }

$listCountQ = "SELECT var_value FROM sysVar WHERE var_name = '".$dbname."_count'";
$selectCount = $mysqli->query($listCountQ);
$pCount = $selectCount->fetch_array();
$propertyCount = $pCount['var_value'];
$getExtension = $_GET['picName'];
$breakOpen = explode(".",$getExtension);
$fName = "Property-".$propertyCount.".".$breakOpen[1];

if ($measureWidth > 600) {
$maxsize = 600;
$createPath = $_SERVER['DOCUMENT_ROOT'].'/'.$filePath.'/full-images/'.$fName;
$height_orig = $size[0];
$width_orig = $size[1];
$width = $maxsize+1;
$height = $maxsize;
while($width > $maxsize){
    $width = round($height*$width_orig/$height_orig);
    $height = ($width > $maxsize)?--$height:$height;
}
$images_orig    = imagecreatefromstring( file_get_contents($crnt_image) );
$photoX         = imagesx($images_orig);
$photoY         = imagesy($images_orig);
$images_fin     = imagecreatetruecolor($height,$width);
imagesavealpha($images_fin,true);
$trans_colour   = imagecolorallocatealpha($images_fin,0,0,0,127);
imagefill($images_fin,0,0,$trans_colour);
unset($trans_colour);
ImageCopyResampled($images_fin,$images_orig,0,0,0,0,$height+1,$width+1,$photoX,$photoY);
unset($photoX,$photoY,$height,$width);
imagepng($images_fin,$createPath);
unset($createPath);
unset($maxsize);
} else {
$createPath = $_SERVER['DOCUMENT_ROOT'].'/'.$filePath.'/full-images/'.$fName;
$height = $size[1];
$width = $size[0];
$images_orig    = imagecreatefromstring( file_get_contents($crnt_image) );
$photoX         = imagesx($images_orig);
$photoY         = imagesy($images_orig);
$images_fin     = imagecreatetruecolor($height,$width);
imagesavealpha($images_fin,true);
$trans_colour   = imagecolorallocatealpha($images_fin,0,0,0,127);
imagefill($images_fin,0,0,$trans_colour);
unset($trans_colour);
ImageCopyResampled($images_fin,$images_orig,0,0,0,0,$height+1,$width+1,$photoX,$photoY);
unset($photoX,$photoY,$height,$width);
imagepng($images_fin,$createPath);
unset($createPath);
}

if ($measureWidth > 150) {
$maxsize = 150;
$createPath = $_SERVER['DOCUMENT_ROOT'].'/'.$filePath.'/images/'.$fName;
unset($size);
$width = $maxsize+1;
$height = $maxsize;
while($width > $maxsize){
    $width = round($height*$width_orig/$height_orig);
    $height = ($width > $maxsize)?--$height:$height;
}
unset($height_orig,$width_orig,$maxsize);
$images_orig    = imagecreatefromstring( file_get_contents($crnt_image) );
$photoX         = imagesx($images_orig);
$photoY         = imagesy($images_orig);
$images_fin     = imagecreatetruecolor($height,$width);
imagesavealpha($images_fin,true);
$trans_colour   = imagecolorallocatealpha($images_fin,0,0,0,127);
imagefill($images_fin,0,0,$trans_colour);
unset($trans_colour);
ImageCopyResampled($images_fin,$images_orig,0,0,0,0,$height+1,$width+1,$photoX,$photoY);
unset($photoX,$photoY,$height,$width);
imagepng($images_fin,$createPath);
unset($createPath);
ImageDestroy($images_orig);
}

echo $fileLocation."|".$measureWidth."|".$fName;
?>