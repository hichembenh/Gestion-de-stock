<?php

namespace App\Entity;

use App\Repository\CommandeUnitaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CommandeGrosRepository;
use App\Entity\CommandeGros;

/**
 * @ORM\Entity(repositoryClass=CommandeUnitaireRepository::class)
 */
class CommandeUnitaire
{

    const ETAT = [
        0=>'nouvelle',
        1=>'confirmée',
        2=>'envoyée',
        3=>'recu',
        4=>'annulée'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2,max=50)
     */
    private $ref;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex("/^[0-9]{5}/")
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomClient;

    /**
     * @ORM\Column(type="datetime")
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":null})
     */
    private $numColis;

    /**
     * @ORM\Column(type="integer",options={"default":0})
     */
    private $etat;


    public function __construct(){
        $this->dateCreation=new \DateTime();
        $this->numColis=null;
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

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

    public function getNumColis(): ?string
    {
        return $this->numColis;
    }

    public function setNumColis(?string $numColis): self
    {
        $this->numColis = $numColis;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
