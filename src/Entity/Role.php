<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 *
 * */
/*
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="string", length=50, nullable=false)
     */
    private $public;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AskerUser", mappedBy="role")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPublic(): ?string
    {
        return $this->public;
    }

    public function setPublic(string $public): self
    {
        $this->public = $public;

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
            $askerUser->addRole($this);
        }

        return $this;
    }

    public function removeAskerUser(AskerUser $askerUser): self
    {
        if ($this->askerUser->contains($askerUser)) {
            $this->askerUser->removeElement($askerUser);
            $askerUser->removeRole($this);
        }

        return $this;
    }

}
