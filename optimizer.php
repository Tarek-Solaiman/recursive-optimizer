<?php

function compressImage($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);

    if      ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg') {$image = imagecreatefromjpeg($source_url);}
    elseif  ($info['mime'] == 'image/gif')  {$image = imagecreatefromgif($source_url);}
    elseif  ($info['mime'] == 'image/png')  {$image = imagecreatefrompng($source_url);}

   // $image = imagecreatefromstring(file_get_contents($source_url));

    //save file
    imagejpeg($image, $destination_url, $quality);

    //return destination file

    return $destination_url;
}

//$image = compressImage("test.jpeg", "updated/o.jpeg", 30);

?>