<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 05/04/2018
 * Time: 15:15
 */

namespace App\Model;
use PDO;

class InfosuserManager extends Manager
{

    public function __construct()
    {
        parent::__construct('projet5_infosuser');

    }

    public function create(Projet5_infosuser & $Projet5_infosuser){
        $this->pdostatement=$this->pdo->prepare('REPLACE INTO projet5_infosuser VALUES (NULL,:userId,:search,:postal_code,:city,:purpose,:family,:children,:familyAdd,:physic,:speech,:school,:schoolAdd, :business,:buinessAdd)');
        //liaison des paramètres
        $this->pdostatement->bindValue(':userId',$Projet5_infosuser->getUserId(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':search',$Projet5_infosuser->getSearch(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':postal_code',$Projet5_infosuser->getPostalCode(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':city',$Projet5_infosuser->getCity(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':purpose',$Projet5_infosuser->getPurpose(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':family',$Projet5_infosuser->getFamilySituation(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':children',$Projet5_infosuser->getChildren(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':familyAdd',$Projet5_infosuser->getFamilySituationAdd(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':physic',$Projet5_infosuser->getPhysicAdd(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':speech',$Projet5_infosuser->getSpeech(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':school',$Projet5_infosuser->getSchoolLevel(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':schoolAdd',$Projet5_infosuser->getSchoolLevelAdd(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':business',$Projet5_infosuser->getWork(),PDO::PARAM_STR);
        $this->pdostatement->bindValue(':buinessAdd',$Projet5_infosuser->getWorkAdd(),PDO::PARAM_STR);
        //execution de la requête
        $executeIsOk=$this->pdostatement->execute();

        if (!$executeIsOk){
            return false;
        }
        else{
            $id=$this->pdo->lastInsertId();
            $Projet5_infosuser= $this->read($id);
            return true;


        }



    }

    /*public function  readAll(){
        $this->pdostatement= $this->pdo->query('SELECT * FROM Projet5_infosuser ORDER BY nom, prenom');
        //construction tableau d'objet de type Projet5_infosuser
        $Projet5_infosusers = [];
        while ($Projet5_infosuser= $this->pdostatement->fetchObject('App\Entity\Projet5_infosuser')){
            $Projet5_infosusers[]= $Projet5_infosuser;
        }
        return $Projet5_infosusers;
    }*/

    /**
     * récupère un objet Projet5_infosuser à partir de son identifiant
     * @param int $id identifiant d'un Projet5_infosuser
     *
     * @return bool|Projet5_infosuser|Null false si une erreur survient, un objet si un correspondance est trouvée,
     * Null s'il n'y aucune correspondance
     */

    /*public function read($userId){
        $this->pdostatement= $this->pdo->prepare('SELECT * FROM Projet5_infosuser WHERE user_id= :userId');
        //liaison paramètres
        $this->pdostatement->bindValue(':userId',$userId,PDO::PARAM_INT);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        $infos = [];
        while ($info= $this->pdostatement->fetchObject("App\Model\Projet5_infosuser")){
            $infos[]= $info;
        }

        return $infos;
    }*/








}