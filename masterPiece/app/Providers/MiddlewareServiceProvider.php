<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\VerifiedCompanyMiddleware;
use App\Http\Middleware\RestrictCompanyAccessMiddleware;
use App\Http\Middleware\RedirectIfAdmin;
use Illuminate\Routing\Router;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('admin', AdminMiddleware::class);
        $router->aliasMiddleware('verified.company', VerifiedCompanyMiddleware::class);
        $router->aliasMiddleware('company.restrict', RestrictCompanyAccessMiddleware::class);
        $router->aliasMiddleware('redirect.if.admin', RedirectIfAdmin::class);

        // Apply the RedirectIfAdmin middleware globally
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(RedirectIfAdmin::class);
    }
}
