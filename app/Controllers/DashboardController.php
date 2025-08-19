<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class DashboardController extends Controller
{
  public function index($username = null)
  {
    // echo $_SESSION['error_message'];

    // Fetch user data based on the username
    $db = Database::getInstance();
    $user = $db->query("SELECT * FROM users WHERE username = ?", [$username])->fetch();

    if (!$user) {
      // If user not found, abort with a 404
      http_response_code(404);
      require "../app/Views/errors/404.php";
      exit();
    }

    // Prepare data to pass to the view
    $data = [
      'title' => "{$user['firstname']}'s Dashboard",
      'user' => $user,
    ];

    // Render the dashboard view for the authenticated user
    $this->view('dashboard/index', $data);
  }
}
