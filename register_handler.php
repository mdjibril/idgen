<?php 
    require 'connection.php';

    if (isset($_POST['register'])) {
        // echo "Your form is set";
        $matric = $_POST['matric'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $level = $_POST['level'];

        $sql = "INSERT INTO `user`(`fullname`, `matric_number`, `gender`, `level`, `password`) VALUES('$fullname', '$matric', '$gender','$level', '$password')";

        $registerUser = mysqli_query($conn, $sql);

        if ($registerUser) {
            echo "registered successfully";
        }else {
            echo "error";
        }
    }
?>