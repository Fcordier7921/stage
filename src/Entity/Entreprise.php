<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
     */
    private $site_net;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="entreprise", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Candidature::class, mappedBy="entreprise")
     */
    private $candidature;

    /**
     * @ORM\OneToMany(targetEntity=AnnonceEntreprise::class, mappedBy="entreprise")
     */
    private $annoce_entreprise;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="entreprise")
     */
    private $contact;

    public function __construct()
    {
        $this->candidature = new ArrayCollection();
        $this->annoce_entreprise = new ArrayCollection();
        $this->contact = new ArrayCollection();
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

    public function getSiteNet(): ?string
    {
        return $this->site_net;
    }

    public function setSiteNet(string $site_net): self
    {
        $this->site_net = $site_net;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidature(): Collection
    {
        return $this->candidature;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidature->contains($candidature)) {
            $this->candidature[] = $candidature;
            $candidature->setEntreprise($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidature->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getEntreprise() === $this) {
                $candidature->setEntreprise(null);
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
            $annoceEntreprise->setEntreprise($this);
        }

        return $this;
    }

    public function removeAnnoceEntreprise(AnnonceEntreprise $annoceEntreprise): self
    {
        if ($this->annoce_entreprise->removeElement($annoceEntreprise)) {
            // set the owning side to null (unless already changed)
            if ($annoceEntreprise->getEntreprise() === $this) {
                $annoceEntreprise->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
            $contact->setEntreprise($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getEntreprise() === $this) {
                $contact->setEntreprise(null);
            }
        }

        return $this;
    }
}
