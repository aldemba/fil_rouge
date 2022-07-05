<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
#[ApiResource(
    collectionOperations:[
        "post"=>[ 
        'method' => 'post',
        'denormalization_context' => ['groups' => ['taille:write']]
    ],"get"
]

       
    
)]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['taille:write','menu:read:simple'])]
    private $id;

    #[Groups(['taille:write','menu:read'])]
    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;


    #[Groups(['taille:write'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $libelle;


    
    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'tailles')]
    private $boissons;


    // #[ORM\ManyToOne(targetEntity: Complements::class, inversedBy: 'tailles')]
    private $complements;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'tailles')]
    private $menus;


    public function __construct()
    {
        $this->boissons = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        $this->boissons->removeElement($boisson);

        return $this;
    }

    // public function getComplements(): ?Complements
    // {
    //     return $this->complements;
    // }

    // public function setComplements(?Complements $complements): self
    // {
    //     $this->complements = $complements;

    //     return $this;
    // }

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
            $menu->addTaille($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeTaille($this);
        }

        return $this;
    }

   
    
}
