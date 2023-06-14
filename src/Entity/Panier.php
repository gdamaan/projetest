<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Article::class)]
    private Collection $listeArticles;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->listeArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getListeArticles(): Collection
    {
        return $this->listeArticles;
    }

    public function addListeArticle(Article $listeArticle): self
    {
        if (!$this->listeArticles->contains($listeArticle)) {
            $this->listeArticles->add($listeArticle);
        }

        return $this;
    }

    public function removeListeArticle(Article $listeArticle): self
    {
        $this->listeArticles->removeElement($listeArticle);

        return $this;
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
}
