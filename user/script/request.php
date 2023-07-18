<?php 
    session_start();
    require '../../connection.php';

    if (isset($_GET['matric'])) {
        $current_matric = $_GET['matric'];
        // echo 'e don set';
        $sql = "UPDATE `user` SET `request` = '1' WHERE matric_number = $current_matric";
        $updateRequest = mysqli_query($conn, $sql);

        if ($updateRequest) {
            // echo "request has been recorded please check back letter";
            header('location: ../dashboard.php');
        }else {
            echo "error";
        }
    }
?>