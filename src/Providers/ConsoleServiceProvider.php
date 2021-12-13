<?php

namespace DXMB\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use DXMB\Modules\Commands\CommandMakeCommand;
use DXMB\Modules\Commands\ComponentClassMakeCommand;
use DXMB\Modules\Commands\ComponentViewMakeCommand;
use DXMB\Modules\Commands\ControllerMakeCommand;
use DXMB\Modules\Commands\DisableCommand;
use DXMB\Modules\Commands\DumpCommand;
use DXMB\Modules\Commands\EnableCommand;
use DXMB\Modules\Commands\EventMakeCommand;
use DXMB\Modules\Commands\FactoryMakeCommand;
use DXMB\Modules\Commands\InstallCommand;
use DXMB\Modules\Commands\JobMakeCommand;
use DXMB\Modules\Commands\LaravelModulesV6Migrator;
use DXMB\Modules\Commands\ListCommand;
use DXMB\Modules\Commands\ListenerMakeCommand;
use DXMB\Modules\Commands\MailMakeCommand;
use DXMB\Modules\Commands\MiddlewareMakeCommand;
use DXMB\Modules\Commands\MigrateCommand;
use DXMB\Modules\Commands\MigrateRefreshCommand;
use DXMB\Modules\Commands\MigrateResetCommand;
use DXMB\Modules\Commands\MigrateRollbackCommand;
use DXMB\Modules\Commands\MigrateStatusCommand;
use DXMB\Modules\Commands\MigrationMakeCommand;
use DXMB\Modules\Commands\ModelMakeCommand;
use DXMB\Modules\Commands\ModuleDeleteCommand;
use DXMB\Modules\Commands\ModuleMakeCommand;
use DXMB\Modules\Commands\NotificationMakeCommand;
use DXMB\Modules\Commands\PolicyMakeCommand;
use DXMB\Modules\Commands\ProviderMakeCommand;
use DXMB\Modules\Commands\PublishCommand;
use DXMB\Modules\Commands\PublishConfigurationCommand;
use DXMB\Modules\Commands\PublishMigrationCommand;
use DXMB\Modules\Commands\PublishTranslationCommand;
use DXMB\Modules\Commands\RequestMakeCommand;
use DXMB\Modules\Commands\ResourceMakeCommand;
use DXMB\Modules\Commands\RouteProviderMakeCommand;
use DXMB\Modules\Commands\RuleMakeCommand;
use DXMB\Modules\Commands\SeedCommand;
use DXMB\Modules\Commands\SeedMakeCommand;
use DXMB\Modules\Commands\SetupCommand;
use DXMB\Modules\Commands\TestMakeCommand;
use DXMB\Modules\Commands\UnUseCommand;
use DXMB\Modules\Commands\UpdateCommand;
use DXMB\Modules\Commands\UseCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Namespace of the console commands
     * @var string
     */
    protected $consoleNamespace = "DXMB\\Modules\\Commands";

    /**
     * The available commands
     * @var array
     */
    protected $commands = [
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        InstallCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        FactoryMakeCommand::class,
        PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        PublishCommand::class,
        PublishConfigurationCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        SetupCommand::class,
        UnUseCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
        LaravelModulesV6Migrator::class,
        ComponentClassMakeCommand::class,
        ComponentViewMakeCommand::class,
    ];

    public function register(): void
    {
        $this->commands($this->resolveCommands());
    }

    private function resolveCommands(): array
    {
        $commands = [];

        foreach (config('modules.commands', $this->commands) as $command) {
            $commands[] = Str::contains($command, $this->consoleNamespace) ?
                $command :
                $this->consoleNamespace . "\\" . $command;
        }

        return $commands;
    }

    public function provides(): array
    {
        return $this->commands;
    }
}
