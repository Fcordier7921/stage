<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatureRepository::class)
 */
class Candidature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_candidature;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\JoinColumn(nullable=true)
     */
    private $date_relance;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\JoinColumn(nullable=true)
     */
    private $date_entretient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="candidature")
     * @ORM\JoinColumn(nullable=false)
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="candidature")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCandidature(): ?\DateTimeInterface
    {
        return $this->date_candidature;
    }

    public function setDateCandidature(\DateTimeInterface $date_candidature): self
    {
        $this->date_candidature = $date_candidature;

        return $this;
    }

    public function getDateRelance(): ?\DateTimeInterface
    {
        return $this->date_relance;
    }

    public function setDateRelance(\DateTimeInterface $date_relance): self
    {
        $this->date_relance = $date_relance;

        return $this;
    }

    public function getDateEntretient(): ?\DateTimeInterface
    {
        return $this->date_entretient;
    }

    public function setDateEntretient(\DateTimeInterface $date_entretient): self
    {
        $this->date_entretient = $date_entretient;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
