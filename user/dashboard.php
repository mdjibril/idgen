<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['matric'])) {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a,
        .sidenav button {
            padding: 6px 6px 6px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }

        .sidenav a:hover,
        .sidenav button:hover {
            color: #f1f1f1;
        }

        .main {
            margin-left: 200px;
            /* Same as the width of the sidenav */
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .modal-body {
            padding: 2px 16px;
        }

        .modal-footer {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .input-container {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            width: 100%;
            margin-bottom: 15px;
        }

        .icon {
            padding: 10px;
            background: #4caf50;
            color: white;
            min-width: 50px;
            text-align: center;
            font-size: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            outline: none;
        }

        .input-field:focus {
            border: 2px solid #4caf50;
        }

        /* Set a style for the submit button */
        .btn {
            background-color: #4caf50;
            color: white;
            padding: 15px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .btn:hover {
            opacity: 1;
        }
    </style>
</head>

<body>

    <div class="sidenav">
        <a href="#">Dashboard</a>
        <a href="#" id="myBtn">Update</a>
        <a href="script/logout.php">Logout</a>
    </div>
    <?php
    $current_matric = $_SESSION['matric'];
    $sql = "SELECT * FROM `user` WHERE `matric_number` = '$current_matric'";
    $getUser = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($getUser)) :
        $fullname = $row['fullname'];
        $gender = $row['gender'];
        $level = $row['level'];
        $passport = $row['passport'];
        $request = $row['request'];
        $status = $row['status'];
    ?>
        <div class="main">
            <h2>Welcome <span style="color:#4caf50"><?php echo $fullname ?> </span></h2>
            <?php
            if (empty($passport)) :
                echo "<p>Please click on update to upload your passport</p>";
            else :
                echo "
                    <p><b>Matric:</b>$current_matric</p>
                    <p><b>Gender:</b> $gender</p>
                    <p><b>Level:</b> $level</p>
                ";

                if ($request == '0') {
                    echo "Click to <a href='script/request.php?matric=$current_matric'>request</a> for ID Card";
                }elseif(($request == '1') && ($status == 'notapproved')) {
                    echo "Your Id Card is been processed, please check back letter";
                }elseif(($request == '1') && ($status == 'approved')){
                    echo "Click to <a href='script/idcard.php?matric=$current_matric'>print</a> ID Card";
                }
            endif;
            ?>
        </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2 style="text-align:center">Update Record</h2>
            </div>
            <div class="modal-body">
                <form action="script/update_handler.php" method="post" style="max-width:500px;margin:auto" enctype="multipart/form-data">
                    <div class="input-container">
                        <i class="fa fa-hand-o-right icon"></i>
                        <input class="input-field" type="text" placeholder="Fullname" name="fullname" value="<?php echo $fullname ?>">
                    </div>

                    <div class="input-container">
                        <i class="fa fa-hand-o-right icon"></i>
                        <input class="input-field" type="text" placeholder="Matric" name="matric" value="<?php echo $current_matric ?>">
                    </div>

                    <div class="input-container">
                        <i class="fa fa-hand-o-right icon"></i>
                        <select name="gender" id="" class="input-field">
                            <option value="">Select Gender</option>
                            <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
                            <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
                        </select>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-hand-o-right icon"></i>
                        <input class="input-field" type="file" placeholder="Passport" name="passport">
                    </div>

                    <div class="input-container">
                        <i class="fa fa-hand-o-right icon"></i>
                        <select name="level" id="" class="input-field">
                            <option value="">Select Level</option>
                            <option value="100" <?php if ($level == "100") echo "selected"; ?>>100-Level</option>
                            <option value="200" <?php if ($level == "200") echo "selected"; ?>>200-Level</option>
                            <option value="300" <?php if ($level == "300") echo "selected"; ?>>300-Level</option>
                            <option value="400" <?php if ($level == "400") echo "selected"; ?>>400-Level</option>
                            <option value="500" <?php if ($level == "500") echo "selected"; ?>>500-Level</option>
                        </select>
                    </div>

                    <button type="submit" class="btn" name="update">Update Record</button>
                </form>
            </div>
            <div class="modal-footer">
                <h3>&nbsp;</h3>
            </div>
        </div>
    </div>
    <?php
    endwhile;
    ?>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_css_sidenav by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2019 03:50:09 GMT -->

</html>