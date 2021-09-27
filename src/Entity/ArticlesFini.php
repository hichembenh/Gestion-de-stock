<?php

namespace App\Entity;

use App\Repository\ArticlesFiniRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticlesFiniRepository::class)
 * @UniqueEntity("ref")
 */
class ArticlesFini
{
    const ETAT=[
        1=>"Mawjoud",
        2=>"le"
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="datetime")
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean",options={"default":false}, nullable=true)
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=CommandeUnitaire::class, mappedBy="famille")
     */
    private $commandeUnitaires;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=ArticleCaract::class, mappedBy="article", orphanRemoval=true)
     */
    private $articleCaracts;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->etat = true;
        $this->commandeUnitaires = new ArrayCollection();
        $this->articleCaracts = new ArrayCollection();
    }

    public function __toString(){
        // Pour afficher la ref de l'article dans la commandeUnitaire
        return $this->ref;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|CommandeUnitaire[]
     */
    public function getCommandeUnitaires(): Collection
    {
        return $this->commandeUnitaires;
    }

    public function addCommandeUnitaire(CommandeUnitaire $commandeUnitaire): self
    {
        if (!$this->commandeUnitaires->contains($commandeUnitaire)) {
            $this->commandeUnitaires[] = $commandeUnitaire;
            $commandeUnitaire->setFamille($this);
        }

        return $this;
    }

    public function removeCommandeUnitaire(CommandeUnitaire $commandeUnitaire): self
    {
        if ($this->commandeUnitaires->removeElement($commandeUnitaire)) {
            // set the owning side to null (unless already changed)
            if ($commandeUnitaire->getFamille() === $this) {
                $commandeUnitaire->setFamille(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


    /**
     * @return Collection|ArticleCaract[]
     */
    public function getArticleCaracts(): Collection
    {
        return $this->articleCaracts;
    }

    public function addArticleCaract(ArticleCaract $articleCaract): self
    {
        if (!$this->articleCaracts->contains($articleCaract)) {
            $this->articleCaracts[] = $articleCaract;
            $articleCaract->setArticle($this);
        }

        return $this;
    }

    public function removeArticleCaract(ArticleCaract $articleCaract): self
    {
        if ($this->articleCaracts->removeElement($articleCaract)) {
            // set the owning side to null (unless already changed)
            if ($articleCaract->getArticle() === $this) {
                $articleCaract->setArticle(null);
            }
        }

        return $this;
    }



}
