<?php
return array(
    'router' => array(
        'routes' => array(
            'application' => array(
                'type'=> 'Segment',
                'options' => array(
                    'route' => '/[:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Product\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'id' => '[0-9]*'
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array (
        'invokables' => array(
            'Product\Controller\Index' => 'Product\Controller\IndexController'
        )
    ),
    'view_manager' => array (
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'FlashHelper' => 'Product\View\Helper\FlashHelper'
        )
    ),
    'doctrine' => array(
          'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Product/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Product\Entity' => 'application_entities'
                ),
            ),
        ),
    )
);