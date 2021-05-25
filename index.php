<?php
include('server.php');


if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="container mt-3 col-sm-3">
        <div class="card text-white bg-dark" style="width: 18rem;">
            <?php if (isset($_SESSION['email'])) {
                $query = "SELECT users.id, users.name, users.email, users.gender, users.image, countries.country, states.state, cities.city
                FROM users 
                JOIN countries ON users.country_id = countries.id
                JOIN states ON users.state_id = states.id
                JOIN cities ON users.city_id = cities.id WHERE email = '" . $_SESSION['email'] . "'";
                $result = mysqli_query($db, $query);
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <img class="card-img-top" src="images/<?= $row['image']; ?>" alt="profile" width="200" height="200">
                    <div class="card-body">
                        <h5 class="card-title">INFORMATION</h5>
                        <b>Name: </b><span><?= $row['name']; ?></span><br>
                        <b>Email: </b><span><?= $row['email']; ?></span><br>
                        <b>Gender: </b><span><?= $row['gender']; ?></span><br>
                        <b>Country: </b><span><?= $row['country']; ?></span><br>
                        <b>State: </b><span><?= $row['state']; ?></span><br>
                        <b>City: </b><span><?= $row['city']; ?></span><br><br>
                        <a href="index.php?logout='2'" class="btn btn-danger">LogOut</a>
                        <div class="mt-3">
                            <a class="btn btn-primary"  href="index.php?edit =">EDIT</a>
                            <a class="btn btn-primary" href="http://">DELETE</a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- scripts -->
    <script src="assets/jquery/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/node_modules/jquery-validation/dist/jquery.validate.js"></script>
</body>

</html>