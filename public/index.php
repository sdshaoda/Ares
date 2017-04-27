<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

//$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
//$twig = new Twig_Environment($loader, array(
//    'cache' => __DIR__ . 'compilation_cache',
//));

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
//        'cache' => __DIR__ . '/../compilation_cache'
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};


require __DIR__ . '/../src/dependencies.php';

require __DIR__ . '/../src/middleware.php';

require __DIR__ . '/../src/routes.php';

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'index.html', [
        'name' => $args['name']
    ]);
})->setName('index');

$app->run();