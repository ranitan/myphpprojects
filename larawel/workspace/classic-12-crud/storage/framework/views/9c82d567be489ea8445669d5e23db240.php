<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts for Classic Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lora:wght@400;500;600&display=swap" rel="stylesheet">

    <title>Laravel 12 CRUD - Classic Management</title>
    
    <style>
      :root {
        --classic-primary: #2c3e50;
        --classic-secondary: #34495e;
        --classic-accent: #e74c3c;
        --classic-gold: #f39c12;
        --classic-light: #ecf0f1;
        --classic-dark: #1a252f;
        --classic-text: #333;
        --classic-border: #bdc3c7;
        --classic-shadow: rgba(44, 62, 80, 0.1);
      }

      body {
        font-family: 'Lora', serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        color: var(--classic-text);
      }

      /* Classic Navigation */
      .navbar-classic {
        background: linear-gradient(135deg, var(--classic-primary) 0%, var(--classic-secondary) 100%);
        box-shadow: 0 4px 20px var(--classic-shadow);
        padding: 1rem 0;
        border-bottom: 3px solid var(--classic-gold);
      }

      .navbar-brand {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.8rem;
        color: white !important;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        letter-spacing: 1px;
      }

      .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        font-size: 1.1rem;
        padding: 0.75rem 1.5rem !important;
        margin: 0 0.25rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .navbar-nav .nav-link:hover,
      .navbar-nav .nav-link.active {
        color: white !important;
        background: var(--classic-gold);
        box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        transform: translateY(-2px);
      }

      .navbar-nav .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
      }

      .navbar-nav .nav-link:hover::before {
        left: 100%;
      }

      /* Main Content Area */
      .content-wrapper {
        background: white;
        margin: 2rem auto;
        max-width: 1200px;
        border-radius: 15px;
        box-shadow: 0 10px 40px var(--classic-shadow);
        overflow: hidden;
        border: 1px solid var(--classic-border);
      }

      .content-header {
        background: linear-gradient(135deg, var(--classic-light) 0%, #fff 100%);
        padding: 2rem;
        border-bottom: 2px solid var(--classic-border);
        position: relative;
      }

      .content-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--classic-primary), var(--classic-gold), var(--classic-accent));
      }

      .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--classic-primary);
        margin: 0;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
      }

      .page-subtitle {
        color: var(--classic-secondary);
        font-size: 1.1rem;
        margin-top: 0.5rem;
        font-style: italic;
      }

      /* Classic Buttons */
      .btn-classic-primary {
        background: linear-gradient(135deg, var(--classic-primary) 0%, var(--classic-secondary) 100%);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
        position: relative;
        overflow: hidden;
      }

      .btn-classic-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.4);
        color: white;
      }

      .btn-classic-success {
        background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
      }

      .btn-classic-warning {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
      }

      .btn-classic-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
      }

      .btn-classic-success:hover,
      .btn-classic-warning:hover,
      .btn-classic-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        color: white;
      }

      /* Classic Table Styling */
      .table-classic {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin: 0;
      }

      .table-classic thead {
        background: linear-gradient(135deg, var(--classic-primary) 0%, var(--classic-secondary) 100%);
        color: white;
      }

      .table-classic thead th {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.2rem;
        border: none;
        font-size: 0.95rem;
      }

      .table-classic tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #eee;
      }

      .table-classic tbody tr:hover {
        background: rgba(52, 73, 94, 0.05);
        transform: scale(1.01);
      }

      .table-classic tbody td {
        padding: 1rem 1.2rem;
        vertical-align: middle;
        border: none;
      }

      /* Classic Cards */
      .card-classic {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border: 1px solid var(--classic-border);
        transition: all 0.3s ease;
        overflow: hidden;
      }

      .card-classic:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
      }

      .card-classic .card-header {
        background: linear-gradient(135deg, var(--classic-light) 0%, #fff 100%);
        border-bottom: 2px solid var(--classic-border);
        padding: 1.5rem;
      }

      /* Form Styling */
      .form-classic .form-control {
        border: 2px solid var(--classic-border);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 1rem;
      }

      .form-classic .form-control:focus {
        border-color: var(--classic-gold);
        box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
      }

      .form-classic .form-label {
        font-weight: 600;
        color: var(--classic-primary);
        margin-bottom: 0.75rem;
      }

      /* Alert Styling */
      .alert-classic {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
      }

      .alert-success {
        background: linear-gradient(135deg, rgba(39, 174, 96, 0.1) 0%, rgba(46, 204, 113, 0.1) 100%);
        color: #27ae60;
        border-left: 4px solid #27ae60;
      }

      .alert-danger {
        background: linear-gradient(135deg, rgba(231, 76, 60, 0.1) 0%, rgba(192, 57, 43, 0.1) 100%);
        color: #e74c3c;
        border-left: 4px solid #e74c3c;
      }

      /* Footer */
      .footer-classic {
        background: var(--classic-dark);
        color: white;
        text-align: center;
        padding: 2rem 0;
        margin-top: 3rem;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        .content-wrapper {
          margin: 1rem;
          border-radius: 10px;
        }
        
        .page-title {
          font-size: 2rem;
        }
        
        .navbar-brand {
          font-size: 1.4rem;
        }
      }

      /* Animation for page load */
      .fade-in {
        animation: fadeIn 0.8s ease-in-out;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-classic">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <i class="fas fa-crown me-2"></i><?php echo e(config('app.name')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border: none; box-shadow: none;">
          <span style="color: white;"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?php echo e(request()->routeIs('product.*') ? 'active' : ''); ?>" href="<?php echo e(route('product.index')); ?>">
                <i class="fas fa-box me-2"></i>Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo e(request()->routeIs('category.*') ? 'active' : ''); ?>" href="<?php echo e(route('category.index')); ?>">
                <i class="fas fa-tags me-2"></i>Categories
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="content-wrapper fade-in">
        <?php echo $__env->yieldContent('content'); ?>
      </div>
    </div>

    <footer class="footer-classic">
      <div class="container">
        <p class="mb-0">&copy; 2024 <?php echo e(config('app.name')); ?> - Classic Management System</p>
      </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
      // Add smooth scrolling and enhanced interactions
      document.addEventListener('DOMContentLoaded', function() {
        // Add ripple effect to buttons
        document.querySelectorAll('.btn').forEach(button => {
          button.addEventListener('click', function(e) {
            let ripple = document.createElement('span');
            let rect = this.getBoundingClientRect();
            let size = Math.max(rect.width, rect.height);
            let x = e.clientX - rect.left - size / 2;
            let y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
              ripple.remove();
            }, 600);
          });
        });
      });
    </script>

    <style>
      .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
      }

      @keyframes ripple-animation {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    </style>
  </body>
</html><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/layouts/layout.blade.php ENDPATH**/ ?>