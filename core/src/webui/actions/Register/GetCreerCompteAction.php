<?php

namespace App\webui\actions\Register;

use App\webui\providers\interfaces\FormBuilderInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetCreerCompteAction extends AbstractAction {
    private FormBuilderInterface $formBuilder;

    public function __construct(FormBuilderInterface $formBuilder) {
        $this->formBuilder = $formBuilder;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildRegisterForm()
        ]);
    }
}