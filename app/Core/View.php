<?php

namespace App\Core;

class View
{
  protected $templatePath;

  public function __construct($templatePath = '../app/Views/')
  {
    $this->templatePath = $templatePath;
  }

  public function render($view, $data = [], $layout = 'layout')
  {
    // Extract the data to be used in the view
    extract($data);

    // Define the path to the view file
    $viewFile = $this->templatePath . $view . '.php';

    // Check if the view file exists
    if (file_exists($viewFile)) {
      // Start output buffering
      ob_start();
      include $viewFile; // Include the view file
      $content = ob_get_clean(); // Get the buffered content (view content)

      // If a layout is provided, render the layout and inject the content
      if ($layout) {
        $layoutFile = "{$this->templatePath}/template/{$layout}.php";
        if (file_exists($layoutFile)) {
          // Pass the content to the layout
          ob_start();
          include $layoutFile; // Include the layout file
          return ob_get_clean(); // Return the fully-rendered content
        } else {
          throw new \Exception("Layout file not found: $layoutFile");
        }
      }

      // If no layout is specified, return the content directly
      return $content;
    } else {
      throw new \Exception("View file not found: $viewFile");
    }
  }
}