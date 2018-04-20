<?php
declare(strict_types=0);



function resizeImage2()
{
    $images= glob('users/img/user/'.$_POST['username'].'/*.jpg');
    foreach ($images as $image)
    {
        $src=$image;//var_dump($src);die;
        $image= imagecreatefromjpeg($src);
        $imageSize = getimagesize($src);

        if($imageSize[1]>700)
        {
            $newHeight = 700;
            $newWidth= intval(($imageSize[0] * (($newHeight)/$imageSize[1])));//var_dump($newHeight);

            $newImage = imagecreatetruecolor($newWidth,$newHeight);
            imagecopyresampled($newImage, $image,0,0,0,0,$newWidth, $newHeight,$imageSize[0],$imageSize[1]);

            imagejpeg($newImage,$src);
            imagedestroy($image);
        }


    }

}


function resizeImage3()
{
    $images= glob('users/img/user/'.$_POST['username'].'/*.jpg');
    foreach ($images as $image)
    {
        $src=$image;//var_dump($src);die;
        $image= imagecreatefromjpeg($src);
        $imageSize = getimagesize($src);



            $newHeight = 700;
            $newWidth= intval(($imageSize[0] * (($newHeight)/$imageSize[1])));//var_dump($newHeight);

            $newImage = imagecreatetruecolor($newWidth,$newHeight);
            imagecopyresampled($newImage, $image,0,0,0,0,$newWidth, $newHeight,$imageSize[0],$imageSize[1]);

            imagejpeg($newImage,$src);
            imagedestroy($image);



    }

}

