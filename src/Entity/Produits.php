<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 255)]
    private ?string $Name = null;
    /**
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     */
    #[ORM\Column(length: 255)]
    private ?string $Description = null;
    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 255)]
    private ?float $Price = null;
    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 255)]
    private ?string $Image = null;
    /**
     * @Assert\NotBlank
     */
    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(name:"categories_id",referencedColumnName:"id",onDelete: "CASCADE", nullable: false)]
    private ?Categories $Categories = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->Categories;
    }

    public function setCategories(?Categories $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

   
}
