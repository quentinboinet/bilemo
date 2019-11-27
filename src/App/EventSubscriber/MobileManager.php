<?php


namespace App\App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class MobileManager implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['checkMobileAvailability', EventPriorities::POST_READ],
        ];
    }

    public function checkMobileAvailability(ExceptionEvent $event): void
    {
        $pathInfo = $event->getRequest()->getPathInfo();

        if (strpos($pathInfo, '/api/mobiles/') === false || !$event->getRequest()->isMethodSafe(false)) {
            return;
        }

        $data['data'] = array(
            'erreur' => "Erreur ! Le téléphone demandé n'existe pas.",
        );

        $response = new JsonResponse(
            $data,
            '404'
        );
        $response->headers->set('Content-Type', 'application/ld+json');
        $event->setResponse($response);
    }
}