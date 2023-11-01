<?php
    include '../koneksi.php';
    $act = $_GET['act'];
    switch ($act) {
        case "save":
            mysql_query("INSERT INTO t_user(username,password,level) VALUES('" . $_POST['username'] . "','" . md5($_POST['password']) . "','" . $_POST['level'] . "')");
            header("location:../../spk/index.php?menu=usr&status=succes&action=save");
            break;
        case "update":
            mysql_query("UPDATE t_user SET username='" . $_POST['username'] . "',password='" . md5($_POST['password']) . "',level='" . $_POST['level'] . "' WHERE user_id='".$_POST['user_id']."'");
            header("location:../../spk/index.php?menu=usr&status=succes&action=update");
            break;
        case "delete":
            mysql_query("UPDATE t_user SET aktif='N' WHERE user_id='".$_GET['id']."'");
            header("location:../../spk/index.php?menu=usr&status=succes&action=delete");
            break;
    }
?>