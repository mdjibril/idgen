<?php
session_start();
require '../connection.php';

if (!isset($_GET['matric'])) {
  header('location: ../index.php');
}

$current_matric = $_GET['matric'];
$sql = "SELECT * FROM `user` WHERE `matric_number` = $current_matric";
$getStudent = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
  <title>ID Card</title>
  <style>
    * {
      border: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      padding: 0;
      margin: 0;
    }
    section {
      display: flex;
      justify-content: space-around;
      align-items: center;
      height: 100vh;
      background: #f4f7fc;
      font-family: Arial, sans-serif;
    }

    .id-card {
      /* position: relative; */
      width: 400px;
      height: 200px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 10px;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-around;
      align-items: center;
      flex-direction: row;
      border: 2px solid red;

    }



    .id-card img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .id-card h3 {
      margin: 0;
      font-size: 16px;
      font-weight: normal;
    }

    .id-card p {
      margin: 5px 0;
      font-size: 14px;
      color: #888;
    }

    .id-card button {
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
    }

    .top {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50px;
      position: fixed;
      background-color: #007bff;
      width: 100%;
    }
    
    .top a {
      text-decoration: none;
      color:white;
      /* background-color: #888; */
    }
  </style>
</head>

<body>
  <div class="top">
    <h1><a href="dashboard.php">Back to Dashboard</a></h1>
  </div>
  <section>
    <?php
    while ($row = mysqli_fetch_array($getStudent)) :
      $passport = $row['passport'];
      $matric = $row['matric_number'];
      $fullname = $row['fullname'];
      $gender = $row['gender'];
      $level = $row['level'];
    ?>
      <div class="id-card front">
        <img src="<?php echo $passport ?>" alt="User Image">
        <div class="info">
          <h3><?php echo $fullname ?></h3>
          <p>Registration Number: <?php echo $matric ?></p>
          <p>Level: <?php echo $level ?></p>
          <p>Gender: <?php echo $gender ?></p>
        </div>
        <!-- <button onclick="window.print()">Print ID Card</button> -->
      </div>

      <div class="id-card back">
        <div class="info">
          <h3>Back of ID Card</h3>
          <p>Add more detail here</p>
        </div>
        <!-- <button onclick="window.print()">Print ID Card</button> -->
      </div>
    <?php
    endwhile;
    ?>
  </section>
</body>

</html>