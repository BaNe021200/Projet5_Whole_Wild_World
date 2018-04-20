<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 05/04/2018
 * Time: 14:58
 */

namespace App\Model;


class Projet5_infosuser
{
    /**
     * @var int $id identifiant de l'objet
     */
    private $id;


    /**
     * @var int $user_id idnetifiant de lu'ilisateur
     */
    private $user_id;


    /**
     * @var string $search recherche de l'utilisateur
     *
     */
    private $search;


    /**
     * @var string $postal_code code postal de l'utilisateur
     */
    private $postal_code;


    /**
     * @var string $city ville le l'utilisateur
     */
    private $city;


    /**
     * @var string  $purpose  but de l'inscription de l'user
     */
    private $purpose;


    /**
     * @var string $family_situation
     */
    private $family_situation;


    /**
     * @var string $children
     */
    private $children;


    /**
     * @var
     */
    private $family_situation_add;


    /**
     * @var string $physic_add
     */
    private $physic_add;


    /**
     * @var string $speech
     */
    private $speech;


    /**
     * @var string $school_level
     */
    private $school_level;


    /**
     * @var string $school_level_add
     */
    private $school_level_add;


    /**
     * @var string $work
     */
    private $work;


    /**
     * @var string $work_add
     */
    private $work_add;

    /**
     * @param int $user_id
     * @return Projet5_infosuser
     */
    public function setUserId(int $user_id): Projet5_infosuser
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param string $search
     * @return Projet5_infosuser
     */
    public function setSearch(string $search): Projet5_infosuser
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @param string $postal_code
     * @return Projet5_infosuser
     */
    public function setPostalCode(string $postal_code): Projet5_infosuser
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * @param string $city
     * @return Projet5_infosuser
     */
    public function setCity(string $city): Projet5_infosuser
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $purpose
     * @return Projet5_infosuser
     */
    public function setPurpose(string $purpose): Projet5_infosuser
    {
        $this->purpose = $purpose;
        return $this;
    }

    /**
     * @param string $family_situation
     * @return Projet5_infosuser
     */
    public function setFamilySituation(string $family_situation): Projet5_infosuser
    {
        $this->family_situation = $family_situation;
        return $this;
    }

    /**
     * @param string $children
     * @return Projet5_infosuser
     */
    public function setChildren(string $children): Projet5_infosuser
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @param mixed $family_situation_add
     * @return Projet5_infosuser
     */
    public function setFamilySituationAdd($family_situation_add)
    {
        $this->family_situation_add = $family_situation_add;
        return $this;
    }

    /**
     * @param string $physic_add
     * @return Projet5_infosuser
     */
    public function setPhysicAdd(string $physic_add): Projet5_infosuser
    {
        $this->physic_add = $physic_add;
        return $this;
    }

    /**
     * @param string $speech
     * @return Projet5_infosuser
     */
    public function setSpeech(string $speech): Projet5_infosuser
    {
        $this->speech = $speech;
        return $this;
    }

    /**
     * @param string $school_level
     * @return Projet5_infosuser
     */
    public function setSchoolLevel(string $school_level): Projet5_infosuser
    {
        $this->school_level = $school_level;
        return $this;
    }

    /**
     * @param string $school_level_add
     * @return Projet5_infosuser
     */
    public function setSchoolLevelAdd(string $school_level_add): Projet5_infosuser
    {
        $this->school_level_add = $school_level_add;
        return $this;
    }

    /**
     * @param string $work
     * @return Projet5_infosuser
     */
    public function setWork(string $work): Projet5_infosuser
    {
        $this->work = $work;
        return $this;
    }

    /**
     * @param string $work_add
     * @return Projet5_infosuser
     */
    public function setWorkAdd(string $work_add): Projet5_infosuser
    {
        $this->work_add = $work_add;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    /**
     * @return string
     */
    public function getFamilySituation(): ?string
    {
        return $this->family_situation;
    }

    /**
     * @return string
     */
    public function getChildren(): ?string
    {
        return $this->children;
    }

    /**
     * @return mixed
     */
    public function getFamilySituationAdd()
    {
        return $this->family_situation_add;
    }

    /**
     * @return string
     */
    public function getPhysicAdd(): ?string
    {
        return $this->physic_add;
    }

    /**
     * @return string
     */
    public function getSpeech(): string
    {
        return $this->speech;
    }

    /**
     * @return string
     */
    public function getSchoolLevel(): ?string
    {
        return $this->school_level;
    }

    /**
     * @return string
     */
    public function getSchoolLevelAdd():? string
    {
        return $this->school_level_add;
    }

    /**
     * @return string
     */
    public function getWork(): ?string
    {
        return $this->work;
    }

    /**
     * @return string
     */
    public function getWorkAdd(): ?string
    {
        return $this->work_add;
    }



}