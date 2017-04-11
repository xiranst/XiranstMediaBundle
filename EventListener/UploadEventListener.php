<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/9/17
 * Time: 2:07 PM
 */

namespace Xiranst\Bundle\MediaBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Xiranst\Bundle\MediaBundle\Event\PostUploadEvent;
use Xiranst\Bundle\MediaBundle\Upload\Service\UploadService;

class UploadEventListener
{
    /**
     * @var ObjectManager
     */
    private $om;
    private $uploadService;

    public function __construct(ObjectManager $om, $uploadService)
    {
        $this->om = $om;
        $this->uploadService = $uploadService;
    }

    public function onUpload(PostUploadEvent $event)
    {
        $file = $event->getFile();
        $uploadedFile = $this->uploadService->upload($file);
        $response = $event->getResponse();
        $response->setContent($uploadedFile['fileName']);
        return $response;
    }
}