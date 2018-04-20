<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 04/04/2018
 * Time: 21:55
 */

namespace App\Model;


class Projet5_thumbnails
{
    /**
     * @var int $id identifiant de la thumbnail
     */
    private $id;


    /**
     * @var int $user_id idenfiant de l'utilisateur
     */
    private $user_id;


    /**
     * @var int $image_id identifiant de l'image
     */
    private $image_id;


    /**
     * @var string $thumbnail chemin de la thumbnail
     */
    private $thumbnail;

    /**
     * @param int $user_id
     * @return Projet5_thumbnails
     */
    public function setUserId(int $user_id): Projet5_thumbnails
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param int $image_id
     * @return Projet5_thumbnails
     */
    public function setImageId(int $image_id): Projet5_thumbnails
    {
        $this->image_id = $image_id;
        return $this;
    }

    /**
     * @param string $thumbnail
     * @return Projet5_thumbnails
     */
    public function setThumbnail(string $thumbnail): Projet5_thumbnails
    {
        $this->thumbnail = $thumbnail;
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
     * @return int
     */
    public function getImageId(): int
    {
        return $this->image_id;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }






}