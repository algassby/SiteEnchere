<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PackJetonRepository")
 */
class PackJeton
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     *
     */
    private $nbJetons;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min="5", max="200")
     */
    private $descrption;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Achat", mappedBy="packJeton")
     */
    private $achats;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJetons(): ?int
    {
        return $this->nbJetons;
    }

    public function setNbJetons(int $nbJetons): self
    {
        $this->nbJetons = $nbJetons;

        return $this;
    }

    public function getDescrption(): ?string
    {
        return $this->descrption;
    }

    public function setDescrption(string $descrption): self
    {
        $this->descrption = $descrption;

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

    /**
     * @return Collection|Achat[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setPackJeton($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->contains($achat)) {
            $this->achats->removeElement($achat);
            // set the owning side to null (unless already changed)
            if ($achat->getPackJeton() === $this) {
                $achat->setPackJeton(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->descrption;
    }
}
