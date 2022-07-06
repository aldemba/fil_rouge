<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;



use App\Entity\Menu;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

/**
 *
 */
class ProduitDataPersister implements DataPersisterInterface
{
    private $_entityManager;
    private $security;
    // private $prix=0;



    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->_entityManager = $entityManager;
        $this->security = $security;
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
        if ($data instanceof Produit) {
            $data->setUser($this->security->getUser());
        }

        if ($data instanceof Menu) {
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
