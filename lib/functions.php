<?php
declare(strict_types=1);

function loggedOnly()
{
    if(session_status()==PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!isset($_COOKIE['ID']))
    {
       $session= new \App\Model\Session();
       $session->setFlash('Vous n\'avez pas le droit d\'accéder à cette page','danger');
       header('Location:home');
       $session->flash();
    }
}

function calendarControl()
{

    $birth = strtotime($_POST['birthday']);
    $today = strtotime('NOW' );


    @$birthYear = date('Y',$birth);
    $dateControl = date('Y',$today);

    $birthYearInt = intval($birthYear);
    $dateControlInt = intval($dateControl);





    if($birthYearInt<1900 || $birthYearInt>=$dateControlInt)
    {
        return false;

    }else
    {
        return true;
    }

}

//on controle l'âge
function birthdayControl()
{
    $birth = new DateTime($_POST['birthday']);
    $today = new DateTime(date('d-m-Y'));
    $old = $birth->diff($today);
    $age = $old->y;

    if($age>=18)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function isAjax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function newFolder()
{
    $folder='users/img/user/'.$_COOKIE['username'];

    mkdir($folder);
}

function newFolderCrop()
{
    $folderCrop='users/img/user/'.$_COOKIE['username'].'/crop';

    mkdir($folderCrop);
}

function newFolderThumbnails()
{
    $folderThumbnails='users/img/user/'.$_COOKIE['username'].'/thumbnails';

    mkdir($folderThumbnails);
}

function newFolderProfilPicture()
{
    $folderProfilPicture = 'users/img/user/'.$_COOKIE['username'].'/profilPicture';
    mkdir($folderProfilPicture);
}

function displayUserName($name)
{
    $username=$name;

    $username = str_replace('_',' ',$username);
}

function resizeByHeight()
{
    $images= glob('users/img/user/'.$_COOKIE['username'].'/*.jpg');
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

