<?php

namespace App\Entity;

use App\Repository\TagTableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagTableRepository::class)
 */
class TagTable
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
     * @ORM\ManyToMany(targetEntity=ArticleTable::class, mappedBy="tags")
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
     * @return Collection|ArticleTable[]
     */
    public function getArticleTables(): Collection
    {
        return $this->articleTables;
    }

    public function addArticleTable(ArticleTable $articleTable): self
    {
        if (!$this->articleTables->contains($articleTable)) {
            $this->articleTables[] = $articleTable;
            $articleTable->addTag($this);
        }

        return $this;
    }

    public function removeArticleTable(ArticleTable $articleTable): self
    {
        if ($this->articleTables->removeElement($articleTable)) {
            $articleTable->removeTag($this);
        }

        return $this;
    }
}
