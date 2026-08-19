<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new database schema based on configuration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fallback to the .env default database if no argument is passed
        $databaseName = $this->argument('name') ?: config('database.connections.mysql.database');

        $driver = config('database.default');
        $host = config("database.connections.{$driver}.host");
        $port = config("database.connections.{$driver}.port");
        $username = config("database.connections.{$driver}.username");
        $password = config("database.connections.{$driver}.password");

        if (!$databaseName) {
            $this->error('No database name specified or found in your configuration.');
            return Command::FAILURE;
        }

        try {
            // Establish a PDO connection without selecting a database target yet
            $pdo = new PDO("{$driver}:host={$host};port={$port}", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Execute the raw creation query safely wrapped in backticks
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$databaseName}`");

            $this->info("Database '$databaseName' created successfully or already exists!");
            return Command::SUCCESS;
        } catch (PDOException $e) {
            $this->error("Failed to create database: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
