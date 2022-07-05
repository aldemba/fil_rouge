<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;



use App\Entity\Menu;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
*
*/
class ProduitDataPersister implements DataPersisterInterface
{
private $_entityManager;


public function __construct(EntityManagerInterface $entityManager) {
$this->_entityManager = $entityManager;
}

/**
* {@inheritdoc}
*/
public function supports($data, array $context = []): bool
{
return $data instanceof Produit;
}

/**
* @param Produit $data
*/
public function persist($data, array $context = [])
{
    if($data instanceof Menu) {
        $prix=0;
        foreach($data->getBurgers() as $burger){
        $prix += $burger->getPrix();
        }
        foreach($data->getPortionfrites() as $portionfrite){
        $prix+=$portionfrite->getPrix();
        }
        foreach($data->getTailles() as $taille){
        $prix+=$taille->getPrix();
        }
        $data->setPrix($prix);
        
        }
        
$this->_entityManager->persist($data);

$this->_entityManager->flush();
}

/**
* {@inheritdoc}
*/
public function remove($data, array $context = [])
{
$this->_entityManager->remove($data);
$this->_entityManager->flush();
}
}
