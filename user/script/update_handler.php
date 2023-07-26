<?php
session_start();
require '../../connection.php';

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $gender = $_POST['gender'];
    $level = $_POST['level'];

    $passport = $_FILES['passport']['name'];
    $extension = explode(".", $passport);
    $newfilename = $matric . '.' . end($extension);
    $temp_name = $_FILES['passport']['tmp_name'];

    $creatfolder = "../../passport/";
    $path = "../../passport/" . $newfilename;
    $sql = "UPDATE `user` SET `fullname` = '$fullname', `matric_number` = '$matric', `gender` = '$gender', `passport` = '$path' WHERE `matric_number` = '$matric'";

    if (file_exists($creatfolder)) {
        $uploadtodb = move_uploaded_file($temp_name, $path);
    }else{
        $created = mkdir($creatfolder, 0755);
       if ($created) {
        $uploadtodb = move_uploaded_file($temp_name, $path);
       }
    }   

    $update = mysqli_query($conn, $sql);
    if ($update && $uploadtodb) {
        // echo "Record and passport has been updated";
        $_SESSION['success'] = "Record and passport updated successfully";
        header('location: ../dashboard.php');
    } else {
        echo "error";
    }
}
