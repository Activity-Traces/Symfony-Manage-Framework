<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log", indexes={@ORM\Index(name="IDX_8F3F68C5A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Log
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
     * @ORM\Column(name="loggedAt", type="datetime", nullable=false)
     */
    private $loggedat;

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

    public function getLoggedat(): ?\DateTimeInterface
    {
        return $this->loggedat;
    }

    public function setLoggedat(\DateTimeInterface $loggedat): self
    {
        $this->loggedat = $loggedat;

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
