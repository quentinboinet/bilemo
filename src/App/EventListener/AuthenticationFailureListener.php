<?php


namespace App\App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class AuthenticationFailureListener
{
    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        $data = [
            'status'  => '401 Unauthorized',
            'message' => 'Identifiants invalides, veuillez vérifier que votre couple e-mail/mot de passe soit correct.',
        ];

        $response = new JWTAuthenticationFailureResponse($data);

        $event->setResponse($response);
    }
}