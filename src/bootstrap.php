<?php
define(CACHE_DIR, __DIR__.'/../resource/cache');
define(RESOURCE_DIR, __DIR__.'/../resource');

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/../resource/views', [
        // 'cache' => __DIR__.'/../resource/cache/views'
        'cache' => false
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};
