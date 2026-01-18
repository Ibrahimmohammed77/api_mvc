<?php
// routes/web.php
use App\Core\Router;

// إنشاء كائن الراوتر
$router = new Router();

// تعريف مسارات الصفحات الرئيسية
$router->get('/', 'AuthController@login');
$router->get('', 'AuthController@login');
$router->post('/', 'AuthController@attemptLogin');

// مسارات المصادقة
$router->get('login', 'AuthController@login');
$router->post('login', 'AuthController@attemptLogin');
$router->get('register', 'RegisterController@showRegisterForm');
$router->post('register', 'RegisterController@register');
$router->post('logout', 'AuthController@logout');

// مسارات لوحة التحكم (محمية)
$router->get('dashboard', 'DashboardController@index');
$router->get('dashboard/profile', 'DashboardController@profile');

// يمكنك إضافة المزيد من المسارات هنا

// إرجاع كائن الراوتر للاستخدام
return $router;