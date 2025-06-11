<?php

use App\api\GetApiHelp;
use App\api\GetCategoriesApi;
use App\api\GetCategoryEventsApi;
use App\api\GetEventByIdApi;
use App\api\GetEventsApi;
use App\webui\actions\auth\GetSigninAction;
use App\webui\actions\auth\PostSigninAction;
use App\webui\actions\CreerCategorie\GetCategoryPersoAction;
use App\webui\actions\CreerCategorie\PostCategoryPersoAction;
use App\webui\actions\GetCreateEventAction;
use App\webui\actions\GetEventsAction;
use App\webui\actions\GetHomeAction;
use App\webui\actions\GetUnvalideUserAction;
use App\webui\actions\PostCreateEventAction;
use App\webui\actions\PostPublishEventAction;
use App\webui\actions\Register\GetCreerCompteAction;
use App\webui\actions\Register\PostCreerCompteAction;
use App\webui\actions\auth\GetSignOutAction;

return function ($app) {

    //-----------GET-----------//
    $app->get('/', GetHomeAction::class)
        ->setName('homepage');
    $app->get('/create-event', GetCreateEventAction::class)
        ->setName('create_event');
    $app->get('/create-category-perso', GetCategoryPersoAction::class)
        ->setName('create_category_perso');
    $app->get('/events', GetEventsAction::class)
        ->setName('events');
    $app->get('/signin', GetSigninAction::class)
        ->setName('signin');
    $app->get('/creer-compte', GetCreerCompteAction::class)
        ->setName('creer_compte');
    $app->get('/signout', GetSignOutAction::class)
        ->setName('signout');
    $app->get('/unvalide_user', GetUnvalideUserAction::class)
        ->setName('unvalide_user');

    //-----------POST-----------//
    $app->post('/create-event', PostCreateEventAction::class)
        ->setName('post_create_event');
    $app->post('/create-category-perso', PostCategoryPersoAction::class)
        ->setName('post_create_category_perso');
    $app->post('/signin', PostSigninAction::class)
        ->setName('post_signin');
    $app->post('/creer-compte', PostCreerCompteAction::class)
        ->setName('post_creer_compte');
    $app->post('/events', PostPublishEventAction::class)
        ->setName('post_publish_event');

    //-----------API-----------//
    $app->get("/api", GetApiHelp::class)
        ->setName('api_help');
    $app->get("/api/categories", GetCategoriesApi::class)
        ->setName('api_categories');
    $app->get("/api/events", GetEventsApi::class)
        ->setName('api_events');
    $app->get("/api/category/{category_id}/events", GetCategoryEventsApi::class)
        ->setName('api_category_events');
    $app->get("/api/event/{id}", GetEventByIdApi::class)
        ->setName("api_event_by_id");

    return $app;
};