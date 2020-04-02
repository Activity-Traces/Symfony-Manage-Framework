<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatView
 *
 * @ORM\Table(name="stat_view", indexes={@ORM\Index(name="IDX_DFB550DA2C94069F", columns={"directory_id"})})
 * @ORM\Entity
 */
class StatView
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
     * @ORM\Column(name="name", type="string", length=70, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refPedagogic", type="string", length=70, nullable=true)
     */
    private $refpedagogic;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=false)
     */
    private $enddate;

    /**
     * @var \Directory
     *
     * @ORM\ManyToOne(targetEntity="Directory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="directory_id", referencedColumnName="id")
     * })
     */
    private $directory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRefpedagogic(): ?string
    {
        return $this->refpedagogic;
    }

    public function setRefpedagogic(?string $refpedagogic): self
    {
        $this->refpedagogic = $refpedagogic;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getDirectory(): ?Directory
    {
        return $this->directory;
    }

    public function setDirectory(?Directory $directory): self
    {
        $this->directory = $directory;

        return $this;
    }


}
