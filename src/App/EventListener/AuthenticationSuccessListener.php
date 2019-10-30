<?php


namespace App\App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        date_default_timezone_set("Europe/Paris");
        $data['data'] = array(
            'Message' => "Bienvenue " . $user->getName() . ", content de vous retrouver !",
            'name' => $user->getName(),
            'roles' => $user->getRoles(),
            'expiresAt' => date("d/m/Y H:i:s", time() + 3600),
        );

        $event->setData($data);
    }
}