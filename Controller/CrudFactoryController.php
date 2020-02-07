<?php

namespace Xpat\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;
use Xpat\AdminBundle\Classes\CrudParameters;
use Xpat\AdminBundle\Service\ConfigProvider;
use Xpat\AdminBundle\Service\ControllerBuilder;

class CrudFactoryController extends Controller
{

    protected $builder;

    /**
     * @var ControllerBuilder
     * @required
     */
    public function setBuilder(ControllerBuilder $builder)
    {
        $this->builder = $builder;
    }
    /**
     * @param Request $request
     * @param $refId
     * @return Response
     * @Route("/{refId}", name="crud_factory_index")
     */
    public function indexAction(Request $request, $refId)
    {
        return $this->builder->build($refId)->indexAction($request);
    }

    /**
     * @param Request $request
     * @param $refId
     * @return Response
     * @Route("/new/{refId}", name="crud_factory_new")
     */
    public function newAction(Request $request, $refId)
    {
        return $this->builder->build($refId)->newAction($request);
    }

    /**
     * @param Request $request
     * @param $refId
     * @param $id
     * @return Response
     * @Route("/edit/{refId}/{id}", name="crud_factory_edit")
     */
    public function editAction(Request $request, $refId, $id)
    {
        return $this->builder->build($refId)->editAction($request, $id);
    }

    /**
     * @param Request $request
     * @param $refId
     * @param $id
     * @return Response
     * @Route("/delete/{refId}/{id}", name="crud_factory_delete")
     */
    public function deleteAction(Request $request, $refId, $id)
    {
        return $this->builder->build($refId)->deleteAction($request, $id);
    }


}