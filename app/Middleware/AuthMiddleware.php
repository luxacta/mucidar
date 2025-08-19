<?php

namespace App\Middleware;

class AuthMiddleware
{
  public function handle()
  {
    // Check if user is authenticated
    if (!isset($_SESSION['user'])) {
      // If not authenticated, redirect to login page
      header('Location: ' . $_ENV['URL'] . '/login');
      exit();
    }
  }

  // public function handleRole($requiredRole)
  // {
  //   // Simulate role check (you can replace this with actual logic)
  //   if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
  //     http_response_code(403);
  //     echo "403 Forbidden: You do not have permission to access this resource.";
  //     exit;
  //   }
  // }
}
