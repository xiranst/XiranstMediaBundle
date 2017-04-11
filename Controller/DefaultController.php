<?php

namespace Xiranst\Bundle\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('XiranstMediaBundle:Default:index.html.twig');
    }
}
