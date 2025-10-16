<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Student Portal</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Custom styling for teacher dashboard */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 60px;
            text-align: center;
            max-width: 600px;
            width: 90%;
        }
        
        .welcome-icon {
            font-size: 5rem;
            color: #667eea;
            margin-bottom: 30px;
        }
        
        .welcome-text {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        
        .subtitle {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        
        .nav-buttons {
            margin-top: 40px;
        }
        
        .nav-buttons .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <!-- Welcome Icon -->
        <div class="welcome-icon">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        
        <!-- Welcome Message -->
        <h1 class="welcome-text">
            Welcome, Teacher!
        </h1>
        
        <p class="subtitle">
            You have successfully accessed the Teacher Dashboard
        </p>
        
        <!-- Optional: Display teacher information if available in session -->
        <?php if (session()->get('name')): ?>
            <div class="alert alert-info">
                <i class="fas fa-user"></i> Logged in as: <strong><?= esc(session()->get('name')) ?></strong>
            </div>
        <?php endif; ?>
        
        <!-- Navigation Buttons -->
        <div class="nav-buttons">
            <a href="<?= base_url('announcements') ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-bullhorn"></i> View Announcements
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-lg">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
