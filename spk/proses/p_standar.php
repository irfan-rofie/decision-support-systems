<?php
    include '../koneksi.php';
    $act = $_GET['act'];
    switch ($act) {
        case "save":
            mysql_query("INSERT INTO t_standar(standar,nilai) VALUES('" . $_POST['standar'] . "','" . $_POST['nilai'] . "')");
            header("location:../../spk/index.php?menu=std&status=succes&action=save");
            break;
        case "update":
            mysql_query("UPDATE t_standar SET standar='" . $_POST['standar'] . "',nilai='" . $_POST['nilai'] . "' WHERE id_standar='".$_POST['id_standar']."'");
            header("location:../../spk/index.php?menu=std&status=succes&action=update");
            break;
        case "delete":
            mysql_query("UPDATE t_standar SET status='N' WHERE id_standar='".$_GET['id']."'");
            header("location:../../spk/index.php?menu=std&status=succes&action=delete");
            break;
    }
?>