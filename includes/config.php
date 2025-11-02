<?php
// Auto-detect base path
if (!defined('BASE_PATH')) {
	$base_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
	if ($base_path === '/' || $base_path === '\\') {
		$base_path = '';
	} else {
		$base_path = rtrim($base_path, '/');
	}
	define('BASE_PATH', $base_path);
}

// Helper function to generate URLs with base path
function url($path = '') {
	$path = ltrim($path, '/');
	if (empty($path)) {
		return BASE_PATH ? BASE_PATH : '/';
	}
	return BASE_PATH . '/' . $path;
}
