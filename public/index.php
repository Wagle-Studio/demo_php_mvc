<?php

use Src\MigrationManager;
use Src\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$migrationManager = new MigrationManager();

$migrationManager->runMigrations();

$router = new Router();

$router->add("users", "UserController", "collection", "GET");
$router->add("users/{id}", "UserController", "read", "GET");
$router->add("users", "UserController", "create", "POST");
$router->add("users/{id}", "UserController", "update", "UPDATE");
$router->add("users/{id}", "UserController", "delete", "DELETE");

$router->dispatch();