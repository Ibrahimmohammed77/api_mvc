// dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    // تبديل الوضع المظلم/فاتح
    const themeToggle = document.getElementById('themeToggle');
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('light-mode');
        const icon = themeToggle.querySelector('i');
        if (document.body.classList.contains('light-mode')) {
            icon.className = 'fas fa-sun';
        } else {
            icon.className = 'fas fa-moon';
        }
    });

    // عدادات متحركة
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-value');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    }

    // تحديث التاريخ والوقت
    function updateDateTime() {
        const now = new Date();
        const dateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };
        
        document.getElementById('currentDate').textContent = 
            now.toLocaleDateString('ar-SA', dateOptions);
        document.getElementById('currentTime').textContent = 
            now.toLocaleTimeString('ar-SA', timeOptions);
        
        // تحديث التحية
        const hour = now.getHours();
        const greetingText = document.getElementById('greetingText');
        if (hour < 12) {
            greetingText.textContent = 'صباح الخير،';
        } else if (hour < 18) {
            greetingText.textContent = 'مساء الخير،';
        } else {
            greetingText.textContent = 'مساء الخير،';
        }
    }

    // تهيئة المخططات
    function initCharts() {
        // مخطط النشاط
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
                datasets: [{
                    label: 'المستخدمون النشطون',
                    data: [65, 78, 90, 85, 95, 105, 120],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // مخطط مصادر الزيارات
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        new Chart(trafficCtx, {
            type: 'doughnut',
            data: {
                labels: ['مباشر', 'اجتماعي', 'بحث', 'إحالات'],
                datasets: [{
                    data: [40, 30, 20, 10],
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#8b5cf6'
                    ]
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // تأثيرات التمرير
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card, .card').forEach(el => {
            observer.observe(el);
        });
    }

    // إخفاء التنبيهات تلقائياً
    function autoHideAlerts() {
        const alerts = document.querySelectorAll('.alert-toast');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 5000);
        });
    }

    // تهيئة جميع الوظائف
    function initDashboard() {
        updateDateTime();
        setInterval(updateDateTime, 1000);
        
        setTimeout(animateCounters, 500);
        setTimeout(initCharts, 1000);
        setTimeout(initScrollAnimations, 1500);
        setTimeout(autoHideAlerts, 2000);
    }

    // تشغيل النظام
    initDashboard();

    // التأثيرات التفاعلية الإضافية
    document.querySelectorAll('.menu-item a').forEach(item => {
        item.addEventListener('click', function(e) {
            document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
            this.parentElement.classList.add('active');
            
            // تأثير الانتقال
            document.body.style.opacity = '0.8';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 300);
        });
    });

    // تأثيرات خاصة عند التحميل
    window.addEventListener('load', () => {
        document.body.style.opacity = '0';
        document.body.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            document.body.style.opacity = '1';
            
            // تأثيرات دخول البطاقات
            document.querySelectorAll('.stat-card').forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        }, 100);
    });
});