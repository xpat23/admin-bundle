<?php


namespace Xpat\AdminBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Xpat\AdminBundle\Classes\CrudParameters;
use Xpat\AdminBundle\Controller\CrudBaseController;
use Xpat\AdminBundle\Controller\CrudControllerInterface;

class ControllerBuilder
{
    private $configProvider;
    private $container;

    public function __construct(ConfigProvider $configProvider, ContainerInterface $container)
    {
        $this->container = $container;
        $this->configProvider = $configProvider;
    }

    public function build(string $refId)
    {
        $array = $this->configProvider->getConfig();

        if (isset($array["references"]) and isset($array["references"][$refId])) {
            $data = $array["references"][$refId];
            $params = new CrudParameters();
            $params->setBaseLayout($this->container->getParameter('base_layout'));
            if (isset($data["name"]) and isset($data["entity"])) {
                $params->setEntity($data["entity"]);
                $params->setName($data["name"]);
                $params->setRefId($refId);
                $params->setViewName($data["viewName"] ?? $params->getViewName());
                $params->setFormType($data["formType"] ?? $params->getFormType());
                $controllerClass = $data['controller'] ?? CrudBaseController::class;
                /** @var CrudControllerInterface $controller */
                $controller = new $controllerClass();
                $controller->setParams($params);
                $controller->setContainer($this->container);
                return $controller;

            }
            throw new \Exception($this->configProvider->getConfigSource() . " file is not correct yml");

        }
        throw new \Exception("reference \"{$refId}\" is not found in file " . $this->configProvider->getConfigSource());
    }

}