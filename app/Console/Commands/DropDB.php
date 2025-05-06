<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class DropDB extends Command
{
    protected $signature = 'db:drop';
    protected $description = 'Drop database from .env';

    public function handle()
    {
        $databaseName = config('database.connections.mysql.database');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        try {
            // Kết nối đến MySQL mà không chọn database
            $connection = new PDO("mysql:host=$host;port=$port", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Kiểm tra xem database có tồn tại không
            $stmt = $connection->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname");
            $stmt->execute(['dbname' => $databaseName]);

            if ($stmt->rowCount() > 0) {
                // Nếu tồn tại, thực hiện DROP
                $connection->exec("DROP DATABASE `$databaseName`");
                $this->info("Database `$databaseName` dropped successfully");
            } else {
                $this->warn("Database `$databaseName` does not exist");
            }
        } catch (PDOException $e) {
            $this->error("Database dropping error: " . $e->getMessage());
        }
    }
}
