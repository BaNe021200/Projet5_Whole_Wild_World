<?php
declare(strict_types=1);

namespace App\Controler;




use App\Model\ImagesManager;
use App\Model\Manager;
use App\Model\Projet5_images;
use App\Model\Session;
use App\Model\ThumbnailsManager;
use App\Model\UserManager;
use Twig\Cache\NullCache;

require_once 'twig.php';
require_once 'lib/functions.php';
//require_once 'model/User.php';
require_once 'lib/resize2.php';
require_once 'lib/crop.php';

class Backend
{


    public static function homeUser()
    {
        if (file_exists("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg")) {
            $src = "users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg";
        } else {
            $src = "users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped.jpg";
        }


        $Manager = new Manager('Projet5_User');
        $isConnected = $Manager->read($_COOKIE['ID']);

        if((strval($isConnected->getId())===$_COOKIE['ID']) && ($isConnected->getUsername()===$_COOKIE['username']))
        {
            $manager = New \App\Model\UserManager();
            $connectedSelf=$manager->connexionStatus($_COOKIE['ID'],1);
        }
        twigRender('homeUser.html.twig','imageProfil',$src);

    }

    public function connectUser()
    {
        twigRender('connexion.html.twig','','');

    }

    public static function authentificationConnexion()
    {

        $manager =new Manager('projet5_user');
        $getUserCredential = $manager->readUser($_POST['username'],"username");


        $pwd=$_POST['password'];
//var_dump($getUserCredential);
        if(!is_null($getUserCredential) && !is_null($getUserCredential->getConfirmedAt()))
        {
            if(password_verify($pwd,$getUserCredential->getPassword()))
            {
                $_SESSION['id'] = strval($getUserCredential->getId());
                $_SESSION['username'] = $getUserCredential->getUsername();
                $_SESSION['first_name'] = $getUserCredential->getFirstName();
                $_SESSION['gender'] = $getUserCredential->getGender();
                $_SESSION['ip'] = $_SERVER['SERVER_ADDR'];

                setcookie("ID", $_SESSION['id'], time() + 3600 * 24 * 365, '', '', false, true);
                setcookie("username", $_SESSION['username'], time() + 3600 * 24 * 365, '', '', false, true);
                setcookie("first_name", $_SESSION['first_name'], time() + 3600 * 24 * 365, '', '', false, true);
                setcookie("ip", $_SESSION['ip'], time() + 3600 * 24 * 365, '', '', false, true);

                $session=new Session();
                $session->setFlash('Vous êtes à présent connecté','success');
                $session->flash();
              twigRender('homeUser.html.twig','session',$session);
                //header('Location:homeUser');


            }else{
                throw new \Exception('Mauvais identifiant ou mot de passe');
            }

        }else{
            throw new \Exception('Cet identifiant n\'existe pas ou votre email n\'a pas été confirmé');
        }







    }

    public  function register()
    {
        if (!empty($_POST))
        {   $errors=[];






            if(empty($_POST['first_name']) || !preg_match('/^[a-zéèA-Z-]+$/', $_POST['first_name']))
            {
                $errors['first_name'] = "Le champ prénom ne peut contenir que des minuscules et des majuscules ainsi que des tirets (-) ";
            }

            if(empty($_POST['last_name']) || !preg_match('/^[a-zéèA-Z-]+$/', $_POST['last_name']))
            {
                $errors['last_name'] = "Le champs nom  ne peut contenir que des minuscules et des majuscules ainsi que des tirets (-) ";
            }

            if (empty($_POST['username'])|| !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['username'] ))
                {
                   $errors['username'] = "le champs pseudo n'accepte que des lettres (majuscules et/ou minuscules).Les espaces sont représentés, dans le formulaire, par des tirets bas (underscores : '_'). Les espaces apparaitrons sur le site.";
                }
            else
            {
                $Manager = new Manager('projet5_user');
                $usermanager= new UserManager();

                $ifUnderscore=strpos($_POST['username'],'_');

                if($ifUnderscore!= false)
                {
                    $username=str_replace('_',' ',$_POST['username']);
                }



                $username = $Manager->readQItemUser($_POST['username'],'username');
                if($username)
                {
                    $errors['username']= 'Ce pseudo est déjà pris';
                }

            }

            $birthDay= calendarControl();

            if ($birthDay==false)
            {
                $errors['birthday'] ="la date est incorecte";

            }

            $birthDayControl= birthdayControl();
            if ($birthDayControl==false)
            {
                $errors['birthday']="Désolé vous n'avez pas l'age requis !";
                //exit();
            }

            if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = "Votre email n'est pas valide";
            }else
            {
                $Manager = new Manager('projet5_user');
                $email = $Manager->readQItemUser($_POST['email'],'email');
                if($email)
                {
                    $errors['email']='Cet email est déjà utilisé pour un autre compte';
                }

            }


            if(empty($_POST['password'])|| $_POST['password']!=$_POST['password2'])
            {
                $errors['password']="Vous devez entrer un mot de passe valide";
            }

            if(empty($errors))
            {
                if(isAjax()) {

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode(['success' => 'Bravo !']);

                    /*$getRegistry= new Frontend();
                    $getRegistry->get_registry();*/
                    die();
                }
                else
                    {
                        $getRegistry= new Frontend();
                        $getRegistry->get_registry();
                    }

            }

            if(!empty($errors))
            {
                if(isAjax()) {

                    header('Content-Type: application/json');
                    http_response_code(400);
                    echo json_encode($errors);
                    die();
                }
                @$_SESSION['gender']=$_POST['gender'];
                @$_SESSION['first_name']=$_POST['first_name'];
                @$_SESSION['last_name']=$_POST['last_name'];
                @$_SESSION['username']=$_POST['username'];
                @$_SESSION['email']=$_POST['email'];
                @$_SESSION['birthday']=$_POST['birthday'];

                twigRender('frontend/signUp.html.twig','errors',$errors);


                //header('Location:signUp');
            }
        }
    }

    public function disconnectUser()
    {
        $manager= new UserManager();
        @$disconnectUser = $manager->connexionStatus($_COOKIE['ID'],NULL);
        session_destroy();
        setcookie("ID","", time()- 60);
        setcookie("username","", time()- 60);
        setcookie("first_name","", time()- 60);
        setcookie("ip","", time()- 60);

        header('Location:home');

        //Frontend::home();
    }

    public function emailConfirmation($userId,$token){

        $token= $_GET['token'];

        $manager = new Manager('projet5_user');
        $user = $manager->readUser($userId,'id');

        if($user && $user->getConfirmationToken()==$token )
        {

            $userManager= new UserManager();
            $userConfirm = $userManager->updateConfirm($userId);

            if($userConfirm)
            {




                $this->autoConnect($user);


            }





        } else
        {
            $session= new Session();
            $session->setFlash('Ce token n\'est plus valide','danger');
            $session->flash();
            $connexion= new Backend();
            twigRender('connexion.html.twig','session',$session);

        }

    }

    public function autoConnect($user)
    {


//var_dump($getUserCredential);




                $_SESSION['id'] = strval($user->getId());
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['first_name'] = $user->getFirstName();
                $_SESSION['gender'] = $user->getGender();
                $_SESSION['ip'] = $_SERVER['SERVER_ADDR'];

                setcookie("ID", $_SESSION['id'], time() + 3600 * 24 * 365, '', '', false, true);
                setcookie("username", $_SESSION['username'], time() + 3600 * 24 * 365, '', '', false, true);
                setcookie("first_name", $_SESSION['first_name'], time() + 3600 * 24 * 365, '', '', false, true);
                setcookie("ip", $_SESSION['ip'], time() + 3600 * 24 * 365, '', '', false, true);

        $session= new Session();
        $session->setFlash('Votre compte a bien été validé','success');
        $session->flash();
                twigRender('homeUser.html.twig','session',$session);
                //header('Location:homeUser');







    }

    public function galerie1()
    {

        twigRender('galerie1.html.twig','','' ,'','');
    }

    public function imageProfile()
    {
        $imageManager = new ImagesManager();
        if (!file_exists('users/img/user/'.$_COOKIE['username'].'/profilPicture')) {
            newFolderProfilPicture();
            if (file_exists("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg")) {
                copy("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg", 'users/img/user/'.$_COOKIE['username'].'/profilPicture/img-userProfil.jpg');
            } else {
                copy("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped.jpg", 'users/img/user/'.$_COOKIE['username'].'/profilPicture/img-userProfil.jpg');
            }
        }
        else {
            $deleteimageProfile=$imageManager->deletePicture("img-userProfil");
            $deleteimageProfile=$imageManager->deletePicture("img-userProfil");

            if (file_exists("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg")) {
                copy("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg", 'users/img/user/'.$_COOKIE['username'].'/profilPicture/img-userProfil.jpg');
            } else {
                copy("users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped.jpg", 'users/img/user/'.$_COOKIE['username'].'/profilPicture/img-userProfil.jpg');
            }
        }

        $imageProfil= new Projet5_images();
        $imageProfil
            ->setUserId(intval($_COOKIE['ID']))
            ->setDirname('users/img/user/'.$_COOKIE['username'].'/profilPicture')
            ->setFilename('img-userProfil')
            ->setExtension('jpg');

        $addProfilPicture = $imageManager->create($imageProfil);

        //$imageProfile = $user->addProfilPicture();

    }

    public function uploadPicture($userId,$img)
    {


        //$user=new oldUserManager();
        $image = new Projet5_images();
        $imageManager = new ImagesManager();

        $messages = [];

        if(!file_exists('users/img/user/'.$_COOKIE['username']))
        {
            newFolder();
            foreach ($_FILES as $file) {//var_dump($file['name']);


                if ($file['error'] == UPLOAD_ERR_NO_FILE) {
                    continue;
                }

                if (is_uploaded_file($file['tmp_name'])) {
                    //on vérifie que le fichier est d'un type autorisé
                    $typeMime = mime_content_type($file['tmp_name']);
                    if ($typeMime == 'image/jpeg') {
                        //on verifie la taille du fichier
                        $size = filesize($file['tmp_name']);
                        if ($size > 1600000) {
                            $messages[] = "le fichier est trop gros";
                        } else {


                            //$destinationPath='upload/user/'.$file['name'];
                            $destinationPath ="users/img/user/".$_COOKIE['username'].'/img_00'.$img.'.jpg';
                            $image
                                ->setUserId(intval($_COOKIE['ID']))
                                ->setDirname('users/img/user/'.$_COOKIE['username'])
                                ->setFilename('img_00'.$img)
                                ->setExtension('jpg');

                            $uploadimage= $imageManager->create($image);



                            $temporaryPath = $file['tmp_name'];

                            if (move_uploaded_file($temporaryPath, $destinationPath)) {
                                $messages[] = "le fichier a été correctement uploadé";


                            } else {
                                $messages[] = "le fichier  n'a pas été correctement uploadé";

                            }

                        }
                    } else {
                        $messages[] = 'type de fichiers non valide';
                    }
                } else {

                    if($file['error']==2){$messages[]= 'votre fichier est trop volumineux';}
                    if($file['error']==1){$messages[]= 'votre fichier excède la taille de configuration du serveur';}

                    //$messages[] = 'un problème est survenu lors de l\'upload';
                }
                //$destinationPath= $user->addUserFiles($_SESSION['id']);
            }//twigRender('homeUserFront.html.twig', 'message', $messages);

        }
        else
        {
            foreach ($_FILES as $file) {//var_dump($file['name']);


                if ($file['error'] == UPLOAD_ERR_NO_FILE) {
                    continue;
                }

                if (is_uploaded_file($file['tmp_name'])) {
                    //on vérifie que le fichier est d'un type autorisé
                    $typeMime = mime_content_type($file['tmp_name']);
                    if ($typeMime == 'image/jpeg') {
                        //on verifie la taille du fichier
                        $size = filesize($file['tmp_name']);
                        if ($size > 1600000) {
                            $messages[] = "le fichier est trop gros";
                        } else {



                            $destinationPath ="users/img/user/".$_COOKIE['username'].'/img_00'.$img.'.jpg';
                            $image
                                ->setUserId(intval($_COOKIE['ID']))
                                ->setDirname('users/img/user/'.$_COOKIE['username'])
                                ->setFilename('img_00'.$img)
                                ->setExtension('jpg');

                            $uploadimage= $imageManager->create($image);




                            $temporaryPath = $file['tmp_name'];

                            if (move_uploaded_file($temporaryPath, $destinationPath)) {
                                $messages[] = "le fichier a été correctement uploadé";


                            } else {
                                $messages[] = "le fichier n'a pas été correctement uploadé";

                            }

                        }
                    } else {
                        $messages[] = 'type de fichiers non valide';
                    }
                } else {

                    if($file['error']==2){$messages[]= 'votre fichier est trop volumineux';}
                    if($file['error']==1){$messages[]= 'votre fichier excède la taille de configuration du serveur. il doit être impérativement < 1.4Mo';}

                    //$messages[] = 'un problème est survenu lors de l\'upload';
                }



            }
        }
        //resizeImage();


        twigRender('success.html.twig','message', $messages,'','');

        @$imageId= strval($uploadimage->getId());
        @thumbNails2(525,700,$_COOKIE['ID'],$imageId);
        @resizeByHeight();
        @cropImages();
        @$this->imageProfile();



    }

    public function recropped($userId,$img){



        $folder="users/img/user/".$_COOKIE['username'].'/img_00'.$img.'.jpg';
        $file2crop="users/img/user/".$_COOKIE['username'].'/crop/img_00'.$img.'-cropped.jpg';
        if(file_exists($folder))
        {
            //$folderpart=pathinfo($folder);
            //$folderfilename=$folderpart['filename'];
            cropcenter($folder);
            $cropCenterFile='users/img/user/'.$_COOKIE['username'].'/crop/img_00'.$img.'-crop-center.jpg';

            $imageCropcenter= new Projet5_images();
            $imageCropcenter
                ->setUserId(intval($_COOKIE['ID']))
                ->setDirname('users/img/user/'.$_COOKIE['username'].'/crop')
                ->setFilename('img_001-cropped-center')
                ->setExtension('jpg');
            $imageManager = new ImagesManager();
            $addCropCenterFiles = $imageManager->create($imageCropcenter);
            $recrop=[

                'recrop'=>$imageCropcenter,
                'img2crop'=>$file2crop
            ];


            //$cropCenterFile = $user->addCropCenterFiles($userId,$img);

            twigRender('recroppedView.html.twig','recrop',$recrop);
        }
        else
        {
            throw new Exception('Il n\'y a rien à recadrer');
        }
        $this->imageProfile();

    }

    public function croppedChoice($userId,$img){


        $src="users/img/user/".$_COOKIE['username']."/crop/img_001-cropped-center.jpg";
        $imageManager = new ImagesManager();
        $deleteImageCroppedCenter= $imageManager->delete($img);
        if(file_exists($src))
        {

            unlink("users/img/user/".$_COOKIE['username']."/crop/img_001-cropped-center.jpg");

            header('Location: homeUser');
        }
        else
        {
            throw new Exception('Il n\'y a rien effacer');
        }
        $this->imageProfile();


    }

    public function deleteImage($userId,$imageId)
    {
        $imageManager= new ImagesManager();
        $thumbnailManager= new ThumbnailsManager();

        $deleteimage= $imageManager->deletePicture('img_00'.$imageId);
        $deleteCropped = $imageManager->deletePicture('img_00'.$imageId.'-cropped');
        $deleteCroppedCenter = $imageManager->deletePicture('img_00'.$imageId.'-cropped-center');
        $deleteThumbnail = $thumbnailManager->deleteThumbnail('users/img/user/'.$_COOKIE['username'].'/thumbnails/img_00'.$imageId.'-thumb.jpg');
        //$imageManger= new App\Model\ImagesManager();
        //$imageDeleted=$user->deleteImage($userId,$imageId);
        if($imageId==='1')
        {

            $deleteProfilPicture=$imageManager->deletePicture("img-userProfil");
            $folderThumbnails="users/img/user/".$_COOKIE['username'].'/thumbnails/img_00'.$imageId.'-thumb.jpg';
            $folderProfilPicture='users/img/user/'.$_COOKIE['username'].'/profilPicture/img-userProfil.jpg';
            $folderCroppedCenterToDelete = "users/img/user/".$_COOKIE['username'].'/crop/img_00'.$imageId.'-cropped-center.jpg';
            $folderCroppedToDelete = "users/img/user/".$_COOKIE['username'].'/crop/img_00'.$imageId.'-cropped.jpg';
            $folderToDelete = "users/img/user/".$_COOKIE['username'].'/img_00'.$imageId.'.jpg';

            if(file_exists($folderThumbnails)){
                unlink($folderToDelete);
                unlink($folderProfilPicture);
                unlink($folderCroppedToDelete);
                @unlink($folderCroppedCenterToDelete);
                unlink($folderThumbnails);


            }
            else {
                throw new Exception('Il N\'y a rien à effacer');
            }
        }else
        {

            $folderThumbnails="users/img/user/".$_COOKIE['username'].'/thumbnails/img_00'.$imageId.'-thumb.jpg';

            $folderCroppedCenterToDelete = "users/img/user/".$_COOKIE['username'].'/crop/img_00'.$imageId.'-cropped-center.jpg';
            $folderCroppedToDelete = "users/img/user/".$_COOKIE['username'].'/crop/img_00'.$imageId.'-cropped.jpg';
            $folderToDelete = "users/img/user/".$_COOKIE['username'].'/img_00'.$imageId.'.jpg';

            if(file_exists($folderThumbnails)){
                unlink($folderToDelete);

                unlink($folderCroppedToDelete);
                unlink($folderCroppedCenterToDelete);
                unlink($folderThumbnails);


            }
            else {
                throw new Exception('Il N\'y a rien à effacer');
            }
        }

        header('Location:galerie1');
    }

    public function getUserImages($userId)
    {
        $thumbnailManager= new Manager('projet5_thumbnails');
        $folder=$thumbnailManager->readUsers($userId,'user_id');//var_dump($folder);

        twigRender('galerie3.html.twig','images',$folder);
        //require_once 'templates/photo.php';


    }
    public function viewerGalerie($imageId)
    {

        $imageManager=new Manager('projet5_images');
        $view = $imageManager->readUser($imageId,'id');

        twigRender('galerieViewer.html.twig','view',$view,'','');
    }



}