<?php

namespace Lumen\Breeze\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breeze:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Breeze controllers and resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Install Inertia...
        $this->requireComposerPackages('illuminate/notifications:^8.73');

        // Controllers...
        copy(__DIR__.'/../../stubs/app/Http/Controllers/AuthController.php.stub', base_path('app/Http/Controllers/AuthController.php'));
        copy(__DIR__.'/../../stubs/app/Http/Controllers/HomeController.php.stub', base_path('app/Http/Controllers/HomeController.php'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(base_path('app/Http/Requests'));
        copy(__DIR__.'/../../stubs/app/Http/Requests/BaseRequest.php.stub', base_path('app/Http/Requests/BaseRequest.php'));
        copy(__DIR__.'/../../stubs/app/Http/Requests/ForgotPasswordRequest.php.stub', base_path('app/Http/Requests/ForgotPasswordRequest.php'));
        copy(__DIR__.'/../../stubs/app/Http/Requests/LoginRequest.php.stub', base_path('app/Http/Requests/LoginRequest.php'));
        copy(__DIR__.'/../../stubs/app/Http/Requests/RegisterRequest.php.stub', base_path('app/Http/Requests/RegisterRequest.php'));
        copy(__DIR__.'/../../stubs/app/Http/Requests/ResetPasswordRequest.php.stub', base_path('app/Http/Requests/ResetPasswordRequest.php'));

        // Models
        copy(__DIR__.'/../../stubs/app/Models/User.php.stub', base_path('app/Models/User.php'));

        // ServiceProvider
//        $this->replaceInFile('/home', '/dashboard', resource_path('js/Pages/Welcome.vue'));
        copy(__DIR__.'/../../stubs/app/Providers/RequestServiceProvider.php.stub', base_path('app/Providers/RequestServiceProvider.php'));
        copy(__DIR__.'/../../stubs/app/Providers/AuthServiceProvider.php.stub', base_path('app/Providers/AuthServiceProvider.php'));

        // Views...
        copy(__DIR__.'/../../stubs/resources/views/app.blade.php', resource_path('views/app.blade.php'));

        // Public
        copy(__DIR__.'/../../stubs/resources/js/assets/favicon.ico', base_path('public/favicon.ico'));

        // Bootstrap
        copy(__DIR__.'/../../stubs/bootstrap/app.php', base_path('bootstrap/app.php'));

        // Migrations
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/database/migrations', base_path('database/migrations'));

        // Css
        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/css', resource_path('css'));
        // Js
        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js', resource_path('js'));
        // Lang
        (new Filesystem)->ensureDirectoryExists(resource_path('lang'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/lang', resource_path('lang'));

        // Routes...
        copy(__DIR__.'/../../stubs/routes/web.php', base_path('routes/web.php'));

        // Config
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/config', base_path('config'));

        // Tailwind / Webpack...
        copy(__DIR__.'/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/../../stubs/webpack.config.js', base_path('webpack.config.js'));
        copy(__DIR__.'/../../stubs/jsconfig.json', base_path('jsconfig.json'));
        copy(__DIR__.'/../../stubs/package.json', base_path('package.json'));

        $this->info('Breeze scaffolding installed successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
