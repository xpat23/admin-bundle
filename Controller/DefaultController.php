<?php

namespace Xpat\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package Xpat\AdminBundle\Controller
 * @Route()
 */
class DefaultController extends Controller
{
    /**
     * @return Response
     * @Route("/xpat/admin")
     */
    public function indexAction()
    {
        return $this->render('@XpatAdmin/Default/index.html.twig');
    }
}
