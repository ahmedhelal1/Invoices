-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 12:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoices`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive_invoices`
--

CREATE TABLE `archive_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoices_number` varchar(50) NOT NULL,
  `invoices_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `product` varchar(50) NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `amount_collection` decimal(8,2) DEFAULT NULL,
  `amount_commission` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `rate_vat` varchar(999) NOT NULL,
  `value_vat` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `value_status` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_attachments`
--

CREATE TABLE `invoices_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(999) NOT NULL,
  `invoices_number` varchar(50) NOT NULL,
  `created_by` varchar(999) NOT NULL,
  `id_invoices` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_details`
--

CREATE TABLE `invoices_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_invoices` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `section` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `value_status` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `user` varchar(300) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_05_215245_create_sections_table', 1),
(6, '2024_12_06_164333_create_invoices_table', 1),
(7, '2024_12_09_120308_create_products_table', 1),
(8, '2024_12_11_162836_create_invoices_details_table', 1),
(9, '2024_12_11_164830_create_invoices_attachments_table', 1),
(10, '2024_12_21_210558_create_archive_invoices_table', 1),
(11, '2024_12_29_141846_create_permission_tables', 1),
(12, '2025_01_09_140920_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'الفواتير', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(2, 'قائمة الفواتير', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(3, 'الفواتير المدفوعة', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(4, 'الفواتير المدفوعة جزئيا', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(5, 'الفواتير الغير مدفوعة', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(6, 'ارشيف الفواتير', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(7, 'التقارير', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(8, 'تقرير الفواتير', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(9, 'تقرير العملاء', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(10, 'المستخدمين', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(11, 'قائمة المستخدمين', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(12, 'صلاحيات المستخدمين', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(13, 'الاعدادات', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(14, 'المنتجات', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(15, 'الاقسام', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(16, 'اضافة فاتورة', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(17, 'حذف الفاتورة', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(18, 'تصدير EXCEL', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(19, 'تغير حالة الدفع', 'web', '2025-01-09 21:39:56', '2025-01-09 21:39:56'),
(20, 'تعديل الفاتورة', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(21, 'ارشفة الفاتورة', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(22, 'طباعةالفاتورة', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(23, 'اضافة مرفق', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(24, 'حذف المرفق', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(25, 'اضافة مستخدم', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(26, 'تعديل مستخدم', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(27, 'حذف مستخدم', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(28, 'عرض صلاحية', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(29, 'اضافة صلاحية', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(30, 'تعديل صلاحية', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(31, 'حذف صلاحية', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(32, 'اضافة منتج', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(33, 'تعديل منتج', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(34, 'حذف منتج', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(35, 'اضافة قسم', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(36, 'تعديل قسم', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(37, 'حذف قسم', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57'),
(38, 'الاشعارات', 'web', '2025-01-09 21:39:57', '2025-01-09 21:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(999) NOT NULL,
  `description` text DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2025-01-09 21:40:10', '2025-01-09 21:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(999) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` varchar(999) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `roles_name` text NOT NULL,
  `Status` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `roles_name`, `Status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ahmedhelal', 'owner@gmail.com', NULL, '\"[owner]\"', 'مفعل', '$2y$10$lQpgKggZC7opokhcQ10wl.RrvXSQuBwYAVZAFgf/ErQJL/IrSGtK2', NULL, '2025-01-09 21:40:10', '2025-01-09 21:40:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_invoices`
--
ALTER TABLE `archive_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_section_id_foreign` (`section_id`);

--
-- Indexes for table `invoices_attachments`
--
ALTER TABLE `invoices_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_attachments_id_invoices_foreign` (`id_invoices`);

--
-- Indexes for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_details_id_invoices_foreign` (`id_invoices`),
  ADD KEY `invoices_details_section_foreign` (`section`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_section_id_foreign` (`section_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive_invoices`
--
ALTER TABLE `archive_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices_attachments`
--
ALTER TABLE `invoices_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices_details`
--
ALTER TABLE `invoices_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices_attachments`
--
ALTER TABLE `invoices_attachments`
  ADD CONSTRAINT `invoices_attachments_id_invoices_foreign` FOREIGN KEY (`id_invoices`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD CONSTRAINT `invoices_details_id_invoices_foreign` FOREIGN KEY (`id_invoices`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_details_section_foreign` FOREIGN KEY (`section`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
