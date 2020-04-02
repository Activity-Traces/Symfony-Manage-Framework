<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseStoredExercise
 *
 * @ORM\Table(name="claire_exercise_stored_exercise", indexes={@ORM\Index(name="IDX_7270807A7F19170F", columns={"exercise_model_id"})})
 * @ORM\Entity
 */


/**
 * @ORM\Entity(repositoryClass="App\Repository\ClaireExerciseStoredExerciseRepository")
 */

class ClaireExerciseStoredExercise
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
     * @ORM\Column(name="content", type="text", length=0, nullable=false)
     */
    private $content;

    /**
     * @var \ClaireExerciseModel
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exercise_model_id", referencedColumnName="id")
     * })
     */
    private $exerciseModel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ClaireExerciseTest", mappedBy="exercise")
     */
    private $test;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->test = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getExerciseModel(): ?ClaireExerciseModel
    {
        return $this->exerciseModel;
    }

    public function setExerciseModel(?ClaireExerciseModel $exerciseModel): self
    {
        $this->exerciseModel = $exerciseModel;

        return $this;
    }

    /**
     * @return Collection|ClaireExerciseTest[]
     */
    public function getTest(): Collection
    {
        return $this->test;
    }

    public function addTest(ClaireExerciseTest $test): self
    {
        if (!$this->test->contains($test)) {
            $this->test[] = $test;
            $test->addExercise($this);
        }

        return $this;
    }

    public function removeTest(ClaireExerciseTest $test): self
    {
        if ($this->test->contains($test)) {
            $this->test->removeElement($test);
            $test->removeExercise($this);
        }

        return $this;
    }

}
