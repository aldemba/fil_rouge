<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFriteRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
#[ApiResource(
   



)]
class PortionFrite extends Produit
{
    // #[ORM\ManyToOne(targetEntity: Complements::class, inversedBy: 'PortionFrites')]
    // private $complements;
    // #[Groups(["menu:ajouter"])]
    #[ORM\OneToMany(mappedBy: 'portionfrite', targetEntity: MenuPortion::class)]
    private $menuPortions;

    public function __construct()
    {
        $this->menuPortions = new ArrayCollection();
    }

    // #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'portionfrites')]
    // private $menus;

    // public function __construct()
    // {
    //     $this->menus = new ArrayCollection();
    // }

    // public function getComplements(): ?Complements
    // {
    //     return $this->complements;
    // }

    // public function setComplements(?Complements $complements): self
    // {
    //     $this->complements = $complements;

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Menu>
    //  */
    // public function getMenus(): Collection
    // {
    //     return $this->menus;
    // }

    // public function addMenu(Menu $menu): self
    // {
    //     if (!$this->menus->contains($menu)) {
    //         $this->menus[] = $menu;
    //         $menu->addPortionfrite($this);
    //     }

    //     return $this;
    // }

    // public function removeMenu(Menu $menu): self
    // {
    //     if ($this->menus->removeElement($menu)) {
    //         $menu->removePortionfrite($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, MenuPortion>
     */
    public function getMenuPortions(): Collection
    {
        return $this->menuPortions;
    }

    public function addMenuPortion(MenuPortion $menuPortion): self
    {
        if (!$this->menuPortions->contains($menuPortion)) {
            $this->menuPortions[] = $menuPortion;
            $menuPortion->setPortionfrite($this);
        }

        return $this;
    }

    public function removeMenuPortion(MenuPortion $menuPortion): self
    {
        if ($this->menuPortions->removeElement($menuPortion)) {
            // set the owning side to null (unless already changed)
            if ($menuPortion->getPortionfrite() === $this) {
                $menuPortion->setPortionfrite(null);
            }
        }

        return $this;
    }
}
