<section class="registration">
  <div class="row h-100">
    <div class="col-md-5 bg-light p-5">
      <a href="/">
        <img src="<?= $_ENV['URL']; ?>/assets/images/lasuidr-logo-black.png" width="250px" alt="LASUIDR Logo" />
      </a>
      <!-- verify.php -->
      <div class="container mt-5">
        <div class="row justify-content-center mt-5">
          <div class="col-md-12">
            <div class="alert alert-info mt-5">
              <h4>Email Verification Required</h4>
              <p><?php echo htmlspecialchars($message); ?></p>
            </div>
            <div class="text-center">
              <a href="/login" class="btn btn-purple">Login</button>
            </div>
            <div class="text-center d-none">
              <form method="POST" action="/resendVerificationEmail">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <button type="submit">Resend Verification Email</button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>