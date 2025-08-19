<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Data -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    MUCIDAR | <?= isset($title) ? htmlspecialchars($title) : '' ?>
  </title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <!-- StyleSheet-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="<?= $_ENV['URL']; ?>/assets/css/style.css" rel="stylesheet" />
</head>

<body>
  <header class="shadow-sm w-100 z-2 bg-light">
    <div class="container-xl">
      <div class="row justify-content-between align-items-center">
        <div class="col-md-4">
          <nav class="navbar navbar-expand-md flex-md-column justify-content-md-start align-items-md-start">
            <a href="/" class="navbar-brand mb-1">
              <img src="assets/images/mucidar-logo-black.png" width="250px" alt="LASUIDR Logo" />
            </a>

            <button
              class="navbar-toggler border-light d-flex d-md-none justify-content-start align-items-center column-gap-1"
              type="button" data-bs-toggle="offcanvas" data-bs-target="#main-nav" aria-controls="main-nav"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon small"></span>
              <span class="d-none d-sm-block text-light">Menu</span>
            </button>

            <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="main-nav" aria-labelledby="mainNavLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul
                  class="navbar-nav z-2 _ls-text-white justify-content-end row-gap-4 column-gap-2 flex-grow-1 pe-3 py-0">

                  <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#modality">Modality</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#repository">Repository</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                  </li>
                  <li class="nav-item d-md-none">
                    <a class="nav-link" href="<?= $_ENV['URL']; ?>/register">Get Started</a>
                  </li>
                  <li class="nav-item d-md-none">
                    <a class="nav-link" href="<?= $_ENV['URL']; ?>/login">Login</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
        <form class="col-md-4 d-none d-md-flex" form="search">
          <div class="input-group">
            <input type="text" class="form-control shadow-none" placeholder="Search Repository" />
            <button class="input-group-text" name="search">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
              </svg>
            </button>
          </div>
        </form>
        <div class="col-md-4 d-none d-md-flex flex-md-column align-items-md-end row-gap-1">
          <img src="assets/images/datican-black.png" width="250px" alt="LASUIDR Logo" />
          <ul class="nav z-2 _ls-text-white">
            <li class="nav-item">
              <a class="nav-link py-3" href="<?= $_ENV['URL']; ?>/register">Get Started</a>
            </li>
            <li class="nav-item">
              <a class="nav-link py-3" href="<?= $_ENV['URL']; ?>/login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <?php if ($_SERVER['REQUEST_URI'] === '/')
    include __DIR__ . '/../partial/hero.php';
  ?>

  <main>
    <?= $content ?>
  </main>

  <footer>
    <!-- <p>&copy; <?= date('Y') ?> My Application</p> -->
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $_ENV['URL']; ?>/assets/js/script.js"></script>
</body>

</html>