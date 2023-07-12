<?php 
    session_start();
    require 'connection.php';

    if (isset($_POST['update'])) {
        $fullname = $_POST['fullname'];
        $matric = $_POST['matric'];
        $gender = $_POST['gender'];
        $level = $_POST['level'];

        $pasport = $_POST['passport']['name'];

    }
?>