<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'actors')]
    private Collection $Relation;

    public function __construct()
    {
        $this->Relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getRelation(): Collection
    {
        return $this->Relation;
    }

    public function addRelation(Movie $relation): self
    {
        if (!$this->Relation->contains($relation)) {
            $this->Relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(Movie $relation): self
    {
        $this->Relation->removeElement($relation);

        return $this;
    }
}
