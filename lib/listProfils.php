<?php
declare(strict_types=1);
require_once 'twig.php';


listProfile();


function listProfile()
{
    $user=new App\Model\UserManager();
    //$userProfileNbx=$user->getUserProfileNbx();

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
    /*if(!isset ($_GET['p'])){

        for($i=1; $i<=$nbPage; $i++){
            $_GET['p']== $i;
        }
    }*/

    $infos=[

        'currentPage' => $currentPage,
        'perPage'    => $perPage,
        'nbPage'    => $nbPage,

    ];


    $userProfilePictures=$user->getUserProfilePicture($currentPage,$perPage);
    twigRender('frontend/listProfile.html.twig','userdata',$userProfilePictures,'infos',$infos);









}