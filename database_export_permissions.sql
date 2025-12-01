-- =====================================================
-- Database Export for Authorization System
-- CMS Website Peradaban
-- =====================================================

-- Users Table
INSERT INTO users (id, name, email, photo, email_verified_at, password, remember_token, created_at, updated_at) VALUES (1, 'Admin User aaa', 'admin@example.com', 'profile-photos/1763800470.jpg', '2025-11-22 01:32:22', '$2y$12$acKgkhjJj6COuMP6yBlQiupgl25mBCXcvjbbYGQ3vcLEW9.PbrTse', '', '2025-11-22 01:32:22', '2025-11-22 08:34:30');
INSERT INTO users (id, name, email, photo, email_verified_at, password, remember_token, created_at, updated_at) VALUES (2, 'Regular User', 'user@example.com', '', '2025-11-22 01:32:23', '$2y$12$PCtQ4F3TwFpzRoXFiSQihOQlPaWR3dlYam9eJFZ4GVjuROCvzCuZ.', '', '2025-11-22 01:32:23', '2025-11-22 01:32:23');

-- Roles Table
INSERT INTO roles (id, name, guard_name, created_at, updated_at) VALUES (1, 'admin', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO roles (id, name, guard_name, created_at, updated_at) VALUES (2, 'user', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');

-- Permissions Table
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (1, 'dashboard.view', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (2, 'users.view', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (3, 'users.create', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (4, 'users.edit', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (5, 'users.delete', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (6, 'roles.view', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (7, 'roles.create', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (8, 'roles.edit', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (9, 'roles.delete', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (10, 'permissions.view', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (11, 'permissions.create', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (12, 'permissions.edit', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (13, 'permissions.delete', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (14, 'settings.view', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (15, 'settings.edit', 'web', '2025-11-22 01:32:22', '2025-11-22 01:32:22');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (16, 'menus.view', 'web', '2025-11-22 11:06:26', '2025-11-22 11:06:26');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (17, 'menus.create', 'web', '2025-11-22 11:06:26', '2025-11-22 11:06:26');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (18, 'menus.edit', 'web', '2025-11-22 11:06:26', '2025-11-22 11:06:26');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (19, 'menus.delete', 'web', '2025-11-22 11:06:26', '2025-11-22 11:06:26');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (20, 'posts.view', 'web', '2025-11-22 11:58:31', '2025-11-22 11:58:31');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (21, 'posts.create', 'web', '2025-11-22 11:58:31', '2025-11-22 11:58:31');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (22, 'posts.edit', 'web', '2025-11-22 11:58:31', '2025-11-22 11:58:31');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (23, 'posts.delete', 'web', '2025-11-22 11:58:31', '2025-11-22 11:58:31');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (24, 'posts.publish', 'web', '2025-11-22 11:58:31', '2025-11-22 11:58:31');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (25, 'posts.archive', 'web', '2025-11-22 11:58:31', '2025-11-22 11:58:31');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (26, 'categories.view', 'web', '2025-11-22 15:49:45', '2025-11-22 15:49:45');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (27, 'categories.create', 'web', '2025-11-22 15:49:45', '2025-11-22 15:49:45');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (28, 'categories.edit', 'web', '2025-11-22 15:49:45', '2025-11-22 15:49:45');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (29, 'categories.delete', 'web', '2025-11-22 15:49:45', '2025-11-22 15:49:45');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (30, 'pages.view', 'web', '2025-11-23 04:50:42', '2025-11-23 04:50:42');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (31, 'pages.create', 'web', '2025-11-23 04:50:42', '2025-11-23 04:50:42');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (32, 'pages.edit', 'web', '2025-11-23 04:50:42', '2025-11-23 04:50:42');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (33, 'pages.delete', 'web', '2025-11-23 04:50:42', '2025-11-23 04:50:42');
INSERT INTO permissions (id, name, guard_name, created_at, updated_at) VALUES (34, 'activity-logs.view', 'web', '2025-11-23 13:06:30', '2025-11-23 13:06:30');

-- Model_has_roles Table (User-Role Relationships)
INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\Models\User', 1);
INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (2, 'App\Models\User', 2);

-- Role_has_permissions Table (Role-Permission Relationships)
-- Admin Role (ID=1) has ALL permissions
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (1, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (2, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (3, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (4, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (5, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (6, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (7, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (8, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (9, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (10, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (11, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (12, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (13, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (14, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (15, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (16, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (17, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (18, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (19, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (20, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (21, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (22, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (23, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (24, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (25, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (26, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (27, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (28, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (29, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (30, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (31, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (32, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (33, 1);
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (34, 1);

-- User Role (ID=2) has limited permissions
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (1, 2); -- dashboard.view
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (20, 2); -- posts.view
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (21, 2); -- posts.create
INSERT INTO role_has_permissions (permission_id, role_id) VALUES (22, 2); -- posts.edit

-- =====================================================
-- LOGIN INFORMATION FOR TESTING:
-- Admin User: admin@example.com
-- Regular User: user@example.com
-- Password: password (default for both users)
-- =====================================================