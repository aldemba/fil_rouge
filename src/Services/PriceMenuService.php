<?php

namespace App\Services;

use App\Entity\Menu;


class PriceMenuService 
{
    public function Calculprice( $data)
    {
        $prix = 0;
        foreach ($data->getMenuBurgers() as $burger){
            $prix+= $burger->getBurger()->getPrix() * $burger->getQuantite();
          
        }
        foreach ($data->getMenuPortions() as $portionfrite){
            $prix+= $portionfrite->getPortionfrite()->getPrix() * $portionfrite->getQuantite();

        }
        foreach ($data->getMenuTailles() as $taille){
            $prix+= $taille->getTaille()->getPrix() * $taille->getQuantite();
        }
         return $prix;
    
    }
    
    }
    



