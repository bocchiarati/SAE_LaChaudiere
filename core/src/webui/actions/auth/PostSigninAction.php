<?php

namespace App\webui\actions\auth;


use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\useCases\AppService;
use App\webui\actions\abstract\AbstractAction;
use App\webui\providers\interfaces\AuthnProviderInterface;
use App\application_core\application\exceptions\AuthenticationException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostSigninAction extends AbstractAction{

    private AuthnProviderInterface $authnProvider;

    public function __construct(AuthnProviderInterface $authnProvider){
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = $data['password'];

        try {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new AuthenticationException("email invalide");
            }
        } catch(AuthenticationException $e){
            return $twig->render($response, 'error/index.html.twig', ["code" => 401, "message" => "Erreur lors de l'authentification, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        }

        try{
            $this->authnProvider->signin($email, $password);
        } catch(DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        } catch(AuthenticationException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 401, "message" => "Erreur lors de l'authentification, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('homepage');
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}