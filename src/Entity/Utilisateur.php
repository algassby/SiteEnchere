<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message = "votre mail '{{ value }}' n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min="6", max="100")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="utilisateurs")
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Achat", mappedBy="utilisateur")
     */
    private $achat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HistoriqueEnchere", mappedBy="utilisateur")
     */
    private $historiqueEnchere;

    public function __construct()
    {
        $this->achat = new ArrayCollection();
        $this->historiqueEnchere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Achat[]
     */
    public function getAchat(): Collection
    {
        return $this->achat;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achat->contains($achat)) {
            $this->achat[] = $achat;
            $achat->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achat->contains($achat)) {
            $this->achat->removeElement($achat);
            // set the owning side to null (unless already changed)
            if ($achat->getUtilisateur() === $this) {
                $achat->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HistoriqueEnchere[]
     */
    public function getHistoriqueEnchere(): Collection
    {
        return $this->historiqueEnchere;
    }

    public function addHistoriqueEnchere(HistoriqueEnchere $historiqueEnchere): self
    {
        if (!$this->historiqueEnchere->contains($historiqueEnchere)) {
            $this->historiqueEnchere[] = $historiqueEnchere;
            $historiqueEnchere->setUtilisateur($this);
        }

        return $this;
    }

    public function removeHistoriqueEnchere(HistoriqueEnchere $historiqueEnchere): self
    {
        if ($this->historiqueEnchere->contains($historiqueEnchere)) {
            $this->historiqueEnchere->removeElement($historiqueEnchere);
            // set the owning side to null (unless already changed)
            if ($historiqueEnchere->getUtilisateur() === $this) {
                $historiqueEnchere->setUtilisateur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (String)$this->email;
    }
}
