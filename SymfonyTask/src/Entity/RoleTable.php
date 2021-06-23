<?php

namespace App\Entity;

use App\Repository\RoleTableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleTableRepository::class)
 */
class RoleTable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=UserTable::class, mappedBy="roleTable")
     */
    private $rolename;

    public function __construct()
    {
        $this->rolename = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|UserTable[]
     */
    public function getRolename(): Collection
    {
        return $this->rolename;
    }

    public function addRolename(UserTable $rolename): self
    {
        if (!$this->rolename->contains($rolename)) {
            $this->rolename[] = $rolename;
            $rolename->setRoleTable($this);
        }

        return $this;
    }

    public function removeRolename(UserTable $rolename): self
    {
        if ($this->rolename->removeElement($rolename)) {
            // set the owning side to null (unless already changed)
            if ($rolename->getRoleTable() === $this) {
                $rolename->setRoleTable(null);
            }
        }

        return $this;
    }
}
