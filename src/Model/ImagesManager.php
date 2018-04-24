<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 03/04/2018
 * Time: 16:16
 */

namespace App\Model;


use PDO;
class ImagesManager extends Manager
{

    public function __construct()
    {
        parent::__construct('projet5_images');

    }

    /**
     * Insert un objet Projet5_image dans la BDD et met à jour l'objet passé en argument en lui attribuant un identifiant (id)
     * @param Projet5_images $image objet de type Projet5_images passé par référence
     * @return bool true si l'objet a été inséré; false si une erreur survient
     */
    public function create(Projet5_images &$image){
        $this->pdostatement=$this->pdo->prepare('REPLACE INTO projet5_images VALUES (NULL,:user_id, :dirname,:filename, :ext)');
        //liaison des paramètres
        $this->pdostatement->bindValue(':user_id',$image->getUserId(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':dirname',$image->getDirname(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':filename',$image->getFilename(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':ext',$image->getExtension(),PDO::PARAM_STR);
        //execution de la requête
        $executeIsOk=$this->pdostatement->execute();

        if (!$executeIsOk){
            return false;
        }
        else{
            $id=$this->pdo->lastInsertId();
            $image= $this->read($id);
            return $image; var_dump($image);


        }



    }

    /**
     * récupère un objet contact à partir de son identifiant
     * @param int $id identifiant d'une image
     *
     * @return bool|Contact|Null false si une erreur survient, un objet si un correspondance est trouvée,
     * Null s'il n'y aucune correspondance
     */
   /* public function read($imgId){
        $this->pdostatement= $this->pdo->prepare('SELECT * FROM projet5_images WHERE id= :id');
        //liaison paramètres
        $this->pdostatement->bindValue(':id',$imgId,PDO::PARAM_INT);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $image = $this->pdostatement->fetchObject('App\Model\Projet5_images');
            if($image===false){
                return null;
            }
            else{
                return $image;
            }
        }else{
            return false;
        }
    }*/

    /*public function readUserImg( $userId)
    {
        $this->pdostatement= $this->pdo->prepare('SELECT * FROM projet5_images WHERE user_id= :userId');
        //liaison paramètres
        $this->pdostatement->bindValue(':userId',$userId,PDO::PARAM_INT);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $image = $this->pdostatement->fetchObject('App\Model\Projet5_images');
            if($image===false){
                return null;
            }
            else{
                return $image;
            }
        }else{
            return false;
        }
    }*/


    /**
     * Récupère tous les objets Projet5_images de la BDD
     *
     * @return array|bool tableau d'ojbet Contact ou un tableau vide s'il n'y aucun d'ojet ou false si une erreur survient
     *
     */
    /*public function  readAll(){
        $this->pdostatement= $this->pdo->query('SELECT * FROM projet5_images ');
        //construction tableau d'objet de type Contact
        $images = [];
        while ($image= $this->pdostatement->fetchObject('App\Model\Projet5_images')){
            $images[]= $image;
        }
        return $images;
    }

    /**
     * Met à jour un objet stocké en base de données
     * @param Projet5_images $image objet de type Contact
     * @return bool true en cas de succès et false en cas d'erreur
     */
    /*private function update(Projet5_images $image){
        $this->pdostatement=$this->pdo->prepare('UPDATE projet5_images set dirname=:dirname, filename=:filename,extension=:extension WHERE user_id=:id LIMIT 1');
        //liaison des éléments
        $this->pdostatement->bindValue(':dirname',$image->getDirname(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':filename',$image->getFilename(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':extension',$image->getExtension(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':id',$image->getId(),PDO::PARAM_INT);

        //exécution de la requête

        return $this->pdostatement->execute();



    }*/

    /**
     * Supprime un objet stocké en base de données
     * @param $img int identifiant de l'image
     * @return bool true en cas de succès et false en cas d'erreur
     */
   /* public function delete($img){

        $this->pdostatement=$this->pdo->prepare('DELETE FROM projet5_images WHERE id= :id LIMIT 1');
        $this->pdostatement->bindValue(':id',$img, PDO::PARAM_INT);
        //execution de la requête
        return $this->pdostatement->execute();
    }*/

   /* public function deleteimageUser( $userId){
        $this->pdostatement=$this->pdo->prepare('DELETE FROM projet5_images WHERE user_id=:userId');
        $this->pdostatement->bindValue(':userId',$userId,PDO::PARAM_INT);
        return $this->pdostatement->execute();
    }*/


    public function deletePicture($picture2delete)
    {
        $this->pdostatement = $this->pdo->prepare('
        DELETE FROM projet5_images WHERE user_id = :userId AND filename= :filename');
        $this->pdostatement->bindValue(':userId', $_COOKIE['ID'],PDO::PARAM_INT);
        $this->pdostatement->bindValue(':filename', $picture2delete,PDO::PARAM_STR);
        return $this->pdostatement->execute();
    }









    /**
     * Insère un objet en bdd et met à jour l'objet passé en argument en lui spécifiant un identifiant ou le met simplement à jour dans la bdd s'il en est issu
     *
     * @param Projet5_images $image
     * @return bool
     */















}