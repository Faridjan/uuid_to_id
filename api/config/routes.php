<?php

declare(strict_types=1);

use App\Http\Action\HomeAction;
use App\Http\Action\Transformer\GoodsTransformer\AddAction as GoodsAddAction;
use App\Http\Action\Transformer\GoodsTransformer\GoodsTransformerAction;
use App\Http\Action\Transformer\UserTransformer\AddAction as UserAddAction;
use App\Http\Action\Transformer\UserTransformer\UserTransformerAction;
use Slim\App;

return static function (App $app) {
    $app->get('/', HomeAction::class);

    $app->get('/id/goods', GoodsTransformerAction::class);
    $app->get('/id/user', UserTransformerAction::class);

    $app->post('/goods_transformer/add', GoodsAddAction::class);
    $app->post('/user_transformer/add', UserAddAction::class);
};
