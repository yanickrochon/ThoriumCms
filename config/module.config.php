<?php
return array(
    'thoriumcms' => array(
        'page_model_class'          => 'ThoriumCms\Model\Page',
        'page_content_model_class'  => 'ThoriumCms\Model\PageContent',
    ),

    'router' => array(
        'routes' => array(
            'thoriumcms' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'priority' => 1000,
                'options' => array(
                    'route'    => '/page[/[:page]]',
                    'constraints' => array(
                        'page'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'thoriumcms/page',
                        'action'     => 'index',
                        'page'       => 'index',
                    ),
                ),
            ),
            'thoriumcms_admin' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'priority' => 1000,
                'options' => array(
                    'route'    => '/page-admin[/[:page]]',
                    'constraints' => array(
                        'page'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'thoriumcms/admin',
                        'action'     => 'index',
                        'page'       => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controller' => array(
        'classes' => array(
            'thoriumcms/page'  => 'ThoriumCms\Controller\PageController',
            'thoriumcms/admin' => 'ThoriumCms\Controller\AdminController',
        ),
    ),

    'service_manager' => array(
        'aliases' => array(
            'thoriumcms_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
