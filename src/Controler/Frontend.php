<?php
namespace App\Controler;


use App\Model\InfosuserManager;
use App\Model\Manager;
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
        $JSON= json_encode(["ROLE_USER"]);
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
            ->setConfirmationToken($token)
            ->setRole($JSON);


        $userManager= new UserManager();
        $addUser= $userManager->save($user);
        $finalUpdate=$userManager->newUserFinalUpdate($user);
        $newUser=$manager->read($user->getId());


        if($addUser)
        {
            $session= new Session();
            $session->setFlash("Un email vous a été envoyé pour valider votre compte",'success');
            $session->flash();

            session_destroy();
            $userId=$user->getId();

            mail($newUser->getEmail(), 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://myphptraining/Whole%20wild%20world/confirm?id=$userId&token=$token");

            //twigRender('frontend/home.html.twig','session',$session);
            Frontend::home('session',$session);
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





}