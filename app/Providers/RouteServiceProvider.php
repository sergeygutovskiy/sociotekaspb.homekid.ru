<?php

namespace App\Providers;

use App\Models\Job\Variant\EduProgram;
use App\Models\Job\Variant\SocialProject;
use App\Models\Job\Variant\SocialWork;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        Route::bind('user', fn($id) => User::findOrFail($id));
        
        Route::bind('social_project', fn($id, $route) => SocialProject::findOrFailByUser($id, $route->parameter('user')->id));
        Route::bind('social_project_deleted', fn($id, $route) => SocialProject::findDeletedOrFailByUser($id, $route->parameter('user')->id));
        Route::bind('social_project_optional_deleted', fn($id, $route) => SocialProject::findOptionalDeletedOrFailByUser($id, $route->parameter('user')->id));

        Route::bind('edu_program', fn($id, $route) => EduProgram::findOrFailByUser($id, $route->parameter('user')->id));
        Route::bind('edu_program_deleted', fn($id, $route) => EduProgram::findDeletedOrFailByUser($id, $route->parameter('user')->id));
        Route::bind('edu_program_optional_deleted', fn($id, $route) => EduProgram::findOptionalDeletedOrFailByUser($id, $route->parameter('user')->id));

        Route::bind('social_work', fn($id, $route) => SocialWork::findOrFailByUser($id, $route->parameter('user')->id));
        Route::bind('social_work_deleted', fn($id, $route) => SocialWork::findDeletedOrFailByUser($id, $route->parameter('user')->id));
        Route::bind('social_work_optional_deleted', fn($id, $route) => SocialWork::findOptionalDeletedOrFailByUser($id, $route->parameter('user')->id));


        $this->routes(function () {
            Route::prefix('api/client/v1')
                ->middleware('api')
                ->group(base_path('routes/client/v1/api.php'));
            
                Route::prefix('api/admin/v1')
                ->middleware([ 'api', 'auth:sanctum', 'auth.admin'])
                ->group(base_path('routes/admin/v1/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(120)->by($request->user()?->id ?: $request->ip());
        });
    }
}
