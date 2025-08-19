<?php

namespace App\Core;

use Throwable;

class ErrorHandler
{
  public static function handle(Throwable $exception)
  {
    http_response_code(500);
    echo "An error occurred: " . htmlspecialchars($exception->getMessage());
  }
}