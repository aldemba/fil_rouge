<?php
namespace App\DataProvider;


use App\Entity\Catalogue;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

class DataProviderCatalogue implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    public function __construct(MenuRepository $menus,BurgerRepository $burgers)
    {
       $this->menus=$menus;
       $this->burgers=$burgers; 
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Catalogue::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        if(Catalogue::class === $resourceClass){
            return [
                ["menus"=>$this->menus->findAll()],
                ["burgers"=>$this->burgers->findAll()]
            ];
        } 
    }
}
