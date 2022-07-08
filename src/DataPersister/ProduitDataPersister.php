<?php

// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;



use App\Entity\Menu;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Services\PriceMenuService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

/**
 *
 */
class ProduitDataPersister implements DataPersisterInterface
{
    private $_entityManager;
    private $security;
    private $price;
   




    public function __construct(EntityManagerInterface $entityManager, Security $security, PriceMenuService $price)
    {
        $this->_entityManager = $entityManager;
        $this->security = $security;
        $this->price = $price;


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

            $data->setPrix($this->price->Calculprice($data));
            
        }

        if ($data instanceof Produit) {
            if($data->getFileImage()){
                $data->setImage(\file_get_contents($data->getFileImage()));
                
            }
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
//  $prix = 0;
            // foreach ($data->getMenuBurgers() as $burger){
            //     $prix+= $burger->getBurger()->getPrix() * $burger->getQuantite();
              
                
            // }
            // foreach ($data->getMenuPortions() as $portionfrite){
            //     $prix+= $portionfrite->getPortionfrite()->getPrix() * $portionfrite->getQuantite();

            // }
            // foreach ($data->getMenuTailles() as $taille){
            //     $prix+= $taille->getTaille()->getPrix() * $taille->getQuantite();
            // }
            //  $data->setPrix($prix);