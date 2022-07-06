<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuPortionRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuPortionRepository::class)]
#[ApiResource()]

class MenuPortion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
// #[Groups(["menu:ajouter"])]
#[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["menu:ajouter"])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    #[Groups(["menu:ajouter"])]
    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'menuPortions')]
    private $portionfrite;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuPortions')]
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

    public function getPortionfrite(): ?PortionFrite
    {
        return $this->portionfrite;
    }

    public function setPortionfrite(?PortionFrite $portionfrite): self
    {
        $this->portionfrite = $portionfrite;

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
