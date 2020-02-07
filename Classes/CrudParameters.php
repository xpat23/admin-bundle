<?php


namespace Xpat\AdminBundle\Classes;


class CrudParameters
{
    protected $refId;

    protected $name;

    protected $viewName = '@XpatAdmin/CrudFactory';

    protected $entity;

    protected $formType = 'Xpat\AdminBundle\Form\ReferenceSimpleType';

    protected $baseLayout;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }

    /**
     * @param string $viewName
     */
    public function setViewName($viewName)
    {
        $this->viewName = $viewName;
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;
    }

    /**
     * @return mixed
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * @param mixed $refId
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;
    }

    /**
     * @return mixed
     */
    public function getBaseLayout()
    {
        return $this->baseLayout;
    }

    /**
     * @param mixed $baseLayout
     */
    public function setBaseLayout($baseLayout): void
    {
        $this->baseLayout = $baseLayout;
    }
}