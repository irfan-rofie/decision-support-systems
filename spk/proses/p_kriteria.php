<?php
    include '../koneksi.php';
    $act = $_GET['act'];
    switch ($act) {
        case "save":
            mysql_query("INSERT INTO t_kriteria(nama,atribut) VALUES('" . $_POST['nama'] . "','" . $_POST['atribut'] . "')");
            header("location:../../spk/index.php?menu=krt&status=succes&action=save");
            break;
        case "update":
            mysql_query("UPDATE t_kriteria SET nama='" . $_POST['nama'] . "',atribut='" . $_POST['atribut'] . "' WHERE id_kriteria='".$_POST['id_kriteria']."'");
            header("location:../../spk/index.php?menu=krt&status=succes&action=update");
            break;
        case "delete":
            mysql_query("UPDATE t_kriteria SET status='N' WHERE id_kriteria='".$_GET['id']."'");
            header("location:../../spk/index.php?menu=krt&status=succes&action=delete");
            break;
    }
?>