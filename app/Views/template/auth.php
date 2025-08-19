<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Data -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    LASUIDR | <?= isset($title) ? htmlspecialchars($title) : '' ?>
  </title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= $_ENV['URL']; ?>/favicon.png" type="image/png">
  <!-- StyleSheet-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= $_ENV['URL']; ?>/assets/css/style.css" rel="stylesheet" />
</head>

<body>
  <main>
    <!-- This is where the view content will be injected -->
    <?= $content ?>
  </main>

  <footer>
    <!-- <p>&copy; <?= date('Y') ?> My Application</p> -->
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_ENV['URL']; ?>/assets/js/script.js"></script>
</body>

</html>