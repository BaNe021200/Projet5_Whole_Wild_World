<?php
/**
 * Created by PhpStorm.
 * User: connector
 * Date: 05/04/2018
 * Time: 16:17
 */

namespace App\Model;


class Projet5_mails
{
    /**
     * @var int $id
     */
    private $id;


    /**
     * @var int $expeditor  expéditeur
     */
    private $expeditor;


    /**
     * @var int $receiver  destinataire
     */
    private $receiver;


    /**
     * @var string $title
     */
    private $title;


    /**
     * @var string $message
     */
    private $message;


    /**
     * @var datetime $time
     */
    private $time;


    /**
     * @var tinyint $mp_read
     */
    private $mp_read;

    /**
     * @param int $expeditor
     * @return Projet5_mails
     */
    public function setExpeditor(int $expeditor): Projet5_mails
    {
        $this->expeditor = $expeditor;
        return $this;
    }

    /**
     * @param int $receiver
     * @return Projet5_mails
     */
    public function setReceiver(int $receiver): Projet5_mails
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @param string $title
     * @return Projet5_mails
     */
    public function setTitle(string $title): Projet5_mails
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $message
     * @return Projet5_mails
     */
    public function setMessage(string $message): Projet5_mails
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param datetime $time
     * @return Projet5_mails
     */
    public function setTime(datetime $time): Projet5_mails
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @param tinyint $mp_read
     * @return Projet5_mails
     */
    public function setMpRead(tinyint $mp_read): Projet5_mails
    {
        $this->mp_read = $mp_read;
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
    public function getExpeditor(): int
    {
        return $this->expeditor;
    }

    /**
     * @return int
     */
    public function getReceiver(): int
    {
        return $this->receiver;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return datetime
     */
    public function getTime(): datetime
    {
        return $this->time;
    }

    /**
     * @return tinyint
     */
    public function getMpRead(): tinyint
    {
        return $this->mp_read;
    }



}