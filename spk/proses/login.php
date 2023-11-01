<?php

session_start();
include '../koneksi.php';
include '../function/grade_convert.php';
/* @var $_POST type */
$username = $_POST['username'];
$password = md5($_POST['password']);
$q = mysql_query("select * from t_user where username='$username' and  password='$password' and aktif='Y'");
$j = mysql_num_rows($q);
if ($j > 0) {
    $_SESSION['login'] = true;
    $rows = mysql_fetch_array($q);
    $_SESSION['username'] = $rows['username'];
    $_SESSION['level'] = level_convert($rows['level']);
    header("location:../../spk/index.php");
} else {
    echo '<script type="text/javascript">window.alert("Username atau Password Salah");
		location.href=\'../proses/../../spk/../index.php\'</script>';
}
?>

