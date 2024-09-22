<?php
require_once('function.php');
dbconnect();
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tailor MS</title>
    <!-- Local Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min2.css" rel="stylesheet">
  </head>
  <body>

  <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="index.php">
        Tailor MS
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php#order-form">Place an Order</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Orders
            </a>
            <ul class="dropdown-menu" aria-labelledby="ordersDropdown">
                <li><a class="dropdown-item" href="frontend_orderlist.php?status=pending">Pending Orders</a></li>
                <li><a class="dropdown-item" href="frontend_orderlist.php?status=confirmed">Confirmed Orders</a></li>
                <li><a class="dropdown-item" href="frontend_orderlist.php?status=completed">Completed Orders</a></li>
                <li><a class="dropdown-item" href="frontend_orderlist.php?status=canceled">Canceled Orders</a></li>
            </ul>
        </li>
        </ul>
    </div>
    <div class="d-flex">
        <?php if(!is_user()){
            ?><a href="signin.php" class="me-2 btn btn-primary">Login</a><?php
            ?><a href="register.php" class="btn btn-primary">Register</a><?php
        }else{
            ?><a href="signout.php" class="btn btn-primary">Logout</a><?php
        }
        ?>
    </div>
    </div>
</nav>
