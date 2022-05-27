<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $intitule;

    #[ORM\ManyToOne(targetEntity: Organisme::class, inversedBy: 'formation_liste')]
    private $organisme_id;

    #[ORM\OneToMany(mappedBy: 'formation_id', targetEntity: Promotion::class)]
    private $promotions_liste;

    public function __construct()
    {
        $this->promotions_liste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getOrganismeId(): ?Organisme
    {
        return $this->organisme_id;
    }

    public function setOrganismeId(?Organisme $organisme_id): self
    {
        $this->organisme_id = $organisme_id;

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotionsListe(): Collection
    {
        return $this->promotions_liste;
    }

    public function addPromotionsListe(Promotion $promotionsListe): self
    {
        if (!$this->promotions_liste->contains($promotionsListe)) {
            $this->promotions_liste[] = $promotionsListe;
            $promotionsListe->setFormationId($this);
        }

        return $this;
    }

    public function removePromotionsListe(Promotion $promotionsListe): self
    {
        if ($this->promotions_liste->removeElement($promotionsListe)) {
            // set the owning side to null (unless already changed)
            if ($promotionsListe->getFormationId() === $this) {
                $promotionsListe->setFormationId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getIntitule();
    }
}
