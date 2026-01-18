<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Path;
use App\Core\Session;
use App\Models\User;

/**
 * متحكم المصادقة - يدير عمليات تسجيل الدخول والخروج
 */
class AuthController extends Controller
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
    }

    /**
     * عرض صفحة تسجيل الدخول
     * @return void
     */
    public function login()
    {
        // إذا كان المستخدم مسجل الدخول بالفعل، التوجيه مباشرة للـ dashboard
        if (self::check()) {
            $this->redirect('dashboard');
            exit;
        }

        $data = [
            'title' => 'تسجيل الدخول',
            'email' => '',
            'error' => ''
        ];
        
        if (Session::hasFlash('error')) {
            $data['error'] = Session::getFlash('error');
        }
        
        $this->view('auth/login', $data);
    }

    /**
     * محاولة تسجيل الدخول
     * @return void
     */
    public function attemptLogin()
    {
        // التحقق من وجود البيانات المطلوبة
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            Session::setFlash('error', 'الرجاء إدخال جميع البيانات');
            $this->redirect('login');
        }

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            Session::setFlash('error', 'الرجاء إدخال جميع البيانات');
            $this->redirect('login');
        }

        $user = $this->userModel->validateLogin($email, $password);
        
        if ($user) {
            // تسجيل بيانات المستخدم في الجلسة
            Session::set('user_id', $user->id);
            Session::set('user_email', $user->email);
            Session::set('user_username', $user->username);
            Session::set('user_full_name', $user->full_name);
            Session::set('user_created_at', $user->created_at);
            
            Session::setFlash('success', 'تم تسجيل الدخول بنجاح!');
            
            $this->redirect('dashboard');
        } else {
            Session::setFlash('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة');
            $this->redirect('login');
        }
    }

    /**
     * تسجيل الخروج
     * @return void
     */
    public function logout()
    {
        Session::destroy();
        Session::setFlash('success', 'تم تسجيل الخروج بنجاح');
        $this->redirect('login');
    }

    /**
     * التحقق إذا كان المستخدم مسجل الدخول
     * @return bool
     */
    public static function check()
    {
        Session::init();
        return Session::has('user_id');
    }

    /**
     * الحصول على بيانات المستخدم الحالي
     * @return object|null
     */
    public static function user()
    {
        if (self::check()) {
            $user = new \stdClass();
            $user->id = Session::get('user_id');
            $user->email = Session::get('user_email');
            $user->username = Session::get('user_username');
            $user->full_name = Session::get('user_full_name');
            $user->created_at = Session::get('user_created_at');
            return $user;
        }
        return null;
    }

    /**
     * التحقق من صلاحيات الوصول لأي صفحة محمية
     * @return void
     */
    public static function requireAuth()
    {
        if (!self::check()) {
            Session::setFlash('error', 'الرجاء تسجيل الدخول أولاً');
            header('Location: '. Path::url('login'));
            exit;
        }
    }
}
