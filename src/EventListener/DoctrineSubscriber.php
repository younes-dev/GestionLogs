<?php

namespace App\EventListener;

use App\Entity\Log;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\RequestStack;

class DoctrineSubscriber implements EventSubscriber
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var RequestStack
     */
    private $request;


    public function __construct(LoggerInterface $dbLogger,RequestStack  $request)
    {
        $this->logger = $dbLogger;
        $this->request = $request;
    }


    /**
     * @return array|string[]
     */
    public function getSubscribedEvents():array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove
        ];
    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args):void
    {
        $this->log('Ajouté', $args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args):void
    {

        //dd( $this->request->getCurrentRequest()->attributes);
        $this->log('Modifié', $args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postRemove(LifecycleEventArgs $args):void
    {
        //dd( $this->request->getCurrentRequest()/*->get('id')*/);
        $this->log('Supprimé', $args);
    }

    /**
     * @param string $message
     * @param object $args
     */
    public function log(string $message, object $args):void
    {
        $id=$this->request->getCurrentRequest()->get('id');
        $entity = $args->getEntity();
        if (!($entity instanceof Log)) {
                $this->logger->info($id . $message);
        }

    }


}