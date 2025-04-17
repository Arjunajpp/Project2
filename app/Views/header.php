<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sarpras</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Custom CSS -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Styling Header */
        .header {
            background-color: #fff;
            padding: 10px 50px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
        }

        .header .logo {
            display: flex;
            align-items: center;
            margin-right: 450px;
        }

        .header img {
            height: 40px;
            margin-right: 10px;
        }

        .header .title {
            font-size: 24px;
            font-weight: bold;
            /* color: #28a745; */
        }

        .header .menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header .menu a {
            text-decoration: none;
            color: #28a745;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .header .menu a i {
            margin-right: 8px;
        }

    </style>
</head>
<body>

<!-- Header Section -->
<div class="header">
    <div class="logo">
        <img src="/assets/icon/logoppu.png" alt="E-Sarpras Logo">
        <span class="title">E-Sarpras</span>
    </div>
    <div class="menu">
        <a href="https://www.instagram.com/disdikporappu/"><i class="fas fa-globe"></i> DISDIKPORA</a>
        <!-- <a href="/sekolah"><i class="fas fa-school"></i> Sekolah</a> -->
        <a href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
    </div>
</div>
