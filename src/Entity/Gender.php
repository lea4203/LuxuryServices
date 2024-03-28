<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderRepository::class)]
class Gender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'gender', cascade: ['persist', 'remove'])]
    private ?Candidats $candidats = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCandidats(): ?Candidats
    {
        return $this->candidats;
    }

    public function setCandidats(?Candidats $candidats): static
    {
        // unset the owning side of the relation if necessary
        if ($candidats === null && $this->candidats !== null) {
            $this->candidats->setGender(null);
        }

        // set the owning side of the relation if necessary
        if ($candidats !== null && $candidats->getGender() !== $this) {
            $candidats->setGender($this);
        }

        $this->candidats = $candidats;

        return $this;
    }
}
