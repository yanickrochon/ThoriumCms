<?php
return array(
    'speckcms' => array(
        'page_model_class'          => 'SpeckCms\Model\Page',
    ),

    'router' => array(
        'routes' => array(
            'speckcms' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/page/[:page]',
                    'constraints' => array(
                        'page'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'speckcms/index',
                        'action'     => 'index',
                        'page'       => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controller' => array(
        'classes' => array(
            'speckcms/index' => 'SpeckCms\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
