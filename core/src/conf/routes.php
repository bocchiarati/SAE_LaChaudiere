<?php

use app\webui\actions\GetCreateEventAction;
use App\webui\actions\GetHomeAction;
use app\webui\actions\PostCreateEventAction;

return function ($app) {

    //-----------GET-----------//
    $app->get('/', GetHomeAction::class)
        ->setName('homepage');
    $app->get('/create_event', GetCreateEventAction::class)
        ->setName('create-event');

    //-----------POST-----------//
    $app->post('/create_event', PostCreateEventAction::class)
        ->setName('post-create-event');

    return $app;
};