<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\StatusRepository")
 */
class Status
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     * @Groups({"projects"})
     */
    private $label;

    /**
     * @var Project $projects
     * @ORM\OneToMany(targetEntity="Project", mappedBy="status")
     * @Groups({"status"})
     */
    private $projects;

    /**
     * Status constructor.
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Status
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return Project[]|[]
     */
    public function getProjects(): array
    {
        return $this->projects->toArray();
    }

    /**
     * @param Project $project
     * @return Project[]
     */
    public function addProject(Project $project): array
    {
        if (!in_array($project, $this->getProjects(), true)){
            $this->projects->add($this->projects);
        }
        return $this->projects->toArray();
    }

    /**
     * @param Project $project
     * @return Project[]|[]
     */
    public function removeProject(Project $project): array
    {
        if (in_array($project, $this->getProjects(), true)){
            $this->projects->removeElement($project);
        }
        return $this->projects->toArray();
    }
}

