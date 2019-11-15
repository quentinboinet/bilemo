<?php


namespace App\App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class UserManager implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['checkUserAvailability', EventPriorities::POST_READ],
        ];
    }

    public function checkUserAvailability(ExceptionEvent $event): void
    {
        $pathInfo = $event->getRequest()->getPathInfo();
        if (strpos($pathInfo, '/api/users/') === false) {
            return;
        }

        $data['data'] = array(
            'erreur' => "Erreur ! L'utilisateur n'existe pas.",
        );

        $response = new JsonResponse(
            $data,
            '404'
        );
        $response->headers->set('Content-Type', 'application/ld+json');
        $event->setResponse($response);
    }
}