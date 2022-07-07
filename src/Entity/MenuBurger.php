<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuBurgerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MenuBurgerRepository::class)]
#[ApiResource()]

class MenuBurger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
#[Groups(["menu:ajouter"])]

#[ORM\Column(type: 'integer')]
    private $id;

#[Assert\Positive(message:"la quantite doit etre superieur a 0")]
#[Groups(["menu:ajouter"])]
#[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;


#[Assert\NotBlank(message:"le menu doit contenir au moins un burger")]
#[Groups(["menu:ajouter"])]
#[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'menuBurgers')]
    private $burger;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuBurgers')]
    private $menu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
