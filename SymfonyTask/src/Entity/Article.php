<?php

namespace App\Entity;

use App\Repository\ArticleTableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleTableRepository::class)
 */
class ArticleTable
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryTable::class, inversedBy="articleTables")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=TagTable::class, inversedBy="articleTables")
     */
    private $tags;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=UserTable::class, inversedBy="articleTables")
     */
    private $added_by;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $views;

    /**
     * @ORM\OneToMany(targetEntity=CommentTable::class, mappedBy="article")
     */
    private $commentTables;

    public function __construct()
    {
        $created_at=new \DateTime();
        $this->tags = new ArrayCollection();
        $this->commentTables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {

        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?CategoryTable
    {
        return $this->category;
    }

    public function setCategory(?CategoryTable $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|TagTable[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(TagTable $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(TagTable $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getAddedBy(): ?UserTable
    {
        return $this->added_by;
    }

    public function setAddedBy(?UserTable $added_by): self
    {
        $this->added_by = $added_by;

        return $this;
    }

    public function getViews(): ?string
    {
        return $this->views;
    }

    public function setViews(string $views): self
    {
        $this->views = $views;

        return $this;
    }

    /**
     * @return Collection|CommentTable[]
     */
    public function getCommentTables(): Collection
    {
        return $this->commentTables;
    }

    public function addCommentTable(CommentTable $commentTable): self
    {
        if (!$this->commentTables->contains($commentTable)) {
            $this->commentTables[] = $commentTable;
            $commentTable->setArticle($this);
        }

        return $this;
    }

    public function removeCommentTable(CommentTable $commentTable): self
    {
        if ($this->commentTables->removeElement($commentTable)) {
            // set the owning side to null (unless already changed)
            if ($commentTable->getArticle() === $this) {
                $commentTable->setArticle(null);
            }
        }

        return $this;
    }
}
