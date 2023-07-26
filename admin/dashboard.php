<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['username'])) {
    header('location: index.php');
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
            background-color: #4caf50;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a,
        .sidenav button {
            padding: 6px 6px 6px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #ffffff;
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

        .cards {
            display: flex;
            align-items: center;
            margin-top: 50px;
        }

        .card {
            width: 200px;
            height: 100px;
            text-align: center;
            background-color: #4caf50;
            color: #ffffff;
            margin: 0 20px;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="sidenav">
        <a href="dashboard.php">Dashboard</a>
        <a href="allstudent.php" id="myBtn">All student</a>
        <a href="id_request.php">ID Card Request</a>
        <a href="approvedrequest.php">Approved ID Card</a>
        <a href="script/logout.php">Logout</a>
    </div>
    <?php
    $sqlall = "SELECT COUNT(gender) FROM `user`";
    $allgender = mysqli_query($conn, $sqlall);
    $row =  mysqli_fetch_row($allgender);

    $sqlmale = "SELECT COUNT(gender) FROM `user` WHERE `gender` = 'Male'";
    $totalmale = mysqli_query($conn, $sqlmale);
    $males =  mysqli_fetch_row($totalmale);

    $sqlfemale = "SELECT COUNT(gender) FROM `user` WHERE `gender` = 'Female'";
    $totalfemale = mysqli_query($conn, $sqlfemale);
    $females =  mysqli_fetch_row($totalfemale);

    $sqlrequest = "SELECT COUNT(request) FROM `user` WHERE `status` = 'notapproved'";
    $totalrequest = mysqli_query($conn, $sqlrequest);
    $request =  mysqli_fetch_row($totalrequest);

    $sqlapprove = "SELECT COUNT(request) FROM `user` WHERE `status` = 'approved'";
    $totalapprove = mysqli_query($conn, $sqlapprove);
    $approve =  mysqli_fetch_row($totalapprove);
    ?>
    <div class="main">
        <h2>Welcome <span style="color:#4caf50"><?php echo $_SESSION['username'] ?> </span></h2>
        <div class="cards">
            <div class="card">
                Total Students: <?php echo $row['0'] ?>
            </div>
            <div class="card">
                Total Males: <?php echo $males['0'] ?>
            </div>
            <div class="card">
                Total Females: <?php echo $females['0'] ?>
            </div>
            <div class="card">
                New request: <?php echo $request['0'] ?>
            </div>
            <div class="card">
                Approved ID's: <?php echo $approve['0'] ?>
            </div>
        </div>
    </div>
    <?php
    // endwhile;
    ?>
</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_css_sidenav by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2019 03:50:09 GMT -->

</html>