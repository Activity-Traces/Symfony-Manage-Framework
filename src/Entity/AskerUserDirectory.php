<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * 
 * AskerUserDirectory
 * @ORM\Entity(repositoryClass="App\Repository\aaaRepository")

 * @ORM\Table(name="asker_user_directory", uniqueConstraints={@ORM\UniqueConstraint(name="search_idx_user_directory", columns={"directory_id", "user_id"})}, indexes={@ORM\Index(name="IDX_168D76D92C94069F", columns={"directory_id"}), @ORM\Index(name="IDX_168D76D9A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */

 class AskerUserDirectory
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
     * @var bool
     *
     * @ORM\Column(name="isManager", type="boolean", nullable=false)
     */
    private $ismanager;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
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

    public function getIsmanager(): ?bool
    {
        return $this->ismanager;
    }

    public function setIsmanager(bool $ismanager): self
    {
        $this->ismanager = $ismanager;

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

    public function setEnddate(?\DateTimeInterface $enddate): self
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
