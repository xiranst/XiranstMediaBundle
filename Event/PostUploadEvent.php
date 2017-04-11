<?php

namespace Xiranst\Bundle\MediaBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostUploadEvent extends Event
{
    protected $file;
    protected $request;
    // protected $type;
    protected $response;
    // protected $config;

    public function __construct($file, Response $response, Request $request)
    {
        $this->file = $file;
        $this->request = $request;
        $this->response = $response;
        // $this->type = $type;
        // $this->config = $config;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getRequest()
    {
        return $this->request;
    }
    //
    // public function getType()
    // {
    //     return $this->type;
    // }
    //
    public function getResponse()
    {
        return $this->response;
    }

    public function getUploadedFileNames()
    {
        $result = false;
        if ($this->getResponse())
        {
            $response = $this->getResponse();
            $result = $response->getContent();
        }
        return $result;
    }
    //
    // public function getConfig()
    // {
    //     return $this->config;
    // }
}
