<h3>Verification Token Expired</h3>
<p>Your verification token has expired. Would you like to resend the verification email?</p>

<form action="/resend-verification" method="POST">
  <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
  <button type="submit" class="btn btn-primary">Resend Verification Email</button>
</form>

<p>Or, if you have already verified your email, <a href="<?= $_ENV['URL']; ?>/login">click here to login</a>.</p>