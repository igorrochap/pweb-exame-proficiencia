<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name} {--namespace=}';

    protected $description = 'it creates the interface and the concrete implementation of a repository';

    private array $namespaces = [
        'interface' => 'App\\Contracts\\Repositories',
        'concrete' => 'App\\Repositories',
    ];

    private string $repositoryName;

    private ?string $namespace;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->repositoryName = $this->argument('name');
        $this->namespace = $this->option('namespace');
        $interface = $this->createInterface();
        $implementacao = $this->createImplementation();
        $this->registerBinding($interface, $implementacao);
        $this->info('Repository created successfully!');

        return self::SUCCESS;
    }

    private function createInterface(): object
    {
        $fullName = is_null($this->namespace) ? $this->repositoryName : "{$this->namespace}/{$this->repositoryName}";
        $pathInterface = app_path("Contracts/Repositories/{$fullName}.php");
        $namespace = is_null($this->namespace) ? '' : "\\{$this->namespace}";
        $this->generateByStub(base_path('stubs/repository/interface.stub'), $pathInterface, [
            '{{ namespace }}' => $this->namespaces['interface'] . $namespace,
            '{{ interface }}' => $this->repositoryName,
        ]);
        $this->comment("{$fullName} created");

        return (object) ['nome' => $this->repositoryName, 'namespace' => $this->namespaces['interface'] . $namespace];
    }

    private function createImplementation(): object
    {
        $concreteName = "Eloquent{$this->repositoryName}";
        $fullName = is_null($this->namespace) ? $concreteName : "{$this->namespace}/{$concreteName}";
        $pathImplementation = app_path("Repositories/{$fullName}.php");
        $namespace = is_null($this->namespace) ? '' : "\\{$this->namespace}";
        $this->generateByStub(base_path('stubs/repository/implementation.stub'), $pathImplementation, [
            '{{ namespace }}' => $this->namespaces['concrete'] . $namespace,
            '{{ class }}' => "Eloquent{$this->repositoryName}",
            '{{ interfaceNamespace }}' => $this->namespaces['interface'] . $namespace,
            '{{ interface }}' => $this->repositoryName,
        ]);
        $this->comment("{$fullName} created");

        return (object) ['nome' => $concreteName, 'namespace' => $this->namespaces['concrete'] . $namespace];
    }

    private function registerBinding(object $interface, object $implementacao): void
    {
        $provider = app_path('Providers/RepositoryServiceProvider.php');
        if (! File::exists($provider)) {
            $this->error('RepositoryServiceProvider not found');

            return;
        }
        $binding = "\$this->app->bind(\\{$interface->namespace}\\{$interface->nome}::class, \\{$implementacao->namespace}\\{$implementacao->nome}::class);";
        $providerContent = File::get($provider);
        if (str_contains($providerContent, $binding)) {
            $this->warn('Repository already registered in the RepositoryServiceProvider');

            return;
        }
        $content = preg_replace(
            '/public function register\(\): void\s*\n\s*\{/',
            "public function register(): void\n    {\n        {$binding}",
            $providerContent
        );
        File::put($provider, $content);
        $this->comment('Binding registered in the RepositoryServiceProvider');
    }

    private function generateByStub(string $pathStub, string $destination, array $substitutions): void
    {
        if (File::exists($destination)) {
            $this->warn("File already exists at {$destination}");

            return;
        }
        $stub = File::get($pathStub);
        foreach ($substitutions as $key => $substitution) {
            $stub = str_replace($key, $substitution, $stub);
        }
        File::ensureDirectoryExists(dirname($destination));
        File::put($destination, $stub);
    }
}
