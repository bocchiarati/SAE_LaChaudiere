<?php

namespace App\webui\actions\auth;

use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\providers\interfaces\FormBuilderInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetSigninAction extends AbstractAction{

    private FormBuilderInterface $formBuilder;
    private AuthnProviderInterface $authnProvider;

    public function __construct(FormBuilderInterface $formBuilder, AuthnProviderInterface $authnProvider){
        $this->formBuilder = $formBuilder;
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args){
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildSignInForm()
        ]);
    }

}