<?php

namespace App\Middleware;

class GuestMiddleware
{
  public function handle()
  {
    // Check if user is already authenticated
    if (isset($_SESSION['user'])) {
      // If already authenticated, redirect to user dashboard
      header('Location: /dashboard/' . $_SESSION['user']);
      exit();
    }
  }
}
