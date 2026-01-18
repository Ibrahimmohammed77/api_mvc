<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - نظام MVC</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- CSS المشروع -->
    <link rel="stylesheet" href="<?php echo \App\Core\Path::url('css/dashboard.css'); ?>" />
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
                    <a href="<?php echo \App\Core\Path::url(''); ?>" class="active">
                        <i class="fas fa-tachometer-alt"></i>
                        الرئيسية
                    </a>
                </li>
                <li>
                    <a href="<?php echo \App\Core\Path::url('dashboard/profile'); ?>">
                        <i class="fas fa-user"></i>
                        الملف الشخصي
                    </a>
                </li>
                <li>
                    <a href="<?php echo \App\Core\Path::url('dashboard/settings'); ?>">
                        <i class="fas fa-cog"></i>
                        الإعدادات
                    </a>
                </li>
                <li>
                    <form action="<?php echo \App\Core\Path::url('logout'); ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-link p-0" style="border:none; background:none;">
                            <i class="fas fa-sign-out-alt"></i>
                            تسجيل الخروج
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer" style="position: absolute; bottom: 0; width: 100%; padding: 20px; text-align: center;">
            <small style="opacity: 0.7;">الإصدار 1.0.0</small>
        </div>
    </div>

    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        <!-- شريط العلوي -->
        <div class="topbar">
            <div>
                <h1>لوحة التحكم</h1>
                <p class="text-muted mb-0" id="current-time"></p>
            </div>

            <div class="user-info">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($user->full_name, 0, 1)); ?>
                        </div>
                        <?php echo htmlspecialchars($user->username); ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="<?php echo \App\Core\Path::url('dashboard/profile'); ?>">
                                <i class="fas fa-user me-2"></i>الملف الشخصي
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo \App\Core\Path::url('dashboard/settings'); ?>">
                                <i class="fas fa-cog me-2"></i>الإعدادات
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="<?php echo \App\Core\Path::url('logout'); ?>" method="POST" style="display:inline;">
                                <button type="submit" class="dropdown-item text-danger p-0" style="border:none; background:none;">
                                    <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- عرض رسائل النجاح -->
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo htmlspecialchars($success_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- بطاقة الترحيب -->
        <div class="card welcome-card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="card-title">مرحباً بك، <?php echo htmlspecialchars($user->full_name); ?>!</h2>
                        <p class="mb-4">هذا مشروع تعليمي يوضح كيفية بناء نظام MVC باستخدام PHP مع AutoLoad وNamespaces.</p>
                        <a href="<?php echo \App\Core\Path::url('dashboard/profile'); ?>" class="btn btn-light">عرض الملف الشخصي</a>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-graduation-cap" style="font-size: 5rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقات الإحصائيات -->
        <div class="cards-container mb-4">
            <div class="card stats-card users">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">المستخدمون</h5>
                            <p class="card-value">1</p>
                            <p class="text-muted mb-0">أنت المستخدم الوحيد</p>
                        </div>
                        <i class="fas fa-users" style="font-size: 2.5rem; color: var(--success-color); opacity: 0.7;"></i>
                    </div>
                </div>
            </div>

            <div class="card stats-card views">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">المشاهدات</h5>
                            <p class="card-value">1</p>
                            <p class="text-muted mb-0">مشاهدة اليوم</p>
                        </div>
                        <i class="fas fa-eye" style="font-size: 2.5rem; color: var(--info-color); opacity: 0.7;"></i>
                    </div>
                </div>
            </div>

            <div class="card stats-card sessions">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">الجلسات</h5>
                            <p class="card-value">1</p>
                            <p class="text-muted mb-0">جلسة نشطة</p>
                        </div>
                        <i class="fas fa-clock" style="font-size: 2.5rem; color: var(--warning-color); opacity: 0.7;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول النشاط -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>النشاط الأخير</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>النشاط</th>
                                <th>الوقت</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>تسجيل الدخول</td>
                                <td>منذ لحظات</td>
                                <td><span class="badge bg-success">مكتمل</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>تحميل لوحة التحكم</td>
                                <td>الآن</td>
                                <td><span class="badge bg-info">جاري</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- معلومات المشروع -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>معلومات عن المشروع</h5>
            </div>
            <div class="card-body">
                <p>هذا المشروع التعليمي يغطي المواضيع التالية:</p>
                <ul>
                    <li><strong>نمط MVC:</strong> فصل المنطق عن العرض عن البيانات</li>
                    <li><strong>AutoLoad:</strong> تحميل الكلاسات تلقائياً</li>
                    <li><strong>Namespaces:</strong> تنظيم الكود ومنع تعارض الأسماء</li>
                    <li><strong>Routing:</strong> توجيه الطلبات بشكل ديناميكي</li>
                    <li><strong>PDO:</strong> التعامل الآمن مع قواعد البيانات</li>
                    <li><strong>Sessions:</strong> إدارة جلسات المستخدمين</li>
                </ul>

                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>نصيحة:</strong> يمكنك استكشاف الكود المصدري لفهم كيفية عمل كل جزء.
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo \App\Core\Path::url('js/index.js'); ?>">

    </script>
</body>

</html>