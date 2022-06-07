<?php

namespace App\Entity;

use App\Repository\CollegueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CollegueRepository::class)]
class Collegue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Le nom doit contenir au minimum {{ limit }} caractères',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères',
    )]
    #[Assert\NotBlank(
        message: "Veuillez renseigné un nom"
    )]
    private $name;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Length(
        min: 3,
        max: 20,
        minMessage: 'Le prénom doit contenir au minimum {{ limit }} caractères.',
        maxMessage: 'Le prénom doit contenir au maximum {{ limit }} caractères.',
    )]
    #[Assert\NotBlank(
        message: "Veuillez renseigné un prénom"
    )]
    private $firstname;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(
        message: "Veuillez renseigné un salaire mensuel."
    )]
    #[Assert\Positive(
        message: "Le salaire doit être strictement positif."
    )] 
    #[Assert\LessThanOrEqual(
        value: 5000,
        message: "Le salaire ne peut pas excéder 5.000€."
    )]
    #[Assert\GreaterThanOrEqual(
        value: 1200,
        message: "Le salaire ne peut pas excéder 1.200€."
    )]
    private $wages;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getWages(): ?int
    {
        return $this->wages;
    }

    public function setWages(int $wages): self
    {
        $this->wages = $wages;

        return $this;
    }
}
