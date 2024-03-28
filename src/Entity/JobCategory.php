<?php

namespace App\Entity;

use App\Repository\JobCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobCategoryRepository::class)]
class JobCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Jobs::class, mappedBy: 'jobCategory')]
    private Collection $job;

    public function __construct()
    {
        $this->job = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Jobs>
     */
    public function getJob(): Collection
    {
        return $this->job;
    }

    public function addJob(Jobs $job): static
    {
        if (!$this->job->contains($job)) {
            $this->job->add($job);
            $job->setJobCategory($this);
        }

        return $this;
    }

    public function removeJob(Jobs $job): static
    {
        if ($this->job->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getJobCategory() === $this) {
                $job->setJobCategory(null);
            }
        }

        return $this;
    }

    
}
