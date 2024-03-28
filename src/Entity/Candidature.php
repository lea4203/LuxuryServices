<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $submitAt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Candidats $candidat = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Jobs $jobs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubmitAt(): ?\DateTimeImmutable
    {
        return $this->submitAt;
    }

    public function setSubmitAt(\DateTimeImmutable $submitAt): static
    {
        $this->submitAt = $submitAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCandidat(): ?Candidats
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidats $candidat): static
    {
        $this->candidat = $candidat;

        return $this;
    }

    public function getJobs(): ?Jobs
    {
        return $this->jobs;
    }

    public function setJobs(?Jobs $jobs): static
    {
        $this->jobs = $jobs;

        return $this;
    }
}
