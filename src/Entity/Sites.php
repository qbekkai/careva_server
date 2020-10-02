<?php

namespace App\Entity;

use App\Repository\SitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SitesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"site:read"}},
 *  denormalizationContext={"groups"={"site:write"}},
 *  collectionOperations={"get"},
 *  itemOperations={"get"}
 * )
 */
class Sites
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
     *      "eventType:read",
     *      "projectType:read",
     *      "client:read",
     *      "project:read",
     *      "site:read", 
     *      "site:write"
     * })
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="site")
     * @Groups({"site:read"})
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
            $project->setSite($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getSite() === $this) {
                $project->setSite(null);
            }
        }

        return $this;
    }
}
