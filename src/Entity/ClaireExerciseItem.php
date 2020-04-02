<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseItem
 *
 * @ORM\Table(name="claire_exercise_item", indexes={@ORM\Index(name="IDX_F5D1234E934951A", columns={"exercise_id"})})
 * @ORM\Entity
 */
class ClaireExerciseItem
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
     * @ORM\Column(name="content", type="text", length=0, nullable=false)
     */
    private $content;

    /**
     * @var \ClaireExerciseStoredExercise
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseStoredExercise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     * })
     */
    private $exercise;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getExercise(): ?ClaireExerciseStoredExercise
    {
        return $this->exercise;
    }

    public function setExercise(?ClaireExerciseStoredExercise $exercise): self
    {
        $this->exercise = $exercise;

        return $this;
    }


}
