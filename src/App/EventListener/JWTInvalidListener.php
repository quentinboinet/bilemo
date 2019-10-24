<?php


namespace App\App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class JWTInvalidListener
{
    /**
     * @param JWTInvalidEvent $event
     */
    public function onJWTInvalid(JWTInvalidEvent $event)
    {
        $response = new JWTAuthenticationFailureResponse('Token invalide ! Veuillez vous authentifier à nouveau afin d\'en récupérer un nouveau. (requête sur /login)', 403);

        $event->setResponse($response);
    }
}