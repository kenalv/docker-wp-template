<?php
// Production wp-config using environment variables
define('DB_NAME', getenv('WORDPRESS_DB_NAME') ?: 'tsd_cms');
define('DB_USER', getenv('WORDPRESS_DB_USER') ?: 'tsd_cms_user');
define('DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') ?: 'WZ1jh8wbKwmW6SgiD4!');
define('DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'host.docker.internal:3306');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

$table_prefix = getenv('WORDPRESS_TABLE_PREFIX') ?: 'wp_';

define('WP_DEBUG', getenv('WP_DEBUG') === 'true' ? true : false);
define('WP_ENV', getenv('WP_ENV') ?: 'production');
define('WP_HOME', getenv('WP_HOME') ?: 'https://cms.ticostack.dev');
define('WP_SITEURL', getenv('WP_SITEURL') ?: 'https://cms.ticostack.dev');

// WordPress Security Keys and Salts
define('AUTH_KEY',         getenv('WORDPRESS_AUTH_KEY') ?: 'put your unique phrase here');
define('SECURE_AUTH_KEY',  getenv('WORDPRESS_SECURE_AUTH_KEY') ?: 'put your unique phrase here');
define('LOGGED_IN_KEY',    getenv('WORDPRESS_LOGGED_IN_KEY') ?: 'put your unique phrase here');
define('NONCE_KEY',        getenv('WORDPRESS_NONCE_KEY') ?: 'put your unique phrase here');
define('AUTH_SALT',        getenv('WORDPRESS_AUTH_SALT') ?: 'put your unique phrase here');
define('SECURE_AUTH_SALT', getenv('WORDPRESS_SECURE_AUTH_SALT') ?: 'put your unique phrase here');
define('LOGGED_IN_SALT',   getenv('WORDPRESS_LOGGED_IN_SALT') ?: 'put your unique phrase here');
define('NONCE_SALT',       getenv('WORDPRESS_NONCE_SALT') ?: 'put your unique phrase here');

// Hardening
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', false); // set true if you want to block plugin/theme installs

// Memory & uploads sane defaults
if (!defined('WP_MEMORY_LIMIT')) define('WP_MEMORY_LIMIT', getenv('WP_MEMORY_LIMIT') ?: '256M');

// Set HTTPS behind Traefik
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
  $_SERVER['HTTPS'] = 'on';
}

// Force SSL for admin if in production
if (getenv('WP_ENV') === 'production') {
  define('FORCE_SSL_ADMIN', true);
}

// Redis Cache Configuration
define('WP_REDIS_HOST', getenv('WP_REDIS_HOST') ?: 'redis');
define('WP_REDIS_PORT', getenv('WP_REDIS_PORT') ?: 6379);
define('WP_REDIS_DATABASE', getenv('WP_REDIS_DATABASE') ?: 0);
define('WP_REDIS_TIMEOUT', 1);
define('WP_REDIS_READ_TIMEOUT', 1);

// Load WordPress
if (!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');
require_once ABSPATH . 'wp-settings.php';