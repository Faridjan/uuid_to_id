<?php

use App\Http\Action\HomeAction;
use Slim\App;

return static function (App $app) {
    $app->get('/', HomeAction::class);
};
