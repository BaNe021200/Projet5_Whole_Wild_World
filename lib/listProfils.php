<?php
declare(strict_types=1);
require_once 'twig.php';
//require_once '../twig.php';





listProfile();

function listProfile()
{

    //$userProfileNbx=$user->getUserProfileNbx();
    $user= new \App\Model\UserManager();
    $data= $user->homeDisplay();
    $nbUsers=$data->nbUsers;

    $perPage=6;
    $nbPage= ceil($nbUsers/$perPage);



    if (isset($_GET['p'])&& $_GET['p']>0 && $_GET['p']<=$nbPage)
    {
        $currentPage=$_GET['p'];
    }
    else{
        $currentPage='1';
    }


    $userProfilePictures=$user->getUserProfilePicture($currentPage,$perPage);

    $infos=[

        'userdata' =>$userProfilePictures,
        'currentPage' => $currentPage,
        'perPage'    => $perPage,
        'nbPage'    => $nbPage,

    ];


    twigRender('frontend/listProfile.html.twig','infos',$infos);









}