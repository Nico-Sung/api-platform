<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {

        $payload = $event->getData();
        
        $user = $event->getUser();


        if (method_exists($user, 'getFirstName')) {
            $payload['firstname'] = $user->getFirstName();
        }

        $event->setData($payload);
    }
}