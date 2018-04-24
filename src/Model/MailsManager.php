<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 05/04/2018
 * Time: 16:43
 */

namespace App\Model;

use PDO;

class MailsManager extends Manager
{


    public function __construct()
    {
        parent::__construct('projet5_mails');

    }

    /**
     * Insert un objet Projet5_mails dans la BDD et met à jour l'objet passé en argument en lui attribuant un identifiant (id)
     * @param Projet5_mails $Projet5_mails objet de type Projet5_mails passé par référence
     * @return bool true si l'objet a été inséré; false si une erreur survient
     */
    public function create(Projet5_mails &$Projet5_mails){
        $this->pdostatement=$this->pdo->prepare('INSERT INTO Projet5_mails VALUES (NULL, :expeditor,:receiver,:title,:message,Now(),:see )');
        //liaison des paramètres
        $this->pdostatement->bindValue(':expeditor',$Projet5_mails->getExpeditor(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':receiver',$Projet5_mails->getReceiver(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':title',$Projet5_mails->getTitle(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':message',$Projet5_mails->getMessage(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':see',0,PDO::PARAM_STR);
        //execution de la requête
        $executeIsOk=$this->pdostatement->execute();

        if (!$executeIsOk){
            return false;
        }
        else{
            $id=$this->pdo->lastInsertId();
            $Projet5_mails= $this->read($id);
            return true;


        }



    }

    public function getMessages($userId,$mp_read)
    {
        $this->pdostatement=$this->pdo->prepare('
        SELECT projet5_mails.id as mp_id,expeditor,receiver,title,message,DATE_FORMAT(time, \'%d/%m/%Y à %Hh%i\') AS time_date_fr,mp_read, projet5_user.id,username,projet5_images.user_id,dirname,filename,extension
            FROM projet5_mails
            JOIN projet5_user
            ON expeditor =projet5_user.id
            JOIN projet5_images
            ON user_id=projet5_user.id
            WHERE projet5_mails.receiver = :receiver AND mp_read='.$mp_read.' AND filename="img-userProfil" ORDER By time_date_fr DESC');
        $this->pdostatement->bindValue('receiver',$userId,PDO::PARAM_INT);
        $executeIsOk= $this->pdostatement->execute();
        $unseenMessages = [];
        while ($unseenMessage= $this->pdostatement->fetchObject("App\Model\Projet5_mails")){
            $unseenMessages[]= $unseenMessage;
        }

        return $unseenMessages;


    }

    public function getSentMessages($userId)
    {
        $this->pdostatement=$this->pdo->prepare('
        SELECT projet5_mails.id as mp_id,expeditor,receiver,title,message,DATE_FORMAT(time, \'%d/%m/%Y à %Hh%i\') AS time_date_fr, projet5_user.id,username,projet5_images.user_id,dirname,filename,extension
        FROM projet5_mails
        JOIN projet5_user
        ON receiver =projet5_user.id
        JOIN projet5_images
        ON user_id=projet5_user.id
        WHERE projet5_mails.expeditor = :expeditor  AND filename="img-userProfil" ORDER By time_date_fr DESC');
        $this->pdostatement->bindValue(':expeditor',$userId,PDO::PARAM_INT);

        $executeIsOk= $this->pdostatement->execute();
        $sentMessages = [];
        while ($sentMessage= $this->pdostatement->fetchObject("App\Model\Projet5_mails")){
            $sentMessages[]= $sentMessage;
        }

        return $sentMessages;


    }


    public function readMessages($messageId,$userId,$from,$to)
    {
        $this->pdostatement=$this->pdo->prepare('
        
        SELECT projet5_mails.id as mp_id,expeditor,receiver,title,message,DATE_FORMAT(time, \' % d /%m /%Y à % Hh % i\') AS time_date_fr,mp_read, projet5_user.id,username,projet5_images.user_id,dirname,filename,extension
            FROM projet5_mails
            JOIN projet5_user
            ON '.$from.' =projet5_user.id
            JOIN projet5_images
            ON user_id=projet5_user.id
            WHERE projet5_mails.id=:id AND '.$to.' = :toUser AND filename="img-userProfil"');

        $this->pdostatement->bindValue(':id',$messageId,PDO::PARAM_INT);
        $this->pdostatement->bindValue(':toUser',$userId,PDO::PARAM_INT);
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $unseenMessage = $this->pdostatement->fetchObject('App\Model\Projet5_mails');
            if($unseenMessage===false){
                return null;
            }
            else{
                return $unseenMessage;
            }
        }else{
            return false;
        }
    }

    public function read($id){
        $this->pdostatement= $this->pdo->prepare('SELECT * FROM projet5_mails WHERE id= :id');
        //liaison paramètres
        $this->pdostatement->bindValue(':id',$id,PDO::PARAM_INT);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $message = $this->pdostatement->fetchObject('App\Model\Projet5_mails');
            if($message===false){
                return null;
            }
            else{
                return $message;
            }
        }else{
            return false;
        }
    }

    /*public function readUserMail($who,$whoQuery)
    {
        $this->pdostatement=$this->pdo->prepare('
        
        SELECT * 
        FROM projet5_mails
        WHERE '.$whoQuery.'= :who');
        $this->pdostatement->bindValue(':who',$who,PDO::PARAM_INT);
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $message = $this->pdostatement->fetchObject('App\Model\Projet5_mails');
            if($message===false){
                return null;
            }
            else{
                return $message;
            }
        }else{
            return false;
        }

    }*/



    public function updateStatus($messageId,$mp_read)
    {
        $this->pdostatement = $this->pdo->prepare("
        
        UPDATE projet5_mails
        SET mp_read= $mp_read
        WHERE projet5_mails.id = :mpId");

        $this->pdostatement->bindValue('mpId',$messageId,PDO::PARAM_INT);
        return $this->pdostatement->execute();
    }

    public function countMessages($userId,$mp_read)
    {
        $this->pdostatement= $this->pdo->prepare('
            SELECT COUNT(mp_read)
            FROM projet5_mails
            WHERE mp_read='.$mp_read.' AND receiver=:receiver');
       $this->pdostatement->bindValue('receiver',$userId,PDO::PARAM_INT);
       $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $countMessages = $this->pdostatement->fetch();
            if($countMessages===false){
                return null;
            }
            else{
                return $countMessages;
            }
        }else{
            return false;
        }
    }

    public function countSentMessages($userId)
    {
        $this->pdostatement= $this->pdo->prepare('
        SELECT COUNT(id)
        FROM projet5_mails WHERE expeditor=:exp');
        $this->pdostatement->bindValue(':exp',$userId,PDO::PARAM_INT);
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $countMessages = $this->pdostatement->fetch();
            if($countMessages===false){
                return null;
            }
            else{
                return $countMessages;
            }
        }else{
            return false;
        }


    }

    /*public function delete(Projet5_mails $mail){

        $this->pdostatement=$this->pdo->prepare('DELETE FROM Projet5_mails WHERE id= :id LIMIT 1');
        $this->pdostatement->bindValue(':id',$mail->getId(), PDO::PARAM_INT);
        //execution de la requête
        return $this->pdostatement->execute();
    }*/

    /*public function deleteUserMail($userId)
    {
        $this->pdostatement=$this->pdo->prepare('
            DELETE
            FROM projet5_mails WHERE expeditor=:expeditor OR receiver=:receiver');
            $this->pdostatement->bindValue(':expeditor',$userId,PDO::PARAM_INT);
            $this->pdostatement->bindValue(':receiver',$userId,PDO::PARAM_INT);

            return $this->pdostatement->execute();

    }*/


}