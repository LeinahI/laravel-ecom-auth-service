<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Passport::enablePasswordGrant();/* Enable Password Grant */
        Passport::tokensExpireIn(now()->addDays(30));/* Set token expiration to 30 days */
        Passport::refreshTokensExpireIn(now()->addDays(60));/* Set refresh token expiration to 30 days */
        Passport::personalAccessTokensExpireIn(now()->addDays(30));/* Set personal access token expiration to 30 days */

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
