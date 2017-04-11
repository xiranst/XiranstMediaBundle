<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/10/17
 * Time: 11:33 PM
 */

namespace Xiranst\Bundle\MediaBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Xiranst\Bundle\MediaBundle\Service\UploadService;

class ThumbnailEventSubscriber implements EventSubscriberInterface
{
    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService    = $uploadService;
    }

    public static function getSubscribedEvents()
    {
        return array(
            // FormEvents::PRE_SET_DATA    => 'preSetData',
            // FormEvents::POST_SUBMIT     => 'postSubmit',
            // FormEvents::POST_SET_DATA   => 'postSetData',
            FormEvents::PRE_SUBMIT      => 'preSubmit',
            // FormEvents::SUBMIT          => 'submit'
        );
    }

    // public function preSetData(FormEvent $event) {}
    //
    // public function postSetData(FormEvent $event) {}

    public function preSubmit(FormEvent $event)
    {
        $parentForm     = $event->getForm()->getParent();
        $currentData    = $event->getData();
        $thumbnail      = $parentForm->getData()->getThumbnail();
        if ($currentData)
        {
            $uploadedFile = $this->uploadService->upload($currentData);
            $thumbnail = $uploadedFile['fileName'];
        }
        $parentForm->add('thumbnail', HiddenType::class);
        $parentForm->getData()->setThumbnail($thumbnail);
    }

    // public function submit(FormEvent $event) {}
}