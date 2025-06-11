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


$app->add(function ($request, $handler) use ($app, $twig) {
    $container = $app->getContainer();

        /** @var AuthnProviderInterface $authnProvider */
    $authnProvider = $container->get(AuthnProviderInterface::class);

    // Récupérer l'utilisateur à partir de l'email stocké en session
    $user = $authnProvider->getSignedInUser();

    // Injecter dans Twig
    $twig->getEnvironment()->addGlobal('user', $user);

    return $handler->handle($request);
});


$app->add(TwigMiddleware::create($app, $twig));
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;