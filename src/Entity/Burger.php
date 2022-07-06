<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations: [

        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['burger:read:simple']]
        ],
        "post" => [
            'method' => 'post',
            'normalization_context' => ['groups' => ['burger:read:all']],
            'denormalization_context' => ['groups' => ['write']],
            'security' => "is_granted('ROLE_GESTIONNAIRE')",
            'security_message' => "Vous n'avez pas acces a cette ressource"

        ],
    ],
    itemOperations: [
        "put" => [
            'method' => 'put',
            'security' => "is_granted('ROLE_GESTIONNAIRE')",
            'security_message' => "Vous n'avez pas acces a cette ressource"

        ], "get"
    ]


)]
class Burger extends Produit
{
    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'burgers')]
    private $menus;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: MenuBurger::class)]
    private $menuBurgers;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->menuBurgers = new ArrayCollection();
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }

    /**
     * @return Collection<int, MenuBurger>
     */
    public function getMenuBurgers(): Collection
    {
        return $this->menuBurgers;
    }

    public function addMenuBurger(MenuBurger $menuBurger): self
    {
        if (!$this->menuBurgers->contains($menuBurger)) {
            $this->menuBurgers[] = $menuBurger;
            $menuBurger->setBurger($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurger $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getBurger() === $this) {
                $menuBurger->setBurger(null);
            }
        }

        return $this;
    }
}
