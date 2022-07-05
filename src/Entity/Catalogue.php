<?php

namespace App\Entity;

// use Doctrine\ORM\Mapping as ORM;
use App\Repository\CatalogueRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
#[ApiResource(
     collectionOperations:[
         "get"=>[ 
         'method' => 'get',
         'path'=>'/catalogues',
         'status' => Response::HTTP_OK,
         'normalization_context' => ['groups' => ['catalogue:read:simple']]
     ]
     ], itemOperations:[]


    )]

// #[ORM\Entity(repositoryClass: CatalogueRepository::class)]
class Catalogue
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    private $id;

    private $burgers;

    private $complements;



    public function getId(): ?int
    {
        return $this->id;
    }
}
