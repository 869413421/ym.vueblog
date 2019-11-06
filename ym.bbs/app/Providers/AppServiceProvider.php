<?php

namespace App\Providers;

use App\Models\Collection;
use App\Models\Comment;
use App\Models\Good;
use App\Observers\CollectionObserver;
use App\Observers\CommentObserver;
use App\Observers\GoodObserver;
use Carbon\Carbon;
use Dingo\Api\Facade\API;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        API::error(function (AuthorizationException $exception)
        {
            //如果出现权限异常，请先检查策略是否有再服务提供者中进行绑定
            abort(403, $exception->getMessage());
        });

        API::error(function (AuthenticationException $exception)
        {
            abort(401, $exception->getMessage());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');
        Comment::observe(CommentObserver::class);
        Good::observe(GoodObserver::class);
        Collection::observe(CollectionObserver::class);

        app('Dingo\Api\Transformer\Factory')->setAdapter(function ($app)
        {
            $fractal = new \League\Fractal\Manager;
            $fractal->setSerializer(new \League\Fractal\Serializer\ArraySerializer);
            return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
        });
    }
}
