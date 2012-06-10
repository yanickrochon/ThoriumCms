<?php
return array(
    'thoriumcms' => array(
        'page_model_class'          => 'ThoriumCms\Model\Page',
        'page_content_model_class'  => 'ThoriumCms\Model\PageContent',
    ),

    'router' => array(
        'routes' => array(
            //'testroute' => array(
            //    'type'    => 'ThoriumCms\Router\Page',
            //    'options' => array(
            //        'route'    => '/page',
            //        'defaults' => array(
            //            'controller' => 'thoriumcms/page',
            //            'action'     => 'index',
            //            'page'       => 'index',
            //        ),
            //    ),
            //),
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
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/page-admin',
                    'defaults' => array(
                        'controller' => 'thoriumcms/admin',
                        'action'     => 'edit',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'edit' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => '/edit[/[:page]]',
                            'constraints' => array(
                                'page'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'thoriumcms/admin',
                                'action'     => 'edit',
                                'page'       => 'index',
                            ),
                        ),
                    ),
                    'save' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route'    => '/save',
                            'defaults' => array(
                                'controller' => 'thoriumcms/admin',
                                'action'     => 'save',
                            ),
                        ),
                    )
                ),
            ),
        ),
    ),
    'controller' => array(
        'classes' => array(
            'thoriumcms/page'  => 'ThoriumCms\Controller\PageController',
            'thoriumcms/admin' => 'ThoriumCms\Controller\AdminController',
        ),
        'map' => array(
            'thoriumCmsPageAccess' => 'ThoriumCms\Controller\Plugin\ThoriumCmsPageAccess',
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
