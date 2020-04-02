<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseModelMetadata
 *
 * @ORM\Table(name="claire_exercise_model_metadata", indexes={@ORM\Index(name="IDX_1FCD0C517F19170F", columns={"exercise_model_id"})})
 * @ORM\Entity
 */
class ClaireExerciseModelMetadata
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
     * @var \ClaireExerciseModel
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ClaireExerciseModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exercise_model_id", referencedColumnName="id")
     * })
     */
    private $exerciseModel;

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

    public function getExerciseModel(): ?ClaireExerciseModel
    {
        return $this->exerciseModel;
    }

    public function setExerciseModel(?ClaireExerciseModel $exerciseModel): self
    {
        $this->exerciseModel = $exerciseModel;

        return $this;
    }


}
