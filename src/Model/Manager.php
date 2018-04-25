<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 03/04/2018
 * Time: 17:11
 */

namespace App\Model;


use PDO;
class Manager
{
    protected $table;

    /**
     * @var \PDO $pdo objet PDO lié à la base de donnée
     */
    protected $pdo;

    /**
     * @var \PDOStatement $pdostatement objet PDOStatement résultant des méthode PDO::QUERY
    et PDO::PREPARE */

    protected $pdostatement;

    /**
     * ContactManager constructor.
     * initialisation de la connexion à la base de donnée
     */
    public function __construct($table)
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=twig','root','nzB69yCSBDz9eK46',array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        $this->table = $table;
    }











    /**
     * @param $item exemple  valeur de l'item $_Post['username']
     * @param $Queryitem  nom de la colone dans la table exemple "username"
     * @return bool|mixed|null
     *
     */


    public function readQItemUser($item,$Queryitem){

        $this->pdostatement= $this->pdo->prepare('SELECT '.$Queryitem.' FROM '.$this->table.' WHERE '.$Queryitem.' = :item');
        //liaison paramètres
        $this->pdostatement->bindValue(':item',$item,PDO::PARAM_STR);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $user = $this->pdostatement->fetchObject('App\Model\\'.ucfirst($this->table).'');
            if($user===false){
                return null;

            }
            else{
                return $user;

            }
        }else{
            return false;
        }


    }

    public function readUser($item,$Queryitem){





        $this->pdostatement= $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE '.$Queryitem.' = :item');
        //liaison paramètres
        $this->pdostatement->bindValue(':item',$item,PDO::PARAM_STR);
        //Execution de la requête
        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $user = $this->pdostatement->fetchObject('App\Model\\'.ucfirst($this->table).'');
            if($user===false){
                return null;

            }
            else{
                return $user;var_dump($user);

            }
        }else{
            return false;
        }


    }

    public function readUsers($item,$Queryitem)
    {
        $this->pdostatement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $Queryitem . ' = :item');
        //liaison paramètres
        $this->pdostatement->bindValue(':item', $item, PDO::PARAM_STR);
        //Execution de la requête
        $executeIsOk = $this->pdostatement->execute();
        $items = [];
        while ($item = $this->pdostatement->fetchObject('App\Model\\' . ucfirst($this->table) . '')) {
            $items[] = $item;
        }

        return $items;

    }

    public function readAll()
    {
        $this->pdostatement=$this->pdo->query('SELECT * FROM '.$this->table.' LIMIT 0,6 ');
        $profils=[];
        while ($profil=$this->pdostatement->fetchObject('App\Model\\'.ucfirst($this->table).'')){
            $profils[]=$profil;

        }

        return $profils;


    }

    public function read($id)
    {
        $this->pdostatement=$this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE id=:id ');
        $this->pdostatement->bindValue(':id',$id,PDO::PARAM_INT);

        $executeIsOk= $this->pdostatement->execute();
        if($executeIsOk){
            $user = $this->pdostatement->fetchObject('App\Model\\'.ucfirst($this->table).'');
            if($user===false){
                return null;
            }
            else{
                return $user;
            }
        }else{
            return false;
        }





    }

    public function deleteItem($item,$col)
    {
        $this->pdostatement=$this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' .$col. '= :item ');
        $this->pdostatement->bindValue(':item',$item, PDO::PARAM_INT);
        //execution de la requête
        return $this->pdostatement->execute();
    }





}
