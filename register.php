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
  }
</style>

<body>
  <div class="container mt-3">
    <h2>Register User</h2>
    <hr class="mt-0">
    <form action="register.php" method="post" enctype="multipart/form-data" name="registration">

      <div class="form-group">
        <label for="image">Choose Profile</label>
        <input type="file" class="form-control-file" id="image" name="image">
      </div>

      <div class="card mb-3" style="width: 10rem; display:none">
        <img class="card-img-top" alt="Profile" id="preview_img">
      </div>

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

      <div class="form-group">
        <label class="form-check-label" for="exampleRadios1">
          Gender
        </label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
          <label class="form-check-label" for="male">
            Male
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="female" value="female">
          <label class="form-check-label" for="female">
            Female
          </label>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="countr">Country</label>
          <select id="country" name="country_id" class="form-control">
            <option value="" selected>Choose...</option>
            <?php
            $query = "SELECT * FROM countries";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['country']; ?></option>
            <?php
              }
            }
            ?>

          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="state">State</label>
          <select id="state" name="state_id" class="form-control">
            <option value="" selected>Choose...</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="city">City</label>
          <select id="city" name="city_id" class="form-control">
            <option value="" selected>Choose...</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="password">Create Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Create Password">
      </div>

      <button type="submit" name="reg_usr" class="btn btn-primary mb-2">Create Account</button>
      <p>Have an account? <a href="login.php">Log In</a> </p>
    </form>
  </div>

  <!-- scripts -->
  <script src="assets/jquery/jquery.js"></script>
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/node_modules/jquery-validation/dist/jquery.validate.js"></script>

  <!-- validations -->
  <script>
    $(document).ready(function() {
      $("form[name = 'registration']").validate({
        rules: {
          name: "required",
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 8
          },
          gender: "required",
          country: "required",
          state: "required",
          city: "required",
          image: {
            required: true,
          }
        },
        messages: {
          name: "Please enter your name",
          email: "Please enter your valid email",
          password: {
            required: "Please enter a password",
            minlength: "Minimum length must be 8 characters"
          },
          gender: "Select your gender",
          country: "Select your country",
          state: "Select your state",
          city: "Select your country",
          image: {
            required: "Upload a profile"
          }
        },
        submitHAndler: function(form) {
          form.submit();
        }
      });
    });

    //before submit profile preview
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#preview_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#image').on('change', function() {
      $('.card').css('display', 'block');
      readURL(this);
    });

    // country_state_city ajax
    $("#country").on('change', function() {
      var countryID = $(this).val();
      $.ajax({
        method: 'POST',
        url: 'country_state_city.php',
        data: {
          id: countryID
        },
        dataType: 'html',
        success: function(data) {
          $("#state").html(data);
        }
      });
    });

    $("#state").on('change', function() {
      var stateID = $(this).val();
      $.ajax({
        method: 'POST',
        url: 'country_state_city.php',
        data: {
          stateID: stateID
        },
        dataType: 'html',
        success: function(data) {
          $("#city").html(data);
        }
      });
    });
  </script>
</body>

</html>