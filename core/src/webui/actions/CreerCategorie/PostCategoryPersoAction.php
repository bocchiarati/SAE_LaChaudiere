<?php

namespace App\webui\actions\CreerCategorie;

use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\abstract\AbstractAction;
use App\webui\providers\interfaces\AuthnProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostCategoryPersoAction extends AbstractAction{

    private AppServiceInterface $appService;
    private AuthnProviderInterface $authnProvider;
    public function __construct(AppServiceInterface $appService, AuthnProviderInterface $authnProvider){
        $this->appService = $appService;
    }

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
        $libelle = $data['libelle'];
        $description = $data['description'];

        try {
            $this->appService->creerCategory($libelle,$description);
        } catch (\Throwable $th) {
            return $twig->render($response, 'error/index.html.twig', ["code" => 500, "message" => "Erreur interne du serveur, " . $th->getMessage() . " Veuillez essayer plus tard."]);
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('homepage');
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}