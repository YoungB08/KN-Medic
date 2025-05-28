<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/models/user.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$regtster = UserModel::UserRegister($username, $password, $email, $phone, $name);
if ($regtster == 1) {
    session_start();
    $_SESSION['user'] = $username;
    echo json_encode([
        'status' => 1,
        'msg' => 'Đăng ký thành công!'
    ]);
} else if($regtster == 2) {
    echo json_encode([
        'status' => 2,
        'msg' => 'Đã có lỗi xảy ra!'
    ]);
} else if($regtster == 0) {
    echo json_encode([
        'status' => 0,
        'msg' => 'Tài khoản đã tồn tại'
    ]);
}
else if($regtster == 99) {
    echo json_encode([
        'status' => 99,
        'msg' => 'Email đã tồn tại!'
    ]);
}
else if($regtster == 98) {
    echo json_encode([
        'status' => 98,
        'msg' => 'Số điện thoại đã tồn tại!'
    ]);
}
else if($regtster == 97) {
    echo json_encode([
        'status' => 97,
        'msg' => 'Mật khẩu phải lớn hơn 6 kí tự và không chứa kí tự đặc biệt (!@#$%^&*)!'
    ]);
}