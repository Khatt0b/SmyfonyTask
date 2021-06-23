<?php

namespace App\Entity;

use App\Repository\UserTableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserTableRepository::class)
 */
class UserTable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pwd;

    /**
     * @ORM\ManyToOne(targetEntity=RoleTable::class, inversedBy="rolename")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roleTable;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTable::class, mappedBy="added_by")
     */
    private $articleTables;

    public function __construct()
    {
        $this->articleTables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getRoleTable(): ?RoleTable
    {
        return $this->roleTable;
    }

    public function setRoleTable(?RoleTable $roleTable): self
    {
        $this->roleTable = $roleTable;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticleTables(): Collection
    {
        return $this->articleTables;
    }

    public function addArticleTable(Article $articleTable): self
    {
        if (!$this->articleTables->contains($articleTable)) {
            $this->articleTables[] = $articleTable;
            $articleTable->setAddedBy($this);
        }

        return $this;
    }

    public function removeArticleTable(Article $articleTable): self
    {
        if ($this->articleTables->removeElement($articleTable)) {
            // set the owning side to null (unless already changed)
            if ($articleTable->getAddedBy() === $this) {
                $articleTable->setAddedBy(null);
            }
        }

        return $this;
    }
}
