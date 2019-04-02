<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 12-Jan-19
 * Time: 15:52
 */

namespace Settings\Domain\Services\EventListeners;


use Settings\Domain\Services\Exceptions\DomainException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DomainExceptionSubscriber implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => 'onResourceException'
        );
    }

    public function onResourceException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();
        if (!$e instanceof DomainException) {
            return;
        }
        $response = new JsonResponse(
            $e->getArray(),
            $e->getStatusCode()
        );
        $response->headers->set('Content-Type', 'application/problem+json');
        $event->setResponse($response);
    }
}
