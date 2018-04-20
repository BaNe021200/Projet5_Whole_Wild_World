<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
require_once 'src/Controler/Frontend.php';
require_once 'lib/functions.php';
try
{

$router = new \App\Router\Router($_GET['url']);

$router->get('/',function (){
    if(isset($_COOKIE['ID'])&& isset($_COOKIE['username']))
    {
        require_once 'listProfils.php';
    }
    else
    {
        \App\Controler\Frontend::home();
    }
});

    $router->get('home',function(){


        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username']))
        {
            require_once 'lib/listProfils.php';
        }
        else
        {
           \App\Controler\Frontend::home();
        }




    });

    $router->get('connexion',function(){


        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username']))
        {
            \App\Controler\Backend::homeUser();
        }
        else
        {
           $connect = new \App\Controler\Backend();
           $connect->connectUser();

        }
    });

    $router->post('getConnexion',function (){

        \App\Controler\Backend::authentificationConnexion();
    });

    $router->get('homeUser',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            \App\Controler\Backend::homeUser();

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }




    });

    $router->get('deconnexion',function(){

        $disconnectUser= new \App\Controler\Backend();
        $disconnectUser->disconnectUser();

    });




    $router->get('signUp',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username']))
        {
           \App\Controler\Backend::homeUser();
        }
        else
        {
           $signUp= new \App\Controler\Frontend();
           $signUp->signUp();

        }
    });

    $router->post('register',function (){

       $register = new \App\Controler\Backend();
       $register->register();



    });

    $router->get('confirm',function (){

        $confirm = new \App\Controler\Backend();
        $confirm->emailConfirmation($_GET['id'],$_GET['token']);



    })->with('id','[0-9]+')->with('token','[0-9a-zA-Z]+');

    $router->get('galerie1',function (){


        $galerie1=new \App\Controler\Backend();
        $galerie1->galerie1();


    });

    $router->get('galerie3',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){
            if (file_exists("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg")) {
                $src = "users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg";
            } else {
                $src = "users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped.jpg";
            }
            $getUserImages= new \App\Controler\Backend();
            $getUserImages->getUserImages($_COOKIE['ID']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }



    });

    $router->get('viewerGalerie',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            $viewerGalerie=new \App\Controler\Backend();
            $viewerGalerie->viewerGalerie($_GET['id']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }


    })->with('id','[0-9]+');

    $router->post('upload',function (){

        $uploadPicture=new \App\Controler\Backend();
        $uploadPicture->uploadPicture($_COOKIE['ID'],$_GET['id']);

    } )->with('id', '[0-9]+');

    $router->get('recropped',function (){

        $recropped= new \App\Controler\Backend();
        $recropped->recropped($_COOKIE['ID'],$_GET['id']);

    })->with('id','[0-9]+');

    $router->get('CroppedChoice',function (){

        $croppedChoice = new \App\Controler\Backend();
        $croppedChoice->croppedChoice($_COOKIE['ID'],$_GET['id']);
    })->with('id','[0-9]+');

    $router->get('infosUser',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            infosUser();
        }

    });

    $router->post('saveUserinfos',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            saveUserinfos($_GET['userid']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('userid','[0-9]+');

    $router->get('deleteUserInfos',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            deleteUserInfos($_GET['userid']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('userid','[0-9]+');

    $router->get('eraseProfil',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){



            eraseUser($_COOKIE['ID']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }

    });

    $router->get('deleteImage',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            $deleteImage=new \App\Controler\Backend();
            $deleteImage->deleteImage($_COOKIE['ID'],$_GET['id']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }

    })->with('id','[0-9]+');

    $router->get('messages',function(){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){
            messages($_COOKIE['ID']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    });

    $router->get('sentMessages',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            sentMessages($_GET['messageId'],$_COOKIE['ID']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }




    })->with('messageId','[0-9]+');

    $router->get('readArchivedMessages',function (){

        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            readArchivedMessages($_GET['messageId'],$_COOKIE['ID']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }




    })->with('messageId','[0-9]+');

    $router->get('readMessage',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            readUnreadMessages($_GET['messageId'],$_COOKIE['ID']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('messageId','[0-9]+');

    $router->post('sendMessage',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){
            sendMessage($_GET['expeditor'],$_GET['receiver']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('expeditor','[0-9]+')->with('receiver','[0-9]+');

    $router->get('listProfile',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            require_once 'lib/listProfils.php';
            //listProfile();

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    });

    $router->get('homeUserFront',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            $homeUserFront= new \App\Controler\Frontend();
            $homeUserFront->homeUserFront($_GET['userId']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('userId','[0-9]+');


    $router->get('userGalerie',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            userGalerie($_GET['userId'],$_GET['username']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('userId','[0-9]+')->with('username','[a-zA-Z ]+');


    $router->get('frontGalerieViewer',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){
            frontGalerieViewer($_GET['id'],$_GET['username']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('id','[0-9]+')->with('username','[a-zA-Z ]+');


    $router->get('archiveMessages',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            archiveMessages($_GET['messageId'],$_COOKIE['ID']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }

    })->with('messageId','[0-9]+');


    $router->get('deleteMessage',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){

            deleteMessage($_GET['messageId']);

        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('messageId','[0-9]+');


    $router->post('messageToWebmaster',function (){
        if(isset($_COOKIE['ID'])&& isset($_COOKIE['username'])){
            sendMessageToWebmaster($_GET['expeditor'],$_GET['receiver']);
        }
        else
        {
            throw new Exception("Erreur vous n'êtes pas connectez. Veuillez vous identifier");
        }
    })->with('expeditor','[0-9]+')->with('receiver','[0-9]+');




$router->run();
}
catch (Exception $e)
{
    $errorMessage= $e->getMessage();
    $bg_ramdom = mt_rand(1, 4);
    $data=[
        'errorMessage'=>$errorMessage,
        'bgRamdom'=>$bg_ramdom
    ];


    // require('templates/404.html.twig');
    twigRender('404.html.twig',"errorMessage",$data);




}
