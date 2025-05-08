<?php

namespace App\EventListener;

use App\Entity\User; // On veut les infos des utilisateurs 
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $user = $event->getUser();
        $payload = $event->getData();
        if (!$user instanceof User) {
            return;
        }
        $payload['userid'] = $user->getId();
        $payload['roles'] = $user->getRoles();
        $event->setData($payload);
    }
}