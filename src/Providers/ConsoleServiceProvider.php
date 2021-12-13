<?php

namespace dxmb\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use dxmb\Modules\Commands\CommandMakeCommand;
use dxmb\Modules\Commands\ComponentClassMakeCommand;
use dxmb\Modules\Commands\ComponentViewMakeCommand;
use dxmb\Modules\Commands\ControllerMakeCommand;
use dxmb\Modules\Commands\DisableCommand;
use dxmb\Modules\Commands\DumpCommand;
use dxmb\Modules\Commands\EnableCommand;
use dxmb\Modules\Commands\EventMakeCommand;
use dxmb\Modules\Commands\FactoryMakeCommand;
use dxmb\Modules\Commands\InstallCommand;
use dxmb\Modules\Commands\JobMakeCommand;
use dxmb\Modules\Commands\LaravelModulesV6Migrator;
use dxmb\Modules\Commands\ListCommand;
use dxmb\Modules\Commands\ListenerMakeCommand;
use dxmb\Modules\Commands\MailMakeCommand;
use dxmb\Modules\Commands\MiddlewareMakeCommand;
use dxmb\Modules\Commands\MigrateCommand;
use dxmb\Modules\Commands\MigrateRefreshCommand;
use dxmb\Modules\Commands\MigrateResetCommand;
use dxmb\Modules\Commands\MigrateRollbackCommand;
use dxmb\Modules\Commands\MigrateStatusCommand;
use dxmb\Modules\Commands\MigrationMakeCommand;
use dxmb\Modules\Commands\ModelMakeCommand;
use dxmb\Modules\Commands\ModuleDeleteCommand;
use dxmb\Modules\Commands\ModuleMakeCommand;
use dxmb\Modules\Commands\NotificationMakeCommand;
use dxmb\Modules\Commands\PolicyMakeCommand;
use dxmb\Modules\Commands\ProviderMakeCommand;
use dxmb\Modules\Commands\PublishCommand;
use dxmb\Modules\Commands\PublishConfigurationCommand;
use dxmb\Modules\Commands\PublishMigrationCommand;
use dxmb\Modules\Commands\PublishTranslationCommand;
use dxmb\Modules\Commands\RequestMakeCommand;
use dxmb\Modules\Commands\ResourceMakeCommand;
use dxmb\Modules\Commands\RouteProviderMakeCommand;
use dxmb\Modules\Commands\RuleMakeCommand;
use dxmb\Modules\Commands\SeedCommand;
use dxmb\Modules\Commands\SeedMakeCommand;
use dxmb\Modules\Commands\SetupCommand;
use dxmb\Modules\Commands\TestMakeCommand;
use dxmb\Modules\Commands\UnUseCommand;
use dxmb\Modules\Commands\UpdateCommand;
use dxmb\Modules\Commands\UseCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Namespace of the console commands
     * @var string
     */
    protected $consoleNamespace = "dxmb\\Modules\\Commands";

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
