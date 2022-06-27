<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComplementsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ComplementsRepository::class)]
#[ApiResource()]
class Complements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'complements')]
    private $menus;

    #[ORM\OneToMany(mappedBy: 'complements', targetEntity: Taille::class)]
    private $tailles;

    #[ORM\OneToMany(mappedBy: 'complements', targetEntity: PortionFrite::class)]
    private $PortionFrites;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->tailles = new ArrayCollection();
        $this->PortionFrites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    // public function addMenu(Menu $menu): self
    // {
    //     if (!$this->menus->contains($menu)) {
    //         $this->menus[] = $menu;
    //         $menu->addComplement($this);
    //     }

    //     return $this;
    // }

    // public function removeMenu(Menu $menu): self
    // {
    //     if ($this->menus->removeElement($menu)) {
    //         $menu->removeComplement($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Taille>
     */
    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function addTaille(Taille $taille): self
    {
        if (!$this->tailles->contains($taille)) {
            $this->tailles[] = $taille;
            $taille->setComplements($this);
        }

        return $this;
    }

    public function removeTaille(Taille $taille): self
    {
        if ($this->tailles->removeElement($taille)) {
            // set the owning side to null (unless already changed)
            if ($taille->getComplements() === $this) {
                $taille->setComplements(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PortionFrite>
     */
    public function getPortionFrites(): Collection
    {
        return $this->PortionFrites;
    }

    public function addPortionFrite(PortionFrite $portionFrite): self
    {
        if (!$this->PortionFrites->contains($portionFrite)) {
            $this->PortionFrites[] = $portionFrite;
            $portionFrite->setComplements($this);
        }

        return $this;
    }

    public function removePortionFrite(PortionFrite $portionFrite): self
    {
        if ($this->PortionFrites->removeElement($portionFrite)) {
            // set the owning side to null (unless already changed)
            if ($portionFrite->getComplements() === $this) {
                $portionFrite->setComplements(null);
            }
        }

        return $this;
    }
}
