<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
  private static $instance = null;
  private $pdo;

  private function __construct()
  {
    // Get environment variables
    $host = $_ENV['DB_HOST'] ?? 'localhost';
    $db = $_ENV['DB_NAME'] ?? '';
    $user = $_ENV['DB_USER'] ?? '';
    $pass = $_ENV['DB_PASS'] ?? '';
    $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
      $this->pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
      throw new \Exception("Database connection failed: " . $e->getMessage());
    }
  }



  // Singleton instance to prevent multiple connections
  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  // Get PDO connection
  public function getConnection()
  {
    return $this->pdo;
  }

  // Helper methods
  public function query($query, $params = [])
  {
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($params);
    return $stmt;
  }

  public function fetchAll($query, $params = [])
  {
    return $this->query($query, $params)->fetchAll();
  }

  public function fetch($query, $params = [])
  {
    return $this->query($query, $params)->fetch();
  }

  public function execute($query, $params = [])
  {
    return $this->query($query, $params)->rowCount();
  }
}