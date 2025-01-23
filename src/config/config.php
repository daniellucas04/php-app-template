<?php

// CLIENT
define("CLIENT_NAME", "Template");

// URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:/" : "http:/";
define("PUBLIC_URL", "{$protocol}/{$_SERVER['SERVER_NAME']}");
define("ADMIN_URL", "{$protocol}/{$_SERVER['SERVER_NAME']}/admin");

// USER TYPES
define('INTERN', 1);
define('CUSTOMER', 2);
define('PROFESSIONAL', 3);

// Permissions
define("CAN_CREATE", "can_create");
define("CAN_READ",   "can_read");
define("CAN_UPDATE", "can_update");
define("CAN_DELETE", "can_delete");