<?php
namespace App\Entity;

Trait TimeStamps
{
    /**
     * @ORM\Column (type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column (type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist()
     */
    public function createdAt(){
        $this->createdAt= new \DateTime();
        $this->updatedAt=new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function updatedAt(){
        $this->updatedAt=new \DateTime();
    }

    public function getCreatedAt(){
        return $this->updatedAt;
    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }
}