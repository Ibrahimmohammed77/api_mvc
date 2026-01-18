<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- تنسيقات مخصصة -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h2 {
            color: #333;
            font-weight: 600;
        }
        
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-register {
            background-color: #4e73df;
            border-color: #4e73df;
            color: white;
            font-weight: 600;
            padding: 10px;
            width: 100%;
        }
        
        .btn-register:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }
        
        .register-links {
            margin-top: 20px;
            text-align: center;
        }
        
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 500;
            color: #555;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h2>إنشاء حساب جديد</h2>
                <p class="text-muted">الرجاء تعبئة جميع الحقول المطلوبة</p>
            </div>
            
            <!-- عرض رسالة الخطأ العامة إذا وجدت -->
            <?php if (isset($errors['general'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($errors['general']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo  \App\Core\Path::url('register');?>" id="registerForm">
                <div class="mb-3">
                    <label for="username" class="form-label">اسم المستخدم</label>
                    <input type="text" 
                           class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                           id="username" 
                           name="username" 
                           required
                           value="<?php echo htmlspecialchars($username); ?>"
                           placeholder="أدخل اسم المستخدم (3 أحرف على الأقل)">
                    <?php if (isset($errors['username'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['username']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" 
                           class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" 
                           id="email" 
                           name="email" 
                           required
                           value="<?php echo htmlspecialchars($email); ?>"
                           placeholder="أدخل بريدك الإلكتروني">
                    <?php if (isset($errors['email'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['email']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="full_name" class="form-label">الاسم الكامل</label>
                    <input type="text" 
                           class="form-control <?php echo isset($errors['full_name']) ? 'is-invalid' : ''; ?>" 
                           id="full_name" 
                           name="full_name" 
                           required
                           value="<?php echo htmlspecialchars($full_name); ?>"
                           placeholder="أدخل الاسم الكامل">
                    <?php if (isset($errors['full_name'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['full_name']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" 
                           class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" 
                           id="password" 
                           name="password" 
                           required
                           placeholder="أدخل كلمة المرور (6 أحرف على الأقل)">
                    <?php if (isset($errors['password'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['password']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" 
                           class="form-control <?php echo isset($errors['password_confirmation']) ? 'is-invalid' : ''; ?>" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required
                           placeholder="أعد إدخال كلمة المرور">
                    <?php if (isset($errors['password_confirmation'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['password_confirmation']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-register">إنشاء حساب</button>
                </div>
            </form>
            
            <div class="register-links">
                <p class="mb-0">لديك حساب بالفعل؟ <a href="/login">تسجيل الدخول</a></p>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small">
                    مشروع تعليمي - نظام MVC مع AutoLoad وNamespaces
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript للتحقق من صحة النموذج -->
    <script>
        // التركيز على حقل اسم المستخدم عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
        
        // التحقق من صحة النموذج قبل الإرسال
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var isValid = true;
            var username = document.getElementById('username').value.trim();
            var email = document.getElementById('email').value.trim();
            var fullName = document.getElementById('full_name').value.trim();
            var password = document.getElementById('password').value;
            var passwordConfirmation = document.getElementById('password_confirmation').value;
            
            // إعادة تعيين أخطاء التنسيق
            document.querySelectorAll('.is-invalid').forEach(function(element) {
                element.classList.remove('is-invalid');
            });
            
            // التحقق من اسم المستخدم
            if (username.length < 3) {
                document.getElementById('username').classList.add('is-invalid');
                showError('username', 'اسم المستخدم يجب أن يكون على الأقل 3 أحرف');
                isValid = false;
            }
            
            // التحقق من البريد الإلكتروني
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById('email').classList.add('is-invalid');
                showError('email', 'البريد الإلكتروني غير صالح');
                isValid = false;
            }
            
            // التحقق من الاسم الكامل
            if (fullName.length < 2) {
                document.getElementById('full_name').classList.add('is-invalid');
                showError('full_name', 'الاسم الكامل يجب أن يكون على الأقل حرفين');
                isValid = false;
            }
            
            // التحقق من كلمة المرور
            if (password.length < 6) {
                document.getElementById('password').classList.add('is-invalid');
                showError('password', 'كلمة المرور يجب أن تكون على الأقل 6 أحرف');
                isValid = false;
            }
            
            // التحقق من تطابق كلمات المرور
            if (password !== passwordConfirmation) {
                document.getElementById('password_confirmation').classList.add('is-invalid');
                showError('password_confirmation', 'كلمات المرور غير متطابقة');
                isValid = false;
            }
            
            // إذا لم يكن النموذج صالحاً، منع الإرسال
            if (!isValid) {
                event.preventDefault();
            }
        });
        
        // دالة لعرض رسائل الخطأ
        function showError(fieldId, message) {
            var field = document.getElementById(fieldId);
            var errorDiv = field.nextElementSibling;
            
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.textContent = message;
            } else {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.textContent = message;
                field.parentNode.appendChild(errorDiv);
            }
        }
    </script>
</body>
</html>