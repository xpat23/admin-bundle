<?php

namespace Xpat\AdminBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Xpat\AdminBundle\Classes\CrudParameters;

interface CrudControllerInterface
{
    public function indexAction(Request $request);

    public function newAction(Request $request);

    public function editAction(Request $request, $id);

    public function deleteAction(Request $request, $id);

    public function setContainer(ContainerInterface $container);

    public function setParams(CrudParameters $parameters);

}