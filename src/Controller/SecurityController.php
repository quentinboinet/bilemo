<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login()
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json([
                'error' => 'Requête non valide: veuillez vérifier que le Content-Type du header soit "application/json".'
            ], 400);
        }
        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}