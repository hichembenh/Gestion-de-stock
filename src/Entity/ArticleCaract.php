<?php

namespace App\Entity;

use App\Repository\ArticleCaractRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleCaractRepository::class)
 */
class ArticleCaract
{
    const Tailles=[
        1=>"S",
        2=>"M",
        3=>"L",
        4=>"XL",
        5=>"XXL",
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=ArticlesFini::class, inversedBy="articleCaracts")
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

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

    public function getArticle(): ?ArticlesFini
    {
        return $this->article;
    }

    public function setArticle(?ArticlesFini $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function __toString(){
        return $this->taille;
    }
}
