<?php
include('db_connection.php');
session_start();
$errors = array();

if (isset($_POST['reg_usr'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $country_id = $_POST['country_id'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];

    $target = 'images/';
    $fileName = $_FILES['image']['name'];
    $target  = $target . basename($fileName);
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];

    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $ext = array("jpeg", "jpg", "png");

    if (in_array($fileExt, $ext) === FALSE) {
        array_push($errors, "Extension not allowed! Allowed - jpeg, jpg, png");
    }

    if ($fileSize > 2097152) {
        array_push($errors, "Size must be exactly of 2Mb");
    }

    // if (file_exists($target)) {
    //     array_push($errors, "Image already exists");
    // }

    if (empty($errors) === TRUE) {
        move_uploaded_file($fileTmpName, $target);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter a valid Email");
    }

    $usr_chk = "SELECT * FROM users";
    $result = mysqli_query($db, $usr_chk);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    foreach($row as $ro){
        if ($email === $ro['email']) {
            array_push($errors, "Email already exists");
        }
    }
    

    if (count($errors) === 0) {
        $query = "INSERT INTO users(`name`, `email`, `password`, `gender`, `country_id`, `state_id`, `city_id`, `image`)
     VALUES('$name', '$email', '$password', '$gender', '$country_id', '$state_id', '$city_id', '$fileName')";
        if ($query) {
            mysqli_query($db, $query);
            echo "<script>alert('Successfully Registered')</script>";
        } else {
            echo "<script>alert('Failed to register')</script>";
        }
    }
}

//LogIn User

if(isset($_POST['login_usr'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) > 0){
        $_SESSION['email'] = $email;
        //$_SESSION['id'] = $id;
        $_SESSION['success'] = "You are successfully logged in";
        header('location:index.php');
    }else{
        array_push($errors, "Wrong username/password combination");
    }

}
