-- --------------------------------------------------------
-- قاعدة بيانات مشروع MVC التعليمي
-- إصدار: 1.0
-- تاريخ الإنشاء: 2024
-- --------------------------------------------------------

-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS `mvc_project`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `mvc_project`;

-- --------------------------------------------------------
-- هيكل جدول المستخدمين
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- بيانات تجريبية للمستخدمين
-- --------------------------------------------------------

-- كلمة المرور: 123456 (مشفرة)
INSERT INTO `users` (`username`, `email`, `password`, `full_name`, `created_at`) VALUES
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مدير النظام', NOW()),
('user1', 'user1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مستخدم تجريبي', NOW());

-- --------------------------------------------------------
-- جدول الجلسات (اختياري - لتحسين الأداء)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- جدول أنشطة المستخدمين (لأغراض التدريب)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- بيانات تجريبية للأنشطة
-- --------------------------------------------------------

INSERT INTO `user_activities` (`user_id`, `activity_type`, `description`, `ip_address`, `created_at`) VALUES
(1, 'login', 'تسجيل الدخول إلى النظام', '127.0.0.1', NOW()),
(1, 'profile_view', 'عرض الملف الشخصي', '127.0.0.1', NOW()),
(2, 'register', 'تسجيل مستخدم جديد', '127.0.0.1', NOW());