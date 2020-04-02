<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseResource
 *
 * @ORM\Table(name="claire_exercise_resource", indexes={@ORM\Index(name="IDX_E9AEB0BEF675F31B", columns={"author_id"}), @ORM\Index(name="IDX_E9AEB0BE727ACA70", columns={"parent_id"}), @ORM\Index(name="IDX_E9AEB0BE3AB8C0BA", columns={"fork_from_id"}), @ORM\Index(name="IDX_E9AEB0BE7E3C61F9", columns={"owner_id"})})
 * @ORM\Entity
 */
class ClaireExerciseResource
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
     * @var bool
     *
     * @ORM\Column(name="public", type="boolean", nullable=false)
     */
    private $public;

    /**
     * @var bool
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    private $archived;

    /**
     * @var \ClaireExerciseResource
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseResource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fork_from_id", referencedColumnName="id")
     * })
     */
    private $forkFrom;

    /**
     * @var \ClaireExerciseResource
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseResource")
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
     * @ORM\ManyToMany(targetEntity="ClaireExerciseModel", mappedBy="requiredResource")
     */
    private $model;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseKnowledge", inversedBy="resource")
     * @ORM\JoinTable(name="claire_exercise_resource_knowledge_requirement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="required_knowledge_id", referencedColumnName="id")
     *   }
     * )
     */
    private $requiredKnowledge;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseResource", inversedBy="resource")
     * @ORM\JoinTable(name="claire_exercise_resource_resource_requirement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="required_id", referencedColumnName="id")
     *   }
     * )
     */
    private $required;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new \Doctrine\Common\Collections\ArrayCollection();
        $this->requiredKnowledge = new \Doctrine\Common\Collections\ArrayCollection();
        $this->required = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setPublic(bool $public): self
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
            $model->addRequiredResource($this);
        }

        return $this;
    }

    public function removeModel(ClaireExerciseModel $model): self
    {
        if ($this->model->contains($model)) {
            $this->model->removeElement($model);
            $model->removeRequiredResource($this);
        }

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseKnowledge[]
     */
    public function getRequiredKnowledge(): Collection
    {
        return $this->requiredKnowledge;
    }

    public function addRequiredKnowledge(ClaireExerciseKnowledge $requiredKnowledge): self
    {
        if (!$this->requiredKnowledge->contains($requiredKnowledge)) {
            $this->requiredKnowledge[] = $requiredKnowledge;
        }

        return $this;
    }

    public function removeRequiredKnowledge(ClaireExerciseKnowledge $requiredKnowledge): self
    {
        if ($this->requiredKnowledge->contains($requiredKnowledge)) {
            $this->requiredKnowledge->removeElement($requiredKnowledge);
        }

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseResource[]
     */
    public function getRequired(): Collection
    {
        return $this->required;
    }

    public function addRequired(ClaireExerciseResource $required): self
    {
        if (!$this->required->contains($required)) {
            $this->required[] = $required;
        }

        return $this;
    }

    public function removeRequired(ClaireExerciseResource $required): self
    {
        if ($this->required->contains($required)) {
            $this->required->removeElement($required);
        }

        return $this;
    }

}
