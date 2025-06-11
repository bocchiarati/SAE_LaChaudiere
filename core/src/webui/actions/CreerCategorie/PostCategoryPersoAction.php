<?php

namespace App\webui\actions\CreerCategorie;

use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostCategoryPersoAction extends AbstractAction{

    private AppServiceInterface $appService;

    public function __construct(AppServiceInterface $appService){
        $this->appService = $appService;
    }

    public function __invoke(Request $request, Response $response, array $args){
        $twig = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $libelle = $data['libelle'];
        $description = $data['description'];

        $this->appService->creerCategory($libelle,$description);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('homepage');
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}