<?php

use App\webui\actions\GetHomeAction;

return function ($app) {

    //-----------GET-----------//
    $app->get('/', GetHomeAction::class)
        ->setName('homepage');

    //-----------POST-----------//

    return $app;
};