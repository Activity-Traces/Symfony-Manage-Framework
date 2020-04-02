<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 *  @UniqueEntity( fields= {"nom"}, message="Cette competence existe deja")
 * @ORM\Table(name="competence", indexes={@ORM\Index(name="index_competence_name", columns={"nom"})})
 */
class Competence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauCompetence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauResponsabilite;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $isshared;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Referentiel", inversedBy="competences")
     */
    private $mareference;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Referentiel")
     */

    private $user;


      /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClaireExerciseModel", inversedBy="competence")
     */
    private $modelesExercices;


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function getIsshared(): ?bool
    {
        return $this->isshared;
    }

    public function setIsshared(bool $isshared): self
    {
        $this->isshared = $isshared;

        return $this;
    }
    
    public function __construct()
    {
        $this->mareference = new ArrayCollection();
        $this->modelesExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }



    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    
    public function getNiveauCompetence(): ?string
    {
        return $this->niveauCompetence;
    }

    public function setNiveauCompetence(string $niveauCompetence): self
    {
        $this->niveauCompetence = $niveauCompetence;

        return $this;
    }

    public function getNiveauResponsabilite(): ?string
    {
        return $this->niveauResponsabilite;
    }

    public function setNiveauResponsabilite(string $niveauResponsabilite): self
    {
        $this->niveauResponsabilite = $niveauResponsabilite;

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getMareference(): Collection
    {
        return $this->mareference;
    }

    public function addMareference(Referentiel $mareference): self
    {
        if (!$this->mareference->contains($mareference)) {
            $this->mareference[] = $mareference;
        }

        return $this;
    }

    public function removeMareference(Referentiel $mareference): self
    {
        if ($this->mareference->contains($mareference)) {
            $this->mareference->removeElement($mareference);
        }

        return $this;
    }


    /**
     * @return Collection|ClaireExerciseModel[]
     */
    public function getModelesExercices(): Collection
    {
        return $this->modelesExercices;
    }

    public function addModelesExercice(ClaireExerciseModel $modelesExercices): self
    {
        if (!$this->modelesExercices->contains($modelesExercices)) {
            $this->modelesExercices[] = $modelesExercices;
        }

        return $this;
    }

    public function removeModelesExercice(ClaireExerciseModel $modelesExercices): self
    {
        if ($this->modelesExercices->contains($modelesExercices)) {
            $this->modelesExercices->removeElement($modelesExercices);
        }

        return $this;
    }
}
