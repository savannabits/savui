<?php

namespace Savannabits\AdminAuth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class AdminAuthInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin-auth:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install a savannabits/admin-auth package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Installing package savannabits/admin-auth');

        $this->call('admin-ui:install');

        $this->call('vendor:publish', [
            '--provider' => "Savannabits\\AdminAuth\\AdminAuthServiceProvider",
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Savannabits\\AdminAuth\\Activation\\Providers\\ActivationServiceProvider",
        ]);

        $this->strReplaceInFile(
            resource_path('views/admin/layout/profile-dropdown.blade.php'),
            '|url\(\'admin\/logout\'\)|',
            '{{-- Do not delete me :) I\'m used for auto-generation menu items --}}',
            '{{-- Do not delete me :) I\'m used for auto-generation menu items --}}
    <a href="{{ url(\'admin/logout\') }}" class="dropdown-item"><i class="fa fa-lock"></i> {{ trans(\'savannabits/admin-auth::admin.profile_dropdown.logout\') }}</a>'
        );

        $this->appendAdminAuthToAuthConfig();

        $this->call('migrate');

        $this->info('Package savannabits/admin-auth installed');
    }

    /**
     * Replace string in file
     *
     * @param string $fileName
     * @param string $ifExistsRegex
     * @param string $find
     * @param string $replaceWith
     * @return int|bool
     */
    private function strReplaceInFile($fileName, $ifExistsRegex, $find, $replaceWith)
    {
        $content = File::get($fileName);
        if ($ifExistsRegex !== null && preg_match($ifExistsRegex, $content)) {
            return;
        }

        return File::put($fileName, str_replace($find, $replaceWith, $content));
    }

    /**
     * Append admin-auth config to auth config
     *
     * @return void
     */
    private function appendAdminAuthToAuthConfig(): void
    {
        $auth = Config::get('auth');

        $this->strReplaceInFile(
            config_path('auth.php'),
            '|\'admin\' => \[|',
            '\'guards\' => [',
            '\'guards\' => [
        \'admin\' => [
            \'driver\' => \'session\',
            \'provider\' => \'admin_users\',
        ],
        '
        );
        if (!isset($auth['guards'])) {
            $auth['guards'] = [];
        }
        $auth['guards']['admin'] = [
            'driver' => 'session',
            'provider' => 'admin_users',
        ];

        $this->strReplaceInFile(
            config_path('auth.php'),
            '|    \'providers\' => \[
        \'admin_users\' => \[|',
            '\'providers\' => [',
            '\'providers\' => [
        \'admin_users\' => [
            \'driver\' => \'eloquent\',
            \'model\' => Savannabits\AdminAuth\Models\AdminUser::class,
        ],
        '
        );
        if (!isset($auth['providers'])) {
            $auth['providers'] = [];
        }
        $auth['providers']['admin_users'] = [
            'driver' => 'eloquent',
            'model' => \Savannabits\AdminAuth\Models\AdminUser::class,
        ];

        $this->strReplaceInFile(
            config_path('auth.php'),
            '|\'passwords\' => \[
        \'admin_users\' => \[|',
            '\'passwords\' => [',
            '\'passwords\' => [
        \'admin_users\' => [
            \'provider\' => \'admin_users\',
            \'table\' => \'admin_password_resets\',
            \'expire\' => 60,
        ],
        '
        );
        if (!isset($auth['passwords'])) {
            $auth['passwords'] = [];
        }
        $auth['passwords']['admin_users'] = [
            'provider' => 'admin_users',
            'table' => 'admin_password_resets',
            'expire' => 60,
        ];

        Config::set('auth', $auth);
    }
}
