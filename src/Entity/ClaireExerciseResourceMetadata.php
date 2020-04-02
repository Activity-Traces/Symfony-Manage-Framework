<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClaireExerciseResourceMetadata
 *
 * @ORM\Table(name="claire_exercise_resource_metadata", indexes={@ORM\Index(name="IDX_115B5EA589329D25", columns={"resource_id"})})
 * @ORM\Entity
 */
class ClaireExerciseResourceMetadata
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
     * @var \ClaireExerciseResource
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ClaireExerciseResource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;

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

    public function getResource(): ?ClaireExerciseResource
    {
        return $this->resource;
    }

    public function setResource(?ClaireExerciseResource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }


}
