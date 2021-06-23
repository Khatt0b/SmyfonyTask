<?php

namespace App\Entity;

use App\Repository\CategoryTableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryTableRepository::class)
 */
class CategoryTable
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTable::class, mappedBy="category")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $articleTable->setCategory($this);
        }

        return $this;
    }

    public function removeArticleTable(Article $articleTable): self
    {
        if ($this->articleTables->removeElement($articleTable)) {
            // set the owning side to null (unless already changed)
            if ($articleTable->getCategory() === $this) {
                $articleTable->setCategory(null);
            }
        }

        return $this;
    }
}
