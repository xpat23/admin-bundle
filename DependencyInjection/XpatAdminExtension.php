<?php

namespace Xpat\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Xpat\AdminBundle\Controller\CrudFactoryController;
use Xpat\AdminBundle\Service\ConfigProvider;
use Xpat\AdminBundle\Service\ControllerBuilder;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class XpatAdminExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter("pages_config_file",$config['pages_config_file']);
        $container->setParameter("base_layout",$config['base_layout']);

        $this->addAnnotatedClassesToCompile([
            CrudFactoryController::class
        ]);
    }
}
