<?php
include('server.php');
include('errors.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">

</head>
<style>
  .error {
    color: red;
    /* background-color: #acf; */
  }
</style>

<body>
  <div class="container mt-3">
    <h2>LogIn User</h2>
    <hr class="mt-0">
    <form action="login.php" method="post" name="login">

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
      </div>

      <button type="submit" name="login_usr" class="btn btn-primary mb-2">Log In</button>
      <p>Don't have an account? <a href="register.php">Create Account</a> </p>
    </form>
  </div>

  <!-- scripts -->
  <script src="assets/jquery/jquery.js"></script>
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/node_modules/jquery-validation/dist/jquery.validate.js"></script>

  <!-- validations -->
  <script>
    $(document).ready(function() {
      $("form[name = 'login']").validate({
        rules: {
          name: "required",
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
          }
        },
        messages: {
          email: "Please enter your valid email",
          password: {
            required: "Please enter a password",
          },
        },
        submitHAndler: function(form) {
          form.submit();
        }
      });
    });    
  </script>
</body>

</html>