<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap(["boisson"=>"Boisson", "burger"=>"Burger","menu"=>"Menu","portion"=>"PortionFrite" ])]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]

#[ApiResource(
    collectionOperations:[
        "get"=>[ 
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['simple']]
    ],
    "post" =>[
        'status' => Response::HTTP_CREATED,
        'denormalization_context' => ['groups' => ['write:simple','write:all']],
        'normalization_context' => ['groups' => ['write:simple','write']]
        ]    
    ],
    itemOperations:["put","get"])]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["write:simple", "write:all","simple"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["write:simple", "write:all","simple"])]
    private $nom;

    #[ORM\Column(type: 'object', nullable: true)]
    #[Groups(["write:simple", "write:all","simple"])]
    private $image;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(["write:simple", "write:all","simple"])]
    private $prix;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["write:simple", "write:all","simple"])]
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?object
    {
        return $this->image;
    }

    public function setImage(?object $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
