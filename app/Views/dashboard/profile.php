<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- CSS المشروع -->
    <link rel="stylesheet" href="<?php echo \App\Core\Path::url('css/dashboard.css'); ?>">
    
</head>
<body>
    <!-- الشريط الجانبي -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>لوحة التحكم</h3>
            <p>نظام MVC التعليمي</p>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="/dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        الرئيسية
                    </a>
                </li>
                <li>
                    <a href="/dashboard/profile" class="active">
                        <i class="fas fa-user"></i>
                        الملف الشخصي
                    </a>
                </li>
                <li>
                    <a href="/dashboard/stats">
                        <i class="fas fa-chart-bar"></i>
                        الإحصائيات
                    </a>
                </li>
                <li>
                    <a href="/dashboard/settings">
                        <i class="fas fa-cog"></i>
                        الإعدادات
                    </a>
                </li>
                <li>
                    <a href="/logout">
                        <i class="fas fa-sign-out-alt"></i>
                        تسجيل الخروج
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer" style="padding: 20px; position: absolute; bottom: 0; width: 100%; text-align: center;">
            <p style="font-size: 0.8rem; opacity: 0.7;">
                &copy; <?php echo date('Y'); ?> مشروع MVC
            </p>
        </div>
    </div>
    
    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        <!-- شريط العلوي -->
        <div class="topbar">
            <h1>الملف الشخصي</h1>
            
            <div class="user-info">
                <button class="btn btn-sm btn-outline-primary logout-btn" onclick="window.location.href='/logout'">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </button>
                <div>
                    <div class="name">مرحباً، <?php echo htmlspecialchars($user->full_name); ?></div>
                    <div class="text-muted small"><?php echo htmlspecialchars($user->email); ?></div>
                </div>
            </div>
        </div>
        
        <!-- بطاقة الملف الشخصي -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info">
                    <h2><?php echo htmlspecialchars($user->full_name); ?></h2>
                    <p>عضو منذ <?php echo date('Y/m/d', strtotime($user->created_at)); ?></p>
                </div>
            </div>
            
            <div class="profile-details">
                <div class="info-row">
                    <div class="info-label">اسم المستخدم:</div>
                    <div class="info-value"><?php echo htmlspecialchars($user->username); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">البريد الإلكتروني:</div>
                    <div class="info-value"><?php echo htmlspecialchars($user->email); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">الاسم الكامل:</div>
                    <div class="info-value"><?php echo htmlspecialchars($user->full_name); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">تاريخ التسجيل:</div>
                    <div class="info-value"><?php echo date('Y/m/d H:i:s', strtotime($user->created_at)); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">معرف المستخدم:</div>
                    <div class="info-value">#<?php echo htmlspecialchars($user->id); ?></div>
                </div>
            </div>
        </div>
        
        <!-- معلومات عن المشروع -->
        <div class="profile-card">
            <h4 class="mb-3"><i class="fas fa-info-circle me-2"></i> عن هذا العرض</h4>
            <p>هذه الصفحة توضح كيفية:</p>
            <ul>
                <li>استرجاع بيانات المستخدم من الجلسة (Session)</li>
                <li>عرض البيانات في واجهة مستخدم منظمة</li>
                <li>استخدام متحكم (Controller) لعرض صفحة محمية</li>
                <li>تطبيق تنسيقات متسقة عبر التطبيق</li>
            </ul>
            
            <div class="alert alert-info mt-3">
                <i class="fas fa-lightbulb me-2"></i>
                <strong>نصيحة تعليمية:</strong> البيانات المعروضة هنا تم استرجاعها من الجلسة، وليس من قاعدة البيانات مباشرةً، لتحسين الأداء.
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
   <?php echo \App\Core\Path::url('js/index.js'); ?>
</body>
</html>