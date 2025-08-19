<section class="registration">
  <div class="row h-100">
    <div class="col-md-5 bg-light p-5">
      <a href="/">
        <img src="<?= $_ENV['URL']; ?>/assets/images/lasuidr-logo-black.png" width="250px" alt="LASUIDR Logo" />
      </a>

      <form action="/login" method="POST" class="row g-3 mt-4 needs-validation">

        <?php if (isset($error_message)): ?>
        <div id="alert-message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $error_message; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
        <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $success_message; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

        <div class=" col-12">
          <label for="email_or_user" class="form-label">Email or Username</label>
          <input type="text" class="form-control" id="email_or_username" name="email_or_username"
            value="<?= htmlspecialchars($form_data['email_or_username']); ?>" required>
        </div>

        <div class="col-md-12">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="col-12">
          <small>Don't have an Account! <a href="/register" class="text-success">Register</a></small>
        </div>
        <div class="col-12">
          <button type="submit" class="btn-purple fw-bold text-white rounded">Login</button>
        </div>
      </form>
    </div>
  </div>

</section>