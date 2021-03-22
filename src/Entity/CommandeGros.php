<?php

namespace App\Entity;

use App\Repository\CommandeGrosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeGrosRepository::class)
 */
class CommandeGros
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
     */
    private $ref;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $mondat;

    /**
     * @ORM\Column(type="integer")
     */
    private $restePayer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomProp;

    /**
     * @ORM\Column(type="integer")
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime")
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    public function __construct(){
        $this->dateCreation=new \DateTime();
        $this->numColis=null;
        $this->restePayer=$this->getMontantTotal() - $this->getMondat();
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

    public function getMontantTotal(): ?int
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(int $montantTotal): self
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getMondat(): ?int
    {
        return $this->mondat;
    }

    public function setMondat(int $mondat): self
    {
        $this->mondat = $mondat;

        return $this;
    }

    public function getRestePayer(): ?int
    {
        return $this->restePayer;
    }

    public function setRestePayer(int $restePayer): self
    {
        $this->restePayer = $restePayer;

        return $this;
    }

    public function getNomProp(): ?string
    {
        return $this->nomProp;
    }

    public function setNomProp(string $nomProp): self
    {
        $this->nomProp = $nomProp;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
