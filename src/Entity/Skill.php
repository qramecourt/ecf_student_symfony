<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: skill::class, inversedBy: 'skills')]
    private $skills;

    #[ORM\ManyToMany(targetEntity: student::class, inversedBy: 'skills')]
    private $students;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(skill $skill): self
    {
        $this->skills->removeElement($skill);

        return $this;
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
        }

        return $this;
    }

    public function removeStudent(student $student): self
    {
        $this->students->removeElement($student);

        return $this;
    }
}
