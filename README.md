# مشروع تعليمي MVC مع AutoLoad وNamespaces

مشروع تعليمي متكامل يوضح كيفية بناء نظام MVC في PHP باستخدام AutoLoad وNamespaces.

## المميزات

- ✅ نظام توجيه (Routing) مرن
- ✅ تحميل تلقائي للكلاسات (AutoLoad)
- ✅ استخدام المساحات الاسمية (Namespaces)
- ✅ فصل كامل بين الموديل، الفيو، والكنترولر
- ✅ اتصال آمن بقاعدة البيانات باستخدام PDO
- ✅ نظام جلسات (Sessions) متكامل
- ✅ واجهة مستخدم عربية متجاوبة
- ✅ تحقق من صحة البيانات (Validation)
- ✅ حماية الصفحات (Authentication)
- ✅ تصميم عصري باستخدام Bootstrap 5

## هيكل المجلدات

api_mvc/
├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── RegisterController.php
│   │   └── DashboardController.php
│   ├── Models/
│   │   └── User.php
│   ├── Views/
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   └── dashboard.php
│   ├── Database/
│   │   └── Connection.php
│   ├── Core/
│   │   └── Router.php
│   └── Helpers/
│       └── Session.php
├── public/
│   └── index.php
├── autoload.php
├── routes.php
├── config.php
├── .htaccess
└── database.sql