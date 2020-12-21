<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$server = $_SERVER['SERVER_NAME'];
 define('SITE_ABS_PATH', $protocol . $server . '/'); 
define('SITE_ABS_UPLOAD_PATH', SITE_ABS_PATH . '/openxcell/uploads/');

define('SITE_REL_PATH', dirname(__FILE__) . '/');
// path for cronlog

define('UPLOAD_DIR_PATH', SITE_REL_PATH . 'uploads/');

define('THUMB_IMAGE_WIDTH', '215');
define('THUMB_IMAGE_HEIGHT', '215');
define('THUMB_THUMB_IMAGE_NAME_APPEND', '215x215_');

//User profile pictures path
define('PROFILE_PICTURE_ORIGINAL', UPLOAD_DIR_PATH . 'profile_pictures/original/');
define('PROFILE_PICTURE_THUMBNAIL', UPLOAD_DIR_PATH . 'profile_pictures/thumbnails/');

define('SITE_ABS_PATH_UPLOADS', SITE_ABS_PATH . 'uploads/');

define('SITE_ABS_PATH_PROFILE_PICTURE', SITE_ABS_PATH_UPLOADS . 'profile_pictures/original/');
define('SITE_ABS_PATH_PROFILE_PICTURE_THUMB', SITE_ABS_PATH_UPLOADS . 'profile_pictures/thumbnails/');
