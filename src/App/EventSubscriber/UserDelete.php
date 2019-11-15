<?php


namespace App\App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class UserDelete implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['checkUserDeleted', EventPriorities::POST_WRITE],
        ];
    }

    public function checkUserDeleted(ViewEvent $event): void
    {
        $pathInfo = $event->getRequest()->getPathInfo();
        if (strpos($pathInfo, '/api/users/') === false && $event->getRequest()->getMethod() !== 'DELETE') {
            return;
        }

            $data['data'] = array(
                'message' => 'Utilisateur correctement supprimé !',
            );

            $response = new JsonResponse(
                $data,
                '200'
            );
            $response->headers->set('Content-Type', 'application/ld+json');
            $event->setResponse($response);
    }
}