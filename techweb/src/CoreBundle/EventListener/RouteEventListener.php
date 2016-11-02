<?php
namespace CoreBundle\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RouteEventListener
{
    private $router;
    private $container;

    public function __construct($router, $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $_route  = $request->attributes->get('_route');
        $user = $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');

        if(($_route === 'fos_user_security_login' || $_route === 'fos_user_registration_register') && $user) {
            $event->setResponse(new RedirectResponse($this->router->generate('homepage')));
        }
    }
}