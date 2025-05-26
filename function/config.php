
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$_SESSION['session_request'] = time();
$time = date('Y-m-d h:i:z');
$base_url = 'http://localhost/'; // Thay url web bạn

class KNCMS
{
    private $ketnoi;
    function ketnoi()
    {
        if (!$this->ketnoi) {
            // mẫu config database
            // $this->ketnoi = mysqli_connect('IP HOST hoặc để mặc định localhost', 'User Database', 'Password Database', 'Database Name') or die('Vui lòng kết nối đến DATABASE');
            $this->ketnoi = mysqli_connect('localhost', 'root', '123456', 'revo') or die('Vui lòng kết nối đến DATABASE');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }
    function disketnoi()
    {
        if ($this->ketnoi) {
            mysqli_close($this->ketnoi);
        }
    }

    function getUser($user)
    {
        $this->ketnoi();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `Username` = '$user'")->fetch_array();
        return $row;
    }

    function getCharacter($char)
    {
        $this->ketnoi();
        $row = $this->ketnoi->query("SELECT * FROM `players` WHERE `PlayerName` = '$char'")->fetch_array();
        return $row;
    }

    function getSite()
    {
        $this->ketnoi();
        $row = $this->ketnoi->query("SELECT * FROM `kncms_settings`")->fetch_array();
        return $row;
    }
    function query($sql)
    {
        $this->ketnoi();
        $sqlz = $sql;
        $row = $this->ketnoi->query($sqlz);
        return $row;
    }
    function get_row($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }
    function num_rows($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }
    function get_list($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function gettime()
    {
        return date('Y/m/d H:i:s', time());
    }
    function anti_text($text)
    {
        $text = html_entity_decode(trim($text), ENT_QUOTES, 'UTF-8');
        //$text=str_replace(" ","-", $text);
        $text = str_replace("--", "", $text);
        $text = str_replace("@", "", $text);
        $text = str_replace("/", "", $text);
        $text = str_replace("\\", "", $text);
        $text = str_replace(":", "", $text);
        $text = str_replace("\"", "", $text);
        $text = str_replace("'", "", $text);
        $text = str_replace("<", "", $text);
        $text = str_replace(">", "", $text);
        $text = str_replace(",", "", $text);
        $text = str_replace("?", "", $text);
        $text = str_replace(";", "", $text);
        $text = str_replace(".", "", $text);
        $text = str_replace("[", "", $text);
        $text = str_replace("]", "", $text);
        $text = str_replace("$", "", $text);
        $text = str_replace("(", "", $text);
        $text = str_replace(")", "", $text);
        $text = str_replace("́", "", $text);
        $text = str_replace("̀", "", $text);
        $text = str_replace("̃", "", $text);
        $text = str_replace("̣", "", $text);
        $text = str_replace("̉", "", $text);
        $text = str_replace("*", "", $text);
        $text = str_replace("!", "", $text);
        $text = str_replace("%", "", $text);
        $text = str_replace("#", "", $text);
        $text = str_replace("^", "", $text);
        $text = str_replace("=", "", $text);
        $text = str_replace("+", "", $text);
        $text = str_replace("~", "", $text);
        $text = str_replace("`", "", $text);
        return $text;
    }


    function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
    function xoadau($strTitle)
    {
        $strTitle = strtolower($strTitle);
        $strTitle = trim($strTitle);
        $strTitle = str_replace(' ', '-', $strTitle);
        $strTitle = preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/", 'o', $strTitle);
        $strTitle = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/", 'o', $strTitle);
        $strTitle = preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/", 'a', $strTitle);
        $strTitle = preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/", 'a', $strTitle);
        $strTitle = preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/", 'e', $strTitle);
        $strTitle = preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/", 'e', $strTitle);
        $strTitle = preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/", 'u', $strTitle);
        $strTitle = preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/", 'u', $strTitle);
        $strTitle = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $strTitle);
        $strTitle = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $strTitle);
        $strTitle = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $strTitle);
        $strTitle = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $strTitle);
        $strTitle = str_replace('đ', 'd', $strTitle);
        $strTitle = str_replace('Đ', 'd', $strTitle);
        $strTitle = preg_replace("/[^-a-zA-Z0-9]/", '', $strTitle);
        return $strTitle;
    }
    function format_cash($price)
    {
        return str_replace(",", ".", number_format($price));
    }
    function exitsql($sql)
    {
        $this->ketnoi();
        $result = mysqli_query($this->ketnoi, $sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        curl_close($ch);
        return $data;
    }
    function msg_success($text, $url, $time)
    {
        return die('<script type="text/javascript">Swal.fire("Thành Công", "' . $text . '","success");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
    }
    function msg_error($text, $url, $time)
    {
        return die('<script type="text/javascript">Swal.fire("Thất Bại", "' . $text . '","error");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
    }
    function msg_warning($text, $url, $time)
    {
        return die('<script type="text/javascript">Swal.fire("Thông Báo", "' . $text . '","warning");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
    }
    function rows_sql($dataz)
    {
        if ($dataz->num_rows != 0) { // da co du lieu
            $kt = True;
        } else {
            $kt = False; // chua co du lieu
        }
        return $kt;
    }
}
$KNCMS = new KNCMS;

function getUserModel($user)
{
    $KNCMS = new KNCMS;
    $user_sql = $KNCMS->get_row("SELECT * FROM `players` WHERE `PlayerName` = '$user' ");
    $url = '/lib/model/skins/' . $user_sql['Skin'] . '';
    return $url;
}
function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if ($ip == "::1") {
        $ip = '127.0.0.1';
    }
    return $ip;
}
// function sendCSM($mail_nhan, $ten_nhan, $chu_de, $noi_dung)
// {
//     $mail = new PHPMailer();
//     $smtp = new SMTP();
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'tls://smtp.gmail.com';                     //Set the SMTP server to send through
//     // $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'maztechwork@gmail.com';                     //SMTP username
//     $mail->Password   = 'ndnpyrlwoldcgaqz';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('MaztechWork@gmail.com', "MazTech - Develop Team");
//     $mail->addAddress($mail_nhan, $ten_nhan);     //Add a recipient
//     $mail->addReplyTo('maztechwork@gmail.com', 'Not Reply');
//     $mail->addCC($mail_nhan);

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = $chu_de;
//     $mail->Body    = $noi_dung;
//     $mail->CharSet = 'UTF-8';
//     $send = $mail->send();
//     return $send;
// }
function hUrl($url)
{
    global $base_url;
    $new_url = str_replace("//", "/", $url);
    $new_url = $base_url . $url;
    return $new_url;
}


function XoaKiTuDacBiet($str) {
    $pattern = '/[^\p{L}\p{N}\s]/u';
    $cleanedStr = preg_replace($pattern, '', $str);
    $cleanedStr = trim(preg_replace('/\s+/', ' ', $cleanedStr));
    return $cleanedStr;
}

function writeLog($message, $logFile = 'app.log') {
    // Tạo đường dẫn đầy đủ tới tệp log
    $filePath = __DIR__ . '/' . $logFile;

    // Định dạng thông báo log (thời gian + thông báo)
    $logMessage = "[" . date("Y-m-d H:i:s") . "] " . $message. '(IP:'.getIp().')' . PHP_EOL;

    // Ghi thông báo vào tệp log (chế độ append)
    file_put_contents($filePath, $logMessage, FILE_APPEND);
}
function check_rows($table, $field, $data)
{
    $KNCMS = new KNCMS;
    $querycheck  = $KNCMS->query("SELECT * FROM `$table` WHERE `$field` = '$data'");
    if ($querycheck->num_rows > 0) {
        return true;
    }
    else return false;
}
function get_rows($table, $field, $data)
{
    $KNCMS = new KNCMS;
    $querycheck  = $KNCMS->query("SELECT * FROM `$table` WHERE `$field` = '$data'");
    if ($querycheck->num_rows > 0) {
        return $querycheck->fetch_array();
    }
    else return false;
}
?>