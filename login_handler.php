<?php 
    require 'connection.php';

    if (isset($_POST['login'])) {
        // echo "Your form is set";
        $matric = $_POST['matric'];
        $password = $_POST['password'];

        $success = "Login Successful";
        $error = "Password or Matric is not correct";
        
        $sql = "SELECT * FROM `user` WHERE `matric_number`='$matric' AND `password`='$password'";

        $userLogin = mysqli_query($conn, $sql);

        if ($userLogin) {
            // login successful;
			$_SESSION['success'] = $success;
            header('location: dashboard.php');
        }else {
			$_SESSION['error'] = $error;
            header('location: index.php');
        }
    }
?>