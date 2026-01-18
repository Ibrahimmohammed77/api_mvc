<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

/**
 * متحكم التسجيل - يدير عمليات تسجيل المستخدمين الجدد
 */
class RegisterController extends Controller
{
    /**
     * @var User نموذج المستخدم
     */
    private $userModel;

    /**
     * البناء - تهيئة نموذج المستخدم
     */
    public function __construct()
    {
        $this->userModel = $this->model('User');
        
        // بدء الجلسة
        Session::init();
        
        // إذا كان المستخدم مسجل الدخول بالفعل، قم بتوجيهه إلى لوحة التحكم
        if (Session::has('user_id')) {
            $this->redirect('dashboard');
        }
    }

    /**
     * عرض نموذج التسجيل
     * @return void
     */
    public function showRegisterForm()
    {
        $data = [
            'title' => 'إنشاء حساب جديد',
            'username' => '',
            'email' => '',
            'full_name' => '',
            'errors' => []
        ];
        
        // عرض رسائل الخطأ إذا وجدت
        if (Session::hasFlash('errors')) {
            $data['errors'] = Session::getFlash('errors');
            $data['username'] = Session::getFlash('old_username') ?? '';
            $data['email'] = Session::getFlash('old_email') ?? '';
            $data['full_name'] = Session::getFlash('old_full_name') ?? '';
        }
        
        $this->view('auth/register', $data);
    }

    /**
     * معالجة طلب التسجيل
     * @return void
     */
    public function register()
    {
        // التحقق من وجود البيانات المطلوبة
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('register');
        }

        // جمع البيانات من النموذج
        $data = [
            'username' => trim($_POST['username'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirmation' => $_POST['password_confirmation'] ?? '',
            'full_name' => trim($_POST['full_name'] ?? '')
        ];

        // مصفوفة لتخزين الأخطاء
        $errors = [];

        // التحقق من صحة البيانات
        $errors = $this->validateRegistrationData($data);

        // إذا كان هناك أخطاء، قم بإعادة التوجيه مع عرض الأخطاء
        if (!empty($errors)) {
            Session::setFlash('errors', $errors);
            Session::setFlash('old_username', $data['username']);
            Session::setFlash('old_email', $data['email']);
            Session::setFlash('old_full_name', $data['full_name']);
            $this->redirect('register');
        }

        // إنشاء المستخدم
        $userData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'full_name' => $data['full_name']
        ];

        if ($this->userModel->create($userData)) {
            // رسالة نجاح
            Session::setFlash('success', 'تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول');
            
            // التوجيه إلى صفحة تسجيل الدخول
            $this->redirect('login');
        } else {
            // رسالة خطأ عامة
            Session::setFlash('errors', ['general' => 'حدث خطأ أثناء إنشاء الحساب. الرجاء المحاولة مرة أخرى']);
            Session::setFlash('old_username', $data['username']);
            Session::setFlash('old_email', $data['email']);
            Session::setFlash('old_full_name', $data['full_name']);
            $this->redirect('register');
        }
    }

    /**
     * التحقق من صحة بيانات التسجيل
     * @param array $data
     * @return array
     */
    private function validateRegistrationData($data)
    {
        $errors = [];

        // التحقق من اسم المستخدم
        if (empty($data['username'])) {
            $errors['username'] = 'اسم المستخدم مطلوب';
        } elseif (strlen($data['username']) < 3) {
            $errors['username'] = 'اسم المستخدم يجب أن يكون على الأقل 3 أحرف';
        } elseif ($this->userModel->usernameExists($data['username'])) {
            $errors['username'] = 'اسم المستخدم موجود بالفعل';
        }

        // التحقق من البريد الإلكتروني
        if (empty($data['email'])) {
            $errors['email'] = 'البريد الإلكتروني مطلوب';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'البريد الإلكتروني غير صالح';
        } elseif ($this->userModel->emailExists($data['email'])) {
            $errors['email'] = 'البريد الإلكتروني موجود بالفعل';
        }

        // التحقق من كلمة المرور
        if (empty($data['password'])) {
            $errors['password'] = 'كلمة المرور مطلوبة';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = 'كلمة المرور يجب أن تكون على الأقل 6 أحرف';
        } elseif ($data['password'] !== $data['password_confirmation']) {
            $errors['password_confirmation'] = 'كلمات المرور غير متطابقة';
        }

        // التحقق من الاسم الكامل
        if (empty($data['full_name'])) {
            $errors['full_name'] = 'الاسم الكامل مطلوب';
        } elseif (strlen($data['full_name']) < 2) {
            $errors['full_name'] = 'الاسم الكامل يجب أن يكون على الأقل حرفين';
        }

        return $errors;
    }
}