<?php
include("connect.php");
session_start();

if(!isset($_SESSION['userid']) || ($_SESSION['userid'] != '1')) {
    header('Location: login.php');
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    echo 'The id is '.$id;
    $sql = "DELETE FROM clans WHERE id = $id";
    $conn->query($sql);
    header('Location: admin.php');
}




?>