<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require_once 'vendor/autoload.php';

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class Database extends PDO
{
    private string $engine;
    private string $host;
    private string $database;
    private string $username;
    private string $password;

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(BASE_PATH . '/.env');

        $this->engine = $_ENV['DB_CONNECTION'] ?? 'mysql';
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->database = $_ENV['DB_DATABASE'] ?? 'phpberry';
        $this->username = $_ENV['DB_USERNAME'] ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? '';

        $dsn = $this->engine . ':host=' . $this->host . ';dbname=' . $this->database;
        parent::__construct($dsn, $this->username, $this->password);
    }
}
