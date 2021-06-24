<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="roleTable")
     */
    private $RoleMembers;

    public function __construct()
    {
        $this->RoleMembers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getRoleMembers(): Collection
    {
        return $this->RoleMembers;
    }

    public function addRoleMembers(User $RoleMembers): self
    {
        if (!$this->RoleMembers->contains($RoleMembers)) {
            $this->RoleMembers[] = $RoleMembers;
            $RoleMembers->setRole($this);
        }

        return $this;
    }

    public function removeRoleMembers(User $roleMembers): self
    {
        if ($this->RoleMembers->removeElement($roleMembers)) {
            // set the owning side to null (unless already changed)
            if ($roleMembers->getRole() === $this) {
                $roleMembers->setRole(null);
            }
        }

        return $this;
    }
}
