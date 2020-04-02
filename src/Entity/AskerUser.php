<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
* AskerUser
*
* @ORM\Entity(repositoryClass="MyBundle\Entity\testRepository")
 */


/** 
 * @ORM\Entity(repositoryClass="App\Repository\AskerUsersRepository")
*/
 
class AskerUser
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
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=70, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=70, nullable=false)
     */
    private $salt;

    /**
     * @var int
     *
     * @ORM\Column(name="ldapEmployeeId", type="integer", nullable=false)
     */
    private $ldapemployeeid;

    /**
     * @var bool
     *
     * @ORM\Column(name="isLdap", type="boolean", nullable=false)
     */
    private $isldap;

    /**
     * @var bool
     *
     * @ORM\Column(name="isEnable", type="boolean", nullable=false)
     */
    private $isenable;

    /**
     * @var string
     *
     * @ORM\Column(name="ldapDn", type="string", length=255, nullable=false)
     */
    private $ldapdn;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pedagogic", inversedBy="askerUser")
     * @ORM\JoinTable(name="asker_user_pedagogic",
     *   joinColumns={
     *     @ORM\JoinColumn(name="asker_user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pedagogic_id", referencedColumnName="id")
     *   }
     * )
     */
    private $pedagogic;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="askerUser")
     * @ORM\JoinTable(name="asker_user_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="asker_user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedagogic = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getLdapemployeeid(): ?int
    {
        return $this->ldapemployeeid;
    }

    public function setLdapemployeeid(int $ldapemployeeid): self
    {
        $this->ldapemployeeid = $ldapemployeeid;

        return $this;
    }

    public function getIsldap(): ?bool
    {
        return $this->isldap;
    }

    public function setIsldap(bool $isldap): self
    {
        $this->isldap = $isldap;

        return $this;
    }

    public function getIsenable(): ?bool
    {
        return $this->isenable;
    }

    public function setIsenable(bool $isenable): self
    {
        $this->isenable = $isenable;

        return $this;
    }

    public function getLdapdn(): ?string
    {
        return $this->ldapdn;
    }

    public function setLdapdn(string $ldapdn): self
    {
        $this->ldapdn = $ldapdn;

        return $this;
    }

    /**
     * @return Collection|Pedagogic[]
     */
    public function getPedagogic(): Collection
    {
        return $this->pedagogic;
    }

    public function addPedagogic(Pedagogic $pedagogic): self
    {
        if (!$this->pedagogic->contains($pedagogic)) {
            $this->pedagogic[] = $pedagogic;
        }

        return $this;
    }

    public function removePedagogic(Pedagogic $pedagogic): self
    {
        if ($this->pedagogic->contains($pedagogic)) {
            $this->pedagogic->removeElement($pedagogic);
        }

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Role $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
        }

        return $this;
    }

}
