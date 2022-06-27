<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
#[ApiResource()]
class PortionFrite extends Produit
{
    #[ORM\ManyToOne(targetEntity: Complements::class, inversedBy: 'PortionFrites')]
    private $complements;

    public function getComplements(): ?Complements
    {
        return $this->complements;
    }

    public function setComplements(?Complements $complements): self
    {
        $this->complements = $complements;

        return $this;
    }
}
