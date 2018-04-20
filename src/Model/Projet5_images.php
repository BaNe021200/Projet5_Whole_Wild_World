<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 03/04/2018
 * Time: 16:09
 */

namespace App\Model;


class Projet5_images
{
    /**
     * @var int $id identifiant de l'image
     */
    private $id;


    /**
     * @var int $user_id identifiant de l'utilisateur
     */
    private $user_id ;


    /**
     * @var string $dirname chemin du dossier de l'image
     */
    private $dirname;


    /**
     * @var string $filename  nom de l'image
     */
    private $filename;


    /**
     * @var string $extension  extension de l'image
     */
    private $extension;

    /**
     * @param int $user_id
     * @return Projet5_images
     */
    public function setUserId(int $user_id): Projet5_images
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param string $dirname
     * @return Projet5_images
     */
    public function setDirname(string $dirname): Projet5_images
    {
        $this->dirname = $dirname;
        return $this;
    }

    /**
     * @param string $filename
     * @return Projet5_images
     */
    public function setFilename(string $filename): Projet5_images
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @param string $extension
     * @return Projet5_images
     */
    public function setExtension(string $extension): Projet5_images
    {
        $this->extension = $extension;
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
    public function getDirname(): string
    {
        return $this->dirname;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }









}