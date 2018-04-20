<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 15/02/2018
 * Time: 16:31
 */

namespace App\Model;


class User
{
    /**
     * @var int $id
     */
    private $id;


    /**
     * @var string $gender
     */
    private $gender;


    /**
     * @var string  $first_name
     */
    private $first_name;


    /**
     * @var string $last_name
     */
    private $last_name;


    /**
     * @var string $username
     */
    private $username;


    /**
     * @var date $birthday
     */
    private $birthday;


    /**
     * @var string $email
     */
    private $email;


    /**
     * @var string $password
     */
    private $password;


    /**
     * @var datetime $registry_date
     */
    private $registry_date;


    /**
     * @var string $roles
     */
    private $roles;

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return date
     */
    public function getBirthday(): date
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return datetime
     */
    public function getRegistryDate(): datetime
    {
        return $this->registry_date;
    }

    /**
     * @return string
     */
    public function getRoles(): string
    {
        return $this->roles;
    }



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param date $birthday
     */
    public function setBirthday(date $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param datetime $registry_date
     */
    public function setRegistryDate(datetime $registry_date): void
    {
        $this->registry_date = $registry_date;
    }

    /**
     * @param string $roles
     */
    public function setRoles(string $roles): void
    {
        $this->roles = $roles;
    }



}