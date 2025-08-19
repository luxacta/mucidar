<section class="registration">
  <div class="row h-100">
    <div class="col-md-5 bg-light p-5">
      <a href="/">
        <img src="<?= $_ENV['URL']; ?>/assets/images/lasuidr-logo-black.png" width="250px" alt="LASUIDR Logo" />
      </a>

      <form action="/register" method="POST" class="row g-3 mt-4 needs-validation">

        <?php if (isset($error_message)): ?>
        <div id="alert-message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $error_message; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

        <div class="col-md-6">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" name="firstName" id="firstName"
            value="<?= htmlspecialchars($form_data['firstName']); ?>" required />
        </div>

        <div class=" col-md-6">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" name="lastName" id="lastName"
            value="<?= htmlspecialchars($form_data['lastName']); ?>" required />
        </div>

        <div class=" col-12">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email"
            value="<?= htmlspecialchars($form_data['email']); ?>" required />
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" required />
        </div>

        <div class="col-md-6">
          <label for="cpassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="cpassword" id="cpassword" required />
        </div>

        <div class="col-12">
          <small>Have an Account Already! <a href="/login" class="text-success">Sign in</a></small>
        </div>

        <div class="col-12">
          <button type="submit" class="btn-purple fw-bold text-white rounded">Register</button>
        </div>

      </form>
    </div>
  </div>
</section>