<?php


namespace App\Subscribers;


use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class ArticleSubscriber implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private Security $security;

    /**
     * ArticleSubscriber constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {

        $this->security = $security;
    }
    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityUpdatedEvent::class => ['test'],
            BeforeEntityPersistedEvent::class => ['setUser']
        ];
    }
    public function test(BeforeEntityUpdatedEvent $event){
        $entity = $event->getEntityInstance();
        if($entity instanceof Article){

        }
    }
    public function setUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if($entity instanceof Article){
            $entity->setAuthor($this->security->getUser());
        }
    }
}