<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseKnowledge
 *
 * @ORM\Table(name="claire_exercise_knowledge", indexes={@ORM\Index(name="IDX_465F3A833AB8C0BA", columns={"fork_from_id"}), @ORM\Index(name="IDX_465F3A837E3C61F9", columns={"owner_id"}), @ORM\Index(name="IDX_465F3A83727ACA70", columns={"parent_id"}), @ORM\Index(name="IDX_465F3A83F675F31B", columns={"author_id"})})
 * @ORM\Entity
 */
class ClaireExerciseKnowledge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=true)
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="draft", type="boolean", nullable=false)
     */
    private $draft;

    /**
     * @var bool
     *
     * @ORM\Column(name="complete", type="boolean", nullable=false)
     */
    private $complete;

    /**
     * @var string|null
     *
     * @ORM\Column(name="complete_error", type="string", length=255, nullable=true)
     */
    private $completeError;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="public", type="boolean", nullable=true)
     */
    private $public;

    /**
     * @var bool
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    private $archived;

    /**
     * @var \ClaireExerciseKnowledge
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseKnowledge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fork_from_id", referencedColumnName="id")
     * })
     */
    private $forkFrom;

    /**
     * @var \ClaireExerciseKnowledge
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseKnowledge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \AskerUser
     *
     * @ORM\ManyToOne(targetEntity="AskerUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     * })
     */
    private $owner;

    /**
     * @var \AskerUser
     *
     * @ORM\ManyToOne(targetEntity="AskerUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseKnowledge", mappedBy="required")
     */
    private $knowledge;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseModel", mappedBy="requiredKnowledge")
     */
    private $model;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseResource", mappedBy="requiredKnowledge")
     */
    private $resource;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->knowledge = new \Doctrine\Common\Collections\ArrayCollection();
        $this->model = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resource = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }

    public function getComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): self
    {
        $this->complete = $complete;

        return $this;
    }

    public function getCompleteError(): ?string
    {
        return $this->completeError;
    }

    public function setCompleteError(?string $completeError): self
    {
        $this->completeError = $completeError;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(?bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getForkFrom(): ?self
    {
        return $this->forkFrom;
    }

    public function setForkFrom(?self $forkFrom): self
    {
        $this->forkFrom = $forkFrom;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getOwner(): ?AskerUser
    {
        return $this->owner;
    }

    public function setOwner(?AskerUser $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getAuthor(): ?AskerUser
    {
        return $this->author;
    }

    public function setAuthor(?AskerUser $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseKnowledge[]
     */
    public function getKnowledge(): Collection
    {
        return $this->knowledge;
    }

    public function addKnowledge(ClaireExerciseKnowledge $knowledge): self
    {
        if (!$this->knowledge->contains($knowledge)) {
            $this->knowledge[] = $knowledge;
            $knowledge->addRequired($this);
        }

        return $this;
    }

    public function removeKnowledge(ClaireExerciseKnowledge $knowledge): self
    {
        if ($this->knowledge->contains($knowledge)) {
            $this->knowledge->removeElement($knowledge);
            $knowledge->removeRequired($this);
        }

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseModel[]
     */
    public function getModel(): Collection
    {
        return $this->model;
    }

    public function addModel(ClaireExerciseModel $model): self
    {
        if (!$this->model->contains($model)) {
            $this->model[] = $model;
            $model->addRequiredKnowledge($this);
        }

        return $this;
    }

    public function removeModel(ClaireExerciseModel $model): self
    {
        if ($this->model->contains($model)) {
            $this->model->removeElement($model);
            $model->removeRequiredKnowledge($this);
        }

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseResource[]
     */
    public function getResource(): Collection
    {
        return $this->resource;
    }

    public function addResource(ClaireExerciseResource $resource): self
    {
        if (!$this->resource->contains($resource)) {
            $this->resource[] = $resource;
            $resource->addRequiredKnowledge($this);
        }

        return $this;
    }

    public function removeResource(ClaireExerciseResource $resource): self
    {
        if ($this->resource->contains($resource)) {
            $this->resource->removeElement($resource);
            $resource->removeRequiredKnowledge($this);
        }

        return $this;
    }

}
