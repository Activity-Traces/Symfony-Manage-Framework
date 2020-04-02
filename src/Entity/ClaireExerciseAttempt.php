<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseAttempt
 *
 * @ORM\Table(name="claire_exercise_attempt", indexes={@ORM\Index(name="IDX_228E85D1A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_228E85D1E934951A", columns={"exercise_id"}), @ORM\Index(name="IDX_228E85D1CAA20852", columns={"test_attempt_id"})})
 * @ORM\Entity
 */
class ClaireExerciseAttempt
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var \AskerUser
     *
     * @ORM\ManyToOne(targetEntity="AskerUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \ClaireExerciseTestAttempt
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseTestAttempt")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_attempt_id", referencedColumnName="id")
     * })
     */
    private $testAttempt;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getUser(): ?AskerUser
    {
        return $this->user;
    }

    public function setUser(?AskerUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTestAttempt(): ?ClaireExerciseTestAttempt
    {
        return $this->testAttempt;
    }

    public function setTestAttempt(?ClaireExerciseTestAttempt $testAttempt): self
    {
        $this->testAttempt = $testAttempt;

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
