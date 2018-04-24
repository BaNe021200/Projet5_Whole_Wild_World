<?php
namespace App\Controler;


use App\Model\InfosuserManager;
use App\Model\MailsManager;
use App\Model\Manager;
use App\Model\Projet5_mails;
use App\Model\Projet5_user;
use App\Model\Session;
use App\Model\UserManager;

require_once 'twig.php';
class Frontend
{
    public static function home()
    {
        $userManager = new UserManager();
        $profils= $userManager->getProfils();

        //require_once 'src/templates/frontend/home2.php';
        twigRender('frontend/home.html.twig','userdata', $profils);
    }

    public function signUp()
    {
        twigRender('frontend/signUp.html.twig','session',$_SESSION);
    }

    public function get_registry()
    {
        $hashPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //$JSON= json_encode(["ROLE_USER"]);
        $token= str_random(60);

        $user = new Projet5_user();
        $manager= new Manager('projet5_user');



        $user
            ->setGender($_POST['gender'])
            ->setFirstName($_POST['first_name'])
            ->setLastName($_POST['last_name'])
            ->setUsername($_POST['username'])
            ->setBirthday($_POST['birthday'])
            ->setEmail($_POST['email'])
            ->setPassword($hashPwd)
            ->setConfirmationToken($token);
           // ->setRole($JSON);


        $userManager= new UserManager();
        $addUser= $userManager->save($user);
        $finalUpdate=$userManager->newUserFinalUpdate($user);
        $newUser=$manager->read($user->getId());


        if($addUser)
        {
            /*$session= new Session();
            $session->setFlash("Un email vous a été envoyé pour valider votre compte",'success');
            $session->flash();*/

            session_destroy();
            $userId=$user->getId();

            mail($newUser->getEmail(), 'Confirmation de votre compte', "Bonjour ".$newUser->getFirstName(). "
            Notez votre pseudo : ".$newUser->getUsername()." <br> Votre mot de passe est celui que vous avez tapé pour vous inscrire. 
            Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://myphptraining/Whole%20wild%20world/confirm?id=$userId&token=$token");

            //twigRender('frontend/home.html.twig','session',$session);
            //Frontend::home('session',$session);
           // twigRender('frontend/registrySucces.html.twig','','');
            exit();
        }






    }

    public function homeUserFront($userId)
    {
        $userManager= new UserManager();
        $InfosManager= new InfosuserManager();
        $data= $userManager->getProfil($userId);
        $infos=$InfosManager->read($userId);

        $data=[
         'data'=>$data,
         'userInfos' =>$infos
        ];



        twigRender('frontend/homeUserFront.html.twig','data',$data);
    }

    public function sendMessage($expeditor, $receiver)
    {

        $message = new Projet5_mails();
        $message
            ->setExpeditor(intval($_GET['expeditor']))
            ->setReceiver(intval($_GET['receiver']))
            ->setTitle($_POST['title'])
            ->setMessage($_POST['message']);

        $mailManager = new MailsManager();
        $sendMessage = $mailManager->create($message);

        if(intval($_GET['receiver'])===0)
        {
            mail('mail@site.com',"'nouveau message de'.$expeditor","$expeditor.'vous a envoyeé un mùessage'");
        }

        $Session = new Session();
        if ($sendMessage)
        {

            $Session->setFlash('votre message est envoyé','success');
            $Session->flash();
            // header('Location:homeUserFront&userId='.$receiver);

            twigRender('homeUser.html.twig','','','','');
        }
        else
        {
            //$Session = new Session();
            $Session->setFlash('Une erreur est survenue votre message n\'est pas envoyé','danger');
            $Session->flash();
            twigRender('homeUser.html.twig','','','','');
        }
    }

    public function userGalerie($userId,$username)
    {
        $imageManager = new Manager('projet5_thumbnails');
        $usermanager=new Manager('projet5_user');

        //$userGalerie= $user->frontUsergalerie($userId,$username);
        $userGalerie= $imageManager->readUsers($userId,'user_id');
        //$username=$usermanager->readQItemUser($username,"username");





        twigRender('frontend/userGalerie.html.twig','images',$userGalerie);
    }

    public function frontGalerieViewer($imageId,$username)
    {

        $imageManager=new Manager('projet5_images');
        $view = $imageManager->readUser($imageId,'id');


        twigRender('frontend/frontGalerieViewer.html.twig','view',$view);
    }

}