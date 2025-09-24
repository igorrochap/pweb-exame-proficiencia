<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateJWTKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jwt:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate JWT secret key';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $env = base_path('.env');
        $key = Str::random(20);
        file_put_contents($env, PHP_EOL."JWT_SECRET={$key}".PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
