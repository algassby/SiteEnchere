<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * * @Assert\Length(min="5", max="200")
     *@Assert\Type("string")
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="10", minMessage="10")
     * @Assert\Type("string")
     */
    private $descriptif;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive(message="uniquement chiffre positif")
     * @Assert\Type("float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=100)
     * * @Assert\Length(min="5", max="200")
     * @Assert\Type("string")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enchere", mappedBy="produit", orphanRemoval=true)
     */
    private $enchere;

    public function __construct()
    {
        $this->enchere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEnchere(): Collection
    {
        return $this->enchere;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->enchere->contains($enchere)) {
            $this->enchere[] = $enchere;
            $enchere->setProduit($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->enchere->contains($enchere)) {
            $this->enchere->removeElement($enchere);
            // set the owning side to null (unless already changed)
            if ($enchere->getProduit() === $this) {
                $enchere->setProduit(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->reference;
    }
}
