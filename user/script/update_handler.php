<?php 
    session_start();
    require '../../connection.php';
    // define ('SITE_ROOT', realpath(dirname(__FILE__)));

    if (isset($_POST['update'])) {
        $fullname = $_POST['fullname'];
        $matric = $_POST['matric'];
        $gender = $_POST['gender'];
        $level = $_POST['level'];

        $passport = $_FILES['passport']['name'];
        $extension = explode(".", $passport);
        $newfilename = $matric.'.'.end($extension);
        $temp_name = $_FILES['passport']['tmp_name'];
        
        $path = "../../passport/".$newfilename;
        $sql = "UPDATE `user` SET `fullname` = '$fullname', `matric_number` = '$matric', `gender` = '$gender', `passport` = '$path' WHERE `matric_number` = '$matric'";

        $uploadtodb = move_uploaded_file($temp_name, $path);

        $update = mysqli_query($conn, $sql);
        if ($update && $uploadtodb) {
            echo "Record and passport has been updated";
        }else {
            echo "error";
        }

    }
?>