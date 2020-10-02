<?php

namespace App\Entity;

use App\Repository\EventTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EventTypesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"eventType:read"}},
 *  denormalizationContext={"groups"={"eventType:write"}},
 *  collectionOperations={"get", "post"},
 *  itemOperations={"get", "put", "delete"}
 * )
 */
class EventTypes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "eventType:read",
     *      "eventType:write"
     * })
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="eventType")
     * @Groups({"eventType:read"})
     */
    private $projects;


    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Projects[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setEventType($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getEventType() === $this) {
                $project->setEventType(null);
            }
        }

        return $this;
    }
}
