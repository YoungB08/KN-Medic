<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php';

class UserModel
{
    public static function UserLogin($user, $pass)
    {
        global $KNCMS;
        $user = $KNCMS->anti_text($user); // sqli
        $pass = $KNCMS->anti_text($pass); // sqli
        if (check_rows('users', 'Username', $user)) {
            $userS = $KNCMS->query("SELECT * FROM users WHERE `Username` = '$user' AND `Password` = '$pass'")->fetch_array();
            if ($userS['Password'] == $pass) {
                return 1;
            } else return 0;
        } else return 0;
    }
    public static function UserRegister($user, $pass, $email, $phone, $name)
    {
        global $KNCMS;
        $user = $KNCMS->anti_text($user); // sqli
        $pass = $KNCMS->anti_text($pass); // sqli
        // $email = $KNCMS->anti_text($email); // sqli
        $phone = $KNCMS->anti_text($phone); // sqli
        $name =  $KNCMS->anti_text($name); // sqli
        /* 
        0: Exits acc
        99: Exits Email
        98: Exits Phone
        97: pass small than 6
        */

        if (check_rows('users', 'Username', $user)) return 0;
        if (check_rows('users', 'Email', $email)) return 99;
        if (check_rows('users', 'Phone', $phone)) return 98;

        if(strlen($pass) < 6) return 97;
        
        $reg = $KNCMS->query("INSERT INTO `users` 
        (`Username`, `Password`, `Name`, `Email`, `Phone`) VALUES ('$user', '$pass', '$name', '$email', '$phone')");
        if($reg) return 1;
        else return 2;
    }
    public static function isLogin()
    {
        if(isset($_SESSION['user']))
        {
            if(check_rows('users', 'Username', $_SESSION['user'])) return 1;
        } else return 0;
    }
    public static function GetUserInfo($username)
    {
        global $KNCMS;
        $user = $KNCMS->query("SELECT * FROM users WHERE `Username` = '$username'")->fetch_array();
        return $user;
    }
}
