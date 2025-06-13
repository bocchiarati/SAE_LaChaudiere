<?php

use App\infrastructure\Eloquent;
use App\webui\providers\interfaces\AuthnProviderInterface;
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Error\LoaderError;

session_start();
try {
    Eloquent::init(__DIR__ . '/db.ini');
} catch (Exception $e) {
}

try {
    $twig = Twig::create(__DIR__ . '/../webui/views/',
        ['cache' => 'path/to/cache-dir',
            'auto_reload' => true]);
} catch (LoaderError $e) {
}

$container = new Container();
$app = (require_once __DIR__ . '/dependencies.php')($container);


AppFactory::setContainer($container);
$app = AppFactory::create();

$app->add(function($request, $handler) use ($app) {
    $handler->handle($request);
    return $handler->handle($request)
        ->withHeader('Access-Control-Allow-Origin', '*') // CORS
        ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization');
});


$app->add(function ($request, $handler) use ($app, $twig) {
        /** @var AuthnProviderInterface $authnProvider */
    $authnProvider = $app->getContainer()->get(AuthnProviderInterface::class);

    // Injecter dans Twig
    $twig->getEnvironment()->addGlobal('user', $authnProvider->getSignedInUser());
    $twig->getEnvironment()->addGlobal('verify_user', $authnProvider->verifyUser());

    return $handler->handle($request);
});

$app->add(function ($request, $handler) use ($app, $twig) {
    $container = $app->getContainer();

    /** @var AuthnProviderInterface $authnProvider */
    $authnProvider = $container->get(AuthnProviderInterface::class);

    // Affecte à la variable isSudo true or false si l'utilisateur est un super admin
    $isSudo = $authnProvider->isSudo();

    // Ajoute à Twig la variable si l'utilisateur est super admin
    $twig->getEnvironment()->addGlobal('isSudo', $isSudo);

    return $handler->handle($request);
});


$app->add(TwigMiddleware::create($app, $twig));
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;