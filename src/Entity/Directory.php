<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
* Directory
*

* @ORM\Table(name="directory", indexes={@ORM\Index(name="IDX_467844DA727ACA70", columns={"parent_id"}), @ORM\Index(name="IDX_467844DA7E3C61F9", columns={"owner_id"})})
* @ORM\Entity(repositoryClass="App\Repository\DirectoryRepository")
*/
class Directory
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var bool
     *
     * @ORM\Column(name="isVisible", type="boolean", nullable=false)
     */
    private $isvisible;

    /**
     * @var \Directory
     *
     * @ORM\ManyToOne(targetEntity="Directory")
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseModel", inversedBy="directory")
     * @ORM\JoinTable(name="directories_models",
     *   joinColumns={
     *     @ORM\JoinColumn(name="directory_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     *   }
     * )
     */
    private $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getIsvisible(): ?bool
    {
        return $this->isvisible;
    }

    public function setIsvisible(bool $isvisible): self
    {
        $this->isvisible = $isvisible;

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
        }

        return $this;
    }

    public function removeModel(ClaireExerciseModel $model): self
    {
        if ($this->model->contains($model)) {
            $this->model->removeElement($model);
        }

        return $this;
    }

}
