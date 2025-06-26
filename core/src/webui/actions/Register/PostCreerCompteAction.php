<?php

namespace App\webui\actions\Register;

use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\auth\AuthnService;
use App\webui\actions\abstract\AbstractAction;
use App\application_core\application\exceptions\AuthenticationException;
use App\webui\providers\interfaces\AuthnProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostCreerCompteAction extends AbstractAction {
    public function __construct(private AuthnProviderInterface $authnProvider) {}
    public function __invoke(Request $request, Response $response, array $args){
        $redirection = $this->authnProvider->verifyUser();
        if ($redirection !== null) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor($redirection);

            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        }

        $twig = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        try{
            $this->authnProvider->signinNewUser($email,$password);
        } catch(DatabaseException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $e->getMessage() . " Veuillez essayer plus tard."]);
        } catch(AuthenticationException $e) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 401, "message" => $e->getMessage()]);
        }


        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        // Générer l'URL depuis le nom de route
        $url = $routeParser->urlFor('homepage');
        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}