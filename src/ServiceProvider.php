<?php

namespace Jezzdk\StatamicGitSync;

use Gitonomy\Git\Repository as GitRepository;
use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    public function register()
    {
        app()->singleton(GitRepository::class, function () {
            $name = config('statamic.git.user.name');
            $email = config('statamic.git.user.email');

            return new GitRepository(base_path(), [
                'environment_variables' => [
                    'GIT_AUTHOR_NAME' => $name,
                    'GIT_AUTHOR_EMAIL' => $email,
                    'GIT_COMMITTER_NAME' => $name,
                    'GIT_COMMITTER_EMAIL' => $email,
                ],
            ]);
        });
    }

    public function boot()
    {
        parent::boot();

        Nav::extend(function ($nav) {
            $nav->tools('Git Sync')
            ->route('git-sync.status')
            ->icon('git');
        });
    }
}
