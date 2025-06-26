<?php

namespace App\webui\actions\Register;

use App\webui\providers\interfaces\FormBuilderInterface;
use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCreerCompteAction extends AbstractAction {
    private FormBuilderInterface $formBuilder;
    private AuthnProviderInterface $authnProvider;
    public function __construct(FormBuilderInterface $formBuilder, AuthnProviderInterface $authnProvider) {
        $this->formBuilder = $formBuilder;
        $this->authnProvider = $authnProvider;
        
    }

    public function __invoke(Request $request, Response $response, array $args) {
        $redirection = $this->authnProvider->verifyUser();
        if ($redirection !== null) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor($redirection);

            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        }

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildRegisterForm()
        ]);
    }
}