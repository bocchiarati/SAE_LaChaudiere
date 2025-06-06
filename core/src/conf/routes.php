<?php

use App\webui\actions\API\GetCategoriesApiAction;
use App\webui\actions\API\GetEventsApiAction;
use App\webui\actions\CreerCategorie\GetCategoryPersoAction;
use App\webui\actions\CreerCategorie\PostCategoryPersoAction;
use App\webui\actions\GetCreateEventAction;
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

    //-----------POST-----------//
    $app->post('/create-event', PostCreateEventAction::class)
        ->setName('post_create_event');
    $app->post('/create-category-perso', PostCategoryPersoAction::class)
        ->setName('post_create_category_perso');

    //-----------API-----------//
    $app->get("/api/categories", GetCategoriesApiAction::class)
        ->setName('api_categories');
    $app->get("/api/category/{category_id}/events", GetEventsApiAction::class)
        ->setName('api_category_events');
    return $app;
};