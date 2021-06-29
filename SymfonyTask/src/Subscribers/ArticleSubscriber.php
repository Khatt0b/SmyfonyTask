<?php


namespace App\Subscribers;


use App\Entity\Article;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class ArticleSubscriber implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private Security $security;
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * ArticleSubscriber constructor.
     * @param Security $security
     */
    public function __construct(Security $security,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder=$passwordEncoder;
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
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
            $entity->setSlug(strtolower(preg_replace('/\s+/', '_', $entity->getTitle())));
        }
        if($entity instanceof User){
            $entity->setPassword(
                $this->passwordEncoder->encodePassword(
                    $entity,
                    $entity->getPassword()
                )
            );
            $entity->setSlug(strtolower(preg_replace('/\s+/', '_', $entity->getUsername())));
        }
    }
}