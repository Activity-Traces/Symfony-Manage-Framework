<?php

namespace App\Entity;

use App\Entity\Competence;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ClaireExerciseModel
 *
 * @ORM\Table(name="claire_exercise_model", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_C3EFD381BAD783F", columns={"resource_node_id"})}, indexes={@ORM\Index(name="IDX_C3EFD38727ACA70", columns={"parent_id"}), @ORM\Index(name="IDX_C3EFD38F675F31B", columns={"author_id"}), @ORM\Index(name="IDX_C3EFD383AB8C0BA", columns={"fork_from_id"}), @ORM\Index(name="IDX_C3EFD387E3C61F9", columns={"owner_id"})})
 * @ORM\Entity
 */


/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseModelRepository")
 */

class ClaireExerciseModel
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
     * @var bool|null
     *
     * @ORM\Column(name="archived", type="boolean", nullable=true)
     */
    private $archived;

    /**
     * @var \ResourceNode
     *
     * @ORM\ManyToOne(targetEntity="ResourceNode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_node_id", referencedColumnName="id")
     * })
     */
    private $resourceNode;

    /**
     * @var \ClaireExerciseModel
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fork_from_id", referencedColumnName="id")
     * })
     */
    private $forkFrom;

    /**
     * @var \ClaireExerciseModel
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseModel")
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
     * @ORM\ManyToMany(targetEntity="ClaireExerciseKnowledge", inversedBy="model")
     * @ORM\JoinTable(name="claire_exercise_model_knowledge_requirement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="model_id", referencedColumnName="id")
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
     * @ORM\ManyToMany(targetEntity="ClaireExerciseResource", inversedBy="model")
     * @ORM\JoinTable(name="claire_exercise_model_resource_requirement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="required_resource_id", referencedColumnName="id")
     *   }
     * )
     */
    private $requiredResource;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseTestModel", mappedBy="exerciseModel")
     */
    private $testModel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Directory", mappedBy="model")
     */
    private $directory;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competence", mappedBy="modelesExercices")
     */
    private $competence;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->requiredKnowledge = new \Doctrine\Common\Collections\ArrayCollection();
        $this->requiredResource = new \Doctrine\Common\Collections\ArrayCollection();
        $this->testModel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directory = new \Doctrine\Common\Collections\ArrayCollection();
        $this->competence = new ArrayCollection();
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

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getResourceNode(): ?ResourceNode
    {
        return $this->resourceNode;
    }

    public function setResourceNode(?ResourceNode $resourceNode): self
    {
        $this->resourceNode = $resourceNode;

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
    public function getRequiredResource(): Collection
    {
        return $this->requiredResource;
    }

    public function addRequiredResource(ClaireExerciseResource $requiredResource): self
    {
        if (!$this->requiredResource->contains($requiredResource)) {
            $this->requiredResource[] = $requiredResource;
        }

        return $this;
    }

    public function removeRequiredResource(ClaireExerciseResource $requiredResource): self
    {
        if ($this->requiredResource->contains($requiredResource)) {
            $this->requiredResource->removeElement($requiredResource);
        }

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseTestModel[]
     */
    public function getTestModel(): Collection
    {
        return $this->testModel;
    }

    public function addTestModel(ClaireExerciseTestModel $testModel): self
    {
        if (!$this->testModel->contains($testModel)) {
            $this->testModel[] = $testModel;
            $testModel->addExerciseModel($this);
        }

        return $this;
    }

    public function removeTestModel(ClaireExerciseTestModel $testModel): self
    {
        if ($this->testModel->contains($testModel)) {
            $this->testModel->removeElement($testModel);
            $testModel->removeExerciseModel($this);
        }

        return $this;
    }

    /**
     * @return Collection|Directory[]
     */
    public function getDirectory(): Collection
    {
        return $this->directory;
    }

    public function addDirectory(Directory $directory): self
    {
        if (!$this->directory->contains($directory)) {
            $this->directory[] = $directory;
            $directory->addModel($this);
        }

        return $this;
    }

    public function removeDirectory(Directory $directory): self
    {
        if ($this->directory->contains($directory)) {
            $this->directory->removeElement($directory);
            $directory->removeModel($this);
        }

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addComp(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence[] = $competence;
            $competence->addModelesExercice($this);
        }

        return $this;
    }

    public function removeComp(Competence $competence): self
    {
        if ($this->competence->contains($competence)) {
            $this->competence->removeElement($competence);
            $competence->removeModelesExercice($this);
        }

        return $this;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence[] = $competence;
            $competence->addModelesExercice($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competence->contains($competence)) {
            $this->competence->removeElement($competence);
            $competence->removeModelesExercice($this);
        }

        return $this;
    }

}
