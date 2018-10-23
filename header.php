<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fortnite Clan - Find your next clan here!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-2">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addclan.php"><i class="fas fa-plus"></i> Add Clan</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
            </li>
            </ul>
           
            <a href="login.php" ><button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-user-circle"></i> Sign In</button></a>
           
        </div>
    </nav>