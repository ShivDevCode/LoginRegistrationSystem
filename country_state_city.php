<?php
include('db_connection.php');


if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "SELECT * FROM states WHERE country_id = $id ORDER BY state ASC";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $state = $row['state'];
            echo"<option value='$id'>$state</option>";
        }
    }
}

if(isset($_POST['stateID'])){
    $id = $_POST['stateID'];
    $query = "SELECT * FROM cities WHERE state_id = $id ORDER BY city ASC";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $city = $row['city'];
            echo"<option value='$id'>$city</option>";
        }
    }
}
?>