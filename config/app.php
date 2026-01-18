<?php
use App\Core\Path;

return [
    'name' => 'مشروع MVC التعليمي',
    'debug' => true,
    'charset' => 'UTF-8',
    'paths' => [
        'views' => Path::views(),
    ],
    
    'app_name' => 'Project MVC',
    'app_url' => 'http://localhost/api_mvc/public',

    // إعدادات JWT
    'jwt_secret' => 'مفتاح_سري_طويل_وصعب_التخمين_جداً',
    'jwt_exp' => 3600 // بالثواني

];
