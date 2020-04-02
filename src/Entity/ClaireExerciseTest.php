<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseTest
 *
 * @ORM\Table(name="claire_exercise_test", indexes={@ORM\Index(name="IDX_C8394926EC16BCB1", columns={"test_model_id"})})
 * @ORM\Entity
 */
class ClaireExerciseTest
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
     * @var \ClaireExerciseTestModel
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseTestModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_model_id", referencedColumnName="id")
     * })
     */
    private $testModel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseStoredExercise", inversedBy="test")
     * @ORM\JoinTable(name="claire_exercise_test_position",
     *   joinColumns={
     *     @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     *   }
     * )
     */
    private $exercise;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exercise = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestModel(): ?ClaireExerciseTestModel
    {
        return $this->testModel;
    }

    public function setTestModel(?ClaireExerciseTestModel $testModel): self
    {
        $this->testModel = $testModel;

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseStoredExercise[]
     */
    public function getExercise(): Collection
    {
        return $this->exercise;
    }

    public function addExercise(ClaireExerciseStoredExercise $exercise): self
    {
        if (!$this->exercise->contains($exercise)) {
            $this->exercise[] = $exercise;
        }

        return $this;
    }

    public function removeExercise(ClaireExerciseStoredExercise $exercise): self
    {
        if ($this->exercise->contains($exercise)) {
            $this->exercise->removeElement($exercise);
        }

        return $this;
    }

}
