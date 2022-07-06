<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    collectionOperations:[
        "post"=>[ 
        'method' => 'post',
        'denormalization_context' => ['groups' => ['menu:ajouter']],
        'normalization_context' => ['groups' => ['menu:lecture']],
        'security' => "is_granted('ROLE_GESTIONNAIRE')",
        'security_message' => "Vous n'avez pas acces a cette ressource"
        // 'denormalization_context' => ['groups' => ['menu:read:simple']]
    ],"get"
    ]
    
)]
class Menu extends Produit

{
#[Groups(["menu:ajouter"])]
    protected $nom;

#[Groups(["menu:ajouter"])]
    protected $prix;

#[Groups(["menu:ajouter"])]
    protected $image;

#[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurger::class,cascade:["persist"])]
#[Groups(["menu:ajouter"])]
private $menuBurgers;

#[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuPortion::class,cascade:["persist"])]
#[Groups(["menu:ajouter"])]
private $menuPortions;

#[Groups(["menu:ajouter"])]
#[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class,cascade:["persist"])]
private $menuTailles;

public function __construct()
{
    $this->menuBurgers = new ArrayCollection();
    $this->menuPortions = new ArrayCollection();
    $this->menuTailles = new ArrayCollection();
}

//     #[Groups(['menu:read:simple'])]
//     #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
//     private $burgers;

//     #[Groups(['menu:read:simple','taille:write'])]
//     #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'menus')]
//     private $tailles;

//     #[Groups(['menu:read:simple'])]
//     #[ORM\ManyToMany(targetEntity: PortionFrite::class, inversedBy: 'menus')]
//     private $portionfrites;

//     public function __construct()
//     {
//         $this->tailles = new ArrayCollection();
//         $this->portionfrites = new ArrayCollection();
//         $this->burgers = new ArrayCollection();

//     }


//     // #[Groups(['menu:read:simple'])]
//     // #[ORM\ManyToMany(targetEntity: Complements::class, inversedBy: 'menus')]
//     // private $complements;

    

//     /**
//      * @return Collection<int, Burger>
//      */
//     public function getBurgers(): Collection
//     {
//         return $this->burgers;
//     }

//      public function addBurger(Burger $burger): self
//      {
//          if (!$this->burgers->contains($burger)) {
//              $this->burgers[] = $burger;
//              $burger->addMenu($this);
//          }

//          return $this;
//      }

//      public function removeBurger(Burger $burger): self
//              {
//                  if ($this->burgers->removeElement($burger)) {
//                         $burger->removeMenu($this);
//                  }
            
//                  return $this;
//              }

// //  /**
// //   * @return Collection<int, Complements>
// //   */
// //  public function getComplements(): Collection
// //      {
// //          return $this->complements;
// //      }

// //      public function addComplement(Complements $complement): self
// //      {
// //          if (!$this->complements->contains($complement)) {
// //              $this->complements[] = $complement;
// //          }

// //          return $this;
// //      }

// //      public function removeComplement(Complements $complement): self
// //      {
// //          $this->complements->removeElement($complement);

// //          return $this;
// //      }

// // /**
// //  * @return Collection<int, Complements>
// //  */
// // public function getComplements(): Collection
// // {
// //     return $this->complements;
// // }

// // public function addComplement(Complements $complement): self
// // {
// //     if (!$this->complements->contains($complement)) {
// //         $this->complements[] = $complement;
// //     }

// //     return $this;
// // }

// // public function removeComplement(Complements $complement): self
// // {
// //     $this->complements->removeElement($complement);

// //     return $this;
// // }

// /**
//  * @return Collection<int, Taille>
//  */
// public function getTailles(): Collection
// {
//     return $this->tailles;
// }

// public function addTaille(Taille $taille): self
// {
//     if (!$this->tailles->contains($taille)) {
//         $this->tailles[] = $taille;
//     }

//     return $this;
// }

// public function removeTaille(Taille $taille): self
// {
//     $this->tailles->removeElement($taille);

//     return $this;
// }

// /**
//  * @return Collection<int, PortionFrite>
//  */
// public function getPortionfrites(): Collection
// {
//     return $this->portionfrites;
// }

// public function addPortionfrite(PortionFrite $portionfrite): self
// {
//     if (!$this->portionfrites->contains($portionfrite)) {
//         $this->portionfrites[] = $portionfrite;
//     }

//     return $this;
// }

// public function removePortionfrite(PortionFrite $portionfrite): self
// {
//     $this->portionfrites->removeElement($portionfrite);

//     return $this;
// }

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
        $menuBurger->setMenu($this);
    }

    return $this;
}

public function removeMenuBurger(MenuBurger $menuBurger): self
{
    if ($this->menuBurgers->removeElement($menuBurger)) {
        // set the owning side to null (unless already changed)
        if ($menuBurger->getMenu() === $this) {
            $menuBurger->setMenu(null);
        }
    }

    return $this;
}

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
        $menuPortion->setMenu($this);
    }

    return $this;
}

public function removeMenuPortion(MenuPortion $menuPortion): self
{
    if ($this->menuPortions->removeElement($menuPortion)) {
        // set the owning side to null (unless already changed)
        if ($menuPortion->getMenu() === $this) {
            $menuPortion->setMenu(null);
        }
    }

    return $this;
}

/**
 * @return Collection<int, MenuTaille>
 */
public function getMenuTailles(): Collection
{
    return $this->menuTailles;
}

public function addMenuTaille(MenuTaille $menuTaille): self
{
    if (!$this->menuTailles->contains($menuTaille)) {
        $this->menuTailles[] = $menuTaille;
        $menuTaille->setMenu($this);
    }

    return $this;
}

public function removeMenuTaille(MenuTaille $menuTaille): self
{
    if ($this->menuTailles->removeElement($menuTaille)) {
        // set the owning side to null (unless already changed)
        if ($menuTaille->getMenu() === $this) {
            $menuTaille->setMenu(null);
        }
    }

    return $this;
}
}
