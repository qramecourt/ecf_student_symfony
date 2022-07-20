<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: student::class)]
    private $students;

    #[ORM\OneToOne(targetEntity: project::class, cascade: ['persist', 'remove'])]
    private $schoolyear;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, student>
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setProject($this);
        }

        return $this;
    }

    public function removeStudent(student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getProject() === $this) {
                $student->setProject(null);
            }
        }

        return $this;
    }

    public function getSchoolyear(): ?project
    {
        return $this->schoolyear;
    }

    public function setSchoolyear(?project $schoolyear): self
    {
        $this->schoolyear = $schoolyear;

        return $this;
    }
}
