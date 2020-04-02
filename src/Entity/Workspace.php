<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workspace
 *
 * @ORM\Table(name="workspace", indexes={@ORM\Index(name="IDX_8D9400197E3C61F9", columns={"owner_id"})})
 * @ORM\Entity
 */
class Workspace
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
     * @ORM\Column(name="isPersonnal", type="boolean", nullable=false)
     */
    private $ispersonnal;

    /**
     * @var \AskerUser
     *
     * @ORM\ManyToOne(targetEntity="AskerUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     * })
     */
    private $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIspersonnal(): ?bool
    {
        return $this->ispersonnal;
    }

    public function setIspersonnal(bool $ispersonnal): self
    {
        $this->ispersonnal = $ispersonnal;

        return $this;
    }

    public function getOwner(): ?AskerUser
    {
        return $this->owner;
    }

    public function setOwner(?AskerUser $owner): self
    {
        $this->owner = $owner;

        return $this;
    }


}
