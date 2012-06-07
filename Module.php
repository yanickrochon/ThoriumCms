<?php

namespace SpeckCms;

use Zend\ModuleManager\ModuleManager,
    Zend\EventManager\StaticEventManager,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements 
    AutoloaderProviderInterface, 
    ConfigProviderInterface, 
    ServiceProviderInterface
{
    protected static $options;

    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->events()->attach('loadModules.post', array($this, 'modulesLoaded'));
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfiguration()
    {
        return array(
            'factories' => array(
                'speckcms_page_service' => function ($sm) {
                    $service = new Service\Page;
                    $service->setPageMapper($sm->get('speckcms_page_mapper'));
                    $service->setPageContentMapper($sm->get('speckcms_pagecontent_mapper'));
                    return $service;
                },

                'speckcms_page_mapper' => function ($sm) {
                    $adapter = $sm->get('speckcms_zend_db_adapter');
                    $tg = new \Zend\Db\TableGateway\TableGateway('page', $adapter);
                    return new Model\PageMapper($tg);
                },

                //'speckcms_pagecontent_mapper' => function ($sm) {
                //    $adapter = $sm->get('speckcms_zend_db_adapter');
                //    $tg = new \Zend\Db\TableGateway\TableGateway('page_content', $adapter);
                //    return new Model\PageContentMapper($tg);
                //},
            ),
        );
    }

    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['speckcms'];
    }

    /**
     * @TODO: Come up with a better way of handling module settings/options
     */
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        return static::$options[$option];
    }
}
