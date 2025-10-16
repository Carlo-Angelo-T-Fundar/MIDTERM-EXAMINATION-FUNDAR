<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Student Portal</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Custom styling for announcements page */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .announcement-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .announcement-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .announcement-title {
            color: #667eea;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .announcement-content {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .announcement-date {
            color: #999;
            font-size: 0.9rem;
            font-style: italic;
        }
        
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state {
            background: white;
            border-radius: 15px;
            padding: 60px 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-graduation-cap"></i> Student Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
                            <i class="fas fa-user"></i> <?= esc($user_name) ?> 
                            <span class="badge bg-info"><?= esc(ucfirst($user_role)) ?></span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('announcements') ?>">
                            <i class="fas fa-bullhorn"></i> Announcements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container announcement-container">
        
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="mb-0">
                <i class="fas fa-bullhorn text-primary"></i> Announcements
            </h1>
            <p class="text-muted mb-0 mt-2">Stay updated with the latest news and updates</p>
        </div>

        <!-- Flash Messages (Success/Error) -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Announcements List -->
        <?php if (!empty($announcements) && count($announcements) > 0): ?>
            
            <!-- Loop through each announcement and display it -->
            <?php foreach ($announcements as $announcement): ?>
                <div class="announcement-card">
                    <!-- Announcement Title -->
                    <h3 class="announcement-title">
                        <i class="fas fa-info-circle"></i> <?= esc($announcement['title']) ?>
                    </h3>
                    
                    <!-- Announcement Content -->
                    <div class="announcement-content">
                        <?= nl2br(esc($announcement['content'])) ?>
                    </div>
                    
                    <!-- Announcement Date -->
                    <div class="announcement-date">
                        <i class="fas fa-calendar-alt"></i> 
                        Posted on: <?= date('F d, Y \a\t h:i A', strtotime($announcement['created_at'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
        <?php else: ?>
            
            <!-- Empty State - No announcements found -->
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3 class="text-muted">No Announcements Yet</h3>
                <p class="text-muted">Check back later for updates and important information.</p>
            </div>
            
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
