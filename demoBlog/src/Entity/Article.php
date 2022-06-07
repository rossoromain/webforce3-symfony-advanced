<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'Votre titre doit contenir au minimum 10 caractères.',
        maxMessage: 'Votre titre doit contenir au maximumu 255 caractères.',
    )]
    #[Assert\NotNull(
        message: 'Veuillez indiquer un titre.',
    )]
    private $title;

    #[Assert\Length(        
        max: 255,        
        maxMessage: 'Votre titre doit contenir au maximumu 255 caractères.',
    )]
    #[Assert\NotNull(
        message: 'Veuillez indiquer un contenu.',
    )]
    #[ORM\Column(type: 'text')]
    private $content;

    #[Assert\Length(        
        max: 255,        
        maxMessage: 'Votre titre doit contenir au maximumu 255 caractères.',
    )]
    #[Assert\NotNull(
        message: 'Veuillez indiquer un url d\'image.',
    )]
    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'datetime')]
    #[Assert\DateTime]
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
