<?php


namespace App\App\EventListener;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTNotFoundListener
{
    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $data = [
            'status'  => '403 Forbidden',
            'message' => 'Le token d\'authentification est introuvable.',
        ];

        $response = new JsonResponse($data, 403);

        $event->setResponse($response);
    }
}