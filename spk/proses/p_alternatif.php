<?php
    include '../koneksi.php';
    include '../function/date_convert.php';
    $act = $_GET['act'];
    switch ($act) {
        case "save":
            mysql_query("INSERT INTO t_alternatif(nik,periode,tgl_penilaian) VALUES('" . $_POST['nik'] . "','" . $_POST['periode'] . "','" . $_POST['tgl_penilaian'] . "')");
            header("location:../../spk/index.php?menu=alt&status=succes&action=save");
            break;
        case "update":
            mysql_query("UPDATE t_alternatif SET nik='" . $_POST['nik'] . "',periode='" . $_POST['periode'] . "',tgl_penilaian='" . $_POST['tgl_penilaian'] . "' WHERE id_alternatif='".$_POST['id_alternatif']."'");
            header("location:../../spk/index.php?menu=alt&status=succes&action=update");
            break;
        case "delete":
            mysql_query("UPDATE t_alternatif SET aktif='N' WHERE id_alternatif='".$_GET['id']."'");
            header("location:../../spk/index.php?menu=alt&status=succes&action=delete");
            break;
    }
?>