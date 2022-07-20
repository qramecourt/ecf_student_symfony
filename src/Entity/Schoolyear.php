<?php

namespace App\Entity;

use App\Repository\SchoolyearRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchoolyearRepository::class)]
class Schoolyear
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
