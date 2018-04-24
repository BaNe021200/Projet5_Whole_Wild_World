<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 04/04/2018
 * Time: 22:01
 */

namespace App\Model;

use PDO;

class ThumbnailsManager extends Manager
{

    public function __construct()
    {
        parent::__construct('projet5_thumbnails');

    }

    public function create(Projet5_thumbnails &$thumbnail){
        $this->pdostatement=$this->pdo->prepare('REPLACE INTO projet5_thumbnails VALUES (NULL,:user_id,:image_id,:thumbnail)');
        //liaison des paramètres
        $this->pdostatement->bindValue(':user_id',$thumbnail->getUserId(),PDO::PARAM_INT);
        $this->pdostatement->bindValue(':image_id',$thumbnail->getImageId(),PDO::PARAM_INT);
        $this->pdostatement->bindValue(':thumbnail',$thumbnail->getThumbnail(),PDO::PARAM_STR);

        //execution de la requête
        $executeIsOk=$this->pdostatement->execute();

        if (!$executeIsOk){
            return false;
        }
        else{
            $id=$this->pdo->lastInsertId();
            $thumbnail= $this->read($id);
            return $thumbnail;


        }



    }

    public function read($userId)
    {
        $this->pdostatement= $this->pdo->prepare('SELECT * FROM projet5_thumbnails WHERE user_id= :userId');
        //liaison paramètres
        $this->pdostatement->bindValue(':userId',$userId,PDO::PARAM_INT);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        $thumbnails = [];
        while ($thumbnail= $this->pdostatement->fetchObject("App\Model\Projet5_thumbnails")){
            $thumbnails[]= $thumbnail;
        }

        return $thumbnails;




        /*if($executeIsOk){
            $thumbnail = $this->pdostatement->fetchObject('App\Model\Projet5_thumbnails');
            if($thumbnail===false){
                return null;
            }
            else{
                return $thumbnail;
            }
        }else{
            return false;
        }*/
    }

    /**
     * Récupère tous les objets Projet5_user de la BDD
     *
     * @return array|bool tableau d'ojbet Projet5_user ou un tableau vide s'il n'y aucun d'ojet ou false si une erreur survient
     *
     */
    /*public function  readAll()
    {
        $this->pdostatement= $this->pdo->query('SELECT * FROM projet5_thumbnails ');
        //construction tableau d'objet de type Contact
        $thumbnails = [];
        while ($thumbnail= $this->pdostatement->fetchObject("App\Model\Projet5_thumbnails")){
            $thumbnails[]= $thumbnail;
        }

        return $thumbnails;


    }*/

    public function deleteThumbnail($thumbnail2delete)
    {
        $this->pdostatement = $this->pdo->prepare('
        DELETE FROM projet5_thumbnails WHERE user_id = :userId AND thumbnail= :thumbnail');
        $this->pdostatement->bindValue(':userId', $_COOKIE['ID'],PDO::PARAM_INT);
        $this->pdostatement->bindValue(':thumbnail', $thumbnail2delete,PDO::PARAM_STR);
        return $this->pdostatement->execute();
    }

    /*public function delete($id){
        $this->pdostatement=$this->pdo->prepare('DELETE FROM projet5_thumbnails WHERE user_id=:id');
        $this->pdostatement->bindValue(':id',$id,PDO::PARAM_INT);//var_dump($id);
        return $this->pdostatement->execute();
    }*/






}