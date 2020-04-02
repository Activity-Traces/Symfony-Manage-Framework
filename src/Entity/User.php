<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity( fields= {"username"}, message="L'utilisateur existe deja")
* @ORM\Table(name="user", indexes={@ORM\Index(name="index_user_name", columns={"username"})})


*/
class User Implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert/Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    
     private $password;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $isactive;

    /**
     * @ORM\Column(type="integer" )
     * 
     */
    private $askerid;



    public $confirm_password;


    private $roles = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }



    public function getIsactive(): ?bool
    {
        return $this->isactive;
    }

    public function setIsactive(bool $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(){
        
    }

    public function getSalt()
    {
      //  return $this->salt;
    }

    public function setSalt(string $salt): self
    {
       // $this->salt = $salt;

        return $this;
    }
    
    public function getRoles():array
    {
        $myrole = $this->isactive;
        

        // guarantee every user at least has ROLE_USER
        if ($myrole)
             $roles[] = 'ROLE_USER';
        else
            $roles[] = 'ROLE_NOACESS';
        
    
        return array_unique($roles);      
    }



    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }



    function addRole($role) {
        $this->roles[] = $role;
    }


    public function getAskerid(): ?int
    {
        return $this->askerid;
    }

    public function setAskerid(int $askerid): self
    {
        $this->askerid = $askerid;

        return $this;
    }

}