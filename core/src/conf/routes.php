<?php

use App\webui\actions\api\GetCategoriesApiAction;
use App\webui\actions\api\GetCategoryEventsApiAction;
use App\webui\actions\api\GetEventByIdApiAction;
use App\webui\actions\api\GetEventsApiAction;
use App\webui\actions\CreerCategorie\GetCategoryPersoAction;
use App\webui\actions\CreerCategorie\PostCategoryPersoAction;
use App\webui\actions\GetCreateEventAction;
use App\webui\actions\GetEventsAction;
use App\webui\actions\GetHomeAction;
use App\webui\actions\PostCreateEventAction;

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

    //-----------POST-----------//
    $app->post('/create-event', PostCreateEventAction::class)
        ->setName('post_create_event');
    $app->post('/create-category-perso', PostCategoryPersoAction::class)
        ->setName('post_create_category_perso');

    //-----------API-----------//
    $app->get("/api/categories", GetCategoriesApiAction::class)
        ->setName('api_categories');
    $app->get("/api/events", GetEventsApiAction::class)
        ->setName('api_events');
    $app->get("/api/category/{category_id}/events", GetCategoryEventsApiAction::class)
        ->setName('api_category_events');
    $app->get("/api/event/{id}", GetEventByIdApiAction::class)
        ->setName("api_event_by_id");
    return $app;
};