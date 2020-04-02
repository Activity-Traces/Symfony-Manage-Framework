<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseTestModel
 *
 * @ORM\Table(name="claire_exercise_test_model", indexes={@ORM\Index(name="IDX_CB243285F675F31B", columns={"author_id"})})
 * @ORM\Entity
 */
class ClaireExerciseTestModel
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

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
     * @ORM\ManyToMany(targetEntity="ClaireExerciseModel", inversedBy="testModel")
     * @ORM\JoinTable(name="claire_exercise_test_model_position",
     *   joinColumns={
     *     @ORM\JoinColumn(name="test_model_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="exercise_model_id", referencedColumnName="id")
     *   }
     * )
     */
    private $exerciseModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exerciseModel = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getExerciseModel(): Collection
    {
        return $this->exerciseModel;
    }

    public function addExerciseModel(ClaireExerciseModel $exerciseModel): self
    {
        if (!$this->exerciseModel->contains($exerciseModel)) {
            $this->exerciseModel[] = $exerciseModel;
        }

        return $this;
    }

    public function removeExerciseModel(ClaireExerciseModel $exerciseModel): self
    {
        if ($this->exerciseModel->contains($exerciseModel)) {
            $this->exerciseModel->removeElement($exerciseModel);
        }

        return $this;
    }

}
