<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
$activePage = basename($_SERVER['PHP_SELF'], ".php");
session_start();

?>
<!doctype html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
    crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> <?= (isset($pagetitle) ? $pagetitle : 'X-Wing ELO System') ?> </title>

    <style>
        body {
            background-image: url('./img/background.jpg');
        }
        .kerekitett{
            border-radius: 30px;
        }
    </style>
</head>

<body>
