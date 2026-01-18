<?php
use App\Core\Config;

$appName = Config::get('app.name', 'مشروع MVC');
$appDebug = Config::get('app.debug', false);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>404 - الصفحة غير موجودة | <?= htmlspecialchars($appName) ?></title>
    
    <!-- ربط Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- خطوط Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
        }

        .error-container {
            max-width: 800px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-header {
            background: linear-gradient(to right, #4f6df5, #3a56d5);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .error-header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .error-header h1 i {
            font-size: 3rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .error-header h2 {
            font-size: 1.8rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .error-body {
            padding: 40px;
        }

        .error-icon {
            text-align: center;
            margin-bottom: 30px;
        }

        .error-icon i {
            font-size: 5rem;
            color: #ff6b6b;
            background: #ffeaea;
            width: 120px;
            height: 120px;
            line-height: 120px;
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .error-message {
            text-align: center;
            margin-bottom: 30px;
        }

        .error-message h3 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .error-message p {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto 20px;
        }

        .error-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 30px 0;
            border-right: 5px solid #4f6df5;
        }

        .error-details h4 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-details ul {
            list-style-type: none;
            padding-right: 20px;
        }

        .error-details li {
            padding: 8px 0;
            border-bottom: 1px dashed #ddd;
            color: #555;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-details li:last-child {
            border-bottom: none;
        }

        .error-details li i {
            color: #4f6df5;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .btn {
            padding: 14px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-family: 'Tajawal', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(to right, #4f6df5, #3a56d5);
            color: white;
            box-shadow: 0 5px 15px rgba(79, 109, 245, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(79, 109, 245, 0.6);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #555;
            border: 2px solid #ddd;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            border-color: #ccc;
            transform: translateY(-3px);
        }

        .btn-tertiary {
            background: transparent;
            color: #4f6df5;
            border: 2px solid #4f6df5;
        }

        .btn-tertiary:hover {
            background: rgba(79, 109, 245, 0.1);
            transform: translateY(-3px);
        }

        .error-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #eee;
            color: #777;
            font-size: 0.9rem;
        }

        .error-footer a {
            color: #4f6df5;
            text-decoration: none;
        }

        .error-footer a:hover {
            text-decoration: underline;
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .error-header h1 {
                font-size: 2.8rem;
            }
            
            .error-header h2 {
                font-size: 1.5rem;
            }
            
            .error-body {
                padding: 30px 20px;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
            }
            
            .error-icon i {
                width: 100px;
                height: 100px;
                line-height: 100px;
                font-size: 4rem;
            }
        }

        @media (max-width: 480px) {
            .error-header {
                padding: 20px;
            }
            
            .error-header h1 {
                font-size: 2.2rem;
            }
            
            .error-message h3 {
                font-size: 1.6rem;
            }
            
            .error-message p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-header">
            <h1>
                <i class="fas fa-exclamation-triangle"></i>
                404
            </h1>
            <h2>عذراً، الصفحة التي تبحث عنها غير موجودة</h2>
        </div>
        
        <div class="error-body">
            <div class="error-icon">
                <i class="fas fa-map-signs"></i>
            </div>
            
            <div class="error-message">
                <h3>لقد ضللت الطريق!</h3>
                <p>
                    يبدو أن الصفحة التي تحاول الوصول إليها قد تم نقلها أو حذفها أو أنها غير موجودة.
                    يرجى التحقق من العنوان أو العودة إلى الصفحة الرئيسية.
                </p>
            </div>
            
            <div class="error-details">
                <h4><i class="fas fa-info-circle"></i> معلومات تقنية عن الخطأ:</h4>
                <ul>
                    <li><i class="fas fa-link"></i> <strong>العنوان المطلوب:</strong> <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'غير معروف') ?></li>
                    <li><i class="fas fa-clock"></i> <strong>الوقت:</strong> <?= date('Y-m-d H:i:s') ?></li>
                    <li><i class="fas fa-globe"></i> <strong>المتصفح:</strong> <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'غير معروف') ?></li>
                    <?php if($appDebug): ?>
                    <li><i class="fas fa-code"></i> <strong>وضع التصحيح:</strong> مفعل</li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="action-buttons">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    العودة للصفحة الرئيسية
                </a>
                
                <a href="/login" class="btn btn-secondary">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول
                </a>
                
                <button onclick="window.history.back()" class="btn btn-tertiary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للصفحة السابقة
                </button>
            </div>
        </div>
        
        <div class="error-footer">
            <p>
                &copy; <?= date('Y') ?> - 
                <a href="/"><?= htmlspecialchars($appName) ?></a> | 
                جميع الحقوق محفوظة
                <?php if($appDebug): ?>
                | <span style="color: #28a745;">وضع التطوير مفعل</span>
                <?php endif; ?>
            </p>
        </div>
    </div>
    
    <script>
        // إضافة بعض التفاعلية للصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // إضافة تأثير عند تحميل الصفحة
            const container = document.querySelector('.error-container');
            container.style.transform = 'scale(0.95)';
            setTimeout(() => {
                container.style.transition = 'transform 0.5s ease';
                container.style.transform = 'scale(1)';
            }, 100);
            
            // تأثير عند المرور على الأزرار
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // إظهار رسالة في الكونسول للمطورين
            console.log('404 Error - Page not found: <?php echo $_SERVER['REQUEST_URI'] ?? "Unknown"; ?>');
            
            // إضافة تأثير صوتي بسيط (اختياري)
            const playErrorSound = () => {
                try {
                    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    const oscillator = audioContext.createOscillator();
                    const gainNode = audioContext.createGain();
                    
                    oscillator.connect(gainNode);
                    gainNode.connect(audioContext.destination);
                    
                    oscillator.frequency.value = 300;
                    oscillator.type = 'sine';
                    
                    gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                    
                    oscillator.start();
                    oscillator.stop(audioContext.currentTime + 0.5);
                } catch(e) {
                    // إذا لم يدعم المتصفح Web Audio API
                    console.log("Web Audio API not supported");
                }
            };
            
            // تشغيل الصوت عند تحميل الصفحة (اختياري)
            // playErrorSound();
        });
    </script>
</body>
</html>