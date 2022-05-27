<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
class Candidat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email_contact;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numero_tel;

    #[ORM\ManyToOne(targetEntity: Promotion::class, inversedBy: 'candidats_liste')]
    #[ORM\JoinColumn(nullable: false)]
    private $promotion_id;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->email_contact;
    }

    public function setEmailContact(?string $email_contact): self
    {
        $this->email_contact = $email_contact;

        return $this;
    }

    public function getNumeroTel(): ?string
    {
        return $this->numero_tel;
    }

    public function setNumeroTel(?string $numero_tel): self
    {
        $this->numero_tel = $numero_tel;

        return $this;
    }

    public function getPromotionId(): ?Promotion
    {
        return $this->promotion_id;
    }

    public function setPromotionId(?Promotion $promotion_id): self
    {
        $this->promotion_id = $promotion_id;

        return $this;
    }
}
