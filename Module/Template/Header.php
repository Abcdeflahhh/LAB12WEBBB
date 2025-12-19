<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 11 - PHP - OOP | Routing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Style Umum */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0; 
            padding: 0;
            background-color: #f4f4f9; 
            color: #333;
        }
        header {
            background-color: #ffffff;
            border-bottom: 3px solid #007bff;
        }
        header h1 {
            color: #007bff;
            padding: 15px 20px;
            margin: 0;
            font-size: 24px;
        }
        
        /* Custom Navbar Adjustment */
        .navbar {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 0.5rem 1rem;
        }

        /* Layout */
        .main-container {
            display: flex;
            padding: 20px;
            min-height: 80vh;
        }

        /* Sidebar Styling */
        .sidebar { 
            width: 200px; 
            padding-right: 20px; 
            border-right: 1px solid #ddd; 
            background-color: #ffffff;
            padding-top: 10px;
        }
        .sidebar h3 {
            color: #007bff;
            font-size: 1.2rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 8px 0;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .sidebar li a:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        /* Content Area */
        .content { 
            flex-grow: 1; 
            padding-left: 30px; 
        }

        /* Table & Components */
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 15px;
            background-color: #ffffff;
        }
        thead th { 
            background-color: #007bff; 
            color: white; 
            padding: 12px; 
        }
        td { padding: 10px; border: 1px solid #ddd; }
        
        .btn { font-weight: bold; border-radius: 5px; }
    </style>
</head>
<body>

<header>
    <h1>Aplikasi Sederhana OOP & Routing</h1>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../home/index">Home</a>
                    </li>
                    <?php if (isset($_SESSION['is_login'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../artikel/index">Data Artikel</a>
                    </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['is_login'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/logout">Logout (<?= $_SESSION['nama'] ?>)</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/login">Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="main-container">
    <?php include TEMPLATE_PATH . "sidebar.php"; ?>

    <div class="content">
