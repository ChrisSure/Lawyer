<?php

namespace App\Common\Providers;

use App\Cabinet\Entity\Profile;
use App\Common\Entity\Articles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Common\Entity\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-panel', function (User $user) {
            return $user->isModerator() || $user->isAdmin() || $user->isSuperAdmin();
        });

        Gate::define('admin.users', function (User $user) {
            return $user->isSuperAdmin() || $user->isAdmin();
        });

        Gate::define('admin.setting', function (User $user) {
            return $user->isSuperAdmin() || $user->isAdmin();
        });

        Gate::define('manage-own-articles', function (User $user, Articles $article) {
            return (int)$article->author_id === $user->id;
        });

        Gate::define('manage-own-profile', function (User $user, Profile $profile) {
            return (int)$profile->user_id === $user->id;
        });

        Gate::define('manage-own-main', function (User $user, User $user_two) {
            return (int)$user_two->id === $user->id;
        });




    }
}
