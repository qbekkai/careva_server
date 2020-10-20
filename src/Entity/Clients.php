<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"client:read"}},
 *  denormalizationContext={"groups"={"client:write"}},
 *  collectionOperations={"get", "post"},
 *  itemOperations={"get", "put", "delete"}
 * )
 */
class Clients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({
     *      "client:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "project:read",
     *      "client:read", 
     *      "client:write"
     * })
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *      "client:read", 
     *      "client:write"
     * })
     */
    private $thumb;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="client")
     * @Groups({
     *      "client:read"
     * })
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

    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    public function setThumb(?string $thumb): self
    {
        $this->thumb = $thumb;

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
            $project->setClient($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getClient() === $this) {
                $project->setClient(null);
            }
        }

        return $this;
    }
}
