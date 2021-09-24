<?php

namespace App\EventSubscriber;

use App\Entity\Project;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{


    public function __construct()
    {
       
    }
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setProjectDate'],
        ];
    }
    public function setProjectDate(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Project)){
            return;
        }

        $now = new DateTime('now');
        $entity->setdate($now);
    }
}