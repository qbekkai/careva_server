<?php

namespace App\Entity;

use App\Repository\ProjectTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProjectTypesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"projectType:read"}},
 *  denormalizationContext={"groups"={"projectType:write"}},
 *  collectionOperations={"get"},
 *  itemOperations={"get"}
 * )
 */
class ProjectTypes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read", 
     *      "projectType:read", 
     *      "projectType:write"
     * })
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="projectType")
     * @Groups({"projectType:read"})
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
            $project->setProjectType($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getProjectType() === $this) {
                $project->setProjectType(null);
            }
        }

        return $this;
    }
}
