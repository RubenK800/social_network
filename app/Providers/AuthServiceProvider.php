<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //

        Gate::define('update-comment', function (User $user, PostComment $comment) {
            return $user->id === $comment->writer_user_id;
        });

        Gate::define('delete-comment', function (User $user, PostComment $comment) {
            return $user->id === $comment->writer_user_id;
        });
    }
}
