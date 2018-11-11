<?php
include('connect.php');
session_start();

if(!isset($_SESSION['userid']) || ($_SESSION['userid'] != '1')) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fortnite Clan - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css" />
    <style>
      .wrapper {
        min-height:100vh;
        position:relative;
      }
      .admin-bg {
        background-image: url('images/adminbg.jpg');
        background-position: center center;
        background-attachment: fixed;
        background-size:100% auto;
      }
      .bg-primary-gradient {
        background: linear-gradient(45deg,#007bff, #0035cc);
      }

      .bg-info-gradient {
        background: linear-gradient(45deg, #17a2b8, #006880);
      }

      .bg-success-gradient {
        background: linear-gradient(45deg,#28a745, #006700);
      }
      body {
          margin:0;
          padding:0;
          height:100%;
      }
      main {
        padding-bottom: 150px;
      }
      footer {
        position: absolute;
        bottom:0;
      }
    </style>
</head>
<body class="admin-bg">
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-light" href="admin.php"><i class="fas fa-columns"></i> Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-gopuram"></i> Manage Clans
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">View Clans</a>
                  <a class="dropdown-item" href="add.php">Add Clans</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="manageusers.php"><i class="fas fa-user"></i> Manage Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="add.php"><i class="fas fa-star"></i> Manage Featured</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="add.php"><i class="fas fa-cog"></i> Website Settings</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" action="logout.php" method="post">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Logout <i class="fas fa-sign-out-alt"></i></button>
          </form>
        </div>
    </nav>
    <main>
