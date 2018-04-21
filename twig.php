<?php
declare(strict_types=1);
require_once 'lib/functions.php';


session_start();
function twigRender($renderPath,$argument,$params)
{
    $mailManager = new \App\Model\MailsManager();




    if (file_exists("users/img/user/" . @$_COOKIE['username'] . "/crop/img_001-cropped-center.jpg")) {
        @$src = "users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped-center.jpg";
    } else {
        @$src = "users/img/user/" . $_COOKIE['username'] . "/crop/img_001-cropped.jpg";
    }
    @$getUnSeenMessages=$mailManager->getMessages($_COOKIE['ID'],0);
    @$getSeenMessages=$mailManager->getMessages($_COOKIE['ID'],1);
    @$getArchiveMessages=$mailManager->getMessages($_COOKIE['ID'],2);
    @$countUnseenMessages = $mailManager->countMessages($_COOKIE['ID'],0);
    @$countSeenMessages = $mailManager->countMessages($_COOKIE['ID'],1);
    @$countArchivedMessage = $mailManager->countMessages($_COOKIE['ID'],2);
    @$countSentMessage = $mailManager->countSentMessages($_COOKIE['ID']);




    $loader = new Twig_Loader_Filesystem(__DIR__ .'/src/templates');
    $twig= new Twig_Environment($loader,[

        'cache'=>/*false,*/ __DIR__.'/tmp',
        'debug'=>true


        ]);
    $twig->addExtension(new Twig_Extension_Debug());
    $twig->addExtension(new Twig_Extensions_Extension_Text());




    echo $twig->render($renderPath,[



        'userDatum' => $_SESSION,
        @'imageProfil'=>$src,
        @'Messagesread'=>$getSeenMessages,
        @'archiveMessages'=>$getArchiveMessages,
        @'unreadMessages'=>$countUnseenMessages,
        @'countReadMessages'=>$countSeenMessages,
        @'countArchiveMessages'=>$countArchivedMessage,
        @'countSentMessages'=>$countSentMessage,
       @ 'usernameGalerieFrontUser'=>@$_GET['username'],
       @ 'userIdGalerieFrontUser'=>@$_GET['userId'],
        @ 'unSeenMessages'=>$getUnSeenMessages,




        $argument=>$params,


    ]);






}

