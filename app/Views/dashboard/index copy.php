<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم المتقدمة - نظام MVC الاحترافي</title>
    
    <!-- الخطوط العربية -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- CSS الخاص -->
    <link rel="stylesheet" href="<?php echo \App\Core\Path::url('css/dashboard.css'); ?>">
</head>

<body class="dark-mode">
    <!-- الشريط الجانبي الاحترافي -->
    <nav class="sidebar-nav">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="fas fa-code"></i>
            </div>
            <div class="logo-text">
                <h3>MVC<span>PRO</span></h3>
                <p>نظام إدارة متكامل</p>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar glow">
                <?php echo strtoupper(substr($user->full_name, 0, 1)); ?>
            </div>
            <div class="user-info">
                <h5><?php echo htmlspecialchars($user->full_name); ?></h5>
                <span class="user-role">مدير النظام</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-item active">
                <a href="<?php echo \App\Core\Path::url('dashboard'); ?>">
                    <i class="fas fa-home"></i>
                    <span>الرئيسية</span>
                    <div class="menu-badge">2</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo \App\Core\Path::url('dashboard/profile'); ?>">
                    <i class="fas fa-user-circle"></i>
                    <span>الملف الشخصي</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo \App\Core\Path::url('dashboard/analytics'); ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>الإحصائيات</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo \App\Core\Path::url('dashboard/users'); ?>">
                    <i class="fas fa-users"></i>
                    <span>المستخدمين</span>
                    <div class="menu-badge new">جديد</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo \App\Core\Path::url('dashboard/settings'); ?>">
                    <i class="fas fa-cogs"></i>
                    <span>الإعدادات</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo \App\Core\Path::url('dashboard/support'); ?>">
                    <i class="fas fa-headset"></i>
                    <span>الدعم الفني</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="<?php echo \App\Core\Path::url('logout'); ?>" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>تسجيل الخروج</span>
            </a>
            <div class="version">v2.1.0</div>
        </div>
    </nav>

    <!-- المحتوى الرئيسي -->
    <main class="main-content">
        <!-- شريط التنبيهات -->
        <?php if (!empty($success_message)): ?>
        <div class="alert-toast show" id="successToast">
            <div class="toast-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-content">
                <h6>تم بنجاح!</h6>
                <p><?php echo htmlspecialchars($success_message); ?></p>
            </div>
            <button class="toast-close" onclick="this.parentElement.classList.remove('show')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?php endif; ?>

        <!-- شريط العلوي -->
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">
                    <span id="greetingText">مرحباً بعودتك،</span>
                    <span class="highlight"><?php echo explode(' ', $user->full_name)[0]; ?>!</span>
                </h1>
                <p class="page-subtitle">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="currentDate"></span>
                    <span class="separator">•</span>
                    <i class="fas fa-clock"></i>
                    <span id="currentTime"></span>
                </p>
            </div>

            <div class="header-right">
                <div class="header-actions">
                    <button class="action-btn notification-btn" data-count="3">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="action-btn theme-toggle" id="themeToggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    <div class="user-dropdown">
                        <button class="user-profile-btn">
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user->full_name); ?>&background=6C63FF&color=fff" 
                                 alt="<?php echo htmlspecialchars($user->username); ?>">
                            <span><?php echo htmlspecialchars($user->username); ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="<?php echo \App\Core\Path::url('dashboard/profile'); ?>" class="dropdown-item">
                                <i class="fas fa-user"></i>الملف الشخصي
                            </a>
                            <a href="<?php echo \App\Core\Path::url('dashboard/settings'); ?>" class="dropdown-item">
                                <i class="fas fa-cog"></i>الإعدادات
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo \App\Core\Path::url('logout'); ?>" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i>تسجيل الخروج
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- بطاقات الإحصائيات -->
        <section class="stats-section">
            <div class="section-header">
                <h2>نظرة عامة</h2>
                <a href="#" class="view-all">عرض الكل <i class="fas fa-arrow-left"></i></a>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card primary animate__animated animate__fadeInUp">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value" data-count="125">0</h3>
                        <p class="stat-label">إجمالي المستخدمين</p>
                    </div>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 12% هذا الشهر
                    </div>
                </div>

                <div class="stat-card success animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value" data-count="89">0</h3>
                        <p class="stat-label">نشطون الآن</p>
                    </div>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 8% هذا الأسبوع
                    </div>
                </div>

                <div class="stat-card warning animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value" data-count="256">0</h3>
                        <p class="stat-label">الطلبات اليوم</p>
                    </div>
                    <div class="stat-trend down">
                        <i class="fas fa-arrow-down"></i> 3% أقل من أمس
                    </div>
                </div>

                <div class="stat-card info animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value" data-count="5240">0</h3>
                        <p class="stat-label">الإيرادات</p>
                    </div>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 24% هذا الشهر
                    </div>
                </div>
            </div>
        </section>

        <!-- المخططات والإحصائيات -->
        <section class="charts-section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card chart-card">
                        <div class="card-header">
                            <h5>نظرة عامة على النشاط</h5>
                            <select class="chart-period">
                                <option>الأسبوع الحالي</option>
                                <option>الشهر الحالي</option>
                                <option>هذا العام</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <canvas id="activityChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card traffic-card">
                        <div class="card-header">
                            <h5>مصادر الزيارات</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="trafficChart"></canvas>
                            <div class="traffic-legend">
                                <div class="legend-item direct">
                                    <span class="dot"></span>
                                    <span>مباشر: 40%</span>
                                </div>
                                <div class="legend-item social">
                                    <span class="dot"></span>
                                    <span>اجتماعي: 30%</span>
                                </div>
                                <div class="legend-item search">
                                    <span class="dot"></span>
                                    <span>بحث: 20%</span>
                                </div>
                                <div class="legend-item referral">
                                    <span class="dot"></span>
                                    <span>إحالات: 10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- الجداول والنشاط -->
        <section class="tables-section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card recent-activity">
                        <div class="card-header">
                            <h5>النشاط الأخير</h5>
                            <a href="#" class="btn-sm">عرض الكل</a>
                        </div>
                        <div class="card-body">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon success">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>مستخدم جديد مسجل</h6>
                                        <p>محمد أحمد انضم للتو</p>
                                        <span class="activity-time">منذ 5 دقائق</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon warning">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>طلب جديد</h6>
                                        <p>تم تقديم طلب #ORD-7894</p>
                                        <span class="activity-time">منذ ساعة</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon info">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>تقرير مبيعات</h6>
                                        <p>تم إنشاء تقرير المبيعات الشهري</p>
                                        <span class="activity-time">منذ 3 ساعات</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon primary">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>تحديث النظام</h6>
                                        <p>تم تحديث النظام إلى النسخة 2.1.0</p>
                                        <span class="activity-time">منذ 5 ساعات</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card project-progress">
                        <div class="card-header">
                            <h5>تقدم المشروع</h5>
                        </div>
                        <div class="card-body">
                            <div class="progress-item">
                                <div class="progress-info">
                                    <span>تصميم الواجهة</span>
                                    <span>85%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 85%"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-info">
                                    <span>تطوير النظام</span>
                                    <span>70%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 70%"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-info">
                                    <span>الاختبارات</span>
                                    <span>45%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 45%"></div>
                                </div>
                            </div>
                            <div class="progress-item">
                                <div class="progress-info">
                                    <span>التوثيق</span>
                                    <span>30%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- معلومات النظام -->
        <footer class="system-footer">
            <div class="row">
                <div class="col-md-4">
                    <div class="system-info">
                        <h6><i class="fas fa-server"></i> حالة النظام</h6>
                        <div class="system-status online">
                            <span class="status-dot"></span>
                            <span>جميع الأنظمة تعمل</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="system-info">
                        <h6><i class="fas fa-database"></i> استخدام التخزين</h6>
                        <div class="storage-bar">
                            <div class="storage-fill" style="width: 65%"></div>
                        </div>
                        <small>3.2GB من 5GB مستخدم</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="system-info">
                        <h6><i class="fas fa-shield-alt"></i> الأمان</h6>
                        <div class="security-level high">
                            <i class="fas fa-lock"></i>
                            <span>مستوى أمان عالي</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- مكتبات JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo \App\Core\Path::url('js/dashboard.js'); ?>"></script>
    <script>
        // كود JavaScript سيتم وضعه في ملف منفصل
    </script>
</body>
</html>