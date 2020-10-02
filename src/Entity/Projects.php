<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"project:read"}},
 *  denormalizationContext={"groups"={"project:write"}},
 *  collectionOperations={"get", "post"},
 *  itemOperations={"get", "put", "delete"}
 * )
 */
class Projects
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read"
     * })
     */
    private $publishDate;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({
     *      "project:read",
     *      "project:write"
     * })
     */
    private $visibility;

    /**
     * @ORM\Column(type="integer")
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $year;

    /**
     * @ORM\Column(type="json")
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $medias = [];

    /**
     * @ORM\ManyToOne(targetEntity=Sites::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "project:read", 
     *      "project:write"
     * })
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=ProjectTypes::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "eventType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $projectType;

    /**
     * @ORM\ManyToOne(targetEntity=EventTypes::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *      "color:read",
     *      "event:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $eventType;

    /**
     * @ORM\ManyToOne(targetEntity=Events::class, inversedBy="projects")
     * @Groups({
     *      "color:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=Colors::class, inversedBy="projects")
     * @Groups({
     *      "event:read",
     *      "eventType:read",
     *      "projectType:read",
     *      "site:read",
     *      "client:read",
     *      "project:read",
     *      "project:write"
     * })
     */
    private $color;

    public function __construct()
    {
        $this->publishDate = new \DateTime();
        $this->visibility = false;
        $this->medias = [];
        $this->year = 2020;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }

    public function setPublishDate(\DateTimeInterface $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function getVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getMedias(): ?array
    {
        return $this->medias;
    }

    public function setMedias(array $medias): self
    {
        $this->medias = $medias;

        return $this;
    }

    public function getSite(): ?Sites
    {
        return $this->site;
    }

    public function setSite(?Sites $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getProjectType(): ?ProjectTypes
    {
        return $this->projectType;
    }

    public function setProjectType(?ProjectTypes $projectType): self
    {
        $this->projectType = $projectType;

        return $this;
    }

    public function getEventType(): ?EventTypes
    {
        return $this->eventType;
    }

    public function setEventType(?EventTypes $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getEvent(): ?Events
    {
        return $this->event;
    }

    public function setEvent(?Events $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getColor(): ?Colors
    {
        return $this->color;
    }

    public function setColor(?Colors $color): self
    {
        $this->color = $color;

        return $this;
    }
}
