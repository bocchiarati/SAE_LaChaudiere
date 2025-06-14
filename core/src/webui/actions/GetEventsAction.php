<?php

namespace App\webui\actions;


use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\useCases\interfaces\AppServiceInterface;

use App\webui\providers\interfaces\FormBuilderInterface;
use App\webui\providers\interfaces\CsrfTokenProviderInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur pour obtenir la liste des événement triés par date
 */
class GetEventsAction extends AbstractAction
{
    private AppServiceInterface $appService;

    public function __construct(AppServiceInterface $appService, FormBuilderInterface $formBuilder, CsrfTokenProviderInterface $csrfProvider)
    {
        $this->appService = $appService;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        $events = $this->appService->getEventsSortByDate();
        $categories = $this->appService->getCategories();

        return $twig->render($response, 'event/index.html.twig', [
            "eventsByDate" => $events,
            "categories" => $categories
        ]);
    }
}