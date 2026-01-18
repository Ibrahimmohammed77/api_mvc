<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

/**
 * متحكم لوحة التحكم - الصفحات التي تحتاج إلى مصادقة
 */
class DashboardController extends Controller
{
    /**
     * البناء - التحقق من المصادقة
     */
    public function __construct()
    {
        // التحقق من تسجيل الدخول قبل الوصول إلى أي دالة
        \App\Controllers\AuthController::requireAuth();
    }

    /**
     * عرض الصفحة الرئيسية للوحة التحكم
     * @return void
     */
    public function index()
    {
        $data = [
            'title' => 'لوحة التحكم',
            'user' => \App\Controllers\AuthController::user(),
            'success_message' => Session::getFlash('success')
        ];
        
        $this->view('dashboard/index', $data);
    }

    /**
     * عرض صفحة الملف الشخصي
     * @return void
     */
    public function profile()
    {
        $data = [
            'title' => 'الملف الشخصي',
            'user' => \App\Controllers\AuthController::user()
        ];
        
        $this->view('dashboard/profile', $data);
    }

    /**
     * عرض إحصائيات لوحة التحكم
     * @return void
     */
    public function stats()
    {
        $data = [
            'title' => 'الإحصائيات',
            'user' => \App\Controllers\AuthController::user()
        ];
        
        $this->view('dashboard/stats', $data);
    }

    /**
     * عرض إعدادات الحساب
     * @return void
     */
    public function settings()
    {
        $data = [
            'title' => 'الإعدادات',
            'user' => \App\Controllers\AuthController::user()
        ];
        
        $this->view('dashboard/settings', $data);
    }
}