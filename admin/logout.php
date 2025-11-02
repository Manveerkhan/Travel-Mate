<?php
session_start();
require_once __DIR__.'/../includes/config.php';
unset($_SESSION['admin']);
session_write_close();
header('Location: ' . url('login.php'));
exit;
