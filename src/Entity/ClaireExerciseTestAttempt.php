<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseTestAttempt
 *
 * @ORM\Table(name="claire_exercise_test_attempt", indexes={@ORM\Index(name="IDX_783E4D1FA76ED395", columns={"user_id"}), @ORM\Index(name="IDX_783E4D1F1E5D0459", columns={"test_id"})})
 * @ORM\Entity
 */
class ClaireExerciseTestAttempt
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
     * @var \ClaireExerciseTest
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseTest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     * })
     */
    private $test;

    /**
     * @var \AskerUser
     *
     * @ORM\ManyToOne(targetEntity="AskerUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

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

    public function getTest(): ?ClaireExerciseTest
    {
        return $this->test;
    }

    public function setTest(?ClaireExerciseTest $test): self
    {
        $this->test = $test;

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


}
