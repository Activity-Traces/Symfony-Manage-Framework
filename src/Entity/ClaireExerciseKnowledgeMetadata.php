<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseKnowledgeMetadata
 *
 * @ORM\Table(name="claire_exercise_knowledge_metadata", indexes={@ORM\Index(name="IDX_269D7264E7DC6902", columns={"knowledge_id"})})
 * @ORM\Entity
 */
class ClaireExerciseKnowledgeMetadata
{
    /**
     * @var string
     *
     * @ORM\Column(name="meta_key", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $metaKey;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_value", type="string", length=255, nullable=false)
     */
    private $metaValue;

    /**
     * @var \ClaireExerciseKnowledge
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ClaireExerciseKnowledge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="knowledge_id", referencedColumnName="id")
     * })
     */
    private $knowledge;

    public function getMetaKey(): ?string
    {
        return $this->metaKey;
    }

    public function getMetaValue(): ?string
    {
        return $this->metaValue;
    }

    public function setMetaValue(string $metaValue): self
    {
        $this->metaValue = $metaValue;

        return $this;
    }

    public function getKnowledge(): ?ClaireExerciseKnowledge
    {
        return $this->knowledge;
    }

    public function setKnowledge(?ClaireExerciseKnowledge $knowledge): self
    {
        $this->knowledge = $knowledge;

        return $this;
    }


}
