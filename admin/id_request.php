<?php
session_start();
require '../connection.php';

$sql = "SELECT * FROM user WHERE request = '1' AND status = 'notapproved'";
$allstudent = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
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
    <div class="main">
        <h2>All Id Card Request</h2>

        <div style="overflow-x:auto;">
            <table>
                <tr>
                    <th>Fullname</th>
                    <th>Matric</th>
                    <th>Gender</th>
                    <th>Level</th>
                    <th>Passport</th>
                    <th>Request</th>
                    <th>Status</th>
                </tr>
                <?php
                $x = 0;
                while ($row = mysqli_fetch_array($allstudent)) :
                    $fullname = $row['fullname'];
                    $matric = $row['matric_number'];
                    $gender = $row['gender'];
                    $level = $row['level'];
                    $passport = $row['passport'];
                    $request = $row['request'];
                    $status = $row['status'];

                ?>
                    <tr>
                        <td><?php echo $fullname ?></td>
                        <td><?php echo $matric ?></td>
                        <td><?php echo $gender ?></td>
                        <td><?php echo $level ?></td>
                        <td><img src="<?php echo $passport ?>" alt="passport" srcset="" width="50px" height="50px"></td>
                        <td><?php echo $request ?></td>
                        <td>
                            <?php
                            if ($status == 'approved') {
                                echo "<a href='script/approve.php?usermatric=$matric&userstatus=$status&userrequest=$request'>Disapprove</a>";
                            } else {
                                echo "<a href='script/approve.php?usermatric=$matric&userstatus=$status&userrequest=$request'>Approve</a>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                endwhile;
                ?>
                <table>
        </div>
    </div>

</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_css_table_responsive by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2019 03:58:12 GMT -->

</html>