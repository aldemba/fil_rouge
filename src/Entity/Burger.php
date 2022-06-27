<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations:[
        "get"=>[ 
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['simple']]
    ],
        "post"=>[
            'method' => 'post',
            'status' => Response::HTTP_OK,
            'denormalization_context' => ['groups' => ['write:simple','write:all']],
            'normalization_context' => ['groups' => ['write:simple','write']]    
        ],
        ]
    )]
class Burger extends Produit
{
     #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'burgers')]
     private $menus; public function __construct()
 {
        $this->menus = new ArrayCollection();
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
}
