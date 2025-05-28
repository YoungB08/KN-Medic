<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/models/user.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = $_POST['remember'] ?? 0;

if (UserModel::UserLogin($username, $password)) {
    $_SESSION['user'] = $username;
    echo json_encode([
        'status' => 1,
        'msg' => 'Đăng nhập thành công!'
    ]);
} else {
    echo json_encode([
        'status' => 2,
        'msg' => 'Sai tài khoản hoặc mật khẩu!'
    ]);
}