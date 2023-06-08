<?php
namespace Controller\Listener;

use App\Entity\Property;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ListenerSubcriber implements EventSubscriber
{
    private $cache;
    private $helper;
    public function __construct(CacheManager $cache,UploaderHelper $helper)
    {
        $this->cache=$cache;
        $this->helper=$helper;
    }
    public function getSubscribedEvents(){
        return[
            'preRemove',
            'preUpdate'
        ];
    }
    public function preRemove(PreRemoveEventArgs $eventArgs){
        if(!$eventArgs->getObject() instanceof Property){
            return ;
       }
     $this->cache->remove($this->helper->asset($eventArgs->getObject(),'imageFile'));
    }
    public function preUpdate(PreUpdateEventArgs $eventArgs){
        if(!$eventArgs->getObject() instanceof Property){
             return ;
        }
       if($eventArgs->getObject()->getImageFile() instanceof UploadedFile){
        $this->cache->remove($this->helper->asset($eventArgs->getObject(),'imageFile'));
       }
    }
}
