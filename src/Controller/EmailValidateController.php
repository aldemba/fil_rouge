<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailValidateController extends AbstractController
{
    public function __construct(EntityManagerInterface $emi){
        $this->emi =$emi;
    }
    public function __invoke(Request $request, UserRepository $userR, EntityManagerInterface $emi){

    $token=$request->get("token");

    $user = $userR->findOneBy(["token" => $token]);
if(!$user){
    return new jsonResponse(["error" => "Invalid token"],Response::HTTP_BAD_REQUEST);
}
if($user->isIsEnable()){
    return neW jsonResponse(["message" => "Votre compte est déjà actif"],Response::HTTP_BAD_REQUEST);
}
if($user->getExpireAt()< new \DateTime()){
    return new jsonResponse(["message" => "clé expirée"],Response::HTTP_BAD_REQUEST);
}
    $user->setIsEnable (true);
    $emi->flush();

    return new jsonResponse (["message" => "compte activé avec succés "],Response::HTTP_OK);
    }
}
