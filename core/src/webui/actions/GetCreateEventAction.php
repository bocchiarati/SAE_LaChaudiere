<?php

namespace App\webui\actions;


use App\application_core\application\useCases\interfaces\FormBuilderInterface;
use App\webui\actions\Abstract\AbstractAction;
use App\webui\providers\interfaces\CsrfTokenProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur pour obtenir le formualire de création d'un événement.
 */
class GetCreateEventAction extends AbstractAction
{
    private FormBuilderInterface $formBuilder;
    private CsrfTokenProviderInterface $csrfProvider;
    public function __construct(FormBuilderInterface $formBuilder, CsrfTokenProviderInterface $csrfProvider) {
        $this->formBuilder = $formBuilder;
        $this->csrfProvider = $csrfProvider;
    }
    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildCreateEventForm(),
            "token" => $this->csrfProvider->generate()
        ]);
    }
}