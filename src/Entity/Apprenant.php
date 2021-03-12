<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */
class Apprenant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="bigint")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $portfolio;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $git;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $cv;

    /**
     * 
     * @ORM\Column(type="datetime")
     * 
     */
    private $promo_anne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $promo_ville;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $competences;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $mobilit = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zone_geographique;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="apprenant", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Users;

    /**
     * @ORM\OneToMany(targetEntity=Candidature::class, mappedBy="apprenant")
     */
    private $candidature;

    /**
     * @ORM\ManyToMany(targetEntity=AnnonceEntreprise::class, inversedBy="apprenants")
     */
    private $annoce_entreprise;

    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $speudogithub;

    /**
     * @ORM\ManyToMany(targetEntity=Entreprise::class, inversedBy="apprenants")
     */
    private $entreprise;

    public function __construct()
    {
        // $this->candidature = new ArrayCollection();
        $this->annoce_entreprise = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
        $this->entreprise = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId().'-'.$this->getNom().' '.$this->getPrenom();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
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

    public function getPortfolio(): ?string
    {
        return $this->portfolio;
    }

    public function setPortfolio(string $portfolio): self
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getGit(): ?string
    {
        return $this->git;
    }

    public function setGit(string $git): self
    {
        $this->git = $git;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getPromoAnne(): ?\DateTimeInterface
    {
        return $this->promo_anne;
    }

    public function setPromoAnne(\DateTimeInterface $promo_anne): self
    {
        $this->promo_anne = $promo_anne;

        return $this;
    }

    public function getPromoVille(): ?string
    {
        return $this->promo_ville;
    }

    public function setPromoVille(string $promo_ville): self
    {
        $this->promo_ville = $promo_ville;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    public function setCompetences(string $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getMobilit(): ?bool
    {
        return $this->mobilit;
    }

    public function setMobilit(bool $mobilit): self
    {
        $this->mobilit = $mobilit;

        return $this;
    }

    public function getZoneGeographique(): ?string
    {
        return $this->zone_geographique;
    }

    public function setZoneGeographique(string $zone_geographique): self
    {
        $this->zone_geographique = $zone_geographique;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->Users;
    }

    public function setUsers(User $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    
    public function getCandidature(): ?Candidature
    {
        
        return $this->candidature;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidature->contains($candidature)) {
            $this->candidature[] = $candidature;
            $candidature->setApprenant($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidature->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getApprenant() === $this) {
                $candidature->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AnnonceEntreprise[]
     */
    public function getAnnoceEntreprise(): Collection
    {
        return $this->annoce_entreprise;
    }

    public function addAnnoceEntreprise(AnnonceEntreprise $annoceEntreprise): self
    {
        if (!$this->annoce_entreprise->contains($annoceEntreprise)) {
            $this->annoce_entreprise[] = $annoceEntreprise;
        }

        return $this;
    }

    public function removeAnnoceEntreprise(AnnonceEntreprise $annoceEntreprise): self
    {
        $this->annoce_entreprise->removeElement($annoceEntreprise);

        return $this;
    }

   

    public function getSpeudogithub(): ?string
    {
        return $this->speudogithub;
    }

    public function setSpeudogithub(?string $speudogithub): self
    {
        $this->speudogithub = $speudogithub;

        return $this;
    }

    /**
     * @return Collection|Entreprise[]
     */
    public function getEntreprise(): Collection
    {
        return $this->entreprise;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprise->contains($entreprise)) {
            $this->entreprise[] = $entreprise;
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        $this->entreprise->removeElement($entreprise);

        return $this;
    }
}
