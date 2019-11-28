<?php


namespace App\App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class UserAdd implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['checkUserAdded', EventPriorities::POST_WRITE],
        ];
    }

    public function checkUserAdded(ViewEvent $event): void
    {
        $pathInfo = $event->getRequest()->getPathInfo();
        if (strpos($pathInfo, '/api/users') !== false && $event->getRequest()->getMethod() === 'POST') {

            /** @var User $user */
            $user = $event->getControllerResult();

            $data = array(
                'message' => 'Utilisateur correctement ajouté !',
                '@context' => '/api/contexts/User',
                '@id' => '/api/users/' . $user->getId(),
                '@type' => 'User',
                'username' => '' . $user->getUsername() . '',
                'email' => '' . $user->getEmail() . '',
                'firstName' => '' . $user->getFirstName() . '',
                'lastName' => '' . $user->getLastName() . '',
            );

            $response = new JsonResponse(
                $data,
                '201'
            );
            $response->headers->set('Content-Type', 'application/ld+json');
            $event->setResponse($response);
        }
        else {
            return;
        }
    }
}