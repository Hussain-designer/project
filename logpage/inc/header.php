<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Bootstrap Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .sidebar {
    width: 250px;         
    min-height: 100vh;
    background: #343a40;
    color: #fff;
    }

    .sidebar .nav-link {
    color: #adb5bd;
    }

    .sidebar .nav-link.active {
    background: #495057;
    color: #fff;
    }

    @media (max-width: 992px) { 
        .sidebar {
            display: none;
        }
    }



    /*datatable*/

  </style>
</head>
<body>
  <div class="d-flex">