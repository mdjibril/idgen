<?php 
    session_start();
    require '../../connection.php';

    if (isset($_GET['usermatric'])) {
        $current_matric = $_GET['usermatric'];
        $status = $_GET['userstatus'];
        $reqeust = $_GET['userrequest'];
        // echo 'e don set';
        if (($status == 'notapproved') && ($reqeust == '1')) {
            $sql = "UPDATE `user` SET `status` = 'approved' WHERE `matric_number` = $current_matric";
            $updateStatus = mysqli_query($conn, $sql);
    
            if ($updateStatus) {
                // echo "status has been approve";
                header('location: ../approvedrequest.php');
            }else {
                echo "error";
            }
        }elseif((($status == 'approved') && ($reqeust == '1')) || ($request='0')) {
            $sql = "UPDATE `user` SET `status` = 'notapproved' WHERE `matric_number` = $current_matric";
            $updateStatus = mysqli_query($conn, $sql);
    
            if ($updateStatus) {
                // echo "status has been approve";
                header('location: ../id_request.php');
            }else {
                echo "error";
            }
        }
    }
?>