<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type",type:"string")]
#[ORM\DiscriminatorMap(["boisson"=>"Boisson", "burger"=>"Burger","menu"=>"Menu","portion"=>"PortionFrite" ])]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]

#[ApiResource(
    collectionOperations:[
        "get"=>[ 
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['burger:read:simple']]
    ],
    "post" =>[
        'method' => 'post',
        'normalization_context' => ['groups' => ['burger:read:all']],
        'denormalization_context' => ['groups' => ['write']],
        'security' => "is_granted('ROLE_GESTIONNAIRE')",
        'security_message' => "Vous n'avez pas acces a cette ressource"
        // 'status' => Response::HTTP_CREATED,
        // 'denormalization_context' => ['groups' => ['write:simple','write:all']],
        // 'normalization_context' => ['groups' => ['write:simple','write']],
        ]    
    ],
    itemOperations:[
        "get"=>[ 
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['burger:read:all']]
    ],
    
    "put"])]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['burger:read:all','menu:read:simple','menu:read',"menu:ajouter",'taille:write'])] 
    protected $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['burger:read:simple','burger:read:all','write','portion:read:simple','boisson:write','menu:read:simple','menu:read','menu:lecture','portion:write','taille:write','lister:boisson','lister:menu','lister:portion'])]
    protected $nom;


    // #[Groups(['burger:read:simple','burger:read:all','write','portion:read:simple','boisson:write','menu:read:simple','menu:read','menu:lecture'])]
    // #[ORM\Column(type: 'blob', nullable: true)]
    // protected $image;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['burger:read:simple','burger:read:all','write','portion:read:simple','menu:read','menu:lecture','portion:write','lister:boisson','lister:menu','lister:portion'])]
    protected $prix;

    #[Groups(['burger:read:all','menu:read'])]
    #[ORM\Column(type: 'boolean', nullable: true)]
    protected $isEtat=true;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'produits')]
    private $user;


    // #[Groups(['menu:ajouter'])]
    #[SerializedName("image")]
    protected string $fileImage="";


    #[Groups(['burger:read:simple','burger:read:all','write','portion:read:simple','boisson:write','menu:read:simple','menu:read','menu:lecture','portion:write','taille:write','lister:boisson','lister:menu','lister:portion'])]
    #[ORM\Column(type: 'blob', nullable: true)]
    private $image;

    // #[Groups(['burger:read:simple','burger:read:all','write','portion:read:simple','boisson:write','menu:read:simple','menu:read','menu:lecture','menu:ajouter'])]
    
    
    // #[ORM\Column(type: 'blob', nullable: true)]
    // private $image;

    


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

    

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function isIsEtat(): ?bool
    {
        return $this->isEtat;
    }

    public function setIsEtat(?bool $isEtat): self
    {
        $this->isEtat = $isEtat;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

  

    /**
     * Get the value of fileImage
     */ 
    public function getFileImage()
    {
        return $this->fileImage;
    }

    /**
     * Set the value of fileImage
     *
     * @return  self
     */ 
    public function setFileImage($fileImage)
    {
        $this->fileImage = $fileImage;

        return $this;
    }

    // /**
    //  * Get the value of image
    //  */ 
    // public function getImage()
    // {
    //     // return $this->image;
    //     return is_resource($this->image) ? utf8_encode(base64_encode(stream_get_contents($this->image))):$this->image;

    // }

    // /**
    //  * Set the value of image
    //  *
    //  * @return  self
    //  */ 
    // public function setImage($image)
    // {
    //     $this->image = $image;

    //     return $this;
    // }

    // public function getImage()
    // {
    //  return (base64_encode(($this->image)));
    // }

    // public function setImage($image): self
    // {
    //     $this->image = $image;

    //     return $this;
    // }

    public function getImage()
    {
        return (base64_encode(($this->image)));
    
    } 


    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
