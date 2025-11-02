<?php
session_start();
require_once __DIR__.'/includes/config.php';
unset($_SESSION['user']);
session_write_close();
header('Location: ' . url('index.php'));
exit;
