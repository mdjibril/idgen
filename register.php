<?php

    session_start();
    require 'connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* style the container */
        .container {
            /* position: relative; */
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px 0 30px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* style inputs and link buttons */
        input,
        select,
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            margin: 5px 0;
            opacity: 0.85;
            display: inline-block;
            font-size: 17px;
            line-height: 20px;
            text-decoration: none;
            /* remove underline from anchors */
        }

        input:hover,
        .btn:hover {
            opacity: 1;
        }

        /* add appropriate colors to fb, twitter and google buttons */
        .fb {
            background-color: #3B5998;
            color: white;
        }

        .twitter {
            background-color: #55ACEE;
            color: white;
        }

        .google {
            background-color: #dd4b39;
            color: white;
        }

        /* style the submit button */
        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Two-column layout */
        .col {
            float: left;
            width: 50%;
            margin: auto;
            padding: 0 50px;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* vertical line */
        .vl {
            position: absolute;
            left: 50%;
            transform: translate(-50%);
            border: 2px solid #ddd;
            height: 175px;
        }

        /* text inside the vertical line */
        .vl-innertext {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-radius: 50%;
            padding: 8px 10px;
        }

        /* hide some text on medium and large screens */
        .hide-md-lg {
            display: none;
        }

        /* bottom container */
        .bottom-container {
            text-align: center;
            background-color: #666;
            border-radius: 0px 0px 4px 4px;
        }

        /* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 650px) {
            .col {
                width: 100%;
                margin-top: 0;
            }

            /* hide the vertical line */
            .vl {
                display: none;
            }

            /* show the hidden text on small screens */
            .hide-md-lg {
                display: block;
                text-align: center;
            }
        }

        #admin {
            line-height: 120px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="register_handler.php" method="post">
            <div class="row">
                <h2 style="text-align:center">ID CARD GENERATOR</h2>
                <div class="vl">
                    <span class="vl-innertext"></span>
                </div>

                <div class="col">
                <a href="#" class="fb btn" id="admin">
                        <i class="fa fa-user fa-fw"></i> User Register
                    </a>
                </div>

                <div class="col">
                    <div class="hide-md-lg">
                        <!-- <p>Or Register</p> -->
                    </div>
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p style='color:red'>".$_SESSION['error']."</p>";
                        }
                    ?>
                    
                    <input type="text" name="matric" placeholder="Matric" required>
                    <input type="text" name="fullname" placeholder="Fullname" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <select name="gender" id="">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Male">Female</option>
                    </select>
                    <select name="level" id="">
                        <option value="">Select Level</option>
                        <option value="100">100-Level</option>
                        <option value="200">200-Level</option>
                        <option value="300">300-Level</option>
                        <option value="400">400-Level</option>
                        <option value="500">500-Level</option>
                    </select>
                    <input type="submit" value="Register" name="register">
                    <a href="index" class=" btn" style="text-align:center"><i class="fa fa-login fa-fw">
                        </i> Already have an account Login
                    </a>
                </div>

            </div>
        </form>
    </div>
</body>

</html>
<?php 
    unset($_SESSION['error']);
?>