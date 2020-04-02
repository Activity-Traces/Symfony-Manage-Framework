<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pedagogic
 *
 * @ORM\Table(name="pedagogic", uniqueConstraints={@ORM\UniqueConstraint(name="search_idx_code_year_period", columns={"code", "year", "period"})})
 * @ORM\Entity
 */
class Pedagogic
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
     * @ORM\Column(name="code", type="string", length=20, nullable=false)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="longName", type="string", length=100, nullable=false)
     */
    private $longname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="period", type="string", length=50, nullable=true)
     */
    private $period;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AskerUser", mappedBy="pedagogic")
     */
    private $askerUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->askerUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getLongname(): ?string
    {
        return $this->longname;
    }

    public function setLongname(string $longname): self
    {
        $this->longname = $longname;

        return $this;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(?string $period): self
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return Collection|AskerUser[]
     */
    public function getAskerUser(): Collection
    {
        return $this->askerUser;
    }

    public function addAskerUser(AskerUser $askerUser): self
    {
        if (!$this->askerUser->contains($askerUser)) {
            $this->askerUser[] = $askerUser;
            $askerUser->addPedagogic($this);
        }

        return $this;
    }

    public function removeAskerUser(AskerUser $askerUser): self
    {
        if ($this->askerUser->contains($askerUser)) {
            $this->askerUser->removeElement($askerUser);
            $askerUser->removePedagogic($this);
        }

        return $this;
    }

}
