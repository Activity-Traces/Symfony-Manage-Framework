<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseAnswer
 *
 * @ORM\Table(name="claire_exercise_answer", indexes={@ORM\Index(name="IDX_D0B3344126F525E", columns={"item_id"}), @ORM\Index(name="IDX_D0B3344B191BE6B", columns={"attempt_id"})})
 * @ORM\Entity
 */
class ClaireExerciseAnswer
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
     * @var float|null
     *
     * @ORM\Column(name="mark", type="float", precision=10, scale=0, nullable=true)
     */
    private $mark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \ClaireExerciseItem
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var \ClaireExerciseAttempt
     *
     * @ORM\ManyToOne(targetEntity="ClaireExerciseAttempt")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attempt_id", referencedColumnName="id")
     * })
     */
    private $attempt;

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

    public function getMark(): ?float
    {
        return $this->mark;
    }

    public function setMark(?float $mark): self
    {
        $this->mark = $mark;

        return $this;
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

    public function getItem(): ?ClaireExerciseItem
    {
        return $this->item;
    }

    public function setItem(?ClaireExerciseItem $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getAttempt(): ?ClaireExerciseAttempt
    {
        return $this->attempt;
    }

    public function setAttempt(?ClaireExerciseAttempt $attempt): self
    {
        $this->attempt = $attempt;

        return $this;
    }


}
