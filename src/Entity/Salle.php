<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'salles_liste')]
    private $session_id;

    public function __construct()
    {
        $this->session_id = new ArrayCollection();
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

    /**
     * @return Collection<int, Session>
     */
    public function getSessionId(): Collection
    {
        return $this->session_id;
    }

    public function addSessionId(Session $sessionId): self
    {
        if (!$this->session_id->contains($sessionId)) {
            $this->session_id[] = $sessionId;
        }

        return $this;
    }

    public function removeSessionId(Session $sessionId): self
    {
        $this->session_id->removeElement($sessionId);

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}

