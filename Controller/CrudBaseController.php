<?php
/**
 * Created by PhpStorm.
 * User: xpat
 * Date: 17.04.19
 * Time: 21:00
 */

namespace Xpat\AdminBundle\Controller;


use AppBundle\Entity\SimpleReference;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xpat\AdminBundle\Classes\CrudParameters;

class CrudBaseController extends Controller implements CrudControllerInterface
{
    /**
     * @var CrudParameters
     */
    protected $parameters;


    /**
     * @param CrudParameters $parameters
     */
    public function setParams(CrudParameters $parameters)
    {
        $this->parameters = $parameters;
    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository($this->parameters->getEntity())
            ->createQueryBuilder('q')
            ->orderBy('q.id', 'ASC')->getQuery();
        $paginator = $this->get("knp_paginator");
        $pagination = $paginator->paginate($query, $request->get("page", 1), 25);

        return $this->render($this->parameters->getViewName() . '/index.html.twig', array(
            'pagination' => $pagination,
            'params' => $this->parameters,
            "fields" => $this->getListFields(),
            "this" => $this
        ));

    }

    public function getListFields(): array
    {
        return [
            "id" => function ($entity, $index) {
                /** @var  $entity SimpleReference */
                return $entity->getId();
            },
            "Название" => function ($entity, $index) {
                /** @var  $entity SimpleReference */
                return $entity->getName();
            },
        ];

    }


    public function newAction(Request $request)
    {
        $class = $this->parameters->getEntity();
        $entity = new $class();
        return $this->formProcess($request, $entity, "new.html.twig");
    }


    public function editAction(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository($this->parameters->getEntity())->find($id);
        if (!$entity) {
            throw  $this->createNotFoundException('Запись не найдена');
        }

        return $this->formProcess($request, $entity, "edit.html.twig");
    }

    /**
     * @param Request $request
     * @param $entity
     * @return RedirectResponse|Response
     */
    private function formProcess(Request $request, $entity, $view)
    {
        $form = $this->createForm($this->parameters->getFormType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->beforeSave($entity, $request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->afterSave($entity, $request);
            return $this->redirectToRoute('crud_factory_index', [
                "refId" => $this->parameters->getRefId()
            ]);
        }

        return $this->render($this->parameters->getViewName() . "/$view", array(
            'entity' => $entity,
            'form' => $form->createView(),
            'params' => $this->parameters,
        ));
    }


    public function deleteAction(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository($this->parameters->getEntity())->find($id);
        if (!$entity) {
            throw  $this->createNotFoundException('Запись не найдена');
        }

        $this->beforeDelete($entity);

        $em = $this->getDoctrine()->getManager();

        $em->remove($entity);

        $em->flush();

        $this->addFlash("success", "Запись удаелна");

        return $this->redirectToRoute('crud_factory_index', [
            "refId" => $this->parameters->getRefId()
        ]);
    }

    protected function beforeSave($entity, Request $request)
    {
    }

    protected function afterSave($entity, Request $request)
    {
    }

    protected function beforeDelete($entity)
    {
    }
}
