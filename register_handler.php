<?php 
    session_start();
    require 'connection.php';

    if (isset($_POST['register'])) {
        // echo "Your form is set";
        $matric = $_POST['matric'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $level = $_POST['level'];

        $success = "Register Successful";
        $error = "Error registering user please try again";

        $sql = "INSERT INTO `user`(`fullname`, `matric_number`, `gender`, `level`, `password`) VALUES('$fullname', '$matric', '$gender','$level', '$password')";

        $registerUser = mysqli_query($conn, $sql);

        if ($registerUser) {
            // echo "registered successfully";
			$_SESSION['success'] = $success;
            header('location: index.php');
        }else {
            // echo "error";
			$_SESSION['error'] = $error;
            header('location: register.php');
        }
    }
?>