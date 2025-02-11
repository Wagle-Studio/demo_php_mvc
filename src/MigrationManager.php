<?php

namespace Src;

use PDO;

class MigrationManager extends Database
{

    public function __construct()
    {
        parent::__construct();

        $this->createMigrationsTable();
    }

    private function createMigrationsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";


        $this->database->exec($sql);
    }

    public function runMigrations()
    {
        $executedMigrations = $this->getExecutedMigrations();
        $migrationFiles = glob(__DIR__ . '/../migrations/*.php');

        foreach ($migrationFiles as $file) {
            $migrationName = basename($file, '.php');

            if (!in_array($migrationName, $executedMigrations)) {
                require_once $file;

                $className = "Src\\Database\\Migrations\\$migrationName";

                if (class_exists($className)) {
                    $migration = new $className($this->database);
                    $migration->up();

                    $this->logMigration($migrationName);
                }
            }
        }
    }

    private function getExecutedMigrations(): array
    {
        $stmt = $this->database->query("SELECT migration FROM migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function logMigration(string $migration)
    {
        $stmt = $this->database->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $stmt->execute(['migration' => $migration]);
    }
}
